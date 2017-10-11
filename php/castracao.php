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
	$mensagem 		= $_POST['strMensagem'];
	$animal			= $_POST['strTipo'];
	$jejum			= $_POST['strSimJejum'];
	$doente			= $_POST['strSimDoente'];
	$sexo			= $_POST['strSexo'];
	$idade			= $_POST['strIdade'];
	$cirurgia	 	= $_POST['strOpCirurgia'];
	$tpCirurgia		= $_POST['strCirurgia'];
	$alergia		= $_POST['strOpAlergia'];
	$tpalergia		= $_POST['strAlergia'];

	$valores = array(
		'color' 		=> '#8b59e3',
		'titulo' 		=> utf8_decode('CASTRAÇÃO'),
		'subtitulo1' 	=> utf8_decode('Dados da Pessoal'),
		'nome' 			=> utf8_decode($nome),
		'fone' 			=> $fone, 			 
		'email' 		=> $email, 		 
		'cep' 			=> $cep, 			
		'cidade' 		=> utf8_decode($cidade), 		
		'bairro'		=> utf8_decode($bairro),		
		'rua' 			=> utf8_decode($rua), 			
		'complemento' 	=> utf8_decode($complemento),
		'subtitulo2' 	=> utf8_decode('Detalhes do Animal'),
		'animal' 		=> $animal,
		'jejum' 		=> $jejum,
		'doente' 		=> $doente,
		'sexo' 			=> $sexo,
		'idade' 		=> $idade,
		'alergia' 		=> utf8_decode($alergia),
		'tpalergia' 	=> $tpalergia,
		'tpcirurgia' 	=> $tpCirurgia,
		'cirurgia' 		=> utf8_decode($cirurgia),	
		'mensagem' 		=> utf8_decode($mensagem)
	);

	$template = file_get_contents('../template_email/template_castracao.html');

	foreach($valores as $chave => $valor){

		$template = str_replace('{'.$chave.'}', $valor, $template);

	}

	$mail ->Charset = 'UTF-8';										//aceitar caracteres especiais

	//configurar cabeçalho de email
	$mail ->setFrom('contato@cadubarbosa.com.br', 'Site Cadu Barbosa');		//insere o remetente
	$mail ->addAddress('atendimento@cadubarbosa.com.br', 'Atendimento Cadu Barbosa');					//adiciona o destinatario
	$mail ->isHTML(true);											//formato do email em html

	//conteudo do email
	$mail ->Subject = utf8_decode("CASTRAÇÃO");										//adiciona assunto ao email
	$mail ->Body = $template;

	//verificação se o email foi enviado
	if(!$mail->send()) {
		die(json_encode(array('status' => 'Mensagem nao foi enviada.')));
		//echo 'Error: ' . $mail->ErrorInfo;
	} else {
		die(json_encode(array('status' => 'ok')));
	}
