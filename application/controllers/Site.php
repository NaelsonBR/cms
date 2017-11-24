<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

  function __construct() {
    /* contrutor da classe pai */
    parent::__construct();
    // aqui deverá ser carregado os helpers, libraries e models necessários.
    $this->load->helper('url');
    $this->load->model('Option_model');
    $this->load->model('Noticia_model');
    $this->load->model('Estado_model');
  }

  public function index() {
    $manutenção = Option_model::recuperarOption('manutencao');
    if ($manutenção) {
      $this->load->view('site/manutencao_view');
    } else {
      $this->load->view('site/home_page_view');
    }
  }

  public function sobre() {
    $manutenção = Option_model::recuperarOption('manutencao');
    if ($manutenção) {
      $this->load->view('site/manutencao_view');
    } else {
      $this->load->view('site/sobre_view');
    }
  }

  public function servicos() {
    $manutenção = Option_model::recuperarOption('manutencao');
    if ($manutenção) {
      $this->load->view('site/manutencao_view');
    } else {
      $this->load->view('site/servicos_view');
    }
  }

  public function produto($id) {
    $manutenção = Option_model::recuperarOption('manutencao');
    if ($manutenção) {
      $this->load->view('site/manutencao_view');
    } else {
      $dados['id_produto'] = $id;
      $this->load->view('site/produto_view', $dados); /* !!!!!!!!!!! */
    }
  }

  public function procurar_instalador() {
    $ja_logou = $this->session->userdata('cliente_logado');
    if ($ja_logou) {
      $this->load->view('site/escolher_estado_instalador_view');
    } else {
      $getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
      $login = $getpost['login_cliente'];
      $senha = $getpost['senha_cliente'];
      $logado = Cliente_model::valida_login($login, $senha);
      if ($logado) {
        $novosdados = array(
          'login_usuario' => $login,
          'cliente_logado' => TRUE
        );
        $this->session->set_userdata($novosdados);
        //logou-se
        $this->load->view('site/escolher_estado_instalador_view');
      } else {
        $url = base_url();
        echo "  <script>
                    alert(\"Falha na autenticação!\");
                    window.location = '$url';
                </script>";
      }
    }
  }

  public function instaladores_por_estado($estado) {
    $id_estado = Estado_model::link_SVG_para_idEstado($estado);
    $dados['id_estado'] = $id_estado;
    $this->load->view('site/listar_instaladores_view', $dados);
  }

  public function revendedores_por_estado($estado) {
    $id_estado = Estado_model::link_SVG_para_idEstado($estado);
    $dados['id_estado'] = $id_estado;
    $this->load->view('site/listar_revendedores_view', $dados);
  }

  public function noticia($id) {
    $manutenção = Option_model::recuperarOption('manutencao');
    if ($manutenção) {
      $this->load->view('site/manutencao_view');
    } else {
      $dados['id_noticia'] = $id;
      $this->load->view('site/noticia_view', $dados); /* !!!!!!!!!!! */
    }
  }

  public function procurar_revendedor() {
    $manutenção = Option_model::recuperarOption('manutencao');
    if ($manutenção) {
      $this->load->view('site/manutencao_view');
    } else {
      $this->load->view('site/procurar_revendedor_view');
    }
  }

  public function procurar_revendedor_por_estado() {
    $getpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $login = $getpost['login_cliente'];
    $senha = $getpost['senha_cliente'];
    $logado = Cliente_model::valida_login($login, $senha);
    if ($logado) {
      $novosdados = array(
        'login_usuario' => $login,
        'cliente_logado' => TRUE
      );
      $this->session->set_userdata($novosdados);
      //logou-se
      $this->load->view('site/escolher_estado_revendedor_view');
    } else {
      $url = base_url();
      echo "  <script>
                  alert(\"Falha na autenticação!\");
                  window.location = '$url';
              </script>";
    }
  }

  public function servico($id) {
    $manutenção = Option_model::recuperarOption('manutencao');
    if ($manutenção) {
      $this->load->view('site/manutencao_view');
    } else {
      $dados['id_servico'] = $id;
      $this->load->view('site/servico_view', $dados);
    }
  }

  public function novidades() {
    $manutenção = Option_model::recuperarOption('manutencao');
    if ($manutenção) {
      $this->load->view('site/manutencao_view');
    } else {
      $noticias = Noticia_model::getTodasAsNoticias();
      $posts = "";
      $recentes = "";
      foreach ($noticias as $noticia) {
        $imagem = $noticia->getImagem_principal();
        $base = base_url('assets/uploads/');
        $id = $noticia->getId();
        $link = base_url('site/novidade/') . "$id";
        $img = "$base" . "$imagem";
        $titulo = $noticia->getTitulo();
        $texto = $noticia->getConteudo();
        $posts .= "<div class=\"blog-entry\">
          <div class=\"blog-entry-image  clearfix\">
            <div class=\"portfolio-item\">
              <img class=\"img-responsive\" src=\"$img\" >
            </div>
          </div>
          <div class=\"entry-title\">
            <a href=\"$link\">$titulo</a>
          </div>
          <div class=\"entry-content\">
            $texto
          </div>
        </div>
        <hr class=\"gray\">";
        $recentes .= "<li><a href=\"$link\"> <i class=\"fa fa-angle-right\"></i> $titulo</a></li>";
      }
      $dados['noticias'] = $posts;
      $dados['recentes'] = $recentes;
      $this->load->view('site/novidades_view', $dados);
    }
  }

  public function novidade($id_noticia) {
    $noticia = Noticia_model::getObjNoticia($id_noticia);
    $titulo = $noticia->getTitulo();
    $img = $noticia->getImagem_principal();
    $imagem = base_url('assets/uploads/') . "$img";
    $conteudo = $noticia->getConteudo();
    $autor = $noticia->getAutor();
    $data_cadastro = $noticia->getData_insercao();
    $dados['titulo'] = $titulo;
    $dados['imagem'] = $imagem;
    $dados['conteudo'] = $conteudo;
    $dados['autor'] = $autor;
    $dados['data_cadastro'] = $data_cadastro;
    $this->load->view('site/novidade_view', $dados);
  }

  public function contato() {
    $manutenção = Option_model::recuperarOption('manutencao');
    if ($manutenção) {
      $this->load->view('site/manutencao_view');
    } else {
      $this->load->view('site/contato_view');
    }
  }

  public function solicitar_orcamento() {
    $manutenção = Option_model::recuperarOption('manutencao');
    if ($manutenção) {
      $this->load->view('site/manutencao_view');
    } else {
      $this->load->view('site/solicitar_orcamento_view');
    }
  }

}
