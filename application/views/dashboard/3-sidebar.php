<?php
$menu = "";
$submenu = '';
$submenu2 = '';
if (isset($menuAtivo) && $menuAtivo != "") {
	$menu = $menuAtivo;
}
if (isset($subMenuAtivo) && $subMenuAtivo != "") {
	$submenu = $subMenuAtivo;
}
if (isset($subMenuAtivo2) && $subMenuAtivo2 != "") {
	$submenu2 = $subMenuAtivo2;
}
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">

		<!-- Sidebar user panel (optional) -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?= base_url('assets/admin/') ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>
					<?php
					if (Option_model::recuperarOption('nome_da_empresa') && Option_model::recuperarOption('nome_da_empresa') != "") {
						echo Option_model::recuperarOption('nome_da_empresa');
					} else {
						echo "Administrador";
					}
					?>
				</p>
				<!-- Status -->
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">
			<li class="header">Menu</li>
			<!-- Optionally, you can add icons to the links -->

			<li class="treeview <?= ($menu == 'msg') ? 'active' : ''; ?>" >
				<a href="#"><i class="fa fa-comment" aria-hidden="true"></i> <span>Mensagens</span>
					<span class="pull-right-container">
						<?php
						$msgNaoLida = Mensagem_model::contarMsgsNaoLidas();
						if ($msgNaoLida > 0) {
							echo "<small class='label pull-left bg-red'>$msgNaoLida</small>";
						}
						?>
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li <?= ($submenu == 'msg_01') ? 'class="active"' : ''; ?>>
						<a href="<?= base_url('Dashboard/todas_as_mensagens') ?>">Todas as mensagens</a>
					</li>
					<li <?= ($submenu == 'msg_02') ? 'class="active"' : ''; ?>>
						<a href="<?= base_url('Dashboard/msg_ult_30_dias') ?>">Últimos 30 dias</a>
					</li>
				</ul>
			</li>

			<li class="treeview <?= ($menu == 'contatos') ? 'active' : ''; ?>">
				<a href="#"><i class="fa fa-address-book-o" aria-hidden="true"></i> <span>Contatos</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li <?= ($submenu == 'contatos_01') ? 'class="active"' : ''; ?>>
						<a href="<?= base_url('Dashboard/listar_contatos') ?>">Listar contatos</a>
					</li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span>Editar site</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="#">Pagina 1</a></li>
					<li><a href="#">Pagina 2</a></li>
					<li><a href="#">Pagina 3</a></li>
					<li><a href="#">Pagina 4</a></li>
					<li><a href="#">Pagina 5</a></li>
				</ul>
			</li>

			<li class="treeview <?= ($menu == 'email') ? 'active' : ''; ?>">
				<a href="#"><i class="fa fa fa-envelope-open" aria-hidden="true"></i> <span>Email</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li <?= ($submenu == 'email_01') ? 'class="active"' : ''; ?>>
						<a href="<?= base_url('Dashboard/email_boas_vindas') ?>">Email de boas vindas</a>
					</li>
					<li <?= ($submenu == 'email_02') ? 'class="active"' : ''; ?>>
						<a href="<?= base_url('Dashboard/email_promocional') ?>">Email promocional</a>
					</li>
				</ul>
			</li>

			<li class="treeview <?= ($menu == 'tag') ? 'active' : ''; ?>">
				<a href="#"><i class="fa fa-tags" aria-hidden="true"></i><span>TagManager</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li <?= ($submenu == 'tag_01') ? 'class="active"' : ''; ?>>
						<a href="<?= base_url('Dashboard/gerenciar_tags') ?>">Gerenciar tags</a>
					</li>
				</ul>
			</li>

			<li class="treeview <?= ($menu == 'noticia') ? 'active' : ''; ?>">
				<a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Notícias</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li <?= ($submenu == 'noticia_01') ? 'class="active"' : ''; ?>>
						<a href="<?= base_url('Dashboard/todas_as_noticia') ?>">Todas as notícias</a>
					</li>
					<li <?= ($submenu == 'noticia_02') ? 'class="active"' : ''; ?>>
						<a href="<?= base_url('Dashboard/nova_noticia') ?>">Nova Notícia</a>
					</li>
					<li <?= ($submenu == 'noticia_03') ? 'class="active"' : ''; ?>>
						<a href="<?= base_url('Dashboard/categoria_noticia') ?>">Categorias</a>
					</li>
					<li <?= ($submenu == 'noticia_04') ? 'class="active"' : ''; ?>>
						<a href="<?= base_url('Dashboard/tag_noticia') ?>">Tags</a>
					</li>
				</ul>
			</li>

			<li class="treeview <?= ($menu == 'redes_sociais') ? 'active' : ''; ?>">
				<a href="#"><i class="fa fa-share-alt-square" aria-hidden="true"></i> <span>Redes sociais</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li <?= ($submenu == 'redes_sociais_01') ? 'class="active"' : ''; ?>>
						<a href="<?= base_url('Dashboard/link_facebook') ?>"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a>
					</li>
					<li <?= ($submenu == 'redes_sociais_02') ? 'class="active"' : ''; ?>>
						<a href="<?= base_url('Dashboard/link_instagram') ?>"><i class="fa fa-instagram" aria-hidden="true"></i>Instagram</a>
					</li>
					<li <?= ($submenu == 'redes_sociais_03') ? 'class="active"' : ''; ?>>
						<a href="<?= base_url('Dashboard/link_twitter') ?>"><i class="fa fa-twitter" aria-hidden="true"></i>Twitter</a>
					</li>
					<li <?= ($submenu == 'redes_sociais_04') ? 'class="active"' : ''; ?>>
						<a href="<?= base_url('Dashboard/link_youtube') ?>"><i class="fa fa-youtube" aria-hidden="true"></i>Youtube</a>
					</li>
					<li <?= ($submenu == 'redes_sociais_05') ? 'class="active"' : ''; ?>>
						<a href="<?= base_url('Dashboard/link_gplus') ?>"><i class="fa fa-google-plus" aria-hidden="true"></i>Google Plus</a>
					</li>
					<li <?= ($submenu == 'redes_sociais_06') ? 'class="active"' : ''; ?>>
						<a href="<?= base_url('Dashboard/link_linkedin') ?>"><i class="fa fa-linkedin" aria-hidden="true"></i>Linkedin</a>
					</li>
				</ul>
			</li>

			<li class="treeview <?= ($menu == 'galeria') ? 'active' : ''; ?>">
				<a href="#"><i class="fa fa-file-image-o"></i> <span>Galeria de imagens</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li <?= ($submenu == 'galeria_01') ? 'class="active"' : ''; ?>>
						<a href="<?= base_url('Dashboard/gerenciar_galeria') ?>">Gerenciar galeria</a>
					</li>
				</ul>
			</li>

			<li class="treeview <?= ($menu == 'config') ? 'active' : ''; ?>">
				<a href="#"><i class="fa fa-wrench" aria-hidden="true"></i> <span>Configurações</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li <?= ($submenu == 'config_01') ? 'class="active"' : ''; ?>>
						<a href="<?= base_url('Dashboard/editar_email_principal') ?>">Email principal</a>
					</li>
					<li <?= ($submenu == 'config_02') ? 'class="active"' : ''; ?>>
						<a href="<?= base_url('Dashboard/editar_nome_da_empresa') ?>">Nome da empresa</a>
					</li>
					<li <?= ($submenu == 'config_03') ? 'class="active"' : ''; ?>>
						<a href="<?= base_url('Dashboard/editar_senha_usuario') ?>">Trocar sua senha</a>
					</li>
					<li <?= ($submenu == 'config_04') ? 'class="active"' : ''; ?>>
						<a href="<?= base_url('Dashboard/site_em_manutencao') ?>"><span>Modo de manutenção</span></a>
					</li>
				</ul>
			</li>
			<li><a href="<?= base_url() ?>" target="_blank"><i class="fa fa-eye"></i> <span>Visualizar site</span></a></li>
			<li>
				<a href="<?= base_url('sair') ?>"><i class="fa fa-power-off"></i> <span style="color: red;">Sair do sistema</span></a>
			</li>
		</ul>
		<style>
			ul.sidebar-menu li{
				cursor: pointer;
			}
		</style>
		<!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>