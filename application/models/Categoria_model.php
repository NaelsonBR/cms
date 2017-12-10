<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria_model extends CI_Model {

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
    $this->load->model('Helper');
  }

  //metodos estaticos
  public static function cadastrarCategoria($nome, $slug, $descricao) {
    try {
      $con = Conect_model::conectar();
      //preparando a query
      $stmt = $con->prepare("INSERT INTO categoria
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

  public static function getObjCategoria($id) {
    $con = Conect_model::conectar();
    $rs = $con->query("SELECT * FROM `categoria` WHERE id = '$id'");
    while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
      $objeto = new Categoria_model();
      $objeto->id = $row->id;
      $objeto->nome = $row->nome;
      $objeto->slug = $row->slug;
      $objeto->descricao = $row->descricao;
    }
    return $objeto;
  }

  public static function editarCategoria($id, $nome, $slug, $descricao) {
    $con = Conect_model::conectar();
    $select = $con->prepare("UPDATE `categoria` SET 
    `nome` = :nome, `slug` = :slug, `descricao` = :descricao
    WHERE `categoria`.`id` = :id");
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

  public static function deleteCategoria($id) {
    $con = Conect_model::conectar();
    $select = $con->prepare("DELETE FROM `categoria` WHERE `categoria`.`id` = :id");
    $select->bindParam(':id', $id);
    $select->execute();
    if ($select->rowCount() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public static function getTodosOsCategorias() {
    $array[0] = "";
    $contador = 0;
    $con = Conect_model::conectar();
    $rs = $con->query("SELECT * FROM `categoria`");
    while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
      $id = $row->id;
      $obj = self::getObjCategoria($id);
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
