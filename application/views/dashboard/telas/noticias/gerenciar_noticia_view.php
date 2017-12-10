<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 */

$noticias = Noticia_model::getTodosOsNoticias();
echo "<h3>Lista de todas as notícias cadastradas</h3>";
if (is_string($noticias[0])) {
  echo "<p>Não existem notícias ativas no momento</p>";
} else {
  echo "<div class='box'>";
  echo "<div class='box-body'>";
  echo "<table id='tabela1' class=\"table table-striped table-bordered table-hover\">
            <thead>
              <tr>
                <th width='40px'>Id</th>
                <th>Titulo</th>
                <th>Data de postagem</th>
                <th width='130px'></th>
                <th width='130px'></th>
              </tr>
            </thead>
            <tbody>";
  foreach ($noticias as $post) {
    $id = $post->getId();
    $titulo = $post->getTitulo();
    $data_postagem = $post->getData_cadastro();
    $data_postagem_2 = Helper::formatarDateTime($data_postagem);
    $url = base_url('Dashboard/editar_noticia/') . $id;
    $url2 = base_url('Dashboard/apagar_noticia/') . $id;
    echo "  <tr>
              <td>$id</td>
              <td>$titulo</td>
              <td>$data_postagem_2</td>
              <td><a href='$url' class='btn btn-primary'>Editar noticia</a></td>
              <td><a href='$url2' class='btn btn-danger'>Apagar noticia</a></td>
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