<?php

/*
	* Autor: Peterson Passos
	* peterson.jfp@gmail.com
	* 51 9921298121
	*/

defined('BASEPATH')	OR	exit('No direct script access allowed');

/**
	* tipos de visualização
  * 1 - Home
	*/
class	Visualizacoes_model	extends	CI_Model	{

		//atributos
		//###########################################################################
		private	$id;
		private	$tipo;
		private	$opcional_1;
		private	$opcional_2;
		private	$opcional_3;
		private	$data_de_visualizacao;

		//construtor
		//###########################################################################
		function	__construct()	{
				parent::__construct();
				// Helpers, libraries e models necessários
		}

		//metodos estaticos
		//###########################################################################

		/**
			* Cria um novo registro na tabela Visualizacoes
			*/
		public	static	function	insertVisualizacoes($tipo,	$opcional_1,	$opcional_2,	$opcional_3,	$data_de_visualizacao)	{
				try	{
						$con	=	Conect_model::conectar();
						//preparando a query
						$stmt	=	$con->prepare("INSERT INTO visualizacoes
        (
          tipo, opcional_1, opcional_2, opcional_3, data_de_visualizacao
        )
      VALUES(?, ?, ?, ?, ?)");

						//configurando os valores
						$stmt->bindParam(1,	$tipo);
						$stmt->bindParam(2,	$opcional_1);
						$stmt->bindParam(3,	$opcional_2);
						$stmt->bindParam(4,	$opcional_3);
						$stmt->bindParam(5,	$data_de_visualizacao);
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
			* Busca o registro que representa o objeto Visualizacoes cujo id é passado
			* no banco de dados, monta o objeto e o retorna.
			*/
		public	static	function	getObjVisualizacoes($id)	{
				$con	=	Conect_model::conectar();
				$rs	=	$con->query("SELECT * FROM `visualizacoes` WHERE id = '$id'");
				while	($row	=	$rs->fetch(PDO::FETCH_OBJ))	{
						$objeto	=	new	Visualizacoes_model();
						$objeto->id	=	$row->id;
						$objeto->tipo	=	$row->tipo;
						$objeto->opcional_1	=	$row->opcional_1;
						$objeto->opcional_2	=	$row->opcional_2;
						$objeto->opcional_3	=	$row->opcional_3;
						$objeto->data_de_visualizacao	=	$row->data_de_visualizacao;
				}
				return	$objeto;
		}

		/**
			* Atualiza o registro de um objeto Visualizacoes existente no banco de dados
			*/
		public	static	function	updateVisualizacoes($id,	$tipo,	$opcional_1,	$opcional_2,	$opcional_3,	$data_de_visualizacao)	{
				$con	=	Conect_model::conectar();
				$select	=	$con->prepare("UPDATE `visualizacoes` SET 
    `tipo` = :tipo, `opcional_1` = :opcional_1, `opcional_2` = :opcional_2, `opcional_3` = :opcional_3, `data_de_visualizacao` = :data_de_visualizacao
    WHERE `visualizacoes`.`id` = :id");
				$select->bindParam(':tipo',	$tipo);
				$select->bindParam(':opcional_1',	$opcional_1);
				$select->bindParam(':opcional_2',	$opcional_2);
				$select->bindParam(':opcional_3',	$opcional_3);
				$select->bindParam(':data_de_visualizacao',	$data_de_visualizacao);
				$select->bindParam(':id',	$id);
				$select->execute();
				if	($select->rowCount()	>	0)	{
						return	TRUE;
				}	else	{
						return	FALSE;
				}
		}

		/**
			* Deleta de forma definitiva o registro do objeto Visualizacoes cujo id é passado
			*/
		public	static	function	deleteVisualizacoes($id)	{
				$con	=	Conect_model::conectar();
				$select	=	$con->prepare("DELETE FROM `visualizacoes` WHERE `visualizacoes`.`id` = :id");
				$select->bindParam(':id',	$id);
				$select->execute();
				if	($select->rowCount()	>	0)	{
						return	TRUE;
				}	else	{
						return	FALSE;
				}
		}

		/**
			* Retorna um array de objetos Visualizacoes contendo todos os registros que estão no
			* banco de dados na tabela Visualizacoes
			*/
		public	static	function	getAllVisualizacoes()	{
				$array[0]	=	"";
				$contador	=	0;
				$con	=	Conect_model::conectar();
				$rs	=	$con->query("SELECT * FROM `visualizacoes`");
				while	($row	=	$rs->fetch(PDO::FETCH_OBJ))	{
						$objeto	=	new	Visualizacoes_model();
						$objeto->id	=	$row->id;
						$objeto->tipo	=	$row->tipo;
						$objeto->opcional_1	=	$row->opcional_1;
						$objeto->opcional_2	=	$row->opcional_2;
						$objeto->opcional_3	=	$row->opcional_3;
						$objeto->data_de_visualizacao	=	$row->data_de_visualizacao;
						$array[$contador]	=	$objeto;
						$contador++;
				}
				return	$array;
		}

		/**
			* Conta todos os registros da tabela Visualizacoes e retorna um INT o resultado.
			*/
		public	static	function	countVisualizacoes()	{
				$con	=	Conect_model::conectar();
				$rs	=	$con->query("SELECT * FROM `visualizacoes`");
				return	$rs->rowCount();
		}

		//metodos da classe
		//###########################################################################

		/**
			* Atualiza o registro do objeto atual no banco de dados.
			*/
		public	function	autoSave()	{
				$id	=	$this->id;
				$tipo	=	$this->tipo;
				$opcional_1	=	$this->opcional_1;
				$opcional_2	=	$this->opcional_2;
				$opcional_3	=	$this->opcional_3;
				$data_de_visualizacao	=	$this->data_de_visualizacao;
				$con	=	Conect_model::conectar();
				$select	=	$con->prepare("UPDATE `visualizacoes` SET 
    `tipo` = :tipo, `opcional_1` = :opcional_1, `opcional_2` = :opcional_2, `opcional_3` = :opcional_3, `data_de_visualizacao` = :data_de_visualizacao
    WHERE `visualizacoes`.`id` = :id");
				$select->bindParam(':tipo',	$tipo);
				$select->bindParam(':opcional_1',	$opcional_1);
				$select->bindParam(':opcional_2',	$opcional_2);
				$select->bindParam(':opcional_3',	$opcional_3);
				$select->bindParam(':data_de_visualizacao',	$data_de_visualizacao);
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

		function	getTipo()	{
				return	$this->tipo;
		}

		function	getOpcional_1()	{
				return	$this->opcional_1;
		}

		function	getOpcional_2()	{
				return	$this->opcional_2;
		}

		function	getOpcional_3()	{
				return	$this->opcional_3;
		}

		function	getData_de_visualizacao()	{
				return	$this->data_de_visualizacao;
		}

		//setters
		//###########################################################################
		function	setTipo($tipo)	{
				$this->tipo	=	$tipo;
		}

		function	setOpcional_1($opcional_1)	{
				$this->opcional_1	=	$opcional_1;
		}

		function	setOpcional_2($opcional_2)	{
				$this->opcional_2	=	$opcional_2;
		}

		function	setOpcional_3($opcional_3)	{
				$this->opcional_3	=	$opcional_3;
		}

		function	setData_de_visualizacao($data_de_visualizacao)	{
				$this->data_de_visualizacao	=	$data_de_visualizacao;
		}

}
