<div class="page-header header-filter" data-parallax="true" style="background-image: url('<?= base_url('assets/img/bg.svg'); ?>')"></div>
<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Your Profile</h2>
            <hr>
            <?= $this -> session -> flashdata('pesan');?>
            <h3 class ="title pr-5">Ubah Data Diri</h3>
            <?= form_open_multipart('user/change')?>
            <input type="hidden" name="id" id="id" value ="<?= $user['id'];?>">
            <input type="hidden" name="oldimg" id="oldimg" value ="<?= $user['user_image'];?>">
            <input type="hidden" name="email" id="email" value ="<?= $user['email'];?>">
            <div class="form-row">
            <div class="col-md-4">
            <label for="image">Photo Profile :</label>
            <div class="card bordered">
            <input type='file' id="image" name="image" accept=".png, .jpg, .jpeg" onchange="loadFile(event)">
        <img width="350" height="auto" src="<?=base_url();?>assets/user/<?=$user['user_image'];?>" id="output"/>
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
            <div class="col-md-8">
            <div class="form-group bmd-form-group is-filled">
                <label for="email" class="bmd-label-floating">Email Anda</label>
                <input type="email" class="form-control mt-1 p-1" id="mail" name="mail" value="<?=$user['email'];?>" disabled >
                <span class="bmd-help">We'll never share your email with anyone else.</span>
            </div>
                <div class="form-group bmd-form-group is-filled">
                <label for="nama" class="bmd-label-floating">Nama Anda</label>
                <input type="text" class="form-control mt-1 p-1" id="nama" name="nama" required value="<?=$user['nama'];?>">
                <span class="bmd-help">Harap Gunakan Nama Lengkap.</span>
                <?= form_error('nama','<small class="text-danger">','</small>'); ?>
            </div>
            <div class="form-group bmd-form-group is-filled">
                <label for="notelpon" class="bmd-label-floating">Nomor Telefon</label>
                <input type="number" class="form-control mt-1 p-1" id="notelpon" name="notelpon" required value="<?=$user['notelpon'];?>">
                <span class="bmd-help">Harap Gunakan Nomor Aktf.</span>
                <?= form_error('notelpon','<small class="text-danger">','</small>'); ?>
                <br>
                <div class="form-group bmd-form-group is-filled">
                <label for="alamat" class="bmd-label-floating">Alamat</label>
                <textarea type="text" rows="3" class="form-control mt-1 p-1" id="alamat" name="alamat" required><?=$user['alamat'];?></textarea>
                <span class="bmd-help">Harap Menggunakan ALamat Lengkap.</span>
                <?= form_error('alamat','<small class="text-danger">','</small>'); ?>
                <button type="submit" value="submit" class="btn btn-outline-info btn-round center"> Kirim </button>     
                <a href="<?=base_url('user/index');?>" class="btn btn-warning btn-round">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
</div>