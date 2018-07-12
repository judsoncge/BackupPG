<?php
$cpf = $_GET['pessoa'];
$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores WHERE CD_SERVIDOR='$cpf'");


while($result = mysqli_fetch_array($retornoquery)){
	$nome = $result['NM_SERVIDOR'];
	$sobrenome = $result['SNM_SERVIDOR'];
	$matricula = $result['NM_MATRICULA'];
	$cargo = $result['NM_CARGO'];
	$situacao_funcional = $result['NM_SITUACAO_FUNCIONAL'];
	$nivel = $result['NM_NIVEL'];
	$graduacao = $result['NM_GRADUACAO'];
	$data_nomeacao = $result['DT_NOMEACAO'];
	$email_institucional = $result['NM_EMAIL'];
	$setor = $result['CD_SETOR'];
	$grupo = $result['NM_GRUPO'];
	$salario = $result['VLR_SALARIO'];
	$cedido_por = $result['NM_CEDIDO'];
	$foto = $result['NM_ARQUIVO_FOTO'];
	
}
?>