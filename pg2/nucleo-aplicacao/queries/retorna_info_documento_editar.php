<?php

$id = $_GET['documento'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE CD_DOCUMENTO='$id'");


while($result = mysqli_fetch_array($retornoquery)){
	$id = $result['CD_DOCUMENTO'];
	$numero_processo = $result['CD_PROCESSO'];
	$tipo_atividade = $result['NM_ATIVIDADE'];
	$tipo_documento = $result['NM_DOCUMENTO'];
	$interessado = $result['NM_INTERESSADO'];
	$entrada = $result['DT_ENTRADA'];	
	$criacao = $result['DT_CRIACAO'];
	$prazo = $result['DT_PRAZO'];
	$descricao_fato = $result['NM_DESCRICAO'];
	$texto_documento = $result['NM_TEXTO'];
	$prioridade = $result['NR_PRIORIDADE'];	
	$status = $result['NM_STATUS'];	
	$criadopor = $result['CD_SERVIDOR_CRIACAO'];	
	$estacom = $result['CD_SERVIDOR_LOCALIZACAO'];	

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