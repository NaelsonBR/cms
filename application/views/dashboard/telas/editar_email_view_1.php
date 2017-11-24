
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <div class="row">
        <h3>Editar email</h3>
        <p class="text-danger">
          Você está editando o email do dia <?= $ordem ?> na sequência.
        </p>
        <form method="post" id="form_email_boas_vindas">
          <div class="form-group">
            <label for="input_titulo">Assunto</label>
            <input type="text" class="form-control input-lg" id="input_titulo" 
                   placeholder="Digite o assunto do email" name="assunto"
                   <?php
                   if (isset($assunto) && $assunto != "") {
                     echo "value='$assunto'";
                   }
                   ?>>
          </div>
          <div class="form-group">
            <label for="editor1">Corpo do email</label>
            <textarea name="corpo" id="editor1" rows="10" cols="80">
              <?php
              if (isset($corpo) && $corpo != "") {
                echo "$corpo";
              }
              ?>
            </textarea>
          </div>
          <button type="submit" class="btn btn-lg btn-primary">Salvar</button>
        </form>
      </div>
    </div>
    <div id="recipiente"></div>
    <script>
      $(document).ready(function () {
        $('#editor1').ckeditor();

        $('#form_email_promocional').submit(function () {
          var page = "<?= base_url('Email/enviar_email_promocional') ?>";
          var dados = jQuery(this).serialize();
          $.ajax({
            type: 'POST',
            dataType: 'html',
            url: page,
            beforeSend: function () {
              $("#carregando_animado").show('fast');
            },
            data: dados,
            success: function (msg) {
              $("#recipiente").html(msg);
              $("#carregando_animado").hide('fast');
            }
          });
          return false;
        });

      });
    </script>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right -->
  <div class="pull-right hidden-xs">
    <?php
    if (isset($nome_empresa_usuario) && $nome_empresa_usuario != '') {
      echo "$nome_empresa_usuario";
    }
    ?>
  </div>
  <!-- Default to the left -->
  <strong>Copyright &copy; 2017 <a href="http://www.movibr.com/">Movi Brasil</a>.</strong> Todos os direitor reservados.
</footer>