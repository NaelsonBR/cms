<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 */

$msgs = Mensagem_model::getMsgUlt30Dias();
echo "<h3>Todas as mensagens recebidas.</h3>";
if (is_string($msgs[0])) {
  echo "<p>Não existem mensagens no momento</p>";
} else {
  echo "<div class='box'>";
  echo "<div class='box-body'>";
  echo "<table id='tabela1' class=\"table table-striped table-bordered table-hover\">
            <thead>
              <tr>
                <th width='40px'>Status</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Assunto</th>
                <th>Data de envio</th>
                <th width='130px'></th>
              </tr>
            </thead>
            <tbody>";
  foreach ($msgs as $msg) {
    $id = $msg->getId();
    $status = $msg->getStatus();
    $nome = $msg->getNome();
    $email = $msg->getEmail();
    $telefone = $msg->getTelefone();
    $assunto = $msg->getAssunto();
    $mensagem = $msg->getAssunto();
    $data_de_cadastro = Helper::formatarDateTime($msg->getData_de_cadastro());
    $base = base_url('dashboard');
    if ($status == 0) {
      $icone = '<i class="fa fa-envelope" aria-hidden="true"></i>';
    } else {
      $icone = '<i class="fa fa-envelope-open" aria-hidden="true"></i>';
    }
    echo "  <tr>
              <td align='center'><a href='$base/ler_mesagem/$id' title='ler $mensagem'>$icone</a></td>
              <td><a href='$base/ler_mensagem/$id' title='ler $mensagem'>$nome</a></td>
              <td><a href='$base/ler_mensagem/$id' title='ler $mensagem'>$email</a></td>
              <td><a href='$base/ler_mensagem/$id' title='ler $mensagem'>$telefone</a></td>
              <td><a href='$base/ler_mensagem/$id' title='ler $mensagem'>$mensagem</a></td>
              <td><a href='$base/ler_mensagem/$id' title='ler $mensagem'>$data_de_cadastro</a></td>
              <td><a href='$base/apagar_mensagem/$id' title='Apagar mensagem' class='btn btn-md btn-danger'>Apagar</a></td>
            </tr>";
  }
  echo "  </tbody>
        </table>
      </div>
    </div>
    <script>
      $(document).ready(function(){
        $('#tabela1').DataTable({
          \"paging\": true,
          \"lengthChange\": false,
          \"searching\": false,
          \"ordering\": true,
          \"info\": true,
          \"autoWidth\": true
        });
      });
    </script>";
}