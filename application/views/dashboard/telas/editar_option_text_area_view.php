<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 */
$valor = Option_model::recuperarOption($nome_option);
?>
<h1><?= $legenda_do_form ?></h1>
<form method="post" id="form_option">
  <label for="input_1"><?= $label ?></label>
  <textarea name="valor_option" id="editor1" rows="10" cols="80"><?= $valor ?></textarea>
  <input type="hidden" value="<?= $nome_option ?>" name="nome_option">
  <br>
  <button type="submit" class="btn btn-lg btn-primary">Salvar</button>
</form>
<br>
<div class='container'>
  <div class='row'>
    <div id='resposta'></div>
  </div>
</div>
<script>
  $(document).ready(function () {
    $('#form_option').submit(function () {
      var page = "<?= base_url('dashboard/salvar_option') ?>";
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
          $("#resposta").append(msg);
          $("#carregando_animado").hide('fast');
        }
      });
      return false;
    });
  });
</script>