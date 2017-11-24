<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Estado_model extends CI_Model {

  //attr
  private $id;
  private $nome;
  private $uf;
  private $pais;

  function __construct() {
    parent::__construct();
    // aqui deverá ser carregado os helpers, libraries e models necessários
    $this->load->model('Conect_model');
  }

  public static function gerarOptionsEstados() {
    $options = '';
    $con = Conect_model::conectar();
    $rs = $con->query("SELECT * FROM `estado` ORDER BY `estado`.`nome_estado` ASC");
    while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
      $options .= "<option value=\"$row->id\">$row->nome_estado</option>";
    }
    return $options;
  }
  
  public static function getObjEstado($id) {
    $estado = new Estado_model();
    $con = Conect_model::conectar();
    $rs = $con->query("SELECT * FROM `estado` WHERE id = '$id'");
    while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
      $estado->id = $row->id;
      $estado->nome = $row->nome_estado;
      $estado->uf = $row->uf;
      $estado->pais = $row->pais;
    }
    return $estado;
  }

  public static function link_SVG_para_idEstado($link) {
    switch ($link) {
      case 'acre':
        return 1;
      case 'alagoas':
        return 2;
      case 'amazonas':
        return 3;
      case 'amapa':
        return 4;
      case 'bahia':
        return 5;
      case 'ceara':
        return 6;
      case 'distrito_federal':
        return 7;
      case 'espirito_santo':
        return 8;
      case 'goias':
        return 9;
      case 'maranhao':
        return 10;
      case 'minas_gerais':
        return 11;
      case 'mato_grosso_do_sul':
        return 12;
      case 'mato_grosso':
        return 13;
      case 'para':
        return 14;
      case 'paraiba':
        return 15;
      case 'pernambuco':
        return 16;
      case 'piaui':
        return 17;
      case 'parana':
        return 18;
      case 'rio_de_janeiro':
        return 19;
      case 'rio_grande_do_norte':
        return 20;
      case 'rondonia':
        return 21;
      case 'roraima':
        return 22;
      case 'rio_grande_do_sul':
        return 23;
      case 'santa_catarina':
        return 24;
      case 'sergipe':
        return 25;
      case 'sao_paulo':
        return 26;
      case 'tocantins':
        return 27;

      default:
        return FALSE;
    }
  }
  
  //getters
  function getId() {
    return $this->id;
  }

  function getNome() {
    return $this->nome;
  }

  function getUf() {
    return $this->uf;
  }

  function getPais() {
    return $this->pais;
  }

}
