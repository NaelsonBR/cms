<?php

/* codigo que impossibilita o acesso direto sem passar pela home */
defined('BASEPATH') OR exit('No direct script access allowed');
/* todo controller DEVE extender CI_Controller */

class Data_model extends CI_Model {
  /* construtor da classe que carregar os principais helpers
    que podem ser usados dentro de toda a classe */

  function __construct() {
    /* contrutor da classe pai */
    parent::__construct();
    /* abaixo deverão ser carregados helpers, libraries e models utilizados
      por este model */
  }
  
  /**
   * recebe aaaa-mm-aa e retorna dd/mm/aaaa
   * 
   * 
   */
  public static function converterDataUSAParaBR($data) {
    $nova_data = implode('/', array_reverse(explode('-', $data)));
    return $nova_data;
  }

  /**
   * recebe dd/mm/aaaa e retorna aaaa-mm-dd 
   * 
   * 
   */
  public static function converterDataBRParaUSA($data) {
    $nova_data = implode('-', array_reverse(explode('/', $data)));
    return $nova_data;
  }

  /**
   * calcula a diferença em dias entre duas datas e a retorna
   * 
   * 
   */
  public static function calculaDiferencaEmDias($data_maior, $data_menor) {
    $d1 = strtotime($data_maior);
    $d2 = strtotime($data_menor);
    $diferenca = $d1 - $d2;
    $dias = (int) floor($diferenca / (60 * 60 * 24));
    return $dias;
  }

  /**
   * adiciona a quantidade passada como parametro de dias a uma data e a retorna
   * 
   * 
   */
  public static function adicionarDiasAUmaData($data_atual, $dias_a_ser_adicionado) {
    date_default_timezone_set("America/Sao_Paulo");
    $data = date('Y-m-d', strtotime("$dias_a_ser_adicionado days", strtotime($data_atual)));
    return $data;
  }

  /**
   * retorna a data atual no formato aaaa-mm-dd
   * 
   * 
   */
  public static function retornarData() {
    date_default_timezone_set("America/Sao_Paulo");
    $data = date('Y-m-d');
    return $data;
  }

  /**
   * retorna um datetime atual no formato aaaa-mm-dd hh:min:seg
   * 
   * 
   */
  public static function retornarDataComHorario() {
    date_default_timezone_set("America/Sao_Paulo");
    $data = date('Y-m-d H:i:s');
    return $data;
  }

  /**
   * retorna o ano atual
   * 
   * 
   */
  public static function retornarAno() {
    date_default_timezone_set("America/Sao_Paulo");
    $data = date('Y');
    return $data;
  }

  /**
   * retorna o mes atual
   * 
   * 
   */
  public static function retornarMes() {
    date_default_timezone_set("America/Sao_Paulo");
    $data = date('m');
    return $data;
  }

  /**
   * retorna o dia atual
   * 
   * 
   */
  public static function retornarDia() {
    date_default_timezone_set("America/Sao_Paulo");
    $data = date('d');
    return $data;
  }

  /**
   * retorna mm-dd
   * 
   * 
   */
  public static function retornarMesEDia() {
    date_default_timezone_set("America/Sao_Paulo");
    $data = date('m-d');
    return $data;
  }

  /**
   * recebe HH:mm:ss e retorna 00h00min00s
   * 
   * 
   */
  public static function formatarHora($hora) {
    $array = explode(':', $hora);
    $h = $array[0];
    $min = $array[1];
    $s = $array[2];
    $hora_formatada = "$h" . "h" . "$min" . "min" . "$s" . "s";
    return $hora_formatada;
  }

  /**
   * insere aaaa-mm-dd hh:mm:ss e retorna
   * dd/mm/aaaa 00h00min00s
   * 
   */
  public static function formatarDateTime($dateTime) {
    //9h25min6s
    $array = explode(' ', $dateTime);
    $data = Data_model::converterDataUSAParaBR($array[0]);
    $hora = Data_model::formatarHora($array[1]);
    return "$data $hora";
  }

  /**
   * insere aaaa-mm-dd hh:mm:ss e retorna aaaa-mm-dd
   * 
   * 
   */
  public static function retornarDataInserindoDateTime($dateTime) {
    $dataArray = explode(' ', $dateTime);
    return $dataArray[0];
  }

  /**
   * insere aaaa-mm-dd hh:mm:ss e retorna hh:mm:ss
   * 
   * 
   */
  public static function retornarHoraInserindoDateTime($dateTime) {
    $dataArray = explode(' ', $dateTime);
    return $dataArray[1];
  }

  /**
   * Compara duas datas devolvendo true se a primeira for maior
   * e false se a primeira for menor.
   * 
   */
  public static function compararData($data_1, $data_2) {
    if (strtotime($data_1) > strtotime($data_2)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /**
   * adiciona o numero passado de anos a uma data e a retorna
   * formato esperado aaaa-mm-dd
   * 
   */
  public static function adicionarAnosAUmaData($data, $numero_de_anos) {
    $array = explode('-', $data);
    $ano = $array[0];
    $mes = $array[1];
    $dia = $array[2];
    $ano_somado = $ano + $numero_de_anos;
    $data_final = "$ano_somado-$mes-$dia";
    return $data_final;
  }

}
