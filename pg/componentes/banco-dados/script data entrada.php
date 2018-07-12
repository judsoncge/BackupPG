<?php
// inclui a conexão
include_once('conectar.php');

$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM processo WHERE data_saida='0000-00-00'"); 
 
while($r = mysqli_fetch_object($resultado)){ 

	$processo = $r->numero_processo;
	
	$resultado2 = mysqli_query($conexao_com_banco, 
	"SELECT data_mensagem FROM historico_processo WHERE mensagem='ARQUIVOU O PROCESSO' and Processo_numero='$processo'") 
	or die (mysqli_error($conexao_com_banco));
	
	echo "SELECT data_mensagem FROM historico_processo WHERE mensagem='ARQUIVOU O PROCESSO' and Processo_numero='$processo'"."<br>";
	
	

}
?>