<?php

if($_GET['operacao']=='info'){
	
	mysqli_query($conexao_com_banco, "UPDATE tb_receitas SET CD_RECEITA='$edita_codigo_receita', DS_RECEITA='$descricao_receita', NR_MES='$edita_mes', NR_ANO='$edita_ano', VLR_RECEITA='$edita_valor' WHERE ID='$id' ") 
	or die (mysqli_error($conexao_com_banco));

	$linha = mysqli_affected_rows($conexao_com_banco);
	
	header("Location:../../../interface/receitas.php?sessionId=$num&mensagem=As informacoes foram atualizadas com sucesso!&resultado=sucesso");
	
}

?>