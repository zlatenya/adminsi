<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {
  var $data=array();//этот масиив передается в вид

  public function __construct() {
    parent::__construct();
    //Подключение модели
    $this->load->model('cart_model');
  }

  public function index(){
      $this->data['menu'] = $this->db->get('si_page')->result_array();//достаем все данные из базы со страницами чтобы вывести меню
      $this->data['products'] = $this->cart_model->retrieve_products();

      $cart_items= $this->cart->contents(); // Корзина пользователя
      $this->data['items']=$cart_items;

      foreach($cart_items as $row_id => $item){
        $this-> data['cart_items'][] = $this->db->get_where('si_product_catalog',array('id' => $item['id']))->row_array();
      }

      if(isset($_POST['call_back'])){
        if(!empty($_POST['name']) and !empty($_POST['tel'])){
          //создание массива для бд
          $seta=array();
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

      $this->load->view('site/header', $this->data);
      $this->load->view('site/cart_v', $this->data);
      $this->load->view('site/footer');
    }

    public function add_to_cart(){
      // Получаем id добавляемого продукта
      $product_id = $this->input->post('product_id', true);
      // Если $product_id не пустой
      if ($product_id){
          // Получает данные товара
          $product_data = $this->cart_model->get_product($product_id);
          // Если товар существует
          if ($product_data){
              //добавляем данные о товаре в карту
              $this->cart->insert(array(
                  'id' => $product_id,
                  'qty' => 1,
                  'price' => $product_data['price'],
                  'name' => $product_data['name_product'],
              ));
              $result = 'Товар добавлен в корзину';
          }else {
              $result = 'Такого товара не существует';
          }
      }
          $this->session->set_flashdata('message', $result);
          // Редирект на страницу с товарами
          redirect($_SERVER['HTTP_REFERER']);

}

public function delete_item(){
    // Уникальный rowid товара в корзине
    if(isset($_GET['row_id'])){
      $rowid=$_GET['row_id'];
    }
    if ($rowid) {
        $data = array(
            'rowid' => $rowid,
            'qty'   => 0,
        );
        // Обновляем корзину пользователя
        $this->cart->update($data);
        $result = 'Товар успешно удалён из корзины';
    }
      $this->session->set_flashdata('delete',$result);
        // Редирект на страницу с товарами
        redirect($_SERVER['HTTP_REFERER']);
}
public function create_zakaz(){
  if(isset($_POST['zakaz'])){
    if(empty($_POST['name_zakaz']) OR empty($_POST['email_zakaz']) OR empty($_POST['tel_zakaz'])){
        $this->session->set_flashdata('no_create_zakaz','Заполните данные формы для создания заказа');
        redirect($_SERVER['HTTP_REFERER']);
    }else{

      $zakaz= $this->cart->contents();//получение массива с данными карты
      $total_price=0;
      //считаем итоговую сумму заказа
      foreach($zakaz as $key=>$item){
        $price=$item['price'];
        $qty=$_POST[$key];
        $t_price= $price * $qty;
        $total_price +=$t_price;
      }
      //создание массива с данными о заказе
      $seta=array();
      $seta['name']=$_POST['name_zakaz'];
      $seta['email']=$_POST['email_zakaz'];
      $seta['tel']=$_POST['tel_zakaz'];
      $seta['total_price']=$total_price;
      //добавление в базу
      $this->db->insert('si_zakaz', $seta);
      $id = $this->db->insert_id();
      //создание массива с товарами заказа
      $product=array();
      foreach($zakaz as $key=>$item){
        $product['id_product'] = $item['id'];
        $product['qty_product'] = $_POST[$key];
        $product['name_product'] = $item['name'];
        $product['price_product	'] = $item['price'];
        $product['id_zakaz']= $id;
        $this->db->insert('si_zakaz_product', $product);
      }
      //отчистка корзины после создания заказа
      foreach($zakaz as $key=>$item){
        $data = array(
            'rowid' => $key,
            'qty'   => 0,
        );

        $this->cart->update($data);
      }
      $this->session->set_flashdata('create_zakaz','Заказ создан. Спасибо за заказ!');
      redirect($_SERVER['HTTP_REFERER']);
    }
  }
}
//функция отчистки корзины
public function cart_empty(){
  $items = $this->cart->contents();

  foreach($items as $key=>$item){
    $data = array(
        'rowid' => $key,
        'qty'   => 0,
    );

    $this->cart->update($data);
  }

    redirect($_SERVER['HTTP_REFERER']);
}
}
?>
