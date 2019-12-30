<div class="page-header header-filter" data-parallax="true" style="background-image: url('<?= base_url('assets/img/bg.svg'); ?>')"></div>
<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Katalog Produk Kami </h2>
            <hr>
            <div class="row">
                <?php foreach ($product as $product) : ?>
                    <div class="card m-2" style="width: 22rem;" height="320px">
                    <div class="card wrapper">
                    <img class="card-img" src="<?= base_url('assets/uploads/') . $product['image']; ?>" alt="Card image cap"style="width: 22rem;" height="320px">
                        <div class="card-img-overlay" style="width: 22rem;" height="320px">
                        <h4 class=" float-left badge badge-pill badge-info"><?= $product['price']; ?>,-IDR</h4>
                        </div>
                    </div>
                        <div class="card-body">
                            <h4 class="card-title"><?= $product['nama']; ?></h4>

                            <p class="card-text"><?= $product['deskripsi']; ?></p>

                            
                        </div>
                        <div class="container">
                        <a href="<?php echo base_url(); ?>order_item/<?= $product['id']; ?>" class="btn btn-primary btn-round">Pesan</a>    
                        </div>
                    </div>
                    
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>
</div>