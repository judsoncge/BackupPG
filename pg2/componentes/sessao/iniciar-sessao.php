<?php

	//fazendo conexão com o banco de dados
	require_once("../componentes/banco-dados/conectar.php"); //para carregar a página é necessário carregar a conexão
	
	//iniciando sessão
	session_start();

	//se existe sessão...
	if(isset($_SESSION["numLogin"])){
		$n1=$_GET["sessionId"];
		$n2=$_SESSION["numLogin"];
		if($n1 != $n2){
			header("Location:../../../index.php");
			exit;
	}
		//se não existe sessão...
	} 	else {
			header("Location:../../../index.php");
			exit;
	}
	
	$num = $n1;
	
?>