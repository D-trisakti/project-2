<div class="container">
  <div class="form-group">

    <form name="add_name" method="POST" action="<?= base_url(); ?>transaksi/storepost">



      <div class="table-responsive">

        <table class="table table-bordered" id="dynamic_field">
          <thead>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah pesan</th>
            <th>Deskripsi Pesanan</th>
            <th>Total </th>
            <th>aksi</th>
          </thead>
          <tr>
            <td>
            <input type="hidden" id="id_product" name="id_product[]">  
            <select name="nama_product[]" id="product" class="form-control" required />
              <option value="0">-PILIH-</option>
              <?php foreach ($product as $prod) : ?>
                <option value="<?= $prod['nama_product']; ?>" data-id="<?= $prod['id_product']; ?>"><?= $prod['nama_product']; ?></option>
              <?php endforeach ?>
              </select>
            </td>
            <td><input type="number" class="form-control" id="harga" name="harga[]" disabled ></td>
            <td><input type="number" class="form-control" id="jumlah" name="jumlah[]" required></td>
            <td><input type="text" name="deskripsi[]" placeholder="Deskripsi Barang" class="form-control name_list" required></td>
            <td><input type="number" class="form-control" id="totals" name="totals[]" disabled></td>
            <input type="hidden" id="total" name="total[]">
            <input type="hidden" id="price" name="price[]">
            <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
          </tr>

        </table>

        <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />

      </div>



    </form>

  </div>

</div>