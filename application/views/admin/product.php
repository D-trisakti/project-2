<!-- table barang -->
<div class ="col-md 4">
    <div class ="container">
    <?= $this -> session -> flashdata('pesan');?>
    </div>
    <a href ="<?=base_url();?>admin/add_product" class="btn btn-primary float-right">Tambahkan Produk</a>
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
                    <?php foreach ($product as $prod ) : ?>
                    <tr>
                        <td><?= $prod['nama']; ?></td>
                        <td><?=$prod['category'] ;?></td>
                        <td><?=$prod['price']; ?></td>
                        <td><?=$prod['total']; ?></td>
                        <td>
                        <a href="<?php echo base_url(); ?>admin/delete_product/<?= $prod['id']; ?>" class="btn badge-danger float-right" onclick="return confirm ('yakin ?');">
                            Hapus </a>
                            <a href="<?php echo base_url(); ?>admin/detail_product/<?= $prod['id']; ?>" class="btn badge-primary float-right mr-1"> Detail</a>
                            <a href="<?php echo base_url(); ?>admin/ubah_product/<?= $prod['id']; ?>" class="btn badge-success float-right mr-1"> Ubah</a>
                    </td>
                    </tr>
                    <?php endforeach ?>

                </tbody>
        </table>

    </div>
