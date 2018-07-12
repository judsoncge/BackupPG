<?php

mysqli_query($conexao_com_banco, "INSERT INTO 
comunicacao 
(id, item, titulo, texto, data_publicacao, status)
 VALUES 
 ('$id', '$novo_item', '$novo_titulo', '$novo_texto', '$novo_data_publicacao', 'Aberta')") 
 or die (mysqli_error($conexao_com_banco));

$linha = mysqli_affected_rows($conexao_com_banco);

if($linha>=1){         
	echo "<script>history.back();</script>"; 
	echo "<script>history.back();</script>";
	echo "<script>alert('Item cadastrado com sucesso!')</script>"; 
	
}   else{	
		echo "<script>history.back();</script>";
		echo "<script>alert('Ocorreu algum problema no cadastro')</script>";
	}

?>