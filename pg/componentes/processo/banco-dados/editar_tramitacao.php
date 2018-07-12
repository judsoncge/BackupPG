<?php

 

mysqli_query($conexao_com_banco, 

"INSERT INTO tramitacao_processo 

(id, Processo_numero, origem, destino, data_tramitacao) 

VALUES

('$id_tramitacao', '$processo', '$origem', '$destino', '$data_tramitacao')")

 or die (mysqli_error($conexao_com_banco));
 


if(isset($_POST['prazo_final']) and isset($_POST['prazo']) and ($_POST['prazo_final'] != $prazo_final_salvo or $_POST['prazo'] != $prazo_salvo)){
	
		mysqli_query($conexao_com_banco, 

		"INSERT INTO historico_processo 

		(id, Processo_numero, mensagem, Pessoa_CPF_responsavel, data_mensagem, acao) 

		VALUES

		
		('$id3', '$processo', 'ATUALIZOU OS PRAZOS', '$origem', '$data_tramitacao', 'Prazo')


		") or die (mysqli_error($conexao_com_banco));
	
		mysqli_query($conexao_com_banco, 

		"UPDATE processo SET 

		status='$setor_destino', estacom='$destino', prazo='$prazo', prazo_final='$prazo_final'

		WHERE numero_processo='$processo'") 

		 or die (mysqli_error($conexao_com_banco));
		 
		
	
}else{
	mysqli_query($conexao_com_banco, 

		"UPDATE processo SET 

		status='$setor_destino', estacom='$destino', prazo='$prazo_salvo', prazo_final='$prazo_final_salvo'

		WHERE numero_processo='$processo'") 

		 or die (mysqli_error($conexao_com_banco));
		 
		  
}


mysqli_query($conexao_com_banco, 

"INSERT INTO historico_processo 

(id, Processo_numero, mensagem, Pessoa_CPF_responsavel, data_mensagem, acao) 

VALUES

('$id', '$processo', '$mensagem', '$origem', '$data_tramitacao', 'Tramitação')


") or die (mysqli_error($conexao_com_banco));



if($resposta!=''){
mysqli_query($conexao_com_banco, 

"INSERT INTO historico_processo 

(id, Processo_numero, mensagem, Pessoa_CPF_responsavel, data_mensagem, acao) 

VALUES

('$id4', '$processo', '$resposta', '$origem', '$data_tramitacao', 'Mensagem')


") or die (mysqli_error($conexao_com_banco));

}


$query = "SELECT * FROM documento WHERE Processo_numero='$processo'";

$resultado = mysqli_query($conexao_com_banco, $query);

if($resultado!=null){
	
		mysqli_query($conexao_com_banco, " UPDATE documento SET estacom='$destino' WHERE Processo_numero='$processo'")
		or die (mysqli_error($conexao_com_banco));
	
	}

 //quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha>=0){         
	
	echo "<script>history.back();</script>";
	echo "<script>history.back();</script>";
	echo "<script>alert('Processo tramitado!')</script>"; 
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Houve algum problema interno!')</script>";
}


?>