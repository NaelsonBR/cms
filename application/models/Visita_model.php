<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Visita_model extends CI_Model {

  //atributos
  private $id;
  private $data_visita;
  private $ip_visitante;
  private $pagina_visitada;

  //construtor
  function __construct() {
    parent::__construct();
    // Helpers, libraries e models necessários
    $this->load->model('Conect_model');
    $this->load->model('Data_model');
    $this->load->model('Arquivo_model');
  }

  //metodos estaticos
  public static function cadastrarVisita($pagina_visitada) {
    try {
      $data_visita = Data_model::retornarDataComHorario();
      $ip_visitante = Arquivo_model::capturarIP();
      $con = Conect_model::conectar();
      //preparando a query
      $stmt = $con->prepare("INSERT INTO visita
        (
          data_visita, ip_visitante, pagina_visitada
        )
      VALUES(?, ?, ?)");

      //configurando os valores
      $stmt->bindParam(1, $data_visita);
      $stmt->bindParam(2, $ip_visitante);
      $stmt->bindParam(3, $pagina_visitada);
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

  public static function getObjVisita($id) {
    $con = Conect_model::conectar();
    $rs = $con->query("SELECT * FROM `visita` WHERE id = '$id'");
    while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
      $objeto = new Visita_model();
      $objeto->id = $row->id;
      $objeto->data_visita = $row->data_visita;
      $objeto->ip_visitante = $row->ip_visitante;
      $objeto->pagina_visitada = $row->pagina_visitada;
    }
    return $objeto;
  }

  public static function editarVisita($id, $data_visita, $ip_visitante, $pagina_visitada) {
    $con = Conect_model::conectar();
    $select = $con->prepare("UPDATE `visita` SET 
    `data_visita` = :data_visita, `ip_visitante` = :ip_visitante, `pagina_visitada` = :pagina_visitada
    WHERE `visita`.`id` = :id");
    $select->bindParam(':data_visita', $data_visita);
    $select->bindParam(':ip_visitante', $ip_visitante);
    $select->bindParam(':pagina_visitada', $pagina_visitada);
    $select->bindParam(':id', $id);
    $select->execute();
    if ($select->rowCount() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public static function deleteVisita($id) {
    $con = Conect_model::conectar();
    $select = $con->prepare("DELETE FROM `visita` WHERE `visita`.`id` = :id");
    $select->bindParam(':id', $id);
    $select->execute();
    if ($select->rowCount() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public static function getTodosOsVisitas() {
    $array[0] = "";
    $contador = 0;
    $con = Conect_model::conectar();
    $rs = $con->query("SELECT * FROM `visita`");
    while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
      $id = $row->id;
      $obj = self::getObjVisita($id);
      $array[$contador] = $obj;
      $contador++;
    }
    return $array;
  }
  
  public static function contarVisitasUltMes(){
    $hoje = Data_model::retornarData();
    $mesPassaso = Data_model::adicionarDiasAUmaData($hoje, -30);
    $dateTime = Data_model::retornarDataComHorario();
    $hora = Data_model::retornarHoraInserindoDateTime($dateTime);
    $datetimeMespassado = "$mesPassaso $hora";
    $con = Conect_model::conectar();
    $select = $con->query("SELECT * FROM `visita` WHERE data_visita > '$datetimeMespassado'");
    $n = count($select->fetchAll(PDO::FETCH_ASSOC)); //contar linhas
    return $n;
  }

  //getters
  function getId() {
    return $this->id;
  }

  function getData_visita() {
    return $this->data_visita;
  }

  function getIp_visitante() {
    return $this->ip_visitante;
  }

  function getPagina_visitada() {
    return $this->pagina_visitada;
  }

}
