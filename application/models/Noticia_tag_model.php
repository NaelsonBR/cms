<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Noticia_tag_model extends CI_Model {

  //atributos
  private $id;
  private $tag;
  private $noticia;

  //construtor
  function __construct() {
    parent::__construct();
    // Helpers, libraries e models necessários
    $this->load->model('Conect_model');
    $this->load->model('Data_model');
  }

  //metodos estaticos
  public static function cadastrarNoticia_tag($tag, $noticia) {
    try {
      $con = Conect_model::conectar();
      //preparando a query
      $stmt = $con->prepare("INSERT INTO noticia_tag
        (
          tag, noticia
        )
      VALUES(?, ?)");

      //configurando os valores
      $stmt->bindParam(1, $tag);
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

  public static function getObjNoticia_tag($id) {
    $con = Conect_model::conectar();
    $rs = $con->query("SELECT * FROM `noticia_tag` WHERE id = '$id'");
    while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
      $objeto = new Noticia_tag_model();
      $objeto->id = $row->id;
      $objeto->tag = $row->tag;
      $objeto->noticia = $row->noticia;
    }
    return $objeto;
  }

  public static function editarNoticia_tag($id, $tag, $noticia) {
    $con = Conect_model::conectar();
    $select = $con->prepare("UPDATE `noticia_tag` SET 
    `tag` = :tag, `noticia` = :noticia
    WHERE `noticia_tag`.`id` = :id");
    $select->bindParam(':tag', $tag);
    $select->bindParam(':noticia', $noticia);
    $select->bindParam(':id', $id);
    $select->execute();
    if ($select->rowCount() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public static function deleteNoticia_tag($id) {
    $con = Conect_model::conectar();
    $select = $con->prepare("DELETE FROM `noticia_tag` WHERE `noticia_tag`.`id` = :id");
    $select->bindParam(':id', $id);
    $select->execute();
    if ($select->rowCount() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public static function getTodosOsNoticia_tags($id_noticia) {
    $array[0] = "";
    $contador = 0;
    $con = Conect_model::conectar();
    $rs = $con->query("SELECT * FROM `noticia_tag` WHERE `noticia` = '$id_noticia'");
    while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
      $id = $row->id;
      $obj = self::getObjNoticia_tag($id);
      $array[$contador] = $obj;
      $contador++;
    }
    return $array;
  }
  
  public static function apagarNoticia_tagPorNoticia($id_noticia){
    $nts = self::getTodosOsNoticia_tags($id_noticia);
    foreach ($nts as $nt) {
      self::deleteNoticia_tag($nt->getId());
    }
  }

  //getters
  function getId() {
    return $this->id;
  }

  function getTag() {
    return $this->tag;
  }

  function getNoticia() {
    return $this->noticia;
  }

}
