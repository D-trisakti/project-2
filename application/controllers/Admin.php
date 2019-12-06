<?php

class Admin extends CI_Controller {

    public function index (){
        $data['title'] = 'beranda';
        $this-> load -> view ('admin/header',$data);
        $this-> load -> view ('admin/sidebar');
        $this-> load -> view ('admin/index');
        $this-> load -> view ('admin/footer');
    }
    public function product () {
        $data['title'] = 'Produk';
        $this-> load -> view ('admin/header',$data);
        $this-> load -> view ('admin/sidebar');
        $this-> load -> view ('admin/product');
        $this-> load -> view ('admin/footer');
    }
    public function add_product() {
        $data['title'] = 'Tambah Produk';
        $this-> load -> view ('admin/header',$data);
        $this-> load -> view ('admin/sidebar');
        $this-> load -> view ('admin/add_product');
        $this-> load -> view ('admin/footer');
    }
} 
?>