<!-- table barang -->
<div class ="col-md 4">
    <div class ="container">
    <?= $this -> session -> flashdata('pesan');?>
    </div>
</div>
<br>
<br>
<div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Nama Pengguna</th>
                    <th>Email</th>
                    <th>No Telepon</th>
                    <th>Status</th>
                    <th>aksi</th>
                </tr>
            </thead>
                <tbody>
                    <?php foreach ($users as $usr) : ?>
                    <tr>
                        <td><?= $usr['nama']; ?></td>
                        <td><?=$usr['email'] ;?></td>
                        <td><?=$usr['notelpon']; ?></td>
                        <td>
                        <?php if ($usr['is_active'] == 'aktif'){
                               echo '<div class="text-center mt-3"><i class="fas fa-check-circle" style="color:green"></i></div>';
                            }else{
                              echo  ' <div class="text-center mt-3"><i class="fas fa-times-circle"style="color:red"></i></div>';
                            }?>
                        </td>
                        <td>
                        <a href="<?php echo base_url(); ?>admin/deactive_user/<?= $usr['id']; ?>" class="btn badge-danger float-right m-1" >Non Aktifkan Akun</a>
                            <a href="<?php echo base_url(); ?>admin/detail_user/<?= $usr['id']; ?>" class="btn badge-primary float-right m-1"> Detail</a>
                            <a href="<?php echo base_url(); ?>admin/active_user/<?= $usr['id']; ?>" class="btn badge-success float-right m-1"> Aktifkan Akun</a>
                    </td>
                    </tr>
                    <?php endforeach ?>

                </tbody>
        </table>

    </div>
