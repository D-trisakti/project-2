<div class="card-wrapper"> 
    <div class="card-body row">
        <div class="col-sm-4">
        <img width="350" height="auto" id="output" src="<?= base_url('assets/uploads/').$product['image'] ;?>">
        </div>
        <div class="col-sm-8">
        <h2 class ="text-title"><?= $product['nama']?></h2>
        <hr>
        <h4>Rp.<?= $product['price']?></h4>
        <p>
            Kategori Produk : <?= $product['category']; ?>
        </p>
        <div class ="description m-2">
            <p>
                <?= $product['deskripsi'];?>
            </p>
        </div>
        <h4>
            Sisa stok <?= $product['total'];?>
        </h4>
        <!-- <p>Masukan Jumlah yang akan Dipesan</p>
        <input type="number" min-value = "1" max> -->

        </div>
    </div>
    <div class="container">
        <div class ="row text-center">
        <div class="col text-center">
        <a href="<?= base_url('admin/product');?>" class ="btn btn-info btn-sm ">Kembali</a>
        </div>
        </div>
    </div>
    
</div>