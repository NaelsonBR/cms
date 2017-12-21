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
		$this->load->model('Helper');
	}

	public function index() {
			$s = Helper::gerarIdUnico();
			echo	"<p>$s</p>";
		
	}

	public function form_uploads() {
		$getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$imgs = $getpost['imgs'];
		echo "<pre>";
		var_dump($imgs);
		echo "</pre>";
	}

}
