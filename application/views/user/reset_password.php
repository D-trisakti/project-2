<div class="page-header header-filter" data-parallax="true" style="background-image: url('<?= base_url('assets/img/bg.svg'); ?>')"></div>
<div class="main main-raised">
    <div class="container">
        <div class="section">
            <h2 class="title text-center">Your Profile</h2>
            <hr>
            <?= $this->session-> flashdata('pesan');?>
            <h3 class ="title pr-5 text-center">Ubah Password</h3>
            <?= form_open_multipart('user/reset_password')?>
            <div class="row">
            <div class="col-md-4">
            <img src="<?=base_url();?>assets/user/<?=$user['user_image'];?>" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid">
            </div>
            <div class="col-md-6">
            <div class="form-group bmd-form-group is-filled">
                <label for="oldpassword" class="bmd-label-floating text-left">Password Lama Anda</label>
                <input type="password" class="form-control mt-1 p-1" id="oldpassword" name="oldpassword" required>
                <span class="bmd-help">Masukan Password Lama.</span>
                <?= form_error('oldpassword','<small class="text-danger">','</small>'); ?>
            </div>
                <div class="form-group bmd-form-group is-filled">
                <label for="password1" class="bmd-label-floating">Password Baru</label>
                <input type="password" class="form-control mt-1 p-1" id="password1" name="password1" required>
                <span class="bmd-help">Masukan Password Baru.</span>
                <?= form_error('password1','<small class="text-danger">','</small>'); ?>
            </div>
            <div class="form-group bmd-form-group is-filled">
                <label for="password2" class="bmd-label-floating">Masukan Ulang Password Baru</label>
                <input type="password" class="form-control mt-1 p-1" id="passoword2" name="password2" required>
                <span class="bmd-help">Masukan Ulang Password Baru.</span>
                <?= form_error('password2','<small class="text-danger">','</small>'); ?>
                <br>
                <button type="submit" value="submit" class="btn btn-outline-info btn-round center"> Kirim </button> 
                <a href="<?=base_url('user/index');?>" class="btn btn-warning btn-round">Kembali</a>
            </div>
</form>
        </div>
    </div>
</div>
</div>