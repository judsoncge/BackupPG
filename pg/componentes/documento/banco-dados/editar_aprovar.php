<?php

mysqli_query($conexao_com_banco, "UPDATE documento SET status='Aprovado' WHERE id='$id' ") 
or die (mysqli_error($conexao_com_banco));

 mysqli_query($conexao_com_banco, "INSERT INTO historico_documento (id, Documento_id, mensagem, pessoa, data_mensagem, acao)
 VALUES ('$id_historico', '$id', 'APROVOU O DOCUMENTO', '$pessoa', '$data_mensagem', 'Aprovação')") or die (mysqli_error($conexao_com_banco));

//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha>=1){         
	echo "<script>history.back();</script>";
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Ocorreu algum problema interno. Consulte o suporte.')</script>";
}


?>