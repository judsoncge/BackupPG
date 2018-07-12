<?php

mysqli_query($conexao_com_banco, 

"UPDATE processo SET numero_processo='$numero_processo_ok', descricao='$edita_descricao',
 tipo='$edita_tipo', detalhes='$edita_detalhes', interessado='$edita_interessado'
 WHERE numero_processo='$id'") 

 or die (mysqli_error($conexao_com_banco));
 
//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha==1){         
	echo "<script>history.back();</script>";
	echo "<script>history.back();</script>";
	echo "<script>alert('Processo editado com sucesso!')</script>"; 
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Houve algum problema interno!')</script>";
}


?>