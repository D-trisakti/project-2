<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Landing extends CI_Controller
{
//halaman utama
    public function index()
    {
        $this->load->Model('M_product');
        $data['product'] = $this->M_product->getproduct_active();
        $this->load->view('template/header');
        $this->load->view('landing/home', $data);
        $this->load->view('template/footer');
    }
    //halaman login
    public function login()
    {
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header');
            $this->load->view('landing/login');
            $this->load->view('template/footer');
        } else {
            $this->verify_login();
        }
    }
    private function verify_login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $data = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($data) {
            if ($data['is_active']=='aktif'){
            if ($data['role_id'] == 2 || 1) {
                if (password_verify($password, $data['password'])) {
                    $this->session->set_userdata($data);
                    $data = [
                        'email' => $data['email'],
                        'nama' => $data['nama'],
                        'role' => $data['role_id'],
                    ];

                    redirect('admin/index');
                } else {
                    $this->session->set_flashdata(
                        'pesan',
                        '<div class="alert alert-danger">
                    <div class="container">
                    <div class="alert-icon">
                    <i class="material-icons">error_outline</i>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                    </button>
                    <b>Password Salah</b> 
                    </div>
                    </div>'
                    );
                    redirect('landing/login');
                }
            } else if ($data['role_id'] == 3) {
                if (password_verify($password, $data['password'])) {
                    $this->session->set_userdata($data);
                    $data = [
                        'email' => $data['email'],
                        'nama' => $data['nama'],
                        'role' => $data['role_id'],
                    ];

                    redirect('user/index');
                } else {
                    $this->session->set_flashdata(
                        'pesan',
                        '<div class="alert alert-danger">
                    <div class="container">
                    <div class="alert-icon">
                    <i class="material-icons">error_outline</i>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                    </button>
                    <b>Password Salah</b> 
                    </div>
                    </div>'
                    );
                    redirect('landing/login');
                }
            } else {
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-danger">
                <div class="container">
                <div class="alert-icon">
                <i class="material-icons">error_outline</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>
                <b>Akun Tidak Aktif</b>
                </div>
                </div>'
                );
                redirect('landing/login');
            }
        } else {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger">
            <div class="container">
            <div class="alert-icon">
            <i class="material-icons">error_outline</i>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="material-icons">clear</i></span>
            </button>
            <b>Akun Tidak Aktif</b>
            </div>
            </div>'
            );
            redirect('landing/login');
        }
        } else {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger">
        <div class="container">
        <div class="alert-icon">
        <i class="material-icons">error_outline</i>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true"><i class="material-icons">clear</i></span>
        </button>
        <b>Email Tidak Terdaftar</b>
        </div>
        </div>'
            );
            redirect('landing/login');
        }
    }
//halaman pendaftaran
    public function register()
    {
        $this->form_validation->set_rules('name', 'name', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[user.email]', ['is_unique' => 'email sudah ada']);
        $this->form_validation->set_rules('notelpon', 'notelpon', 'required|min_length[10]|max_length[13]|is_unique[user.notelpon]', [
            'is_unique' => 'nomor telpon sudah ada',
            'min_length' => 'nomor terlalu pendek',
            'max_length' => 'nomor terlalu panjang'
        ]);
        $this->form_validation->set_rules('alamat', 'alamat', 'required|trim');
        $this->form_validation->set_rules('password1', 'password1', 'required|trim|min_length[8]|max_length[32]|matches[password2]', [
            'matches' => 'password tidak sama',
            'min_length' => 'password terlalu pendek',
            'max_length' => 'password terlalu panjang'
        ]);
        $this->form_validation->set_rules('password2', 'password2', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {

            $this->load->view('template/header');
            $this->load->view('landing/register');
            $this->load->view('template/footer');
        } else {
            $this->load->model('M_user');
            $this->M_user->registration();
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success">
            <div class="container">
                <div class="alert-icon">
                    <i class="material-icons">check</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>
                <b>Selamat Anda Berhasil Melakukan Pendaftaran Silahkan menuggu akun diaktivasi</b> 
            </div>
        </div>'
            );
            redirect('landing/login');
        }
    }
    //halaman katalog
    public function category()
    {
        $this->load->Model('M_product');
        $data['product'] = $this->M_product->getproduct_active();
        $this->load->view('template/header');
        $this->load->view('landing/category', $data);
        $this->load->view('template/footer');
    }
    public function order(){
        $this -> session->set_flashdata(
            'pesan',
            '<div class="alert alert-info">
        <div class="container">
            <div class="alert-icon">
                <i class="material-icons">info</i>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="material-icons">clear</i></span>
            </button>
            <b>Anda Harus Login Untuk Melanjutkan Memesan Produk</b> 
        </div>
    </div>'
        );
        redirect('landing/login');
    }
}
