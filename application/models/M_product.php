<?php
defined('BASEPATH') or exit ('no direct script to access allowed');

 class M_product extends CI_Model {

    public function add_product(){
       $data = [
        'nama'  => htmlspecialchars ($this -> input -> post ('name'),true),
        'price' => htmlspecialchars ($this -> input -> post ('price'),true),
        'total' => htmlspecialchars ($this -> input -> post ('total'),true),
        'category' => htmlspecialchars ($this -> input -> post ('category'),true),
        'deskripsi' => htmlspecialchars ($this -> input -> post ('deskripsi'),true)
       ];
       $this -> db -> insert ('product',$data);
        
        
    }

    public function getproduct(){
        $this ->db -> select ('*');
        $this -> db -> from ('product');
        return $this -> db -> get()->result();
    }
 }
//  $image = $_FILES['imageUpload']['name'];
//             if($image){
//                 $config['upload_path']          = './assets/uploads/';
//                 $config['allowed_types']        = 'gif|jpg|png';
//                 $config['max_size']             = 2048;
//                 $this->load->library('upload', $config);

//                 $this ->upload -> do_upload ('image');
//             }
//             else {
//                 echo $this -> upload -> display_errors();
//             }