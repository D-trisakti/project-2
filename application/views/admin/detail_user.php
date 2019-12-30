<?php// var_dump($worker); die;?>

<div class="card-wrapper"> 
    <div class="card-body row">
        <div class="col-sm">
        <h2 class ="text-title">Nama :<?= $worker['nama']?></h2>
        <h4>Email :<?= $worker['email']?></h4>
        <h4>
            no telefon : <?= $worker['notelpon']; ?>
        </h4>
        <div class ="description">
            <h4>Status : <?php if ($worker['role_id']=1){
                echo "Aktif";
            }else {
                Echo "Tidak Aktif";
            }?>
        </div>
        <h4>
          
        </h4>
        <!-- <p>Masukan Jumlah yang akan Dipesan</p>
        <input type="number" min-value = "1" max> -->

        </div>
    </div>
    <div class="container">
        <div class ="row text-center">
        <div class="col text-center">
        <a href="<?= base_url('admin/pegawai');?>" class ="btn btn-info btn-sm ">Kembali</a>
        </div>
        </div>
    </div>
    
</div>