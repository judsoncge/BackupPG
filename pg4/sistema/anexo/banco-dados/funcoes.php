<?php

function cadastrar_anexo_atividade($conexao_com_banco, $atividade, $anexo) {
	mysqli_query($conexao_com_banco, "INSERT INTO tb_anexos_atividade(CD_ATIVIDADE, NM_ARQUIVO) VALUES ('$atividade' ,'$anexo')") 
	or die (mysqli_error($conexao_com_banco));
}

function cadastrar_anexo_documento($conexao_com_banco, $documento, $anexo) {
	mysqli_query($conexao_com_banco, "INSERT INTO tb_anexos_documento(CD_DOCUMENTO, NM_ARQUIVO) VALUES ('$documento' ,'$anexo')") 
	or die (mysqli_error($conexao_com_banco));
}

function cadastrar_anexo_comunicacao($conexao_com_banco, $comunicacao, $anexo) {
	mysqli_query($conexao_com_banco, "INSERT INTO tb_anexos_comunicacao(CD_COMUNICACAO, NM_ARQUIVO) VALUES ('$comunicacao' ,'$anexo')") 
	or die (mysqli_error($conexao_com_banco));
}

function cadastrar_anexo_despesa($conexao_com_banco, $despesa, $anexo) {
	mysqli_query($conexao_com_banco, "INSERT INTO tb_anexos_despesa(ID_DESPESA, NM_ARQUIVO) VALUES ('$despesa' ,'$anexo')") 
	or die (mysqli_error($conexao_com_banco));
}

function cadastrar_foto_servidor($conexao_com_banco, $servidor, $anexo){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_servidores SET NM_ARQUIVO_FOTO='$anexo' WHERE CD_SERVIDOR='$servidor'");
	
}

function remover_anexo_comunicacao($conexao_com_banco, $id) {
	mysqli_query($conexao_com_banco, "DELETE FROM tb_anexos_comunicacao WHERE ID='$id'")
	or die (mysqli_error($conexao_com_banco));
}

function remover_anexo_despesa($conexao_com_banco, $id) {
	mysqli_query($conexao_com_banco, "DELETE FROM tb_anexos_despesa WHERE ID='$id'")
	or die (mysqli_error($conexao_com_banco));
}

function remover_anexo_documento($conexao_com_banco, $id) {
	mysqli_query($conexao_com_banco, "DELETE FROM tb_anexos_documento WHERE ID='$id'")
	or die (mysqli_error($conexao_com_banco));
}


?>