<?php

/*
 * Autor: Peterson Passos
 * peterson.jfp@gmail.com
 * 51 9921298121
 */
defined('BASEPATH') OR exit('No direct script access allowed');

function verificaManutencao() {
    $manutencao = Option_model::recuperarOption('manutencao');
    if ($manutencao) {
        redirect(base_url('pages/manutencao'));
        exit();
    }
}

/* Datas
  ############################################################### */

/**
 * recebe aaaa-mm-aa e retorna dd/mm/aaaa
 */
function DataUSA_to_BR($data) {
    $nova_data = implode('/', array_reverse(explode('-', $data)));
    return $nova_data;
}

/**
 * recebe dd/mm/aaaa e retorna aaaa-mm-dd 
 */
function DataBR_to_USA($data) {
    $nova_data = implode('-', array_reverse(explode('/', $data)));
    return $nova_data;
}

/**
 * calcula a diferença em dias entre duas datas e a retorna
 */
function calcularDiferencaEmDias($data_maior, $data_menor) {
    $d1 = strtotime($data_maior);
    $d2 = strtotime($data_menor);
    $diferenca = $d1 - $d2;
    $dias = (int) floor($diferenca / (60 * 60 * 24));
    return $dias;
}

/**
 * adiciona a quantidade passada como parametro de dias a uma data e a retorna
 */
function adicionarDiasAUmaData($data_atual, $dias_a_ser_adicionado) {
    date_default_timezone_set("America/Sao_Paulo");
    $data = date('Y-m-d', strtotime("$dias_a_ser_adicionado days", strtotime($data_atual)));
    return $data;
}

/**
 * retorna a data atual no formato aaaa-mm-dd
 */
function getData() {
    date_default_timezone_set("America/Sao_Paulo");
    $data = date('Y-m-d');
    return $data;
}

/**
 * retorna um datetime atual no formato aaaa-mm-dd hh:min:seg
 */
function getDatetime() {
    date_default_timezone_set("America/Sao_Paulo");
    $data = date('Y-m-d H:i:s');
    return $data;
}

/**
 * retorna o ano atual
 */
function getAno() {
    date_default_timezone_set("America/Sao_Paulo");
    $data = date('Y');
    return $data;
}

/**
 * retorna o mes atual
 */
function getMes() {
    date_default_timezone_set("America/Sao_Paulo");
    $data = date('m');
    return $data;
}

/**
 * retorna o dia atual
 */
function getDia() {
    date_default_timezone_set("America/Sao_Paulo");
    $data = date('d');
    return $data;
}

/**
 * retorna mm-dd
 */
function getMesEDia() {
    date_default_timezone_set("America/Sao_Paulo");
    $data = date('m-d');
    return $data;
}

/**
 * recebe HH:mm:ss e retorna 00h00min00s
 */
function formatarHora($hora) {
    $array = explode(':', $hora);
    $h = $array[0];
    $min = $array[1];
    $s = $array[2];
    $hora_formatada = "$h" . "h" . "$min" . "min" . "$s" . "s";
    return $hora_formatada;
}

/**
 * insere aaaa-mm-dd hh:mm:ss e retorna
 * dd/mm/aaaa 00h00min00s
 */
function formatarDateTime($dateTime) {
//9h25min6s
    $array = explode(' ', $dateTime);
    $data = DataUSA_to_BR($array[0]);
    $hora = formatarHora($array[1]);
    return "$data $hora";
}

/**
 * insere aaaa-mm-dd hh:mm:ss e retorna aaaa-mm-dd
 */
function retornarDataInserindoDateTime($dateTime) {
    $dataArray = explode(' ', $dateTime);
    return $dataArray[0];
}

/**
 * insere aaaa-mm-dd hh:mm:ss e retorna hh:mm:ss
 */
function retornarHoraInserindoDateTime($dateTime) {
    $dataArray = explode(' ', $dateTime);
    return $dataArray[1];
}

/**
 * Compara duas datas devolvendo true se a primeira for maior
 * e false se a primeira for menor.
 */
function compararData($data_1, $data_2) {
    if (strtotime($data_1) > strtotime($data_2)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

/**
 * adiciona o numero passado de anos a uma data e a retorna
 * formato esperado aaaa-mm-dd
 */
function adicionarAnosAUmaData($data, $numero_de_anos) {
    $array = explode('-', $data);
    $ano = $array[0];
    $mes = $array[1];
    $dia = $array[2];
    $ano_somado = $ano + $numero_de_anos;
    $data_final = "$ano_somado-$mes-$dia";
    return $data_final;
}

/* manipulação de imagens
  ############################################################################ */

/**
 * Recebe uma imagem recém recebida por post, move ela para a pasta uploads e
 * retorna o nome gerado para ela.
 */
function salvarImagem($imagem) {
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
        while (!VerSeNomeEstaDisponivel($pasta, $nome_imagem)) {
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
function salvarImagemRedimensinando($imagem, $largura, $altura) {
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
        while (!VerSeNomeEstaDisponivel($pasta, $nome_imagem)) {
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
        redimensionarImagem($caminho_imagem, $largura, $altura);

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
function apagarImagem($imagem) {
//define a pasta
    if (VerSeNomeEstaDisponivel('assets/uploads/', $imagem)) {
        return TRUE;
    } else {
        $url = "assets/uploads/$imagem";
        $sucesso = unlink($url);
        return $sucesso;
    }
}

/**
 * Redimensiona uma imagem para a altura passada e largura proporcional a
 * da imagem original e a salva substituindo a original.
 * @param string $caminho Localização da imagem NÃO HTTP
 * @param string $altura novo heigth da imagem
 */
function redimensionarImagemPorAltura($caminho, $altura) {
    $config['image_library'] = 'gd2';
    $config['source_image'] = $caminho;
    $config['create_thumb'] = FALSE;
    $config['maintain_ratio'] = TRUE;
    $config['height'] = $altura;

    $CI = get_instance();
    $CI->load->library('image_lib', $config);
    $CI->image_lib->resize();
}

/**
 * Redimensiona uma imagem para a largura passada e altura proporcional a
 * da imagem original e a salva substituindo a original.
 * @param string $caminho Localização da imagem NÃO HTTP
 * @param string $largura nova width da imagem
 */
function redimensionarImagemPorLargura($caminho, $largura) {
    $config['image_library'] = 'gd2';
    $config['source_image'] = $caminho;
    $config['create_thumb'] = FALSE;
    $config['maintain_ratio'] = TRUE;
    $config['width'] = $largura;

    $CI = get_instance();
    $CI->load->library('image_lib', $config);
    $CI->image_lib->resize();
}

/**
 * Redimensiona a imagem para o valor exato passado esticando-a conforme necessario, 
 * pode distorcer a imagem se esta for upada com proporções diferentes.
 * @param string $caminho Localização da imagem NÃO HTTP
 * @param string $largura nova width da imagem
 * @param string $altura novo heigth da imagem
 */
function redimensionarImagem($caminho, $largura, $altura) {
    $config['image_library'] = 'gd2';
    $config['source_image'] = $caminho;
    $config['create_thumb'] = FALSE;
    $config['maintain_ratio'] = FALSE;
    $config['width'] = $largura;
    $config['height'] = $altura;

    $CI = get_instance();
    $CI->load->library('image_lib', $config);
    $CI->image_lib->resize();
}

/* manipulação de string
  ############################################################################ */

/**
 * Recebe um texto e o numero máximo de caracteres e retorna um resumo do texto.
 */
function criarResumo($texto, $QuantidadeCaracteres) {
    $Texto = strip_tags($texto);
    if (strlen($Texto) > $QuantidadeCaracteres) {
        while (substr($Texto, $QuantidadeCaracteres, 1) <> ' ' && ($QuantidadeCaracteres < strlen($Texto))) {
            $QuantidadeCaracteres++;
        }
        return substr($Texto, 0, $QuantidadeCaracteres) . '...';
    } else {
        return $texto;
    }
}

/**
 * Recebe uma frase ou palavra escrita da forma comum e retorna um slug dessa
 * mesma frase ou palavra.
 */
function criarSlug($string) {
    $string = strtolower(trim(utf8_decode($string)));
    $before = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr²³°';
    $after = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr23o';
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

/**
 * Monta um alert-dismissable do bootstrap 3 com a mensagem e o tipo passados e o retorna
 */
function mountAlertBt3($mensagem, $tipo = 'primary') {
    $alert = "	<div class='row'>
														<div class='alert alert-$tipo alert-dismissible fade in text-center' style='border: 1px solid #000;' role='alert'>
																<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
																		<span aria-hidden='true'>x</span>
																</button>
																<strong>$mensagem</strong> 
														</div>
											  </div>";
    return $alert;
}

/* manipulação de csv
  ############################################################################ */

function gerarEBaixarCsv($array_de_arrays) {
    cabecalhoDownloadCsv("contatos-" . date("d-m-Y") . ".csv");
    echo arrayParaCsv($array_de_arrays);
    die();
}

function arrayParaCsv(array &$array) {
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

function cabecalhoDownloadCsv($filename) {
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

/* Valores
  ################################################################ */

/**
 * recebe um numero com virgula (99,90) e retorna um com ponto (99.00)
 */
function valorRealParaDecimal($valor) {
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
function valorDecimalParaReal($valor) {
    $valor2 = number_format($valor, "2", ",", ".");
    $valor3 = "R$ $valor2";
    return $valor3;
}

/* manipulação de arquivos em geral e outras funções úteis
  ############################################################### */

/**
 * Recebe o caminho da pasta e um nome de arquivo e analisa se ja existe um arquivo
 * com o mesmo nome na pasta passada como parametro, retorna TRUE caso o nome 
 * esteja disponivel e FALSE cajo o nome já esteja sendo usado naquela pasta
 */
function VerSeNomeEstaDisponivel($pasta, $nome_do_arquivo) {
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
function forcarDownload($caminho_e_nome_do_arquivo_em_relacao_a_classe_arquivo) {
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
function getUserIP() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

/* Geração de senha, identificadores e string aleatórias
  ############################################################### */

/**
 * gera uma senha aleatoria contendo numeros e letras minusculas
 */
function gerarSenha($tamanho) {
    if ($tamanho > 0) {
        $id_aleatorio = "";
        for ($i = 1; $i <= $tamanho; $i++) {
            $numero = rand(1, 36);
            $id_aleatorio .= valorAleatorio($numero);
        }
    } else {
        return '';
    }
    return $id_aleatorio;
}

/**
 * gera um identificador unico alfanumerico baseado no microsegundo atual com prefixo(6) e sufixo(6) aleatorios
 * retorna uma string unica de aproximadamente 25 algarismos
 */
function gerarIdUnico() {
    $p1 = gerarSenha(6);
    $p2 = uniqid();
    $p3 = gerarSenha(6);
    $id = "$p1" . "$p2" . "$p3";
    return strtolower($id);
}

function gerarLoginCliente($nome_completo) {
    $nome2 = $nome_completo;
    $nome3 = strtolower($nome2);
    $nome = explode(" ", $nome3);
    if (!isset($nome[1])) {
        $nome[1] = "SemSobrenome";
    }
    $complemento = gerar_senha(4);
    $login = "$nome[0]" . ".$nome[1]" . ".$complemento";
    return $login;
}

function valorAleatorio($numero) {
    switch ($numero) {
        case "1":
            return "A";
        case "2":
            return "B";
        case "3":
            return "C";
        case "4":
            return "D";
        case "5":
            return "E";
        case "6":
            return "F";
        case "7":
            return "G";
        case "8":
            return "H";
        case "9":
            return "I";
        case "10":
            return "J";
        case "11":
            return "K";
        case "12":
            return "L";
        case "13":
            return "M";
        case "14":
            return "N";
        case "15":
            return "0";
        case "16":
            return "P";
        case "17":
            return "Q";
        case "18":
            return "R";
        case "19":
            return "S";
        case "20":
            return "T";
        case "21":
            return "U";
        case "22":
            return "V";
        case "23":
            return "W";
        case "24":
            return "X";
        case "25":
            return "Y";
        case "26":
            return "Z";
        case "27":
            return "0";
        case "28":
            return "1";
        case "29":
            return "2";
        case "30":
            return "3";
        case "31":
            return "4";
        case "32":
            return "5";
        case "33":
            return "6";
        case "34":
            return "7";
        case "35":
            return "8";
        case "36":
            return "9";
        default :
            return 'A';
    }
}
