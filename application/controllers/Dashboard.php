<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
		/* contrutor da classe pai */
		parent::__construct();
		// aqui deverá ser carregado os helpers, libraries e models necessários
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('usuario_model');
		$this->load->model('Mensagem_model');
		$this->load->model('Data_model');
		$this->load->model('GeradorDeSenha_model');
		$this->load->model('Noticia_model');
		$this->load->model('Option_model');
		$this->load->model('Email_model');
		$this->load->model('Contato_model');
		$this->load->model('Arquivo_model');
		$this->load->model('Tag_model');
		$this->load->model('Categoria_model');
		$this->load->model('Noticia_categoria_model');
		$this->load->model('Noticia_tag_model');
	}

	/* Home - painel administrativo
	  ########################################################################## */

	public function index() {
		redirect('autenticacao');
	}

	public function autHome($tokenGet) {
		if ($this->session->userdata('token_usuario') == "") {
			redirect('autenticacao');
			exit();
		} else {
			$tokenSession = $this->session->userdata('token_usuario');
			if ($tokenGet != $tokenSession) {
				//se forem diferentes saia do sistema
				redirect('autenticacao');
				exit('Login não efetuado!!!');
			}
		}
		redirect('Dashboard/home');
	}

	public function home() {
		$logado = $this->session->userdata('esta_logado');
		if (!$logado) {
			exit('Aconteceu um erro ao se logar no sistema');
		}
		$op = $this->uri->segment(3);
		if ($op != "") {
			if ($op == 1) {
				$dados['msg'] = "Operação realizada com sucesso.";
				$dados['tipo'] = 'info';
				$this->load->view('dashboard/1-header');
				$this->load->view('dashboard/2-topbar');
				$this->load->view('dashboard/3-sidebar');
				$this->load->view('dashboard/4-content', $dados);
				$this->load->view('dashboard/5-configbar');
				$this->load->view('dashboard/6-footer');
			} else {
				$dados['msg'] = "Aconteceu um erro, se persistir informe ao WebMaster.";
				$dados['tipo'] = 'danger';
				$this->load->view('dashboard/1-header');
				$this->load->view('dashboard/2-topbar');
				$this->load->view('dashboard/3-sidebar');
				$this->load->view('dashboard/4-content', $dados);
				$this->load->view('dashboard/5-configbar');
				$this->load->view('dashboard/6-footer');
			}
		} else {
			$this->load->view('dashboard/1-header');
			$this->load->view('dashboard/2-topbar');
			$this->load->view('dashboard/3-sidebar');
			$this->load->view('dashboard/4-content');
			$this->load->view('dashboard/5-configbar');
			$this->load->view('dashboard/6-footer');
		}
	}

	public function verificaSessao() {
		$esta_logado = $this->session->userdata('esta_logado');
		$sessao = 'fga35ds4g8sd4g3g8weg7w987g9f8gre';
		if ($esta_logado != $sessao) {
			redirect('autenticacao');
			exit();
		}
	}

	/* Mensagens
	  ########################################################################### */

	public function todas_as_mensagens() {
		self::verificaSessao();
		$dados['menuAtivo'] = "msg";
		$dados['subMenuAtivo'] = "msg_01";
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/mensagem/todas_as_mensagens_view');
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	public function apagar_mensagem($id) {
		self::verificaSessao();
		$apagada = Mensagem_model::deleteMensagem($id);
		if ($apagada) {
			redirect(base_url('dashboard/home/1'));
		} else {
			redirect(base_url('dashboard/home/2'));
		}
	}

	public function msg_ult_30_dias() {
		self::verificaSessao();
		$dados['menuAtivo'] = "msg";
		$dados['subMenuAtivo'] = "msg_02";
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/mensagem/mensagens_ult_30_dias_view');
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	public function ler_mensagem($id) {
		self::verificaSessao();
		$dados['menuAtivo'] = "msg";
		$dados['subMenuAtivo'] = "";
		$dados['id_mensagem'] = $id;
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/mensagem/ler_mensagem_view', $dados);
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	public function responder_mensagem() {
		self::verificaSessao();
		$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$assunto = $getpost['assunto'];
		$mensagem = $getpost['editor1'];
		$destinatario = $getpost['destinatario'];

		$sucesso = Email_model::emailHTML($destinatario, $assunto, $mensagem);
		if ($sucesso) {
			$msg = "Resposta enviada com sucesso.";
			echo "
      <div class='row'>
        <div class='alert alert-info alert-dismissible fade in text-center' style='border: 1px solid blue;' role='alert'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>x</span>
          </button>
          <strong>$msg</strong> 
        </div>
      </div>";
		} else {
			$msg = "Aconteceu um erro ao enviar o email, se persistir informe ao administrador.";
			echo "
      <div class='row'>
        <div class='alert alert-info alert-dismissible fade in text-center' style='border: 1px solid blue;' role='alert'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>x</span>
          </button>
          <strong>$msg</strong> 
        </div>
      </div>";
		}
	}

	/* Contatos
	  ############################################################################ */

	public function listar_contatos() {
		self::verificaSessao();
		$dados['menuAtivo'] = "contatos";
		$dados['subMenuAtivo'] = "contatos_01";
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/contatos/gerenciar_contatos_view');
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	public function apagar_contato($id) {
		self::verificaSessao();
		$apagada = Contato_model::deleteContato($id);
		if ($apagada) {
			redirect(base_url('dashboard/home/1'));
		} else {
			redirect(base_url('dashboard/home/2'));
		}
	}

	/* Email
	  ########################################################################## */

	public function email_boas_vindas() {
		self::verificaSessao();
		$dados['menuAtivo'] = "email";
		$dados['subMenuAtivo'] = "email_01";
		$dados['legenda_do_form'] = "Email de boas vindas";
		$dados['label'] = "Email que será enviado para o usuário que se inscrever na newsletter";
		$dados['nome_option'] = "email_de_boas_vindas";
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/option/editar_option_text_area_view', $dados);
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	public function email_promocional() {
		self::verificaSessao();
		$dados['menuAtivo'] = "email";
		$dados['subMenuAtivo'] = "email_02";
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/email/email_promocional_view');
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	public function enviar_email_promocional() {
		self::verificaSessao();
		$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$assunto = $getpost['assunto'];
		$mensagem = $getpost['mensagem'];
		$contatos = Contato_model::getTodosOsContatos();
		foreach ($contatos as $contato) {
			$destinatario = $contato->getEmail();
			Email_model::emailHTML($destinatario, $assunto, $mensagem);
		}
		$msg = "Operação realizada com sucesso.";
		echo "
    <div class='row'>
      <div class='alert alert-info alert-dismissible fade in text-center' style='border: 1px solid blue;' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>x</span>
        </button>
        <strong>$msg</strong> 
      </div>
    </div>";
	}

	/* TagManager
	  ############################################################################ */

	public function gerenciar_tags() {
		self::verificaSessao();
		$dados['menuAtivo'] = "tag";
		$dados['subMenuAtivo'] = "tag_01";
		$dados['legenda_do_form'] = "Tags";
		$dados['label'] = "Tags de rastreio tipo google analytcs, facebook pixel etc. Elas serão inseridas no rodapé de seu site.";
		$dados['nome_option'] = "tags";
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/tagmanager/gerenciar_tags_de_rastreio_view', $dados);
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	/* notícias
	  ############################################################################ */

	public function nova_noticia() {
		self::verificaSessao();
		$dados['menuAtivo'] = "noticia";
		$dados['subMenuAtivo'] = "noticia_02";
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/noticias/nova_noticia_view');
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	public function salvar_nova_noticia() {
		self::verificaSessao();
		$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$titulo = $getpost['titulo'];
		$corpo = $getpost['corpo'];
		$imagem = Arquivo_model::salvarImagemRedimensinando($_FILES['imagem'], 1200, 900);
		$status = $getpost['status'];
		$visibilidade = 1;
		$categorias = $getpost['categorias'];
		$tags = $getpost['tags'];
		$token = GeradorDeSenha_model::gerarIdUnico();
		$login_autor = $this->session->userdata('login_usuario');
		$autor = Usuario_model::retornarIdInserindoLogin($login_autor);
		$data_cadastro = Data_model::retornarDataComHorario();
		$data_atualizacao = $data_cadastro;
		$ultimo_usuario_que_atualizou = $autor;
		$sucesso = Noticia_model::cadastrarNoticia($titulo, $corpo, $imagem, $status, $visibilidade, $token, $autor, $data_cadastro, $data_atualizacao, $ultimo_usuario_que_atualizou);
		$id_noticia = Noticia_model::recuperarIdInserindoToken($token);
		foreach ($categorias as $categoria) {
			Noticia_categoria_model::cadastrarNoticia_categoria($categoria, $id_noticia);
		}
		foreach ($tags as $tag) {
			Noticia_tag_model::cadastrarNoticia_tag($tag, $id_noticia);
		}
		if ($sucesso) {
			redirect(base_url('dashboard/home/1'));
		} else {
			redirect(base_url('dashboard/home/2'));
		}
	}

	public function todas_as_noticia() {
		self::verificaSessao();
		$dados['menuAtivo'] = "noticia";
		$dados['subMenuAtivo'] = "noticia_01";
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/noticias/gerenciar_noticia_view');
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	public function editar_noticia($id) {
		self::verificaSessao();
		$dados['menuAtivo'] = "";
		$dados['subMenuAtivo'] = "";
		$dados['id_noticia'] = $id;
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/noticias/editar_noticia_view', $dados);
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	public function salvar_noticia_editada() {
		self::verificaSessao();
		$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$id_noticia = $getpost['id'];
		$noticia = Noticia_model::getObjNoticia($id_noticia);
		$titulo = $getpost['titulo'];
		$corpo = $getpost['corpo'];
		$imagem_1 = $_FILES['imagem'];
		if (!empty($imagem_1["name"])) {
			Arquivo_model::apagarImagem($noticia->getImagem());
			$imagem = Arquivo_model::salvarImagemRedimensinando($imagem_1, 600, 450);
		} else {
			$imagem = $noticia->getImagem();
		}
		$status = $getpost['status'];
		$visibilidade = 1;
		if (isset($getpost['categorias'])) {
			$categorias = $getpost['categorias'];
		}
		if (isset($getpost['tags'])) {
			$tags = $getpost['tags'];
		}
		$token = $noticia->getToken();
		$login_editor = $this->session->userdata('login_usuario');
		$autor = $noticia->getAutor();
		$data_cadastro = $noticia->getData_cadastro();
		$data_atualizacao = Data_model::retornarDataComHorario();
		$ultimo_usuario_que_atualizou = Usuario_model::retornarIdInserindoLogin($login_editor);
		$sucesso = Noticia_model::editarNoticia($id_noticia, $titulo, $corpo, $imagem, $status, $visibilidade, $token, $autor, $data_cadastro, $data_atualizacao, $ultimo_usuario_que_atualizou);

		//apagando as categorias e tags antigas
		$catsAntigas = Noticia_categoria_model::getTodosOsNoticia_categorias($id_noticia);
		if (!is_string($catsAntigas[0])) {
			Noticia_categoria_model::apagarNoticia_categoriaPorNoticia($id_noticia);
		}
		$tagsAntigas = Noticia_tag_model::getTodosOsNoticia_tags($id_noticia);
		if (!is_string($tagsAntigas[0])) {
			Noticia_tag_model::apagarNoticia_tagPorNoticia($id_noticia);
		}

		//salvando as novas categorias e tags no banco
		if (count($categorias) > 0) {
			foreach ($categorias as $categoria) {
				Noticia_categoria_model::cadastrarNoticia_categoria($categoria, $id_noticia);
			}
		}

		foreach ($tags as $tag) {
			Noticia_tag_model::cadastrarNoticia_tag($tag, $id_noticia);
		}

		if ($sucesso) {
			redirect(base_url('dashboard/home/1'));
		} else {
			redirect(base_url('dashboard/home/2'));
		}
	}

	public function apagar_noticia($id) {
		$apagada = Noticia_model::deleteNoticia($id);
		if ($apagada) {
			echo "<script>javascript:history.back(-2)</script>";
		} else {
			redirect(base_url('dashboard/home/2'));
		}
	}

	/* notícias - tag
	  ############################################################################ */

	public function tag_noticia() {
		self::verificaSessao();
		$dados['menuAtivo'] = "noticia";
		$dados['subMenuAtivo'] = "noticia_04";
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/noticias/tag_noticia_view');
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	public function salvar_nova_tag() {
		self::verificaSessao();
		$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$nome = $getpost['nome'];
		$slug = $getpost['slug'];
		$descricao = $getpost['descricao'];

		$sucesso = Tag_model::cadastrarTag($nome, $slug, $descricao);
		if ($sucesso) {
			$msg = "Tag salva com sucesso";
			echo "
      <div class='row'>
        <div class='alert alert-info alert-dismissible fade in text-center' style='border: 1px solid blue;' role='alert'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>x</span>
          </button>
          <strong>$msg</strong>
        </div>
      </div>";
		} else {
			$msg = "Aconteceu um erro ao cadastrar no banco de dados, se persistir informe ao programador.";
			echo "
      <div class='row'>
        <div class='alert alert-danger alert-dismissible fade in text-center' style='border: 1px solid red;' role='alert'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>x</span>
          </button>
          <strong>$msg</strong>
        </div>
      </div>";
		}
	}

	public function apagar_tag($id) {
		//mostrar msg para o usuario que pode dar erro porque essa tag esta ligada a alguma noticia
		self::verificaSessao();
		$apagada = Tag_model::deleteTag($id);
		if ($apagada) {
			echo "<script>javascript:history.back(-2)</script>";
		} else {
			redirect(base_url('dashboard/home/2'));
		}
	}

	/* noticia - categoria
	  ############################################################################ */

	public function categoria_noticia() {
		self::verificaSessao();
		$dados['menuAtivo'] = "noticia";
		$dados['subMenuAtivo'] = "noticia_03";
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/noticias/tag_categoria_view');
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	public function salvar_nova_categoria() {
		self::verificaSessao();
		$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$nome = $getpost['nome'];
		$slug = $getpost['slug'];
		$descricao = $getpost['descricao'];

		$sucesso = Categoria_model::cadastrarCategoria($nome, $slug, $descricao);
		if ($sucesso) {
			$msg = "Categoria salva com sucesso.";
			echo "
      <div class='row'>
        <div class='alert alert-info alert-dismissible fade in text-center' style='border: 1px solid blue;' role='alert'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>x</span>
          </button>
          <strong>$msg</strong>
        </div>
      </div>";
		} else {
			$msg = "Aconteceu um erro ao cadastrar no banco de dados, se persistir informe ao programador.";
			echo "
      <div class='row'>
        <div class='alert alert-danger alert-dismissible fade in text-center' style='border: 1px solid red;' role='alert'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>x</span>
          </button>
          <strong>$msg</strong>
        </div>
      </div>";
		}
	}

	public function apagar_categoria($id) {
		self::verificaSessao();
		$apagada = Categoria_model::deleteCategoria($id);
		if ($apagada) {
			echo "<script>javascript:history.back(-2)</script>";
		} else {
			redirect(base_url('dashboard/home/2'));
		}
	}

	/* redes sociais
	  ########################################################################### */

	public function link_facebook() {
		self::verificaSessao();
		$dados['menuAtivo'] = "redes_sociais";
		$dados['subMenuAtivo'] = "redes_sociais_01";

		$dados['legenda_do_form'] = "Editar link do facebook";
		$dados['label'] = "Link do facebook de sua empresa";
		$dados['nome_option'] = "link_rede_social_facebook";
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/option/editar_option_input_text_view', $dados);
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	public function link_instagram() {
		self::verificaSessao();
		$dados['menuAtivo'] = "redes_sociais";
		$dados['subMenuAtivo'] = "redes_sociais_02";

		$dados['legenda_do_form'] = "Editar link do Instagram";
		$dados['label'] = "Link do Instagram de sua empresa";
		$dados['nome_option'] = "link_rede_social_instagram";
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/option/editar_option_input_text_view', $dados);
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	public function link_twitter() {
		self::verificaSessao();
		$dados['menuAtivo'] = "redes_sociais";
		$dados['subMenuAtivo'] = "redes_sociais_03";

		$dados['legenda_do_form'] = "Editar link do Twitter";
		$dados['label'] = "Link do Twitter de sua empresa";
		$dados['nome_option'] = "link_rede_social_twitter";
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/option/editar_option_input_text_view', $dados);
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	public function link_youtube() {
		self::verificaSessao();
		$dados['menuAtivo'] = "redes_sociais";
		$dados['subMenuAtivo'] = "redes_sociais_04";

		$dados['legenda_do_form'] = "Editar link do Youtube";
		$dados['label'] = "Link do Youtube de sua empresa";
		$dados['nome_option'] = "link_rede_social_youtube";
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/option/editar_option_input_text_view', $dados);
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	public function link_gplus() {
		self::verificaSessao();
		$dados['menuAtivo'] = "redes_sociais";
		$dados['subMenuAtivo'] = "redes_sociais_05";

		$dados['legenda_do_form'] = "Editar link do G+";
		$dados['label'] = "Link do G+ de sua empresa";
		$dados['nome_option'] = "link_rede_social_gplus";
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/option/editar_option_input_text_view', $dados);
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	public function link_linkedin() {
		self::verificaSessao();
		$dados['menuAtivo'] = "redes_sociais";
		$dados['subMenuAtivo'] = "redes_sociais_06";

		$dados['legenda_do_form'] = "Editar link do Linkedin";
		$dados['label'] = "Link do Linkedin de sua empresa";
		$dados['nome_option'] = "link_rede_social_linkedin";
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/option/editar_option_input_text_view', $dados);
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	/* Biblioteca de imagens
	  ########################################################################### */

	public function gerenciar_galeria() {
		self::verificaSessao();
		$dados['menuAtivo'] = "galeria";
		$dados['subMenuAtivo'] = "galeria_01";
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/galeria/gerenciar_galeria_view');
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	/* configurações gerais
	  ########################################################################## */

	public function editar_senha_usuario() {
		self::verificaSessao();
		$dados['menuAtivo'] = "config";
		$dados['subMenuAtivo'] = "config_03";
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/config/editar_senha_usuario_view');
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	public function trocar_senha_usuario() {
		self::verificaSessao();
		$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$senha_atual = $getpost['senha_atual'];
		$nova_senha = $getpost['senha_nova'];
		$login = $this->session->userdata('login_usuario');
		$autenticado = Usuario_model::autenticaLogin($login, $senha_atual);
		if ($autenticado) {
			$att = Usuario_model::atualizar_senha($login, $nova_senha);
			if ($att) {
				$this->load->view('dashboard/1-header');
				$this->load->view('dashboard/2-topbar');
				$this->load->view('dashboard/3-sidebar');
				$this->load->view('dashboard/4-content');
				$this->load->view('dashboard/5-configbar');
				$this->load->view('dashboard/6-footer');
				echo "  <script>
                  alert(\"Senha atualizada com sucesso.\");
                </script>";
			} else {
				$this->load->view('dashboard/1-header');
				$this->load->view('dashboard/2-topbar');
				$this->load->view('dashboard/3-sidebar');
				$this->load->view('dashboard/4-content');
				$this->load->view('dashboard/5-configbar');
				$this->load->view('dashboard/6-footer');
				echo "  <script>
                  alert(\"Erro ao atualizar a senha.\");
                </script>";
			}
		} else {
			$this->load->view('dashboard/1-header');
			$this->load->view('dashboard/2-topbar');
			$this->load->view('dashboard/3-sidebar');
			$this->load->view('dashboard/4-content');
			$this->load->view('dashboard/5-configbar');
			$this->load->view('dashboard/6-footer');
			echo "  <script>
                alert(\"Senha atual digitada incorretamente.\");
              </script>";
		}
	}

	public function editar_email_principal() {
		self::verificaSessao();
		$dados['menuAtivo'] = "config";
		$dados['subMenuAtivo'] = "config_01";
		$dados['legenda_do_form'] = "Email principal ";
		$dados['label'] = "Email que irá receber todas as mensagens enviadas de formulários no site";
		$dados['nome_option'] = "email_principal";
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/option/editar_option_input_text_view', $dados);
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	public function salvar_option() {
		self::verificaSessao();
		$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$valor = $getpost['valor_option'];
		$nome = $getpost['nome_option'];
		$sucesso = Option_model::atualizarOption($nome, $valor);
		if ($sucesso) {
			$msg = "Operação realizada com sucesso.";
			echo "
      <div class='row'>
        <div class='alert alert-info alert-dismissible fade in text-center' style='border: 1px solid blue;' role='alert'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>x</span>
          </button>
          <strong>$msg</strong> 
        </div>
      </div>";
		} else {
			$msg = "Aconteceu um erro ao salvar ou você tentou salvar sem editar nada, se persistir informe ao administrador.";
			echo "
      <div class='row'>
        <div class='alert alert-danger alert-dismissible fade in text-center' style='border: 1px solid blue;' role='alert'>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>x</span>
          </button>
          <strong>$msg</strong> 
        </div>
      </div>";
		}
	}

	public function editar_nome_da_empresa() {
		self::verificaSessao();
		$dados['menuAtivo'] = "config";
		$dados['subMenuAtivo'] = "config_02";
		$dados['legenda_do_form'] = "Nome da empresa";
		$dados['label'] = "Nome de empresa dona deste site.";
		$dados['nome_option'] = "nome_da_empresa";
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/option/editar_option_input_text_view', $dados);
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	/* modo de manutenção
	  ########################################################################## */

	public function site_em_manutencao() {
		self::verificaSessao();
		$dados['menuAtivo'] = "config";
		$dados['subMenuAtivo'] = "config_04";
		$dados['ativo'] = Option_model::recuperarOption('manutencao');
		$this->load->view('dashboard/1-header');
		$this->load->view('dashboard/2-topbar');
		$this->load->view('dashboard/3-sidebar', $dados);
		$this->load->view('dashboard/4-content-open');
		$this->load->view('dashboard/telas/manutencao/manutencao_view', $dados);
		$this->load->view('dashboard/4-content-close');
		$this->load->view('dashboard/5-configbar');
		$this->load->view('dashboard/6-footer');
	}

	public function ativar_modo_manutencao() {
		self::verificaSessao();
		$nome = "manutencao";
		$valor = TRUE;
		Option_model::atualizarOption($nome, $valor);
		redirect(base_url('dashboard/site_em_manutencao'));
	}

	public function desativar_modo_manutencao() {
		self::verificaSessao();
		$nome = "manutencao";
		$valor = FALSE;
		Option_model::atualizarOption($nome, $valor);
		redirect(base_url('dashboard/site_em_manutencao'));
	}

}
