<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Controller para testar a refatoração das models
 */
class Test_user_model extends CI_Controller {
    public function __construct(){
        parent::__construct();

        // Habilita um debugger muito poderoso do Codeigniter
        $this->output->enable_profiler(TRUE);
        // Se colocar no construtor, basta carregar uma vez
        $this->load->model("Usuario_ci_model");
    }
    
    public function index(){
        echo '<h1>Index do controller Tests/TestingModels</h1>';
    }

    public function cadastrar_usuario(){

        // Instancia a model dentro do CI

        // Gerando um sample para testar a conexão com o banco e o método criado na model
        $dados_usuario = Array (
            'id' => NULL,
            'nome' => "Asdrúbal da Silva",
            'login' => "asdrubal",
            'senha' => hash('sha256', 'minha_senha'),
            'telefone' => '',
            'email' => 'asdrubal@email.cms',
            'nivel_de_acesso' => 0,
            'data_de_cadastro' => date("Y-m-d H:i:s"),
            'data_de_ultimo_acesso' => date("Y-m-d H:i:s"),
            'status' => 0
        );

        // Mostrando na tela apenas os resultados dos testes
        echo "Dados do sample abaixo: <hr>";
        var_dump($dados_usuario);
        
        $query = $this->Usuario_ci_model->cadastrarUsuario($dados_usuario);
        
        echo "<hr>Resultado do banco de dados: ";
        var_dump($query); // Vai ser true ou false

    }

    public function get_obj_usuario(){

    }
}