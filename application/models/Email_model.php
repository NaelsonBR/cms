<?php

/* codigo que impossibilita o acesso direto sem passar pela home */
defined('BASEPATH')	OR	exit('No direct script access allowed');
/* todo controller DEVE extender CI_Controller */

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use	PHPMailer\PHPMailer\PHPMailer;
use	PHPMailer\PHPMailer\Exception;

class	Email_model	extends	CI_Model	{
		/* construtor da classe que carregar os principais helpers
			 que podem ser usados dentro de toda a classe */

		function	__construct()	{
				/* contrutor da classe pai */
				parent::__construct();
				/* abaixo deverão ser carregados helpers, libraries e models utilizados
					 por este model */
		}

		public	static	function	emailHTML($destinatario,	$assunto,	$mensagem)	{
				$mail	=	new	PHPMailer(true);								// Passing `true` enables exceptions
				try	{
						//Server settings
						//$mail->SMTPDebug = 2;								 // Enable verbose debug output
						$mail->isSMTP();										// Set mailer to use SMTP
						$mail->Host	=	'smtp.gmail.com';	// Specify main and backup SMTP servers
						$mail->SMTPAuth	=	true;								// Enable SMTP authentication
						$mail->Username	=	'peterson.jfp@gmail.com';					// SMTP username
						$mail->Password	=	'01141988pjfp';							// SMTP password
						$mail->SMTPSecure	=	'tls';							// Enable TLS encryption, `ssl` also accepted
						$mail->Port	=	587;									// TCP port to connect to
						$mail->CharSet	=	"utf-8";	//evitar erros de acentuação
						//Recipients
						$mail->setFrom('peterson.jfp@gmail.com',	'Peterson');
						$mail->addAddress($destinatario);				// Name is optional
						//$mail->addReplyTo('info@example.com', 'Information');
						//$mail->addCC('cc@example.com');
						//$mail->addBCC('bcc@example.com');
						//Attachments
						//    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
						//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
						//Content
						$mail->isHTML(true);									// Set email format to HTML
						$mail->Subject	=	$assunto;
						$mail->Body	=	$mensagem;
						$mail->AltBody	=	'Por favor visualize esse email em um leitor de email html';

						$mail->send();
						// Limpa os destinatários e os anexos
						$mail->ClearAllRecipients();
						$mail->ClearAttachments();
						return	TRUE;
				}	catch	(Exception	$e)	{
						Log_model::insertLog('email_model/emailHTML',	'Erro ao enviar o email, <br>'	.	$mail->ErrorInfo);
						echo	'Message could not be sent.';
						echo	'Mailer Error: '	.	$mail->ErrorInfo;
				}
		}

}
