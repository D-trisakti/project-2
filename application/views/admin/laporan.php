<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Laporan</title>
</head>
<body>
    <div>
    <img src="assets/img/logo.png" class="rounded float-left" style="width: 200px; height :auto;">
    <h3 style="text-align: right; padding-bottom : -5px ;">PD.Tria Anugerah</h3>
    <h5 style="text-align: right; padding-top : -3px ;">Military Fashion</h5>
    <h6 style="text-align: right; padding-top : -3px ;">Jalan Dustira No.80, Kota Cimahi<br>Jawa Barat, Indonesia</h6>
    <h6 style="text-align: right; padding-top : -3px ;">Telp: (+62) 85721107126</h6>
    </div>

    <hr>
    <h5 class="text-center">Daftar Data Produk</h5>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
            <th>No</th>
            <th>Nama produk</th>
            <th>Harga</th>
            <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($product as $product): ?>
            <tr>
                <th><?= $no++?></th>
                <th><?=$product['nama'];?></th>
                <th>Rp.<?=$product['price'];?></th>
                <th><?=$product['total'];?></th>
            </tr>
            <?php endforeach ;?>
        </tbody>
  </table>
   
</body>
</html>
