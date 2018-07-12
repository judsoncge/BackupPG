<?php

mysqli_query($conexao_com_banco, "UPDATE veiculo SET valor='$edita_valor', 
placa='$edita_placa', modelo='$edita_modelo' ,Pessoa_CPF_condutor='$edita_condutor', termo_cessao='$edita_termo_cessao', chipado='$edita_chipado', 
codigo_chip='$edita_codigo_chip', logomarca='$edita_logomarca' , licenciado='$edita_licenciado',
ano_fabricacao='$edita_ano_fabricacao' , locado='$edita_locado' ,renavam='$edita_renavam' , seguro='$edita_seguro' ,
recolhido_garagem_noite='$edita_recolhido_garagem_noite', observacoes='$edita_observacoes'  WHERE id='$id' ") 
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