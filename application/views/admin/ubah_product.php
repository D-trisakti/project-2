<div class="card-wrapper">
<?= $this->session-> flashdata('pesan');?>
<?= form_open_multipart(); ?>
    <input type="hidden" name="id" id="id" value ="<?= $product['id_product'];?>">
    <input type="hidden" name="oldimg" id="oldimg" value ="<?= $product['image_product'];?>">
    <div class="form-row">
    <div class="col-sm-8">
            <label for="name">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $product['nama_product'];?>"required >
            <?= form_error('name','<small class="text-danger">','</small>'); ?>
            <br>
            <label for="price">Harga Produk</label>
            <input type="number" class="form-control" id="price" name="price" value="<?= $product['price_product'];?>" required>
            <?= form_error('price','<small class="text-danger">','</small>'); ?>
            <br>
            <label for="total">Jumlah Produk</label>
            <input type="number" class="form-control" id="total" name="total" value="<?= $product['stock_product'];?>" required>
            <?= form_error('total','<small class="text-danger">','</small>'); ?>
            <br>
            <label for="category">Kategori Produk</label>
            <input type="text" class="form-control" id="category" name="category" value="<?= $product['category_product'];?>" required>
            <?= form_error('category','<small class="text-danger">','</small>'); ?>
            <br>
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?= $product['deskripsi_product'];?></textarea>
            <?= form_error('deskripsi','<small class="text-danger">','</small>'); ?>
        </div>

        <div class="col-sm-4">
            <label for="image">Gambar Produk :</label>
        <input type='file' id="image" name="image" accept=".png, .jpg, .jpeg" onchange="loadFile(event)">
       
        <div class="card bordered">
        <img width="350" height="auto" src="<?=base_url('assets/uploads/').$product['image_product'] ;?>" id="output"/>
        </div>
        
        <script>
        var loadFile = function(event) {
        var reader = new FileReader();
        reader.onload = function(){
        var output = document.getElementById('output');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>
        </div>
        <div class="col-md-6 offset-md-3 text-center mt-2">
            <button type="submit" value="submit" class="btn btn-outline-info btn-round center"> Kirim </button>
            <a href="<?= base_url('product');?>" class ="btn btn-outline-info btn-round center ">Kembali</a>
        </div>
   </div>
   </form>
</div>