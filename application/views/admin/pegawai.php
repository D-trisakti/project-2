<!-- table barang -->
<div class ="col-md 4">
    <div class ="container">
    <?= $this -> session -> flashdata('pesan');?>
    </div>
    <a href ="<?=base_url();?>admin/add_pegawai" class="btn btn-primary float-right">Tambah data Pegawai</a>
</div>
<br>
<br>
<div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Nama Pegawai</th>
                    <th>Email</th>
                    <th>No Telepon</th>
                    <th>Status</th>
                    <th>aksi</th>
                </tr>
            </thead>
                <tbody>
                    <?php foreach ($pegawai as $worker) : ?>
                    <tr>
                        <td><?= $worker['nama']; ?></td>
                        <td><?=$worker['email'] ;?></td>
                        <td><?=$worker['notelpon']; ?></td>
                        <td>
                            <?php if ($worker['is_active'] == 'aktif'){
                               echo '<div class="text-center mt-3"><i class="fas fa-check-circle" style="color:green"></i></div>';
                            }else{
                              echo  ' <div class="text-center mt-3"><i class="fas fa-times-circle"style="color:red"></i></div>';
                            }?>
                        </td>
                       
                        <td>
                            <div class="ml-3">
                            <a href="<?php echo base_url(); ?>admin/deactive_pegawai/<?= $worker['id']; ?>" class="btn badge-danger float-right m-1" >Non-Aktifkan</a>
                            <a href="<?php echo base_url(); ?>admin/detail_pegawai/<?= $worker['id']; ?>" class="btn badge-primary float-right m-1" >Detail</a>
                            <a href="<?php echo base_url(); ?>admin/active_pegawai/<?= $worker['id']; ?>" class="btn badge-success float-right m-1" >Aktifkan</a>
                    </td>
                    </tr>
                    <?php endforeach ?>

                </tbody>
        </table>
        </div>
    </div>
