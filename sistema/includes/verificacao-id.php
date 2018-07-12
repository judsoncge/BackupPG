<?php

mysqli_query($conexao_com_banco, "SELECT * FROM $tabela WHERE ID='$id'");

if(!mysqli_affected_rows($conexao_com_banco)){
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home.php?mensagem=Registro não encontrado.&resultado=falha'>";	
}
?>

