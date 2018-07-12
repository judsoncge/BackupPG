<?php

mysqli_query($conexao_com_banco, "INSERT INTO tb_processos (CD_PROCESSO, NM_DESCRICAO, NM_DETALHES, NM_INTERESSADO, DT_ENTRADA, CD_SETOR_LOCALIZACAO, CD_SERVIDOR_LOCALIZACAO, NM_SITUACAO, NM_SITUACAO_FINAL, NM_TIPO, NM_STATUS) VALUES ('$novo_processo','$novo_descricao', '$novo_detalhes', '$novo_interessado', '$novo_data_entrada', '$setor', '$pessoa' ,'Aberto', 'Aberto','$novo_tipo', 'Ativo')")  
or die (mysqli_error($conexao_com_banco));
 
mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_processos (ID, CD_PROCESSO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_processo', '$novo_processo', 'ABRIU O PROCESSO', '$pessoa', '$data_hora_atual', 'Abertura')")
or die (mysqli_error($conexao_com_banco));
 
if(isset($_GET["documento"])){
	 
	$documento = $_GET["documento"];
		
	mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_PROCESSO='$novo_processo' WHERE CD_DOCUMENTO='$documento'") 
	or die (mysqli_error($conexao_com_banco));
	
} 
 
header("Location:../../../interface/processos.php?sessionId=$num&mensagem=O processo foi cadastrado com sucesso!&resultado=sucesso");

?>