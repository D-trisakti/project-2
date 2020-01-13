<div class="page-header header-filter" data-parallax="true" style="background-image: url('<?= base_url('assets/img/bg.svg'); ?>')"></div>
<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Pembayaran</h2>
            <hr>
            
            <div class="alert alert-info alert-dismissible fade show" role="alert">
            <h3 class="title">Informasi</h3><br>                
            <?= $this -> session -> flashdata('pesan');?>
                            </div>
            <?= form_open_multipart(); ?>
            <input type="hidden" value="<?= $order->id_invoice;?>" id="id" name="id">
            <input type="hidden" value="<?= $order->jumlah_beli;?>" id="jumlah_bayar" name="jumlah_bayar">
            <input type="hidden" value="<?= $order->total_bayar;?>" id="total_bayar" name="total_bayar">
            <h5 class="text-centered">Anda akan melakukan pembayaran dengan ID Pemesanan : <?= $order->id_invoice;?> dengan Jumlah Pembayaran Sebesar Rp.<?=$order->total_bayar ?>
                <br>
                silahkan Melakukan Transfer Ke Rekening PD.Tria Anugerah Melanjutkan Pembayaran<br>
                <strong>Nama Bank  : BNI a/n Fajar Gondor</strong><br>
                <strong>No Rekening : 0432198806</strong> 
            </h5>
            <br>
            <h5>
Upload bukti Pembayaran Anda untuk melajutkan proses pesanan
            </h5>

        <input type='file' id="image" name="image" accept=".png, .jpg, .jpeg" onchange="loadFile(event)" class="mb-3">
        
        
        
        <div class="col-md-6 offset-md-3 text-center mt-2">
            <input type="submit" value="submit" class="btn btn-outline-info btn-round center"></input>
            <a href="<?= base_url('product');?>" class ="btn btn-outline-info btn-round center ">Kembali</a>
        </div>
   </div>
   </form>
    </div>
</div>
</div>