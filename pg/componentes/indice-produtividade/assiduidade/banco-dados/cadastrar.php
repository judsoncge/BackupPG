<?php

//cadastrando no banco de dados
mysqli_query($conexao_com_banco, 

"INSERT INTO assiduidade (id, servidor_avaliado, mes_referencia, ano_referencia, horas_esperadas, horas_trabalhadas, horas_abonadas, justificativa)
VALUES 
('$id', '$novo_avaliado', '$novo_mes', '$novo_ano' ,'$novo_esperadas', '$novo_trabalhadas', '$novo_abonadas', '$novo_justificativa')")
or die (mysqli_error($conexao_com_banco));


mysqli_query($conexao_com_banco, 

"INSERT INTO indice_produtividade (id, tipo_avaliacao, mes_referencia, ano_referencia, servidor_avaliado, nota_avaliacao) 
VALUES 
('$id', 'ASSIDUIDADE', '$novo_mes', '$novo_ano' ,'$novo_avaliado', '$novo_nota_avaliacao')")
or die (mysqli_error($conexao_com_banco));

//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha>=1){         
	echo "<script>history.back();</script>"; 
	echo "<script>history.back();</script>";
	echo "<script>alert('Nota: $novo_nota_avaliacao. Calculada e gravada com sucesso!')</script>";
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Ocorreu algum problema no cadastro')</script>";
}


?>