<?php

if($_GET['operacao']=='receita'){
			
		mysqli_query($conexao_com_banco, "INSERT INTO tb_receitas VALUES ('id','$novo_codigo_receita','$novo_descricao', '$novo_mes', '$novo_ano', '$novo_valor')")  or die (mysqli_error($conexao_com_banco));
		
		$caixa = retorna_caixa_mes_ano($novo_mes, $novo_ano, $conexao_com_banco);
		
		$novo_caixa = $caixa + $novo_valor;
		
		mysqli_query($conexao_com_banco, "UPDATE tb_caixa SET VLR_CAIXA='$novo_caixa' WHERE NR_MES='$novo_mes' AND NR_ANO='$novo_ano'");		
		
		header("Location:../../../interface/fluxo-caixa.php?sessionId=$num&mensagem=A receita foi cadastrada com sucesso!&resultado=sucesso");
	
} else if($_GET['operacao']=='tipo_receita'){

	mysqli_query($conexao_com_banco, "INSERT INTO tb_tipos_receitas VALUES ('$novo_codigo_receita','$novo_nome_receita')")  
	or die (mysqli_error($conexao_com_banco));
	
	header("Location:../../../interface/cadastro-receita.php?sessionId=$num&mensagem=Um novo tipo de receita foi cadastrado com sucesso!&resultado=sucesso");

}

?>