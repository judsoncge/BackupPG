<?php

//cadastrando no banco de dados
mysqli_query($conexao_com_banco, "INSERT INTO almoxarifado 

(codigo, item, medida) 

 VALUES 

('$novo_codigo', '$novo_item','$novo_medida')") 

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