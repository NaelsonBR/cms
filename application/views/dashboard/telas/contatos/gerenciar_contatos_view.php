<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 */

echo "<h1>Listar contatos</h1>";
$categorias = Contato_model::getTodosOsContatos();
if (is_string($categorias[0])) {
  echo "<p>Não existem contatod cadastradas</p>";
} else {
  echo "<div class='box'>";
  echo "<div class='box-body'>";
  echo '<table id="tabela1" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Telefone</th>
              <th>Email</th>
              <th width="130px"></th>
            </tr>
          </thead>
          <tbody>';
  foreach ($categorias as $categoria) {
    $id = $categoria->getId();
    $nome = $categoria->getNome();
    $telefone = $categoria->getTelefone();
    $email = $categoria->getEmail();
    $base = base_url('dashboard');
    echo "  <tr>
              <td>$nome</td>
              <td>$telefone</td>
              <td>$email</td>
              <td><a href='$base/apagar_contato/$id' title='Apagar' class='btn btn-md btn-danger'>Apagar</a></td>
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

