<!DOCTYPE html>
<html>

		<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
				<link rel="shortcut icon" href="<?= base_url('assets/') ?>images/icon.ico" >
				<link rel="stylesheet" href="<?=	base_url('assets/css/style.css')	?>" type="text/css">
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
				<title>MOGI GPRS</title>
		</head>

		<body>
				<nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
						<div class="container">
								<a class="navbar-brand" href="<?=	base_url()	?>">
										<img class="logo" id="header_logo" src="<?=	base_url('assets/images/logo.png')	?>" alt="Mogi GPRS"/>
								</a>
								<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false"
																aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
								<div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
										<ul class="navbar-nav">
												<li class="nav-item">
														<a class="nav-link text-primary <?=	($menu_ativo	==	'home')	?	'active'	:	'';	?>" href="<?=	base_url()	?>">
																Home
														</a>
												</li>
												<li class="nav-item">
														<a class="nav-link text-primary <?=	($menu_ativo	==	'empresa')	?	'active'	:	'';	?>" href="<?=	base_url('empresa')	?>">
																Empresa
														</a>
												</li>
												<li class="nav-item">
														<a class="nav-link text-primary <?=	($menu_ativo	==	'planos')	?	'active'	:	'';	?>" href="<?=	base_url('planos')	?>">
																Planos
														</a>
												</li>
												<li class="nav-item">
														<a class="nav-link text-primary <?=	($menu_ativo	==	'contato')	?	'active'	:	'';	?>" href="<?=	base_url('contato')	?>">
																Contato
														</a>
												</li>
												<li class="nav-item">
													<a class="nav-link text-primary <?=	($menu_ativo	==	'parceiros')	?	'active'	:	'';	?>" href="<?=	base_url('parceiros')	?>">
															Parceiros
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link text-primary" href="https://eshops.mercadolivre.com.br/MOGIGPRS+RASTREADORES" target="_blank">
															Loja
													</a>
												</li>
												<li class="nav-item">
														<a class="nav-link text-primary" href="http://5.189.151.226/login/883" target="_blank">
																Rastrear veículo
														</a>
												</li>
												<li class="nav-item dropdown">
														<a class="nav-link dropdown-toggle text-primary" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Links úteis</a>
														<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
																<a class="dropdown-item" href="<?=	base_url('noticias')	?>">
																		Notícias
																</a>
																<a class="dropdown-item" href="https://play.google.com/store/apps/details?id=com.mogiweb"target="_blank">
																		Mobile App
																</a>
																<a class="dropdown-item" href="http://www2.correios.com.br/sistemas/rastreamento/"target="_blank">
																		Rastrear Pedido
																</a>
														</div>
												</li>
										</ul>
								</div>
						</div>
				</nav>
				<script>
						$(document).ready(function () {
								var header = $(".header-wrapper"); // Variavel da Classe a ser modificada
								var container = $(".header-container"); // Variavel da Classe a ser modificada
								$(window).scroll(function () {
										var scroll = $(window).scrollTop();
										var logo = $('#header_logo');
										if (scroll >= 30) {
												if ($(document).width() > 768) {
														logo.css("width", "130px");
												}
										} else {
												if ($(document).width() > 768) {
														logo.css("width", "260px");
												}
										}
								});
						});
				</script>