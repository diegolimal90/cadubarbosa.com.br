<?php
require 'api/PHPMailer/PHPMailerAutoload.php';


	//Instancio a classe PHPMAILER
	$mail = new PHPMailer;

	//$mail ->SMTPDebug = 2;
	
	//configurar acesso ao email
	$mail->IsSMTP(); 
	$mail->Host = "smtp.cadubarbosa.com.br"; 
	$mail->SMTPAuth = true; 
	$mail->Port = 587;
	$mail->SMTPSecure = false;
	$mail->SMTPAutoTLS = false;
	$mail->Username = 'contato@cadubarbosa.com.br'; 
	$mail->Password = 'barbosa1234';
		

	$nome 			= $_POST['strNome'];
	$fone 			= $_POST['strFone'];
	$email 			= $_POST['strEmail'];
	$cep 			= $_POST['strCep'];
	$cidade 		= $_POST['strCidade'];
	$bairro 		= $_POST['strBairro'];
	$rua 			= $_POST['strRua'];
	$complemento 	= $_POST['strComplemento'];
	$cep1 			= $_POST['strCep1'];
	$cidade1 		= $_POST['strCidade1'];
	$bairro1 		= $_POST['strBairro1'];
	$rua1 			= $_POST['strRua1'];
	$complemento1 	= $_POST['strComplemento1'];
	$mensagem 		= $_POST['strMensagem'];
	$tipo			= $_POST['strTipo'];

	$valores = array(
		'color' 		=> '#139349',
		'titulo' 		=> utf8_decode('Requerimento Online'),
		'subtitulo1' 	=> utf8_decode('Dados do Solicitante'),
		'nome' 			=> utf8_decode($nome),
		'fone' 			=> $fone, 			 
		'email' 		=> $email, 		 
		'cep' 			=> $cep, 			
		'cidade' 		=> utf8_decode($cidade), 		
		'bairro'		=> utf8_decode($bairro),		
		'rua' 			=> utf8_decode($rua), 			
		'complemento' 	=> utf8_decode($complemento), 		 
		'cep1' 			=> $cep1, 			
		'cidade1' 		=> utf8_decode($cidade1), 		
		'bairro1'		=> utf8_decode($bairro1),		
		'rua1' 			=> utf8_decode($rua1), 			
		'complemento1' 	=> utf8_decode($complemento1),
		'subtitulo2' 	=> utf8_decode($tipo),	
		'mensagem' 		=> utf8_decode($mensagem)
	);

	$template = file_get_contents('../template_email/template_solicita.html');

	foreach($valores as $chave => $valor){

		$template = str_replace('{'.$chave.'}', $valor, $template);

	}

	$mail ->Charset = 'UTF-8';										//aceitar caracteres especiais

	//configurar cabeçalho de email
	$mail ->setFrom('contato@cadubarbosa.com.br', 'Site Cadu Barbosa');		//insere o remetente
	$mail ->addAddress('atendimento@cadubarbosa.com.br', 'Atendimento Cadu Barbosa');					//adiciona o destinatario
	$mail ->isHTML(true);											//formato do email em html

	//conteudo do email
	$mail ->Subject = utf8_decode("Requerimento Online - {$tipo}");//adiciona assunto ao email
	$mail ->Body = $template;

	//verificação se o email foi enviado
	if(!$mail->send()) {
		die(json_encode(array('status' => 'Mensagem nao foi enviada.')));
		//echo 'Error: ' . $mail->ErrorInfo;
	} else {
		die(json_encode(array('status' => 'ok')));
	}
