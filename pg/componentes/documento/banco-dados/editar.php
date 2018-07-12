<?php

mysqli_query($conexao_com_banco, "UPDATE documento SET Processo_numero='$edita_numero_processo', 
tipo_atividade='$edita_tipo_atividade', tipo_documento='$edita_tipo_documento' , interessado='$edita_interessado', data_entrada='$edita_data_entrada', 
prazo='$edita_prazo', prioridade='$edita_prioridade'  WHERE id='$id' ") 
or die (mysqli_error($conexao_com_banco));

//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha==1){         
	echo "<script>history.back();</script>"; echo "<script>history.back();</script>";
	echo "<script>alert('Edição realizada com sucesso!')</script>"; 
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Selecione pelo menos um campo para editar')</script>";
}


?>