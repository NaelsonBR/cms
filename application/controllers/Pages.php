<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    function __construct() {
        /* contrutor da classe pai */
        parent::__construct();
        // aqui deverá ser carregado os helpers, libraries e models necessários.
        $this->load->helper('url');
        $this->load->model('Visualizacoes_model');
        $this->load->model('Helper');
        $this->load->model('Mensagem_model');
        $this->load->model('Email_model');
        $this->load->model('Contato_model');
        $this->load->model('Noticia_model');
    }

    public function index() {
        Helper::verificaManutencao();
        Visualizacoes_model::insertVisualizacoes(1, '', '', '', Helper::getDatetime());
        $dados['menu_ativo'] = 'home';
        $this->load->view('pages/includes/header_view', $dados);
        $this->load->view('pages/home_view');
        $this->load->view('pages/includes/footer_view');
    }

    public function planos() {
        Helper::verificaManutencao();
        Visualizacoes_model::insertVisualizacoes(2, '', '', '', Helper::getDatetime());
        $dados['menu_ativo'] = 'planos';
        $this->load->view('pages/includes/header_view', $dados);
        $this->load->view('pages/planos_view');
        $this->load->view('pages/includes/footer_view');
    }

    public function contato() {
        Helper::verificaManutencao();
        Visualizacoes_model::insertVisualizacoes(3, '', '', '', Helper::getDatetime());
        $dados['menu_ativo'] = 'contato';
        $this->load->view('pages/includes/header_view', $dados);
        $this->load->view('pages/contato_view');
        $this->load->view('pages/includes/footer_view');
    }

    public function parceiros() {
        Helper::verificaManutencao();
        Visualizacoes_model::insertVisualizacoes(4, '', '', '', Helper::getDatetime());
        $dados['menu_ativo'] = 'parceiros';
        $this->load->view('pages/includes/header_view', $dados);
        $this->load->view('pages/parceiros_view');
        $this->load->view('pages/includes/footer_view');
    }

    public function empresa() {
        Helper::verificaManutencao();
        Visualizacoes_model::insertVisualizacoes(5, '', '', '', Helper::getDatetime());
        $dados['menu_ativo'] = 'empresa';
        $this->load->view('pages/includes/header_view', $dados);
        $this->load->view('pages/empresa_view');
        $this->load->view('pages/includes/footer_view');
    }

    public function noticias() {
        Helper::verificaManutencao();
        Visualizacoes_model::insertVisualizacoes(6, '', '', '', Helper::getDatetime());
        $dados['menu_ativo'] = 'noticias';
        $this->load->view('pages/includes/header_view', $dados);
        $this->load->view('pages/noticias_view');
        $this->load->view('pages/includes/footer_view');
    }

    public function noticia($id_noticia, $slug = 'default') {
        Helper::verificaManutencao();
        Visualizacoes_model::insertVisualizacoes(6, $id_noticia, '', '', Helper::getDatetime());
        $dados['menu_ativo'] = 'noticias';
        $dados['id_noticia'] = $id_noticia;
        $dados['slug'] = $slug;
        $this->load->view('pages/includes/header_view', $dados);
        $this->load->view('pages/noticia_view', $dados);
        $this->load->view('pages/includes/footer_view');
    }

    /* Funções auxiliares
      ############################################################### */

    public function receber_form_contato() {
        $getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $nome = $getpost['nome'];
        $email = $getpost['email'];
        $assunto = $getpost['assunto'];
        $msg = $getpost['mensagem'];
        $mensagem = "Nome: $nome<br />Email: $email: <br />Assunto: $assunto<br />Mensagem: $msg";

        Mensagem_model::cadastrarMensagem($nome, '', $email, $assunto, $mensagem, Helper::getDatetime(), 0);
        try {
            $assunto_2 = 'Mensagem do formulario de contato do site';
            $destinatario = Option_model::recuperarOption('email_principal');
            Email_model::emailHTML($destinatario, $assunto_2, $mensagem);
        } catch (Exception $exc) {
            
        }

        echo "<div class='alert alert-info mt-3' role='alert'>
										<strong>Mensagem recebida com sucesso, em breve entraremos em contato.</strong>
								</div>";
    }

    public function receber_form_rodape() {
        $getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $email = $getpost['email'];
        Contato_model::cadastrarContato('', '', $email, Helper::getDatetime(), 1);
        echo "<script>alert('Seu email foi cadastrado com sucesso em nossa newsletter');</script>";
    }

    public function manutencao() {
        $this->load->view('pages/manutencao_view');
    }

}
