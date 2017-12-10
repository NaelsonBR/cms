<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Option_model extends CI_Model {

  function __construct() {

    parent::__construct();
    // aqui deverá ser carregado os helpers, libraries e models necessários
    $this->load->model('Conect_model');
  }

  public static function cadastrarOption($nome, $valor) {
    try {
      $con = Conect_model::conectar();
      //preparando a query
      $stmt = $con->prepare("INSERT INTO option
            (
              nome_option,valor_option
            ) 
            VALUES(?, ?)");
      //configurando os valores
      $stmt->bindParam(1, $nome);
      $stmt->bindParam(2, $valor);
      //executando a query
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        $cadastrado = TRUE;
      } else {
        $cadastrado = FALSE;
      }
      if ($cadastrado) {
        return TRUE;
      } else {
        return FALSE;
      }
    } catch (Exception $exc) {
      echo $exc->getTraceAsString();
    }
  }

  /**
   * retorna o valor da option cujo nome é passado
   */
  public static function recuperarOption($nome) {
    $existe = self::verSeOptionExiste($nome);
    if ($existe) {
      $con = Conect_model::conectar();
      $rs = $con->query("SELECT * FROM `option` WHERE nome_option = '$nome'");
      while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
        $valor = $row->valor_option;
      }
      if (isset($valor) && $valor != "") {
        return $valor;
      } else {
        return FALSE;
      }
    } else {
      $valor = FALSE;
      self::cadastrarOption($nome, $valor);
      return FALSE;
    }
  }

  /**
   * verifica se uma option com o nome passado já existe no banco e retorna 
   * um booleano
   */
  public static function verSeOptionExiste($nome_option) {
    $con = Conect_model::conectar();
    $select = $con->prepare("SELECT * FROM `option` WHERE nome_option = :nome_option");
    $select->bindParam(':nome_option', $nome_option);
    $select->execute();
    $n = count($select->fetchAll(PDO::FETCH_ASSOC));
    if ($n > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /**
   * busca no banco pela option cujo nome foi passado e atualiza seu valor com o
   * valor passado
   */
  public static function atualizarOption($nome, $valor) {
    //criando a conexão
    $con = Conect_model::conectar();
    /* conte quantas linhas retornaram da pesquisa */
    $select = $con->prepare("UPDATE `option` SET `valor_option` = :valor
                            WHERE `option`.`nome_option` = :nome");
    $select->bindParam(':valor', $valor);
    $select->bindParam(':nome', $nome);
    $select->execute();
    if ($select->rowCount() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

}
