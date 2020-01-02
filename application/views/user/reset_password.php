<div class="page-header header-filter" data-parallax="true" style="background-image: url('<?= base_url('assets/img/bg.svg'); ?>')"></div>
<div class="main main-raised">
    <div class="container">
        <div class="section">
            <h2 class="title text-center">Your Profile</h2>
            <hr>
            <h3 class ="title pr-5 text-center">Ubah Password</h3>
            <div class="row">
            <div class="col-md-4">
            <img src="<?=base_url();?>assets/user/camp.jpg" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid">
            </div>
            <div class="col-md-6">
            <div class="form-group bmd-form-group is-filled">
                <label for="oldpassword" class="bmd-label-floating text-left">Password Lama Anda</label>
                <input type="password" class="form-control mt-1 p-1" id="password" name="password" required>
                <span class="bmd-help">Masukan Password Lama.</span>
            </div>
                <div class="form-group bmd-form-group is-filled">
                <label for="password1" class="bmd-label-floating">Password Baru</label>
                <input type="password" class="form-control mt-1 p-1" id="password" name="password" required>
                <span class="bmd-help">Masukan Password Baru.</span>
            </div>
            <div class="form-group bmd-form-group is-filled">
                <label for="password2" class="bmd-label-floating">Masukan Ulang Password Baru</label>
                <input type="password" class="form-control mt-1 p-1" id="passoword2" name="password2" required>
                <span class="bmd-help">Masukan Ulang Password Baru.</span>
                <br>
                <a href="<?=base_url('user/change');?>" class="btn btn-primary btn-round">Ubah Password</a>
                <a href="<?=base_url('user/index');?>" class="btn btn-warning btn-round">Kembali</a>
            </div>
        </div>
    </div>
</div>
</div>