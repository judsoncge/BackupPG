<?php
// inclui a conexão
include_once('conectar.php');

include('../../nucleo-aplicacao/retornar_dados.php');

$lista = retorna_documentos_sem_processo_mensagem($conexao_com_banco);

while($r = mysqli_fetch_object($lista)){
	
	$id = $r -> Documento_id;
	
	$mensagem_quebrada = explode(" ",$r->mensagem);
	
	$nome_pessoa = $mensagem_quebrada[4];
	
	$cpf_dessa_pessoa = retorna_cpf_parte_nome($nome_pessoa, $conexao_com_banco);
	
	$query = "UPDATE documento SET estacom='".$cpf_dessa_pessoa."' WHERE id='".$id."'";			
	
	$resultado = mysqli_query($conexao_com_banco, $query);
		
	echo "FEITO PARA " .$id;
	
	}
		

?>