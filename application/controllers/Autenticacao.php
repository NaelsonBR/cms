<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 */

/* codigo que impossibilita o acesso direto sem passar pela home */
defined('BASEPATH') OR exit('No direct script access allowed');
/* todo controller DEVE extender CI_Controller */

class Autenticacao extends CI_Controller {
	/* construtor da classe que carregar os principais helpers
	  que podem ser usados dentro de toda a classe */

	function __construct() {
		/* contrutor da classe pai */
		parent::__construct();
		/* abaixo deverão ser carregados helpers, libraries e models utilizados
		  por este controller */
		$this->load->model('Usuario_model');
		$this->load->model('GeradorDeSenha_model');
		/* helper de url */
		$this->load->helper('url');
		$this->load->library('session');
	}

	public function index() {
		$dados['titulo'] = 'Login';
		$this->load->view('dashboard/login_view', $dados);
	}
	
	public function autenticar() {
		$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$login = $getpost['login'];
		$senha = $getpost['senha'];
		$autenticado = Usuario_model::autenticaLogin($login, $senha);
		if ($autenticado) {
			//caso login_valido seja true faça....
			$num = GeradorDeSenha_model::gerarSenha(22);
			$novosdados = array(
				'token_usuario' => $num,
				'login_usuario' => $login,
				'esta_logado' => 'fga35ds4g8sd4g3g8weg7w987g9f8gre'
			);
			$this->session->set_userdata($novosdados);
			//redirecione-o para a tela inicial
			redirect("dashboard/autHome/$num");
		} else {
			$dados['msg_erro'] = "<p>Login ou senha inválidos, por favor tente novamente.</p>";
			$dados['titulo'] = 'Login';
			$this->load->view('dashboard/login_view', $dados);
		}
	}

	public function recuperar_senha() {
		echo "<p>metodo de recuperaçao de senha</p>";
	}

	public function novo_cadastro() {
		echo "<p>novo cadastro</p>";
	}

	public function sair() {
		$this->session->set_userdata(array());
		$this->session->sess_destroy();
		redirect('administracao');
		exit();
	}

}
