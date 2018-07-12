<?php


mysqli_query($conexao_com_banco, "UPDATE chamado SET status='$edita_status_chamado', data_fechamento='$edita_data_fechamento' WHERE id='$id_chamado'") 
or die (mysqli_error($conexao_com_banco));

mysqli_query($conexao_com_banco, "INSERT INTO historico_chamado (id, Chamado_numero, mensagem, pessoa, data_mensagem, acao)
VALUES ('$id2','$id_chamado','ENCERROU O CHAMADO', '$pessoa', '$edita_data_fechamento', 'Ação')")
or die (mysqli_error($conexao_com_banco));

 //quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha>=1){       
	echo "<script>history.back();</script>";
	echo "<script>alert('Chamado encerrado. Ele sumirá da sua lista de chamados.')</script>"; 
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Ocorreu algum problema')</script>";
  }



 

?>