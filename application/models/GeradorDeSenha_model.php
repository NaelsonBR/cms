<?php

/* codigo que impossibilita o acesso direto sem passar pela home */
defined('BASEPATH') OR exit('No direct script access allowed');
/* todo controller DEVE extender CI_Controller */

class GeradorDeSenha_model extends CI_Model {
  /* construtor da classe que carregar os principais helpers
    que podem ser usados dentro de toda a classe */

  function __construct() {
    /* contrutor da classe pai */
    parent::__construct();
    /* abaixo deverão ser carregados helpers, libraries e models utilizados
      por este model */
  }

  /**
   * gera uma senha aleatoria contendo numeros e letras minusculas
   */
  public static function gerarSenha($tamanho) {
    if ($tamanho > 0) {
      $id_aleatorio = "";
      for ($i = 1; $i <= $tamanho; $i++) {
        $numero = rand(1, 36);
        $id_aleatorio .= GeradorDeSenha_model::valorAleatorio($numero);
      }
    }
    return $id_aleatorio;
  }

  /**
   * gera uma senha contendo letras maiusculas e minusculas, 
   * numeros e caraceteres especiais
   */
  public static function gerarSenhaComplexa($tamanho) {
    if ($tamanho > 0) {
      $id_aleatorio = "";
      for ($i = 1; $i <= $tamanho; $i++) {
        $numero = rand(1, 80);
        $id_aleatorio .= GeradorDeSenha_model::valorAleatorioComplexo($numero);
      }
    }
    return $id_aleatorio;
  }
  
  /**
   * gera um id unico alfanumerico baseado no microsegundo atual com prefixo e sufixo aleatorios
   */
  public static function gerarIdUnico(){
    $p1 = self::gerarSenha(6);
    $p2 = uniqid();
    $p3 = self::gerarSenha(6);
    $id = "$p1"."$p2"."$p3";
    return $id;
  }

  public static function gerarLoginCliente($nome_completo) {
    $nome2 = $nome_completo;
    $nome3 = strtolower($nome2);
    $nome = explode(" ", $nome3);
    if (!isset($nome[1])) {
      $nome[1] = "SemSobrenome";
    }
    $complemento = GeradorDeSenha_model::gerar_senha(4);
    $login = "$nome[0]" . ".$nome[1]" . ".$complemento";
    return $login;
  }

  private static function valorAleatorio($numero) {
    switch ($numero) {
      case "1":
        $valor = "A";
        break;
      case "2":
        $valor = "B";
        break;
      case "3":
        $valor = "C";
        break;
      case "4":
        $valor = "D";
        break;
      case "5":
        $valor = "E";
        break;
      case "6":
        $valor = "F";
        break;
      case "7":
        $valor = "G";
        break;
      case "8":
        $valor = "H";
        break;
      case "9":
        $valor = "I";
        break;
      case "10":
        $valor = "J";
        break;
      case "11":
        $valor = "K";
        break;
      case "12":
        $valor = "L";
        break;
      case "13":
        $valor = "M";
        break;
      case "14":
        $valor = "N";
        break;
      case "15":
        $valor = "0";
        break;
      case "16":
        $valor = "P";
        break;
      case "17":
        $valor = "Q";
        break;
      case "18":
        $valor = "R";
        break;
      case "19":
        $valor = "S";
        break;
      case "20":
        $valor = "T";
        break;
      case "21":
        $valor = "U";
        break;
      case "22":
        $valor = "V";
        break;
      case "23":
        $valor = "W";
        break;
      case "24":
        $valor = "X";
        break;
      case "25":
        $valor = "Y";
        break;
      case "26":
        $valor = "Z";
        break;
      case "27":
        $valor = "0";
        break;
      case "28":
        $valor = "1";
        break;
      case "29":
        $valor = "2";
        break;
      case "30":
        $valor = "3";
        break;
      case "31":
        $valor = "4";
        break;
      case "32":
        $valor = "5";
        break;
      case "33":
        $valor = "6";
        break;
      case "34":
        $valor = "7";
        break;
      case "35":
        $valor = "8";
        break;
      case "36":
        $valor = "9";
        break;
    }
    return $valor;
  }

  private static function valorAleatorioComplexo($numero) {
    switch ($numero) {
      case "1":
        $valor = "a";
        break;
      case "2":
        $valor = "b";
        break;
      case "3":
        $valor = "c";
        break;
      case "4":
        $valor = "d";
        break;
      case "5":
        $valor = "e";
        break;
      case "6":
        $valor = "f";
        break;
      case "7":
        $valor = "g";
        break;
      case "8":
        $valor = "h";
        break;
      case "9":
        $valor = "i";
        break;
      case "10":
        $valor = "j";
        break;
      case "11":
        $valor = "k";
        break;
      case "12":
        $valor = "l";
        break;
      case "13":
        $valor = "m";
        break;
      case "14":
        $valor = "n";
        break;
      case "15":
        $valor = "o";
        break;
      case "16":
        $valor = "p";
        break;
      case "17":
        $valor = "q";
        break;
      case "18":
        $valor = "r";
        break;
      case "19":
        $valor = "s";
        break;
      case "20":
        $valor = "t";
        break;
      case "21":
        $valor = "u";
        break;
      case "22":
        $valor = "v";
        break;
      case "23":
        $valor = "w";
        break;
      case "24":
        $valor = "x";
        break;
      case "25":
        $valor = "y";
        break;
      case "26":
        $valor = "z";
        break;
      case "27":
        $valor = "0";
        break;
      case "28":
        $valor = "1";
        break;
      case "29":
        $valor = "2";
        break;
      case "30":
        $valor = "3";
        break;
      case "31":
        $valor = "4";
        break;
      case "32":
        $valor = "5";
        break;
      case "33":
        $valor = "6";
        break;
      case "34":
        $valor = "7";
        break;
      case "35":
        $valor = "8";
        break;
      case "36":
        $valor = "9";
        break;
      case "37":
        $valor = "A";
        break;
      case "38":
        $valor = "B";
        break;
      case "39":
        $valor = "C";
        break;
      case "40":
        $valor = "D";
        break;
      case "41":
        $valor = "E";
        break;
      case "42":
        $valor = "F";
        break;
      case "43":
        $valor = "G";
        break;
      case "44":
        $valor = "H";
        break;
      case "45":
        $valor = "I";
        break;
      case "46":
        $valor = "J";
        break;
      case "47":
        $valor = "K";
        break;
      case "48":
        $valor = "L";
        break;
      case "49":
        $valor = "M";
        break;
      case "50":
        $valor = "N";
        break;
      case "51":
        $valor = "O";
        break;
      case "52":
        $valor = "P";
        break;
      case "53":
        $valor = "Q";
        break;
      case "54":
        $valor = "R";
        break;
      case "55":
        $valor = "S";
        break;
      case "56":
        $valor = "T";
        break;
      case "57":
        $valor = "Y";
        break;
      case "58":
        $valor = "U";
        break;
      case "59":
        $valor = "V";
        break;
      case "60":
        $valor = "W";
        break;
      case "61":
        $valor = "X";
        break;
      case "62":
        $valor = "Z";
        break;
      case "63":
        $valor = "*";
        break;
      case "64":
        $valor = "-";
        break;
      case "65":
        $valor = "/";
        break;
      case "66":
        $valor = "´";
        break;
      case "67":
        $valor = "`";
        break;
      case "68":
        $valor = "^";
        break;
      case "69":
        $valor = "~";
        break;
      case "70":
        $valor = "!";
        break;
      case "71":
        $valor = "@";
        break;
      case "72":
        $valor = "#";
        break;
      case "73":
        $valor = '$';
        break;
      case "74":
        $valor = "%";
        break;
      case "75":
        $valor = "&";
        break;
      case "76":
        $valor = "<";
        break;
      case "77":
        $valor = ">";
        break;
      case "78":
        $valor = "§";
        break;
      case "79":
        $valor = "=";
        break;
      case "80":
        $valor = ")(";
        break;
    }
    return $valor;
  }

}
