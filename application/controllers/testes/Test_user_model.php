<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller para testar a refatoração das models
 */
class Test_user_model extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Habilita um debugger muito poderoso do Codeigniter
        $this->output->enable_profiler(TRUE);
        // Se colocar no construtor, basta carregar uma vez
        $this->load->model("Usuario_ci_model");
    }

    public function index() {
        echo '<h1>Index do controller Tests/TestingModels</h1>';
    }

    public function cadastrar_usuario() {

        // Gerando um sample para testar a conexão com o banco e o método criado na model
        $dados_usuario = Array(
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

    // Passando um id genérico para testar o método
    public function get_usuario($id = 1) {
        $usuario = $this->Usuario_ci_model->getUsuario($id);
        echo "O usuário é:";
        echo "<pre>";
        var_dump($usuario);
        echo "</pre>";
    }
    
    // repetindo o metodo anterior com meu metodo
    public function get_objeto_usuario($id = 1) {
        $usuario = $this->Usuario_ci_model->getUsuario($id);
        echo "O usuário é:";
        echo "<pre>";
        var_dump($usuario);
        echo "</pre>";
    }

    public function update_usuario($id) {

        // Gerando um sample para testar a conexão com o banco e o método criado na model
        $dados_usuario = Array(
          'nome' => "Asdrúbal da Silva",
          'login' => "NOVO_ASDRUBAL",
          'email' => 'novo_email@email.cms',
          'data_de_ultimo_acesso' => date("Y-m-d H:i:s"),
        );

        // Mostrando na tela apenas os resultados dos testes
        echo "Dados do sample abaixo: <hr>";
        var_dump($dados_usuario);

        $query = $this->Usuario_ci_model->editarUsuario($id, $dados_usuario);
        echo "<hr>Resultado do banco de dados: ";
        var_dump($query); // Vai ser true ou false
    }
    
    public function update_obj_usuario($id) {
        //instanciando o objeto
        $usuario = Usuario_ci_model::getObjUsuario($id);
        //exibindo na tela
        echo "<p>Objeto antes de ser modificado</p>";
        echo "<pre>";
        var_dump($usuario);
        echo "</pre>";
        //modificando
        $usuario->setNome('teste3');
        $usuario->setEmail('teste@testador.com');
        //salvando
        $usuario->autoSave();
        //exibindo o resultado
        echo "<p>Objeto depois de ser modificado pelos setters</p>";
        echo "<pre>";
        var_dump($usuario);
        echo "</pre>";
    }

}
