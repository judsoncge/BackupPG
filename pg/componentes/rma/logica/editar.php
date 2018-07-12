<?php

include('../../banco-dados/conectar.php');

session_start();

$edita_codigo = $_GET['codigo'];
$edita_acao = $_POST['acao'];
$edita_quantidade = $_POST['quantidade'];

$query = "SELECT quantidade_atual FROM almoxarifado WHERE codigo='$edita_codigo'";
	
	$lista = mysqli_query($conexao_com_banco, $query);
	
	while($resultado = mysqli_fetch_array($lista)){
	
		$quantidade_atual = $resultado['quantidade_atual'];
		
	}

if($edita_acao == 'Saída'){
	
	if($quantidade_atual < $edita_quantidade){
		
		echo "<script>history.back();</script>";
		
		echo "<script>alert('Não é possível dar saída em $edita_quantidade se no estoque tem $quantidade_atual')</script>";
		
		die();
		
		
	}else{
		$edita_quantidade = $quantidade_atual-$edita_quantidade;
	}
	
		
}else if($edita_acao == 'Entrada'){
		$edita_quantidade = $quantidade_atual+$edita_quantidade;
}

include('../banco-dados/editar.php');

?>