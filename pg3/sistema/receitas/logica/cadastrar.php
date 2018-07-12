<?php

include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
include('../../funcoes.php');
session_start();

if($_GET['operacao']=='receita'){
	
	$novo_codigo_receita = $_POST['tipo'];

	$novo_descricao = $_POST['descricao'];

	$novo_mes = date('m');

	$novo_ano = date('Y');
	
	$novo_valor = $_POST['valor'];
	
	cadastrar_receita($conexao_com_banco, $novo_codigo_receita, $novo_descricao, $novo_mes, $novo_ano, $novo_valor);
	
	echo "<script>history.back()</script>";
	echo "<script>history.back()</script>";
	
}else if($_GET['operacao']=='tipo_receita'){

	$novo_codigo_receita = $_POST['codigo'];
	
	$novo_nome_receita = $_POST['nome'];
	
	$existe_receita = existe_receita($conexao_com_banco, $novo_codigo_receita);

	if($existe_receita == true){ 
		echo "<script>alert('Uma receita com este código já existe!')</script>";
		echo "<script>history.back()</script>";
		die();
	}
	
	cadastrar_tipo_receita($conexao_com_banco, $novo_codigo_receita, $novo_nome_receita);
	header("Location:../cadastrar.php?mensagem=O novo tipo de receita foi cadastrado com sucesso!&resultado=sucesso");
		
}	

?>