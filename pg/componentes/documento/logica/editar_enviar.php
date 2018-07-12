<?php

include('../../banco-dados/conectar.php');

$id = $_GET['documento']; 

$estacom = $_POST['enviar']; 

	$query = "SELECT nome FROM pessoa WHERE CPF='$estacom'";
	
	$lista = mysqli_query($conexao_com_banco, $query);
	
	$nome='';
	
	while($resultado = mysqli_fetch_array($lista)){
	
	$nome = $resultado['nome'];
		
	}
	
$nome = strtoupper($nome);

$pessoa = $_GET['pessoa']; 
//gravando o nome do requisitante
date_default_timezone_set('America/Bahia');
$data_mensagem = date('Y-m-d H:i:s');

$id_historico = "HISTORICO_DOCUMENTO_" . $pessoa . date('H:i:s');
$id_historico = str_replace('.', '', $id_historico);
$id_historico = str_replace('-', '', $id_historico);
$id_historico = str_replace(':', '', $id_historico);

include('../banco-dados/editar_enviar.php');

?>