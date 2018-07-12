<?php
// inclui a conexão
include_once('conectar.php');

include('../../nucleo-aplicacao/retornar_dados.php');

$lista = retorna_documentos_sem_processo($conexao_com_banco);

while($r = mysqli_fetch_object($lista)){
	
	$id = $r->id;
	
	$lista2 = retorna_documento_maior_data($id, $conexao_com_banco);
	
	while($r2 = mysqli_fetch_object($lista2)){
		
		$cpf = $r2->pessoa;
		
		$query = "UPDATE documento SET estacom='".$cpf."' WHERE id='".$id."'";			
	
		$resultado = mysqli_query($conexao_com_banco, $query);
		
		echo "feito para" . $id . "<br>";
	}
		
}	

?>