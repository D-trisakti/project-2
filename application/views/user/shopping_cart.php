<div class="page-header header-filter" data-parallax="true" style="background-image: url('<?= base_url('assets/img/bg.svg'); ?>')"></div>
<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Shopping Cart</h2>
            <hr>
            <?= $this->session->flashdata('pesan'); ?>
            
                    <a href="<?= base_url();?>user/product" class ="btn btn-warning btn-lg btn-round float-right">Kembali belanja</a>
            <div class="table-responsive">
                <table class="table table-shopping">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th>Produk</th>
                            <th class="text-right">Harga</th>
                            <th class="text-right">Jumlah</th>
                            <th class="text-right">Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($order as $ordr ) : ?>
                        <tr>
                            <td>
                                <div class="img-container float-left">
                                <img style="width: 10rem;" height="auto" id="output" src="<?= base_url('assets/uploads/').$ordr['image_product']?>">
                                </div>
                            </td>
                            <td class="td-name align-middle">
                                <small><?=$ordr['nama_product'];?></small>
                            </td>  
                            <td class="td-number align-middle">
                                <small>Rp.<?=$ordr['price_product'];?></small>
                            </td>
                            <td class="td-number align-middle"><?=$ordr['jumlah_beli'];?>
                            </td>
                            <td class="td-number align-middle">
                            <small>Rp.<?=$ordr['total_bayar'];?></small>
                            </td>
                            <td class="td-actions align-middle">
                                <a href="<?=base_url();?>user/delete_item/<?=$ordr['id_pesanan'];?>" type="button" rel="tooltip" data-placement="Right" title="Remove item" class="btn btn-simple btn-md btn-round">
                                    <i class="material-icons">close</i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach ; ?>
                    </tbody>
                 
                        <tfoot>
                        <th colspan =3 class="td-number text-right ">
                            Total Keseluruhan
                        </th>
                        <th>
                        <small><?= $total_item['jumlah_beli']?></small>
                        </th>
                        <th>
                            <small>Rp.<?= $total_bayar['total_bayar'];?></small>
                        </th>
                    </tfoot>
                 
                </table>
                <a href="<?= base_url();?>user/invoice/<?=$user['id'];?>" target="<?=base_url();?>user/delete_item" class ="btn btn-info btn-lg btn-round float-right">Lanjutan Pembayaran</a>
            </div>
        </div>
    </div>
</div>
</div>