<?php

mysqli_query($conexao_com_banco, "DELETE FROM documento WHERE id='$id' ") or die (mysqli_error($conexao_com_banco));

$linha = mysqli_affected_rows($conexao_com_banco);

if($linha==1){         
	echo "<script>history.back();</script>";
	
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Houve algum problema interno. Consulte o suporte')</script>";
}

?>