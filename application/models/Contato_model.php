<?php

/*
	* Autor: Peterson Passos
	* peterson.jfp@gmail.com
	* 51 9921298121
	*/

defined('BASEPATH')	OR	exit('No direct script access allowed');

class	Contato_model	extends	CI_Model	{

		//atributos
		private	$id;
		private	$nome;
		private	$telefone;
		private	$email;
		private	$data_de_cadastro;
		private	$email_confirmado;

		//construtor
		function	__construct()	{
				parent::__construct();
				// Helpers, libraries e models necessários
				$this->load->model('Conect_model');
				$this->load->model('Helper');
		}

		//metodos estaticos
		public	static	function	cadastrarContato($nome,	$telefone,	$email,	$data_de_cadastro,	$email_confirmado)	{
				try	{
						if	(self::contatoJaCadastrado($email))	{
								return	TRUE;
						}	else	{
								$con	=	Conect_model::conectar();
								//preparando a query
								$stmt	=	$con->prepare("INSERT INTO contato
												(
														nome, telefone, email, data_de_cadastro, email_confirmado
												)
										VALUES(?, ?, ?, ?, ?)");

								//configurando os valores
								$stmt->bindParam(1,	$nome);
								$stmt->bindParam(2,	$telefone);
								$stmt->bindParam(3,	$email);
								$stmt->bindParam(4,	$data_de_cadastro);
								$stmt->bindParam(5,	$email_confirmado);
								$stmt->execute();
								if	($stmt->rowCount()	>	0)	{
										$email_de_boas_vindas = Option_model::recuperarOption('email_de_boas_vindas');
										if	($email_de_boas_vindas)	{
												$destinatario = $email;
												$assunto = 'Bem vindo a nossa newsletter';
												$mensagem = $email_de_boas_vindas;
												Email_model::emailHTML($destinatario,	$assunto,	$mensagem);
										}
										return	TRUE;
								}	else	{
										return	FALSE;
								}
						}
				}	catch	(Exception	$exc)	{
						echo	$exc->getTraceAsString();
				}
		}

		public	static	function	getObjContato($id)	{
				$con	=	Conect_model::conectar();
				$rs	=	$con->query("SELECT * FROM `contato` WHERE id = '$id'");
				while	($row	=	$rs->fetch(PDO::FETCH_OBJ))	{
						$objeto	=	new	Contato_model();
						$objeto->id	=	$row->id;
						$objeto->nome	=	$row->nome;
						$objeto->telefone	=	$row->telefone;
						$objeto->email	=	$row->email;
						$objeto->data_de_cadastro	=	$row->data_de_cadastro;
						$objeto->email_confirmado	=	$row->email_confirmado;
				}
				return	$objeto;
		}

		public	static	function	editarContato($id,	$nome,	$telefone,	$email,	$data_de_cadastro,	$email_confirmado)	{
				$con	=	Conect_model::conectar();
				$select	=	$con->prepare("UPDATE `contato` SET 
								`nome` = :nome, `telefone` = :telefone, `email` = :email, `data_de_cadastro` = :data_de_cadastro, `email_confirmado` = :email_confirmado
								WHERE `contato`.`id` = :id");
				$select->bindParam(':nome',	$nome);
				$select->bindParam(':telefone',	$telefone);
				$select->bindParam(':email',	$email);
				$select->bindParam(':data_de_cadastro',	$data_de_cadastro);
				$select->bindParam(':email_confirmado',	$email_confirmado);
				$select->bindParam(':id',	$id);
				$select->execute();
				if	($select->rowCount()	>	0)	{
						return	TRUE;
				}	else	{
						return	FALSE;
				}
		}

		public	static	function	deleteContato($id)	{
				$con	=	Conect_model::conectar();
				$select	=	$con->prepare("DELETE FROM `contato` WHERE `contato`.`id` = :id");
				$select->bindParam(':id',	$id);
				$select->execute();
				if	($select->rowCount()	>	0)	{
						return	TRUE;
				}	else	{
						return	FALSE;
				}
		}

		public	static	function	getTodosOsContatos()	{
				$array[0]	=	"";
				$contador	=	0;
				$con	=	Conect_model::conectar();
				$rs	=	$con->query("SELECT * FROM `contato` WHERE email_confirmado = '1'");
				while	($row	=	$rs->fetch(PDO::FETCH_OBJ))	{
						$id	=	$row->id;
						$obj	=	self::getObjContato($id);
						$array[$contador]	=	$obj;
						$contador++;
				}
				return	$array;
		}

		public	static	function	contarContatos()	{
				$con	=	Conect_model::conectar();
				$select	=	$con->query("SELECT * FROM `contato` WHERE email_confirmado = '1'");
				$n	=	count($select->fetchAll(PDO::FETCH_ASSOC));	//contar linhas
				return	$n;
		}

		public	static	function	contarCadastrosUltMes()	{
				$hoje	=	Helper::getData();
				$mesPassaso	=	Helper::adicionarDiasAUmaData($hoje,	-30);
				$dateTime	=	Helper::getDatetime();
				$hora	=	Helper::retornarHoraInserindoDateTime($dateTime);
				$datetimeMespassado	=	"$mesPassaso $hora";
				$con	=	Conect_model::conectar();
				$select	=	$con->query("SELECT * FROM `contato` WHERE data_de_cadastro > '$datetimeMespassado' AND email_confirmado = '1'");
				$n	=	count($select->fetchAll(PDO::FETCH_ASSOC));	//contar linhas
				return	$n;
		}

		public	static	function	contatoJaCadastrado($email)	{
				$con	=	Conect_model::conectar();
				$select	=	$con->prepare("SELECT * FROM `contato` WHERE email = :email");
				$select->bindParam(':email',	$email);
				$select->execute();
				$n	=	count($select->fetchAll(PDO::FETCH_ASSOC));
				if	($n	>	0)	{
						return	TRUE;
				}	else	{
						return	FALSE;
				}
		}

		//getters
		function	getId()	{
				return	$this->id;
		}

		function	getNome()	{
				return	$this->nome;
		}

		function	getTelefone()	{
				return	$this->telefone;
		}

		function	getEmail()	{
				return	$this->email;
		}

		function	getData_de_cadastro()	{
				return	$this->data_de_cadastro;
		}

		function	getEmail_confirmado()	{
				return	$this->email_confirmado;
		}

}
