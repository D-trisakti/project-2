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
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 4048 ;
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

    public function ubah_product($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Ubah Produk';

        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('price', 'price', 'required');
        $this->form_validation->set_rules('total', 'total', 'required');
        $this->form_validation->set_rules('category', 'category', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');


        if ($this->form_validation->run() == false) {
            $data['product'] = $this->M_product->getproductbyid($id);
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/ubah_product', $data);
            $this->load->view('admin/footer');
        } else {
            
            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];
            // var_dump($upload_image);
            // die;
            if ($upload_image != "") {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/uploads/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $old_image = $this->input->post('oldimg');
                    unlink(FCPATH . 'assets/uploads/' . $old_image);
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                    $this->M_product->ubah_product();
                    redirect('admin/product');
                } else {
                    $this->session->set_flashdata(
                        'pesan',
                        $this->upload->display_errors()
                    );
                    $data['product'] = $this->M_product->getproductbyid($id);
                    $this->load->view('admin/header', $data);
                    $this->load->view('admin/sidebar', $data);
                    $this->load->view('admin/ubah_product', $data);
                    $this->load->view('admin/footer');
                }
            }else{
                $this->M_product->ubah_product();
                redirect('admin/product');
            }
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
    public function add_pegawai () {
        $this -> form_validation -> set_rules ('nama','nama','required|trim');
        $this -> form_validation -> set_rules ('email','email','required|trim|valid_email|is_unique[user.email]',['is_unique' => 'email sudah ada']);
        $this -> form_validation -> set_rules ('notelpon','notelpon','required|min_length[10]|max_length[13]|is_unique[user.notelpon]',[
            'is_unique' => 'nomor telpon sudah ada',
            'min_length' => 'nomor terlalu pendek',
            'max_length' => 'nomor terlalu panjang'
            ]);
        $this -> form_validation -> set_rules ('password1','password1','required|trim|min_length[8]|max_length[32]|matches[password2]',[
            'matches' => 'Password tidak sama',
            'min_length' => 'Password terlalu pendek',
            'max_length' => 'Password terlalu panjang',
            'required' =>'Password tidak boleh kosong'
        ]);
        $this -> form_validation -> set_rules ('password2','password2','required|trim|matches[password1]',[
            'required' =>'Password tidak boleh kosong',
            'matches' => 'Password tidak sama',
        ]);
            if ($this -> form_validation -> run() == false){
                $data['user'] = $this -> db ->get_where ('user', ['email' => $this -> session -> userdata('email')])-> row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Tambah Data Pegawai';
        $this-> load -> view ('admin/header',$data);
        $this-> load -> view ('admin/sidebar',$data);
        $this-> load -> view ('admin/add_pegawai');
        $this-> load -> view ('admin/footer');
            }
            else {
                $this -> M_user -> add_pegawai();
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data Pegawai Berhasil Ditambahkan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>'
                );    
                redirect ('admin/pegawai');
            }
        
    }
    public function detail_pegawai($id){
        $data['user'] = $this -> db ->get_where ('user', ['email' => $this -> session -> userdata('email')])-> row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Detail Pegawai';
        $data['worker'] = $this -> M_user -> get_user_by_id($id);
        $this-> load -> view ('admin/header',$data);
        $this-> load -> view ('admin/sidebar',$data);
        $this-> load -> view ('admin/detail_user',$data);
        $this-> load -> view ('admin/footer');
    }
    public function detail_user($id){
        $data['user'] = $this -> db ->get_where ('user', ['email' => $this -> session -> userdata('email')])-> row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Detail User';
        $data['worker'] = $this -> M_user -> get_user_by_id($id);
        $this-> load -> view ('admin/header',$data);
        $this-> load -> view ('admin/sidebar',$data);
        $this-> load -> view ('admin/detail_user',$data);
        $this-> load -> view ('admin/footer');
    }
}