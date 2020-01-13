<!-- table barang -->
<div class="col-md 4">
    <div class="container">
        <?= $this->session->flashdata('pesan'); ?>
    </div>
    <a href="<?= base_url(); ?>product/add_product" class="btn btn-primary float-right ml-1">Tambahkan Produk</a>
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
                        <a href="<?php echo base_url(); ?>product/out_stock/<?= $prod['id_product']; ?>" class="btn badge-danger float-right" onclick="return confirm ('Apakah Produk Benar Benar Tidak Tersedia ?');">
                            Produk Tidak Tersedia</a>
                        <a href="<?php echo base_url(); ?>product/detail_product/<?= $prod['id_product']; ?>" class="btn badge-primary float-right mr-1"> Detail</a>
                        <a href="<?php echo base_url(); ?>product/ubah_product/<?= $prod['id_product']; ?>" class="btn badge-success float-right mr-1"> Ubah</a>
                    </td>
                </tr>
            <?php endforeach ?>

        </tbody>
    </table>

</div>