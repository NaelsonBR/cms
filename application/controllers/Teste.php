<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Teste extends CI_Controller {

	function __construct() {
		/* contrutor da classe pai */
		parent::__construct();
		// aqui deverá ser carregado os helpers, libraries e models necessários.
		$this->load->model('Data_model');
		$this->load->helper('url');
		$this->load->model('GeradorDeSenha_model');
		$this->load->model('Email_model');
		$this->load->model('Arquivo_model');
		$this->load->model('Imagem_model');
	}

	public function index() {
		$this->load->helper('data_functions');
		echo "<p>oiueeee</p>";
		pedirBacon();
		echo ENVIRONMENT;
	}

	public function receberFoto() {
		$imagem = Arquivo_model::salvarImagemRedimensinando($_FILES['imagem'], 1200, 900);
		$identificador = GeradorDeSenha_model::gerarIdUnico();
		Imagem_model::cadastrarImagem($imagem, "", "", Data_model::retornarDataComHorario(), $identificador);
		$objImagem = Imagem_model::getObjImagemPeloIdentificador($identificador);
		$id = $objImagem->getId();
		echo "$id";
	}

	public function form_uploads() {
		$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$imgs = $getpost['imgs'];
		echo "<pre>";
		var_dump($imgs);
		echo "</pre>";
	}

}
