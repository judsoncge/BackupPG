<?php

//Editando no banco de dados. Atualizar na tabela contrato coluna = novo valor que estamos passando onde o empenho é o que estamos passando

mysqli_query($conexao_com_banco, 

"UPDATE servico SET 

tipo='$edita_tipo', valor='$edita_valor', credor='$edita_credor'

WHERE id='$id' ") 

or die (mysqli_error($conexao_com_banco));

//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha==1){         echo "<script>history.back();</script>"; echo "<script>history.back();</script>";
	echo "<script>alert('Edição realizada com sucesso!')</script>"; 
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Selecione pelo menos um campo para editar')</script>";
}


?>