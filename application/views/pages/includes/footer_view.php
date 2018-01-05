<footer class="bg-dark text-white">
		<div class="container">
				<div class="row">
						<div class="p-4 col-md-3">
								<h4 class="mb-4 text-light">Newsletter</h4>
								<form id="form_rodape">
										<fieldset class="form-group text-white">
												<label for="email_form_rodape">
														Cadastre-se e receba todas as novidades de suporte, atualizações, promoções e muito mais.
												</label>
												<input type="email" class="form-control" id="email_form_rodape" name="email" placeholder="Seu melhor email" required>
										</fieldset>
										<button type="submit" class="btn btn-outline-light">Enviar</button>
								</form>
								<div id="resposta_form_rodape"></div>
								<script>
										$(document).ready(function () {
												$('#form_rodape').submit(function () {
														var page = "<?=	base_url('pages/receber_form_rodape')	?>";
														var dados = jQuery(this).serialize();
														$.ajax({
																type: 'POST',
																dataType: 'html',
																url: page,
																beforeSend: function () {
																		$("#form_rodape .btn").prop('disabled', true);
																		$("#form_rodape .btn").html('Enviando <i class="fa fa-spinner fa-pulse fa-fw"></i>');
																},
																data: dados,
																success: function (msg) {
																		$("#form_rodape .btn").prop('disabled', false);
																		$("#form_rodape .btn").text('Enviar');
																		$('#resposta_form_rodape').html(msg);
																}
														});
														return false;
												});
										});
								</script>
						</div>
						<div class="p-4 col-md-3">
								<h4 class="mb-4" contenteditable="true">Vendas/Financeiro</h4>
								<p> Vendas </p>
								<p>
										<a href="tel:+551198195384" class="text-white">
												<i class="fa d-inline fa-phone text-white"></i> 
												<i class="fa d-inline mr-3 text-white fa-whatsapp"></i>
												<?=	Option_model::recuperarOption('telefone_1')	?> 
										</a>
								</p>
								<p> Financeiro </p>
								<p>
										<a href="tel:+551198195384" class="text-white">
												<i class="fa d-inline fa-phone text-white"></i>
												<i class="fa d-inline mr-3 text-white fa-whatsapp"></i>
												<?=	Option_model::recuperarOption('telefone_1')	?> 
										</a>
								</p>
						</div>
						<div class="p-4 col-md-3">
								<h4 class="mb-4">Visite-nos</h4>
								<p>
										<a href="tel:+246 - 542 550 5462" class="text-white">
												<i class="fa d-inline mr-3 fa-map-marker text-white"></i>
												<?=	Option_model::recuperarOption('endereco_empresa')	?> 
										</a>
								</p>
								<p>
										<a href="mailto:contato@mogigprs.com.br" class="text-white">
												<i class="fa d-inline mr-3 fa-envelope-o text-white"></i>
												contato@mogigprs.com.br
										</a>
								</p>
								<p>
										<a href="mailto:suporte@mogigprs.com.br" class="text-white">
												<i class="fa d-inline mr-3 fa-envelope-o text-white"></i>
												suporte@mogigprs.com.br
										</a>
								</p>
								<p>
										<a href="mailto:vendas@mogigprs.com.br" class="text-white">
												<i class="fa d-inline mr-3 fa-envelope-o text-white"></i>
												vendas@mogigprs.com.br
										</a>
								</p>
						</div>
						<div class="p-4 col-md-3">
								<h4 class="mb-4">Siga-nos</h4>
								<p class="text-center">
										<a href="<?=	Option_model::recuperarOption('link_rede_social_facebook')	?>" target="_blank">
												<i class="fa d-inline mx-1 text-dark bg-light fa-facebook-square fa-3x p-2 br50 footer_social"></i>
										</a>
										<a href="<?=	Option_model::recuperarOption('link_rede_social_twitter')	?>" target="_blank">
												<i class="fa d-inline mx-1 text-dark bg-light fa-twitter fa-3x p-2 br50 footer_social"></i>
										</a>
										<a href="<?=	Option_model::recuperarOption('link_rede_social_youtube')	?>" target="_blank">
												<i class="fa d-inline mx-1 fa-youtube bg-light text-dark fa-3x p-2 br50 footer_social"></i>
										</a>
								</p>
						</div>
				</div>
				<div class="row">
						<div class="col-md-8 mt-3">
								<p class="text-left text-white">© Copyright 2017 MOGI GPRS Rastreamento Veicular - Todos os Direitos Reservados.</p>
						</div>
						<div class="col-md-4 mt-3">
								<p class="text-right text-white">
										Site feito por 
										<a href="http://passosweb.com/" class="footer_social link_passosweb" target="_blank">
												PassosWeb
										</a>
								</p>
						</div>
				</div>
		</div>
</footer>
<?=	Option_model::recuperarOption('tags')	?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>

</html>