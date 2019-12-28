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
                        <td><?=$worker['is_active']; ?></td>
                        <td>
                        <a href="<?php echo base_url(); ?>admin/deactive_pegawai/<?= $worker['id']; ?>" class="btn badge-danger float-right" >
                            Non Aktifkan Akun</a>
                        <div class="ml-3">
                            <a href="<?php echo base_url(); ?>admin/detail_useruct/<?= $worker['id']; ?>" class="btn badge-primary float-right mr-1"> Detail</a>
                            <a href="<?php echo base_url(); ?>admin/active_pegawai/<?= $worker['id']; ?>" class="btn badge-success float-right m-1"> Aktifkan Akun</a>
                    </td>
                    </tr>
                    <?php endforeach ?>

                </tbody>
        </table>

    </div>
