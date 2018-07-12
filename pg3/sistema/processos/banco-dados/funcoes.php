<?php

function existe_processo($conexao_com_banco, $novo_processo){
	
	$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_processos WHERE CD_PROCESSO='$novo_processo'");

	if(mysqli_num_rows($retornoquery) > 0){
		return true;
	}else{
		return false;
	}
}

function cadastrar_processo($conexao_com_banco,$novo_processo, $urgente, $novo_descricao, $novo_detalhes, $novo_interessado, $novo_data_entrada, $setor, $pessoa, $novo_tipo) {
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_processos (CD_PROCESSO, URGENTE, DS_PROCESSO, NM_DETALHES, NM_INTERESSADO, DT_ENTRADA, CD_SETOR_LOCALIZACAO, CD_SERVIDOR_LOCALIZACAO, NM_SITUACAO, NM_SITUACAO_FINAL, NM_TIPO, NM_STATUS) VALUES ('$novo_processo','$urgente', '$novo_descricao', '$novo_detalhes', '$novo_interessado', '$novo_data_entrada', '$setor', '$pessoa' ,'Aberto', 'Aberto','$novo_tipo', 'Ativo')")  
	or die (mysqli_error($conexao_com_banco)); 
	
	if(isset($_GET['documento'])){
		
		$id_documento = $_GET['documento'];
		
		mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_PROCESSO='$novo_processo' WHERE CD_DOCUMENTO='$id_documento'");	
	
	}
	
}

function editar_processo($conexao_com_banco, $processo, $edita_processo, $edita_descricao, $edita_detalhes, $edita_interessado, $edita_tipo){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_PROCESSO='$edita_processo', DS_PROCESSO='$edita_descricao', NM_DETALHES='$edita_detalhes', NM_INTERESSADO='$edita_interessado', NM_TIPO='$edita_tipo'  WHERE CD_PROCESSO = '$processo'") or die (mysqli_error($conexao_com_banco)); 
	
	if($processo != $edita_processo){
		
		mysqli_query($conexao_com_banco, "UPDATE tb_historico_processos SET CD_PROCESSO='$edita_processo' WHERE CD_PROCESSO = '$processo'");
		
		mysqli_query($conexao_com_banco, "UPDATE tb_responsaveis_processos SET CD_PROCESSO='$edita_processo' WHERE CD_PROCESSO = '$processo'");
		
		mysqli_query($conexao_com_banco, "UPDATE tb_tramitacao_processos SET CD_PROCESSO='$edita_processo' WHERE CD_PROCESSO = '$processo'");
		
		mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_PROCESSO='$edita_processo' WHERE CD_PROCESSO = '$processo'");
	}
	
	}
	
	
function excluir_processo($conexao_com_banco, $id_processo) {

	excluir_historico_processo($conexao_com_banco, $id_processo);
	
	excluir_responsaveis_processo($conexao_com_banco, $id_processo);
	
	excluir_tramitacoes_processo($conexao_com_banco, $id_processo);

	mysqli_query($conexao_com_banco, "DELETE FROM tb_compras WHERE CD_PROCESSO='$id_processo'") or die (mysqli_error($conexao_com_banco));

	$resultado = mysqli_query($conexao_com_banco, "SELECT CD_DOCUMENTO FROM tb_documentos WHERE CD_PROCESSO='$id_processo'") or die (mysqli_error($conexao_com_banco));

	while($r = mysqli_fetch_object($resultado)){
		
		excluir_documento($conexao_com_banco, $r->CD_DOCUMENTO);	
		
	}
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_despesas WHERE CD_PROCESSO='$id_processo'");	
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_processos WHERE CD_PROCESSO='$id_processo'");	
		
}

function cadastrar_historico_processo($conexao_com_banco,$processo,$mensagem,$pessoa,$acao){
	
	$data_hora_atual = date('Y-m-d H:i:s'); 
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_processos (CD_PROCESSO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$processo', '$mensagem', '$pessoa', '$data_hora_atual', '$acao')")
	or die (mysqli_error($conexao_com_banco));
	
}

function excluir_historico_processo($conexao_com_banco, $id_processo){
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_historico_processos WHERE CD_PROCESSO='$id_processo'") or die (mysqli_error($conexao_com_banco));
	
}

function editar_prazo($conexao_com_banco, $prazo, $processo){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET DT_PRAZO='$prazo', NM_SITUACAO='Análise em andamento' WHERE CD_PROCESSO='$processo'") or die (mysqli_error($conexao_com_banco)); 
	
}

function editar_prazo_final($conexao_com_banco, $prazo_final, $processo){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET DT_PRAZO_FINAL='$prazo_final', NM_SITUACAO_FINAL='Finalização em andamento' WHERE CD_PROCESSO='$processo'") or die (mysqli_error($conexao_com_banco)); 
	
}

function editar_prazos($conexao_com_banco, $prazo, $prazo_final, $processo){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET DT_PRAZO='$prazo', DT_PRAZO_FINAL='$prazo_final', NM_SITUACAO='Análise em andamento', NM_SITUACAO_FINAL='Finalização em andamento' WHERE CD_PROCESSO='$processo'") or die (mysqli_error($conexao_com_banco)); 
	
}

function editar_situacao($conexao_com_banco, $situacao, $processo){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NM_SITUACAO='$situacao' WHERE CD_PROCESSO='$processo'") or die (mysqli_error($conexao_com_banco)); 
	
}

function editar_situacao_final($conexao_com_banco, $situacao_final, $processo){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NM_SITUACAO_FINAL='$situacao_final' WHERE CD_PROCESSO='$processo'") or die (mysqli_error($conexao_com_banco)); 
	
}

function arquivar_processo($conexao_com_banco, $data_saida, $situacao_final, $processo){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET DT_SAIDA='$data_saida', NM_SITUACAO_FINAL='$situacao_final', CD_SETOR_LOCALIZACAO='', CD_SERVIDOR_LOCALIZACAO='', NM_STATUS='Arquivado' WHERE CD_PROCESSO='$processo'") or die (mysqli_error($conexao_com_banco));
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE CD_PROCESSO='$processo'");

	if(mysqli_num_rows($resultado) > 0){
		mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_SERVIDOR_LOCALIZACAO='',CD_SETOR_LOCALIZACAO='', NM_STATUS='Resolvido', DT_RESOLVIDO='$data_saida' WHERE CD_PROCESSO='$processo'")
		or die (mysqli_error($conexao_com_banco));
	}
	
}

function desarquivar_processo($conexao_com_banco, $situacao_final, $pessoa, $setor, $processo){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_SETOR_LOCALIZACAO='$setor', DT_SAIDA='0000-00-00', CD_SERVIDOR_LOCALIZACAO='$pessoa', NM_SITUACAO_FINAL='$situacao_final', NM_STATUS='Ativo' WHERE CD_PROCESSO='$processo'") or die (mysqli_error($conexao_com_banco));
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE CD_PROCESSO='$processo'");

	if(mysqli_num_rows($resultado) > 0){
		mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_SERVIDOR_LOCALIZACAO='$pessoa',CD_SETOR_LOCALIZACAO='$setor', NM_STATUS='Em análise', DT_RESOLVIDO='0000-00-00' WHERE CD_PROCESSO='$processo'")
		or die (mysqli_error($conexao_com_banco));
	}
	
}

function sair_processo($conexao_com_banco, $data_saida, $processo){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET DT_SAIDA='$data_saida', CD_SETOR_LOCALIZACAO='', CD_SERVIDOR_LOCALIZACAO='', NM_STATUS='Saiu' WHERE CD_PROCESSO='$processo'") or die (mysqli_error($conexao_com_banco));
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE CD_PROCESSO='$processo'");

	if(mysqli_num_rows($resultado) > 0){
		mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_SERVIDOR_LOCALIZACAO='',CD_SETOR_LOCALIZACAO='', NM_STATUS='Resolvido', DT_RESOLVIDO='$data_saida' WHERE CD_PROCESSO='$processo'")
		or die (mysqli_error($conexao_com_banco));
	}

}

function voltar_processo($conexao_com_banco, $situacao_final, $pessoa, $setor, $processo){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_SETOR_LOCALIZACAO='$setor', DT_SAIDA='0000-00-00', CD_SERVIDOR_LOCALIZACAO='$pessoa', NM_SITUACAO_FINAL='$situacao_final', NM_STATUS='Ativo' WHERE CD_PROCESSO='$processo'") or die (mysqli_error($conexao_com_banco));
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE CD_PROCESSO='$processo'");

	if(mysqli_num_rows($resultado) > 0){
		mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_SERVIDOR_LOCALIZACAO='$pessoa',CD_SETOR_LOCALIZACAO='$setor', NM_STATUS='Em análise', DT_RESOLVIDO='0000-00-00' WHERE CD_PROCESSO='$processo'")
		or die (mysqli_error($conexao_com_banco));
	}
	
}

function cadastrar_responsaveis_processo($conexao_com_banco, $processo, $responsaveis){
	
	for ($i=0;$i<count($responsaveis);$i++){
		mysqli_query($conexao_com_banco, "INSERT INTO tb_responsaveis_processos (CD_PROCESSO, CD_SERVIDOR) VALUES ('$processo', '$responsaveis[$i]')") or die (mysqli_error($conexao_com_banco));
	}
	
}

function remover_responsavel_processo($conexao_com_banco, $processo, $responsavel){
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_responsaveis_processos WHERE CD_PROCESSO='$processo' AND CD_SERVIDOR='$responsavel'") or die(mysqli_error($conexao_com_banco));
	
}

function excluir_responsaveis_processo($conexao_com_banco, $id_processo){
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_responsaveis_processos WHERE CD_PROCESSO='$id_processo'") or die(mysqli_error($conexao_com_banco));
	
}

function retorna_responsaveis($conexao_com_banco, $processo){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_responsaveis_processos WHERE CD_PROCESSO='$processo'");
	
	return $resultado;
	
}

function tramitar_processo($conexao_com_banco, $origem, $destino, $setor_destino, $processo){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_SETOR_LOCALIZACAO='$setor_destino', CD_SERVIDOR_LOCALIZACAO='$destino' WHERE CD_PROCESSO='$processo'") 
    or die (mysqli_error($conexao_com_banco));
	
	$data_tramitacao = date('Y-m-d H:i:s'); 
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_tramitacao_processos (CD_PROCESSO, CD_SERVIDOR_ORIGEM, CD_SERVIDOR_DESTINO, DT_TRAMITACAO) VALUES ('$processo', '$origem', '$destino', '$data_tramitacao')")
	or die (mysqli_error($conexao_com_banco));
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE CD_PROCESSO='$processo'");

	if(mysqli_num_rows($resultado) > 0){
		
		enviar_documentos_processo($conexao_com_banco, $processo, $destino, $setor_destino);
		
	}
	
}

function enviar_documentos_processo($conexao_com_banco, $id_processo, $pessoa_recebeu, $setor_recebeu){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_SERVIDOR_LOCALIZACAO='$pessoa_recebeu', CD_SETOR_LOCALIZACAO='$setor_recebeu' WHERE CD_PROCESSO='$id_processo'") or die (mysqli_error($conexao_com_banco));

}

function excluir_tramitacoes_processo($conexao_com_banco, $id_processo){
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_tramitacao_processos WHERE CD_PROCESSO='$id_processo'") 
    or die (mysqli_error($conexao_com_banco));
	
}

function definir_urgencia_processo($conexao_com_banco, $valor, $processo){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET URGENTE='$valor' WHERE CD_PROCESSO = '$processo'") or die (mysqli_error($conexao_com_banco)); 
	
	
}
	
	


?>