<?php
	include("../banco-dados/conectar.php"); //incluindo a conexão com o banco de dados
	
	session_start(); //pegando a sessão da página anterior
	
	unset($_SESSION['numLogin']); //eliminando as variáveis da sessão

	session_destroy(); //destruindo a sessão
	
	header("Location:../../index.php"); //voltando para a página de login
?>