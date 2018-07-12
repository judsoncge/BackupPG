<?php

if($_GET['operacao']=='despesa'){

	mysqli_query($conexao_com_banco, "INSERT INTO tb_despesas VALUES ('$id_despesa','$novo_codigo_despesa','$novo_descricao', '$novo_mes', '$novo_ano', '$novo_valor','$novo_data_vencimento', 'Solicitado')")  or die (mysqli_error($conexao_com_banco));
	
	if($novo_anexo != ""){
	 
		mysqli_query($conexao_com_banco, "INSERT INTO tb_anexos (ID, CD_REFERENTE, NM_ARQUIVO) VALUES ('$id_anexo','$id_despesa', '$novo_anexo')") 
		or die (mysqli_error($conexao_com_banco));

	}
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_despesas VALUES ('$id_historico_despesa','$id_despesa','ABRIU UMA SOLICITAÇÃO DE PAGAMENTO', '$pessoa', '$data_hoje', 'Solicitação')")  or die (mysqli_error($conexao_com_banco));

	header("Location:../../../interface/despesas.php?sessionId=$num&mensagem=A despesa foi cadastrada com sucesso!&resultado=sucesso");

} else if($_GET['operacao']=='tipo_despesa'){

	mysqli_query($conexao_com_banco, "INSERT INTO tb_tipos_despesas VALUES ('$novo_codigo_despesa','$novo_tipo_despesa','$novo_nome_despesa')")  
	or die (mysqli_error($conexao_com_banco));
	
	header("Location:../../../interface/cadastro-despesa.php?sessionId=$num&mensagem=Um novo tipo de despesa foi cadastrada com sucesso!&resultado=sucesso");

}

?>