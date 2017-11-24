<?php

/* codigo que impossibilita o acesso direto sem passar pela home */
defined('BASEPATH') OR exit('No direct script access allowed');
/* todo controller DEVE extender CI_Controller */

class Administracao extends CI_Controller {
  /* construtor da classe que carregar os principais helpers
    que podem ser usados dentro de toda a classe */

  function __construct() {
    /* contrutor da classe pai */
    parent::__construct();
    /* abaixo deverão ser carregados helpers, libraries e models utilizados
      por este controller */
    $this->load->helper('url');
  }

  public function index() {
    
    $dados['titulo'] = 'Login';
    $this->load->view('dashboard/login_view', $dados);
    
  }

}
