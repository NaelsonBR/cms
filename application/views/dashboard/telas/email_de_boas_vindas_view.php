<div class="container-fluid">
  <div class="row">
    <h3>Email de boas vindas</h3>
    <p>
      O email de boas vindas é o primeiro email que seu assinante receberá após 
      preencher o formulario de inscrição de recebimento de newsletter em seu site.
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

    $('#form_email_boas_vindas').submit(function () {
      var page = "<?= base_url('Email/cadastrar_email_de_boas_vindas') ?>";
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
