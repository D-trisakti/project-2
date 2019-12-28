<?php
defined ('BASEPATH') OR exit ('no scipt direct access allowed');

class M_user extends CI_Model {

    public function registration(){
        $data = [
            'nama' => htmlspecialchars($this -> input ->post ('name',true)),
            'email' => htmlspecialchars($this -> input -> post ('email',true)),
            'notelpon' => htmlspecialchars ($this -> input -> post ('notelpon',true)),
            'password' => password_hash($this -> input -> post ('password1'), PASSWORD_DEFAULT),
            'role_id' => 3
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
}