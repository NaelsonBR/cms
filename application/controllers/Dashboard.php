<?php

/*
	* Autor: Peterson Passos
	* peterson.jfp@gmail.com
	* 51 9921298121
	*/

defined('BASEPATH')	OR	exit('No direct script access allowed');

class	Dashboard	extends	CI_Controller	{

		function	__construct()	{
				/* contrutor da classe pai */
				parent::__construct();
				// aqui deverá ser carregado os helpers, libraries e models necessários
				$this->load->helper('url');
				$this->load->library('session');
		}

		/* Home - painel administrativo
			 ########################################################################## */

		public	function	index()	{
				redirect('autenticacao');
		}

		public	function	autHome($tokenGet)	{
				if	($this->session->userdata('token_usuario')	==	"")	{
						redirect('autenticacao');
						exit();
				}	else	{
						$tokenSession	=	$this->session->userdata('token_usuario');
						if	($tokenGet	!=	$tokenSession)	{
								//se forem diferentes saia do sistema
								redirect('autenticacao');
								exit('Login não efetuado!!!');
						}
				}
				redirect('Dashboard/home');
		}

		public	function	home()	{
				$logado	=	$this->session->userdata('esta_logado');
				if	(!$logado)	{
						exit('Aconteceu um erro ao se logar no sistema');
				}
				$op	=	$this->uri->segment(3);
				if	($op	!=	"")	{
						if	($op	==	1)	{
								$dados['msg']	=	"Operação realizada com sucesso.";
								$dados['tipo']	=	'info';
								$this->load->view('dashboard/1-header');
								$this->load->view('dashboard/2-topbar');
								$this->load->view('dashboard/3-sidebar');
								$this->load->view('dashboard/4-content',	$dados);
								$this->load->view('dashboard/5-configbar');
								$this->load->view('dashboard/6-footer');
						}	else	{
								$dados['msg']	=	"Aconteceu um erro, se persistir informe ao WebMaster.";
								$dados['tipo']	=	'danger';
								$this->load->view('dashboard/1-header');
								$this->load->view('dashboard/2-topbar');
								$this->load->view('dashboard/3-sidebar');
								$this->load->view('dashboard/4-content',	$dados);
								$this->load->view('dashboard/5-configbar');
								$this->load->view('dashboard/6-footer');
						}
				}	else	{
						$this->load->view('dashboard/1-header');
						$this->load->view('dashboard/2-topbar');
						$this->load->view('dashboard/3-sidebar');
						$this->load->view('dashboard/4-content');
						$this->load->view('dashboard/5-configbar');
						$this->load->view('dashboard/6-footer');
				}
		}
		
		public static	function mountDashboard($tela_central, $dados){
				$CI	=	get_instance();
				$CI->load->view('dashboard/1-header', $dados);
				$CI->load->view('dashboard/2-topbar', $dados);
				$CI->load->view('dashboard/3-sidebar', $dados);
				$CI->load->view('dashboard/4-content-open', $dados);
				$CI->load->view('dashboard/'.$tela_central, $dados);
				$CI->load->view('dashboard/4-content-close', $dados);
				$CI->load->view('dashboard/5-configbar', $dados);
				$CI->load->view('dashboard/6-footer', $dados);
		}

		/* Mensagens
			 ########################################################################### */

		public	function	todas_as_mensagens()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"msg";
				$dados['subMenuAtivo']	=	"msg_01";
				self::mountDashboard('telas/mensagem/todas_as_mensagens_view',	$dados);
		}

		public	function	apagar_mensagem($id)	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$apagada	=	Mensagem_model::deleteMensagem($id);
				if	($apagada)	{
						echo	"<script>javascript:history.back(-2)</script>";
				}	else	{
						redirect(base_url('dashboard/home/2'));
				}
		}

		public	function	msg_ult_30_dias()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"msg";
				$dados['subMenuAtivo']	=	"msg_02";
				self::mountDashboard('telas/mensagem/mensagens_ult_30_dias_view',	$dados);
		}

		public	function	ler_mensagem($id)	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"msg";
				$dados['subMenuAtivo']	=	"";
				$dados['id_mensagem']	=	$id;
				self::mountDashboard('telas/mensagem/ler_mensagem_view',	$dados);
		}

		public	function	responder_mensagem()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$getpost	=	filter_input_array(INPUT_POST,	FILTER_DEFAULT);
				$assunto	=	$getpost['assunto'];
				$mensagem	=	$getpost['editor1'];
				$destinatario	=	$getpost['destinatario'];
				$sucesso	=	Email_model::emailHTML($destinatario,	$assunto,	$mensagem);
				if	($sucesso)	{
						$msg	=	"Resposta enviada com sucesso.";
						$alert	=	Helper::mountAlertBt3($msg,	'info');
						echo	$alert;
				}	else	{
						$msg	=	"Aconteceu um erro ao enviar o email, se persistir informe ao administrador.";
						$alert	=	Helper::mountAlertBt3($msg,	'info');
						echo	$alert;
				}
		}

		/* Contatos
			 ############################################################################ */

		public	function	listar_contatos()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"contatos";
				$dados['subMenuAtivo']	=	"contatos_01";
				self::mountDashboard('telas/contatos/gerenciar_contatos_view',	$dados);
		}

		public	function	apagar_contato($id)	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$apagada	=	Contato_model::deleteContato($id);
				if	($apagada)	{
						echo	"<script>javascript:history.back(-2)</script>";
				}	else	{
						redirect(base_url('dashboard/home/2'));
				}
		}

		public	function	exportar_contatos_csv()	{
				$contatos	=	Contato_model::getTodosOsContatos();
				$contador	=	1;
				$linha[0]	=	"Nome";
				$linha[1]	=	"Telefone";
				$linha[2]	=	"Email";
				$linha[3]	=	'Data de cadastro';
				$array_de_arrays[0]	=	$linha;
				foreach	($contatos	as	$contato)	{
						$linha[0]	=	$contato->getNome();
						$linha[1]	=	$contato->getTelefone();
						$linha[2]	=	$contato->getEmail();
						$linha[3]	=	$contato->getData_de_cadastro();
						$array_de_arrays[$contador]	=	$linha;
						$contador++;
				}
				Helper::gerarEBaixarCsv($array_de_arrays);
		}

		/* Email
			 ########################################################################## */

		public	function	email_boas_vindas()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"email";
				$dados['subMenuAtivo']	=	"email_01";
				$dados['legenda_do_form']	=	"Email de boas vindas";
				$dados['label']	=	"Email que será enviado para o usuário que se inscrever na newsletter";
				$dados['nome_option']	=	"email_de_boas_vindas";
				self::mountDashboard('telas/option/editar_option_text_area_view',	$dados);
		}

		public	function	email_promocional()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"email";
				$dados['subMenuAtivo']	=	"email_02";
				self::mountDashboard('telas/email/email_promocional_view',	$dados);
		}

		public	function	enviar_email_promocional()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$getpost	=	filter_input_array(INPUT_POST,	FILTER_DEFAULT);
				$assunto	=	$getpost['assunto'];
				$mensagem	=	$getpost['mensagem'];
				$contatos	=	Contato_model::getTodosOsContatos();
				foreach	($contatos	as	$contato)	{
						$destinatario	=	$contato->getEmail();
						Email_model::emailHTML($destinatario,	$assunto,	$mensagem);
				}
				$msg	=	"Operação realizada com sucesso.";
				$alert	=	Helper::mountAlertBt3($msg,	'info');
				echo	$alert;
		}

		/* TagManager
			 ############################################################################ */

		public	function	gerenciar_tags()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"tag";
				$dados['subMenuAtivo']	=	"tag_01";
				$dados['legenda_do_form']	=	"Tags";
				$dados['label']	=	"Tags de rastreio tipo google analytcs, facebook pixel etc. Elas serão inseridas no rodapé de seu site.";
				$dados['nome_option']	=	"tags";
				self::mountDashboard('telas/tagmanager/gerenciar_tags_de_rastreio_view',	$dados);
		}

		/* notícias
			 ############################################################################ */

		public	function	nova_noticia()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"noticia";
				$dados['subMenuAtivo']	=	"noticia_02";
				self::mountDashboard('telas/noticias/nova_noticia_view',	$dados);
		}

		public	function	salvar_nova_noticia()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$getpost	=	filter_input_array(INPUT_POST,	FILTER_DEFAULT);
				$titulo	=	$getpost['titulo'];
				$corpo	=	$getpost['corpo'];
				$imagem	=	(isset($_FILES['imagem']))	?	Helper::salvarImagem($_FILES['imagem'])	:	'';
				$status	=	$getpost['status'];
				$visibilidade	=	1;
				$categorias	=	$getpost['categorias'];
				$tags	=	$getpost['tags'];
				$token	=	Helper::gerarIdUnico();
				$login_autor	=	$this->session->userdata('login_usuario');
				$autor	=	Usuario_model::retornarIdInserindoLogin($login_autor);
				$data_cadastro	=	Helper::getDatetime();
				$data_atualizacao	=	$data_cadastro;
				$ultimo_usuario_que_atualizou	=	$autor;
				$sucesso	=	Noticia_model::cadastrarNoticia($titulo,	$corpo,	$imagem,	$status,	$visibilidade,	$token,	$autor,	$data_cadastro,	$data_atualizacao,	$ultimo_usuario_que_atualizou);
				$id_noticia	=	Noticia_model::recuperarIdInserindoToken($token);
				foreach	($categorias	as	$categoria)	{
						Noticia_categoria_model::cadastrarNoticia_categoria($categoria,	$id_noticia);
				}
				foreach	($tags	as	$tag)	{
						Noticia_tag_model::cadastrarNoticia_tag($tag,	$id_noticia);
				}
				if	($sucesso)	{
						redirect(base_url('dashboard/home/1'));
				}	else	{
						redirect(base_url('dashboard/home/2'));
				}
		}

		public	function	todas_as_noticia()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"noticia";
				$dados['subMenuAtivo']	=	"noticia_01";
				self::mountDashboard('telas/noticias/gerenciar_noticia_view',	$dados);
		}

		public	function	editar_noticia($id)	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"";
				$dados['subMenuAtivo']	=	"";
				$dados['id_noticia']	=	$id;
				self::mountDashboard('telas/noticias/editar_noticia_view',	$dados);
		}

		public	function	salvar_noticia_editada()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$getpost	=	filter_input_array(INPUT_POST,	FILTER_DEFAULT);
				$id_noticia	=	$getpost['id'];
				$noticia	=	Noticia_model::getObjNoticia($id_noticia);
				$titulo	=	$getpost['titulo'];
				$corpo	=	$getpost['corpo'];
				$imagem_1	=	(isset($_FILES['imagem']))	?	$_FILES['imagem']	:	FALSE;
				if	($imagem_1	&&	!empty($imagem_1["name"]))	{
						Helper::apagarImagem($noticia->getImagem());
						$imagem	=	Helper::salvarImagem($imagem);
				}	else	{
						$imagem	=	$noticia->getImagem();
				}
				$status	=	$getpost['status'];
				$visibilidade	=	1;
				if	(isset($getpost['categorias']))	{
						$categorias	=	$getpost['categorias'];
				}
				if	(isset($getpost['tags']))	{
						$tags	=	$getpost['tags'];
				}
				$token	=	$noticia->getToken();
				$login_editor	=	$this->session->userdata('login_usuario');
				$autor	=	$noticia->getAutor();
				$data_cadastro	=	$noticia->getData_cadastro();
				$data_atualizacao	=	Helper::getDatetime();
				$ultimo_usuario_que_atualizou	=	Usuario_model::retornarIdInserindoLogin($login_editor);
				$sucesso	=	Noticia_model::editarNoticia($id_noticia,	$titulo,	$corpo,	$imagem,	$status,	$visibilidade,	$token,	$autor,	$data_cadastro,	$data_atualizacao,	$ultimo_usuario_que_atualizou);

				//apagando as categorias e tags antigas
				$catsAntigas	=	Noticia_categoria_model::getTodosOsNoticia_categorias($id_noticia);
				if	(!is_string($catsAntigas[0]))	{
						Noticia_categoria_model::apagarNoticia_categoriaPorNoticia($id_noticia);
				}
				$tagsAntigas	=	Noticia_tag_model::getTodosOsNoticia_tags($id_noticia);
				if	(!is_string($tagsAntigas[0]))	{
						Noticia_tag_model::apagarNoticia_tagPorNoticia($id_noticia);
				}

				//salvando as novas categorias e tags no banco
				if	(count($categorias)	>	0)	{
						foreach	($categorias	as	$categoria)	{
								Noticia_categoria_model::cadastrarNoticia_categoria($categoria,	$id_noticia);
						}
				}

				foreach	($tags	as	$tag)	{
						Noticia_tag_model::cadastrarNoticia_tag($tag,	$id_noticia);
				}

				if	($sucesso)	{
						redirect(base_url('dashboard/home/1'));
				}	else	{
						redirect(base_url('dashboard/home/2'));
				}
		}

		public	function	apagar_noticia($id)	{
				$apagada	=	Noticia_model::deleteNoticia($id);
				if	($apagada)	{
						echo	"<script>javascript:history.back(-2)</script>";
				}	else	{
						redirect(base_url('dashboard/home/2'));
				}
		}

		/* notícias - tag
			 ############################################################################ */

		public	function	tag_noticia()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"noticia";
				$dados['subMenuAtivo']	=	"noticia_04";
				self::mountDashboard('telas/noticias/tag_noticia_view',	$dados);
		}

		public	function	salvar_nova_tag()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$getpost	=	filter_input_array(INPUT_POST,	FILTER_DEFAULT);
				$nome	=	$getpost['nome'];
				$slug	=	$getpost['slug'];
				$descricao	=	$getpost['descricao'];
				$sucesso	=	Tag_model::cadastrarTag($nome,	$slug,	$descricao);
				if	($sucesso)	{
						$msg	=	"Tag salva com sucesso";
						$alert = Helper::mountAlertBt3($msg, 'info');
						echo	$alert;
				}	else	{
						$msg	=	"Aconteceu um erro ao cadastrar no banco de dados, se persistir informe ao programador.";
						$alert = Helper::mountAlertBt3($msg, 'danger');
						echo	$alert;
				}
		}

		public	function	apagar_tag($id)	{
				//mostrar msg para o usuario que pode dar erro porque essa tag esta ligada a alguma noticia
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$apagada	=	Tag_model::deleteTag($id);
				if	($apagada)	{
						echo	"<script>javascript:history.back(-2)</script>";
				}	else	{
						redirect(base_url('dashboard/home/2'));
				}
		}

		/* noticia - categoria
			 ############################################################################ */

		public	function	categoria_noticia()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"noticia";
				$dados['subMenuAtivo']	=	"noticia_03";
				self::mountDashboard('telas/noticias/tag_categoria_view',	$dados);
		}

		public	function	salvar_nova_categoria()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$getpost	=	filter_input_array(INPUT_POST,	FILTER_DEFAULT);
				$nome	=	$getpost['nome'];
				$slug	=	$getpost['slug'];
				$descricao	=	$getpost['descricao'];
				$sucesso	=	Categoria_model::cadastrarCategoria($nome,	$slug,	$descricao);
				if	($sucesso)	{
						$msg	=	"Categoria salva com sucesso.";
						$alert = Helper::mountAlertBt3($msg, 'info');
						echo	$alert;
				}	else	{
						$msg	=	"Aconteceu um erro ao cadastrar no banco de dados, se persistir informe ao programador.";
						$alert = Helper::mountAlertBt3($msg, 'danger');
						echo	$alert;
				}
		}

		public	function	apagar_categoria($id)	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$apagada	=	Categoria_model::deleteCategoria($id);
				if	($apagada)	{
						echo	"<script>javascript:history.back(-2)</script>";
				}	else	{
						redirect(base_url('dashboard/home/2'));
				}
		}

		/* redes sociais
			 ########################################################################### */

		public	function	link_facebook()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"redes_sociais";
				$dados['subMenuAtivo']	=	"redes_sociais_01";
				$dados['legenda_do_form']	=	"Editar link do facebook";
				$dados['label']	=	"Link do facebook de sua empresa";
				$dados['nome_option']	=	"link_rede_social_facebook";
				self::mountDashboard('telas/option/editar_option_input_text_view',	$dados);
		}

		public	function	link_instagram()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"redes_sociais";
				$dados['subMenuAtivo']	=	"redes_sociais_02";
				$dados['legenda_do_form']	=	"Editar link do Instagram";
				$dados['label']	=	"Link do Instagram de sua empresa";
				$dados['nome_option']	=	"link_rede_social_instagram";
				self::mountDashboard('telas/option/editar_option_input_text_view',	$dados);
		}

		public	function	link_twitter()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"redes_sociais";
				$dados['subMenuAtivo']	=	"redes_sociais_03";
				$dados['legenda_do_form']	=	"Editar link do Twitter";
				$dados['label']	=	"Link do Twitter de sua empresa";
				$dados['nome_option']	=	"link_rede_social_twitter";
				self::mountDashboard('telas/option/editar_option_input_text_view',	$dados);
		}

		public	function	link_youtube()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"redes_sociais";
				$dados['subMenuAtivo']	=	"redes_sociais_04";
				$dados['legenda_do_form']	=	"Editar link do Youtube";
				$dados['label']	=	"Link do Youtube de sua empresa";
				$dados['nome_option']	=	"link_rede_social_youtube";
				self::mountDashboard('telas/option/editar_option_input_text_view',	$dados);
		}

		public	function	link_gplus()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"redes_sociais";
				$dados['subMenuAtivo']	=	"redes_sociais_05";
				$dados['legenda_do_form']	=	"Editar link do G+";
				$dados['label']	=	"Link do G+ de sua empresa";
				$dados['nome_option']	=	"link_rede_social_gplus";
				self::mountDashboard('telas/option/editar_option_input_text_view',	$dados);
		}

		public	function	link_linkedin()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"redes_sociais";
				$dados['subMenuAtivo']	=	"redes_sociais_06";
				$dados['legenda_do_form']	=	"Editar link do Linkedin";
				$dados['label']	=	"Link do Linkedin de sua empresa";
				$dados['nome_option']	=	"link_rede_social_linkedin";
				self::mountDashboard('telas/option/editar_option_input_text_view',	$dados);
		}

		/* Biblioteca de imagens
			 ########################################################################### */

		public	function	gerenciar_galeria()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"galeria";
				$dados['subMenuAtivo']	=	"galeria_01";
				self::mountDashboard('telas/galeria/gerenciar_galeria_view',	$dados);
		}

		/* configurações gerais
			 ########################################################################## */

		public	function	editar_senha_usuario()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"config";
				$dados['subMenuAtivo']	=	"config_03";
				self::mountDashboard('telas/config/editar_senha_usuario_view',	$dados);
		}

		public	function	trocar_senha_usuario()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$getpost	=	filter_input_array(INPUT_POST,	FILTER_DEFAULT);
				$senha_atual	=	$getpost['senha_atual'];
				$nova_senha	=	$getpost['senha_nova'];
				$login	=	$this->session->userdata('login_usuario');
				$autenticado	=	Usuario_model::autenticaLogin($login,	$senha_atual);
				if	($autenticado)	{
						$att	=	Usuario_model::atualizar_senha($login,	$nova_senha);
						if	($att)	{
								$this->load->view('dashboard/1-header');
								$this->load->view('dashboard/2-topbar');
								$this->load->view('dashboard/3-sidebar');
								$this->load->view('dashboard/4-content');
								$this->load->view('dashboard/5-configbar');
								$this->load->view('dashboard/6-footer');
								echo	"		<script>
																alert(\"Senha atualizada com sucesso.\");
														</script>";
						}	else	{
								$this->load->view('dashboard/1-header');
								$this->load->view('dashboard/2-topbar');
								$this->load->view('dashboard/3-sidebar');
								$this->load->view('dashboard/4-content');
								$this->load->view('dashboard/5-configbar');
								$this->load->view('dashboard/6-footer');
								echo	"   <script>
																alert(\"Erro ao atualizar a senha.\");
														</script>";
						}
				}	else	{
						$this->load->view('dashboard/1-header');
						$this->load->view('dashboard/2-topbar');
						$this->load->view('dashboard/3-sidebar');
						$this->load->view('dashboard/4-content');
						$this->load->view('dashboard/5-configbar');
						$this->load->view('dashboard/6-footer');
						echo	"   <script>
														alert(\"Senha atual digitada incorretamente.\");
												</script>";
				}
		}

		public	function	editar_email_principal()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"config";
				$dados['subMenuAtivo']	=	"config_01";
				$dados['legenda_do_form']	=	"Email principal ";
				$dados['label']	=	"Email que irá receber todas as mensagens enviadas de formulários no site";
				$dados['nome_option']	=	"email_principal";
				self::mountDashboard('telas/option/editar_option_input_text_view',	$dados);
		}

		public	function	salvar_option()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$getpost	=	filter_input_array(INPUT_POST,	FILTER_DEFAULT);
				$valor	=	$getpost['valor_option'];
				$nome	=	$getpost['nome_option'];
				$sucesso	=	Option_model::atualizarOption($nome,	$valor);
				if	($sucesso)	{
						$msg	=	"Operação realizada com sucesso.";
						$alert = Helper::mountAlertBt3($msg, 'info');
						echo	$alert;
				}	else	{
						$msg	=	"Aconteceu um erro ao salvar ou você tentou salvar sem editar nada, se persistir informe ao administrador.";
						$alert = Helper::mountAlertBt3($msg, 'danger');
						echo	$alert;
				}
		}

		public	function	editar_nome_da_empresa()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"config";
				$dados['subMenuAtivo']	=	"config_02";
				$dados['legenda_do_form']	=	"Nome da empresa";
				$dados['label']	=	"Nome de empresa dona deste site.";
				$dados['nome_option']	=	"nome_da_empresa";
				self::mountDashboard('telas/option/editar_option_input_text_view',	$dados);
		}

		/* modo de manutenção
			 ########################################################################## */

		public	function	site_em_manutencao()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$dados['menuAtivo']	=	"config";
				$dados['subMenuAtivo']	=	"config_04";
				$dados['ativo']	=	Option_model::recuperarOption('manutencao');
				self::mountDashboard('telas/manutencao/manutencao_view',	$dados);
		}

		public	function	ativar_modo_manutencao()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$nome	=	"manutencao";
				$valor	=	TRUE;
				Option_model::atualizarOption($nome,	$valor);
				redirect(base_url('dashboard/site_em_manutencao'));
		}

		public	function	desativar_modo_manutencao()	{
				Usuario_model::verificaSessao($this->session->userdata('esta_logado'));
				$nome	=	"manutencao";
				$valor	=	FALSE;
				Option_model::atualizarOption($nome,	$valor);
				redirect(base_url('dashboard/site_em_manutencao'));
		}

}
