<footer class="footer footer-default fix-bottom">
    <div class="container">
        <nav class="float-center">
            <ul>
                <li>
                    <h4>
                        &copy;<script>
                            document.write(new Date().getFullYear())
                        </script>
                        Created By Creative Tim & Designed By D_Rector's
                    </h4>
                </li>
            </ul>
        </nav>
    </div>
</footer>
<!--   Core JS Files   -->
<script src="<?= base_url('assets/js/core/jquery.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/core/popper.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/core/bootstrap-material-design.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/plugins/moment.min.js') ?>"></script>
<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
<script src="<?= base_url('assets/js/plugins/bootstrap-datetimepicker.js') ?>" type="text/javascript"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="<?= base_url('assets/js/plugins/nouislider.min.js') ?>" type="text/javascript"></script>
<!--  Google Maps Plugin    -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
<!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
<script src="<?= base_url('assets/js/material-kit.js?v=2.0.6') ?>" type="text/javascript"></script>

<script>
jQuery(document).ready(function () {
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
});
  </script>

</body>

</html>