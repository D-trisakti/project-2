<?php
defined('BASEPATH') or exit ('no direct script to access allowed');

 class M_product extends CI_Model {

    public function add_product(){
       $data = [
        'nama'  => htmlspecialchars ($this -> input -> post ('name'),true),
        'price' => htmlspecialchars ($this -> input -> post ('price'),true),
        'total' => htmlspecialchars ($this -> input -> post ('total'),true),
        'category' => htmlspecialchars ($this -> input -> post ('category'),true),
        'deskripsi' => htmlspecialchars ($this -> input -> post ('deskripsi'),true),
        'image' => $this -> upload -> data ('file_name'),
       ];
       $this -> db -> insert ('product',$data);
        
        
    }

    public function getproduct(){
        $this ->db -> select ('*');
        $this -> db -> from ('product');
        return $this -> db -> get()->result();
    }
    public function delete_product($id){
       $this -> db -> where ('id',$id);
       $this -> db -> delete ('product');
    }
    public function getproductbyid($id){
      return $this->db->get_where('product', ['id' => $id])->row_array();
    }
}
