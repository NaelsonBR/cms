<div id="tarja_topo">
		<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
						<div class="container">
								<div class="row">
										<div class="col-12">
												<li class="breadcrumb-item"><a href="<?=	base_url()	?>">Home</a></li>
												<li class="breadcrumb-item active" aria-current="page">Contato</li>
										</div>
								</div>
						</div>
				</ol>
		</nav>
		<div class="container">
				<div class="row">
						<div class="col-12">
								<h1>Contato</h1>
						</div>
				</div>
		</div>
</div>
<div class="container">
		<div class="row">
				<div class="col-12">
						<div class="embed-responsive embed-responsive-21by9">
								<iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d468034.6826368661!2d-46.62765922607378!3d-23.585642465365837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cdd81269172647%3A0xb3859ba7fe8bbb07!2sMogi+das+Cruzes+-+SP!5e0!3m2!1spt-BR!2sbr!4v1492125751086"></iframe>
						</div>
				</div>
		</div>
</div>
<div class="container">
		<div class="row py-5">
				<div class="col-md-6">
						<h3 class="text-primary mb-5">Envie-nos uma mensagem</h3>
						<form id="form_contato">
								<div class="form-group">
										<label for="nome">Nome *</label>
										<input type="text" class="form-control" id="nome" placeholder="Seu nome" name="nome" required>
								</div>
								<div class="form-group">
										<label for="email">Email *</label>
										<input type="email" class="form-control" id="email" placeholder="seu-email@exemplo.com" name="email" required>
								</div>
								<div class="form-group">
										<label for="assunto">Assunto</label>
										<input type="text" class="form-control" id="assunto" placeholder="O assunto da mensagem" name="assunto">
								</div>
								<div class="form-group">
										<label for="mensagem">Mensagem *</label>
										<textarea rows="8" id="mensagem" placeholder="Digite aqui sua mensagem" name="mensagem" class="form-control" required></textarea>
								</div>
								<button type="submit" class="btn btn-lg btn-primary">Enviar</button>
						</form>
						<div id="resposta_form_contato"></div>
						<script>
								$(document).ready(function () {
										$('#form_contato').submit(function () {
												var page = "<?=	base_url('pages/receber_form_contato')	?>";
												var dados = jQuery(this).serialize();
												$.ajax({
														type: 'POST',
														dataType: 'html',
														url: page,
														beforeSend: function () {
																$("#form_contato .btn").html('Enviando <i class="fa fa-spinner fa-pulse fa-fw"></i>');
																$("#form_contato .btn").prop('disabled', true);
														},
														data: dados,
														success: function (msg) {
																$("#form_contato .btn").prop('disabled', false);
																$("#form_contato .btn").text('Enviar');
																$("#resposta_form_contato").append(msg);
														}
												});
												return false;
										});
								});
						</script>
				</div>
				<div class="col-md-6">
						<h3 class="text-primary mb-5">Entre em contato</h3>
						<ul class="unstyled">
								<li>
										<i class="fa fa-map-marker mr-3 mb-3"></i><?=	Option_model::recuperarOption('endereco_empresa') ?> 
								</li>
								<li>
										<i class="fa fa-phone-square mr-3 mb-3"></i><span><?=	Option_model::recuperarOption('telefone_1') ?> </span>
								</li>
								<li>
										<i class="fa fa-phone-square mr-3 mb-3"></i><span><?=	Option_model::recuperarOption('telefone_2') ?> </span>
								</li>
								<li>
										<i class="fa fa-envelope-o mr-3 mb-3"></i>
										<a href="mailto:contato@mogigprs.com.br" class="text-dark">contato@mogigprs.com.br</a>
								</li>
								<li>
										<i class="fa fa-envelope-o mr-3 mb-3"></i>
										<a href="mailto:suporte@mogigprs.com.br" class="text-dark">suporte@mogigprs.com.br</a>
								</li>
								<li>
										<i class="fa fa-envelope-o mr-3 mb-3"></i>
										<a href="mailto:vendas@mogigprs.com.br" class="text-dark">vendas@mogigprs.com.br</a>
								</li>
								<li>
										<p>Atendimento ao cliente de seg a sex das 9 as 17 exceto feriados!</p>
								</li>
						</ul>
				</div>
		</div>
</div>