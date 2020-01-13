<?php
defined('BASEPATH') or exit('no direct script to access allowed');

class M_transaksi extends CI_Model
{
    public function add_transaksi_langsung()
    {
        $id_beli = $this->input->post('id_user') . $this->input->post('id_product') . date("YmdHis");
        $data = [
            'id_user' =>   $this->input->post('id_user'),
            'id_product' =>    $this->input->post('id_product'),
            'id_transaksi' => $id_beli,
            'id_invoice' => $id_beli,
            'tanggal' => date("Y-m-d H:i:s"),
            'jumlah' =>    $this->input->post('jumlah'),
            'jumlah_bayar' =>    $this->input->post('total'),
            'bukti_transaksi' => 'pembelian langsung',
        ];
        $this->db->insert('transaksi', $data);
    }
    public function add_order(){
        $id_beli = $this->input->post('id_user') . $this->input->post('id_product') . date("YmdHis");
        $data = [
            'id_user' =>   $this->input->post('id_user'),
            'id_product' =>    $this->input->post('id_product'),
            'deskripsi_pesanan' =>    $this->input->post('deskripsi'),
            'id_pesanan' => $id_beli,
            'tanggal' => date("Y-m-d H:i:s"),
            'jumlah_beli' =>    $this->input->post('jumlah'),
            'total_bayar' =>    $this->input->post('total'),
        ];
        $this->db->insert('pesanan', $data);
        
    }
    public function shopping_cart ($id){           
            $status = "waiting"    ;
        $this->db->select('*');    
            $this->db->from('pesanan');
            $this->db->where('id_user',$id, 'status_pesanan',$status);
            $this->db->where('status_pesanan',$status);
            $this->db->join('user', 'pesanan.id_user = user.id');
            $this->db->join('product', 'pesanan.id_product = product.id_product');
            $query = $this->db->get();
            return $query ->result_array();
    }
    public function total_item_shopping_cart($id){
        $status = "waiting"    ;
        $this->db->select_sum('jumlah_beli');    
            $this->db->from('pesanan');
            $this->db->where('id_user',$id );
            $this->db->where('status_pesanan',$status);
            $query = $this->db->get();
            return $query ->row_array();
    }
    public function total_bayar_shopping_cart($id){
        $status = "waiting"    ;
        $this->db->select_sum('total_bayar');    
            $this->db->from('pesanan');
            $this->db->where('id_user',$id );
            $this->db->where('status_pesanan',$status);
            $query = $this->db->get();
            return $query ->row_array();
    }
    public function get_payment(){   
            $this->db->select('*');    
            $this->db->from('pesanan');
            $this->db->join('user', 'pesanan.id_user = user.id');
            $this->db->join('product', 'pesanan.id_product = product.id_product');
            $query = $this->db->get();
            return $query ->result_array();
    }
    public function get_riwayat_transaksi(){
        $this->db->select('*');    
            $this->db->from('transaksi');
            $this->db->join('user', 'transaksi.id_user = user.id');
            $query = $this->db->get();
            return $query ->result_array();
    }
    public function count_pesanan(){
        $total_order = $this->db->query('SELECT COUNT(*) AS total_order FROM pesanan ORDER BY tanggal DESC')->row_array();
        $notif_order = $this->db->query('SELECT * FROM pesanan AS notif_order  LIMIT 3')->result_array();
        return array_merge($total_order, $notif_order) ;
    }
    public function count_notif(){
       return $this->db->query('SELECT * FROM pesanan AS notif_order  LIMIT 3')->result_array();
    }
    public function delete_order($id_pesanan){
          $this->db->where('id_pesanan', $id_pesanan);
          $this->db->delete('pesanan');
        
    }
    public function invoice_waiting ($id){           
        $status = "invoiced"    ;
        $status_invoice = "belum bayar";
    $this->db->select('*');    
        $this->db->from('invoice');
        $this->db->where('invoice.id_user',$id);
        $this->db->where('status_invoice',$status_invoice);
        $this->db->where('status_pesanan',$status);
        $this->db->join('user', 'invoice.id_user = user.id');
        $this->db->join('pesanan', 'invoice.id_invoice = pesanan.id_invoice');
        $this->db->join('product', 'pesanan.id_product = product.id_product');
        $query = $this->db->get();
        return $query ->result_array();
}

public function invoice_process ($id){           
    $status = "invoiced"    ;
    $status_invoice = "proses";
$this->db->select('*');    
    $this->db->from('invoice');
    $this->db->where('invoice.id_user',$id);
    $this->db->where('status_invoice',$status_invoice);
    $this->db->where('status_pesanan',$status);
    $this->db->join('user', 'invoice.id_user = user.id');
    $this->db->join('pesanan', 'invoice.id_invoice = pesanan.id_invoice');
    $this->db->join('product', 'pesanan.id_product = product.id_product');
    $query = $this->db->get();
    return $query ->result_array();
}
public function invoice_selesai ($id){           
    $status = "invoiced"    ;
    $status_invoice = "selesai";
$this->db->select('*');    
    $this->db->from('invoice');
    $this->db->where('invoice.id_user',$id);
    $this->db->where('status_invoice',$status_invoice);
    $this->db->where('status_pesanan',$status);
    $this->db->join('user', 'invoice.id_user = user.id');
    $this->db->join('pesanan', 'invoice.id_invoice = pesanan.id_invoice');
    $this->db->join('product', 'pesanan.id_product = product.id_product');
    $query = $this->db->get();
    return $query ->result_array();
}
public function invoice_ditolak ($id){           
    $status = "invoiced"    ;
    $status_invoice = "ditolak";
$this->db->select('*');    
    $this->db->from('invoice');
    $this->db->where('invoice.id_user',$id);
    $this->db->where('status_invoice',$status_invoice);
    $this->db->where('status_pesanan',$status);
    $this->db->join('user', 'invoice.id_user = user.id');
    $this->db->join('pesanan', 'invoice.id_invoice = pesanan.id_invoice');
    $this->db->join('product', 'pesanan.id_product = product.id_product');
    $query = $this->db->get();
    return $query ->result_array();
}
public function detail_invoice ($id,$id_invoice){           
    $status = "invoiced"    ;
    $this->db->select('*');    
    $this->db->from('invoice');
    $this->db->where('invoice.id_user',$id);
    $this->db->where('invoice.id_invoice',$id_invoice);
    $this->db->where('status_pesanan',$status);
    $this->db->join('user', 'invoice.id_user = user.id');
    $this->db->join('pesanan', 'invoice.id_invoice = pesanan.id_invoice');
    $this->db->join('product', 'pesanan.id_product = product.id_product');
    $query = $this->db->get();
    return $query ->result_array();
}
public function detail_invoice_on_process ($id,$id_invoice){           
    $status = "invoiced" ;
    $status_invoice = "proses";
    $this->db->select('*');    
    $this->db->from('invoice');
    $this->db->where('invoice.id_user',$id);
    $this->db->where('invoice.status_invoice',$status_invoice);
    $this->db->where('invoice.id_invoice',$id_invoice);
    $this->db->where('status_pesanan',$status);
    $this->db->join('user', 'invoice.id_user = user.id');
    $this->db->join('pesanan', 'invoice.id_invoice = pesanan.id_invoice');
    $this->db->join('product', 'pesanan.id_product = product.id_product');
    $query = $this->db->get();
    return $query ->result_array();
}
public function pay ($id,$id_invoice){           
    $status = "invoiced"    ;
    $this->db->select('*');    
    $this->db->from('invoice');
    $this->db->where('invoice.id_user',$id);
    $this->db->where('invoice.id_invoice',$id_invoice);
    $this->db->where('status_pesanan',$status);
    $this->db->join('user', 'invoice.id_user = user.id');
    $this->db->join('pesanan', 'invoice.id_invoice = pesanan.id_invoice');
    $this->db->join('product', 'pesanan.id_product = product.id_product');
    $query = $this->db->get();
    return $query ->row();
}
public function add_user_validation_transaksi($id_invoice){
    $status_invoice = "proses";
    $image =$this->upload->data('file_name');
    $this->db->set('bukti_transaksi', $image);
    $this->db->set('status_invoice', $status_invoice);
    $this->db->where('id_invoice', $id_invoice);
    $this->db->update('invoice');
}
public function add_user_transaksi($id,$id_invoice){
    $id_beli = $id . date("YmdHis");
        $data = [
            'id_user' =>   $id,
            'id_invoice' =>$id_invoice,
            'id_transaksi' => $id_beli,
            'tanggal' => date("Y-m-d H:i:s"),
            'jumlah' =>    $this->input->post('jumlah_bayar'),
            'jumlah_bayar' =>    $this->input->post('total_bayar'),
            'bukti_transaksi' => $this->upload->data('file_name')
        ];
        $this->db->insert('transaksi', $data);
}
public function delete_invoice($id_invoice){
    $this->db->where('id_invoice', $id_invoice);
    $this->db->delete('invoice');
    $this->db->where('id_invoice', $id_invoice);
    $this->db->delete('pesanan');
}
}
