<?php
require 'Classes/Cadastro.php';
require 'api/PHPMailer/PHPMailerAutoload.php';

$cadastro = new Cadastro();


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

$mail ->Charset = 'UTF-8';										//aceitar caracteres especiais


if(isset($_POST['strNome'])){
	//var_dump($_POST);
	$nome = $_POST['strNome'];
	$fone = $_POST['strFone'];
	$cel = $_POST['strCel'];
	$email = $_POST['strEmail'];
	$tam = $_POST['strTam'];
	$cep = $_POST['strCep'];
	$cidade = $_POST['strCidade'];
	$bairro = $_POST['strBairro'];
	$rua = $_POST['strRua'];
	$comple = $_POST['strComplemento'];
	$nm_animal = $_POST['strAmigo'];
	$detalhes = 'Você acabou de efetuar sua inscrição. No dia do evento você terá que chegar até as 8h30 e pagar R$ 10,00 para retirar a camisa, após este horário o não comparecimento não garantirá mais sua camiseta que será distribuída aos presentes que estiverem sem camisetas e que farão a inscrição na hora. <br /><br />Duvidas ou maiores informações mande um e-mail para <span style="font-size: 22px; color: green;">atendimento@cadubarbosa.com.br</span>';
	
	$valores = array(
		'color' => '#ff8526',
		'titulo' => utf8_decode('Rolé-cão'),
		'subtitulo' => utf8_decode('DATA DO EVENTO: 10 de DEZEMBRO de 2017'),
		'subtitulo1' => utf8_decode('Dados da Pessoa/Amiguinho(a)'),
		'nome' => utf8_decode($nome),
		'fone' => $fone, 			 
		'cel' => $cel, 			 
		'email' => $email, 		 
		'tam' => $tam, 		 
		'nm_animal' => $nm_animal, 		 
		'cep' => $cep, 			
		'cidade' => utf8_decode($cidade), 		
		'bairro' => utf8_decode($bairro),		
		'rua' => utf8_decode($rua), 			
		'complemento' => utf8_decode($comple),
		'detalhes' => utf8_decode($detalhes)
	);
	
	$cadastro->setParams($nome, $fone, $cel, $email, $tam, $cep, $cidade, $bairro, $rua, $comple, $nm_animal);
	
	//configurar cabeçalho de email
	$mail ->setFrom('contato@cadubarbosa.com.br', 'Evento Role-cao');		//insere o remetente
	$mail ->addAddress($email);												//adiciona o destinatario
	//$mail->addCC('contato@dvs.solutions');								//envio de copia de email
	$mail ->isHTML(true);													//formato do email em html
	
	$template = file_get_contents('../../template_email/template_rolecao.html');

	foreach($valores as $chave => $valor){

		$template = str_replace('{'.$chave.'}', $valor, $template);

	}
	
	
	if($cadastro->insert()){
		//conteudo do email
		$mail ->Subject = utf8_decode("Evento ROLÉ-CÃO");//adiciona assunto ao email
		$mail ->Body = $template;
		if(!$mail->send()) {
			//die(json_encode(array('status' => 'Mensagem nao foi enviada.')));
			echo 'Error: ' . $mail->ErrorInfo;
		} else {
			die(json_encode(array('status' => 'ok')));
		}
	}else{
		die(json_encode(array('status' => 'not ok')));
	}
}