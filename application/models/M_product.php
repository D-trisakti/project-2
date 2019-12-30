<?php
defined('BASEPATH') or exit('no direct script to access allowed');

class M_product extends CI_Model
{

  public function add_product()
  {
    $data = [
      'nama'  => htmlspecialchars($this->input->post('name'), true),
      'price' => htmlspecialchars($this->input->post('price'), true),
      'total' => htmlspecialchars($this->input->post('total'), true),
      'category' => htmlspecialchars($this->input->post('category'), true),
      'deskripsi' => htmlspecialchars($this->input->post('deskripsi'), true),
      'image' => $this->upload->data('file_name'),
    ];
    $this->db->insert('product', $data);
  }

  public function getproduct()
  {
    $this->db->select('*');
    $this->db->from('product');
    return $this->db->get()->result_array();
  }
  public function delete_product($id)
  {
    $data = $this->db->get_where('product', ['id' => $id])->row_array();
    $old_image = $data['image'];
    unlink(FCPATH . 'assets/uploads/' . $old_image);
    $this->db->where('id', $id);
    $this->db->delete('product');
  }
  public function getproductbyid($id)
  {
    return $this->db->get_where('product', ['id' => $id])->row_array();
  }
  public function ubah_product()
  {
    $name = $this->input->post('name');
    $price = $this->input->post('price');
    $total = $this->input->post('total');
    $category = $this->input->post('category');
    $deskripsi = $this->input->post('deskripsi');
    $this->db->set('nama', $name);
    $this->db->set('price', $price);
    $this->db->set('total', $total);
    $this->db->set('category', $category);
    $this->db->set('deskripsi', $deskripsi);
    $this->db->where('id', $this->input->post('id'));
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
    $this->db->set('image', $new_image);
  }
}
