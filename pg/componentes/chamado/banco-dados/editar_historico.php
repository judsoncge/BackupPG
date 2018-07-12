<?php

if($_GET['operacao']=='Mensagem'){
	
mysqli_query($conexao_com_banco, "INSERT INTO historico_chamado (id, Chamado_numero, mensagem, pessoa, data_mensagem, acao)

VALUES ('$id2','$id','$mensagem', '$pessoa', '$data_mensagem', 'Mensagem')



  ") 
or die (mysqli_error($conexao_com_banco));
 //quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha==1){       
	echo "<script>history.back();</script>";
	echo "<script>alert('Mensagem enviada!')</script>"; 
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Ocorreu algum problema no cadastro')</script>";
  }
}




?>