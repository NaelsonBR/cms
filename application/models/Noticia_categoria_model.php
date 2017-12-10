<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Noticia_categoria_model extends CI_Model {

  //atributos
  private $id;
  private $categoria;
  private $noticia;

  //construtor
  function __construct() {
    parent::__construct();
    // Helpers, libraries e models necessários
    $this->load->model('Conect_model');
  }

  //metodos estaticos
  public static function cadastrarNoticia_categoria($categoria, $noticia) {
    try {
      $con = Conect_model::conectar();
      //preparando a query
      $stmt = $con->prepare("INSERT INTO noticia_categoria
        (
          categoria, noticia
        )
      VALUES(?, ?)");

      //configurando os valores
      $stmt->bindParam(1, $categoria);
      $stmt->bindParam(2, $noticia);
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

  public static function getObjNoticia_categoria($id) {
    $con = Conect_model::conectar();
    $rs = $con->query("SELECT * FROM `noticia_categoria` WHERE id = '$id'");
    while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
      $objeto = new Noticia_categoria_model();
      $objeto->id = $row->id;
      $objeto->categoria = $row->categoria;
      $objeto->noticia = $row->noticia;
    }
    return $objeto;
  }

  public static function editarNoticia_categoria($id, $categoria, $noticia) {
    $con = Conect_model::conectar();
    $select = $con->prepare("UPDATE `noticia_categoria` SET 
    `categoria` = :categoria, `noticia` = :noticia
    WHERE `noticia_categoria`.`id` = :id");
    $select->bindParam(':categoria', $categoria);
    $select->bindParam(':noticia', $noticia);
    $select->bindParam(':id', $id);
    $select->execute();
    if ($select->rowCount() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public static function deleteNoticia_categoria($id) {
    $con = Conect_model::conectar();
    $select = $con->prepare("DELETE FROM `noticia_categoria` WHERE `noticia_categoria`.`id` = :id");
    $select->bindParam(':id', $id);
    $select->execute();
    if ($select->rowCount() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public static function getTodosOsNoticia_categorias($id_noticia) {
    $array[0] = "";
    $contador = 0;
    $con = Conect_model::conectar();
    $rs = $con->query("SELECT * FROM `noticia_categoria` WHERE `noticia` = '$id_noticia'");
    while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
      $id = $row->id;
      $obj = self::getObjNoticia_categoria($id);
      $array[$contador] = $obj;
      $contador++;
    }
    return $array;
  }
  
  public static function apagarNoticia_categoriaPorNoticia($id_noticia){
    $ncs = self::getTodosOsNoticia_categorias($id_noticia);
    foreach ($ncs as $nc) {
      self::deleteNoticia_categoria($nc->getId());
    }
  }

  //getters
  function getId() {
    return $this->id;
  }

  function getCategoria() {
    return $this->categoria;
  }

  function getNoticia() {
    return $this->noticia;
  }

}
