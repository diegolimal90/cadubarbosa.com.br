<?php
require_once 'Autoload.php';

$cadastro = new Cadastro();

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
	
	$cadastro->setParams($nome, $fone, $cel, $email, $tam, $cep, $cidade, $bairro, $rua, $comple, $nm_animal);
	if($cadastro->insert()){
		die(json_encode(array('status' => 'ok')));
	}else{
		die(json_encode(array('status' => 'not ok')));
	}
}