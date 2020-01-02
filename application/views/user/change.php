<div class="page-header header-filter" data-parallax="true" style="background-image: url('<?= base_url('assets/img/bg.svg'); ?>')"></div>
<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Your Profile</h2>
            <hr>
            <h3 class ="title pr-5">Ubah Data Diri</h3>
            <div class="row">
            <div class="col-md-4">
            <img src="<?=base_url();?>assets/user/camp.jpg" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid">
            </div>
            <div class="col-md-8">
            <div class="form-group bmd-form-group is-filled">
                <label for="email" class="bmd-label-floating">Email Anda</label>
                <input type="email" class="form-control mt-1 p-1" id="email" name="email" disabled value="<?=$user['email'];?>">
                <span class="bmd-help">We'll never share your email with anyone else.</span>
            </div>
                <div class="form-group bmd-form-group is-filled">
                <label for="nama" class="bmd-label-floating">Nama Anda</label>
                <input type="text" class="form-control mt-1 p-1" id="nama" name="nama" required value="<?=$user['nama'];?>">
                <span class="bmd-help">Harap Gunakan Nama Lengkap.</span>
            </div>
            <div class="form-group bmd-form-group is-filled">
                <label for="notelpon" class="bmd-label-floating">Nomor Telefon</label>
                <input type="number" class="form-control mt-1 p-1" id="notelpon" name="notelpon" required value="<?=$user['notelpon'];?>">
                <span class="bmd-help">Harap Gunakan Nomor Aktf.</span>
                <br>
                <div class="form-group bmd-form-group is-filled">
                <label for="alamat" class="bmd-label-floating">Alamat</label>
                <textarea type="text" rows="3" class="form-control mt-1 p-1" id="alamat" name="alamat" required><?=$user['nama'];?></textarea>
                <span class="bmd-help">Harap Menggunakan ALamat Lengkap.</span>
                <a href="<?=base_url('user/change');?>" class="btn btn-primary btn-round">Ubah Data Diri</a>
                <a href="<?=base_url('user/index');?>" class="btn btn-warning btn-round">Kembali</a>
            </div>
        </div>
    </div>
</div>
</div>