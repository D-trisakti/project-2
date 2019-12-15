<div class="page-header header-filter" style="background-image: url('<?= base_url('assets/img/bg.svg'); ?>')">
    <div class="container">
        <br> <br> <br><br> <br> <br><br><br><br>
        <?= $this -> session -> flashdata('pesan');?>
        <div class="rows">
            <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                <div class="container">
                    <div class="card card-login">
                        <form class="form" method="post" action="<?= base_url('Landing/login');?>">
                            <div class="card-header card-header-primary text-center">
                                <h4 class="card-title">Sign In</h4>
                            </div>
                            <p class="description text-center">Belum Punya Akun ? <a href="<?= base_url('landing/register') ?>">Daftar Disini ! </a></p>
                            <div class="card-body">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">mail</i>
                                        </span>
                                    </div>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email..." value="<?= set_value ('email');?>">
                                </div>
                                <?= form_error('email','<small class ="text-danger">','</small>');?>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                                    </div>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password..." value="<?= set_value ('email');?>">
                                </div>
                                <?= form_error('password','<small class ="text-danger">','</small>');?>
                            </div>
                            <div class="footer text-center">
                            <button type="submit" class="btn btn-primary btn-round" value="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>