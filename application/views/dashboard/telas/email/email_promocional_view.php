<div class="container-fluid">
		<div class="row">
				<h3>Email promocional</h3>
				<p>
						Essa opção enviará um email promocional para todos os seus contatos cadastrados.
				</p>
				<p class="text-danger">
						Você <b>DEVE </b>ter um servidor de e-mails configurado em seu site para poder usar essa opção. Confirme com sua agência antes de usar.
				</p>
				<p class="text-blue">
						Dependendo do tamanho da sua lista de contatos e da velocidade de seu 
						provedor de e-mails essa operação poderá demorar alguns minutos. Então é 
						normal que o sistema fique um tempo processando após você clicar em <b>Enviar</b>.
				</p>
				<form method="post" id="form_email_promocional">
						<?php
						$csrf_name	=	$this->security->get_csrf_token_name();
						$csrf_hash	=	$this->security->get_csrf_hash();
						echo	"<input type='hidden' name='$csrf_name' value='$csrf_hash' />";
						?>
						<div class="form-group">
								<label for="input_titulo">Assunto</label>
								<input type="text" class="form-control input-lg" id="input_titulo" 
															placeholder="Digite o assunto do email" name="assunto">

						</div>
						<div class="form-group">
								<label for="editor1">Corpo do email</label>
								<textarea name="mensagem" id="editor1" rows="10" cols="80">
								</textarea>
						</div>
						<button type="submit" class="btn btn-lg btn-primary">Enviar</button>
				</form>
		</div>
</div>
<br>
<div id="recipiente"></div>
<script>
		$(document).ready(function () {
				$('#editor1').ckeditor();
				$('#form_email_promocional').submit(function () {
						var page = "<?=	base_url('Dashboard/enviar_email_promocional')	?>";
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
										$("#recipiente").html(msg);
										$("#carregando_animado").hide('fast');
								}
						});
						return false;
				});

		});
</script>
