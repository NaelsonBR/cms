<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
		<!-- Main content -->
		<section class="content">

				<?php
				//se precisar passar alguma msg ao usuario faça-o por aqui.
				if	(isset($msg)	&&	$msg	!=	"")	{
						echo	"
											<div class='row'>
												<div class='alert alert-$tipo alert-dismissible fade in text-center' style='border: 1px solid blue;' role='alert'>
													<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
														<span aria-hidden='true'>x</span>
													</button>
													<strong>$msg</strong> 
												</div>
											</div>";
				}
				?>
				<h1>Painel administrativo</h1>
				<br>
				<div class="row">

						<div class="col-md-3 col-sm-6 col-xs-12">
								<div class="info-box">
										<span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
										<div class="info-box-content">
												<span class="info-box-text">Mensagens não lidas</span>
												<span class="info-box-number"><?=	Mensagem_model::contarMsgsNaoLidas()	?></span>
										</div>
										<!-- /.info-box-content -->
								</div>
								<!-- /.info-box -->
						</div>

						<div class="col-md-3 col-sm-6 col-xs-12">
								<div class="info-box">
										<span class="info-box-icon bg-red"><i class="fa fa-bar-chart"></i></span>
										<div class="info-box-content">
												<span class="info-box-text">Visitas nos últimos 30 dias</span>
												<span class="info-box-number"><?=	Visualizacoes_model::countVisualizacoes() ?></span>
										</div>
										<!-- /.info-box-content -->
								</div>
								<!-- /.info-box -->
						</div>

						<div class="col-md-3 col-sm-6 col-xs-12">
								<div class="info-box">
										<span class="info-box-icon bg-yellow"><i class="ion ion-person-add"></i></span>
										<div class="info-box-content">
												<span class="info-box-text">Contatos cadastrados nos <br> últimos 30 dias</span>
												<span class="info-box-number"><?=	Contato_model::contarCadastrosUltMes()	?></span>
										</div>
										<!-- /.info-box-content -->
								</div>
								<!-- /.info-box -->
						</div>

						<div class="col-md-3 col-sm-6 col-xs-12">
								<div class="info-box">
										<span class="info-box-icon bg-blue"><i class="fa fa-address-book"></i></span>
										<div class="info-box-content">
												<span class="info-box-text">Contatos cadastrados</span>
												<span class="info-box-number"><?=	Contato_model::contarContatos()	?></span>
										</div>
										<!-- /.info-box-content -->
								</div>
								<!-- /.info-box -->
						</div>

				</div>



		</section>
		<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Main Footer -->
<footer class="main-footer">
		<!-- Default to the left -->
		<strong>
				Copyright &copy; <?php	echo	date('Y')	?>
				<a href="http://passosweb.com/">
						PassosWeb
				</a>.
		</strong> Todos os direitos reservados.

		<!-- To the right -->
		<div class="pull-right hidden-xs">
				<?php
				$nome_empresa	=	Option_model::recuperarOption('nome_da_empresa');
				if	(isset($nome_empresa)	&&	$nome_empresa	!=	'')	{
						echo	"$nome_empresa";
				}
				?>
		</div>
</footer>