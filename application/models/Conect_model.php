<?php

/* codigo que impossibilita o acesso direto sem passar pela home */
defined('BASEPATH')	OR	exit('No direct script access allowed');
/* todo controller DEVE extender CI_Controller */

class	Conect_model	extends	CI_Model	{
		/* construtor da classe que carregar os principais helpers
			 que podem ser usados dentro de toda a classe */

		function	__construct()	{
				/* contrutor da classe pai */
				parent::__construct();
				/* abaixo deverão ser carregados helpers, libraries e models utilizados
					 por este model */
		}

		public	static	function	conectar()	{
				$con	=	Conect_model::gerarPDO();
				return	$con;
		}

		private	static	function	gerarPDO()	{
				//verificando se é localhost ou produção
				$string	=	base_url();	//string a ser analisada
				$palavra	=	'localhost';	//palavra a ser buscada no meio da string
				$regex	=	'/'	.	$palavra	.	'/';	//formando a regex para ser buscada
				if	(preg_match($regex,	$string))	{
						//BANCO DE AMBIENTE LOCAL ##########
						//endereço do host
						$host	=	"localhost";
						//nome do banco de dados
						$banco	=	"cms";
						//login
						$login	=	"root";
						//senha
						$senha	=	"";
						//criando a conexão
						$con	=	new	PDO("mysql:host=$host;dbname=$banco",	"$login",	"$senha");
						return	$con;
				}		else	{
						//BANCO DE AMBIENTE PRODUÇÃO ##########
						//endereço do host
						$host	=	"";
						//nome do banco de dados
						$banco	=	"";
						//login
						$login	=	"";
						//senha
						$senha	=	"";
						//criando a conexão
						$con	=	new	PDO("mysql:host=$host;dbname=$banco",	"$login",	"$senha");
						return	$con;
				}
		}

}
