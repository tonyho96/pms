<?php

	require_once 'config.php';
	require_once 'vendor/autoload.php';


	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	function createEmailObject() {
		$mail = new PHPMailer( true );
		try {
			$mail->CharSet = 'UTF-8';
			$mail->setLanguage('fr', 'language/');
			//Server settings
			$mail->SMTPDebug = 2;                                       // Enable verbose debug output
			$mail->isSMTP();                                            // Set mailer to use SMTP
			$mail->Host       = SMTP_HOST;                              // Specify main and backup SMTP servers
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = SMTP_USERNAME;                          // SMTP username
			$mail->Password   = SMTP_PASSWORD;                          // SMTP password
			$mail->SMTPSecure = SMTP_SECURE;                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port       = SMTP_PORT;                              // TCP port to connect to
			$mail->isHTML( true );                               		// Set email format to HTML
			$mail->setFrom( SMTP_FROM, SMTP_FROM_NAME );
			return $mail;
		} catch ( Exception $e ) {
			return null;
		}
	}

	function send_mail( $to = '', $object = '', $body = '') {
		$mail = createEmailObject();
		try {
			//Server settings
			$mail->addAddress( $to );

			//Content
			$mail->Subject = $object;
			$mail->Body    = $body;

			$mail->send();
			echo 'Message has been sent<br/>';
		} catch ( Exception $e ) {
			echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
	}


