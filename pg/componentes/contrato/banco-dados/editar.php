<?php

//Editando no banco de dados. Atualizar na tabela contrato coluna = novo valor que estamos passando onde o empenho é o que estamos passando

mysqli_query($conexao_com_banco, 

"UPDATE contrato SET 

valor='$edita_valor', numero_contrato='$edita_numero_contrato', 
contratado='$edita_contratado', CNPJ_contratado='$edita_cnpj_contratado', status_prorrogavel='$edita_status_prorrogavel', 
 objeto_contrato='$edita_objeto_contrato', data_inicio_publicacao='$edita_data_inicio_publicacao',
data_termino_publicacao='$edita_data_termino_publicacao', vinculacao='$edita_vinculacao', numero_contrato_siafem='$edita_numero_contrato_siafem' 

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