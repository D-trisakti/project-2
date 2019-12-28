<?php

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect(site_url('Landing'));
        }
        $this -> load -> model ('M_product');
        $this -> load -> model ('M_user');
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
        $upload_image = $_FILES['image']['name'];
        if ($upload_image){

            $config['upload_path']          = './assets/uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2048 ;
            $this->load->library('upload', $config);
        }
            if ( $this->upload->do_upload('image')) {
                $this -> M_product -> add_product();
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Produk Berhasil di tambahkan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>'
                );

                redirect('admin/product');
            } else {
                $this->session->set_flashdata(
                    'pesan', $this -> upload -> display_errors());
                    $this-> load -> view ('admin/header',$data);
                    $this-> load -> view ('admin/sidebar',$data);
                    $this-> load -> view ('admin/add_product');
                    $this-> load -> view ('admin/footer');
            }
        }   
    }

    public function ubah_product($id) {
        $data['user'] = $this -> db ->get_where ('user', ['email' => $this -> session -> userdata('email')])-> row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Ubah Produk';
        
        $this -> form_validation -> set_rules('name','name','trim|required');
        $this -> form_validation -> set_rules('price','price','required');
        $this -> form_validation -> set_rules('total','total','required');
        $this -> form_validation -> set_rules('category','category','trim|required');
        $this -> form_validation -> set_rules('deskripsi','deskripsi','trim|required');
        

        if ($this -> form_validation -> run() == false) 
        {
            $data['product'] = $this -> M_product -> getproductbyid($id);
            $this-> load -> view ('admin/header',$data);
            $this-> load -> view ('admin/sidebar',$data);
            $this-> load -> view ('admin/ubah_product',$data);
            $this-> load -> view ('admin/footer');
        }
        else
        {
            $this -> M_product -> ubah_product();
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Produk telah di ubah
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>'
            );    
            redirect ('admin/product');
        }
}

    public function delete_product($id){
        $this -> M_product -> delete_product($id);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-info alert-dismissible fade show" role="alert">
            Produk telah di hapus
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>'
        );    
        redirect ('admin/product');
    }
    public function detail_product($id){
        $data['user'] = $this -> db ->get_where ('user', ['email' => $this -> session -> userdata('email')])-> row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Detail Produk';
        $data['product'] = $this -> M_product -> getproductbyid($id);
        $this-> load -> view ('admin/header',$data);
        $this-> load -> view ('admin/sidebar',$data);
        $this-> load -> view ('admin/detail_product',$data);
        $this-> load -> view ('admin/footer');
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role');
        redirect('Landing/index');
    }
    public function user () {
        
        $data['user'] = $this -> db ->get_where ('user', ['email' => $this -> session -> userdata('email')])-> row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Kelola Pengguna';
        $data['user'] = $this -> M_user -> get_user();
        $this-> load -> view ('admin/header',$data);
        $this-> load -> view ('admin/sidebar',$data);
        $this-> load -> view ('admin/user',$data);
        $this-> load -> view ('admin/footer');
    }
    public function active_user($id){
        $this -> M_user -> active_user($id);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Akun Telah Di Aktifkan
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>'
        );    
        redirect ('admin/user');
    }
    public function deactive_user($id){
        $this -> M_user -> deactive_user($id);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Akun Telah Di Non-Aktifkan
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>'
        );    
        redirect ('admin/user');
    }
    public function pegawai () {
        
        $data['user'] = $this -> db ->get_where ('user', ['email' => $this -> session -> userdata('email')])-> row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Kelola Pegawai';
        $data['pegawai'] = $this -> M_user -> get_pegawai();
        $this-> load -> view ('admin/header',$data);
        $this-> load -> view ('admin/sidebar',$data);
        $this-> load -> view ('admin/pegawai',$data);
        $this-> load -> view ('admin/footer');
    }
    public function active_pegawai($id){
        $this -> M_user -> active_pegawai($id);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Akun Telah Di Aktifkan
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>'
        );    
        redirect ('admin/pegawai');
    }
    public function deactive_pegawai($id){
        $this -> M_user -> deactive_pegawai($id);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Akun Telah Di Non-Aktifkan
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>'
        );    
        redirect ('admin/pegawai');
    }
}