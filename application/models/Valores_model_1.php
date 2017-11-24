<?php

/* codigo que impossibilita o acesso direto sem passar pela home */
defined('BASEPATH') OR exit('No direct script access allowed');
/* todo controller DEVE extender CI_Controller */

class Valores_model extends CI_Model {
  /* construtor da classe que carregar os principais helpers
    que podem ser usados dentro de toda a classe */

  function __construct() {
    /* contrutor da classe pai */
    parent::__construct();
    /* abaixo deverão ser carregados helpers, libraries e models utilizados
      por este model */
    $this->load->model('Conect_model');
  }

  /**
   * recebe um numero com virgula (99,90) e retorna um com ponto (99.00)
   */
  public static function realParaDecimal($valor) {
    //deixar so a virgula como caractere especial
    $valor1 = preg_replace('/[^[:alnum:]_,]/', '', $valor);
    //trocar virgula por ponto
    $valor2 = implode('.', (explode(',', $valor1)));
    //formatar o numero com 2 casas decimais
    $valor3 = number_format($valor2, "2", ".", "");
    return $valor3;
  }

  /**
   * recebe um numero decimal separado por ponto (9999.80) e retorna o mesmo 
   * numero formatado para exibição na tela como real brasileiro (R$ 9.999,80)
   */
  public static function decimalParaRealString($valor) {
    $valor2 = number_format($valor, "2", ",", ".");
    $valor3 = "R$ $valor2";
    return $valor3;
  }

}
