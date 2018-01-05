<div id="tarja_topo">
		<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
						<div class="container">
								<div class="row">
										<div class="col-12">
												<li class="breadcrumb-item"><a href="<?=	base_url()	?>">Home</a></li>
												<li class="breadcrumb-item"><a href="<?=	base_url('noticias')	?>">Notícias</a></li>
												<li class="breadcrumb-item active" aria-current="page"><?=	$slug	?></li>
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
<?php	$noticia	=	Noticia_model::getObjNoticia($id_noticia)	?>
<?php	if	($noticia):	?>
		<div class="container">
				<div class="row">
						<div class="col-12">
								<h2 class="py-4"><?=	$noticia->getTitulo()	?></h2>
						</div>
				</div>
				<?php	if	(!empty($noticia->getImagem())):	?>
						<div class="row">
								<div class="col-12 text-center py-5">
										<img class="img-fluid mx-auto" src="<?=	base_url('assets/uploads')	?>/<?=	$noticia->getImagem()	?>"/>
								</div>
						</div>
				<?php	endif;	?>
				<div class="row">
								<div class="col-12 py-5">
												<?=	$noticia->getCorpo() ?>
								</div>
						</div>
		</div>
<?php	else:	?>
		<h2>Desculpe, notícia não encontrada</h2>
<?php	endif;	?>


