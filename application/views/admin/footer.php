</div>
      <!-- End of Main Content -->
<!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
<!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Tria Anugerah Shop 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
      </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin akan logout ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">x</span>
          </button>
        </div>
        <div class="modal-body">Pilih "Logout" Jika anda siap mengakhiri sesi ini.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
          <a class="btn btn-primary" href="<?=base_url('admin/logout')?>">Logout</a>
        </div>
      </div>
    </div>
  </div>


<!-- Bootstrap core JavaScript-->
<script src="<?= base_url(); ?>/assets/sbadmin2/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>/assets/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url(); ?>/assets/sbadmin2/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url(); ?>/assets/sbadmin2/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url(); ?>/assets/sbadmin2/vendor/chart.js/Chart.min.js"></script>
<script src="<?= base_url(); ?>/assets/sbadmin2/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/assets/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url(); ?>/assets/sbadmin2/js/demo/chart-area-demo.js"></script>
<script src="<?= base_url(); ?>/assets/sbadmin2/js/demo/chart-pie-demo.js"></script>
<script src="<?= base_url(); ?>/assets/sbadmin2/js/demo/datatables-demo.js"></script>

<!-- custom script for data table -->
<script src="<?= base_url(); ?>/assets/sbadmin2/js/script.js"></script>
<script>
jQuery(document).ready(function () {
    $('.modalorder').on('click',function(){
    var id_product = ($(this).data('id'));
    console.log(id_product);
    $.ajax({
      url : '<?=base_url('product/restock');?>',
      dataType : 'JSON',
      data : {id :id_product},
      type : 'post',
      cache:false,
      success : function(data) {
        console.log(data);
        $('#id').val(data.id_product);
        $('#nama').val(data.nama_product);		
      }
    });
});
});
</script>
<script>
jQuery(document).ready(function () {
    $('#product').change(function(){
    var id = ($(this).children('option:selected').data('id'));
    console.log(id);
    $.ajax({
      url : '<?=base_url('transaksi/get_price');?>',
      dataType : 'JSON',
      data : {id :id},
      type : 'post',
      cache:false,
      success : function(data) {
        console.log(data);
        prices = JSON.parse (data.price_product);
        console.log(prices);
        $('#harga').val(data.price_product);
        $('#id_product').val(data.id_product);
        $('#price').val(data.price_product);
        $('#output').attr('src','<?=base_url('assets/uploads/')?>'+data.image_product);
        $('#jumlah').attr('max',data.stock_product);
      }
    });
});
});
var img = ($('#output'));
console.log(img);
</script>
  <script>
    $('#jumlah').keyup(function(){
      v = parseInt($(this).val());
        min = parseInt($(this).attr('min'));
        max = parseInt($(this).attr('max'));

        if (v < min){
            $(this).val(min);
        } else if (v > max){
            $(this).val(max);
        }
      var a = parseInt($('#jumlah').val());
      var b = parseInt($('#harga').val());
      var c = a*b;
      $('#totals').val(c);
      // untuk form input hidden
      total = c;
      $('#total').val(total);
    });
  </script>
  
  <script type="text/javascript">
    $(document).ready(function() {

      var i = 1;



      $('#add').click(function() {

        i++;

        $('#dynamic_field').append('<tr id="row' + i + '" class="dynamic-added"><input type="hidden" id="id_product'+i+'" name="id_product[]"><td><select name="nama_product[]" id="product'+i+'" class ="form-control" required><option value="0">-PILIH-</option><?php foreach ($product as $prod) : ?><option value="<?= $prod['nama_product'] ; ?>" data-id="<?= $prod['id_product'] ; ?>"><?= $prod['nama_product'] ; ?></option><?php endforeach ?></select><td><input type="number" class="form-control" id="harga'+i+'" name="harga[]" disabled ></td><td><input type="number" class="form-control" id="jumlah'+i+'" name="jumlah[]" required></td><td><input type="text" name="deskripsi[]" placeholder="Deskripsi Barang" class="form-control name_list" required></td><td><input type="number" class="form-control" id="totals'+i+'" name="totals[]" disabled></td><input type="hidden" id="total'+i+'" name="total[]"><input type="hidden" id="price'+i+'" name="price[]"><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');          
        jQuery(document).ready(function () {
    $('#product'+i+'').change(function(){
    var id = ($(this).children('option:selected').data('id'));
    console.log(id);
    $.ajax({
      url : '<?=base_url('transaksi/get_price');?>',
      dataType : 'JSON',
      data : {id :id},
      type : 'post',
      cache:false,
      success : function(data) {
        console.log(data);
        prices = JSON.parse (data.price_product);
        console.log(prices);
        $('#harga'+i+'').val(data.price_product);
        $('#id_product'+i+'').val(data.id_product);
        $('#price'+i+'').val(data.price_product);
        $('#jumlah'+i+'').attr('max',data.stock_product);
        $('#jumlah'+i+'').keyup(function(){
        v = parseInt($(this).val());
        min = parseInt($(this).attr('min'));
        max = parseInt($(this).attr('max'));
          console.log(max);
        if (v < min){
            $(this).val(min);
        } else if (v > max){
            $(this).val(max);
        }
        var a = parseInt($('#jumlah'+i+'').val());
      var b = parseInt($('#harga'+i+'').val());
      var c = a*b;
      $('#totals'+i+'').val(c);
      // untuk form input hidden
      total = c;
      $('#total'+i+'').val(total);
  });
      }
    });
});
});
  });



      $(document).on('click', '.btn_remove', function() {

        var button_id = $(this).attr("id");

        $('#row' + button_id + '').remove();

      });



    });
  </script>

  
//   <script>
// $(document).ready(function(){
// 	var i=1;

// 	$('#add').click(function(){
// 		i++;
// 		$('#dynamic_field').append('<tr id="row'+i+'"><td><select name="product[]" id="product'+i+'" class ="form-control"><option value="0">-PILIH-</option><?php foreach ($product as $prod) : ?><option value="<?= $prod['nama_product'] ; ?>" data-id="<?= $prod['id_product'] ; ?>"><?= $prod['nama_product'] ; ?></option><?php endforeach ?></select></td> <td><input type="number" class="form-control" id="jumlah'+i+'"placeholder="Jumlah Barang" name="jumlah[]"></td><td><input type="text" name="dekskripsi[]" placeholder="Deskripsi Barang" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');

// });
//   });
  
// 	$(document).on('click', '.btn_remove', function(){
// 		var button_id = $(this).attr("id"); 
// 		$('#row'+button_id+'').remove();
// 	});

// // 	$('#submit').click(function(){		
// // 		$.ajax({
// 			// url:"/transaksi/tes",
// // 			method:"POST",
// //       data:$('#add_name').serialize(),
// // 			success:function(data)
// // 			{
				
// //         alert(data);
// //         $('#add_name')[0].reset();
// // 			}
// // 		});
// // 	});
	
// // });
// </script>

</body>

</html>

