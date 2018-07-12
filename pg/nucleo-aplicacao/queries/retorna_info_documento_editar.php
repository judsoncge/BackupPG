<?php

$id = $_GET['documento'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM documento WHERE id='$id'");

while($result = mysqli_fetch_array($retornoquery)){
	$id = $result['id'];
	$numero_processo = $result['Processo_numero'];
	$tipo_atividade = $result['tipo_atividade'];
	$tipo_documento = $result['tipo_documento'];
	$interessado = $result['interessado'];
	$prazo = $result['prazo'];
	$descricao_fato = $result['descricao_fato'];
	$texto_documento = $result['texto_documento'];
	$prioridade = $result['prioridade'];	
	$status = $result['status'];	
	$texto_documento = $result['texto_documento'];	
	$criadopor = $result['criadopor'];	
	$criacao = $result['data_criacao'];	
	$entrada = $result['data_entrada'];	
}

if($prioridade == 1){
	$prioridade_nome = 'Urgente';
}else if($prioridade == 2){
	$prioridade_nome = 'Alta';
}else if($prioridade == 3){
	$prioridade_nome = 'Média';
}else if($prioridade == 4){
	$prioridade_nome = 'Baixa';
}

?>