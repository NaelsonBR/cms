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
