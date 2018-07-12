<?php
include('../../banco-dados/conectar.php');
include('../banco-dados/funcoes.php');
include('../../funcoes.php');

$novo_id_referente = $_POST['id_referente']; 
$arquivo_anexo = "anexo-".$novo_id_referente;
cadastrar_anexo($conexao_com_banco, $novo_id_referente, $_FILES[$arquivo_anexo], 'ATIVIDADE');
finalizar_atividade($novo_id_referente, $conexao_com_banco);
	


echo "<script>history.back();</script>";

?>