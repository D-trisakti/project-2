<!-- table barang -->
<div class="col-md 4">
    <div class="container">
        <?= $this->session->flashdata('pesan'); ?>
    </div>
    <!-- <a href="<?= base_url(); ?>product/add_product" class="btn btn-primary float-right ml-1">Tambahkan Produk</a> -->
    <!-- <a href ="<?= base_url(); ?>admin/laporan_barang" class="btn btn-info float-right">Cetak</a> -->
</div>
<br>
<br>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($product as $prod) : ?>
                <tr>
                    <td><?= $prod['nama_product']; ?></td>
                    <td><?= $prod['category_product']; ?></td>
                    <td><?= $prod['price_product']; ?></td>
                    <td><?= $prod['stock_product']; ?></td>
                    <td>
                    <a href="<?php echo base_url(); ?>product/out_stock/<?= $prod['id_product']; ?>" class="btn badge-danger float-right mr-1 modalorder" data-toggle="modal" data-target="#exampleModalCenter" data-id="<?= $prod['id_product']; ?>">Restok</a>
                    <a href="<?php echo base_url(); ?>product/detail_product/<?= $prod['id_product']; ?>" class="btn badge-primary float-right mr-1"> Detail</a>
                        <a href="<?php echo base_url(); ?>product/ubah_product/<?= $prod['id_product']; ?>" class="btn badge-success float-right mr-1"> Ubah</a>
                    </td>
                </tr>
            <?php endforeach ?>

        </tbody>
    </table>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Restok Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart('product/restock_product');?>
        <input type="hidden" name="id" id="id">
        <div class="form-group row">
        <label for="total" class="col-sm-5 col-form-label">Nama Produk :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control mb-1" id="nama" name="nama" disabled >
    </div>
    <label for="total" class="col-sm-5 col-form-label">Tambah Stok Produk :</label>
    <div class="col-sm-7">
      <input type="number" class="form-control" id="total" name="total" required>
    </div>
  </div>
        
      </div>
      <div class="modal-footer">
        <button type="submit" value="submit" class="btn btn-primary" >Kirim</button>
        </form>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>
</div>
