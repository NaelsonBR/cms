<h1 class='text-uppercase text-center'>Categorias</h1>
<div class="col-md-5">
		<h3 class='text-center'>Adicionar categoria</h3>
		<form method='post' id='form_cadastrar_tag'>
				<?php
				$csrf_name	=	$this->security->get_csrf_token_name();
				$csrf_hash	=	$this->security->get_csrf_hash();
				echo	"<input type='hidden' name='$csrf_name' value='$csrf_hash' />";
				?>
				<fieldset>
						<!-- Nome -->
						<div class='form-group'>
								<label class='control-label' for='nome'>Nome</label>
								<input id='nome' name='nome' type='text' placeholder='Nome' class='form-control input-md' required>
						</div>
						<p>O nome é como aparece em seu site.</p>
						<!-- Slug -->
						<div class='form-group'>
								<label class='control-label' for='slug'>Slug</label>  
								<input id='slug' name='slug' type='text' placeholder='Slug' class='form-control input-md' required>
						</div>
						<p>O “slug” é uma versão amigável do URL. Normalmente, é todo em minúsculas e contém apenas letras, números e hífens.</p>

						<!-- Descricao -->
						<div class='form-group'>
								<label class='control-label' for='descricao'>Descrição</label>
								<textarea class='form-control input-md' placeholder="Descrição" id='descricao' name='descricao' rows='6'></textarea>
						</div>
						<p>Cadastre a descrição da categoria somente se sua intenção for de mostrá-la no front-end de seu site.</p>
						<br><button type='submit' class='btn btn-lg btn-primary'>Publicar</button>
				</fieldset>
		</form>
		<br>
		<div class='container'>
				<div class='row'>
						<div id='resposta'></div>
				</div>
		</div>
		<script>
				$(document).ready(function () {
						$('#form_cadastrar_tag').submit(function () {
								var page = "<?=	base_url('dashboard/salvar_nova_categoria')	?>";
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
												window.location.reload();
										}
								});
								return false;
						});
				});
		</script>
</div>
<div class="col-md-7">
		<h3 class='text-center'>Lista de categorias cadastradas</h3>
		<?php
		$categorias	=	Categoria_model::getTodosOsCategorias();
		if	(is_string($categorias[0]))	{
				echo	"<p>Não existem categorias cadastradas</p>";
		}	else	{
				echo	"<div class='box'>";
				echo	"<div class='box-body'>";
				echo	'<table id="tabela1" class="table table-striped table-bordered table-hover">
												<thead>
														<tr>
																<th>Nome</th>
																<th>Slug</th>
																<th>Descrição</th>
																<th width="130px"></th>
														</tr>
												</thead>
												<tbody>';
				foreach	($categorias	as	$categoria)	{
						$id	=	$categoria->getId();
						$nome	=	$categoria->getNome();
						$slug	=	$categoria->getSlug();
						$descricao	=	$categoria->getDescricao();
						$base	=	base_url('dashboard');
						echo	"  <tr>
																<td>$nome</td>
																<td>$slug</td>
																<td>$descricao</td>
																<td><a href='$base/apagar_categoria/$id' title='Apagar' class='btn btn-md btn-danger'>Apagar</a></td>
														</tr>";
				}
				echo	"  </tbody>
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
		?>
</div>

