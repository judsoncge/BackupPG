<?php
// inclui a conexão
include_once('conectar.php');

include('../../nucleo-aplicacao/retornar_dados.php');

$lista = retorna_dados("documento", $conexao_com_banco);

while($r = mysqli_fetch_object($lista)){
	
	$id = $r->id;
	
	$query2 = "SELECT data_mensagem FROM historico_documento WHERE mensagem='CRIOU UM DOCUMENTO' and Documento_id='".$id."'";
		
	$resultado = mysqli_query($conexao_com_banco, $query2);

	$data = mysqli_fetch_row($resultado);

	$query3 = "UPDATE documento SET data_criacao='".$data[0]."' WHERE id='".$id."'";
	
	echo $data[0]." foi adicionada<br>";

	$resultado = mysqli_query($conexao_com_banco, $query3);
	
	echo $id . " feito!<br><br><br>";
		
}	

?>