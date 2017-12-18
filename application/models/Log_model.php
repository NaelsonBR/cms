<?php

/*
	* Autor: Peterson Passos
	* peterson.jfp@gmail.com
	* 51 9921298121
	*/

defined('BASEPATH')	OR	exit('No direct script access allowed');

class	Log_model	extends	CI_Model	{

		//atributos
		//###########################################################################
		private	$id;
		private	$arquivo;
		private	$log;
		private	$data;

		//construtor
		//###########################################################################
		function	__construct()	{
				parent::__construct();
				// Helpers, libraries e models necessários
				$this->load->model('Autoload_model');
		}

		//metodos estaticos
		//###########################################################################

		/**
			* Cria um novo registro na tabela Log
			*/
		public	static	function	insertLog($arquivo,	$log)	{
				try	{
						$data = Data_model::retornarDataComHorario();
						$con	=	Conect_model::conectar();
						//preparando a query
						$stmt	=	$con->prepare("INSERT INTO log
								(
										arquivo, log, data
								)
						VALUES(?, ?, ?)");

						//configurando os valores
						$stmt->bindParam(1,	$arquivo);
						$stmt->bindParam(2,	$log);
						$stmt->bindParam(3,	$data);
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

		/**
			* Busca o registro que representa o objeto Log cujo id é passado
			* no banco de dados, monta o objeto e o retorna.
			*/
		public	static	function	getObjLog($id)	{
				$con	=	Conect_model::conectar();
				$rs	=	$con->query("SELECT * FROM `log` WHERE id = '$id'");
				while	($row	=	$rs->fetch(PDO::FETCH_OBJ))	{
						$objeto	=	new	Log_model();
						$objeto->id	=	$row->id;
						$objeto->arquivo	=	$row->arquivo;
						$objeto->log	=	$row->log;
						$objeto->data	=	$row->data;
				}
				return	$objeto;
		}

		/**
			* Atualiza o registro de um objeto Log existente no banco de dados
			*/
		public	static	function	updateLog($id,	$arquivo,	$log,	$data)	{
				$con	=	Conect_model::conectar();
				$select	=	$con->prepare("UPDATE `log` SET 
    `arquivo` = :arquivo, `log` = :log, `data` = :data
    WHERE `log`.`id` = :id");
				$select->bindParam(':arquivo',	$arquivo);
				$select->bindParam(':log',	$log);
				$select->bindParam(':data',	$data);
				$select->bindParam(':id',	$id);
				$select->execute();
				if	($select->rowCount()	>	0)	{
						return	TRUE;
				}	else	{
						return	FALSE;
				}
		}

		/**
			* Deleta de forma definitiva o registro do objeto Log cujo id é passado
			*/
		public	static	function	deleteLog($id)	{
				$con	=	Conect_model::conectar();
				$select	=	$con->prepare("DELETE FROM `log` WHERE `log`.`id` = :id");
				$select->bindParam(':id',	$id);
				$select->execute();
				if	($select->rowCount()	>	0)	{
						return	TRUE;
				}	else	{
						return	FALSE;
				}
		}

		/**
			* Retorna um array de objetos Log contendo todos os registros que estão no
			* banco de dados na tabela Log
			*/
		public	static	function	getAllLog()	{
				$array[0]	=	"";
				$contador	=	0;
				$con	=	Conect_model::conectar();
				$rs	=	$con->query("SELECT * FROM `log`");
				while	($row	=	$rs->fetch(PDO::FETCH_OBJ))	{
						$objeto	=	new	Log_model();
						$objeto->id	=	$row->id;
						$objeto->arquivo	=	$row->arquivo;
						$objeto->log	=	$row->log;
						$objeto->data	=	$row->data;
						$array[$contador]	=	$objeto;
						$contador++;
				}
				return	$array;
		}

		/**
			* Conta todos os registros da tabela Log e retorna um INT o resultado.
			*/
		public	static	function	countLog()	{
				$con	=	Conect_model::conectar();
				$rs	=	$con->query("SELECT * FROM `log`");
				return	$rs->rowCount();
		}

		//metodos da classe
		//###########################################################################

		/**
			* Atualiza o registro do objeto atual no banco de dados.
			*/
		public	function	autoSave()	{
				$id	=	$this->id;
				$arquivo	=	$this->arquivo;
				$log	=	$this->log;
				$data	=	$this->data;
				$con	=	Conect_model::conectar();
				$select	=	$con->prepare("UPDATE `log` SET 
    `arquivo` = :arquivo, `log` = :log, `data` = :data
    WHERE `log`.`id` = :id");
				$select->bindParam(':arquivo',	$arquivo);
				$select->bindParam(':log',	$log);
				$select->bindParam(':data',	$data);
				$select->bindParam(':id',	$id);
				$select->execute();
				if	($select->rowCount()	>	0)	{
						return	TRUE;
				}	else	{
						return	FALSE;
				}
		}

		//getters
		//###########################################################################
		function	getId()	{
				return	$this->id;
		}

		function	getArquivo()	{
				return	$this->arquivo;
		}

		function	getLog()	{
				return	$this->log;
		}

		function	getData()	{
				return	$this->data;
		}

		//setters
		//###########################################################################
		function	setArquivo($arquivo)	{
				$this->arquivo	=	$arquivo;
		}

		function	setLog($log)	{
				$this->log	=	$log;
		}

		function	setData($data)	{
				$this->data	=	$data;
		}

}
