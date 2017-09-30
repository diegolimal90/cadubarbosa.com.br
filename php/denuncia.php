<?php
if(!empty($_POST)){
	
require 'PHPMailer/PHPMailerAutoload.php';


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
		
	$nome 			= $_POST["strNome"];
	$fone 			= $_POST["strFone"]; 
	$email 			= $_POST["strEmail"]; 
	$cep 			= $_POST["strCep"]; 
	$cidade 		= $_POST["strCidade"];
	$bairro 		= $_POST["strBairro"]; 
	$rua 			= $_POST["strRua"];
	$complemento 	= $_POST["strComplemento"]; 
	$mensagem 		= $_POST["strMensagem"];
	
	if(!empty($res)){
		$valores = array(
			'nome' => $nome,
			'fone' => $fone, 			 
			'email' => $email, 		 
			'cep' => $cep, 			
			'cidade' => $cidade, 		
			'bairro' => $bairro,		
			'rua' => $rua, 			
			'complemento' => $complemento, 	
			'mensagem' => $mensagem 			 
		);
		
		$template = file_get_contents('../template_email/template_denuncia.html');
		
		foreach($valores as $chave => $valor){
			
			$template = str_replace('{'.$chave.'}', $valor, $template);
				
		}
		
		$mail ->Charset = 'UTF-8';										//aceitar caracteres especiais

		//configurar cabeçalho de email
		$mail ->setFrom('contato@ignicaonetwork.com', 'Site Cadu Barbosa');		//insere o remetente
		$mail ->addAddress('contato@ignicaonetwork.com', 'Site Cadu Barbosa');					//adiciona o destinatario
		$mail ->isHTML(true);											//formato do email em html

		//conteudo do email
		$mail ->Subject = utf8_encode("DENUNCIA");										//adiciona assunto ao email
		$mail ->Body = $template;
		
		//verificação se o email foi enviado
		if(!$mail->send()) {
			die(json_encode(array('status' => 'Mensagem nao foi enviada.')));
			//echo 'Error: ' . $mail->ErrorInfo;
		} else {
			die(json_encode(array('status' => 'ok')));
		}
		
		
	}
	
	
	
}