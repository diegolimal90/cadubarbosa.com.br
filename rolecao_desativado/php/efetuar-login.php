<?php
require_once 'lib/defines.php';
session_start();

$con = new PDO('mysql:host=mysql.cadubarbosa.com.br;dbname=cadubarbosa', "cadubarbosa", "barbosa123456");

if(!empty($_POST)){
	$usr = $_POST['user'];
	$pwd = $_POST['pwd'];
	
	$sql = "SELECT * FROM login WHERE  usuario = '{$usr}'";
	$query = $con->query($sql);
	$res = $query->fetch();
	
	if(!empty($res)){
		
		$qPwd = $res['senha'];
		$_SESSION['nome'] = $res['nome'];
		$_SESSION['usuarioLogin'] = $usr;
		
		if($qPwd == $pwd){

			echo "<script type='text/javascript'>window.location.href = '../admin/';</script>";	
		}else{
			echo "<script type='text/javascript'>alert('usuario ou senha inválido'); window.location.href = '../admin/index.php';</script>";
			
			//var_dump($_POST);
			
		}
		
	}else{
		//echo "<script type='text/javascript'>alert('Informar os campos para login'); window.location.href = '../admin/';</script>";
	}
}