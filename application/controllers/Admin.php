<?php

class Admin extends CI_Controller
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
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'beranda';
        $data['pesanan'] = $this->M_transaksi->count_pesanan();
        $data['notif'] = $this->M_transaksi->count_notif();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/index');
        $this->load->view('admin/footer');
    }


    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role');
        redirect('Landing/login');
    }
    public function user()
    {
        $data['pesanan'] = $this->M_transaksi->count_pesanan();
        $data['notif'] = $this->M_transaksi->count_notif();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Kelola Pengguna';
        $data['users'] = $this->M_user->get_user();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('admin/footer');
    }
    public function active_user($id)
    {
        $this->M_user->active_user($id);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Akun Telah Di Aktifkan
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>'
        );
        redirect('admin/user');
    }
    public function deactive_user($id)
    {
        $this->M_user->deactive_user($id);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Akun Telah Di Non-Aktifkan
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>'
        );
        redirect('admin/user');
    }
    public function pegawai()
    {
        $data['pesanan'] = $this->M_transaksi->count_pesanan();
        $data['notif'] = $this->M_transaksi->count_notif();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Kelola Pegawai';
        $data['pegawai'] = $this->M_user->get_pegawai();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/pegawai', $data);
        $this->load->view('admin/footer');
    }
    public function active_pegawai($id)
    {
        $this->M_user->active_pegawai($id);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Akun Telah Di Aktifkan
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>'
        );
        redirect('admin/pegawai');
    }
    public function deactive_pegawai($id)
    {
        $this->M_user->deactive_pegawai($id);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Akun Telah Di Non-Aktifkan
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>'
        );
        redirect('admin/pegawai');
    }
    public function add_pegawai()
    {
        $this->form_validation->set_rules('nama', 'nama', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[user.email]', ['is_unique' => 'email sudah ada']);
        $this->form_validation->set_rules('notelpon', 'notelpon', 'required|min_length[10]|max_length[13]|is_unique[user.notelpon]', [
            'is_unique' => 'nomor telpon sudah ada',
            'min_length' => 'nomor terlalu pendek',
            'max_length' => 'nomor terlalu panjang'
        ]);
        $this->form_validation->set_rules('password1', 'password1', 'required|trim|min_length[8]|max_length[32]|matches[password2]', [
            'matches' => 'Password tidak sama',
            'min_length' => 'Password terlalu pendek',
            'max_length' => 'Password terlalu panjang',
            'required' => 'Password tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('password2', 'password2', 'required|trim|matches[password1]', [
            'required' => 'Password tidak boleh kosong',
            'matches' => 'Password tidak sama',
        ]);
        if ($this->form_validation->run() == false) {
            $data['pesanan'] = $this->M_transaksi->count_pesanan();
            $data['notif'] = $this->M_transaksi->count_notif();
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['name'] = $data['user']['nama'];
            $data['title'] = 'Tambah Data Pegawai';
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/add_pegawai');
            $this->load->view('admin/footer');
        } else {
            $this->M_user->add_pegawai();
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data Pegawai Berhasil Ditambahkan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>'
            );
            redirect('admin/pegawai');
        }
    }
    public function detail_pegawai($id)
    {
        $data['pesanan'] = $this->M_transaksi->count_pesanan();
        $data['notif'] = $this->M_transaksi->count_notif();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Detail Pegawai';
        $data['worker'] = $this->M_user->get_user_by_id($id);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/detail_pegawai', $data);
        $this->load->view('admin/footer');
    }
    public function detail_user($id)
    {
        $data['pesanan'] = $this->M_transaksi->count_pesanan();
        $data['notif'] = $this->M_transaksi->count_notif();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Detail User';
        $data['worker'] = $this->M_user->get_user_by_id($id);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/detail_user', $data);
        $this->load->view('admin/footer');
    }
    public function laporan_barang()
    {
        $data['product'] = $this->M_product->getproduct_active();
        $data['produk'] = $this->M_product->getproduct_out_stock();
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "laporan-Barang.pdf";
        $this->pdf->load_view('admin/laporan', $data);
    }
    public function laporan_penjualan()
    {
        $data['transaksi'] = $this->M_transaksi->get_riwayat_transaksi();
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "laporan-Penjualan.pdf";
        $this->pdf->load_view('admin/laporan_penjualan', $data);
    }
    public function laporan_pegawai()
    {
        $data['user'] = $this->M_user->get_pegawai();
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "laporan-Pegawai.pdf";
        $this->pdf->load_view('admin/laporan_pegawai', $data);
    }
    public function edit_profile()
    {
        $data['pesanan'] = $this->M_transaksi->count_pesanan();
        $data['notif'] = $this->M_transaksi->count_notif();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['name'] = $data['user']['nama'];
        $data['title'] = 'Edit Profile';

        $this->form_validation->set_rules('nama', 'nama', 'required|trim');
        $this->form_validation->set_rules('notelpon', 'notelpon', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/edit_profile', $data);
            $this->load->view('admin/footer');
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
                    if ($upload_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/user/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('user_image', $new_image);
                    $this->M_user->edit_profile();
                    redirect('admin/edit_profile');
                } else {
                    $this->session->set_flashdata(
                        'pesan',
                        $this->upload->display_errors()
                    );
                    $this->load->view('admin/header', $data);
                    $this->load->view('admin/sidebar', $data);
                    $this->load->view('admin/edit_profile', $data);
                    $this->load->view('admin/footer');
                }
            } else {
                $this->M_user->edit_profile();
                redirect('admin/edit_profile');
            }
        }
    }
}

// profil dan setting belum
