<div class="page-header header-filter" data-parallax="true" style="background-image: url('<?= base_url('assets/img/bg.svg'); ?>')"></div>
<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Your Profile</h2>
            <?= $this -> session -> flashdata('pesan');?>
            <hr>
            <div class="row">
            <div class="col-md">
            <img src="<?=base_url();?>assets/user/<?=$user['user_image'];?>" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid">
            </div>
            <div class="col-md-8">
                <h3 class ="title pr-5">Informasi Pribadi</h3>
                <h5 class ="title text-left pl-5 form-control">Email Anda : <?=$user['email'];?></h5>
                <h5 class ="title text-left pl-5 form-control">Nama Anda : <?=$user['nama'];?></h5>
                <h5 class ="title text-left pl-5 form-control">No Telepon : <?=$user['notelpon'];?></h5>
                <h5 class ="title text-left pl-5 form-control">Alamat Anda : <?=$user['email'];?></h5>
                <a href="<?=base_url('user/change');?>" class="btn btn-primary btn-round">Ubah Data Diri</a>
                <a href="<?=base_url('user/reset_password');?>" class="btn btn-info btn-round">Ubah Password</a>
                <a href="<?=base_url()?>user/shopping_cart/<?=$user['id'];?>" class="btn btn-warning btn-round">Lihat Keranjang Belanja</a>
            </div>
        </div>
    </div>
</div>
</div>