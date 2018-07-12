<?php

mysqli_query($conexao_com_banco, "UPDATE comunicacao SET item='$edita_item', titulo='$edita_titulo', texto='$edita_texto', 
data_publicacao='$edita_data_publicacao' WHERE id='$id'") 
or die (mysqli_error($conexao_com_banco));

$linha = mysqli_affected_rows($conexao_com_banco);

if($linha==1 or $_FILES["imagem"] != null){ 
	
	echo "<script>history.back();</script>";echo "<script>history.back();</script>";
	echo "<script>alert('Informações atualizadas!')</script>"; 

}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Ocorreu algum problema')</script>";
  }



 

?>