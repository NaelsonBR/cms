<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">

		<?php
		//se precisar passar alguma msg ao usuario faça-o por aqui.
		if (isset($msg) && $msg != "") {
			echo "
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
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?= Mensagem_model::contarMsgsNaoLidas() ?></h3>
						<p>Mensagens não lidas</p>
					</div>
					<div class="icon">
						<i class="fa fa-envelope-o"></i>
					</div>
					<a href="<?= base_url('Dashboard/todas_as_mensagens') ?>" class="small-box-footer">
						Ler agora <i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>

			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3>440</h3>
						<p>Visitas nos últimos 30 dias</p>
					</div>
					<div class="icon">
						<i class="fa fa-bar-chart"></i>
					</div>
					<a href="#" class="small-box-footer">
						Mais informações <i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>

			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
						<h3><?= Contato_model::contarCadastrosUltMes() ?></h3>
						<p>Cadastros nos últimos 30 dias</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="#" class="small-box-footer">
						Mais informações <i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>

			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-blue">
					<div class="inner">
						<h3><?= Contato_model::contarContatos() ?></h3>
						<p>Total de contatos cadastrados</p>
					</div>
					<div class="icon">
						<i class="fa fa-address-book"></i>
					</div>
					<a href="#" class="small-box-footer">
						Mais informações <i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>

		</div>



	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Main Footer -->
<footer class="main-footer">


	<!-- To the right -->
	<div class="pull-right hidden-xs">
		<?php
		$nome_empresa = Option_model::recuperarOption('nome_da_empresa');
		if (isset($nome_empresa) && $nome_empresa != '') {
			echo "$nome_empresa";
		}
		?>
	</div>


	<!-- Default to the left -->
	<strong>
		Copyright &copy; <?php echo date('Y') ?>
		<a href="#">
			<?= Option_model::recuperarOption('nome_da_empresa') ?>
		</a>.
	</strong> Todos os direitos reservados.
</footer>