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
		}

		public	function	index()	{
				Helper::verificaManutencao();
				echo	"<p>Index do controller pages</p>";
		}
		
		public	function	manutencao()	{
				$this->load->view('site/manutencao_view');
		}

}
