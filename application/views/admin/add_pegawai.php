<div class="card-wrapper">
<?= $this -> session -> flashdata('pesan');?>
<?php echo form_open_multipart('admin/add_pegawai');?>   
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Contoh@mail.com" value="<?= set_value('email');?>" required>
    <?= form_error('email','<small class="text-danger">','</small>'); ?>
    </div>
<div class="form-row">
<div class="form-group col-md-6">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pegawai" value="<?= set_value('nama');?>" required>
      <?= form_error('nama','<small class="text-danger">','</small>'); ?>
    </div>
    <div class="form-group col-md-6">
      <label for="notelpon">No Telepon</label>
      <input type="number" class="form-control" id="notelpon" name="notelpon" placeholder="08XXXXXXXXX" value="<?= set_value('notelpon');?>" required>
      <?= form_error('notelpon','<small class="text-danger">','</small>'); ?>
    </div>
  </div>
  <div class="form-row">
<div class="form-group col-md-6">
      <label for="password1">Password</label>
      <input type="password" class="form-control" id="password1" name="password1" required>
      <?= form_error('password1','<small class="text-danger">','</small>'); ?>
    </div>
    <div class="form-group col-md-6">
      <label for="password2">Masukan Ulang Password</label>
      <input type="password" class="form-control" id="password2" name="password2" required>
      <?= form_error('password2','<small class="text-danger">','</small>'); ?>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Kirim Data</button>
   </form>
</div>