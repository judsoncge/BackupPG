<?php

mysqli_query($conexao_com_banco, 

"UPDATE processo SET 

situacao_final='$situacao_final', status='Arquivado', estacom='Ninguém', data_saida='$data_hoje', mes_saida='$mes_saida'

WHERE numero_processo='$processo'") 

 or die (mysqli_error($conexao_com_banco));
 
 
mysqli_query($conexao_com_banco, 

"INSERT INTO historico_processo (id, Processo_numero,  mensagem, Pessoa_CPF_responsavel, data_mensagem, acao)

VALUES

('$id', '$processo', '$mensagem', '$pessoa_arquivou' , '$data_hoje' ,'Ação')

") or die(mysqli_error($conexao_com_banco));

$query = "SELECT * FROM documento WHERE Processo_numero='$processo'";

$resultado = mysqli_query($conexao_com_banco, $query);

if($resultado!=null){
	
		mysqli_query($conexao_com_banco, "UPDATE documento SET estacom='Ninguém', status='Resolvido', data_resolvido='$data_hoje' WHERE Processo_numero='$processo'")
		or die (mysqli_error($conexao_com_banco));
	
	}

//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha>=1){         
	echo "<script>history.back();</script>";
	echo "<script>alert('feito!')</script>"; 
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Houve algum problema interno!')</script>";
}


?>