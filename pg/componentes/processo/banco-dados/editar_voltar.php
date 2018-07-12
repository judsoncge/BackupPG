<?php

mysqli_query($conexao_com_banco, 

"UPDATE processo SET 

status='$status', data_saida='0000-00-00', mes_saida='', estacom='$pessoa' , 
prazo='0000-00-00', prazo_final='0000-00-00', situacao='Aberto', situacao_final='Aberto'

WHERE numero_processo='$processo'") 

 or die (mysqli_error($conexao_com_banco));
 
mysqli_query($conexao_com_banco, 

"INSERT INTO historico_processo 

(id, Processo_numero, mensagem, Pessoa_CPF_responsavel, data_mensagem, acao) 

VALUES

('$id', '$processo', '$mensagem', '$pessoa', '$data', 'Ação')")

 or die (mysqli_error($conexao_com_banco));
 
 $query = "SELECT * FROM documento WHERE Processo_numero='$processo'";

$resultado = mysqli_query($conexao_com_banco, $query);

if($resultado!=null){
	
		mysqli_query($conexao_com_banco, "UPDATE documento SET estacom='$pessoa', status='Em análise', data_resolvido='0000-00-00', prazo='0000-00-00'
		WHERE Processo_numero='$processo'")
		or die (mysqli_error($conexao_com_banco));
	
	}


//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha>=0){         
	echo "<script>history.back();</script>";
	echo "<script>alert('Processo colocado de volta no órgão. Acesse > Comigo <!')</script>"; 
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Houve algum problema interno!')</script>";
}


?>