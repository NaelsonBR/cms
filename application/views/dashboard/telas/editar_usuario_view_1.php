<?php 
  $login_users = $this->session->userdata('login_usuario');
?>
<h1>Trocar senha de usuário</h1>
<form method="post" action="<?= base_url('Dashboard/trocar_senha_usuario') ?>">
  <label>login</label>
  <output class="form-control input-lg"><?= $login_users ?></output>
  <label for="input_senha">Senha atual</label>
  <input type="password" class="form-control  input-lg" id="input_senha" placeholder="Digite sua senha" name="senha_atual">
  <label for="input_nova_senha">Nova senha</label>
  <input type="password" class="form-control  input-lg" id="input_nova_senha" placeholder="Digite a nova senha" name="senha_nova">
  <br>
  <button type="submit" class="btn btn-lg btn-primary">Salvar</button>
</form>


