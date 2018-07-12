<?php

include('../../banco-dados/conectar.php');
include('../../funcoes.php');
include('../banco-dados/funcoes.php');
date_default_timezone_set('America/Bahia');
session_start();

$processo = $_POST['p'];

$existe = existe_processo($conexao_com_banco, $processo);
	
if($existe){
	
	$id = retorna_id_processo($processo, $conexao_com_banco);
		
	Header("Location:../detalhes-consulta.php?id=$id&mensagem=O processo foi encontrado!&resultado=sucesso");
		
}else{
		
	Header("Location:../consultar.php?mensagem=Um processo com este número não foi encontrado!&resultado=falha");

	}

?>