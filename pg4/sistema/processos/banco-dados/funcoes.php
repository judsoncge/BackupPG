<?php

function existe_processo($conexao_com_banco, $novo_processo){
	
	$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_processos WHERE CD_PROCESSO='$novo_processo'");

	if(mysqli_num_rows($retornoquery) > 0){
		return true;
	}else{
		return false;
	}
}

function cadastrar_processo($conexao_com_banco,$novo_processo, $nr_urgencia, $novo_assunto, $novo_detalhes, $orgao_interessado, $novo_interessado, $novo_data_entrada, $novo_prazo, $setor, $pessoa) {
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_processos (CD_PROCESSO, NR_URGENCIA, ID_ASSUNTO, NM_DETALHES, ID_ORGAO_INTERESSADO, NM_INTERESSADO, DT_ENTRADA, DT_PRAZO, CD_SETOR_LOCALIZACAO, CD_SERVIDOR_LOCALIZACAO, NM_STATUS) VALUES ('$novo_processo','$nr_urgencia', '$novo_assunto', '$novo_detalhes', '$orgao_interessado', '$novo_interessado', '$novo_data_entrada', '$novo_prazo' ,'$setor', '$pessoa' , 'Em andamento')") or die (mysqli_error($conexao_com_banco)); 
	
	if(isset($_GET['documento'])){
		
		$id_documento = $_GET['documento'];
		
		mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_PROCESSO='$novo_processo' WHERE CD_DOCUMENTO='$id_documento'");	
	
	}
	
}

function editar_processo($conexao_com_banco, $processo, $edita_processo, $edita_assunto, $edita_detalhes, $edita_orgao, $edita_interessado, $edita_prazo){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_PROCESSO='$edita_processo', ID_ASSUNTO='$edita_assunto', NM_DETALHES='$edita_detalhes', ID_ORGAO_INTERESSADO='$edita_orgao' , NM_INTERESSADO='$edita_interessado', DT_PRAZO='$edita_prazo' WHERE CD_PROCESSO = '$processo'") or die (mysqli_error($conexao_com_banco)); 
	
	if($processo != $edita_processo){
		
		mysqli_query($conexao_com_banco, "UPDATE tb_historico_processos SET CD_PROCESSO='$edita_processo' WHERE CD_PROCESSO = '$processo'");
		
		mysqli_query($conexao_com_banco, "UPDATE tb_responsaveis_processos SET CD_PROCESSO='$edita_processo' WHERE CD_PROCESSO = '$processo'");
		
		mysqli_query($conexao_com_banco, "UPDATE tb_tramitacao_processos SET CD_PROCESSO='$edita_processo' WHERE CD_PROCESSO = '$processo'");
		
		mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_PROCESSO='$edita_processo' WHERE CD_PROCESSO = '$processo'");
		
		mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_PROCESSO_APENSADO='$edita_processo' WHERE CD_PROCESSO_APENSADO = '$processo'");
		
		mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET ID_ASSUNTO='$edita_assunto', DS_DOCUMENTO='$edita_detalhes', NM_INTERESSADO='$edita_interessado' WHERE CD_PROCESSO = '$edita_processo'") or die (mysqli_error($conexao_com_banco)); 
	
	}else{
		mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET ID_ASSUNTO='$edita_assunto', DS_DOCUMENTO='$edita_detalhes', NM_INTERESSADO='$edita_interessado' WHERE CD_PROCESSO = '$processo'") or die (mysqli_error($conexao_com_banco)); 
	}
}
	
	
function excluir_processo($conexao_com_banco, $id_processo) {

	excluir_historico_processo($conexao_com_banco, $id_processo);
	
	excluir_responsaveis_processo($conexao_com_banco, $id_processo);
	
	excluir_tramitacoes_processo($conexao_com_banco, $id_processo);

	mysqli_query($conexao_com_banco, "DELETE FROM tb_compras WHERE CD_PROCESSO='$id_processo'") or die (mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_PROCESSO_APENSADO='' WHERE CD_PROCESSO_APENSADO='$id_processo'") or die (mysqli_error($conexao_com_banco));

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
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET DT_PRAZO='$prazo', NM_STATUS='Em andamento' WHERE CD_PROCESSO='$processo'") or die (mysqli_error($conexao_com_banco)); 
	
	mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET DT_PRAZO='$prazo' WHERE CD_PROCESSO='$processo'") or die (mysqli_error($conexao_com_banco)); 
	
}

function editar_status_processo($conexao_com_banco, $processo, $status){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NM_STATUS='$status' WHERE CD_PROCESSO='$processo'");
	
}

function arquivar_sair_processo($conexao_com_banco, $data_saida, $status, $processo){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET DT_SAIDA='$data_saida', CD_SETOR_LOCALIZACAO='', CD_SERVIDOR_LOCALIZACAO='', NM_STATUS='$status' WHERE CD_PROCESSO='$processo'") or die (mysqli_error($conexao_com_banco));
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE CD_PROCESSO='$processo'");

	if(mysqli_num_rows($resultado) > 0){
		mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_SERVIDOR_LOCALIZACAO='',CD_SETOR_LOCALIZACAO='', NM_STATUS='Resolvido', DT_RESOLVIDO='$data_saida' WHERE CD_PROCESSO='$processo'")
		or die (mysqli_error($conexao_com_banco));
	}
	
}

function desarquivar_processo($conexao_com_banco, $status, $pessoa, $setor, $processo){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_SETOR_LOCALIZACAO='$setor', DT_SAIDA='0000-00-00', CD_SERVIDOR_LOCALIZACAO='$pessoa', NM_STATUS='$status' WHERE CD_PROCESSO='$processo'") or die (mysqli_error($conexao_com_banco));
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE CD_PROCESSO='$processo'");

	if(mysqli_num_rows($resultado) > 0){
		mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_SERVIDOR_LOCALIZACAO='$pessoa',CD_SETOR_LOCALIZACAO='$setor', NM_STATUS='Em análise', DT_RESOLVIDO='0000-00-00' WHERE CD_PROCESSO='$processo'")
		or die (mysqli_error($conexao_com_banco));
	}
	
}

function voltar_processo($conexao_com_banco, $pessoa, $setor, $prazo, $processo){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_SETOR_LOCALIZACAO='$setor', DT_SAIDA='0000-00-00', CD_SERVIDOR_LOCALIZACAO='$pessoa', NM_STATUS='Em andamento', DT_PRAZO='$prazo', NR_DIAS='0' WHERE CD_PROCESSO='$processo'") or die (mysqli_error($conexao_com_banco));
	
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
	
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT count(CD_SERVIDOR) FROM tb_responsaveis_processos WHERE CD_PROCESSO='$processo'") or die (mysqli_error($conexao_com_banco));
	
	$total_responsaveis = mysqli_fetch_row($resultado);
	
	if($total_responsaveis[0]==1){	
		cadastrar_lider_processo($conexao_com_banco, $processo, $responsaveis[0]);
	}
	
}

function definir_responsavel_processo($conexao_com_banco, $processo, $servidor){
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_responsaveis_processos (CD_PROCESSO, CD_SERVIDOR) VALUES ('$processo','$servidor')") or die (mysqli_error($conexao_com_banco));
	
}

function definir_lider_processo($conexao_com_banco, $processo, $servidor){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_SERVIDOR_RESPONSAVEL_LIDER='$servidor' WHERE CD_PROCESSO='$processo'") or die (mysqli_error($conexao_com_banco));
	
}

function cadastrar_apensos_processo($conexao_com_banco, $processo, $apensos){
	
	$servidor = $_SESSION['CPF'];
	
	$setor = $_SESSION['setor'];
	
	$prazo = retorna_prazo_processo($processo, $conexao_com_banco);
	
	for ($i=0;$i<count($apensos);$i++){
		
		mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_PROCESSO_APENSADO='$processo', CD_SERVIDOR_LOCALIZACAO='$servidor', CD_SETOR_LOCALIZACAO='$setor', DT_PRAZO='$prazo' WHERE CD_PROCESSO='$apensos[$i]'") or die (mysqli_error($conexao_com_banco));
			
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

function tramitar_processo($conexao_com_banco, $origem, $destino, $setor_destino, $processo, $recebido){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_SETOR_LOCALIZACAO='$setor_destino', CD_SERVIDOR_LOCALIZACAO='$destino' WHERE CD_PROCESSO='$processo'") or die (mysqli_error($conexao_com_banco));
	
	$data_tramitacao = date('Y-m-d H:i:s'); 
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_tramitacao_processos (CD_PROCESSO, CD_SERVIDOR_ORIGEM, CD_SERVIDOR_DESTINO, DT_TRAMITACAO, RECEBIDO) VALUES ('$processo', '$origem', '$destino', '$data_tramitacao', '$recebido')")
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
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NR_URGENCIA='$valor' WHERE CD_PROCESSO = '$processo' or CD_PROCESSO_APENSADO='$processo'") or die (mysqli_error($conexao_com_banco)); 
		
	$prioridade = ($valor==1) ? 1 : 3;
	
	mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET NR_PRIORIDADE='$prioridade' WHERE CD_PROCESSO IN (SELECT CD_PROCESSO FROM tb_processos WHERE CD_PROCESSO='$processo' or CD_PROCESSO_APENSADO='$processo')") or die (mysqli_error($conexao_com_banco)); 
	
}

function retorna_setor_finalizou($conexao_com_banco, $processo){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT s.CD_SETOR, MAX(hp.DT_MENSAGEM) FROM tb_servidores s, tb_historico_processos hp WHERE s.CD_SERVIDOR = hp.CD_SERVIDOR and hp.CD_PROCESSO='$processo' and hp.NM_ACAO='Finalização'"); 
	
	$setor = mysqli_fetch_row($resultado);
	
	return $setor[0];
	
}
	
	
function retorna_dias_prazo_assunto_processo($conexao_com_banco, $assunto){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NR_DIAS_PRAZO FROM tb_assuntos_processos WHERE ID='$assunto'");	
	
	$dias = mysqli_fetch_row($resultado);
	
	return $dias[0];
	
}

function editar_status_documentos_processo($conexao_com_banco, $processo, $status){
	
	$resultado = mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET NM_STATUS='$status' WHERE CD_PROCESSO='$processo'");	
	
}

function cadastrar_lider_processo($conexao_com_banco, $processo, $responsavel){
	
	 mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_SERVIDOR_RESPONSAVEL_LIDER='$responsavel' WHERE CD_PROCESSO='$processo'");
	
}

function remover_lider_processo($conexao_com_banco, $processo){
	
	 mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_SERVIDOR_RESPONSAVEL_LIDER='' WHERE CD_PROCESSO='$processo'");
	
}

function cadastrar_orgao($conexao_com_banco, $cd_orgao, $nm_orgao) {
	
	 mysqli_query($conexao_com_banco, "INSERT INTO `tb_orgaos` (`ID`, `CD_ORGAO`, `NM_ORGAO`) VALUES (NULL, '$cd_orgao', '$nm_orgao')");
	
}

	


?>