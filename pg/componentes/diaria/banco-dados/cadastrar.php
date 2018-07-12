<?php

//cadastrando no banco de dados
mysqli_query($conexao_com_banco, 


"INSERT INTO diaria (id, numero_portaria, Pessoa_CPF_beneficiario,
data_publicacao_portaria, data_ida, tipo, numero_diarias, destino, data_volta , valor, Pessoa_cadastrou) 


VALUES 


('$id', '$novo_portaria', '$novo_beneficiario','$novo_data_portaria','$novo_data_ida','$novo_tipo',
'$novo_n_diarias', '$novo_destino' ,'$novo_data_volta', '$novo_valor' ,'$novo_cadastrou')") 


or die (mysqli_error($conexao_com_banco));
//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha==1){         
	echo "<script>history.back();</script>"; 
	echo "<script>history.back();</script>";
	echo "<script>alert('Cadastro efetuado com sucesso!')</script>";
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Ocorreu algum problema no cadastro')</script>";
}


?>