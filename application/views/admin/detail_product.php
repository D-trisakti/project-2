<div class="card-wrapper"> 
    <div class="card-body row">
        <div class="col-sm-4">
        <img width="350" height="auto" id="output" src="<?= base_url('assets/uploads/').$product['image_product'] ;?>">
        </div>
        <div class="col-sm-8">
        <h2 class ="text-title"><?= $product['nama_product']?></h2>
        <hr>
        <h4>Rp.<?= $product['price_product']?></h4>
        <p>
            Kategori Produk : <?= $product['category_product']; ?>
        </p>
        <div class ="description m-2">
            <p>
                <?= $product['deskripsi_product'];?>
            </p>
        </div>
        <h4>
            Sisa stok <?= $product['stock_product'];?>
        </h4>
        <!-- <p>Masukan Jumlah yang akan Dipesan</p>
        <input type="number" min-value = "1" max> -->

        </div>
    </div>
    <div class="container">
        <div class ="row text-center">
        <div class="col text-center">
        <a href="<?= base_url('product');?>" class ="btn btn-info btn-sm ">Kembali</a>
        </div>
        </div>
    </div>
    
</div>