<?php

if($_GET['operacao']='extra'){
	
	mysqli_query($conexao_com_banco, "UPDATE ".$tabela." SET NR_NOTA = '$nova_nota', NR_NOTA_EXTRA = '$extra', NM_JUSTIFICATIVA_EXTRA = '$justificativa' WHERE ID='$id'") or die (mysqli_error($conexao_com_banco));

	atualiza_nota_geral_servidor($mes, $ano, $servidor, $conexao_com_banco);	
	
	if($tabela=='tb_assiduidade'){
		header("Location:../../../interface/assiduidades.php?sessionId=$num&mensagem=A nota extra foi calculada com sucesso!&resultado=sucesso");
	}else if($tabela=='tb_cumprimento_prazo'){
		header("Location:../../../interface/cumprimentos-de-prazo.php?sessionId=$num&mensagem=A nota extra foi calculada com sucesso!&resultado=sucesso");
	}else if($tabela=='tb_produtividade'){
		header("Location:../../../interface/produtividades.php?sessionId=$num&mensagem=A nota extra foi calculada com sucesso!&resultado=sucesso");
	}
}

?>