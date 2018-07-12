<?php

$id = $_GET['avaliacao'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM indice_produtividade WHERE id='$id'");

while($result = mysqli_fetch_array($retornoquery)){
	$id = $result['id'];
	$servidor_avaliado = $result['servidor_avaliado'];
	$ass1 = $result['ass1'];
	$ass2 = $result['ass2'];
	$ass_result = $result['ass_result'];
	$cum1 = $result['cum1'];
	$cum2 = $result['cum2'];
	$cum_result = $result['cum_result'];
	$leg1 = $result['leg1'];
	$leg2 = $result['leg2'];
	$leg_result = $result['leg_result'];
	$word1 = $result['word1'];
	$word2 = $result['word2'];
	$word_result = $result['word_result'];
	$excel1 = $result['excel1'];
	$excel2 = $result['excel2'];
	$excel_result = $result['excel_result'];
	$power1 = $result['power1'];
	$power2 = $result['power2'];
	$power_result = $result['power_result'];
	$soft_result = $result['soft_result'];
	$soft_cge1 = $result['soft_cge1'];
	$soft_cge2 = $result['soft_cge2'];
	$soft_cge_result = $result['soft_cge_result'];
	$pro1 = $result['pro1'];
	$pro2 = $result['pro2'];
	$pro_result = $result['pro_result'];
	$data = $result['data'];
	$media_final = $result['media_final'];	
	
}

$retornoquery2 = mysqli_query($conexao_com_banco, "SELECT nome, foto, setor FROM pessoa WHERE CPF='$servidor_avaliado'");

while($result2 = mysqli_fetch_array($retornoquery2)){
	
	$servidor_avaliado_nome = $result2['nome'];
	$servidor_avaliado_foto = $result2['foto'];
	$servidor_avaliado_setor = $result2['setor'];
		
}


?>