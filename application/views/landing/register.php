<div class="page-header header-filter" style="background-image: url('<?= base_url('assets/img/bg.svg'); ?>')">
    <div class="container">
        <br> <br> <br><br> <br> <br><br><br><br>
        <div class="rows" id="regis">
            <div class="col-lg-9 ml-auto mr-auto " style="margin-top: 10px">
                <div class="container">
                    <div class="card card-login">
                    <form class="form" action="<?= base_url('landing/register');?>" method="post">
                            <div class="card-header card-header-primary text-center">
                                <h4 class="card-title">Sign Up</h4>
                            </div>
                            <p class="description text-center">Sudah Punya Akun ? <a href="<?= base_url() ?>landing/login">Masuk Disini! </a></p>
                            
                            <div class="card-body">
                            <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">mail</i>
                                        </span>
                                    </div>
                                    <input type="email" required name="email" id="email" class="form-control" placeholder="Email... " value="<?= set_value ('email');?>">
                                </div>
                                <?= form_error('email','<small class ="text-danger pl-3">','</small>'); ?>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">face</i>
                                        </span>
                                    </div>
                                    <input type="text" required name="name" id="name" class="form-control" placeholder="Nama Anda..." value="<?= set_value ('name');?>">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">contact_phone</i>
                                        </span>
                                    </div>
                                    <input type="Number" required name="notelpon" id="notelpon" class="form-control" placeholder="No Telepon... " value="<?= set_value ('notelpon');?>">
                                   
                                </div>
                                <?= form_error('name','<small class ="text-danger pl-3">','</small>'); ?>
                                <?= form_error('notelpon','<small class ="text-danger pl-3">','</small>'); ?>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">home</i>
                                        </span>
                                    </div>
                                    <input type="text" required name="alamat" id="alamat" class="form-control" placeholder="Alamat " value="<?= set_value ('alamat');?>">
                                </div>
                                <?= form_error('alamat','<small class ="text-danger pl-3">','</small>'); ?>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                                    </div>
                                    <input type="password" required name="password1" id="password1" class="form-control" placeholder="Password... " value="<?= set_value ('password');?>">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                                    </div>
                                    <input type="password" required name="password2" id="password2" class="form-control" placeholder="Masukan Ulang Password...">
                                </div>
                                </div>
                                <?= form_error('password1','<small class ="text-danger pl-3">','</small>'); ?>
                            <div class="footer text-center">
                                <button type="submit" class="btn btn-primary btn-round mt-5" value="submit">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<br><br>