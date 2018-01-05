<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 * 
 * Refatoração para Codeigniter nativo:
 * 
 * André Luiz Girol | andregirol@gmail.com
 */

/* codigo que impossibilita o acesso direto sem passar pela home */
defined('BASEPATH') OR exit('No direct script access allowed');

/* toda Model DEVE estender CI_Model */

class Usuario_ci_model extends CI_Model {

    //atributos
    private $id;
    private $nome;
    private $login;
    private $telefone;
    private $email;
    private $nivel_de_acesso;
    private $data_de_cadastro;
    private $data_de_ultimo_acesso;
    private $status;

    function __construct() {
        /* contrutor da classe pai */
        parent::__construct();

        /*
		  Aqui basta esse método para conectar ao banco.
		  Já tem tudo pronto na model "Pai" CI_Model
          Necessário configurar o banco de dados no arquivo:
          application/config/database.php
         */
        $this->load->database();

        /* abaixo deverão ser carregados helpers, libraries e models utilizados
          por este model */
    }

    /**
     * Cadastra usuários no banco de dados
     * 
     * Utilizado o query builder do Codeigniter
     * 
     * Documentação: 
     * https://www.codeigniter.com/userguide3/database/query_builder.html#inserting-data
     */
    public function cadastrarUsuario($userArray) {
		
		/* 
		Basta essa única linha pra fazer o insert
		O retorno vai ser TRUE se deu tudo certo e FALSE se der errado
		*/
		return $this->db->insert('usuario', $userArray);
    }

	/**
	 * Recupera um usuário baseado em seu ID e retorna um array
	 * 
	 * == Nota do refactor ==
	 * Aqui não faz sentido usar como um objeto, visto que com o WHERE via ID, 
	 * apenas UM usuário será retornado.
	 * 
	 * É muito mais simples trabalhar com um array do que com um objeto e 
	 * você evita ficar reescrevendo getters e setters
	 * 
	 * Documentação do get_where() no query builder do Codeigniter:
	 * 
	 * https://www.codeigniter.com/userguide3/database/query_builder.html#selecting-data
	 */ 
    public function getUsuario($id) {
		$query = $this->db->get_where('usuario', array('id' => $id));
		// Se a query retornar vazia, retorna false
		if(!$query){
			return FALSE;
		}
		// Senão, retorna o array do usuário
		return $query->row_array();
    }
    
    /**
     * Aqui eu fiz um return objeto que atende perfeitamente ao meu estilo de 
     * programar sem sair do padrao do codeigniter, uma vez que o proprio metodo 
     * row_object ja retorna um objeto stdClass, tudo que fiz foi instanciar um obj da 
     * propria classe, popula-lo e retorna-lo, agora com esse objeto instanciado no controller
     * posso exibir seus attr com getters ou se precisar editar uso setter e depois dou um autosave.
     * Sim, o codigo ficou maior e parece mais demorado fazer assim, mas não esquece que vou ajustar
     * o gerador para entregar models assim prontos em um clique
     */
    public function getObjUsuario($id) {
        $query = $this->db->get_where('usuario', array('id' => $id));
		// Se a query retornar vazia, retorna false
		if(!$query){
			return FALSE;
		}
		// Senão instancia, popula e retorna o objeto
		$row = $query->row_object();
        $user = new Usuario_ci_model();
        $user->id = $row->id;
        $user->nome = $row->nome;
        $user->login = $row->login;
        $user->senha = $row->senha;
        $user->telefone = $row->telefone;
        $user->email = $row->email;
        $user->nivel_de_acesso = $row->nivel_de_acesso;
        $user->data_de_cadastro = $row->data_de_cadastro;
        $user->data_de_ultimo_acesso = $row->data_de_ultimo_acesso;
        $user->status = $row->status;
        
        return $user;
    }
	
	/**
	 * Atualiza os dados de um usuário no banco
	 */
    public function editarUsuario($id_usuario, $dados_usuario) {
		$this->db->where('id', $id_usuario);
		// Returna True ou False
		return $this->db->update('usuario', $dados_usuario);
    }
    
    /**
     * esse metodo p mim é magico pq eu posso instanciar um objeto, alterar oque precisar dele
     * e depois chamar esse metodo no proprio objeto que ele salva suas proprias alterações no banco
     * me permitindo assim controlar oque pode ou nao ser editado pelos setter e getters
     * mantendo o sistema mais amarrado, o array te da muita liberdade, ja assim
     * vc so pode editar o que foi definido como editavel no model
     */
    public function autoSave() {
        $id = $this->id;
        $dados_usuario = Array(
          'nome' => $this->nome,
          'login' => $this->login,
          'senha' => $this->senha,
          'telefone' => $this->telefone,
          'email' => $this->email,
          'nivel_de_acesso' => $this->nivel_de_acesso,
          'data_de_cadastro' => $this->data_de_cadastro,
          'data_de_ultimo_acesso' => $this->data_de_ultimo_acesso,
          'status' => $this->status
        );
        //retorna true ou false
        return $this->editarUsuario($id, $dados_usuario);
    }

    
    
    //Old, static and ugly methods
    //##########################################################################
    public static function deleteUsuario($id) {
        $con = Conect_model::conectar();
        $select = $con->prepare("DELETE FROM `usuario` WHERE `usuario`.`id` = :id");
        $select->bindParam(':id', $id);
        $select->execute();
        if ($select->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function getAllUsuarios() {
        $array[0] = "";
        $contador = 0;
        $con = Conect_model::conectar();
        $rs = $con->query("SELECT * FROM `usuario`");
        while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
            $id = $row->id;
            $obj = self::getObjUsuario($id);
            $array[$contador] = $obj;
            $contador++;
        }
        return $array;
    }

    public static function autenticaLogin($login, $senha) {
        $loginOK = FALSE;
        //tirando caracteres especias do login
        $login2 = preg_replace('/[^[:alnum:]_.-@]/', '', $login);
        //criando a conexão
        $con = Conect_model::conectar();
        /* conte quantas linhas retornaram da pesquisa */
        $select = $con->prepare("SELECT * FROM `usuario` WHERE login = :login");
        $select->bindParam(':login', $login2);
        $select->execute();
        $n = count($select->fetchAll(PDO::FETCH_ASSOC));
        if ($n > 0) {
            $loginOK = TRUE;
        } else {
            return FALSE;
        }
        //se chegou ate aqui o login existe, vamos verificar a senha
        $id = Usuario_model::retornarIdInserindoLogin($login2);
        $hash = Usuario_model::retornarHashDaSenha($id);
        $senhaOK = password_verify($senha, $hash);
        //senha verificada, vamos revisar tudo para permitir acesso
        if ($loginOK && $senhaOK) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function retornarIdInserindoLogin($login) {
        $con = Conect_model::conectar();
        $rs = $con->query("SELECT * FROM `usuario` WHERE login = '$login'");
        while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
            $id = $row->id;
        }
        return $id;
    }

    private static function retornarHashDaSenha($id) {
        $con = Conect_model::conectar();
        $rs = $con->query("SELECT * FROM `usuario` WHERE id = '$id'");
        while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
            $hash = $row->senha;
        }
        return $hash;
    }

    public static function oLoginJaExiste($login) {
        $con = Conect_model::conectar();
        $select = $con->prepare("SELECT * FROM `usuario` WHERE login = :login");
        $select->bindParam(':login', $login);
        $select->execute();
        $n = count($select->fetchAll(PDO::FETCH_ASSOC));
        if ($n > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function atualizarUltimoAcesso($id) {
        $data_de_ultimo_acesso = Helper::retornarDataComHorario();
        //criando a conexão
        $con = Conect_model::conectar();
        /* conte quantas linhas retornaram da pesquisa */
        $select = $con->prepare("UPDATE `usuario` SET `data_de_ultimo_acesso` = :data_de_ultimo_acesso WHERE `usuario`.`id` = :id");
        $select->bindParam(':data_de_ultimo_acesso', $data_de_ultimo_acesso);
        $select->bindParam(':id', $id);
        $select->execute();
    }

    public static function atualizar_senha($login, $nova_senha) {
        $id = self::retornarIdInserindoLogin($login);
        $novo_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
        //criando a conexão
        $con = Conect_model::conectar();
        /* conte quantas linhas retornaram da pesquisa */
        $select = $con->prepare("UPDATE `usuario` SET `senha` = :senha WHERE `usuario`.`id` = :id");
        $select->bindParam(':senha', $novo_hash);
        $select->bindParam(':id', $id);
        $select->execute();
        if ($select->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function verificaSessao($chaveDeSessao) {
        $sessao = 'fga35ds4g8sd4g3g8weg7w987g9f8gre';
        if ($chaveDeSessao != $sessao) {
            redirect('autenticacao');
            exit();
        }
    }

    //getters
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getLogin() {
        return $this->login;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getEmail() {
        return $this->email;
    }

    function getNivel_de_acesso() {
        return $this->nivel_de_acesso;
    }

    function getData_de_cadastro() {
        return $this->data_de_cadastro;
    }

    function getData_de_ultimo_acesso() {
        return $this->data_de_ultimo_acesso;
    }

    function getStatus() {
        return $this->status;
    }
    
    //setter
    function setNome($nome) {
        $this->nome = $nome;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setNivel_de_acesso($nivel_de_acesso) {
        $this->nivel_de_acesso = $nivel_de_acesso;
    }

    function setData_de_cadastro($data_de_cadastro) {
        $this->data_de_cadastro = $data_de_cadastro;
    }

    function setData_de_ultimo_acesso($data_de_ultimo_acesso) {
        $this->data_de_ultimo_acesso = $data_de_ultimo_acesso;
    }

    function setStatus($status) {
        $this->status = $status;
    }
}