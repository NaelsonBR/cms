<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Mensagem_model extends CI_Model {

  //atributos
  private $id;
  private $nome;
  private $telefone;
  private $email;
  private $assunto;
  private $mensagem;
  private $data_de_cadastro;
  private $status;

  //construtor
  function __construct() {
    parent::__construct();
    // Helpers, libraries e models necessários
    $this->load->model('Conect_model');
    $this->load->model('Data_model');
  }

  //metodos estaticos
  public static function cadastrarMensagem($nome, $telefone, $email, $assunto, $mensagem, $data_de_cadastro, $status) {
    try {
      $con = Conect_model::conectar();
      //preparando a query
      $stmt = $con->prepare("INSERT INTO mensagem
        (
          nome, telefone, email, assunto, mensagem, data_de_cadastro, status
        )
      VALUES(?, ?, ?, ?, ?, ?, ?)");

      //configurando os valores
      $stmt->bindParam(1, $nome);
      $stmt->bindParam(2, $telefone);
      $stmt->bindParam(3, $email);
      $stmt->bindParam(4, $assunto);
      $stmt->bindParam(5, $mensagem);
      $stmt->bindParam(6, $data_de_cadastro);
      $stmt->bindParam(7, $status);
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

  public static function getObjMensagem($id) {
    $con = Conect_model::conectar();
    $rs = $con->query("SELECT * FROM `mensagem` WHERE id = '$id'");
    while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
      $objeto = new Mensagem_model();
      $objeto->id = $row->id;
      $objeto->nome = $row->nome;
      $objeto->telefone = $row->telefone;
      $objeto->email = $row->email;
      $objeto->assunto = $row->assunto;
      $objeto->mensagem = $row->mensagem;
      $objeto->data_de_cadastro = $row->data_de_cadastro;
      $objeto->status = $row->status;
    }
    return $objeto;
  }

  public static function editarMensagem($id, $nome, $telefone, $email, $assunto, $mensagem, $data_de_cadastro, $status){
    $con = Conect_model::conectar();
    $select = $con->prepare("UPDATE `mensagem` SET 
    `nome` = :nome, `telefone` = :telefone, `email` = :email, `assunto` = :assunto, `mensagem` = :mensagem, `data_de_cadastro` = :data_de_cadastro, `status` = :status
    WHERE `mensagem`.`id` = :id");
    $select->bindParam(':nome', $nome);
    $select->bindParam(':telefone', $telefone);
    $select->bindParam(':email', $email);
    $select->bindParam(':assunto', $assunto);
    $select->bindParam(':mensagem', $mensagem);
    $select->bindParam(':data_de_cadastro', $data_de_cadastro);
    $select->bindParam(':status', $status);
    $select->bindParam(':id', $id);
    $select->execute();
    if ($select->rowCount() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public static function deleteMensagem($id){
    $con = Conect_model::conectar();
    $select = $con->prepare("DELETE FROM `mensagem` WHERE `mensagem`.`id` = :id");
    $select->bindParam(':id', $id);
    $select->execute();
    if ($select->rowCount() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public static function getTodosOsMensagems(){
    $array[0] = "";
    $contador = 0;
    $con = Conect_model::conectar();
    $rs = $con->query("SELECT * FROM `mensagem` ORDER by data_de_cadastro");
    while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
      $id = $row->id;
      $obj = self::getObjMensagem($id);
      $array[$contador] = $obj;
      $contador++;
    }
    return $array;
  }
  
  public static function getMsgUlt30Dias() {
    $hoje = Data_model::retornarData();
    $mesPassaso = Data_model::adicionarDiasAUmaData($hoje, -30);
    $dateTime = Data_model::retornarDataComHorario();
    $hora = Data_model::retornarHoraInserindoDateTime($dateTime);
    $datetimeMespassado = "$mesPassaso $hora";
    $array[0] = "";
    $contador = 0;
    $con = Conect_model::conectar();
    $rs = $con->query("SELECT * FROM `mensagem` WHERE data_de_cadastro > '$datetimeMespassado' ORDER by data_de_cadastro");
    while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
      $id = $row->id;
      $obj = self::getObjMensagem($id);
      $array[$contador] = $obj;
      $contador++;
    }
    return $array;
  }
  
  public static function marcarMsgComoLida($id){
    $status = 1;
    $con = Conect_model::conectar();
    $select = $con->prepare("UPDATE `mensagem` SET 
    `status` = :status
    WHERE `mensagem`.`id` = :id");
    $select->bindParam(':status', $status);
    $select->bindParam(':id', $id);
    $select->execute();
    if ($select->rowCount() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  
  public static function contarMsgsNaoLidas(){
    $con = Conect_model::conectar();
    $select = $con->query("SELECT * FROM `mensagem` WHERE status = '0'");
    $n = count($select->fetchAll(PDO::FETCH_ASSOC)); //contar linhas
    return $n;
  }

  //getters
  function getId(){
    return $this->id;
  }

  function getNome() {
    return $this->nome;
  }

  function getTelefone() {
    return $this->telefone;
  }

  function getEmail() {
    return $this->email;
  }

  function getAssunto() {
    return $this->assunto;
  }

  function getMensagem() {
    return $this->mensagem;
  }

  function getData_de_cadastro() {
    return $this->data_de_cadastro;
  }

  function getStatus() {
    return $this->status;
  }


}
