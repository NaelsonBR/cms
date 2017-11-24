<div id="carregando_animado"style="color: #005983; font-size: 20pt; width: 100px; position: fixed; right: 20px; bottom: 30px; display: none;">
  <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
  <span class="sr-only">Carregando...</span>
</div>
<!-- DataTables -->
<script src="<?= base_url('assets/admin/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/admin/') ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url('assets/admin/') ?>plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?= base_url('assets/admin/') ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url('assets/admin/') ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?= base_url('assets/admin/') ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url('assets/admin/') ?>plugins/fastclick/fastclick.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?= base_url('assets/admin/') ?>plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url('assets/admin/') ?>dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/admin/') ?>dist/js/demo.js"></script>
<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.7.0/standard/ckeditor.js"></script>
<script src="<?= base_url('assets/admin/plugins/ckeditor/adapters/jquery.js') ?>"></script>
<script>
  function ajaxSimples(page) {
    $.ajax({
      type: 'POST',
      dataType: 'html',
      url: page,
      beforeSend: function () {
        $("#carregando_animado").show('fast');
      },
      success: function (msg) {
        $(".content").html(msg);
        $("#carregando_animado").hide('fast');
      }
    });
  }
  $(document).ready(function () {

    $('#editor1').ckeditor();
    $('#texto_curto').ckeditor();
    $('#texto_complementar').ckeditor();
    $('#texto_descricao').ckeditor();
    $('input').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    $('#ativar_modo_manutencao').click(function () {
      var page = "<?= base_url("Dashboard/ativar_modo_manutencao") ?>";
      $.ajax({
        type: 'POST',
        dataType: 'html',
        url: page,
        beforeSend: function () {
          $("#carregando_animado").show('fast');
        },
        success: function (msg) {
          $(".content").html(msg);
          $("#carregando_animado").hide('slow');
          $('#btn_site_em_manutencao').click();
        }
      });
    });

    $('#desativar_modo_manutencao').click(function () {
      var page = "<?= base_url("Dashboard/desativar_modo_manutencao") ?>";
      $.ajax({
        type: 'POST',
        dataType: 'html',
        url: page,
        beforeSend: function () {
          $("#carregando_animado").show('fast');
        },
        success: function (msg) {
          $(".content").html(msg);
          $("#carregando_animado").hide('slow');
          $('#btn_site_em_manutencao').click();
        }
      });
    });

    $('#btn_site_em_manutencao').click(function () {
      var page = "<?= base_url('Dashboard/site_em_manutencao') ?>";
      ajaxSimples(page);
    });

  });
</script>
</body>
</html>