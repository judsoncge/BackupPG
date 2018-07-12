<?php

//cadastrando no banco de dados
mysqli_query($conexao_com_banco, "INSERT INTO veiculo (id, valor, placa, modelo ,Pessoa_CPF_condutor, 
termo_cessao, chipado, codigo_chip, logomarca, licenciado, ano_fabricacao, locado ,renavam, seguro, recolhido_garagem_noite, observacoes , Pessoa_cadastrou) 
VALUES ('$id','$novo_valor' ,'$novo_placa','$novo_modelo','$novo_condutor', '$novo_termo_cessao','$novo_chipado', '$novo_codigo_chip',
'$novo_logomarca', '$novo_licenciado','$novo_ano_fabricacao', '$novo_locado' ,'$novo_renavam','$novo_seguro','$novo_recolhido_garagem_noite', 
'$novo_observacoes', '$novo_cadastrou')") or die (mysqli_error($conexao_com_banco));
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