<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Painel de controle | <?php Option_model::recuperarOption('nome_da_empresa') ?></title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.6 -->
		<link rel="stylesheet" href="<?= base_url('assets/admin/') ?>bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		<!-- jvectormap -->
		<link rel="stylesheet" href="<?= base_url('assets/admin/') ?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="<?= base_url('assets/admin/') ?>dist/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
				 folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="<?= base_url('assets/admin/') ?>dist/css/skins/_all-skins.min.css">
		<!-- flat css -->
		<link href="<?= base_url('assets/admin/') ?>plugins/iCheck/flat/blue.css" rel="stylesheet">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- jQuery 2.2.3 -->
		<script src="<?= base_url('assets/admin/') ?>plugins/jQuery/jquery.js"></script>
		<!-- Bootstrap 3.3.6 -->
		<script src="<?= base_url('assets/admin/') ?>bootstrap/js/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src="<?= base_url('assets/admin/') ?>plugins/fastclick/fastclick.js"></script>
		<!-- AdminLTE App -->
		<script src="<?= base_url('assets/admin/') ?>dist/js/app.min.js"></script>
		<!-- iCheck -->
		<script src="<?= base_url('assets/admin/') ?>plugins/iCheck/icheck.js"></script>
		<!-- imagem uploader -->
		<script type="text/javascript" src="<?= base_url('assets') ?>/admin/plugins/dmuploader/dmuploader.min.js"></script>
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
