<?php

if($_GET['operacao']=='pagar'){ 

		mysqli_query($conexao_com_banco, "UPDATE tb_despesas SET NM_STATUS='Pago' WHERE ID='$despesa'") or die (mysqli_error($conexao_com_banco));
		
		$caixa = retorna_caixa_mes_ano($mes, $ano, $conexao_com_banco);
		
		$novo_caixa = $caixa - $valor;
		
		mysqli_query($conexao_com_banco, "UPDATE tb_caixa SET VLR_CAIXA='$novo_caixa' WHERE NR_MES='$mes' AND NR_ANO='$ano'");
		
		mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_despesas (ID, ID_DESPESA, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_despesa', '$despesa', '$mensagem', '$pessoa', '$data_hoje', '$acao')")
		or die (mysqli_error($conexao_com_banco));
			
		header("Location:../../../interface/despesas.php?sessionId=$num&mensagem=A despesa foi paga com sucesso!&resultado=sucesso");

}

else if($_GET['operacao']=='mensagem'){
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_despesas (ID, ID_DESPESA, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_despesa', '$despesa', '$mensagem', '$cpf', '$data_mensagem', 'Mensagem')")
	or die (mysqli_error($conexao_com_banco));
	
	echo "<script>history.back();</script>";
	
}

else if($_GET['operacao']=='status'){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_despesas SET NM_STATUS='$edita_status' WHERE ID='$despesa'") 
	or die (mysqli_error($conexao_com_banco));
	 
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_despesas (ID, ID_DESPESA, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_despesa', '$despesa', '$mensagem', '$pessoa', '$data_hoje', '$acao')")
	or die (mysqli_error($conexao_com_banco));
 
	echo "<script>history.back();</script>";

}

else if($_GET['operacao']=='info'){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_despesas SET CD_DESPESA='$edita_codigo_despesa', DS_DESPESA='$edita_descricao', NR_MES='$edita_mes', NR_ANO='$edita_ano', VLR_DESPESA='$edita_valor', DT_VENCIMENTO='$edita_data_vencimento' WHERE ID='$id_despesa'") 
	or die (mysqli_error($conexao_com_banco));
	 
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_despesas (ID, ID_DESPESA, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_despesa', '$id_despesa', '$mensagem', '$pessoa', '$data_hoje', 'Edição')")
	or die (mysqli_error($conexao_com_banco));
 
	header("Location:../../../interface/despesas.php?sessionId=$num&mensagem=As informações foram editadas com sucesso!&resultado=sucesso");

}
	


?>