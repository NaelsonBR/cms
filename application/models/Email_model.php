<?php

/* codigo que impossibilita o acesso direto sem passar pela home */
defined('BASEPATH') OR exit('No direct script access allowed');
/* todo controller DEVE extender CI_Controller */

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email_model extends CI_Model {
	/* construtor da classe que carregar os principais helpers
	  que podem ser usados dentro de toda a classe */

	function __construct() {
		/* contrutor da classe pai */
		parent::__construct();
		/* abaixo deverão ser carregados helpers, libraries e models utilizados
		  por este model */
		$this->load->model('Conect_model');
		$this->load->model('Data_model');
		$this->load->library('My_sendgrid');
	}

	public static function emailHTML($destinatario, $assunto, $mensagem) {
		$mail = new PHPMailer(true);							 // Passing `true` enables exceptions
		try {
			//Server settings
			//$mail->SMTPDebug = 2;								 // Enable verbose debug output
			$mail->isSMTP();									 // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;								// Enable SMTP authentication
			$mail->Username = 'publiciauto@gmail.com';				 // SMTP username
			$mail->Password = '61321284q';							// SMTP password
			$mail->SMTPSecure = 'tls';							// Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;									// TCP port to connect to
			$mail->CharSet = "utf-8"; //evitar erros de acentuação
			//Recipients
			$mail->setFrom('publiciauto@gmail.com', 'Publiciauto');
			$mail->addAddress($destinatario);				// Name is optional
			//$mail->addReplyTo('info@example.com', 'Information');
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');
			//Attachments
			//    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			//Content
			$mail->isHTML(true);								 // Set email format to HTML
			$mail->Subject = $assunto;
			$mail->Body = $mensagem;
			$mail->AltBody = 'Por favor visualize esse email em um leitor de email html';

			$mail->send();
			// Limpa os destinatários e os anexos
			$mail->ClearAllRecipients();
			$mail->ClearAttachments();
			return TRUE;
		} catch (Exception $e) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}

	public static function emailHTML2($destinatario, $assunto, $mensagem) {
		$mail = new PHPMailer();

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();									 // Set mailer to use SMTP
		$mail->Host = ''; // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;								// Enable SMTP authentication
		$mail->Username = '';				 // SMTP username
		$mail->Password = '';							// SMTP password
		$mail->SMTPSecure = 'ssl';							// Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;									// TCP port to connect to

		$mail->setFrom('', 'Suporte');
		//$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
		$mail->addAddress($destinatario);				// Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);								 // Set email format to HTML

		$mail->Subject = $assunto;
		$mail->Body = $mensagem;
		$mail->AltBody = 'Tem uma mensagem nova no seu site';

		if (!$mail->send()) {
			echo 'e';
		} else {
			return TRUE;
		}
	}

	public static function emailHtmlComMailRelay($destinatario, $assunto, $mensagem) {
		//email usando a api do mailrelay, enviando um json atraves de uma requisição curl
		$curl = curl_init('');

		// Create rcpt array
		$rcpt = array(
			array(
				'name' => null,
				'email' => $destinatario
			)
		);

		$postData = array(
			'function' => 'sendMail',
			'apiKey' => '',
			'subject' => $assunto,
			'html' => $mensagem,
			'mailboxFromId' => 2,
			'mailboxReplyId' => 2,
			'mailboxReportId' => 2,
			'packageId' => 6,
			'emails' => $rcpt
		);

		$post = http_build_query($postData);

		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		$json = curl_exec($curl);
		if ($json === false) {
			die('Request failed with error: ' . curl_error($curl));
		}

		$result = json_decode($json);
		if ($result->status == 0) {
			die('Bad status returned. Error: ' . $result->error);
		}

		curl_close($curl);
	}

	public static function emailHtmlComPhpMailler($destinatario, $assunto, $mensagem) {
		//REQUERIMENTO: CLASSE PHPMAILLER!!!!!
		//iniciando a classe
		$mailer = new PHPMailer();

		//dados tecnicos do email
		$mailer->CharSet = "utf-8"; //evitar erros de acentuação
		//$mailer->SMTPDebug = 3; //nivel de informaçoes
		$mailer->isSMTP(); //metodo que diz "é smtp"
		$mailer->SMTPAuth = TRUE; //autenticar email
		$mailer->SMTPSecure = "ssl"; //tipo de seguramça do servidor tsl ou ssl
		$mailer->isHTML(TRUE); //define o email como sendo enviado em html
		//dados de acesso ao smtp
		$mailer->Host = ""; //host do servidor da caixa de email
		$mailer->Username = ""; //login
		$mailer->Password = ""; //senha
		$mailer->Port = 465; //porta
		//remetente
		$mailer->FromName = ""; //nome do remetente
		$mailer->From = ""; //email do remetente, deve ser = login ou remetente cadastrado e autenticado no servidor de email
		//dados de envio
		$mailer->addAddress($destinatario); //destinatario
		// $mailer->AddAddress('webmaster@nomedoseudominio.com'); // Caso queira receber uma copia
		// $mailer->AddCC('ciclano@site.net', 'Ciclano'); // Copia
		// $mailer->AddBCC($destinatario); // Cópia Oculta
		// $mailer->AddAttachment("c:/temp/documento.pdf", "documento.pdf"); // Insere um anexo
		$mailer->Subject = $assunto; //assunto do email
		$mailer->Body = $mensagem; //corpo do email
		// Envia o e-mail e guarda na var booleana $enviado se foi enviado ou nao
		$enviado = $mailer->Send();

		// Limpa os destinatários e os anexos
		$mailer->ClearAllRecipients();
		$mailer->ClearAttachments();

		//retorna se foi ou nao enviado
		return $enviado;
	}

}
