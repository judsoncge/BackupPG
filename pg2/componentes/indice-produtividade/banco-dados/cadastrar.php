<?php

if($_GET['operacao']=='assiduidade'){
	mysqli_query($conexao_com_banco, 

	"INSERT INTO tb_assiduidade (ID, CD_SERVIDOR, NR_MES, NR_ANO, HR_ESPERADAS, HR_TRABALHADAS, HR_ABONADAS, NM_JUSTIFICATIVA, NR_NOTA)
	VALUES 
	('$id', '$novo_avaliado', '$novo_mes', '$novo_ano' ,'$novo_esperadas', '$novo_trabalhadas', '$novo_abonadas', '$novo_justificativa', '$novo_nota_avaliacao')")
	or die (mysqli_error($conexao_com_banco));
	
	atualiza_nota_geral_servidor($novo_mes, $novo_ano, $novo_avaliado, $conexao_com_banco);	

	header("Location:../../../interface/assiduidades.php?sessionId=$num&mensagem=A assiduidade foi calculada. Nota: $novo_nota_avaliacao!&resultado=sucesso");

	}
?>