<?php

mysqli_query($conexao_com_banco, "UPDATE passagem_aerea SET numero_processo_integra='$edita_numero_integra', 
Pessoa_CPF_beneficiario='$edita_beneficiario', destino_viagem='$edita_destino', data_ida='$edita_data_ida', horario_ida='$edita_horario_ida', valor_pago_ida='$edita_valor_ida' ,data_volta='$edita_data_volta',
horario_volta='$edita_horario_volta', valor_pago_volta='$edita_valor_volta', finalidade='$edita_finalidade' WHERE id='$id' ") or die (mysqli_error($conexao_com_banco));

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