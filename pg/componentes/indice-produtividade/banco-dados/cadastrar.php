<?php

//cadastrando no banco de dados
mysqli_query($conexao_com_banco, 


"INSERT INTO indice_produtividade (id, servidor_avaliado, ass1, ass2, ass_result, cum1, cum2, cum_result, leg1, leg2, leg_result, word1, word2, word_result, excel1, excel2, excel_result, power1, power2, power_result, soft_result, soft_cge1, soft_cge2, soft_cge_result, pro1, pro2, pro_result, data, avaliador, media_final, atualizado_em) 


VALUES 


('$id', '$novo_avaliado', '$novo_ass1', '$novo_ass2', '$novo_ass_result', '$novo_cum1', '$novo_cum2', '$novo_cum_result', '$novo_leg1', '$novo_leg2', '$novo_leg_result', '$novo_word1', '$novo_word2', '$novo_word_result', '$novo_excel1', '$novo_excel2', '$novo_excel_result', '$novo_power1', '$novo_power2', '$novo_power_result', '$novo_soft_result', '$novo_soft_cge1', '$novo_soft_cge2', '$novo_soft_cge_result', '$novo_pro1', '$novo_pro2', '$novo_pro_result', '$novo_data_avaliacao', '$novo_avaliador', '$novo_media_final', '$novo_atualizado_em')") 


or die (mysqli_error($conexao_com_banco));
//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha==1){         
	echo "<script>history.back();</script>"; 
	echo "<script>history.back();</script>";
	echo "<script>alert('Cadastro efetuado com sucesso!')</script>";
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Ocorreu algum problema no cadastro')</script>";
}


?>