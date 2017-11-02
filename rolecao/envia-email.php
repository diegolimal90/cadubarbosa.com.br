<?php

	require 'api/PHPMailer/PHPMailerAutoload.php';

	//variaveis com os valores de get e post
	$nome 		= utf8_decode($_POST['nome']);
	$whats		= $_POST['whats'];
	$tel 		= $_POST['tel'];

	//verifica valor recebido pelo get para criar o assunto
	/*if($env == '1'){
		$assunto = 'Solicitação do MegaZAP para empresa';
	}elseif($env == '2'){
		$assunto = 'Solicitação do MegaZAP para revenda';
	}else{
		$assunto = 'Solicitação de Contato sobre o MegaZAP';
	}*/


	//Instancio a classe PHPMAILER
	$mail = new PHPMailer;

	//$mail ->SMTPDebug = 2;
	
	//configurar acesso ao email
	$mail ->isSMTP();												//seleciona protocolo de e-mail SMTP
	$mail ->Host = 'megazap.site';								//especifica o servidor smtp
	$mail ->SMTPAuth = true;			 							//Habilita autenticação SMTP
	$mail ->Username = 'contato@megazap.site';						//email de acesso ao e-mail
	$mail ->Password = 'Star.pop2017';								//senha de acesso ao e-mail
	$mail ->SMTPSecure = 'tsl';										//especifica TLS para encriptografia
	$mail ->Port = 587;												//porta TCP para conexao para a TLS -> padrao 587 sempre

	$mail ->Charset = 'UTF-8';										//aceitar caracteres especiais

	//configurar cabeçalho de email
	$mail ->setFrom('contato@megazap.site', 'Contato MegaZap');		//insere o remetente
	$mail ->addAddress('zapdream1@gmail.com');					//adiciona o destinatario
	$mail->addCC('contato@dvs.solutions');							//envio de copia de email
	$mail ->isHTML(true);											//formato do email em html

	//conteudo do email
	$mail ->Subject = "Passaporte Dream Park";										//adiciona assunto ao email
	$mail ->Body = "<b>Nome:</b> {$nome} <br> <b>WhatsApp:</b> {$whats} <br> <b>Telefone:</b> {$tel} <br>";
	$mail ->AltBody = "Nome: {$nome} \n\r WhatsApp: {$whats} \n\r Telefone: {$tel} \n\r";

	//verificação se o email foi enviado
	if(!$mail->send()) {
    	echo 'Mensagem nao foi enviada.';
    	echo 'Error: ' . $mail->ErrorInfo;
	} else {
	    echo '<script type="text/javascript">alert("Mensagem enviada com sucesso!"); location.href="http://dreampark.megazap.site/passaporte.html";</script>';
	}

/*
if (!empty($_POST)) {
    // To send HTML mail, the Content-type header must be set
    //variaveis com os valores de get e post
	$env 		= $_GET['env'];
	$nome 		= utf8_decode($_POST['nome']);
	$cidade 	= utf8_decode($_POST['cidade']);
	$whats		= $_POST['whats'];
	$email 		= $_POST['email'];
	$empresa	= utf8_decode($_POST['empresa']);

	//verifica valor recebido pelo get para criar o assunto
	if($env == '1'){
		$assunto = 'Solicitação do MegaZAP para empresa';
	}elseif($env == '2'){
		$assunto = 'Solicitação do MegaZAP para revenda';
	}else{
		$assunto = 'Solicitação de Contato sobre o MegaZAP';
	}

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

// Additional headers
    $headers .= 'To: Contato MegaZap <contato@megazap.site>' . "\r\n";
    $headers .= 'From: Contato MegaZap <contato@megazap.site>' . "\r\n";
    
    $message = "Segue os dados que foram enviados pelo formulário de contato do site: <br/>"
            . "Nome: {$nome}<br/>"
			. "Cidade: {$cidade}<br/>"
			. "Empresa: {$empresa}<br/>"
            . "Whatsapp: {$whats}<br/>"
            . "E-Mail: {$email} <br/>";
            
    if(mail("contato@megazap.site", $assunto, $message, $headers)){
        echo '<script type="text/javascript">alert("Mensagem enviada com sucesso!"); location.href="http://megazap.site";</script>';
    }
}
*/