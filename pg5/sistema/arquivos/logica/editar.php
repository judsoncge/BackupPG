<?php

include('../../banco-dados/conectar.php');
include('../../funcoes.php');
include('../banco-dados/funcoes.php');
date_default_timezone_set('America/Bahia');
session_start();

if($_GET['operacao'] == 'inativar'){

	$id = $_GET["id"];
	
	inativar_arquivo($conexao_com_banco, $id);
	
	Header("Location:../listar-ativos.php?mensagem=Operação realizada com sucesso!&resultado=sucesso");

}

if($_GET['operacao'] == 'aprovar'){

	$id = $_GET["id"];
	
	aprovar_arquivo($conexao_com_banco, $id);
	
	Header("Location:../listar-ativos.php?mensagem=Operação realizada com sucesso!&resultado=sucesso");

}



?>