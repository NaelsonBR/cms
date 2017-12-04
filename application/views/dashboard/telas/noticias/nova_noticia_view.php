<div class="container-fluid">
  <div class="row">
    <h3>Adicionar nova notícia</h3>
  </div>
  <form method="post" enctype="multipart/form-data" action="<?= base_url('Dashboard/salvar_nova_noticia') ?>">
    <div class="row">
      <div class="form-group">
        <label for="input_titulo">Título</label>
        <input type="text" class="form-control input-lg" id="input_titulo" placeholder="Digite o título da notícia" name="titulo">
      </div>
    </div>
    <div class="row">
      <label for="input_imagem">
        Imagem principal da notícia (tamanho ideal 1200 x 900 pixels)
        <div class="clearfix"></div>
        <div class="col-md-4">
          <img class="img-responsive center-block" id="tag_imagem" src="<?= base_url('assets/images/sem_imagem.jpg') ?>" alt="Imagem da notícia"/>
        </div>
      </label>
      <div class="clearfix"></div>
      <div class="form-group">
        <br>
        <input type="file" class="form-control input-lg" id="input_imagem" name="imagem">
      </div>
    </div>
    <div class="row">
      <div class="form-group">
        <label for="editor1">Corpo da notícia</label>
        <textarea name="corpo" id="editor1" rows="10" cols="80">
        </textarea>
      </div>
    </div>
    <div class="row">
      <h2 class="text-center text-uppercase">Categorias</h2>
      <!-- Categorias -->
			<?php
			$categorias = Categoria_model::getTodosOsCategorias();
			if (is_string($categorias[0])) {
				echo "<p>Não existem categorias cadastradas.</p>";
			} else {
				foreach ($categorias as $categoria) {
					$id = $categoria->getId();
					$nome = $categoria->getNome();
					echo "
            <div class='col-md-3 col-sm-4'>
              <div class='checkbox'>
                <label>
                  <input type='checkbox' value='$id' name='categorias[]'> $nome
                </label>
              </div>
            </div>";
				}
			}
			?>
    </div>
    <div class="row">
      <h2 class="text-center text-uppercase">Tags</h2>
      <!-- Categorias -->
			<?php
			$tags = Tag_model::getTodosOsTags();
			if (is_string($tags[0])) {
				echo "<p>Não existem tags cadastradas.</p>";
			} else {
				foreach ($tags as $tag) {
					$id = $tag->getId();
					$nome = $tag->getNome();
					echo "
            <div class='col-md-3 col-sm-4'>
              <div class='checkbox'>
                <label>
                  <input type='checkbox' value='$id' name='tags[]'> $nome
                </label>
              </div>
            </div>";
				}
			}
			?>
    </div>
    <div class="row">
      <!-- Status -->
      <div class='form-group col-md-4'>
        <label class='control-label' for='status'>Status</label>
        <select id='status' name='status' class='form-control input-lg col-md-4'>
          <option value="1">Publicado</option>
          <option value="0">Rascunho</option>
        </select>
      </div>
    </div>
    <div class="clearfix"></div>
    <button type="submit" class="btn btn-lg btn-primary">Publicar</button>
  </form>

</div>
<script>
	$(document).ready(function () {
		$('#editor1').ckeditor();

		$('#input_imagem').change(function () {
			var img = 'tag_imagem';
			var input = 'input_imagem';
			gerarPreviaDaImagem(img, input);
		});

		/**
		 * Método que recebe o id da img onde sera colocado o preview e o id
		 * do input[type=file] e coloca uma previa da imagem que foi inserida 
		 * no input no src da img
		 * @param {string} img id da tag img que recebera a prévia
		 * @param {string} input id do input[type=file]
		 */
		function gerarPreviaDaImagem(img, input) {
			var preview = document.getElementById(img);
			var file = document.getElementById(input).files[0];
			var reader = new FileReader();

			reader.onloadend = function () {
				preview.src = reader.result;
			};

			if (file) {
				reader.readAsDataURL(file);
			} else {
				preview.src = "<?= base_url('assets') ?>/images/sem_imagem.jpeg";
			}
		}
	});
</script>
