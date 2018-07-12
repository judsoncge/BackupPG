<?php

mysqli_query($conexao_com_banco, 

"INSERT INTO despacho (id, numero_processo, texto)

VALUES

('$id2', '$processo', '$despacho')

") or die (mysqli_error($conexao_com_banco));


mysqli_query($conexao_com_banco, 

"INSERT INTO historico_processo (id, Processo_numero,  mensagem, Pessoa_CPF_responsavel, data_mensagem, acao)

VALUES

('$id', '$processo', 'CRIOU UM DESPACHO', '$pessoa' , '$data' ,'Ação')

") or die (mysqli_error($conexao_com_banco));



//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha==1){  
	echo "<script>history.back();</script>";
	echo "<script>alert('Despacho gravado com sucesso!')</script>"; 
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Despacho não gravado.')</script>";
}


?>