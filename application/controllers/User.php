<?php

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email') || $this->session->userdata('role_id') == 2) {
            redirect(site_url('Landing'));
        }
    }
    public function index(){
        $data['user'] = $this -> db ->get_where ('user', ['email' => $this -> session -> userdata('email')])-> row_array();
        $this->load->view('user/header');
        $this->load->view('user/index',$data);
        $this->load->view('user/footer');
    }
    public function change(){
        $data['user'] = $this -> db ->get_where ('user', ['email' => $this -> session -> userdata('email')])-> row_array();
        $this->load->view('user/header');
        $this->load->view('user/change',$data);
        $this->load->view('user/footer');
    }
    public function reset_password(){
        $data['user'] = $this -> db ->get_where ('user', ['email' => $this -> session -> userdata('email')])-> row_array();
        $this->load->view('user/header');
        $this->load->view('user/reset_password',$data);
        $this->load->view('user/footer');
    }
    public function shopping_cart(){
        $this -> load -> model ('M_product');
        $data['product'] = $this -> M_product -> getproduct();
        $data['user'] = $this -> db ->get_where ('user', ['email' => $this -> session -> userdata('email')])-> row_array();
        $this->load->view('user/header');
        $this->load->view('user/shopping_cart',$data);
        $this->load->view('user/footer');
    }
    public function invoice(){
        $this -> load -> model ('M_product');
        $data['product'] = $this -> M_product -> getproduct();
        $data['user'] = $this -> db ->get_where ('user', ['email' => $this -> session -> userdata('email')])-> row_array();
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Invoice.pdf";
        $this->pdf->load_view('user/invoice', $data);
    }
}