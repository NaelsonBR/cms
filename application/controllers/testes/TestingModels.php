<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Controller para testar a refatoração das models
 */
class TestingModels extends CI_Controller {
    public function __construct(){
        parent::__construct();

        // Habilita um debugger muito poderoso do Codeigniter
        $this->output->enable_profiler(TRUE);
    }
    
    public function index(){
        echo '<h1>Index do controller Tests/TestingModels</h1>';
    }

    public function usuario_model_ci(){
        $this->load->model("Usuario_model_ci");
    }
}