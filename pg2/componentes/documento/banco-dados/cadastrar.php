<?php

mysqli_query($conexao_com_banco, "INSERT INTO tb_documentos(CD_DOCUMENTO, CD_PROCESSO, NM_ATIVIDADE, NM_DOCUMENTO, NM_INTERESSADO, DT_ENTRADA, DT_PRAZO, DT_CRIACAO,  NR_PRIORIDADE, NM_DESCRICAO, NM_TEXTO, CD_SERVIDOR_CRIACAO, CD_SERVIDOR_LOCALIZACAO, CD_SETOR_LOCALIZACAO, NM_STATUS) VALUES ('$id_documento','$novo_numero_processo' ,'$novo_tipo_atividade','$novo_tipo_documento','$novo_interessado', '$novo_data_entrada', '$novo_prazo', '$novo_data_criacao','$novo_prioridade','$novo_descricao_fato', '$novo_texto_documento', '$novo_criadopor', '$novo_estacom', '$novo_setor' ,'Em análise')")
or die (mysqli_error($conexao_com_banco));

mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_documentos(ID, CD_DOCUMENTO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_documento', '$id_documento', 'CRIOU UM DOCUMENTO', '$novo_criadopor', '$novo_data_criacao', 'Criação')")
or die (mysqli_error($conexao_com_banco));

if($novo_anexo != ""){
	 
	mysqli_query($conexao_com_banco, "INSERT INTO tb_anexos (ID, CD_REFERENTE, NM_ARQUIVO) VALUES ('$id','$id_documento', '$novo_anexo')") 
	or die (mysqli_error($conexao_com_banco));

}
 
if($novo_numero_processo != null and $novo_numero_processo != ''){
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_processos (ID, CD_PROCESSO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_processo', '$novo_numero_processo', 'CRIOU UM $novo_tipo_documento', '$novo_criadopor', '$novo_data_criacao', 'Criação')") 
	or die (mysqli_error($conexao_com_banco));
   
 }
 
header("Location:../../../interface/documentos.php?sessionId=$num&mensagem=O documento foi cadastrado com sucesso!&resultado=sucesso");



?>