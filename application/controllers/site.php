<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

  var $data=array();//этот масиив передается в вид


  public function index($segment_1 = null, $segment_2 = null, $segment_3 = null){
    $this->data['segment_1']=$segment_1;
    $this->data['segment_2']=$segment_2;
    $this->data['menu'] = $this->db->get('si_page')->result_array();//достаем все данные из базы со страницами чтобы вывести меню
    $arr_page=array();
    if($segment_2 == null){
      $arr_page=$this->db->get_where('si_page', array('url'=>$segment_1))->row_array();
    }else{
      $arr_page=$this->db->get_where('si_page', array('url'=>$segment_2))->row_array();

    }

    if(isset($_POST['call_back'])){//обработка формы обратной связи
      if(!empty($_POST['name']) and !empty($_POST['tel'])){
        $seta['name']=htmlspecialchars(strip_tags($_POST['name']));
        $seta['email']=htmlspecialchars(strip_tags($_POST['email']));
        $seta['tel']=htmlspecialchars(strip_tags($_POST['tel']));
        $seta['infofield']=htmlspecialchars(strip_tags($_POST['infofield']));
        $this->db->insert('ci_call_back', $seta);
        redirect($_SERVER['HTTP_REFERER']);
      }else{
        $this->session->set_flashdata('error_callback', 'К заполнению обязательны поля Имя и Телефон!');
        header('Location:'. $_SERVER['HTTP_REFERER']);
      }
    }

    $this->data['page'] = $this->db->get_where('si_page', array('url'=>$segment_1))->row_array();//получение данных страницы
    $this->data['categories']=$this->db->get('si_category_catalog')->result_array();//получение всех категорий страниц

    if($segment_1 == null){//значит главная
      $this->data['page'] = $this->db->get_where('si_page', array('type'=>5))->row_array();
      $this->load->view('site/header', $this->data);
      $this->load->view('site/page_v', $this->data);
      $this->load->view('site/footer');
    }else if($segment_1 != null AND $segment_2 == null AND $segment_3 == null){
      if($arr_page['type']==1){//если страница простая
      $this->data['page'] = $this->db->get_where('si_page', array('url'=>$segment_1))->row_array();
      $this->load->view('site/header', $this->data);
      $this->load->view('site/page_v', $this->data);
      $this->load->view('site/footer');
    }else if($arr_page['type']==2){//если страница каталог
      $cat_p = explode(",", $arr_page['category_product']);
      foreach($cat_p as $key=>$k){
        //достаем из базы продукты нужных категорий
        $this->data['products'][]=$this->db->get_where('si_product_catalog', array('category_product'=>$k))->result_array();
      }
      //вывод каталога
      $this->load->view('site/header', $this->data);
      $this->load->view('site/catalog_v', $this->data);
      $this->load->view('site/footer');}
    }else if($segment_2 != null AND $segment_3 == null){
        if($arr_page['type']==1){//это если страница простая сстраница
        $this->data['page'] = $this->db->get_where('si_page', array('url'=>$segment_2))->row_array();
        $this->load->view('site/header', $this->data);
        $this->load->view('site/page_v', $this->data);
        $this->load->view('site/footer');
      }else if($arr_page['type']==2){//это если страница каталог
        $cat_p = explode(",", $arr_page['category_product']);
          foreach($cat_p as $key=>$k){
            //достаем из базы продукты нужных категорий
            $this->data['products'][]=$this->db->get_where('si_product_catalog', array('category_product'=>$k))->result_array();
          }
        //вид страницы каталога
        $this->load->view('site/header', $this->data);
        $this->load->view('site/catalog_v', $this->data);
        $this->load->view('site/footer');
      }else if(!isset($arr_page)){
        //вывод страницы продукта
          $this->data['product']=$this->db->get_where('si_product_catalog',array('page_url'=>$segment_2))->row_array();
          $this->load->view('site/header', $this->data);
          $this->load->view('site/product_v', $this->data);
          $this->load->view('site/footer');
        }
      }
      else if ($segment_3 != null){
        //вывод страницы продукта
      $this->data['product']=$this->db->get_where('si_product_catalog',array('page_url'=>$segment_3))->row_array();
      $this->load->view('site/header', $this->data);
      $this->load->view('site/product_v', $this->data);
      $this->load->view('site/footer');
    }
  }
}
?>
