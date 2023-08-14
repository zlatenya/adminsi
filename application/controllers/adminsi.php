<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminsi extends CI_Controller {
	var $component = '';//имя компонента
	var $data=array();//этот масиив передается в вид


	public function index()
	{

		if($this->session->userdata('user')){
			$this->data['page'] = $this->db->get('si_page')->result_array();
			$this->data['title'] = "Структура";
			$this->load->view('template/header_v');
			$this->load->view('all_pages', $this->data);
			$this->load->view('template/footer_v');
		}else{
			redirect('auth');
		}

	}
	public function page($segment_1 = null,$id = 0){
		if($this->session->userdata('user')){
		$this->data['type_page'] = $this->db->get('si_type_page')->result_array();//даннные из базы для вывада типа страницы
		$this->data['category_catalog'] = $this->db->get('si_category_catalog')->result_array();//данные из базы для вывода категорий каталога

		if(isset($_GET['delete'])){//удаление страницы
			$this-> db-> delete('si_page', array('id'=>intval($_GET['delete'])));
			redirect('adminsi');
		}
		//создание новых страниц
		if(isset($_POST['page'])){
			$seta=array();
			if(!empty($_POST['page_title']) and !empty($_POST['page_url'])){//проверка заполнения обязательных полей
				$seta['title']=$_POST['page_title'];
				$seta['type']=$_POST['type_page'];
				if($_POST['type_page']=="2"){
					$seta['category_product']=implode(",", $_POST['category']);}
				else{
					$seta['category_product']=null;
				}
				$seta['url']=$_POST['page_url'];
				$seta['full_text'] = $_POST['full_text'];

				if(isset($_GET['parent_id'])){//проверка на наличие родителя у страницы
					$seta['parent_id'] = intval($_GET['parent_id']);
					$arr_pg =$this->db->get_where('si_page',array('id'=>intval($_GET['parent_id'])))->row_array();
					$seta['level'] = $arr_pg['level'] + 1;
					//родительский левл +1
				}else{
					$seta['level'] = 1;
				}

				if(!isset($_GET['parent_id']) AND $segment_1=='edit' AND $id==0){//добавление новой страницы
					$this->db->insert('si_page', $seta);
					$id = $this->db->insert_id();
					redirect('adminsi/page/edit/'.$id);
				}
				if(!isset($_GET['parent_id']) AND $segment_1=='edit' AND $id!=0){//обновление данных, если редактирование
					$this->db->where('id', $id);
					$this->db->update('si_page', $seta);
					redirect('adminsi/page/edit/'.$id);
				}


				if(isset($_GET['parent_id']) AND $segment_1=='edit' AND $_GET['id']==0){//добавление новой страницы
					$this->db->insert('si_page', $seta);
					$id = $this->db->insert_id();
					redirect('adminsi/page/edit/?parent_id='.intval($_GET['parent_id']).'&id='.$id);
				}

				if(isset($_GET['parent_id']) AND $segment_1=='edit' AND $_GET['id']!=0){//обновление данных, если редактирование
					$this->db->where('id', intval($_GET['id']));
					$this->db->update('si_page', $seta);
					redirect('adminsi/page/edit/?parent_id='.intval($_GET['parent_id']).'&id='.intval($_GET['id']));
				}
		} else{
				$this->session->set_flashdata('error_page', 'К заполнению обязательны поля Название и url!');
				header('Location:'. $_SERVER['HTTP_REFERER']);
			}


		}else{
			//вывод вида
			if((!isset($_GET['parent_id']) AND $segment_1=='edit' AND $id==0) OR (isset($_GET['parent_id']) AND $_GET['id']==0 AND $segment_1=='edit')){ //добавление новой страницы
					$this->data['title'] = "Новая страница";
					$this->load->view('template/header_v');
					$this->load->view('new_page', $this->data);
					$this->load->view('template/footer_v');
				}

				if(!isset($_GET['parent_id']) AND $segment_1=='edit'AND $id!=0){//редактирование страницы
					$this->data['page'] =$this->db->get_where('si_page',array('id'=>$id))->row_array();
					$this->data['title'] = "Редактирование страницы";
					$this->load->view('template/header_v');
					$this->load->view('new_page', $this->data);
					$this->load->view('template/footer_v');}
				}

				if($segment_1=='edit' AND isset($_GET['parent_id']) AND $_GET['id']!=0){//редактирование подстраницы
					$this->data['page'] =$this->db->get_where('si_page',array('id'=>intval($_GET['id'])))->row_array();
					$this->data['title'] = "Редактирование страницы";
					$this->load->view('template/header_v');
					$this->load->view('new_page', $this->data);
					$this->load->view('template/footer_v');
				}
			}else{
				redirect('auth');
			}
}
	public function catalog($segment_1 = null,$id = 0){
		if($this->session->userdata('user')){
		$this->data['category'] = $this->db->get('si_category_catalog')->result_array();//достаем из базы категории каталога товаров
			if($segment_1 == null){//если нулевой сегмент выводим все товары
				$this->data['products'] = $this->db->get('si_product_catalog')->result_array();
				$this->data['title'] = "Каталог";
				$this->load->view('template/header_v');
				$this->load->view('catalog_v', $this->data);
				$this->load->view('template/footer_v');
			}

			if(isset($_GET['delete'])){//удление продукта
				$this-> db-> delete('si_product_catalog', array('id'=>intval($_GET['delete'])));
				redirect('adminsi/catalog');
			}

			if(isset($_GET['del_cat'])){//удаление категории продукта
				$this-> db-> delete('si_category_catalog', array('id'=>intval($_GET['del_cat'])));
				redirect('catalog');
			}
			if(isset($_GET['del_pic'])){
				$arr_pic =$this->db->get_where('si_product_catalog',array('id'=>intval($_GET['del_pic'])))->row_array();
				//print_r($arr_pic);
				//die();
				unlink('upload/'.$arr_pic['img_product']);//удаление картинки с сервера
				//удаление картинки из базы
				$this->db->set('img_product', null);
				$this->db->where('id', intval($_GET['del_pic']));
				$this-> db-> update('si_product_catalog', array());
				redirect('adminsi/catalog/edit/'.$id);
			}

			if(isset($_POST['category'])){//создание и добавление категорий товаров в базу
				$seta = array();
				if(!empty($_POST['name_category'])){
					$seta['name_category'] = $_POST['name_category'];
					$this->db->insert('si_category_catalog', $seta);
				}
			}

			if(isset($_POST['catalog_product'])){//создание карточки продукта
				$seta = array();
				if(!empty($_POST['name_product']) and !empty($_POST['page_url'])){
					$seta['name_product'] = $_POST['name_product'];
					$seta['category_product'] = $_POST['category_product'];
					$seta['page_url'] = $_POST['page_url'];
					$seta['full_text_product'] = $_POST['full_text_product'];
					$seta['price'] = $_POST['price'];
					$check = $this->can_upload($_FILES['img_product']);
					if($check === true){
	        // загружаем изображение на сервер
						$upload_dir = 'upload/';
						$name = "";
						$name = $id.'_img_product_'.$_FILES['img_product']['name'];
						$mov = move_uploaded_file($_FILES['img_product']['tmp_name'],$upload_dir.$name);
						$seta['img_product'] = $name;
	        //echo "<strong>Файл успешно загружен!</strong>";
	      	}else{
	        // выводим сообщение об ошибке
	        	echo "<strong>$check</strong>";
	      	}



					if($segment_1=='edit' AND $id==0){//добавление нового товара
						$this->db->insert('si_product_catalog', $seta);
						$id = $this->db->insert_id();
					}else{//обновление данных, если редактирование
						$this->db->where('id', $id);
						$this->db->update('si_product_catalog', $seta);
					}
					redirect('adminsi/catalog/edit/'.$id);
			} else{
				$this->session->set_flashdata('error_product', 'К заполнению обязательны поля Название и url!');
				header('Location:'. $_SERVER['HTTP_REFERER']);
			}
			}else{
				//вывод вида
				if($segment_1=='edit' AND $id==0){
					$this->data['element']['title'] = "Новый товар";
					$this->load->view('template/header_v');
					$this->load->view('product_v', $this->data);
					$this->load->view('template/footer_v');
				}

				if($segment_1=='edit'AND $id!=0){//редактирование товара
					$this->data['element'] =$this->db->get_where('si_product_catalog',array('id'=>$id))->row_array();
					$this->data['element']['title'] = "Редактирование товара";
					$this->load->view('template/header_v');
					$this->load->view('product_v', $this->data);
					$this->load->view('template/footer_v');
				}
			}
		}else{
			redirect('auth');
		}
		}


	public function account($segment_1 = null,$id = 0){
		if($this->session->userdata('user')){
			if($segment_1 == null){
				//вывов вида со всеми существующими аккаунтами
				$this->data['accounts'] = $this->db->get('si_account')->result_array();
				$this->data['title'] = "Аккаунты";
				$this->load->view('template/header_v');
				$this->load->view('all_accounts', $this->data);
				$this->load->view('template/footer_v');
			}

			if(isset($_GET['delete'])){//удаление аккаунта
				$this-> db-> delete('si_account', array('id'=>intval($_GET['delete'])));
				redirect('adminsi/account');
			}

			if(isset($_POST['account'])){
				//создаем массив для добавления в базу
				if(!empty($_POST['login']) and !empty($_POST['full_name']) and !empty($_POST['password'])){
				$seta = array();
				$seta['login'] = $_POST['login'];
				$seta['full_name'] = $_POST['full_name'];
				$seta['password'] = $_POST['password'];


				if($segment_1=='edit' AND $id==0){//добавление нового элемента
					$this->db->insert('si_account', $seta);
					$id = $this->db->insert_id();
				}else{//обновление данных, если редактирование
					$this->db->where('id', $id);
					$this->db->update('si_account', $seta);
				}
				redirect('adminsi/account/edit/'.$id);
			}else{
				$this->session->set_flashdata('error_account', 'Заполните все поля!');
				header('Location:'. $_SERVER['HTTP_REFERER']);
			}

			}else{
				if($segment_1=='edit' AND $id==0){ // добавление(вид для добавления нового элемента)
						$this->data['element']['title'] = "Новый аккаунт";
						$this->load->view('template/header_v');
						$this->load->view('account_v', $this->data);
						$this->load->view('template/footer_v');
					}
				if($segment_1=='edit'AND $id!=0){//редактирование элемента
					$this->data['element'] =$this->db->get_where('si_account',array('id'=>$id))->row_array();
					$this->data['element']['title'] = "Редактирование аккаунта";
					$this->load->view('template/header_v');
					$this->load->view('account_v', $this->data);
					$this->load->view('template/footer_v');
				}
			}
	}else{
		redirect('auth');
	}
	}

	public function call_back($segment_1 = null,$id = 0){
		if($this->session->userdata('user')){
			//вывод вида истории сообщений
			if($segment_1 == null){
				$this->data['call_back'] = $this->db->get('ci_call_back')->result_array();
				$this->data['title'] = "История сообщений";
				$this->load->view('template/header_v');
				$this->load->view('call_back_v', $this->data);
				$this->load->view('template/footer_v');
			}else{
				//вывод вида выбранного сообщения
				$this->data['message'] =$this->db->get_where('ci_call_back',array('id'=>$segment_1))->row_array();
				$this->data['title'] = "Сообщение";
				$this->load->view('template/header_v');
				$this->load->view('message_v', $this->data);
				$this->load->view('template/footer_v');

			}

			if(isset($_GET['delete'])){//удаление сообщений
				$this-> db-> delete('ci_call_back', array('id'=>intval($_GET['delete'])));
				redirect('adminsi/call_back');
			}
		}else{
			redirect('auth');
		}

	}

	public function zakaz($segment_1 = null,$id = 0){
		if($this->session->userdata('user')){
		if(isset($_GET['delete'])){//удаление заказа
			$this-> db-> delete('si_zakaz', array('id'=>intval($_GET['delete'])));
			redirect('adminsi/zakaz');
		}

		if($segment_1 == null){
			//вывод истории заказов
			$this->data['zakaz'] = $this->db->get('si_zakaz')->result_array();
			$this->data['title'] = "История заказов";
			$this->load->view('template/header_v');
			$this->load->view('zakaz_v', $this->data);
			$this->load->view('template/footer_v');
		}else{
			//вывод отдельного заказа
			$this->data['items'] = $this-> db-> get_where('si_zakaz_product', array('id_zakaz'=>$segment_1))->result_array();
			$this->data['title'] = "Заказ №".$segment_1;
			$this->load->view('template/header_v');
			$this->load->view('zakaz_item', $this->data);
			$this->load->view('template/footer_v');
		}
	}else{
		redirect('auth');
	}

	}
	private function can_upload($file){
	// если имя пустое, значит файл не выбран
    if($file['name'] == '')
		return 'Вы не выбрали файл.';
	/* если размер файла 0, значит его не пропустили настройки
	сервера из-за того, что он слишком большой */
	if($file['size'] == 0)
		return 'Файл слишком большой.';
	// разбиваем имя файла по точке и получаем массив
	$getMime = explode('.', $file['name']);
	// вытаскиваем расширение
	$mime = strtolower(end($getMime));
	// массив допустимых расширений
	$types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');

	// если расширение не входит в список допустимых - return
	if(!in_array($mime, $types))
		return 'Недопустимый тип файла.';

	return true;
  }


}
