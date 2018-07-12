<?php

mysqli_query($conexao_com_banco, "UPDATE pessoa SET foto='$edita_foto' 
WHERE CPF='$pessoa' ") or die (mysqli_error($conexao_com_banco));

//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha==1){
	echo "<script>history.back();</script>";
	echo "<script>history.back();</script>";
	echo "<script>alert('Foto alterada com sucesso')</script>"; 
	unlink($atual);
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Ocorreu algum problema!')</script>";
}

?>