<?php
defined ('BASEPATH') OR exit ('no scipt direct access allowed');

class M_user extends CI_Model {

    public function registration(){
        $data = [
            'nama' => htmlspecialchars($this -> input ->post ('name',true)),
            'email' => htmlspecialchars($this -> input -> post ('email',true)),
            'notelpon' => htmlspecialchars ($this -> input -> post ('notelpon',true)),
            'password' => password_hash($this -> input -> post ('password1'), PASSWORD_DEFAULT),
            'role_id' => 2
        ];
        $this -> db -> insert ('user',$data);
    }
}