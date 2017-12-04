<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Imagem_model extends CI_Model {

	//atributos
	private $id;
	private $imagem;
	private $titulo;
	private $texto_alternativo;
	private $data_cadastro;
	private $identificador;

	//construtor
	function __construct() {
		parent::__construct();
		// Helpers, libraries e models necessários
		$this->load->model('Conect_model');
		$this->load->model('Data_model');
	}

	//metodos estaticos

	/**
	 * Recebe o NOME da imagem e seus attr e os salva no banco de dados para que 
	 * possa ser recuperado em forma de objeto
	 */
	public static function cadastrarImagem($imagem, $titulo, $texto_alternativo, $data_cadastro, $identificador) {
		try {
			$con = Conect_model::conectar();
			//preparando a query
			$stmt = $con->prepare("INSERT INTO imagem
        (
          imagem, titulo, texto_alternativo, data_cadastro, identificador
        )
      VALUES(?, ?, ?, ?, ?)");

			//configurando os valores
			$stmt->bindParam(1, $imagem);
			$stmt->bindParam(2, $titulo);
			$stmt->bindParam(3, $texto_alternativo);
			$stmt->bindParam(4, $data_cadastro);
			$stmt->bindParam(5, $identificador);
			$stmt->execute();
			if ($stmt->rowCount() > 0) {
				return TRUE;
			} else {
				return FALSE;
			}
		} catch (Exception $exc) {
			echo $exc->getTraceAsString();
		}
	}

	public static function getObjImagem($id) {
		$con = Conect_model::conectar();
		$rs = $con->query("SELECT * FROM `imagem` WHERE id = '$id'");
		while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
			$objeto = new Imagem_model();
			$objeto->id = $row->id;
			$objeto->imagem = $row->imagem;
			$objeto->titulo = $row->titulo;
			$objeto->texto_alternativo = $row->texto_alternativo;
			$objeto->data_cadastro = $row->data_cadastro;
			$objeto->identificador = $row->identificador;
		}
		return $objeto;
	}

	public static function getObjImagemPeloIdentificador($identificador) {
		$con = Conect_model::conectar();
		$rs = $con->query("SELECT * FROM `imagem` WHERE identificador = '$identificador'");
		while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
			$objeto = new Imagem_model();
			$objeto->id = $row->id;
			$objeto->imagem = $row->imagem;
			$objeto->titulo = $row->titulo;
			$objeto->texto_alternativo = $row->texto_alternativo;
			$objeto->data_cadastro = $row->data_cadastro;
			$objeto->identificador = $row->identificador;
		}
		return $objeto;
	}

	public static function editarImagem($id, $imagem, $titulo, $texto_alternativo, $data_cadastro, $identificador) {
		$con = Conect_model::conectar();
		$select = $con->prepare("UPDATE `imagem` SET 
    `imagem` = :imagem, `titulo` = :titulo, `texto_alternativo` = :texto_alternativo, `data_cadastro` = :data_cadastro, `identificador` = :identificador
    WHERE `imagem`.`id` = :id");
		$select->bindParam(':imagem', $imagem);
		$select->bindParam(':titulo', $titulo);
		$select->bindParam(':texto_alternativo', $texto_alternativo);
		$select->bindParam(':data_cadastro', $data_cadastro);
		$select->bindParam(':identificador', $identificador);
		$select->bindParam(':id', $id);
		$select->execute();
		if ($select->rowCount() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public static function deleteImagem($id) {
		$con = Conect_model::conectar();
		$select = $con->prepare("DELETE FROM `imagem` WHERE `imagem`.`id` = :id");
		$select->bindParam(':id', $id);
		$select->execute();
		if ($select->rowCount() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public static function getTodosOsImagems() {
		$array[0] = "";
		$contador = 0;
		$con = Conect_model::conectar();
		$rs = $con->query("SELECT * FROM `imagem`");
		while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
			$id = $row->id;
			$obj = self::getObjImagem($id);
			$array[$contador] = $obj;
			$contador++;
		}
		return $array;
	}

	//getters
	function getId() {
		return $this->id;
	}

	function getImagem() {
		return $this->imagem;
	}

	function getTitulo() {
		return $this->titulo;
	}

	function getTexto_alternativo() {
		return $this->texto_alternativo;
	}

	function getData_cadastro() {
		return $this->data_cadastro;
	}

	function getIdentificador() {
		return $this->identificador;
	}

}
