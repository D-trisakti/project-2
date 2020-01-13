<?php

class Product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect(site_url('Landing'));
        }
        if ($this->session->userdata('role_id') == 3) {
            redirect('user');
        }
        $this->load->model('M_product');
        $this->load->model('M_transaksi');
    }
    public function index()
    {
        $data['pesanan']= $this -> M_transaksi -> count_pesanan();
        $data['notif']= $this -> M_transaksi -> count_notif();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Produk Tersedia';
        $data['product'] = $this->M_product->getproduct_active();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/product', $data);
        $this->load->view('admin/footer');
    }
    public function out_stock_product()
    {
        $data['pesanan']= $this -> M_transaksi -> count_pesanan();
        $data['notif']= $this -> M_transaksi -> count_notif();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Produk Tak Tersedia';
        $data['product'] = $this->M_product->getproduct_out_stock();
        $this->form_validation->set_rules('total', 'total', 'required');
        if ($this -> form_validation -> run()==false){
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/out_stock_product', $data);
        $this->load->view('admin/footer');
        }else{
            $this->m_product->restock();
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Produk Berhasil di Restok
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>'
            );
            redirect('product');
        }
        
    }
    public function add_product()
    {
        $data['pesanan']= $this -> M_transaksi -> count_pesanan();
        $data['notif']= $this -> M_transaksi -> count_notif();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Tambah Produk';
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('price', 'price', 'required');
        $this->form_validation->set_rules('total', 'total', 'required');
        $this->form_validation->set_rules('category', 'category', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');


        if ($this->form_validation->run() == false) {
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/add_product');
            $this->load->view('admin/footer');
        } else {
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {

                $config['upload_path']          = './assets/uploads/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 4048;
                $this->load->library('upload', $config);
            }
            if ($this->upload->do_upload('image')) {
                $this->M_product->add_product();
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Produk Berhasil di tambahkan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>'
                );

                redirect('product');
            } else {
                $this->session->set_flashdata(
                    'pesan',
                    $this->upload->display_errors()
                );
                $this->load->view('admin/header', $data);
                $this->load->view('admin/sidebar', $data);
                $this->load->view('admin/add_product');
                $this->load->view('admin/footer');
            }
        }
    }

    public function ubah_product($id_product)
    {
        $data['pesanan']= $this -> M_transaksi -> count_pesanan();
        $data['notif']= $this -> M_transaksi -> count_notif();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Ubah Produk';

        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('price', 'price', 'required');
        $this->form_validation->set_rules('total', 'total', 'required');
        $this->form_validation->set_rules('category', 'category', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');


        if ($this->form_validation->run() == false) {
            $data['product'] = $this->M_product->getproductbyid($id_product);
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/ubah_product', $data);
            $this->load->view('admin/footer');
        } else {

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image != "") {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/uploads/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $old_image = $this->input->post('oldimg');
                    unlink(FCPATH . 'assets/uploads/' . $old_image);
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image_product', $new_image);
                    $this->M_product->ubah_product();
                    redirect('product');
                } else {
                    $this->session->set_flashdata(
                        'pesan',
                        $this->upload->display_errors()
                    );
                    $data['product'] = $this->M_product->getproductbyid($id_product);
                    $this->load->view('admin/header', $data);
                    $this->load->view('admin/sidebar', $data);
                    $this->load->view('admin/ubah_product', $data);
                    $this->load->view('admin/footer');
                }
            } else {
                $this->M_product->ubah_product();
                redirect('product');
            }
        }
    }

    public function delete_product($id_product)
    {
        $this->M_product->delete_product($id_product);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-info alert-dismissible fade show" role="alert">
            Produk telah di hapus
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>'
        );
        redirect('product');
    }
    public function detail_product($id_product)
    {
        $data['pesanan']= $this -> M_transaksi -> count_pesanan();
        $data['notif']= $this -> M_transaksi -> count_notif();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Detail Produk';
        $data['product'] = $this->M_product->getproductbyid($id_product);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/detail_product', $data);
        $this->load->view('admin/footer');
    }
    public function out_stock($id_product){
        $this->M_product->out_stock($id_product);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-info alert-dismissible fade show" role="alert">
            Data Produk Di pindahkan Ke Data Produk Tak Tersedia
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>'
        );
        redirect('product/out_stock_product');
    }
    function restock(){
       $id_product = $this->input->post('id');
        $data = $this -> M_product ->getproductbyid($id_product);
        echo json_encode($data);

    }
    function restock_product(){
        $this -> form_validation -> set_rules ('total','total','required|trim');

        if($this -> form_validation->run() == false){
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-info alert-dismissible fade show" role="alert">
            Produk Gagal Distock ulang
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>'
        );
        redirect('product/out_stock_product');
        }
        else {
            $this -> M_product -> restock();
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-info alert-dismissible fade show" role="alert">
                Produk Berhasil Distock ulang
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>'
            );
                redirect('product');
        }
    }
    }