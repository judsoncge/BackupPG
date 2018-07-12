<?php

function existe_processo($conexao_com_banco, $numero_processo){
	
	$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_processos WHERE CD_PROCESSO='$numero_processo'");

	if(mysqli_num_rows($retornoquery) > 0){
		return true;
	}else{
		return false;
	}
}

function cadastrar_processo($conexao_com_banco, $numero_processo, $urgencia, $assunto, $detalhes, $orgao, $interessado, $data_entrada, $prazo, $setor, $servidor){

	mysqli_query($conexao_com_banco, "INSERT INTO tb_processos (CD_PROCESSO, BL_URGENCIA, ID_ASSUNTO, NM_DETALHES, ID_ORGAO_INTERESSADO, NM_INTERESSADO, DT_ENTRADA, DT_PRAZO, ID_SETOR_LOCALIZACAO, ID_SERVIDOR_LOCALIZACAO, NM_STATUS) VALUES ('$numero_processo','$urgencia', '$assunto', '$detalhes', '$orgao', '$interessado', '$data_entrada', '$prazo' ,'$setor', '$servidor' , 'EM ANDAMENTO')") or die (mysqli_error($conexao_com_banco)); 
	
	return mysqli_insert_id($conexao_com_banco);
}

function editar_processo($conexao_com_banco, $numero_processo, $urgencia, $assunto, $detalhes, $orgao, $interessado, $prazo, $id){

	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_PROCESSO='$numero_processo', BL_URGENCIA='$urgencia', ID_ASSUNTO='$assunto',  NM_DETALHES='$detalhes', ID_ORGAO_INTERESSADO='$orgao' , NM_INTERESSADO='$interessado', DT_PRAZO='$prazo' WHERE ID = '$id'") or die (mysqli_error($conexao_com_banco)); 
	
}

function editar_prazo_processo($conexao_com_banco, $prazo, $id){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET DT_PRAZO = '$prazo' WHERE ID='$id'");
	
}

function excluir_processo($conexao_com_banco, $id){
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_historico_processos WHERE ID_PROCESSO='$id'") or die(mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_tramitacao_processos WHERE ID_PROCESSO='$id'") or die(mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_processos WHERE ID='$id'") or die(mysqli_error($conexao_com_banco));	
	
}

function cadastrar_historico_processo($conexao_com_banco, $id, $mensagem, $servidor, $acao){
	
	$data_hora_atual = date('Y-m-d H:i:s'); 
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_processos (ID_PROCESSO, NM_MENSAGEM, ID_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id', '$mensagem', '$servidor', '$data_hora_atual', '$acao')")
	or die (mysqli_error($conexao_com_banco));
	
}

function confirmar_recebimento_processo($conexao_com_banco, $servidor_confirmou, $setor_servidor_confirmou, $id_tramitacao, $id) {
	
	$data_hora_atual = date('Y-m-d H:i:s');

	mysqli_query($conexao_com_banco, "UPDATE tb_tramitacao_processos SET BL_RECEBIDO='1' WHERE ID_PROCESSO = '$id'")
	or die (mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "UPDATE tb_tramitacao_processos SET DT_CONFIRMACAO='$data_hora_atual', ID_SERVIDOR_CONFIRMOU='$servidor_confirmou'	WHERE ID = '$id_tramitacao'")
	or die (mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET ID_SETOR_LOCALIZACAO='$setor_servidor_confirmou', ID_SERVIDOR_LOCALIZACAO='$servidor_confirmou' WHERE ID='$id'")
	or die (mysqli_error($conexao_com_banco));
	
}

function recusar_recebimento_processo($conexao_com_banco, $id_tramitacao, $id, $origem, $setor_origem){
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_tramitacao_processos WHERE ID='$id_tramitacao'")
	or die (mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET ID_SERVIDOR_LOCALIZACAO = '$origem' , ID_SETOR_LOCALIZACAO = '$setor_origem' WHERE ID = '$id'")
	or die (mysqli_error($conexao_com_banco));
	
}

function tramitar_registrar_processo($conexao_com_banco, $id, $origem, $destino, $setor_origem, $setor_destino){
	
	$data_hora_atual = date('Y-m-d H:i:s');
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_tramitacao_processos (ID_PROCESSO, ID_SERVIDOR_ORIGEM, ID_SETOR_ORIGEM, ID_SERVIDOR_DESTINO, ID_SETOR_DESTINO, DT_TRAMITACAO, BL_RECEBIDO) VALUES ('$id', '$origem', '$setor_origem', '$destino', '$setor_destino', '$data_hora_atual', '0')")
	or die (mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET ID_SERVIDOR_LOCALIZACAO='$destino', ID_SETOR_LOCALIZACAO='$setor_destino' WHERE ID='$id'")
	or die (mysqli_error($conexao_com_banco));
	
}

function tramitar_processo($conexao_com_banco, $id, $destino, $setor_destino){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET ID_SERVIDOR_LOCALIZACAO='$destino', ID_SETOR_LOCALIZACAO='$setor_destino' WHERE ID='$id'")
	or die (mysqli_error($conexao_com_banco));
	
}

function definir_responsavel_processo($conexao_com_banco, $id, $responsavel){
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_responsaveis_processos (ID_PROCESSO, ID_SERVIDOR) VALUES ('$id', '$responsavel')")
	or die (mysqli_error($conexao_com_banco));
	
}

function remover_responsavel_processo($conexao_com_banco, $id, $responsavel){
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_responsaveis_processos WHERE ID_PROCESSO='$id' AND ID_SERVIDOR='$responsavel'") 
	or die (mysqli_error($conexao_com_banco));
	
}

function definir_responsavel_lider($conexao_com_banco, $id, $responsavel, $setor_responsavel){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_responsaveis_processos SET BL_LIDER=0 WHERE ID_PROCESSO='$id'") 
	or die (mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "UPDATE tb_responsaveis_processos SET BL_LIDER=1 WHERE ID_PROCESSO='$id' AND ID_SERVIDOR='$responsavel'") 
	or die (mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET ID_SETOR_RESPONSAVEL='$setor_responsavel' WHERE ID='$id'") 
	or die (mysqli_error($conexao_com_banco));
	
}

function definir_responsavel_lider_processo($conexao_com_banco, $id, $lider){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_responsaveis_processos SET BL_LIDER = 1 WHERE ID_SERVIDOR = $lider AND ID_PROCESSO = $id");
	
	mysqli_query($conexao_com_banco, "UPDATE tb_responsaveis_processos SET BL_LIDER = 0 WHERE ID_SERVIDOR != $lider AND ID_PROCESSO = $id");
	
}

function definir_apenso_processo($conexao_com_banco, $id, $apenso){
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_processos_apensados (ID_PROCESSO_MAE, ID_PROCESSO_APENSADO) VALUES ('$id', '$apenso')")
	or die (mysqli_error($conexao_com_banco));
	
}

function remover_apenso_processo($conexao_com_banco, $id, $apenso){
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_processos_apensados WHERE ID_PROCESSO_MAE='$id' AND ID_PROCESSO_APENSADO='$apenso'") 
	or die (mysqli_error($conexao_com_banco));
	
}

function marcar_urgencia_processo($conexao_com_banco, $id){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET BL_URGENCIA = 1 WHERE ID = '$id'") or die (mysqli_error($conexao_com_banco));
	
}

function desmarcar_urgencia_processo($conexao_com_banco, $id){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET BL_URGENCIA = 0 WHERE ID = '$id'") or die (mysqli_error($conexao_com_banco));
	
}

function finalizar_processo_setor($conexao_com_banco, $id, $status){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NM_STATUS = '$status' WHERE ID = '$id'") or die (mysqli_error($conexao_com_banco));
	
}

function finalizar_processo_gabinete($conexao_com_banco, $id, $status){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NM_STATUS = '$status' WHERE ID = '$id'") or die (mysqli_error($conexao_com_banco));
	
}

function desfazer_finalizacao_processo($conexao_com_banco, $id, $status){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NM_STATUS = '$status' WHERE ID = '$id'") or die (mysqli_error($conexao_com_banco));
	
}

function arquivar_processo($conexao_com_banco, $id, $status){
	
	$data_hora_atual = date('Y-m-d H:i:s');
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NM_STATUS = '$status', ID_SERVIDOR_LOCALIZACAO=NULL, ID_SETOR_LOCALIZACAO=NULL, DT_SAIDA='$data_hora_atual' WHERE ID = '$id'") or die (mysqli_error($conexao_com_banco));
	
}

function sair_processo($conexao_com_banco, $id, $status){
	
	$data_hora_atual = date('Y-m-d H:i:s');
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NM_STATUS = '$status', ID_SERVIDOR_LOCALIZACAO=NULL, ID_SETOR_LOCALIZACAO=NULL, DT_SAIDA='$data_hora_atual' WHERE ID = '$id'") or die (mysqli_error($conexao_com_banco));
	
}

function anexar_documento_processo($conexao_com_banco, $id, $tipo, $servidor, $anexo){
	
	$data_atual = date('Y-m-d');
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_documentos (ID_PROCESSO, NM_TIPO, DT_CRIACAO, ID_SERVIDOR_CRIACAO, NM_ANEXO) VALUES ('$id', '$tipo', '$data_atual', '$servidor','$anexo')") or die (mysqli_error($conexao_com_banco));
	
	
}

function excluir_documento_processo($conexao_com_banco, $id_documento){
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_documentos WHERE ID='$id_documento'") or die (mysqli_error($conexao_com_banco));
	
}

function voltar_processo($conexao_com_banco, $id, $prazo, $servidor, $setor){
	
	$data_atual = date('Y-m-d');
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET DT_ENTRADA='$data_atual', BL_ATRASADO = 0, DT_SAIDA='0000-00-00', DT_PRAZO='$prazo', ID_SERVIDOR_LOCALIZACAO='$servidor', ID_SETOR_LOCALIZACAO='$setor', NR_DIAS=0, NM_STATUS='EM ANDAMENTO' WHERE ID='$id'") or die (mysqli_error($conexao_com_banco));
	
}

function desarquivar_processo($conexao_com_banco, $status, $servidor, $setor, $id){
	
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET ID_SETOR_LOCALIZACAO='$setor', DT_SAIDA='0000-00-00', ID_SERVIDOR_LOCALIZACAO='$servidor', NM_STATUS='$status' WHERE ID='$id'") or die (mysqli_error($conexao_com_banco));
	
}

function marcar_sobrestado_processo($conexao_com_banco, $id){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET BL_SOBRESTADO=1 WHERE ID='$id'") or die (mysqli_error($conexao_com_banco));
	
	
}


function desmarcar_sobrestado_processo($conexao_com_banco, $id){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET BL_SOBRESTADO=0 WHERE ID='$id'") or die (mysqli_error($conexao_com_banco));
	
	
}

function cadastrar_solicitacao_sobrestado($conexao_com_banco, $id, $servidor, $justificativa){
	
	$data_atual = date('Y-m-d H:i:s');
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_processos_sobrestados (ID_PROCESSO, ID_SERVIDOR_SOLICITANTE, NM_JUSTIFICATIVA, DT_SOLICITACAO, DT_RESPOSTA, NM_STATUS) VALUES ('$id', '$servidor', '$justificativa', '$data_atual', '$data_atual', 'ACEITO')") or die (mysqli_error($conexao_com_banco));
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET BL_SOBRESTADO = 1 WHERE ID=$id") or die (mysqli_error($conexao_com_banco));
		
}

function aceitar_solicitacao_sobrestado($conexao_com_banco, $id, $servidor){
	
	$data_atual = date('Y-m-d H:i:s');
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos_sobrestados SET ID_SERVIDOR_RESPOSTA='$servidor', DT_RESPOSTA='$data_atual', NM_STATUS='ACEITO' WHERE ID = '$id'") or die (mysqli_error($conexao_com_banco));
	
}

function recusar_solicitacao_sobrestado($conexao_com_banco, $id, $servidor){
	
	$data_atual = date('Y-m-d H:i:s');
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos_sobrestados SET ID_SERVIDOR_RESPOSTA='$servidor', DT_RESPOSTA='$data_atual', NM_STATUS='RECUSADO' WHERE ID = '$id'") or die (mysqli_error($conexao_com_banco));
	
}


?>
