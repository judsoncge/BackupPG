<?php

if($_GET['operacao']=='info'){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_PROCESSO='$numero_processo_ok', NM_DESCRICAO='$edita_descricao', NM_TIPO='$edita_tipo', NM_DETALHES='$edita_detalhes', NM_INTERESSADO='$edita_interessado' WHERE CD_PROCESSO='$processo'") 
	or die (mysqli_error($conexao_com_banco));

	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_processos (ID, CD_PROCESSO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_processo', '$processo', '$mensagem', '$pessoa', '$data_hoje', 'Edição')") 
	or die (mysqli_error($conexao_com_banco));
	
	if($processo != $numero_processo_ok){
		
		mysqli_query($conexao_com_banco, "UPDATE tb_historico_processos SET CD_PROCESSO='$numero_processo_ok' WHERE CD_PROCESSO='$processo'") 
		or die (mysqli_error($conexao_com_banco));	
		
		mysqli_query($conexao_com_banco, "UPDATE tb_tramitacao_processos SET CD_PROCESSO='$numero_processo_ok' WHERE CD_PROCESSO='$processo'") 
		or die (mysqli_error($conexao_com_banco));	
		
		mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_PROCESSO='$numero_processo_ok' WHERE CD_PROCESSO='$processo'") 
		or die (mysqli_error($conexao_com_banco));	
	
		mysqli_query($conexao_com_banco, "UPDATE tb_responsaveis_processos SET CD_PROCESSO='$numero_processo_ok' WHERE CD_PROCESSO='$processo'") 
		or die (mysqli_error($conexao_com_banco));	
	
	}
	 
	header("Location:../../../interface/processos".$_GET['pagina'].".php?sessionId=$num&mensagem=As informações foram atualizadas com sucesso!&resultado=sucesso");
	
}

else if($_GET['operacao']=='prazos'){
	
	if(isset($_POST['prazo']) and isset($_POST['prazo_final']) and $prazo != $_GET['prazo'] and $prazo_final != $_GET['prazo_final']){
		
		mysqli_query($conexao_com_banco, "UPDATE tb_processos SET DT_PRAZO='$prazo', NM_SITUACAO='Análise em andamento', DT_PRAZO_FINAL='$prazo_final', NM_SITUACAO_FINAL='Finalização em andamento' WHERE CD_PROCESSO='$processo'") 
		or die (mysqli_error($conexao_com_banco));
		
		mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_processos (ID, CD_PROCESSO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES 
		('$id_historico_processo', '$processo', 'ATUALIZOU O PRAZO PARCIAL E O PRAZO FINAL', '$cpf', '$data_mensagem', 'Mudança de prazo')")
		or die (mysqli_error($conexao_com_banco));
		
		echo "<script>history.back();</script>";
	
	}else if(isset($_POST['prazo']) and $prazo_final == $_GET['prazo_final']){
		
		mysqli_query($conexao_com_banco, "UPDATE tb_processos SET DT_PRAZO='$prazo', NM_SITUACAO='Análise em andamento' WHERE CD_PROCESSO='$processo'") 
		or die (mysqli_error($conexao_com_banco));
		
		mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_processos (ID, CD_PROCESSO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES
		('$id_historico_processo', '$processo', 'ATUALIZOU O PRAZO PARCIAL', '$cpf', '$data_mensagem', 'Mudança de prazo')")
		or die (mysqli_error($conexao_com_banco));
		
		echo "<script>history.back();</script>";
		
	}else if(isset($_POST['prazo_final']) and $prazo == $_GET['prazo']){
		mysqli_query($conexao_com_banco, "UPDATE tb_processos SET DT_PRAZO_FINAL='$prazo_final', NM_SITUACAO_FINAL='Finalização em andamento' WHERE CD_PROCESSO='$processo'") 
		or die (mysqli_error($conexao_com_banco));
		
		mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_processos (ID, CD_PROCESSO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES 
		('$id_historico_processo', '$processo', 'ATUALIZOU O PRAZO FINAL', '$cpf', '$data_mensagem', 'Mudança de prazo')")
		or die (mysqli_error($conexao_com_banco));
		
		echo "<script>history.back();</script>";
	}
	
}

else if($_GET['operacao']=='mensagem'){
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_processos (ID, CD_PROCESSO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_processo', '$processo', '$mensagem', '$cpf', '$data_mensagem', 'Mensagem')")
	or die (mysqli_error($conexao_com_banco));
	
	echo "<script>history.back();</script>";
	
}

else if($_GET['operacao']=='tramitar'){

	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_SETOR_LOCALIZACAO='$setor_destino', CD_SERVIDOR_LOCALIZACAO='$destino' WHERE CD_PROCESSO='$processo'") 
    or die (mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_tramitacao_processos (ID, CD_PROCESSO, CD_SERVIDOR_ORIGEM, CD_SERVIDOR_DESTINO, DT_TRAMITACAO) VALUES ('$id_tramitacao_processo', '$processo', '$origem', '$destino', '$data_tramitacao')")
	or die (mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_processos (ID, CD_PROCESSO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_processo', '$processo', '$mensagem', '$origem', '$data_tramitacao', 'Tramitação')") 
	or die (mysqli_error($conexao_com_banco));
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE CD_PROCESSO='$processo'");

	if(mysqli_num_rows($resultado) > 0){
		
		mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_SERVIDOR_LOCALIZACAO='$destino' WHERE CD_PROCESSO='$processo'")
		or die (mysqli_error($conexao_com_banco));
	
	}

	header("Location:../../../interface/processos".$_GET['pagina'].".php?sessionId=$num&mensagem=O processo foi tramitado para $nome_destino com sucesso!&resultado=sucesso");


}

else if($_GET['operacao']=='sair'){

	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_SETOR_LOCALIZACAO='', DT_SAIDA='$data_saida', CD_SERVIDOR_LOCALIZACAO='', NM_STATUS='$status' WHERE CD_PROCESSO='$processo'") 
    or die (mysqli_error($conexao_com_banco));
	 
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_processos (ID, CD_PROCESSO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_processo', '$processo', '$mensagem', '$pessoa', '$data_saida', 'Saída')")
    or die (mysqli_error($conexao_com_banco));
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM documento WHERE Processo_numero='$processo'");

	if(mysqli_num_rows($resultado) > 0){
		mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_SERVIDOR_LOCALIZACAO='', NM_STATUS='Resolvido', DT_RESOLVIDO='$data_saida' WHERE CD_PROCESSO='$processo'")
		or die (mysqli_error($conexao_com_banco));
	}
	
	header("Location:../../../interface/processos".$_GET['pagina'].".php?sessionId=$num&mensagem=O processo saiu com sucesso!&resultado=sucesso");
	
}



else if($_GET['operacao']=='arquivar'){

	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NM_SITUACAO_FINAL='$situacao_final', CD_SETOR_LOCALIZACAO='', DT_SAIDA='$data_saida', CD_SERVIDOR_LOCALIZACAO='', NM_STATUS='$status' WHERE CD_PROCESSO='$processo'") 
    or die (mysqli_error($conexao_com_banco));
	 
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_processos (ID, CD_PROCESSO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_processo', '$processo', '$mensagem', '$pessoa_arquivou', '$data_hoje', 'Arquivamento')")
    or die (mysqli_error($conexao_com_banco));

	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE CD_PROCESSO='$processo'");

	if(mysqli_num_rows($resultado) > 0){
		mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_SERVIDOR_LOCALIZACAO='',CD_SETOR_LOCALIZACAO='', NM_STATUS='Resolvido', DT_RESOLVIDO='$data_saida' WHERE CD_PROCESSO='$processo'")
		or die (mysqli_error($conexao_com_banco));
	}
	
	header("Location:../../../interface/processos".$_GET['pagina'].".php?sessionId=$num&mensagem=O processo foi arquivado com sucesso!&resultado=sucesso");
	
}

else if($_GET['operacao']=='desarquivar'){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_SETOR_LOCALIZACAO='$setor', DT_SAIDA='0000-00-00', CD_SERVIDOR_LOCALIZACAO='$pessoa', NM_SITUACAO_FINAL='$situacao_final', NM_STATUS='Ativo' WHERE CD_PROCESSO='$processo'") 
	or die (mysqli_error($conexao_com_banco));
	 
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_processos (ID, CD_PROCESSO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_processo', '$processo', '$mensagem', '$pessoa', '$data', 'Desarquivamento')")
	or die (mysqli_error($conexao_com_banco));
	 
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE CD_PROCESSO='$processo'");

	if(mysqli_num_rows($resultado) > 0){
			mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_SERVIDOR_LOCALIZACAO='$pessoa', NM_STATUS='Em análise', DT_RESOLVIDO='0000-00-00', DT_PRAZO='0000-00-00' WHERE CD_PROCESSO='$processo'")
			or die (mysqli_error($conexao_com_banco));
	}
 
	header("Location:../../../interface/processos.php?sessionId=$num&mensagem=O processo foi desarquivado com sucesso!&resultado=sucesso");

}


else if($_GET['operacao']=='voltar'){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_SETOR_LOCALIZACAO='$setor', DT_SAIDA='0000-00-00', CD_SERVIDOR_LOCALIZACAO='$pessoa', DT_PRAZO='0000-00-00', DT_PRAZO_FINAL='0000-00-00', NM_SITUACAO='Aberto', NM_SITUACAO_FINAL='Aberto', NM_STATUS='Ativo' WHERE CD_PROCESSO='$processo'") 
	or die (mysqli_error($conexao_com_banco));
	 
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_processos (ID, CD_PROCESSO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_processo', '$processo', '$mensagem', '$pessoa', '$data', 'Voltar')")
	or die (mysqli_error($conexao_com_banco));
	 
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE CD_PROCESSO='$processo'");

	if(mysqli_num_rows($resultado) > 0){
			mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_SERVIDOR_LOCALIZACAO='$pessoa', NM_STATUS='Em análise', DT_RESOLVIDO='0000-00-00', DT_PRAZO='0000-00-00' WHERE CD_PROCESSO='$processo'")
			or die (mysqli_error($conexao_com_banco));
	}
 
	header("Location:../../../interface/processos.php?sessionId=$num&mensagem=O processo foi colocado de volta ao órgão com sucesso!&resultado=sucesso");

}

else if($_GET['operacao']=='concluir'){

	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NM_SITUACAO='$situacao' WHERE CD_PROCESSO='$processo'") 
	or die (mysqli_error($conexao_com_banco));
	 
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_processos (ID, CD_PROCESSO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_processo', '$processo', '$mensagem', '$pessoa_concluiu' , '$data_hoje' ,'Conclusão')") 
	or die(mysqli_error($conexao_com_banco));

	echo "<script>history.back();</script>";
	
}



else if($_GET['operacao']=='finalizar'){

	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NM_SITUACAO_FINAL='$situacao' WHERE CD_PROCESSO='$processo'") 
	or die (mysqli_error($conexao_com_banco));
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE CD_PROCESSO='$processo'") or die(mysqli_error($conexao_com_banco));
	
	while($r = mysqli_fetch_object($resultado)){
		
		$id = $r->CD_DOCUMENTO;
		$data_resolvido = $r->DT_RESOLVIDO;
				
		if($data_resolvido =='0000-00-00'){
			mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET DT_RESOLVIDO='$data', NM_STATUS='Resolvido', CD_SERVIDOR_LOCALIZACAO='', CD_SETOR_LOCALIZACAO='' WHERE CD_DOCUMENTO='$id'") or die(mysqli_error($conexao_com_banco));	
		}
	
	}
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_processos (ID, CD_PROCESSO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_processo', '$processo', '$mensagem', '$pessoa_concluiu' , '$data_hoje' ,'Finalização')") 
	or die(mysqli_error($conexao_com_banco));

	echo "<script>history.back();</script>";
	
}

else if($_GET['operacao']=='responsaveis'){
	
	for ($i=0;$i<count($responsaveis);$i++){
		mysqli_query($conexao_com_banco, "INSERT INTO tb_responsaveis_processos (CD_PROCESSO, CD_SERVIDOR) VALUES ('$processo', '$responsaveis[$i]')") 
		or die (mysqli_error($conexao_com_banco));
	}

	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_processos (ID, CD_PROCESSO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_processo', '$processo', '$mensagem', '$pessoa' , '$data_hoje' ,'Responsáveis')") 
	or die(mysqli_error($conexao_com_banco));
	
	echo "<script>history.back();</script>";
	
} else if($_GET['operacao']=='remover_responsavel'){
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_responsaveis_processos WHERE CD_PROCESSO='$processo' AND CD_SERVIDOR='$responsavel'") or die(mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_processos (ID, CD_PROCESSO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_processo', '$processo', '$mensagem', '$pessoa' , '$data_hoje' ,'Responsáveis')") or die(mysqli_error($conexao_com_banco));
	
	echo "<script>history.back();</script>";
	
} 
	


?>