<?php
require_once 'efetuar-login.php';
	//remove as variaveis da sessao(caso elas existam)
	unset($_SESSION['nome'], $_SESSION['usuarioLogin']);

	session_destroy();
	//manda para a tela de login
	//header('Location:'.$_SG['paginaLogin']);
	echo "<script language='javascript' type='text/javascript'>window.location.href='../login.html'</script>";