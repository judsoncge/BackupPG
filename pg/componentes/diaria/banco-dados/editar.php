<?php

mysqli_query($conexao_com_banco, "UPDATE diaria SET Pessoa_CPF_beneficiario='$edita_beneficiario', tipo='$edita_tipo', numero_portaria='$edita_portaria', 
data_publicacao_portaria='$edita_data_portaria', destino='$edita_destino', data_ida='$edita_data_ida' , data_volta='$edita_data_volta',
numero_diarias='$edita_n_diarias', valor='$edita_valor' WHERE id='$id' ") or die (mysqli_error($conexao_com_banco));

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