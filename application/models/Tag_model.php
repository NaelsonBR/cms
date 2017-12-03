<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Tag_model extends CI_Model {

	//atributos
	private $id;
	private $nome;
	private $slug;
	private $descricao;

	//construtor
	function __construct() {
		parent::__construct();
		// Helpers, libraries e models necessários
		$this->load->model('Conect_model');
		$this->load->model('Data_model');
	}

	//metodos estaticos
	public static function cadastrarTag($nome, $slug, $descricao) {
		try {
			$con = Conect_model::conectar();
			//preparando a query
			$stmt = $con->prepare("INSERT INTO tag
        (
          nome, slug, descricao
        )
      VALUES(?, ?, ?)");

			//configurando os valores
			$stmt->bindParam(1, $nome);
			$stmt->bindParam(2, $slug);
			$stmt->bindParam(3, $descricao);
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

	public static function getObjTag($id) {
		$con = Conect_model::conectar();
		$rs = $con->query("SELECT * FROM `tag` WHERE id = '$id'");
		while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
			$objeto = new Tag_model();
			$objeto->id = $row->id;
			$objeto->nome = $row->nome;
			$objeto->slug = $row->slug;
			$objeto->descricao = $row->descricao;
		}
		return $objeto;
	}

	public static function editarTag($id, $nome, $slug, $descricao) {
		$con = Conect_model::conectar();
		$select = $con->prepare("UPDATE `tag` SET 
    `nome` = :nome, `slug` = :slug, `descricao` = :descricao
    WHERE `tag`.`id` = :id");
		$select->bindParam(':nome', $nome);
		$select->bindParam(':slug', $slug);
		$select->bindParam(':descricao', $descricao);
		$select->bindParam(':id', $id);
		$select->execute();
		if ($select->rowCount() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public static function deleteTag($id) {
		$con = Conect_model::conectar();
		$select = $con->prepare("DELETE FROM `tag` WHERE `tag`.`id` = :id");
		$select->bindParam(':id', $id);
		$select->execute();
		if ($select->rowCount() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public static function getTodosOsTags() {
		$array[0] = "";
		$contador = 0;
		$con = Conect_model::conectar();
		$rs = $con->query("SELECT * FROM `tag`");
		while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
			$id = $row->id;
			$obj = self::getObjTag($id);
			$array[$contador] = $obj;
			$contador++;
		}
		return $array;
	}

	//getters
	function getId() {
		return $this->id;
	}

	function getNome() {
		return $this->nome;
	}

	function getSlug() {
		return $this->slug;
	}

	function getDescricao() {
		return $this->descricao;
	}

}
