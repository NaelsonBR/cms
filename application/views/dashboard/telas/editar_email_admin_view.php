<div class="container-fluid">
  <div class="row">
    <h1>Editar email administrativo</h1>
    <h2>Esse email é o que recebe todas as notificações enviadas pelo site.</h2>
    <form method="post" id="form_editar_email_admin">
      <label for="input_email_admin">Endereço de email</label>
      <input type="email" value="<?= $email_admin ?>" required class="form-control" id="input_email_admin" name="email">
      <br>
      <button type="submit" class="btn btn-lg btn-primary">Salvar</button>
    </form>
    <script>
      $('#form_editar_email_admin').submit(function () {
        var page = "<?= base_url("Dashboard/salvar_email_admin_editado") ?>";
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
            $(".content").html(msg);
            $("#carregando_animado").hide('fast');
          }
        });
        return false;
      });
    </script>
  </div>
</div>
