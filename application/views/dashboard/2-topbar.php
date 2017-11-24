<?php
//se chegou ate aqui é porque passou em todas as validações
$login_usuario = $this->session->userdata('login_usuario');
$id_usuario = Usuario_model::retornarIdInserindoLogin($login_usuario);
Usuario_model::atualizarUltimoAcesso($id_usuario);
$usuario = Usuario_model::getObjUsuario($id_usuario);
$datetime_cadastro_usuario = $usuario->getData_de_cadastro();
$data_cadastro_usuario = Data_model::retornarDataInserindoDateTime($datetime_cadastro_usuario);
$data_cadastro_usuario_exibicao = Data_model::converterDataUSAParaBR($data_cadastro_usuario);
$nome_usuario = $usuario->getNome();
$cargo_usuario = 'Administrador';
?>
<!-- Main Header -->
<header class="main-header">

  <!-- Logo -->
  <a href="<?= base_url('Dashboard/home') ?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>P</b>w</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Passos </b>Web</span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <?php /*
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
          <!-- Menu toggle button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-envelope-o"></i>
          <span class="label label-success">4</span>
          </a>
          <ul class="dropdown-menu">
          <li class="header">Você tem 4 mensagens</li>
          <li>
          <!-- inner menu: contains the messages -->
          <ul class="menu">
          <li><!-- start message -->
          <a href="#">
          <div class="pull-left">
          <!-- User Image -->
          <img src="<?= base_url('assets/admin/') ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
          </div>
          <!-- Message title and timestamp -->
          <h4>
          Time de suporte
          <small><i class="fa fa-clock-o"></i> 5 mins</small>
          </h4>
          <!-- The message -->
          <p>Eu preciso conversar com você.</p>
          </a>
          </li>
          <!-- end message -->
          </ul>
          <!-- /.menu -->
          </li>
          <li class="footer"><a href="#">Ver todas as mensagens</a></li>
          </ul>
          </li>
          <!-- /.messages-menu -->
         */ ?>

        <?php /* icone de notificações com dropdown 
          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
          <!-- Menu toggle button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-bell-o"></i>
          <span class="label label-warning">10</span>
          </a>
          <ul class="dropdown-menu">
          <li class="header">Você tem 10 notificações</li>
          <li>
          <!-- Inner Menu: contains the notifications -->
          <ul class="menu">
          <li><!-- start notification -->
          <a href="#">
          <i class="fa fa-users text-aqua"></i> 5 novos membros entraram hoje
          </a>
          </li>
          <!-- end notification -->
          </ul>
          </li>
          <li class="footer"><a href="#">Ver todas</a></li>
          </ul>
          </li>
         */ ?>

        <?php /* icone de tarefas em andamento com dropdown
          <!-- Tasks Menu -->
          <li class="dropdown tasks-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-flag-o"></i>
          <span class="label label-danger">9</span>
          </a>
          <ul class="dropdown-menu">
          <li class="header">Você tem 9 tarefas</li>
          <li>
          <!-- Inner menu: contains the tasks -->
          <ul class="menu">
          <li><!-- Task item -->
          <a href="#">
          <!-- Task title and progress text -->
          <h3>
          Meta de vendas do mês
          <small class="pull-right">80%</small>
          </h3>
          <!-- The progress bar -->
          <div class="progress xs">
          <!-- Change the css width attribute to simulate progress -->
          <div class="progress-bar progress-bar-aqua" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
          <span class="sr-only">80% Completa</span>
          </div>
          </div>
          </a>
          </li>
          <!-- end task item -->
          </ul>
          </li>
          <li class="footer">
          <a href="#">Ver todas as tarefas</a>
          </li>
          </ul>
          </li>
         */ ?>


        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            <img src="<?= base_url('assets/admin/') ?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs">
              <?php
              if (isset($nome_usuario) && $nome_usuario != "") {
                echo "$nome_usuario";
              } else {
                echo "Usuario indefinido";
              }
              ?>
            </span>
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              <img src="<?= base_url('assets/admin/') ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

              <p>
                <?php
                if (isset($nome_usuario) && $nome_usuario != "") {
                  echo "$nome_usuario";
                } else {
                  echo "Usuario indefinido";
                }
                if (isset($cargo_usuario) && $cargo_usuario != "") {
                  echo " - $cargo_usuario";
                }
                if (isset($data_de_cadastro_usuario)) {
                  echo "<small>Membro desde $data_de_cadastro_usuario</small>";
                }
                ?>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a id="btn_editar_perfil" class="btn btn-default btn-flat">Trocar senha</a>
              </div>
              <div class="pull-right">
                <a href="<?= base_url('sair') ?>" class="btn btn-danger btn-flat">Sair</a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
      </ul>
    </div>
  </nav>
</header>