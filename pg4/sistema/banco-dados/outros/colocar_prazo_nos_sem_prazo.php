<?php

include("../conectar.php");
include("../../funcoes.php");
include("../../processos/banco-dados/funcoes.php");

$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_processos WHERE DT_PRAZO='0000-00-00'");

while($r = mysqli_fetch_object($resultado)){
	
	$assunto = $r->ID_ASSUNTO;
	
	$entrada = $r->DT_ENTRADA;
	
	$processo = $r->CD_PROCESSO;
	
	$dias_prazo = retorna_dias_prazo_assunto_processo($conexao_com_banco, $assunto);
	
	$novo_prazo = somar_data($entrada, $dias_prazo);	
	
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET DT_PRAZO='$novo_prazo' WHERE CD_PROCESSO='$processo'");
}

?>