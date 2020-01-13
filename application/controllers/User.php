<?php

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email') || $this->session->userdata('role_id') == 2) {
            redirect(site_url('Landing'));
        }
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $this->load->view('user/header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('user/footer');
    }
    public function change()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $this->load->model('M_user');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('notelpon', 'notelpon', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('user/header', $data);
            $this->load->view('user/change', $data);
            $this->load->view('user/footer');
        } else {
            // cek jika ada gambar yang akan diupload
            $old_image = $data['user']['user_image'];
            $upload_image = $_FILES['image']['name'];
                if ($upload_image != "") {
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size']      = '2048';
                    $config['upload_path'] = './assets/user/';
                    $this->load->library('upload', $config);
                        if ($this->upload->do_upload('image')) {
                            if ($old_image != 'default.jpg') {
                                unlink(FCPATH . 'assets/user/' . $old_image);
                            }
                            $new_image = $this->upload->data('file_name');
                            $this->db->set('user_image', $new_image);
                            $this->M_user->change_profile();
                            redirect('user');
                            } else {
                            $this->session->set_flashdata(
                            'pesan',
                            $this->upload->display_errors()
                            );
                            $this->load->view('user/header', $data);
                            $this->load->view('user/change', $data);
                            $this->load->view('user/footer');
                            }
            }
                $this->M_user->change_profile();
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Informasi Profile Telah Diubah
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>'
                );
                redirect('user');
            }
    }
    public function reset_password()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $this -> form_validation-> set_rules('oldpassword','oldpassword','trim|required');
        $this->form_validation->set_rules('password1', 'password1', 'required|trim|min_length[8]|max_length[32]|matches[password2]', [
            'matches' => 'password tidak sama',
            'min_length' => 'password terlalu pendek',
            'max_length' => 'password terlalu panjang'
        ]);
        $this->form_validation->set_rules('password2', 'password2', 'required|trim|matches[password1]');
                if ($this -> form_validation->run()== false){
                    $this->load->view('user/header', $data);
                    $this->load->view('user/reset_password', $data);
                    $this->load->view('user/footer');
                }else{
                $oldpassword = $this->input->post('oldpassword');
                $new_password = $this->input->post('password1');
                        if (!password_verify($oldpassword, $data['user']['password'])) {
                            $this->session->set_flashdata(  'pesan',
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Password Lama Salah
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');
                            redirect('user/reset_password');
                        } else {
                                    if ($oldpassword == $new_password) {
                                        $this->session->set_flashdata(  'pesan',
                                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Password Baru tidak boleh sama dengan password lama
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>');
                                        redirect('user/reset_password');
                                    } else {
                                        // password sudah ok
                                        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                                        $this->db->set('password', $password_hash);
                                        $this->db->where('email', $this->session->userdata('email'));
                                        $this->db->update('user');
                                        $this->session->set_flashdata(  'pesan',
                                        '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Password Telah Diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>');
                                        redirect('user');
                                    }
                                }  
                            }
                        }
                    
    public function shopping_cart()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $id = $data['user']['id'];
        $this->load->model('M_transaksi');
        $data['total_item'] = $this->M_transaksi->total_item_shopping_cart($id);
        $data['total_bayar'] = $this->M_transaksi->total_bayar_shopping_cart($id);
        $data['order'] = $this->M_transaksi->shopping_cart($id);
       if (empty($data['order'])){
        $this->load->view('user/header', $data);
        $this->load->view('user/shopping_cart_empty', $data);
        $this->load->view('user/footer');
       }else{
        $this->load->view('user/header', $data);
        $this->load->view('user/shopping_cart', $data);
        $this->load->view('user/footer');
       }
        
    }
    public function order_invoice($id)
    {
        $this->load->model('M_transaksi');
        $data['order'] = $this->M_transaksi->shopping_cart($id);
        $data['total_item'] = $this->M_transaksi->total_item($id);
        $data['total_bayar'] = $this->M_transaksi->total_bayar($id);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "Invoice.pdf";
        $this->pdf->load_view('user/invoice', $data);
    }
    public function product()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $this->load->model('M_product');
        $data['product'] = $this->M_product->getproduct_active();
        $this->load->view('user/header', $data);
        $this->load->view('user/category', $data);
        $this->load->view('user/footer');
    }
    public function order_item($id_product)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $this->load->model('M_product');
        $data['product'] = $this->M_product->getproductbyid($id_product);
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('price', 'price', 'required');
        $this->form_validation->set_rules('jumlah', 'jumlah', 'required');
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('user/header', $data);
            $this->load->view('user/order_item', $data);
            $this->load->view('user/footer');
        } else {
            redirect('user/product');
        }
    }
    public function add_order()
    {
        $this->load->Model('M_transaksi');
        $this->M_transaksi->add_order();
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-info alert-dismissible fade show" role="alert">
            Pemesanan Produk telah ditambahkan
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>'
        );
        redirect('user/shopping_cart');
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role');
        redirect('Landing/login');
    }
    public function home()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $this->load->view('user/header', $data);
        $this->load->view('user/home', $data);
        $this->load->view('user/footer');
    }
    public function delete_item($id_pesanan)
    {
        $this->load->Model('M_transaksi');
        $this->M_transaksi->delete_order($id_pesanan);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-info alert-dismissible fade show" role="alert">
        Pemesanan Produk telah di hapus
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>'
        );
        redirect('user/shopping_cart');
    }
    public function invoice($id){
        $this -> load -> model('M_user');
        $this ->M_user -> item_invoice($id);
        redirect('user');
    }
    public function pesanan(){
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $id = $data['user']['id'];
        $this->load->model('M_transaksi');
        $data['total_item'] = $this->M_transaksi->total_item_shopping_cart($id);
        $data['total_bayar'] = $this->M_transaksi->total_bayar_shopping_cart($id);
        $data['waiting'] = $this->M_transaksi->invoice_waiting ($id);
        $data['proses'] = $this->M_transaksi->invoice_process ($id);
        $data['selesai'] = $this->M_transaksi->invoice_selesai  ($id);
        $data['ditolak'] = $this->M_transaksi->invoice_ditolak ($id);
        // var_dump($data['proses']);
        // die;
        $this->load->view('user/header', $data);
        $this->load->view('user/pemesanan', $data);
        $this->load->view('user/footer');
       }
}
public function detail_pesanan($id_invoice){
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $id = $data['user']['id'];
        $this->load->model('M_transaksi');
        $data['total_item'] = $this->M_transaksi->total_item_shopping_cart($id);
        $data['total_bayar'] = $this->M_transaksi->total_bayar_shopping_cart($id);
        $data['order'] = $this->M_transaksi->detail_invoice($id,$id_invoice);
        // var_dump($data['proses']);
        // die;
        $this->load->view('user/header', $data);
        $this->load->view('user/detail_pesanan', $data);
        $this->load->view('user/footer');
       }
}
public function pay ($id_invoice){
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $id = $data['user']['id'];
        $this->load->model('M_transaksi');
        $data['total_item'] = $this->M_transaksi->total_item_shopping_cart($id);
        $data['total_bayar'] = $this->M_transaksi->total_bayar_shopping_cart($id);
        $data['order'] = $this->M_transaksi->pay($id,$id_invoice);
        $this -> form_validation-> set_rules('id','id','required');
        if($this ->form_validation->run()== false){
            $this->load->view('user/header', $data);
            $this->load->view('user/pay', $data);
            $this->load->view('user/footer');
        }else{
            // var_dump($_FILES);
            // die;
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size']      = '2048';
                    $config['upload_path'] = './assets/tf/';
                    $this->load->library('upload', $config);
                        if ($this->upload->do_upload('image')) {
                            $this ->load -> model('M_transaksi');
                            $this -> M_transaksi-> add_user_validation_transaksi($id_invoice);
                            redirect('user/pesanan');
                            } else {
                            $this->session->set_flashdata(
                            'pesan',
                            $this->upload->display_errors()
                            );
                            $this->load->view('user/header', $data);
                            $this->load->view('user/pay', $data);
                            $this->load->view('user/footer');
                            }
                        }
                    }
    public function hapus_invoice($id_invoice){
        $this ->load -> model('M_transaksi');
        $this -> M_transaksi->delete_invoice($id_invoice);
        redirect('user/pesanan');
    }
}
