<?php

function cadastrar_documento($conexao_com_banco, $processo, $tipo_atividade, $tipo_documento, $interessado, $data_entrada, $prazo, $data_criacao, $prioridade, $descricao_fato, $texto_documento, $valor, $criado_por, $esta_com, $esta_setor, $status){
	mysqli_query($conexao_com_banco, "INSERT INTO tb_documentos(CD_PROCESSO, ID_ASSUNTO, NM_DOCUMENTO, NM_INTERESSADO, DT_ENTRADA, DT_PRAZO, DT_CRIACAO,  NR_PRIORIDADE, DS_DOCUMENTO, TX_DOCUMENTO, VLR_DOCUMENTO, CD_SERVIDOR_CRIACAO, CD_SERVIDOR_LOCALIZACAO, CD_SETOR_LOCALIZACAO, NM_STATUS) VALUES ('$processo' ,'$tipo_atividade','$tipo_documento','$interessado', '$data_entrada', '$prazo', '$data_criacao','$prioridade','$descricao_fato', '$texto_documento', '$valor','$criado_por', '$esta_com', '$esta_setor' ,'$status')") or die (mysqli_error($conexao_com_banco));	
	
	return mysqli_insert_id($conexao_com_banco);

}

function editar_documento($conexao_com_banco, $id_documento, $processo, $tipo_atividade, $tipo_documento, $interessado, $data_entrada, $prazo, $prioridade, $descricao_fato, $texto_documento, $valor){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_PROCESSO='$processo', ID_ASSUNTO='$tipo_atividade', NM_DOCUMENTO='$tipo_documento', NM_INTERESSADO='$interessado', DT_ENTRADA='$data_entrada', DT_PRAZO='$prazo', NR_PRIORIDADE='$prioridade', DS_DOCUMENTO='$descricao_fato', TX_DOCUMENTO='$texto_documento', VLR_DOCUMENTO='$valor' WHERE CD_DOCUMENTO='$id_documento'") 
	or die (mysqli_error($conexao_com_banco));
	

}

function editar_status_documento($conexao_com_banco, $id_documento, $status){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET NM_STATUS='$status' WHERE CD_DOCUMENTO='$id_documento'") or die (mysqli_error($conexao_com_banco));
	
}

function resolver_documento($conexao_com_banco, $id_documento){
	
	$data_hora_atual = date('Y-m-d H:i:s'); 
	
	mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_SERVIDOR_LOCALIZACAO='', CD_SETOR_LOCALIZACAO='', DT_RESOLVIDO='$data_hora_atual', NM_STATUS='Resolvido' WHERE CD_DOCUMENTO='$id_documento'") or die (mysqli_error($conexao_com_banco));
	
}

function excluir_documento($conexao_com_banco, $id_documento){
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_documentos WHERE CD_DOCUMENTO='$id_documento'");

	excluir_historico_documento($conexao_com_banco, $id_documento);

	excluir_anexos_documento($conexao_com_banco, $id_documento);

}

function excluir_anexos_documento($conexao_com_banco, $id_documento){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT ID, NM_ARQUIVO FROM tb_anexos_documento WHERE CD_DOCUMENTO='$id_documento'");
	
	while($r = mysqli_fetch_object($resultado)){
		
		$nome_anexo = $r->NM_ARQUIVO;
		
		$id_anexo = $r->ID;
		
		mysqli_query($conexao_com_banco, "DELETE FROM tb_anexos_documento WHERE ID='$id_anexo'");
		
		$nome_anexo = '../../../registros/anexos/'.$nome_anexo;
		
		unlink($nome_anexo);

	}

}

function excluir_anexo_documento($conexao_com_banco, $id_anexo, $nome_anexo){
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_anexos_documento WHERE ID='$id_anexo'");

	$nome_anexo = '../../../registros/anexos/'.$nome_anexo;
				
	unlink($nome_anexo);

}


function cadastrar_historico_documento($conexao_com_banco, $id_documento, $mensagem, $pessoa, $tipo_sugestao, $acao){
	
	$data_hora_atual = date('Y-m-d H:i:s'); 
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_documentos (CD_DOCUMENTO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_TIPO, NM_ACAO) VALUES ('$id_documento', '$mensagem', '$pessoa', '$data_hora_atual', '$tipo_sugestao' ,'$acao')")
	or die (mysqli_error($conexao_com_banco));
	
}

function excluir_historico_documento($conexao_com_banco, $id_documento){
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_historico_documentos WHERE CD_DOCUMENTO='$id_documento'") or die (mysqli_error($conexao_com_banco));
	
}

function enviar_documento($conexao_com_banco, $id_documento, $pessoa_recebeu, $setor_recebeu){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_SERVIDOR_LOCALIZACAO='$pessoa_recebeu', CD_SETOR_LOCALIZACAO='$setor_recebeu' WHERE CD_DOCUMENTO='$id_documento'") or die (mysqli_error($conexao_com_banco));
	
}


?>