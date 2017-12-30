<?php

/*
	* Autor: Peterson Passos
	* peterson.jfp@gmail.com
	* 51 9921298121
	*/

defined('BASEPATH')	OR	exit('No direct script access allowed');

class	Imagens	extends	CI_Controller	{

		function	__construct()	{
				/* contrutor da classe pai */
				parent::__construct();
				// aqui deverá ser carregado os helpers, libraries e models necessários.
		}

		public	function	index()	{
				echo	"<p>ola mundo</p>";
		}

		/**
			* se vc precisar mostrar na tela uma imagem redimensionada sob demanda aponte o src da img para 
		 *  base_url('imagens/thumbs').'/caminho_da_imagem-imagem.jpg/largura/altura'
			*/
		public	function	thumbs($imagem,	$largura,	$altura)	{
				$config['image_library']	=	'gd2';
				$config['source_image']	=	str_replace("-",	"/",	$imagem);
				$config['maintain_ratio']	=	true;
				$config['dynamic_output']	=	true;
				$config['width']	=	$largura;
				$config['quality']	=	"100%";
				$config['height']	=	$altura;
				$this->load->library('image_lib',	$config);
				$this->image_lib->resize();
		}

}
