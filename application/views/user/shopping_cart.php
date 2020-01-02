<div class="page-header header-filter" data-parallax="true" style="background-image: url('<?= base_url('assets/img/bg.svg'); ?>')"></div>
<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Shopping Cart</h2>
            <hr>
            <a href="<?= base_url('user/invoice');?>" target="_blank" class ="btn btn-info btn-lg btn-round float-right">Lanjutan Pembayaran</a>
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
                    <?php foreach ($product as $product ) : ?>
                        <tr>
                            <td>
                                <div class="img-container">
                                <img style="width: 10rem;" height="auto" id="output" src="<?= base_url('assets/uploads/').$product['image'] ;?>">
                                </div>
                            </td>
                            <td class="td-name align-middle">
                                <a href="<?=base_url().$product['id']; ?>"><?= $product['nama']; ?></a>
                            </td>  
                            <td class="td-number align-middle">
                                <small>Rp.</small><?= $product['price']; ?>
                            </td>
                            <td class="td-number align-middle">
                            <?= $product['total'];?>
                                <div class="btn-group">
                                    <!-- button tambah kurang kuantitas belum jalan -->
                                    <button class="btn btn-round btn-info btn-sm"> <i class="material-icons">remove</i> </button>
                                    <button class="btn btn-round btn-info btn-sm"> <i class="material-icons">add</i> </button>
                                </div>
                            </td>
                            <td class="td-number align-middle">
                                <small>Rp.</small><?= $product['total'];?>
                            </td>
                            <td class="td-actions align-middle">
                                <button type="button" rel="tooltip" data-placement="left" title="Remove item" class="btn btn-simple">
                                    <i class="material-icons">close</i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach ; ?>
                    </tbody>
                </table>
                <a href="<?= base_url('user/invoice');?>" target="_blank" class ="btn btn-info btn-lg btn-round float-right">Lanjutan Pembayaran</a>
            </div>
        </div>
    </div>
</div>
</div>