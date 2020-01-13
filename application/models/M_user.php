<?php
defined ('BASEPATH') OR exit ('no scipt direct access allowed');

class M_user extends CI_Model {

    public function registration(){
        $data = [
            'nama' => htmlspecialchars($this -> input ->post ('name',true)),
            'notelpon' => htmlspecialchars ($this -> input -> post ('notelpon',true)),
            'alamat' => htmlspecialchars ($this -> input -> post ('alamat',true)),
            'email' => htmlspecialchars($this -> input -> post ('email',true)),
            'password' => password_hash($this -> input -> post ('password1'), PASSWORD_DEFAULT),
            'role_id' => 3,
        ];
        $this -> db -> insert ('user',$data);
    }
    public function get_user() {
        $id = 3;
        return $this->db->get_where('user', ['role_id' => $id])->result_array();
    }
    public function active_user($id){
        $var = 'aktif';
        $this -> db -> set ('is_active',$var);
        $this->db->where('id', $id);
        $this->db->update('user');
    }
    public function deactive_user($id){
        $var = 'tidak aktif';
        $this -> db -> set ('is_active',$var);
        $this->db->where('id', $id);
        $this->db->update('user');
    }
    public function get_pegawai() {
        $id = 2;
        return $this->db->get_where('user', ['role_id' => $id])->result_array();
    }
    public function active_pegawai($id){
        $var = 'aktif';
        $this -> db -> set ('is_active',$var);
        $this->db->where('id', $id);
        $this->db->update('user');
    }
    public function deactive_pegawai($id){
        $var = 'tidak aktif';
        $this -> db -> set ('is_active',$var);
        $this->db->where('id', $id);
        $this->db->update('user');
    }
    public function add_pegawai(){
        $data = [
            'nama' => htmlspecialchars($this -> input ->post ('nama',true)),
            'email' => htmlspecialchars($this -> input -> post ('email',true)),
            'notelpon' => htmlspecialchars ($this -> input -> post ('notelpon',true)),
            'password' => password_hash($this -> input -> post ('password1'), PASSWORD_DEFAULT),
            'role_id' => 2,
            
        ];
        $this -> db -> insert ('user',$data);
    }
    public function get_user_by_id($id){
        return $this->db->get_where('user', ['id' => $id])->row_array();
    }
    public function edit_profile()
  {
    $email = $this->input->post('email');
    $nama = $this->input->post('nama');
    $notelpon = $this->input->post('notelpon');
    $this->db->set('nama', $nama);
    $this->db->set('email', $email);
    $this->db->set('notelpon', $notelpon);
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('user');
    $this->session->set_flashdata(
      'pesan',
      '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Profile telah di ubah
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>'
    );
  }
  public function change_image()
  {
    $old_image = $this->input->post('oldimg');
    unlink(FCPATH . 'assets/user/' . $old_image);
    $new_image = $this->upload->data('file_name');
    $this->db->set('image_product', $new_image);
  }
  public function change_profile(){
    $email = $this->input->post('email');
    $nama = $this->input->post('nama');
    $notelpon = $this->input->post('notelpon');
    $alamat = $this->input->post('alamat');
    $this->db->set('nama', $nama);
    $this->db->set('email', $email);
    $this->db->set('alamat', $alamat);
    $this->db->set('notelpon', $notelpon);
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('user');
    $this->session->set_flashdata(
      'pesan',
      '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Profile telah di ubah
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>'
    );
  }
  public function item_invoice($id){
      $this ->load ->model('m_transaksi');
      $id_invoice = $id. date("YmdHis");
      $id_pesanan =  $this->db->query("SELECT id_pesanan FROM pesanan WHERE id_user =$id")->result_array();
      $id_user = $id;
      $tanggal_invoice = date("YmdHis");
      $bukti_transfer ="belum bayar";
      $status = 'waiting';
    $data = [
        'id_invoice' =>  $id_invoice,
        'id_user'     => $id_user,
        'tanggal_invoice' =>$tanggal_invoice,
        'bukti_transaksi' => $bukti_transfer
  ];
  $this -> db -> insert('invoice',$data);
        $this -> db -> set('id_invoice',$id_invoice);
        $this -> db -> set('status_pesanan','invoiced');
        $this->db->where('id_user', $id);
        $this->db->where('status_pesanan', $status);
        $this ->db ->update('pesanan');
    //   var_dump($data);
  }
}