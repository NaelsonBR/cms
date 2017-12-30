<?php

/*
	* Autor: Peterson Passos
	* peterson.jfp@gmail.com
	* 51 9921298121
	*/
defined('BASEPATH')	OR	exit('No direct script access allowed');

class	Helper	extends	CI_Model	{

		function	__construct()	{
				parent::__construct();
				// aqui deverá ser carregado os helpers, libraries e models necessários
		}

		public	static	function	verificaManutencao()	{
				$manutencao	=	Option_model::recuperarOption('manutencao');
				if	($manutencao)	{
						redirect(base_url('pages/manutencao'));
						exit();
				}
		}

		/* Datas
			 ############################################################### */

		/**
			* recebe aaaa-mm-aa e retorna dd/mm/aaaa
			*/
		public	static	function	DataUSA_to_BR($data)	{
				$nova_data	=	implode('/',	array_reverse(explode('-',	$data)));
				return	$nova_data;
		}

		/**
			* recebe dd/mm/aaaa e retorna aaaa-mm-dd 
			*/
		public	static	function	DataBR_to_USA($data)	{
				$nova_data	=	implode('-',	array_reverse(explode('/',	$data)));
				return	$nova_data;
		}

		/**
			* calcula a diferença em dias entre duas datas e a retorna
			*/
		public	static	function	calcularDiferencaEmDias($data_maior,	$data_menor)	{
				$d1	=	strtotime($data_maior);
				$d2	=	strtotime($data_menor);
				$diferenca	=	$d1	-	$d2;
				$dias	=	(int)	floor($diferenca	/	(60	*	60	*	24));
				return	$dias;
		}

		/**
			* adiciona a quantidade passada como parametro de dias a uma data e a retorna
			*/
		public	static	function	adicionarDiasAUmaData($data_atual,	$dias_a_ser_adicionado)	{
				date_default_timezone_set("America/Sao_Paulo");
				$data	=	date('Y-m-d',	strtotime("$dias_a_ser_adicionado days",	strtotime($data_atual)));
				return	$data;
		}

		/**
			* retorna a data atual no formato aaaa-mm-dd
			*/
		public	static	function	getData()	{
				date_default_timezone_set("America/Sao_Paulo");
				$data	=	date('Y-m-d');
				return	$data;
		}

		/**
			* retorna um datetime atual no formato aaaa-mm-dd hh:min:seg
			*/
		public	static	function	getDatetime()	{
				date_default_timezone_set("America/Sao_Paulo");
				$data	=	date('Y-m-d H:i:s');
				return	$data;
		}

		/**
			* retorna o ano atual
			*/
		public	static	function	getAno()	{
				date_default_timezone_set("America/Sao_Paulo");
				$data	=	date('Y');
				return	$data;
		}

		/**
			* retorna o mes atual
			*/
		public	static	function	getMes()	{
				date_default_timezone_set("America/Sao_Paulo");
				$data	=	date('m');
				return	$data;
		}

		/**
			* retorna o dia atual
			*/
		public	static	function	getDia()	{
				date_default_timezone_set("America/Sao_Paulo");
				$data	=	date('d');
				return	$data;
		}

		/**
			* retorna mm-dd
			*/
		public	static	function	getMesEDia()	{
				date_default_timezone_set("America/Sao_Paulo");
				$data	=	date('m-d');
				return	$data;
		}

		/**
			* recebe HH:mm:ss e retorna 00h00min00s
			*/
		public	static	function	formatarHora($hora)	{
				$array	=	explode(':',	$hora);
				$h	=	$array[0];
				$min	=	$array[1];
				$s	=	$array[2];
				$hora_formatada	=	"$h"	.	"h"	.	"$min"	.	"min"	.	"$s"	.	"s";
				return	$hora_formatada;
		}

		/**
			* insere aaaa-mm-dd hh:mm:ss e retorna
			* dd/mm/aaaa 00h00min00s
			*/
		public	static	function	formatarDateTime($dateTime)	{
				//9h25min6s
				$array	=	explode(' ',	$dateTime);
				$data	=	self::DataUSA_to_BR($array[0]);
				$hora	=	self::formatarHora($array[1]);
				return	"$data $hora";
		}

		/**
			* insere aaaa-mm-dd hh:mm:ss e retorna aaaa-mm-dd
			*/
		public	static	function	retornarDataInserindoDateTime($dateTime)	{
				$dataArray	=	explode(' ',	$dateTime);
				return	$dataArray[0];
		}

		/**
			* insere aaaa-mm-dd hh:mm:ss e retorna hh:mm:ss
			*/
		public	static	function	retornarHoraInserindoDateTime($dateTime)	{
				$dataArray	=	explode(' ',	$dateTime);
				return	$dataArray[1];
		}

		/**
			* Compara duas datas devolvendo true se a primeira for maior
			* e false se a primeira for menor.
			*/
		public	static	function	compararData($data_1,	$data_2)	{
				if	(strtotime($data_1)	>	strtotime($data_2))	{
						return	TRUE;
				}	else	{
						return	FALSE;
				}
		}

		/**
			* adiciona o numero passado de anos a uma data e a retorna
			* formato esperado aaaa-mm-dd
			*/
		public	static	function	adicionarAnosAUmaData($data,	$numero_de_anos)	{
				$array	=	explode('-',	$data);
				$ano	=	$array[0];
				$mes	=	$array[1];
				$dia	=	$array[2];
				$ano_somado	=	$ano	+	$numero_de_anos;
				$data_final	=	"$ano_somado-$mes-$dia";
				return	$data_final;
		}

		/* manipulação de imagens
			 ############################################################################ */

		/**
			* Recebe uma imagem recém recebida por post, move ela para a pasta uploads e
			* retorna o nome gerado para ela.
			*/
		public	static	function	salvarImagem($imagem)	{
				// Se a foto 1 existir
				if	(!empty($imagem["name"]))	{

						//pega nome completo da imagem
						$nome_completo	=	$imagem["name"];

						// Pega extensão da imagem o joga na var $ext
						preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i",	$imagem["name"],	$ext);

						//coloca o nome completo na var final para testar
						$nome_imagem	=	$nome_completo;

						//define a pasta
						$pasta	=	'assets/uploads/';

						//sufixo auxiliar
						$sufixo	=	-1;

						//teste de disponibilidade
						while	(!self::VerSeNomeEstaDisponivel($pasta,	$nome_imagem))	{
								$nome_sem_ext_0	=	str_replace($ext[1],	'',	$nome_completo);
								$tamanho	=	strlen($nome_sem_ext_0);
								$nome_sem_ext	=	substr($nome_sem_ext_0,	0,	$tamanho	-	1);
								$nome_imagem	=	"$nome_sem_ext"	.	"$sufixo."	.	"$ext[1]";
								$sufixo--;
						}

						// Caminho de onde ficará a imagem
						$caminho_imagem	=	'assets/uploads/'	.	$nome_imagem;

						// Faz o upload da imagem para seu respectivo caminho
						$sucesso	=	move_uploaded_file($imagem["tmp_name"],	$caminho_imagem);

						//retorna o nome dado para a imagem caso sucesso
						if	($sucesso)	{
								return	$nome_imagem;
						}	else	{
								return	"";
						}
				}	else	{
						return	"";
				}
		}

		/**
			* Recebe uma imagem recem upada do $_FILES, mantem o mesmo nome e add um sufixo
			* se for necessario para diferencia-la, redimensiona-a para largura e altura 
			* passados, salva na pasta assets/uploads e retornar o nome com o qual ela foi salva no banco.
			*/
		public	static	function	salvarImagemRedimensinando($imagem,	$largura,	$altura)	{
				// Se a foto 1 existir
				if	(!empty($imagem["name"]))	{

						//pega nome completo da imagem
						$nome_completo	=	$imagem["name"];

						// Pega extensão da imagem o joga na var $ext
						preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i",	$imagem["name"],	$ext);

						//coloca o nome completo na var final para testar
						$nome_imagem	=	$nome_completo;

						//define a pasta
						$pasta	=	'assets/uploads/';

						//sufixo auxiliar
						$sufixo	=	-1;

						//teste de disponibilidade
						while	(!self::VerSeNomeEstaDisponivel($pasta,	$nome_imagem))	{
								$nome_sem_ext_0	=	str_replace($ext[1],	'',	$nome_completo);
								$tamanho	=	strlen($nome_sem_ext_0);
								$nome_sem_ext	=	substr($nome_sem_ext_0,	0,	$tamanho	-	1);
								$nome_imagem	=	"$nome_sem_ext"	.	"$sufixo."	.	"$ext[1]";
								$sufixo--;
						}

						// Caminho de onde ficará a imagem
						$caminho_imagem	=	'assets/uploads/'	.	$nome_imagem;

						// Faz o upload da imagem para seu respectivo caminho
						$sucesso	=	move_uploaded_file($imagem["tmp_name"],	$caminho_imagem);

						//redimensionando a imagem
						self::redimensionarImagem($caminho_imagem,	$largura,	$altura);

						//retorna o nome dado para a imagem caso sucesso
						if	($sucesso)	{
								return	$nome_imagem;
						}	else	{
								return	"";
						}
				}	else	{
						return	"";
				}
		}

		/**
			* recebe o nome completo da imagem e apaga ela da pasta base/assets/uploads retornando
			* true ou false
			*/
		public	static	function	apagarImagem($imagem)	{
				$url	=	"assets/uploads/$imagem";
				$sucesso	=	unlink($url);
				return	$sucesso;
		}

		/**
			* Redimensiona uma imagem para a altura passada e largura proporcional a
			* da imagem original e a salva substituindo a original.
			* @param string $caminho Localização da imagem NÃO HTTP
			* @param string $altura novo heigth da imagem
			*/
		public	static	function	redimensionarImagemPorAltura($caminho,	$altura)	{
				$config['image_library']	=	'gd2';
				$config['source_image']	=	$caminho;
				$config['create_thumb']	=	FALSE;
				$config['maintain_ratio']	=	TRUE;
				$config['height']	=	$altura;

				$CI =& get_instance();
				
				$CI->load->library('image_lib',	$config);

				$CI->image_lib->resize();
		}

		/**
			* Redimensiona uma imagem para a largura passada e altura proporcional a
			* da imagem original e a salva substituindo a original.
			* @param string $caminho Localização da imagem NÃO HTTP
			* @param string $largura nova width da imagem
			*/
		public	static	function	redimensionarImagemPorLargura($caminho,	$largura)	{
				$config['image_library']	=	'gd2';
				$config['source_image']	=	$caminho;
				$config['create_thumb']	=	FALSE;
				$config['maintain_ratio']	=	TRUE;
				$config['width']	=	$largura;

				$CI =& get_instance();
				
				$CI->load->library('image_lib',	$config);

				$CI->image_lib->resize();
		}

		/**
			* Redimensiona a imagem para o valor exato passado esticando-a conforme necessario, 
			* pode distorcer a imagem se esta for upada com proporções diferentes.
			* @param string $caminho Localização da imagem NÃO HTTP
			* @param string $largura nova width da imagem
			* @param string $altura novo heigth da imagem
			*/
		public	static	function	redimensionarImagem($caminho,	$largura,	$altura)	{
				$config['image_library']	=	'gd2';
				$config['source_image']	=	$caminho;
				$config['create_thumb']	=	FALSE;
				$config['maintain_ratio']	=	FALSE;
				$config['width']	=	$largura;
				$config['height']	=	$altura;

				$CI =& get_instance();
				
				$CI->load->library('image_lib',	$config);

				$CI->image_lib->resize();
		}

		/* manipulação de string
			 ############################################################################ */

		/**
			* Recebe um texto e o numero máximo de caracteres e retorna um resumo do texto.
			*/
		public	static	function	criarResumo($texto,	$QuantidadeCaracteres)	{
				$Texto	=	strip_tags($texto);
				if	(strlen($Texto)	>	$QuantidadeCaracteres)	{
						while	(substr($Texto,	$QuantidadeCaracteres,	1)	<>	' '	&&	($QuantidadeCaracteres	<	strlen($Texto)))	{
								$QuantidadeCaracteres++;
						}
				}
				return	substr($Texto,	0,	$QuantidadeCaracteres)	.	'...';
		}

		/**
			* Recebe uma frase ou palavra escrita da forma comum e retorna um slug dessa
			* mesma frase ou palavra.
			*/
		public	static	function	criarSlug($string)	{
				$string	=	strtolower(trim(utf8_decode($string)));
				$before	=	'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr';
				$after	=	'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
				$string	=	strtr($string,	utf8_decode($before),	$after);
				$replace	=	array(
						'/[^a-z0-9.-]/'	=>	'-',
						'/-+/'	=>	'-',
						'/\-{2,}/'	=>	''
				);
				$string	=	preg_replace(array_keys($replace),	array_values($replace),	$string);
				$string	=	preg_replace(array('/([`^~\'"])/',	'/([-]{2,}|[-+]+|[\s]+)/',	'/(,-)/'),	array(null,	'-',	', '),	iconv('UTF-8',	'ASCII//TRANSLIT',	$string));
				return	$string;
		}

		/* manipulação de csv
			 ############################################################################ */

		public	static	function	gerarEBaixarCsv($array_de_arrays)	{
				self::cabecalhoDownloadCsv("contatos-"	.	date("d-m-Y")	.	".csv");
				echo	self::arrayParaCsv($array_de_arrays);
				die();
		}

		private	static	function	arrayParaCsv(array	&$array)	{
				if	(count($array)	==	0)	{
						return	null;
				}
				ob_start();
				$df	=	fopen("php://output",	'w');
				fputcsv($df,	array_keys(reset($array)));
				foreach	($array	as	$row)	{
						fputcsv($df,	$row);
				}
				fclose($df);
				return	ob_get_clean();
		}

		private	static	function	cabecalhoDownloadCsv($filename)	{
				// desabilitar cache
				$now	=	gmdate("D, d M Y H:i:s");
				header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
				header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
				header("Last-Modified: {$now} GMT");

				// forçar download  
				header("Content-Type: application/force-download");
				header("Content-Type: application/octet-stream");
				header("Content-Type: application/download");

				// disposição do texto / codificação
				header("Content-Disposition: attachment;filename={$filename}");
				header("Content-Transfer-Encoding: binary");
		}

		/* Valores
			 ################################################################ */

		/**
			* recebe um numero com virgula (99,90) e retorna um com ponto (99.00)
			*/
		public	static	function	valorRealParaDecimal($valor)	{
				//deixar so a virgula como caractere especial
				$valor1	=	preg_replace('/[^[:alnum:]_,]/',	'',	$valor);
				//trocar virgula por ponto
				$valor2	=	implode('.',	(explode(',',	$valor1)));
				//formatar o numero com 2 casas decimais
				$valor3	=	number_format($valor2,	"2",	".",	"");
				return	$valor3;
		}

		/**
			* recebe um numero decimal separado por ponto (9999.80) e retorna o mesmo 
			* numero formatado para exibição na tela como real brasileiro (R$ 9.999,80)
			*/
		public	static	function	valorDecimalParaReal($valor)	{
				$valor2	=	number_format($valor,	"2",	",",	".");
				$valor3	=	"R$ $valor2";
				return	$valor3;
		}

		/* manipulação de arquivos em geral e outras funções úteis
			 ############################################################### */

		/**
			* Recebe o caminho da pasta e um nome de arquivo e analisa se ja existe um arquivo
			* com o mesmo nome na pasta passada como parametro, retorna TRUE caso o nome 
			* esteja disponivel e FALSE cajo o nome já esteja sendo usado naquela pasta
			*/
		public	static	function	VerSeNomeEstaDisponivel($pasta,	$nome_do_arquivo)	{
				$nomeDosArquivosNaPasta	=	scandir($pasta);
				$nomeDisponivel	=	TRUE;
				foreach	($nomeDosArquivosNaPasta	as	$nomeArquivoNaPasta)	{
						if	($nomeArquivoNaPasta	==	$nome_do_arquivo)	{
								$nomeDisponivel	=	FALSE;
						}
				}
				return	$nomeDisponivel;
		}

		/**
			* recebe um caminho completo com nome do arquivo ex.:assets-img/img2.jpg e faz
			* o download desse arquivo para o pc do usuario
			*/
		public	static	function	forcarDownload($caminho_e_nome_do_arquivo_em_relacao_a_classe_arquivo)	{
				$arquivo	=	$caminho_e_nome_do_arquivo_em_relacao_a_classe_arquivo;

				$testa	=	substr($arquivo,	-3);
				$bloqueados	=	array('php',	'tml',	'htm',	'tml');
				// caso a extensão seja diferente das citadas acima ele 
				// executa normalmente o script 

				if	(!in_array($testa,	$bloqueados))	{

						if	(isset($arquivo)	&&	file_exists($arquivo))	{	// faz o teste se a variavel não esta vazia e se o arquivo realmente existe
								switch	(strtolower(substr(strrchr(basename($arquivo),	"."),	1)))	{	// verifica a extensão do arquivo para pegar o tipo
										case	"pdf":	$tipo	=	"application/pdf";
												break;
										case	"exe":	$tipo	=	"application/octet-stream";
												break;
										case	"zip":	$tipo	=	"application/zip";
												break;
										case	"doc":	$tipo	=	"application/msword";
												break;
										case	"xls":	$tipo	=	"application/vnd.ms-excel";
												break;
										case	"ppt":	$tipo	=	"application/vnd.ms-powerpoint";
												break;
										case	"gif":	$tipo	=	"image/gif";
												break;
										case	"png":	$tipo	=	"image/png";
												break;
										case	"jpg":	$tipo	=	"image/jpg";
												break;
										case	"mp3":	$tipo	=	"audio/mpeg";
												break;
										case	"php":	// deixar vazio por seurança
										case	"htm":	// deixar vazio por seurança
										case	"html":	// deixar vazio por seurança
								}
								header("Content-Type: "	.	$tipo);	// informa o tipo do arquivo ao navegador
								header("Content-Length: "	.	filesize($arquivo));	// informa o tamanho do arquivo ao navegador
								header("Content-Disposition: attachment; filename="	.	basename($arquivo));	// informa ao navegador que é tipo anexo e faz abrir a janela de download, tambem informa o nome do arquivo
								readfile($arquivo);	// lê o arquivo
								exit;	// aborta pós-ações
						}
				}	else	{
						echo	"Erro!";
						exit;
				}
		}

		/**
			* retorna o ip do usuario
			*/
		public	static	function	getUserIP()	{
				$ipaddress	=	'';
				if	(isset($_SERVER['HTTP_CLIENT_IP']))
						$ipaddress	=	$_SERVER['HTTP_CLIENT_IP'];
				else	if	(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
						$ipaddress	=	$_SERVER['HTTP_X_FORWARDED_FOR'];
				else	if	(isset($_SERVER['HTTP_X_FORWARDED']))
						$ipaddress	=	$_SERVER['HTTP_X_FORWARDED'];
				else	if	(isset($_SERVER['HTTP_FORWARDED_FOR']))
						$ipaddress	=	$_SERVER['HTTP_FORWARDED_FOR'];
				else	if	(isset($_SERVER['HTTP_FORWARDED']))
						$ipaddress	=	$_SERVER['HTTP_FORWARDED'];
				else	if	(isset($_SERVER['REMOTE_ADDR']))
						$ipaddress	=	$_SERVER['REMOTE_ADDR'];
				else
						$ipaddress	=	'UNKNOWN';
				return	$ipaddress;
		}

		/* Geração de senha, identificadores e string aleatórias
			 ############################################################### */

		/**
			* gera uma senha aleatoria contendo numeros e letras minusculas
			*/
		public	static	function	gerarSenha($tamanho)	{
				if	($tamanho	>	0)	{
						$id_aleatorio	=	"";
						for	($i	=	1;	$i	<=	$tamanho;	$i++)	{
								$numero	=	rand(1,	36);
								$id_aleatorio	.=	self::valorAleatorio($numero);
						}
				}
				return	$id_aleatorio;
		}

		/**
			* gera uma senha contendo letras maiusculas e minusculas, 
			* numeros e caraceteres especiais
			*/
		public	static	function	gerarSenhaComplexa($tamanho)	{
				if	($tamanho	>	0)	{
						$id_aleatorio	=	"";
						for	($i	=	1;	$i	<=	$tamanho;	$i++)	{
								$numero	=	rand(1,	80);
								$id_aleatorio	.=	self::valorAleatorioComplexo($numero);
						}
				}
				return	$id_aleatorio;
		}

		/**
			* gera um id unico alfanumerico baseado no microsegundo atual com prefixo e sufixo aleatorios
			*/
		public	static	function	gerarIdUnico()	{
				$p1	=	self::gerarSenha(6);
				$p2	=	uniqid();
				$p3	=	self::gerarSenha(6);
				$id	=	"$p1"	.	"$p2"	.	"$p3";
				return	$id;
		}

		public	static	function	gerarLoginCliente($nome_completo)	{
				$nome2	=	$nome_completo;
				$nome3	=	strtolower($nome2);
				$nome	=	explode(" ",	$nome3);
				if	(!isset($nome[1]))	{
						$nome[1]	=	"SemSobrenome";
				}
				$complemento	=	self::gerar_senha(4);
				$login	=	"$nome[0]"	.	".$nome[1]"	.	".$complemento";
				return	$login;
		}

		private	static	function	valorAleatorio($numero)	{
				switch	($numero)	{
						case	"1":
								$valor	=	"A";
								break;
						case	"2":
								$valor	=	"B";
								break;
						case	"3":
								$valor	=	"C";
								break;
						case	"4":
								$valor	=	"D";
								break;
						case	"5":
								$valor	=	"E";
								break;
						case	"6":
								$valor	=	"F";
								break;
						case	"7":
								$valor	=	"G";
								break;
						case	"8":
								$valor	=	"H";
								break;
						case	"9":
								$valor	=	"I";
								break;
						case	"10":
								$valor	=	"J";
								break;
						case	"11":
								$valor	=	"K";
								break;
						case	"12":
								$valor	=	"L";
								break;
						case	"13":
								$valor	=	"M";
								break;
						case	"14":
								$valor	=	"N";
								break;
						case	"15":
								$valor	=	"0";
								break;
						case	"16":
								$valor	=	"P";
								break;
						case	"17":
								$valor	=	"Q";
								break;
						case	"18":
								$valor	=	"R";
								break;
						case	"19":
								$valor	=	"S";
								break;
						case	"20":
								$valor	=	"T";
								break;
						case	"21":
								$valor	=	"U";
								break;
						case	"22":
								$valor	=	"V";
								break;
						case	"23":
								$valor	=	"W";
								break;
						case	"24":
								$valor	=	"X";
								break;
						case	"25":
								$valor	=	"Y";
								break;
						case	"26":
								$valor	=	"Z";
								break;
						case	"27":
								$valor	=	"0";
								break;
						case	"28":
								$valor	=	"1";
								break;
						case	"29":
								$valor	=	"2";
								break;
						case	"30":
								$valor	=	"3";
								break;
						case	"31":
								$valor	=	"4";
								break;
						case	"32":
								$valor	=	"5";
								break;
						case	"33":
								$valor	=	"6";
								break;
						case	"34":
								$valor	=	"7";
								break;
						case	"35":
								$valor	=	"8";
								break;
						case	"36":
								$valor	=	"9";
								break;
				}
				return	$valor;
		}

		private	static	function	valorAleatorioComplexo($numero)	{
				switch	($numero)	{
						case	"1":
								$valor	=	"a";
								break;
						case	"2":
								$valor	=	"b";
								break;
						case	"3":
								$valor	=	"c";
								break;
						case	"4":
								$valor	=	"d";
								break;
						case	"5":
								$valor	=	"e";
								break;
						case	"6":
								$valor	=	"f";
								break;
						case	"7":
								$valor	=	"g";
								break;
						case	"8":
								$valor	=	"h";
								break;
						case	"9":
								$valor	=	"i";
								break;
						case	"10":
								$valor	=	"j";
								break;
						case	"11":
								$valor	=	"k";
								break;
						case	"12":
								$valor	=	"l";
								break;
						case	"13":
								$valor	=	"m";
								break;
						case	"14":
								$valor	=	"n";
								break;
						case	"15":
								$valor	=	"o";
								break;
						case	"16":
								$valor	=	"p";
								break;
						case	"17":
								$valor	=	"q";
								break;
						case	"18":
								$valor	=	"r";
								break;
						case	"19":
								$valor	=	"s";
								break;
						case	"20":
								$valor	=	"t";
								break;
						case	"21":
								$valor	=	"u";
								break;
						case	"22":
								$valor	=	"v";
								break;
						case	"23":
								$valor	=	"w";
								break;
						case	"24":
								$valor	=	"x";
								break;
						case	"25":
								$valor	=	"y";
								break;
						case	"26":
								$valor	=	"z";
								break;
						case	"27":
								$valor	=	"0";
								break;
						case	"28":
								$valor	=	"1";
								break;
						case	"29":
								$valor	=	"2";
								break;
						case	"30":
								$valor	=	"3";
								break;
						case	"31":
								$valor	=	"4";
								break;
						case	"32":
								$valor	=	"5";
								break;
						case	"33":
								$valor	=	"6";
								break;
						case	"34":
								$valor	=	"7";
								break;
						case	"35":
								$valor	=	"8";
								break;
						case	"36":
								$valor	=	"9";
								break;
						case	"37":
								$valor	=	"A";
								break;
						case	"38":
								$valor	=	"B";
								break;
						case	"39":
								$valor	=	"C";
								break;
						case	"40":
								$valor	=	"D";
								break;
						case	"41":
								$valor	=	"E";
								break;
						case	"42":
								$valor	=	"F";
								break;
						case	"43":
								$valor	=	"G";
								break;
						case	"44":
								$valor	=	"H";
								break;
						case	"45":
								$valor	=	"I";
								break;
						case	"46":
								$valor	=	"J";
								break;
						case	"47":
								$valor	=	"K";
								break;
						case	"48":
								$valor	=	"L";
								break;
						case	"49":
								$valor	=	"M";
								break;
						case	"50":
								$valor	=	"N";
								break;
						case	"51":
								$valor	=	"O";
								break;
						case	"52":
								$valor	=	"P";
								break;
						case	"53":
								$valor	=	"Q";
								break;
						case	"54":
								$valor	=	"R";
								break;
						case	"55":
								$valor	=	"S";
								break;
						case	"56":
								$valor	=	"T";
								break;
						case	"57":
								$valor	=	"Y";
								break;
						case	"58":
								$valor	=	"U";
								break;
						case	"59":
								$valor	=	"V";
								break;
						case	"60":
								$valor	=	"W";
								break;
						case	"61":
								$valor	=	"X";
								break;
						case	"62":
								$valor	=	"Z";
								break;
						case	"63":
								$valor	=	"*";
								break;
						case	"64":
								$valor	=	"-";
								break;
						case	"65":
								$valor	=	"/";
								break;
						case	"66":
								$valor	=	"´";
								break;
						case	"67":
								$valor	=	"`";
								break;
						case	"68":
								$valor	=	"^";
								break;
						case	"69":
								$valor	=	"~";
								break;
						case	"70":
								$valor	=	"!";
								break;
						case	"71":
								$valor	=	"@";
								break;
						case	"72":
								$valor	=	"#";
								break;
						case	"73":
								$valor	=	'$';
								break;
						case	"74":
								$valor	=	"%";
								break;
						case	"75":
								$valor	=	"&";
								break;
						case	"76":
								$valor	=	"<";
								break;
						case	"77":
								$valor	=	">";
								break;
						case	"78":
								$valor	=	"§";
								break;
						case	"79":
								$valor	=	"=";
								break;
						case	"80":
								$valor	=	")";
								break;
				}
				return	$valor;
		}

}
