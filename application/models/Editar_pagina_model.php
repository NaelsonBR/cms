<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Editar_pagina_model extends CI_Model {

  function __construct() {

    parent::__construct();
    // aqui deverá ser carregado os helpers, libraries e models necessários
    $this->load->model('Conect_model');
  }
  
  /**
   * retorna um array contendo o conteudo da pagina sobre
   */
  public static function getPaginaSobre(){
    $con = Conect_model::conectar();
    $rs = $con->query("SELECT * FROM `sobre` WHERE id_sobre = '1'");
    while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
      $sobre['titulo'] = $row->titulo_sobre;
      $sobre['subtitulo'] = $row->subtitulo_sobre;
      $sobre['imagem'] = $row->imagem_sobre;
      $sobre['texto'] = $row->texto_sobre;
    }
    return $sobre;
  }
  
  public static function salvar_pagina_sobre($titulo, $subtitulo, $imagem, $texto){
    //criando a conexão
    $con = Conect_model::conectar();
    /* conte quantas linhas retornaram da pesquisa */
    $select = $con->prepare("UPDATE `sobre` SET `titulo_sobre` = :titulo_sobre, 
      `subtitulo_sobre` = :subtitulo_sobre, `imagem_sobre` = :imagem_sobre, `texto_sobre` = :texto_sobre
      WHERE `sobre`.`id_sobre` = '1'");
    $select->bindParam(':titulo_sobre', $titulo);
    $select->bindParam(':subtitulo_sobre', $subtitulo);
    $select->bindParam(':imagem_sobre', $imagem);
    $select->bindParam(':texto_sobre', $texto);
    $select->execute();
    if ($select->rowCount() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  
  public static function salvar_pagina_sobre_sem_imagem($titulo, $subtitulo,$texto){
    //criando a conexão
    $con = Conect_model::conectar();
    /* conte quantas linhas retornaram da pesquisa */
    $select = $con->prepare("UPDATE `sobre` SET `titulo_sobre` = :titulo_sobre, 
      `subtitulo_sobre` = :subtitulo_sobre, `texto_sobre` = :texto_sobre
      WHERE `sobre`.`id_sobre` = '1'");
    $select->bindParam(':titulo_sobre', $titulo);
    $select->bindParam(':subtitulo_sobre', $subtitulo);
    $select->bindParam(':texto_sobre', $texto);
    $select->execute();
    if ($select->rowCount() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

}
