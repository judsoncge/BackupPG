<?php

//cadastrando no banco de dados
mysqli_query($conexao_com_banco, "INSERT INTO passagem_aerea (id, numero_processo_integra, Pessoa_CPF_beneficiario,
 data_ida, horario_ida, data_volta, horario_volta, destino_viagem, finalidade, valor_pago_ida, valor_pago_volta , Pessoa_cadastrou) 
VALUES ('$id', '$novo_numero_integra', '$novo_beneficiario','$novo_data_ida','$novo_horario_ida',
'$novo_data_volta','$novo_horario_volta', '$novo_destino' ,'$novo_finalidade', '$novo_valor_ida' , '$novo_valor_volta' , '$novo_cadastrou')") 
or die (mysqli_error($conexao_com_banco));
//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha==1){         echo "<script>history.back();</script>"; echo "<script>history.back();</script>";
	echo "<script>alert('Cadastro efetuado com sucesso!')</script>";
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Ocorreu algum problema no cadastro')</script>";
}


?>