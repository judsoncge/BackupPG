<?php

if($_GET['operacao']=='info'){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_comunicacao SET NM_ITEM='$edita_item', NM_TITULO='$edita_titulo', NM_TEXTO='$edita_texto', DT_PUBLICACAO='$edita_data_publicacao' WHERE ID='$id_comunicacao'") 
	or die (mysqli_error($conexao_com_banco));

	header("Location:../../../interface/comunicacao.php?sessionId=$num&mensagem=As informações foram atualizadas com sucesso!&resultado=sucesso");
	
}


else if($_GET['operacao']=='status'){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_comunicacao SET NM_STATUS='$edita_status' WHERE ID='$id_comunicacao'") 
	or die (mysqli_error($conexao_com_banco));

	if($edita_status=='Submetida'){
		header("Location:../../../interface/comunicacao.php?sessionId=$num&mensagem=A notícia está publicada para todos!&resultado=info");
	}else if($edita_status=='Aberta'){
		header("Location:../../../interface/comunicacao.php?sessionId=$num&mensagem=A notícia não está publicada&resultado=info");
	}else if($edita_status=='Excluída'){
		header("Location:../../../interface/comunicacao.php?sessionId=$num&mensagem=A notícia foi ocultada mas está gravada no banco de dados!&resultado=info");
	}
}  
	

?>