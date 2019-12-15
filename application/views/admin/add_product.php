<div class="card-wrapper">
<?php echo form_open_multipart('admin/add_product');?>   
    <div class="form-row">
        <div class="col-sm-4">
        <input type='file' id="imageUpload" name="imageUpload" accept=".png, .jpg, .jpeg" onchange="loadFile(event)" >
        
        <div class="card bordered">
        <img width="350" height="auto" id="output"/>
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
        <div class="col-sm-8">
            <label for="name">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name" value="<?=set_value('name')?>"required >
            <?= form_error('name','<small class="text-danger">','</small>'); ?>
            <br>
            <label for="price">Harga Produk</label>
            <input type="number" class="form-control" id="price" name="price" value="<?=set_value('price')?>" required>
            <?= form_error('price','<small class="text-danger">','</small>'); ?>
            <br>
            <label for="total">Jumlah Produk</label>
            <input type="number" class="form-control" id="total" name="total" value="<?=set_value('total')?>" required>
            <?= form_error('total','<small class="text-danger">','</small>'); ?>
            <br>
            <label for="category">Kategori Produk</label>
            <input type="text" class="form-control" id="category" name="category" value="<?=set_value('category')?>" required>
            <?= form_error('category','<small class="text-danger">','</small>'); ?>
            
        </div>
        <div class="col-md-8 offset-md-2 mt-1">
        <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" value="<?=set_value('deskripsi')?>" required></textarea>
            <?= form_error('deskripsi','<small class="text-danger">','</small>'); ?>
            </div>
        <div class="col-md-6 offset-md-3 text-center mt-2">
            <button type="submit" value="submit" class="btn btn-outline-info btn-round center"> Kirim </button>
        </div>
   </div>
   </form>
</div>