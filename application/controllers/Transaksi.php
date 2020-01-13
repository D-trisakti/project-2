<?php

class Transaksi extends CI_Controller
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
        $this->load->model('M_user');
        $this->load->model('M_transaksi');
    }
    public function index() {
        $data['pesanan']= $this -> M_transaksi -> count_pesanan();
        $data['notif']= $this -> M_transaksi -> count_notif();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Pemesanan Produk';
        $data['product'] = $this-> M_transaksi ->get_payment();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/pemesanan', $data);
        $this->load->view('admin/footer');
    }
    public function pemesanan_langsung(){
        $data['pesanan']= $this -> M_transaksi -> count_pesanan();
        $data['notif']= $this -> M_transaksi -> count_notif();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $data['id'] = $data['user']['id'];
        $data['title'] = 'Pemesanan Langsung Ditempat';
        $data['product'] = $this->M_product->getproduct_active();

            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/pemesanan_langsung', $data);
            $this->load->view('admin/footer');

            
    
    }
    public function storepost()
    { 
        $status_transaksi = "pembelian langsung";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id = $data['user']['id'];
        $id_beli = $id . date("YmdHis");            
        $jumlah = $this->input->post('jumlah');
        $total = $this->input->post('total');
        $i =0;  
        if(!empty($_POST)){                    
        foreach (array_combine($jumlah, $total) as $jml => $ttl) {
                              
            $datas = array (
                                    'id_user' =>   $id,
                                    'id_transaksi' => $id_beli.$i,
                                    'id_invoice' => $id_beli,
                                    'tanggal' => date("Y-m-d H:i:s"),
                                    'jumlah' =>    $jml,
                                    'jumlah_bayar' =>  $ttl,
                                    'bukti_transaksi' => $status_transaksi
                                );
                                
                                $this->db->insert('transaksi', $datas);
                                $i++;                
                           }
                        }
                        else {echo 'data tidak masuk' ;                         }                     
    }
    
    function get_price(){
        $this -> load -> model ('M_product');
        $id_product = $this->input->post('id');
        $data = $this -> M_product ->getproductbyid($id_product);
        echo json_encode($data);

    }
    public function riwayat_transaksi(){
        $data['pesanan']= $this -> M_transaksi -> count_pesanan();
        $data['notif']= $this -> M_transaksi -> count_notif();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Pemesanan Produk';
        $data['riwayat'] = $this-> M_transaksi ->get_riwayat_transaksi();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/riwayat_transaksi', $data);
        $this->load->view('admin/footer');
    }
    public function save()
    {

            $this->form_validation->set_rules('kecamatantps','Kecamatan','required');
            $this->form_validation->set_rules('kelurahantps','kelurahan','required');
            $this->form_validation->set_rules('deskripsitps','Deskripsi','required');
            $this->form_validation->set_rules('namatps[]','Nama TPS','required');
            if ($this->form_validation->run()==FALSE) 
            {
                $this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal!</div></div>");
                $this->load->view('admin/test');
            }
            else
            {    
                $nm = $this->input->post('namatps');
                $result = array();
                foreach($nm AS $key => $val){
                    $result[] = array(
                    "namatps" => $_POST['namatps'][$key],
                    "kecamatantps" => $_POST['kecamatantps'],
                    "kelurahantps" => $_POST['kelurahantps'],
                    "deskripsitps" => $_POST['deskripsitps']
                    );
                    } 
                $insert=$this->Tps_m->insert($result);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses</h4>
               Data berhasil Disimpan
            </div>');
                echo json_encode(array("status"=>TRUE));
            }
        }
    }   
