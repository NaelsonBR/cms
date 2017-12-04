<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Arquivo_model extends CI_Model {

	function __construct() {
		/* contrutor da classe pai */
		parent::__construct();
		/* helpers, libraries e models utilizados */
		$this->load->model('GeradorDeSenha_model');
		$this->load->library('My_WideImage');
	}

	/* manipulação de imagens
	  ############################################################################ */

	/**
	 * Recebe uma imagem recém recebida por post, move ela para a pasta uploads e
	 * retorna o nome gerado para ela.
	 */
	public static function salvarImagem($imagem) {
		// Se a foto 1 existir
		if (!empty($imagem["name"])) {

			//pega nome completo da imagem
			$nome_completo = $imagem["name"];

			// Pega extensão da imagem o joga na var $ext
			preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem["name"], $ext);

			//coloca o nome completo na var final para testar
			$nome_imagem = $nome_completo;

			//define a pasta
			$pasta = 'assets/uploads/';

			//sufixo auxiliar
			$sufixo = -1;

			//teste de disponibilidade
			while (!self::VerSeNomeEstaDisponivel($pasta, $nome_imagem)) {
				$nome_sem_ext_0 = str_replace($ext[1], '', $nome_completo);
				$tamanho = strlen($nome_sem_ext_0);
				$nome_sem_ext = substr($nome_sem_ext_0, 0, $tamanho - 1);
				$nome_imagem = "$nome_sem_ext" . "$sufixo." . "$ext[1]";
				$sufixo--;
			}

			// Caminho de onde ficará a imagem
			$caminho_imagem = 'assets/uploads/' . $nome_imagem;

			// Faz o upload da imagem para seu respectivo caminho
			$sucesso = move_uploaded_file($imagem["tmp_name"], $caminho_imagem);

			//retorna o nome dado para a imagem caso sucesso
			if ($sucesso) {
				return $nome_imagem;
			} else {
				return "";
			}
		} else {
			return "";
		}
	}

	/**
	 * Recebe uma imagem recem upada do $_FILES, mantem o mesmo nome e add um sufixo
	 * se for necessario para diferencia-la, redimensiona-a para largura e altura 
	 * passados, salva na pasta assets/uploads e retornar o nome com o qual ela foi salva no banco.
	 */
	public static function salvarImagemRedimensinando($imagem, $largura, $altura) {
		// Se a foto 1 existir
		if (!empty($imagem["name"])) {

			//pega nome completo da imagem
			$nome_completo = $imagem["name"];

			// Pega extensão da imagem o joga na var $ext
			preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem["name"], $ext);

			//coloca o nome completo na var final para testar
			$nome_imagem = $nome_completo;

			//define a pasta
			$pasta = 'assets/uploads/';

			//sufixo auxiliar
			$sufixo = -1;

			//teste de disponibilidade
			while (!self::VerSeNomeEstaDisponivel($pasta, $nome_imagem)) {
				$nome_sem_ext_0 = str_replace($ext[1], '', $nome_completo);
				$tamanho = strlen($nome_sem_ext_0);
				$nome_sem_ext = substr($nome_sem_ext_0, 0, $tamanho - 1);
				$nome_imagem = "$nome_sem_ext" . "$sufixo." . "$ext[1]";
				$sufixo--;
			}

			// Caminho de onde ficará a imagem
			$caminho_imagem = 'assets/uploads/' . $nome_imagem;

			// Faz o upload da imagem para seu respectivo caminho
			$sucesso = move_uploaded_file($imagem["tmp_name"], $caminho_imagem);

			//redimensionando a imagem
			self::redimensionarImagem($caminho_imagem, $largura, $altura);

			//retorna o nome dado para a imagem caso sucesso
			if ($sucesso) {
				return $nome_imagem;
			} else {
				return "";
			}
		} else {
			return "";
		}
	}

	/**
	 * recebe o nome completo da imagem e apaga ela da pasta base/assets/uploads retornando
	 * true ou false
	 */
	public static function apagarImagem($imagem) {
		$url = "assets/uploads/$imagem";
		$sucesso = unlink($url);
		return $sucesso;
	}

	/**
	 * Redimensiona uma imagem para a altura passada e largura proporcional a
	 * da imagem original e a salva substituindo a original.
	 * @param string $caminho Localização da imagem NÃO HTTP
	 * @param string $altura novo heigth da imagem
	 */
	public static function redimensionarImagemPorAltura($caminho, $altura) {
		$imagem = WideImage::load($caminho);
		$imagem2 = $imagem->resize(null, $altura, 'inside');
		$imagem2->saveToFile($caminho);
	}

	/**
	 * Redimensiona uma imagem para a largura passada e altura proporcional a
	 * da imagem original e a salva substituindo a original.
	 * @param string $caminho Localização da imagem NÃO HTTP
	 * @param string $largura nova width da imagem
	 */
	public static function redimensionarImagemPorLargura($caminho, $largura) {
		$imagem = WideImage::load($caminho);
		$imagem2 = $imagem->resize($largura, NULL, 'inside');
		$imagem2->saveToFile($caminho);
	}

	/**
	 * Redimensiona a imagem para o valor exato passado esticando-a conforme necessario, 
	 * pode destorcer a imagem se esta for upada com proporções diferentes.
	 * @param string $caminho Localização da imagem NÃO HTTP
	 * @param string $largura nova width da imagem
	 * @param string $altura novo heigth da imagem
	 */
	public static function redimensionarImagem($caminho, $largura, $altura) {
		$imagem = WideImage::load($caminho);
		$imagem2 = $imagem->resize($largura, $altura, 'fill');
		$imagem2->saveToFile($caminho);
	}

	/* manipulação de string
	  ############################################################################ */

	/**
	 * Recebe um texto e o numero máximo de caracteres e retorna um resumo do texto.
	 */
	public static function criarResumo($texto, $QuantidadeCaracteres) {
		$Texto = strip_tags($texto);
		if (strlen($Texto) > $QuantidadeCaracteres) {
			while (substr($Texto, $QuantidadeCaracteres, 1) <> ' ' && ($QuantidadeCaracteres < strlen($Texto))) {
				$QuantidadeCaracteres++;
			}
		}
		return substr($Texto, 0, $QuantidadeCaracteres) . '...';
	}

	/**
	 * Recebe uma frase ou palavra escrita da forma comum e retorna um slug dessa
	 * mesma frase ou palavra.
	 */
	public static function criarSlug($string) {
		$string = strtolower(trim(utf8_decode($string)));
		$before = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr';
		$after = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
		$string = strtr($string, utf8_decode($before), $after);
		$replace = array(
			'/[^a-z0-9.-]/' => '-',
			'/-+/' => '-',
			'/\-{2,}/' => ''
		);
		$string = preg_replace(array_keys($replace), array_values($replace), $string);
		$string = preg_replace(array('/([`^~\'"])/', '/([-]{2,}|[-+]+|[\s]+)/', '/(,-)/'), array(null, '-', ', '), iconv('UTF-8', 'ASCII//TRANSLIT', $string));
		return $string;
	}

	/* manipulação de csv
	  ############################################################################ */

	public static function gerarEBaixarCsv($array_de_arrays) {
		Arquivo_model::cabecalhoDownloadCsv("Seus_clientes_" . date("d-m-Y") . "_SuaFidelidade.csv");
		echo Arquivo_model::arrayParaCsv($array_de_arrays);
		die();
	}

	private static function arrayParaCsv(array &$array) {
		if (count($array) == 0) {
			return null;
		}
		ob_start();
		$df = fopen("php://output", 'w');
		fputcsv($df, array_keys(reset($array)));
		foreach ($array as $row) {
			fputcsv($df, $row);
		}
		fclose($df);
		return ob_get_clean();
	}

	private static function cabecalhoDownloadCsv($filename) {
		// desabilitar cache
		$now = gmdate("D, d M Y H:i:s");
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

	/* manipulação de arquivos em geral e outras funções úteis
	  ############################################################################ */

	/**
	 * Recebe o caminho da pasta e um nome de arquivo e analisa se ja existe um arquivo
	 * com o mesmo nome na pasta passada como parametro, retorna TRUE caso o nome 
	 * esteja disponivel e FALSE cajo o nome já esteja sendo usado naquela pasta
	 */
	public static function VerSeNomeEstaDisponivel($pasta, $nome_do_arquivo) {
		$nomeDosArquivosNaPasta = scandir($pasta);
		$nomeDisponivel = TRUE;
		foreach ($nomeDosArquivosNaPasta as $nomeArquivoNaPasta) {
			if ($nomeArquivoNaPasta == $nome_do_arquivo) {
				$nomeDisponivel = FALSE;
			}
		}
		return $nomeDisponivel;
	}

	/**
	 * recebe um caminho completo com nome do arquivo ex.:assets-img/img2.jpg e faz
	 * o download desse arquivo para o pc do usuario
	 */
	public static function forcarDownload($caminho_e_nome_do_arquivo_em_relacao_a_classe_arquivo) {
		$arquivo = $caminho_e_nome_do_arquivo_em_relacao_a_classe_arquivo;

		$testa = substr($arquivo, -3);
		$bloqueados = array('php', 'tml', 'htm', 'tml');
		// caso a extensão seja diferente das citadas acima ele 
		// executa normalmente o script 

		if (!in_array($testa, $bloqueados)) {

			if (isset($arquivo) && file_exists($arquivo)) { // faz o teste se a variavel não esta vazia e se o arquivo realmente existe
				switch (strtolower(substr(strrchr(basename($arquivo), "."), 1))) { // verifica a extensão do arquivo para pegar o tipo
					case "pdf": $tipo = "application/pdf";
						break;
					case "exe": $tipo = "application/octet-stream";
						break;
					case "zip": $tipo = "application/zip";
						break;
					case "doc": $tipo = "application/msword";
						break;
					case "xls": $tipo = "application/vnd.ms-excel";
						break;
					case "ppt": $tipo = "application/vnd.ms-powerpoint";
						break;
					case "gif": $tipo = "image/gif";
						break;
					case "png": $tipo = "image/png";
						break;
					case "jpg": $tipo = "image/jpg";
						break;
					case "mp3": $tipo = "audio/mpeg";
						break;
					case "php": // deixar vazio por seurança
					case "htm": // deixar vazio por seurança
					case "html": // deixar vazio por seurança
				}
				header("Content-Type: " . $tipo); // informa o tipo do arquivo ao navegador
				header("Content-Length: " . filesize($arquivo)); // informa o tamanho do arquivo ao navegador
				header("Content-Disposition: attachment; filename=" . basename($arquivo)); // informa ao navegador que é tipo anexo e faz abrir a janela de download, tambem informa o nome do arquivo
				readfile($arquivo); // lê o arquivo
				exit; // aborta pós-ações
			}
		} else {
			echo "Erro!";
			exit;
		}
	}

	/**
	 * retorna o ip do usuario
	 */
	public static function capturarIP() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP')) {
			$ipaddress = getenv('HTTP_CLIENT_IP');
		} else if (getenv('HTTP_X_FORWARDED_FOR')) {
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		} else if (getenv('HTTP_X_FORWARDED')) {
			$ipaddress = getenv('HTTP_X_FORWARDED');
		} else if (getenv('HTTP_FORWARDED_FOR')) {
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		} else if (getenv('HTTP_FORWARDED')) {
			$ipaddress = getenv('HTTP_FORWARDED');
		} else if (getenv('REMOTE_ADDR')) {
			$ipaddress = getenv('REMOTE_ADDR');
		} else {
			$ipaddress = 'UNKNOWN';
		}
		return $ipaddress;
	}

}
