<?php
//cadastrando no banco de dados
mysqli_query($conexao_com_banco, 

"INSERT INTO processo 

(numero_processo, descricao, detalhes, interessado, data_entrada, mes_entrada, status, estacom, situacao , situacao_final, tipo) 

VALUES

('$novo_processo','$novo_descricao', '$novo_detalhes', '$novo_interessado', '$novo_data_entrada', '$novo_mes_entrada' , '$setor', '$novo_cadastrou' ,'Aberto' ,'Aberto','$novo_tipo')")

 or die (mysqli_error($conexao_com_banco));
 
 mysqli_query($conexao_com_banco, 

"INSERT INTO historico_processo 

(id, Processo_numero, mensagem, Pessoa_CPF_responsavel, data_mensagem, acao) 

VALUES

('$novo_id', '$novo_processo', 'ABRIU O PROCESSO', '$novo_cadastrou', '$data_hora_atual', 'Ação')")

 or die (mysqli_error($conexao_com_banco));
 

if(isset($_GET["documento"])){
	 
	$documento = $_GET["documento"];
		
	mysqli_query($conexao_com_banco, 

	"UPDATE documento SET Processo_numero='$novo_processo' WHERE id='$documento'") or die (mysqli_error($conexao_com_banco));
} 
 
//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha>=1){         
	echo "<script>history.back();</script>"; 
	echo "<script>history.back();</script>";
	echo "<script>alert('Processo $novo_processo criado com sucesso!')</script>";
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Ocorreu algum problema no cadastro')</script>";
}
?>