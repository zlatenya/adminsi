<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_model {
    public function login($login, $password) {
      $query = $this->db->get_where('si_account', array('login' => $login, 'password' => $password));
      return $query->row_array();
    }
}
