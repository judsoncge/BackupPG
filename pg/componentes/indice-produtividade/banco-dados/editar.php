<?php

mysqli_query($conexao_com_banco, "UPDATE indice_produtividade SET 
	id='$id',
	ass1='$edita_ass1',
	ass2='$edita_ass2',
	ass_result='$edita_ass_result',
	cum1='$edita_cum1',
	cum2='$edita_cum2',
	cum_result='$edita_cum_result',
	leg1='$edita_leg1',
	leg2='$edita_leg2',
	leg_result='$edita_leg_result',
	word1='$edita_word1',
	word2='$edita_word2',
	word_result='$edita_word_result',
	excel1='$edita_excel1',
	excel2='$edita_excel2',
	excel_result='$edita_excel_result',
	power1='$edita_power1',
	power2='$edita_power2',
	power_result='$edita_power_result',
	soft_result='$edita_soft_result',
	soft_cge1='$edita_soft_cge1',
	soft_cge2='$edita_soft_cge2',
	soft_cge_result='$edita_soft_cge_result',
	pro1='$edita_pro1',
	pro2='$edita_pro2',
	pro_result='$edita_pro_result',
	data='$edita_data_avaliacao',
	media_final='$edita_media_final',
	atualizado_em='$edita_atualizado_em'
	
	WHERE id='$id' ") or die (mysqli_error($conexao_com_banco));

//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha==1){         
	echo "<script>history.back();</script>"; echo "<script>history.back();</script>";
	echo "<script>alert('Edição realizada com sucesso!')</script>"; 
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Selecione pelo menos um campo para editar')</script>";
}


?>