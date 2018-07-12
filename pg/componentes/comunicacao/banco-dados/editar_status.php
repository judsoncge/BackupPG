<?php

mysqli_query($conexao_com_banco, "UPDATE comunicacao SET status='$edita_status' WHERE id='$id'") 
or die (mysqli_error($conexao_com_banco));

$linha = mysqli_affected_rows($conexao_com_banco);

if($linha==1){ 
		if($edita_status=='Submetida'){
			echo "<script>history.back();</script>";
			echo "<script>alert('Agora está público!')</script>"; 
		}else{
			echo "<script>history.back();</script>";
			echo "<script>alert('Não está mais público!')</script>"; 
		}
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Ocorreu algum problema')</script>";
  }



 

?>