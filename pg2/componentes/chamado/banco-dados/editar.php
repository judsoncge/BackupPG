<?php

//se a operacao foi para resolver o chamado
if($_GET['operacao']=='resolver'){
	
	//mudando o status para Resolvido do chamado desejado
	mysqli_query($conexao_com_banco, "UPDATE tb_chamados SET NM_STATUS='$edita_status_chamado', DT_FECHAMENTO='$edita_data_fechamento' WHERE ID='$id_chamado'") 
	or die (mysqli_error($conexao_com_banco));

	//inserindo na tabela de historico chamado a informacao de que foi fechado um chamado, com a pessoa e a hora
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_chamados (ID, CD_CHAMADO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_chamado','$id_chamado','RESOLVEU O CHAMADO', '$pessoa', '$edita_data_fechamento', 'Fechamento')")
	or die (mysqli_error($conexao_com_banco));

	//voltando para a pagina para o usuario ver as informacoes atualizadas
	echo "<script>history.back()</script>";
	
}

//se a operacao foi para encerrar o chamado
else if($_GET['operacao']=='encerrar'){
	
	//mudando o status para Encerrado do chamado desejado	
	mysqli_query($conexao_com_banco, "UPDATE tb_chamados SET NM_STATUS='$edita_status_chamado', DT_ENCERRAMENTO='$edita_data_encerramento' WHERE ID='$id_chamado'") 
	or die (mysqli_error($conexao_com_banco));

	//inserindo na tabela de historico chamado a informacao de que foi encerrado um chamado, com a pessoa e a hora
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_chamados (ID, CD_CHAMADO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_chamado','$id_chamado','ENCERROU O CHAMADO', '$pessoa', '$edita_data_encerramento', 'Encerramento')")
	or die (mysqli_error($conexao_com_banco));

	//voltando para a pagina de chamados informando que o chamado foi encerrado
	header("Location:../../../interface/chamados.php?sessionId=$num&mensagem=O chamado foi encerrado. Seus registros estão no nosso banco de dados&resultado=sucesso");
	
}

//se foi enviada uma mensagem 
else if($_GET['operacao']=='mensagem'){
	
	//inserindo na tabela de historico chamado a mensagem digitada pelo usuario, com a pessoa e a hora
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_chamados(ID, CD_CHAMADO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_chamado','$id_chamado','$mensagem', '$pessoa', '$data_mensagem', 'Mensagem')") 
	or die (mysqli_error($conexao_com_banco));
	
	//voltando para a pagina onde foi digitada a mensagem, com a mensagem gravada
	echo "<script>history.back()</script>";
}

//se o usuario der uma nota para o chamado
else if($_GET['operacao']=='nota'){
	
	//inserindo a nota no chamado correspondente
	mysqli_query($conexao_com_banco, "UPDATE tb_chamados SET NM_NOTA='$nota' WHERE ID='$id_chamado'") 
	or die (mysqli_error($conexao_com_banco));

	//inserindo na tabela de historico chamado a informacao de que foi dada uma nota para o atendimento do chamado, com a pessoa e a hora
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_chamados(ID, CD_CHAMADO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$id_historico_chamado','$id_chamado','DEU UMA NOTA PARA O ATENDIMENTO', '$pessoa', '$data_nota', 'Nota')")
	or die (mysqli_error($conexao_com_banco));

	//voltando para a pagina de chamados informando que a nota foi dada com sucesso
	header("Location:../../../interface/chamados.php?sessionId=$num&mensagem=Sua nota foi computada com sucesso!&resultado=sucesso");

}

?>