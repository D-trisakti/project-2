<div class="card-wrapper">
<?= $this->session-> flashdata('pesan');?>
<?= form_open_multipart(); ?>
    <input type="hidden" name="id" id="id" value ="<?= $user['id'];?>">
    <input type="hidden" name="email" id="email" value ="<?= $user['email'];?>">
    <div class="form-row">
    <div class="col-sm-8">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="ema" name="ema" value="<?= $user['email'];?>"disabled >
            <?= form_error('email','<small class="text-danger">','</small>'); ?>
            <br>
            <label for="nama">Nama Anda</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama'];?>" required>
            <?= form_error('nama','<small class="text-danger">','</small>'); ?>
            <br>
            <label for="notelpon">No Telfon</label>
            <input type="number" class="form-control" id="notelpon" name="notelpon" value="<?= $user['notelpon'];?>" required>
            <?= form_error('notelpon','<small class="text-danger">','</small>'); ?>
            <br>
        </div>

        <div class="col-sm-4">
            <label for="image">Photo Profile</label>
        <input type='file' id="image" name="image" accept=".png, .jpg, .jpeg" onchange="loadFile(event)">
       
        <div class="card bordered">
        <img width="350" height="auto" src="<?=base_url('assets/user/').$user['user_image'] ;?>" id="output"/>
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
            <button type="submit" value="submit" class="btn btn-outline-info btn-round center"> Ubah </button>
        </div>
   </div>
   </form>
</div>