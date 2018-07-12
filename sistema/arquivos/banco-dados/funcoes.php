<?php

function cadastrar_arquivo($conexao_com_banco, $tipo, $servidor, $servidor_enviar, $nome_anexo){

	$data_hora_atual = date('Y-m-d'); 

	mysqli_query($conexao_com_banco, "INSERT INTO tb_arquivos (NM_TIPO, DT_CRIACAO, ID_SERVIDOR_CRIACAO, ID_SERVIDOR_ENVIADO, NM_STATUS, NM_ANEXO) VALUES ('$tipo', '$data_hora_atual', '$servidor', '$servidor_enviar', 'ATIVO', '$nome_anexo')") or die(mysqli_error($conexao_com_banco));

	
}

function aprovar_arquivo($conexao_com_banco, $id){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_arquivos SET NM_STATUS='APROVADO' WHERE ID = '$id'") or die(mysqli_error($conexao_com_banco));
	
}

function inativar_arquivo($conexao_com_banco, $id){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_arquivos SET ID_SERVIDOR_ENVIADO = NULL, NM_STATUS='INATIVO' WHERE ID = '$id'") or die(mysqli_error($conexao_com_banco));
	
}

function excluir_arquivo($conexao_com_banco, $id){

	mysqli_query($conexao_com_banco, "DELETE FROM tb_arquivos WHERE ID='$id'") or die(mysqli_error($conexao_com_banco));

	
}

?>
