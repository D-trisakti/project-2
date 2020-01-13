<div class="page-header header-filter" data-parallax="true" style="background-image: url('<?= base_url('assets/img/bg.svg'); ?>')"></div>
<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Shopping Cart</h2>
            <hr>
            <?= $this->session->flashdata('pesan'); ?>
            <div class="table-responsive">
                <h4 class="title text-left">Daftar Pesanan</h4>
                <table class="table table-shopping">
                    <thead>
                        <tr>
                            <th class="text-left">No Pesanan</th>
                            <th>Tanggal Memesan</th>
                            <th class="text-right">Aksi</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($waiting as $ordr) : ?>
                            <tr>
                                <td class="td-name align-middle">
                                    <small><?= $ordr['id_invoice']; ?></small>
                                </td>
                                <td class="td-number align-middle">
                                    <small><?= date('d F Y', strtotime($ordr['tanggal_invoice']));?></small>
                                <td class="td-actions align-middle">
                                    <a href="<?= base_url(); ?>user/detail_pesanan/<?= $ordr['id_invoice']; ?>" class="btn btn-warning btn-sm btn-round float-right">Detail Pemesanan</a>
                                    <a href="<?= base_url(); ?>user/pay/<?= $user['id']; ?>" class="btn btn-info btn-sm btn-round float-right">Bayar Pemesanan</a>
                                    <a href="<?= base_url(); ?>user/hapus_invoice/<?= $ordr['id_invoice']; ?>" class="btn btn-danger btn-sm btn-round float-right">Hapus Pemesanan</a>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <h4 class="title text-left">Pesanan Dalam Proses</h4>
                <table class="table table-shopping">
                    <thead>
                        <tr>
                        <th class="text-left">No Pesanan</th>
                            <th>Tanggal Memesan</th>
                            <th class="text-right">Aksi</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($proses as $pcr) : ?>
                            <tr>
                                <td class="td-name align-middle">
                                    <small><?= $pcr['id_invoice']; ?></small>
                                </td>
                                <td class="td-number align-middle">
                                    <small><?= date('d F Y', strtotime($pcr['tanggal_invoice']));?></small>
                                <td class="td-actions align-middle">
                                    <a href="<?= base_url(); ?>user/detail_pesanan/<?= $pcr['id_invoice']; ?>" class="btn btn-warning btn-sm btn-round float-right">Detail Pemesanan</a>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <h4 class="title text-left">Pesanan Selesai</h4>
                <table class="table table-shopping">
                    <thead>
                        <tr>
                            <th>No Pesanan</th>
                            <th>Tanggal Memesan</th>
                            <th class="text-right">Aksi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($selesai as $pcr) : ?>
                            <tr>
                                <td class="td-name align-middle">
                                    <small><?= $pcr['id_invoice']; ?></small>
                                </td>
                                <td class="td-number align-middle">
                                    <small><?= date('d F Y', strtotime($pcr['tanggal_invoice']));?></small>
                                <td class="td-actions align-middle">
                                    <a href="<?= base_url(); ?>user/detail_pesanan/<?= $pcr['id_invoice']; ?>" class="btn btn-warning btn-sm btn-round float-right">Detail Pemesanan</a>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <h4 class="title text-left">Pesanan Gagal</h4>
                <table class="table table-shopping">
                    <thead>
                        <tr>
                            <th>No Pesanan</th>
                            <th>Tanggal Memesan</th>
                            <th class="text-right">Aksi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ditolak as $pcr) : ?>
                            <tr>
                                <td class="td-name align-middle">
                                    <small><?= $pcr['id_invoice']; ?></small>
                                </td>
                                <td class="td-number align-middle">
                                    <small><?= date('d F Y', strtotime($pcr['tanggal_invoice']));?></small>
                                <td class="td-actions align-middle">
                                    <a href="<?= base_url(); ?>user/detail_pesanan/<?= $pcr['id_invoice']; ?>" class="btn btn-warning btn-sm btn-round float-right">Detail Pemesanan</a>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="<?= base_url(); ?>user/invoice/<?= $user['id']; ?>" target="<?= base_url(); ?>user/delete_item" class="btn btn-info btn-lg btn-round float-right">Lanjutan Pembayaran</a>
            </div>
        </div>
    </div>
</div>
</div>