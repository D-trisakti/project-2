<!-- table barang -->
<div class ="col-md 4">
    <div class ="container">
    <?= $this -> session -> flashdata('pesan');?>
    </div>
    <a href ="<?=base_url();?>admin/add_useruct" class="btn btn-primary float-right">Tambahkan Pengguna</a>
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
                    <?php foreach ($user as $usr) : ?>
                    <tr>
                        <td><?= $usr['nama']; ?></td>
                        <td><?=$usr['email'] ;?></td>
                        <td><?=$usr['notelpon']; ?></td>
                        <td><?=$usr['is_active']; ?></td>
                        <td>
                        <a href="<?php echo base_url(); ?>admin/deactive_user/<?= $usr['id']; ?>" class="btn badge-danger float-right" >
                            Non Aktifkan Akun</a>
                        <div class="ml-3">
                            <a href="<?php echo base_url(); ?>admin/detail_useruct/<?= $usr['id']; ?>" class="btn badge-primary float-right mr-1"> Detail</a>
                            <a href="<?php echo base_url(); ?>admin/active_user/<?= $usr['id']; ?>" class="btn badge-success float-right m-1"> Aktifkan Akun</a>
                    </td>
                    </tr>
                    <?php endforeach ?>

                </tbody>
        </table>

    </div>
