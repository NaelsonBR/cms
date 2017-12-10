<?php

/*
	* Autor: Peterson Passos
	* peterson.jfp@gmail.com
	* 51 9921298121
	*/

defined('BASEPATH')	OR	exit('No direct script access allowed');

class	Noticia_model	extends	CI_Model	{

		//atributos
		private	$id;
		private	$titulo;
		private	$corpo;
		private	$imagem;
		private	$status;
		private	$visibilidade;
		private	$token;
		private	$autor;
		private	$data_cadastro;
		private	$data_atualizacao;
		private	$ultimo_usuario_que_atualizou;

		//construtor
		function	__construct()	{
				parent::__construct();
				// Helpers, libraries e models necessários
				$this->load->model('Conect_model');
				$this->load->model('Helper');
				$this->load->model('Noticia_tag_model');
				$this->load->model('Noticia_categoria_model');
		}

		//metodos estaticos
		public	static	function	cadastrarNoticia($titulo,	$corpo,	$imagem,	$status,	$visibilidade,	$token,	$autor,	$data_cadastro,	$data_atualizacao,	$ultimo_usuario_que_atualizou)	{
				try	{
						$con	=	Conect_model::conectar();
						//preparando a query
						$stmt	=	$con->prepare("INSERT INTO noticia
        (
          titulo, corpo, imagem, status, visibilidade, token, autor, data_cadastro, data_atualizacao, ultimo_usuario_que_atualizou
        )
      VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

						//configurando os valores
						$stmt->bindParam(1,	$titulo);
						$stmt->bindParam(2,	$corpo);
						$stmt->bindParam(3,	$imagem);
						$stmt->bindParam(4,	$status);
						$stmt->bindParam(5,	$visibilidade);
						$stmt->bindParam(6,	$token);
						$stmt->bindParam(7,	$autor);
						$stmt->bindParam(8,	$data_cadastro);
						$stmt->bindParam(9,	$data_atualizacao);
						$stmt->bindParam(10,	$ultimo_usuario_que_atualizou);
						$stmt->execute();
						if	($stmt->rowCount()	>	0)	{
								return	TRUE;
						}	else	{
								return	FALSE;
						}
				}	catch	(Exception	$exc)	{
						echo	$exc->getTraceAsString();
				}
		}

		public	static	function	getObjNoticia($id)	{
				$con	=	Conect_model::conectar();
				$rs	=	$con->query("SELECT * FROM `noticia` WHERE id = '$id'");
				while	($row	=	$rs->fetch(PDO::FETCH_OBJ))	{
						$objeto	=	new	Noticia_model();
						$objeto->id	=	$row->id;
						$objeto->titulo	=	$row->titulo;
						$objeto->corpo	=	$row->corpo;
						$objeto->imagem	=	$row->imagem;
						$objeto->status	=	$row->status;
						$objeto->visibilidade	=	$row->visibilidade;
						$objeto->token	=	$row->token;
						$objeto->autor	=	$row->autor;
						$objeto->data_cadastro	=	$row->data_cadastro;
						$objeto->data_atualizacao	=	$row->data_atualizacao;
						$objeto->ultimo_usuario_que_atualizou	=	$row->ultimo_usuario_que_atualizou;
				}
				return	$objeto;
		}

		public	static	function	editarNoticia($id,	$titulo,	$corpo,	$imagem,	$status,	$visibilidade,	$token,	$autor,	$data_cadastro,	$data_atualizacao,	$ultimo_usuario_que_atualizou)	{
				$con	=	Conect_model::conectar();
				$select	=	$con->prepare("UPDATE `noticia` SET 
    `titulo` = :titulo, `corpo` = :corpo, `imagem` = :imagem, `status` = :status, `visibilidade` = :visibilidade, `token` = :token, `autor` = :autor, `data_cadastro` = :data_cadastro, `data_atualizacao` = :data_atualizacao, `ultimo_usuario_que_atualizou` = :ultimo_usuario_que_atualizou
    WHERE `noticia`.`id` = :id");
				$select->bindParam(':titulo',	$titulo);
				$select->bindParam(':corpo',	$corpo);
				$select->bindParam(':imagem',	$imagem);
				$select->bindParam(':status',	$status);
				$select->bindParam(':visibilidade',	$visibilidade);
				$select->bindParam(':token',	$token);
				$select->bindParam(':autor',	$autor);
				$select->bindParam(':data_cadastro',	$data_cadastro);
				$select->bindParam(':data_atualizacao',	$data_atualizacao);
				$select->bindParam(':ultimo_usuario_que_atualizou',	$ultimo_usuario_que_atualizou);
				$select->bindParam(':id',	$id);
				$select->execute();
				if	($select->rowCount()	>	0)	{
						return	TRUE;
				}	else	{
						return	FALSE;
				}
		}

		public	static	function	deleteNoticia($id)	{
				$noticia	=	self::getObjNoticia($id);
				//deleter a imagem
				Helper::apagarImagem($noticia->getImagem());

				//deletar ligações com categorias
				Noticia_categoria_model::apagarNoticia_categoriaPorNoticia($noticia->getId());

				//deletar ligacoes com tags
				Noticia_tag_model::apagarNoticia_tagPorNoticia($noticia->getId());

				//deletar registro do banco
				$con	=	Conect_model::conectar();
				$select	=	$con->prepare("DELETE FROM `noticia` WHERE `noticia`.`id` = :id");
				$select->bindParam(':id',	$id);
				$select->execute();
				if	($select->rowCount()	>	0)	{
						return	TRUE;
				}	else	{
						return	FALSE;
				}
		}

		public	static	function	getTodosOsNoticias()	{
				$array[0]	=	"";
				$contador	=	0;
				$con	=	Conect_model::conectar();
				$rs	=	$con->query("SELECT * FROM `noticia` ORDER by data_cadastro DESC");
				while	($row	=	$rs->fetch(PDO::FETCH_OBJ))	{
						$id	=	$row->id;
						$obj	=	self::getObjNoticia($id);
						$array[$contador]	=	$obj;
						$contador++;
				}
				return	$array;
		}

		public	static	function	recuperarIdInserindoToken($token)	{
				$con	=	Conect_model::conectar();
				$rs	=	$con->query("SELECT * FROM `noticia` WHERE `token` = '$token'");
				while	($row	=	$rs->fetch(PDO::FETCH_OBJ))	{
						$id	=	$row->id;
				}
				return	$id;
		}

		//getters
		function	getId()	{
				return	$this->id;
		}

		function	getTitulo()	{
				return	$this->titulo;
		}

		function	getCorpo()	{
				return	$this->corpo;
		}

		function	getImagem()	{
				return	$this->imagem;
		}

		function	getStatus()	{
				return	$this->status;
		}

		function	getVisibilidade()	{
				return	$this->visibilidade;
		}

		function	getToken()	{
				return	$this->token;
		}

		function	getAutor()	{
				return	$this->autor;
		}

		function	getData_cadastro()	{
				return	$this->data_cadastro;
		}

		function	getData_atualizacao()	{
				return	$this->data_atualizacao;
		}

		function	getUltimo_usuario_que_atualizou()	{
				return	$this->ultimo_usuario_que_atualizou;
		}

}
