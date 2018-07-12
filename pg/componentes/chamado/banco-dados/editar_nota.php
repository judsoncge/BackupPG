<?php


mysqli_query($conexao_com_banco, "UPDATE chamado SET nota='$nota' WHERE id='$id'") 
or die (mysqli_error($conexao_com_banco));

mysqli_query($conexao_com_banco, "INSERT INTO historico_chamado (id, Chamado_numero, mensagem, pessoa, data_mensagem, acao)
VALUES ('$id2','$id','CLASSIFICOU O ATENDIMENTO COMO $nota', '$pessoa', '$data_nota', 'Ação')")
or die (mysqli_error($conexao_com_banco));

 //quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha>=1){       
	echo "<script>history.back();</script>";
	echo "<script>alert('Obrigado por dar sua nota!')</script>"; 
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Ocorreu algum problema')</script>";
  }



 

?>