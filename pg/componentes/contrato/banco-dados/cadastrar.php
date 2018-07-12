<?php

//cadastrando no banco de dados
mysqli_query($conexao_com_banco, "
INSERT INTO contrato 

(id, numero_contrato, contratado, CNPJ_contratado, status_prorrogavel, objeto_contrato, data_inicio_publicacao, data_termino_publicacao, vinculacao, 
numero_contrato_siafem, valor, Pessoa_cadastrou) 

VALUES 

('$id', '$novo_numero_contrato', '$novo_contratado','$novo_cnpj_contratado', '$novo_status_prorrogavel', '$novo_objeto_contrato', 
'$novo_data_inicio_publicacao' ,'$novo_data_termino_publicacao', '$novo_vinculacao', '$novo_numero_contrato_siafem', '$novo_valor' ,'$novo_cadastrou')") 

or die (mysqli_error($conexao_com_banco));
//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha==1){         echo "<script>history.back();</script>"; echo "<script>history.back();</script>";
	echo "<script>alert('Cadastro efetuado com sucesso!')</script>";
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Ocorreu algum problema no cadastro')</script>";
}


?>