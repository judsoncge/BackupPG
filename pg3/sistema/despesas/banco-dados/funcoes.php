<?php

function existe_despesa($conexao_com_banco, $id_despesa){
	
	$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_tipos_despesas WHERE CD_DESPESA='$id_despesa'");

	if(mysqli_num_rows($retornoquery) > 0){
		return true;
	}else{
		return false;
	}
}

function cadastrar_despesa($conexao_com_banco, $codigo_despesa, $processo, $descricao, $mes, $ano, $valor, $data_vencimento){
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_despesas VALUES ('a','$codigo_despesa','$processo', '$descricao' ,'$mes', '$ano', '$valor','$data_vencimento', 'Solicitado')")  or die (mysqli_error($conexao_com_banco));
	
	return mysqli_insert_id($conexao_com_banco);
	
}

function atualiza_data_despesa($conexao_com_banco, $id_despesa, $mes, $ano){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_despesas SET NR_MES='$mes', NR_ANO='$ano' WHERE ID_DESPESA='$id_despesa'")  or die (mysqli_error($conexao_com_banco));
		
}

function excluir_despesa($conexao_com_banco, $id_despesa){
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_despesas WHERE ID_DESPESA='$id_despesa'");

	excluir_historico_despesa($conexao_com_banco, $id_despesa);

	excluir_anexos_despesa($conexao_com_banco, $id_despesa);

}

function cadastrar_tipo_despesa($conexao_com_banco, $codigo_despesa, $tipo_despesa, $nome_despesa){
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_tipos_despesas VALUES ('$codigo_despesa','$tipo_despesa','$nome_despesa')") or die (mysqli_error($conexao_com_banco));
	
}

function cadastrar_historico_despesa($conexao_com_banco, $id_despesa, $mensagem, $pessoa, $acao){
	
	$data_hora_atual = date('Y-m-d H:i:s'); 
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_despesas (ID_DESPESA, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_despesa', '$mensagem', '$pessoa', '$data_hora_atual', '$acao')")
	or die (mysqli_error($conexao_com_banco));
	
}

function excluir_historico_despesa($conexao_com_banco, $id_despesa){
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_historico_despesas WHERE ID_DESPESA='$id_despesa'") or die (mysqli_error($conexao_com_banco));
	
}

function editar_status($conexao_com_banco, $id_despesa, $status){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_despesas SET NM_STATUS='$status' WHERE ID_DESPESA='$id_despesa'");
	
}

function pagar_despesa($conexao_com_banco, $id_despesa, $mes, $ano, $valor, $status){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_despesas SET NM_STATUS='$status' WHERE ID_DESPESA='$id_despesa'");
	
	atualizar_caixa($mes, $ano, -$valor, $conexao_com_banco);
	
}

function excluir_anexo_despesa($conexao_com_banco, $id_anexo, $nome_anexo){
	
	mysqli_query($conexao_com_banco, "DELETE FROM tb_anexos_despesa WHERE ID_DESPESA='$id_anexo'");

	$nome_anexo = '../../../registros/anexos/'.$nome_anexo;
				
	unlink($nome_anexo);

}

function excluir_anexos_despesa($conexao_com_banco, $id_despesa){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT ID_DESPESA, NM_ARQUIVO FROM tb_anexos_despesa WHERE ID_DESPESA='$id_despesa'");
	
	while($r = mysqli_fetch_object($resultado)){
		
		$nome_anexo = $r->NM_ARQUIVO;
		
		$id_anexo = $r->ID_DESPESA;
		
		excluir_anexo_despesa($conexao_com_banco, $id_anexo, $nome_anexo);

	}

}


?>