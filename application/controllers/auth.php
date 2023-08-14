<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	function __construct(){
	   parent::__construct();
	  	$this->load->helper('url');//подгружаем библиотеку url
	  	$this->load->model('users_model');// подгружаем модель авторизации
		}
		public function index()
		{
	    if($this->session->userdata('user')){
	      redirect('adminsi');
	    }else{
	    $this->load->view('pages/login');
	  }
	}
	  public function login(){

	    $login = $_POST['login'];
	    $password = $_POST['password'];

	    $data = $this->users_model->login($login, $password);//загрузка данных в модель

	    if($data){//проверка наличия данных в базе
	      $this->session->set_userdata('user', $data);
	      redirect('adminsi');
	    }else{
	      $this->session->set_flashdata('error','Пользователь с такими данными не найден');
	      header('Location:'. $_SERVER['HTTP_REFERER']);

	    }
	  }
	  public function logout(){
			$this->session->unset_userdata('user');
	    redirect('auth');
		}
	 }
