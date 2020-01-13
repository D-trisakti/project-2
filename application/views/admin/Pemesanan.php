<!-- table barang -->
<div class="col-md 4">
    <div class="container">
        <?= $this->session->flashdata('pesan'); ?>
    </div>
    <a href="<?= base_url(); ?>transaksi/pemesanan_langsung" class="btn btn-primary float-right ml-1">Tambahkan Pemesanan Di tempat</a>
    <!-- <a href ="<?= base_url(); ?>admin/laporan_barang" class="btn btn-info float-right">Cetak</a> -->
</div>
<br>
<br>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Nomor Pemesanan</th>
                <th>Tanggal Pemesanan</th>
                <th>Nama Pemesan</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
             <?php foreach ($product as $trs) : ?>
                <tr>
                    <td><?= $trs['id_pesanan']; ?></td>
                    <td><?= $trs['tanggal']; ?></td>
                    <td><?= $trs['nama']; ?></td>
                    <td><?= $trs['nama_product']; ?></td>
                    <td><?= $trs['price_product']; ?></td>
                    <td><?= $trs['jumlah_beli']; ?></td>
                    <td><?= $trs['total_bayar']; ?></td>
                    <td><?= $trs['id_pesanan']; ?></td>
                </tr>
            <?php endforeach ?> 

        </tbody>
    </table>

</div>