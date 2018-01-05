<div id="tarja_topo">
		<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
						<div class="container">
								<div class="row">
										<div class="col-12">
												<li class="breadcrumb-item"><a href="<?=	base_url()	?>">Home</a></li>
												<li class="breadcrumb-item active" aria-current="page">Empresa</li>
										</div>
								</div>
						</div>
				</ol>
		</nav>
		<div class="container">
				<div class="row">
						<div class="col-12">
								<h1>Empresa</h1>
						</div>
				</div>
		</div>
</div>
<div class="container">
		<div class="row">
				<div class="col-12">
						<?=	Option_model::recuperarOption('pagina_empresa')	?>
				</div>
		</div>
</div>