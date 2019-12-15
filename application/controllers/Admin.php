<?php

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect(site_url('Landing'));
        }
    }
    public function index (){
        $data['user'] = $this -> db ->get_where ('user', ['email' => $this -> session -> userdata('email')])-> row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'beranda';
        $this-> load -> view ('admin/header',$data);
        $this-> load -> view ('admin/sidebar',$data);
        $this-> load -> view ('admin/index');
        $this-> load -> view ('admin/footer');
    }
    public function product () {
        
        $data['user'] = $this -> db ->get_where ('user', ['email' => $this -> session -> userdata('email')])-> row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Produk';
        $this -> load -> model ('M_product');
        $data['product'] = $this -> M_product -> getproduct();
        $this-> load -> view ('admin/header',$data);
        $this-> load -> view ('admin/sidebar',$data);
        $this-> load -> view ('admin/product',$data);
        $this-> load -> view ('admin/footer');
    }
    public function add_product() {
        $data['user'] = $this -> db ->get_where ('user', ['email' => $this -> session -> userdata('email')])-> row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Tambah Produk';

        $this -> form_validation -> set_rules('name','name','trim|required');
        $this -> form_validation -> set_rules('price','price','required');
        $this -> form_validation -> set_rules('total','total','required');
        $this -> form_validation -> set_rules('category','category','trim|required');
        $this -> form_validation -> set_rules('deskripsi','deskripsi','trim|required');
        

        if ($this -> form_validation -> run() == false) 
        {
            $this-> load -> view ('admin/header',$data);
            $this-> load -> view ('admin/sidebar',$data);
            $this-> load -> view ('admin/add_product');
            $this-> load -> view ('admin/footer');
        }
        else
        {
         $this -> load -> model ('M_product');
         $this -> M_product -> add_product();
        
         $this -> session -> set_flashdata ('pesan', 
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Produk Berhasil di tambahkan
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>' 
        );

         redirect('admin/product');
        }
        
    }
    public function logout () {
        $this -> session -> unset_userdata('email');
        $this -> session -> unset_userdata('role');
        redirect('Landing/index');
    }
} 
?>