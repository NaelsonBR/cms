<?php
/*
	* Autor: Peterson Passos
	* peterson.jfp@gmail.com
	* 51 9921298121
	*/
$valor	=	Option_model::recuperarOption($nome_option);
?>
<h1><?=	$legenda_do_form	?></h1>
<form method="post" id="form_option">
		<?php
		$csrf_name = $this->security->get_csrf_token_name();
		$csrf_hash = $this->security->get_csrf_hash();
		echo	"<input type='hidden' name='$csrf_name' value='$csrf_hash' />";
		?>
		<label for="input_1"><?=	$label	?></label>
		<input type="text" class="form-control" id="input_1" value="<?=	$valor	?>" name="valor_option">
		<input type="hidden" value="<?=	$nome_option	?>" name="nome_option">
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
						var page = "<?=	base_url('dashboard/salvar_option')	?>";
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
										$("#resposta").prepend(msg);
										$("#carregando_animado").hide('fast');
								}
						});
						return false;
				});
		});
</script>