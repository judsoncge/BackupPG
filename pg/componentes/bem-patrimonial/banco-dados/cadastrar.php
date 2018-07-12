<?php

//cadastrando no banco de dados
mysqli_query($conexao_com_banco, "INSERT INTO bem_patrimonial (id, numero_patrimonio, setor, descricao, denominacao, 
conservacao, doc_aquisicao, data_aquisicao, valor_aquisicao, tempo_anos, taxa_depreciacao, valor_residual, 
valor_depreciavel, depreciacao_acumulada , valor_liquido,  Pessoa_cadastrou) VALUES 

('$id', '$novo_numero_patrimonio', '$novo_setor', '$novo_descricao' ,'$novo_denominacao','$novo_conservacao',
'$novo_doc_aquisicao', '$novo_data_aquisicao', '$novo_valor_aquisicao', '$novo_tempo_anos' ,'$novo_taxa_depreciacao', '$novo_valor_residual' , 
'$novo_valor_depreciavel', '$novo_depreciacao_acumulada' , '$novo_valor_liquido' ,'$novo_cadastrou')") 

 or die (mysqli_error($conexao_com_banco));

//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha==1){         echo "<script>history.back();</script>"; echo "<script>history.back();</script>";
	echo "<script>alert('Cadastro efetuado com sucesso!')</script>";
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Ocorreu algum problema no cadastro')</script>";
}


?>