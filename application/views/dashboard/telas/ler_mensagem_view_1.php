<?php
/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 */

$msg = Mensagem_model::getObjMensagem($id_mensagem);
Mensagem_model::marcarMsgComoLida($msg->getId());
?>
<div id="msg">
  <h1 class="text-uppercase">Mensagem</h1>
  <h2>Dados do remetente</h2>
  <p><b>Nome: </b><?= $msg->getNome() ?></p>
  <p><b>Telefone: </b><?= $msg->getTelefone() ?></p>
  <p><b>Email: </b><?= $msg->getEmail() ?></p>
  <h2>Dados da mensagem</h2>
  <p><b>Data de cadastro: </b><?= Data_model::formatarDateTime($msg->getData_de_cadastro()) ?></p>
  <p><b>Assunto: </b><?= $msg->getAssunto() ?></p>
  <p><b>Corpo da mensagem</b></p>
  <p style="border: 1px solid #cecece; padding: 15px; background: #fff;"><?= $msg->getMensagem() ?></p>
</div>
<style>
  #msg p{
    font-size: 18px;
  }
</style>
<h1 class="text-uppercase">Responder mensagem</h1>
<div class="container-fluid">
  <div class="row">
    <form method="post" id="form_responder_mensagem">
      <div class="form-group">
        <label for="input_titulo">Assunto</label>
        <input type="text" class="form-control input-lg" id="input_titulo" 
               placeholder="Digite o assunto da resposta" name="assunto">
      </div>
      <div class="form-group">
        <label for="editor1">Corpo da resposta</label>
        <textarea name="editor1" id="editor1" rows="10" cols="80">
        </textarea>
      </div>
      <input type="hidden" name="destinatario" value="<?= $msg->getEmail() ?>">
      <button type="submit" class="btn btn-lg btn-primary">Enviar</button>
    </form>
  </div>
</div>
<br>
<div class='container'>
  <div class='row'>
    <div id='resposta'></div>
  </div>
</div>
<script>
  $(document).ready(function () {
    $('#editor1').ckeditor();
    $('#form_responder_mensagem').submit(function () {
      var page = "<?= base_url('dashboard/responder_mensagem') ?>";
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