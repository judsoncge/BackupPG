<?php

mysqli_query($conexao_com_banco, "UPDATE almoxarifado SET quantidade_atual='$edita_quantidade' WHERE codigo='$edita_codigo' ") or die (mysqli_error($conexao_com_banco));

//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha==1){         
	
	echo "<script>history.back();</script>";
	echo "<script>alert('$edita_acao realizada com sucesso!')</script>"; 
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Selecione pelo menos um campo para editar')</script>";
}


?>