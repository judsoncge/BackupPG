<?php

//se a operacao foi para autorizar a compra
if($_GET['operacao']=='autorizar'){
	
	//mudando o status para Compra autorizada da compra desejada
	mysqli_query($conexao_com_banco, "UPDATE tb_compras SET DT_PRAZO='$edita_prazo', NM_STATUS='$edita_status_compra' WHERE CD_COMPRA='$id_compra'") 
	or die (mysqli_error($conexao_com_banco));

	//inserindo na tabela de historico compra a informacao de que foi autorizada uma compra, com a pessoa e a hora
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_compras VALUES ('$id_historico_compra','$id_compra','AUTORIZOU A COMPRA', '$pessoa', '$data_hoje', 'Autorização')")
	or die (mysqli_error($conexao_com_banco));

	//voltando para a pagina para o usuario ver as informacoes atualizadas
	echo "<script>history.back()</script>";
	
}else if($_GET['operacao']=='recusar'){
	
	//mudando o status para Compra recusada da compra desejada
	mysqli_query($conexao_com_banco, "UPDATE tb_compras SET NM_STATUS='$edita_status_compra' WHERE CD_COMPRA='$id_compra'") 
	or die (mysqli_error($conexao_com_banco));

	//inserindo na tabela de historico compra a informacao de que foi recusada uma compra, com a pessoa e a hora
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_compras VALUES ('$id_historico_compra','$id_compra','RECUSOU A COMPRA', '$pessoa', '$data_hoje', 'Recusado')")
	or die (mysqli_error($conexao_com_banco));

	//voltando para a pagina para o usuario ver as informacoes atualizadas
	echo "<script>history.back()</script>";
	
}else if($_GET['operacao']=='empenhar'){
	
	//mudando o status para empenhada da compra desejada
	mysqli_query($conexao_com_banco, "UPDATE tb_compras SET ID_DESPESA_COMPRA='$id_despesa',VLR_COMPRA='$valor', NM_STATUS='Empenhada' WHERE CD_COMPRA='$id_compra'") 
	or die (mysqli_error($conexao_com_banco));

	//inserindo na tabela de historico compra a informacao de que foi empenhada uma compra, com a pessoa e a hora
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_compras VALUES ('$id_historico_compra','$id_compra','EMPENHOU A COMPRA', '$pessoa', '$data_hoje', 'Empenho')")
	or die (mysqli_error($conexao_com_banco));
	
	//inserindo na tabela de despesas uma nova despesa que representa a compra
	mysqli_query($conexao_com_banco, "INSERT INTO tb_despesas VALUES ('$id_despesa','$tipo','$descricao', '$mes', '$ano', '$valor', '$prazo', 'Empenhado')")
	or die (mysqli_error($conexao_com_banco));

	//voltando para a pagina para o usuario ver as informacoes atualizadas
	echo "<script>history.back()</script>";
	
}else if($_GET['operacao']=='pagar'){
	
	//mudando o status para empenhada da compra desejada
	mysqli_query($conexao_com_banco, "UPDATE tb_compras SET NM_STATUS='$status' WHERE CD_COMPRA='$id_compra'") 
	or die (mysqli_error($conexao_com_banco));

	//inserindo na tabela de historico compra a informacao de que foi empenhada uma compra, com a pessoa e a hora
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_compras VALUES ('$id_historico_compra','$id_compra','PAGOU A COMPRA', '$pessoa', '$data_hoje', 'Pagamento')")
	or die (mysqli_error($conexao_com_banco));
	
	//atualizando a despesa para paga
	mysqli_query($conexao_com_banco, "UPDATE tb_despesas SET NM_STATUS='Pago' WHERE ID='$id_despesa'")
	or die (mysqli_error($conexao_com_banco));

	//voltando para a pagina para o usuario ver as informacoes atualizadas
	echo "<script>history.back()</script>";
	
}


?>