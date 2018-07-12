<?php

include('../../iniciar.php');

if($_GET['operacao']=='receita'){
	
	$novo_codigo_receita = $_POST['tipo'];

	$novo_descricao = $_POST['descricao'];

	$novo_mes = $_POST['mes'];

	$novo_ano = $_POST['ano'];
	
	$novo_valor = $_POST['valor'];
	
	$num = $_GET['sessionId'];
	
}else if($_GET['operacao']=='tipo_receita'){

	$novo_codigo_receita = $_POST['codigo'];
	
	$novo_nome_receita = $_POST['nome'];
	
	$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_tipos_receitas WHERE CD_RECEITA='$novo_codigo_receita'");
	$linha = mysqli_affected_rows($conexao_com_banco);
	if($linha==1){ 
		echo "<script>history.back();</script>";
		echo "<script>alert('Esta receita já está cadastrada.')</script>";
		die();
	}
	
	$num = $_GET['sessionId'];
}	

include('../banco-dados/cadastrar.php');

?>