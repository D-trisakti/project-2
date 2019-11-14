<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Landing extends CI_Controller
{

    public function index()
    {
        $this->load->view('template/header');
        $this->load->view('landing/home');
        $this->load->view('template/footer');
    }
    public function login()
    {
        $this->load->view('template/header');
        $this->load->view('landing/login');
        $this->load->view('template/footer');
    }
    public function register()
    {
        $this->load->view('template/header');
        $this->load->view('landing/register');
        $this->load->view('template/footer');
    }
    public function category()
    {
        $this->load->view('template/header');
        $this->load->view('landing/category');
        $this->load->view('template/footer');
    }
}
