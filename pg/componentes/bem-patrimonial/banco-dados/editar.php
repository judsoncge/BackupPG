<?php

mysqli_query($conexao_com_banco, "UPDATE bem_patrimonial SET 
 
depreciacao_acumulada='$edita_depreciacao_acumulada', valor_liquido='$edita_valor_liquido', depreciacao_mes = '$edita_depreciacao_mes'

 WHERE id='$id' ") or die (mysqli_error($conexao_com_banco));

//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha==1){         echo "<script>history.back();</script>"; echo "<script>history.back();</script>";
	echo "<script>alert('Depreciado!')</script>"; 
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Selecione pelo menos um campo para editar')</script>";
}


?>