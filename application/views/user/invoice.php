<<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
    <style>
    .clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 190px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url(dimension.png);
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: left;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 12px;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap;        
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,

table td.total {
  font-size: 1.2em;
  text-align: left;
}
table td.qty{
  text-align: center;
  font-size: 1.2em;
}


#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="assets/img/logo.png">
      </div>
      <h1>INVOICE</h1>
      <div id="company" class="clearfix">
      <span>PD.Tria Anugerah</span><br>
    <span>Military Fashion</span><br>
    <span> Jalan Dustira No.80, Kota Cimahi</span><br>
    <span>Jawa Barat, Indonesia</span><br>
    <span>Telp: (+62) 85721107126</span>

      </div>
      <div id="project">
        
        <div><span>PEMESAN</span><span style="text-align: left; text-transform: capitalize; color:Black ">: <?=$user['nama'];?></span></div>
        <div><span>TELP</span><span style="text-align: left; text-transform: capitalize; color:Black ">: <?=$user['notelpon'];?></span></div>
        <div><span>EMAIL</span><span style="text-align: left; text-transform: capitalize; color:Black ">: <?=$user['email'];?></span></div>
        <div><span>ALAMAT</span><span style="text-align: left; text-transform: capitalize; color:Black ">: <?=$user['alamat'];?></div></span></div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th>NO</th>  
            <th class="service">NO PESANAN</th>
            <th class="desc">NAMA PRODUK</th>
            <th>HARGA</th>
            <th>JUMLAH</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
            foreach ($order as $Order) : ?>
                <tr>
                    <td><?= $no++ ?></th>
                    <td class ="service"><?= $Order['id_pesanan']; ?></td>
                    <td class ="desc"><?= $Order['nama_product']; ?></td>
                    <td class="unit">Rp.<?= $Order['price_product']; ?></td>
                    <td class="qty"><?= $Order['jumlah_beli']; ?></td>
                    <td class="total">Rp.<?= $Order['total_bayar']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr><th colspan="4" class="total">GRAND TOTAL</th>
        <th class="qty"><?= $total_item['jumlah_beli']?></th>
                    <th class="total">Rp.<?= $total_bayar['total_bayar'];?></th>  
    </tr>
        </tfoot>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>