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
                <th>Nomor Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Nama Pembeli</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Bukti Transaksi</th>
                
            </tr>
        </thead>
        <tbody>
             <?php foreach ($riwayat as $trs) : ?>
                <tr>
                    <td><?= $trs['id_transaksi']; ?></td>
                    <td><?= $trs['tanggal']; ?></td>
                    <td><?= $trs['nama']; ?>
                    <?php if($trs['role_id'] == 2 ){
                        echo '(Admin)';
                    }else{
                        echo '(User)';
                    }?>
                    </td>
                    <td><?= $trs['jumlah']; ?></td>
                    <td>Rp.<?= $trs['jumlah_bayar']; ?></td>
                    <td><?= $trs['bukti_transaksi']; ?></td>
                </tr>
            <?php endforeach ?> 

        </tbody>
    </table>

</div>