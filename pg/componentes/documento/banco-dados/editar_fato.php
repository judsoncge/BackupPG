<?php

mysqli_query($conexao_com_banco, "UPDATE documento SET descricao_fato='$edita_fato' WHERE id='$id' ") 
or die (mysqli_error($conexao_com_banco));


//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha==1){ 
	echo "<script>history.back();</script>";
	mysqli_query($conexao_com_banco, "INSERT INTO historico_documento (id, Documento_id, mensagem, pessoa, data_mensagem, acao)
	VALUES ('$id_historico', '$id', 'EDITOU O FATO', '$pessoa', '$data_mensagem', 'Edição Fato')") or die (mysqli_error($conexao_com_banco));

//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Você não modificou nada no texto')</script>";
}


?>