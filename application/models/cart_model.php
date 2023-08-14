<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model{

  function retrieve_products(){
             $query = $this->db->get('si_product_catalog');
             return $query->result_array();
         }
 public function get_product($product_id)
  {
     return $this->db->get_where('si_product_catalog',array('id' => $product_id))->row_array();
   }

}
?>
