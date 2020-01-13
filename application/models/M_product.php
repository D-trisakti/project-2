<?php
defined('BASEPATH') or exit('no direct script to access allowed');

class M_product extends CI_Model
{

  public function add_product()
  {
    $data = [
      'nama_product'  => htmlspecialchars($this->input->post('name'), true),
      'price_product' => htmlspecialchars($this->input->post('price'), true),
      'stock_product' => htmlspecialchars($this->input->post('total'), true),
      'category_product' => htmlspecialchars($this->input->post('category'), true),
      'deskripsi_product' => htmlspecialchars($this->input->post('deskripsi'), true),
      'image_product' => $this->upload->data('file_name'),
    ];
    $this->db->insert('product', $data);
  }

  public function getproduct_active()
  {
    $var = 0;
    $this->db->select('*');
    $this->db->from('product');
    $this->db->where('stock_product!=',$var );
    return $this->db->get()->result_array();
  }
  public function getproduct_out_stock()
  {
    $var = 0;
    $this->db->select('*');
    $this->db->from('product');
    $this->db->where('stock_product',$var );
    return $this->db->get()->result_array();
  }
  public function delete_product($id_product)
  {
    $data = $this->db->get_where('product', ['id_product' => $id_product])->row_array();
    $old_image = $data['image_product'];
    unlink(FCPATH . 'assets/uploads/' . $old_image);
    $this->db->where('id_product', $id_product);
    $this->db->delete('product');
  }
  public function getproductbyid($id_product)
  {
    return $this->db->get_where('product', ['id_product' => $id_product])->row_array();
  }
  public function ubah_product()
  {
    $name = $this->input->post('name');
    $price = $this->input->post('price');
    $total = $this->input->post('total');
    $category = $this->input->post('category');
    $deskripsi = $this->input->post('deskripsi');
    $this->db->set('nama_product', $name);
    $this->db->set('price_product', $price);
    $this->db->set('stock_product', $total);
    $this->db->set('category_product', $category);
    $this->db->set('deskripsi_product', $deskripsi);
    $this->db->where('id_product', $this->input->post('id'));
    $this->db->update('product');
    $this->session->set_flashdata(
      'pesan',
      '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Produk telah di ubah
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>'
    );
  }
  public function change_image()
  {
    $old_image = $this->input->post('oldimg');
    unlink(FCPATH . 'assets/uploads/' . $old_image);
    $new_image = $this->upload->data('file_name');
    $this->db->set('image_product', $new_image);
  }
  public function out_stock($id_product){
    $var = 0;
        $this -> db -> set ('stock_product',$var);
        $this->db->where('id_product', $id_product);
        $this->db->update('product');
  }
  public function restock(){
    $id_product = $this -> input -> post('id');
    $stock = htmlspecialchars($this->input->post('total'), true);
    $this -> db -> set ('stock_product',$stock);
    $this->db->where('id_product', $id_product);
    $this->db->update('product');
  }
}
