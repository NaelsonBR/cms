<div id="tarja_topo">
		<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
						<div class="container">
								<div class="row">
										<div class="col-12">
												<li class="breadcrumb-item"><a href="<?=	base_url()	?>">Home</a></li>
												<li class="breadcrumb-item active" aria-current="page">Notícias</li>
										</div>
								</div>
						</div>
				</ol>
		</nav>
		<div class="container">
				<div class="row">
						<div class="col-12">
								<h1>Notícias</h1>
						</div>
				</div>
		</div>
</div>
<div class="container" style="min-height: 600px;">
		<div class="row">
				<?php
				$noticias	=	Noticia_model::getNoticiasAtivas();
				?>
				<?php	if	(!empty($noticias[0])):	?>
						<?php	foreach	($noticias	as	$noticia):	?>
								<div class="col-md-4">
										<div class="card mb-3">
												<div class="card-header">
														<?php	if	(!empty($noticia->getImagem())):	?>
																<img class="img-fluid" src="<?=	base_url('assets/uploads/')	?><?=	$noticia->getImagem()	?>"/>
														<?php	else:	?>
																<img class="img-fluid" src="<?=	base_url('assets/images/sem_imagem.jpg')	?>"/>
														<?php	endif;	?>
												</div>
												<div class="card-body">
														<h4><?=	Helper::criarResumo($noticia->getTitulo(),	24)	?></h4>
														<h6 class="text-muted">
																<?=	Helper::DataUSA_to_BR(Helper::retornarDataInserindoDateTime($noticia->getData_cadastro()))	?>
														</h6>
														<p class=" p-y-1">
																<?=	Helper::criarResumo($noticia->getCorpo(),	100)	?>
														</p>
														<p class="text-center">
																<a href="<?=	base_url('noticia')	?>/<?=	$noticia->getId()	?>/<?=	Helper::criarSlug($noticia->getTitulo())	?>" class="btn btn-primary btn-lg">Leia mais</a>
														</p>
												</div>
										</div>
								</div>
						<?php	endforeach;	?>
				<?php	else:	?>
						<h3>Não existem notícias a serem exibidas no momento.</h3>
				<?php	endif;	?>


		</div>
</div>