<?php

mysqli_query($conexao_com_banco, "UPDATE documento SET estacom='$estacom' WHERE id='$id' ") 
or die (mysqli_error($conexao_com_banco));


//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha==1){         
	echo "<script>history.back();</script>";
	echo "<script>history.back();</script>";
	echo "<script>alert('Enviado!')</script>"; 
	mysqli_query($conexao_com_banco, "INSERT INTO historico_documento (id, Documento_id, mensagem, pessoa, data_mensagem, acao)
 VALUES ('$id_historico', '$id', 'ENVIOU O DOCUMENTO PARA $nome', '$pessoa', '$data_mensagem', 'Ação')") or die (mysqli_error($conexao_com_banco));

//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Você não pode enviar para a mesma pessoa')</script>";
}


?>