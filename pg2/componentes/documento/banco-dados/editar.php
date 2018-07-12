<?php

if($_GET['operacao']=='info'){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_PROCESSO='$edita_numero_processo', NM_ATIVIDADE='$edita_tipo_atividade', NM_DOCUMENTO='$edita_tipo_documento' , NM_INTERESSADO='$edita_interessado', DT_ENTRADA='$edita_data_entrada', DT_PRAZO='$edita_prazo', NR_PRIORIDADE='$edita_prioridade', NM_DESCRICAO='$edita_descricao_fato', NM_TEXTO='$edita_texto_documento' WHERE CD_DOCUMENTO='$id_documento' ") 
	or die (mysqli_error($conexao_com_banco));

	header("Location:../../../interface/documentos".$_GET['pagina'].".php?sessionId=$num&mensagem=As informações foram atualizadas com sucesso!&resultado=sucesso");

}

else if($_GET['operacao']=='aprovar'){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET NM_STATUS='Aprovado' WHERE CD_DOCUMENTO='$id_documento'") 
	or die (mysqli_error($conexao_com_banco));

	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_documentos (ID, CD_DOCUMENTO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_documento', '$id_documento', 'APROVOU O DOCUMENTO', '$pessoa', '$data_mensagem', 'Aprovação')") 
	or die (mysqli_error($conexao_com_banco));

	echo "<script>history.back();</script>";
	
}

else if($_GET['operacao']=='desaprovar'){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET NM_STATUS='Em análise' WHERE CD_DOCUMENTO='$id_documento'") 
	or die (mysqli_error($conexao_com_banco));

	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_documentos (ID, CD_DOCUMENTO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_documento', '$id_documento', 'DESFEZ A APROVAÇÃO', '$pessoa', '$data_mensagem', 'Desaprovação')") 
	or die (mysqli_error($conexao_com_banco));

	echo "<script>history.back();</script>";
	
}
	
else if($_GET['operacao']=='enviar'){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_SERVIDOR_LOCALIZACAO='$estacom', CD_SETOR_LOCALIZACAO='$setor' WHERE CD_DOCUMENTO='$id_documento' ") 
	or die (mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_documentos (ID, CD_DOCUMENTO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES	('$id_historico_documento', '$id_documento', 'ENVIOU O DOCUMENTO PARA $nome', '$pessoa', '$data_mensagem', 'Envio')") 
	or die (mysqli_error($conexao_com_banco));

	header("Location:../../../interface/documentos.php?sessionId=$num&mensagem=O documento foi enviado para $nome com sucesso&resultado=sucesso");

}
	
	
else if($_GET['operacao']=='mensagem'){
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_documentos (ID, CD_DOCUMENTO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_documento','$id_documento','$mensagem', '$pessoa', '$data_mensagem', 'Mensagem')  ") 
	or die (mysqli_error($conexao_com_banco));

	echo "<script>history.back();</script>";
	
}

else if($_GET['operacao']=='resolver'){

	mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET NM_STATUS='Resolvido', DT_RESOLVIDO='$data_resolvido', CD_SERVIDOR_LOCALIZACAO='', CD_SETOR_LOCALIZACAO='' WHERE CD_DOCUMENTO='$id_documento' ") 
	or die (mysqli_error($conexao_com_banco));

	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_documentos (ID, CD_DOCUMENTO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_documento', '$id_documento', 'MARCOU COMO RESOLVIDO', '$pessoa', '$data_mensagem', 'Resolução')") 
	or die (mysqli_error($conexao_com_banco));
	
	header("Location:../../../interface/documentos.php?sessionId=$num&mensagem=O documento foi resolvido. Os registros dele estão no nosso banco de dados&resultado=sucesso");

}


else if($_GET['operacao']=='sugerir'){
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_documentos (ID, CD_DOCUMENTO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_TIPO, NM_ACAO) VALUES ('$id_historico_documento', '$id_documento', '[$edita_tipo_sugestao] SUGERIU PARA O TEXTO: $edita_sugestao', '$pessoa', '$data_mensagem', '$edita_tipo_sugestao' , 'Sugestão')") 
	or die (mysqli_error($conexao_com_banco));

	$linha = mysqli_affected_rows($conexao_com_banco);

	if($linha==1){         
		echo "<script>history.back();</script>";
	}else{	
		echo "<script>history.back();</script>";
		echo "<script>alert('Você não modificou nada no texto')</script>";
	}	
	
}

?>