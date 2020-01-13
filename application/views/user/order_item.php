<div class="page-header header-filter" data-parallax="true" style="background-image: url('<?= base_url('assets/img/bg.svg'); ?>')"></div>
<div class="main main-raised">
  <div class="container">
    <div class="section text-center">
      <h2 class="title">Pemesanan Produk</h2>
      <hr>
      <?= form_open_multipart('user/add_order'); ?>
      <input type=hidden id="id_user" name ="id_user" value="<?= $user['id'] ?>">
      <input type=hidden id="id_product" name ="id_product" value="<?= $product['id_product'] ?>">
      <input type=hidden id="price" name ="price" value="<?= $product['price_product'] ?>">
      <input type=hidden id="total" name ="total">
      <div class="card card-nav-tabs col-lg-9 ml-auto mr-auto mt-5">
        <h4 class="card-header card-header-info mb-5">Detail Pemesanan Produk</h4>
        <div class="card-body">
          <div class="form-group">
            <label for="nama">Nama Produk</label>
            <input type="text" class="form-control pl-1" id="nama" name="nama" value="<?= $product['nama_product'] ?>" disabled>
            <?= form_error('nama','<small class="text-danger">','</small>'); ?>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="harga">Harga Produk</label>
              <input type="number" class="form-control pl-1" id="harga" name="harga" value="<?= $product['price_product'] ?>" disabled>
              <?= form_error('price','<small class="text-danger">','</small>'); ?>
            </div>
            <div class="form-group col-md-6">
              <label for="jumlah">Jumlah Pesan Produk</label>
              <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukan Jumlah Pesanan" min=1 max=<?= $product['stock_product'] ?> required value="<?= set_value ('jumlah');?>">
              <?= form_error('jumlah','<small class="text-danger">','</small>'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi Pemesanan</label>
            <input type="text" class="form-control pl-1" id="deskripsi" name="deskripsi" aria-describedby="deskripsi" placeholder="Masukan Deskripsi" required value="<?= set_value ('deskripsi');?>">
            <small id="deskripsi" class="form-text text-muted">Harap masukan deksripsi produk yang akan dipesan seperti ukuran dan warna (jika warna tidak tersedia maka akan dikirim secara random).</small>
            <?= form_error('deskripsi','<small class="text-danger">','</small>'); ?>
          </div>
          <div class="form-group">
            <label for="totals">Total Pembayaran</label>
            <input type="number" class="form-control pl-1" id="totals" name="totals" disabled>
             <?= form_error('totals','<small class="text-danger">','</small>'); ?>
          </div>
          <?= form_error()?>
          <button type="submit" value="submit" class="btn btn-primary">Konfirmasi</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
</div>