<?php

/*
	* Autor: Peterson Passos
	* peterson.jfp@gmail.com
	* 51 9921298121
	*/

defined('BASEPATH')	OR	exit('No direct script access allowed');

class	Pages	extends	CI_Controller	{

		function	__construct()	{
				/* contrutor da classe pai */
				parent::__construct();
				// aqui deverá ser carregado os helpers, libraries e models necessários.
				$this->load->helper('url');
				$this->load->model('Option_model');
				$this->load->model('Noticia_model');
				$this->load->model('Email_model');
				$this->load->model('Helper');
		}

		public	function	index()	{
				Helper::verificaManutencao();
				echo	"<p>ola mundo</p>";
		}
		
		public	function	manutencao()	{
				$this->load->view('site/manutencao_view');
		}

}
