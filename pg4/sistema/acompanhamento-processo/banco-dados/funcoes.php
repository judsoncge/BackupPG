<?php

function cadastrar_acompanhamento_processo($conexao_com_banco, $cd_processo, $setor_reponsavel, $superintendente_responsavel, $dt_entrada) {
	mysqli_query($conexao_com_banco, "INSERT INTO tb_acompanhamento_processo (CD_PROCESSO, CD_SETOR_RESPONSAVEL, CD_SUPERINTENDENTE_RESPONSAVEL, DT_ENTRADA) VALUES ('$cd_processo', '$setor_reponsavel', '$superintendente_responsavel', '$dt_entrada')") 
	or die (mysqli_error($conexao_com_banco));
}

function retorna_acompanhamento_processo_aberto($cd_processo, $setor_responsavel, $conexao_com_banco) {
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_acompanhamento_processo WHERE CD_PROCESSO='$cd_processo' AND CD_SETOR_RESPONSAVEL='$setor_responsavel' AND (DT_SAIDA IS NULL OR DT_SAIDA ='0000-00-00 00:00:00
' OR DT_SAIDA ='')") or die (mysqli_error($conexao_com_banco));
	
	$acompanhamento = mysqli_fetch_object($resultado);
	
	return $acompanhamento;
}

function atualizar_acompanhamento_processo($conexao_com_banco, $acompanhamento) {
	
	mysqli_query($conexao_com_banco, "UPDATE `tb_acompanhamento_processo` SET CD_SETOR_RESPONSAVEL = '".$acompanhamento -> CD_SETOR_RESPONSAVEL."', CD_SERVIDOR_RESPONSAVEL = '".$acompanhamento -> CD_SERVIDOR_RESPONSAVEL."', VLR_PROCESSO = '".$acompanhamento -> VLR_PROCESSO."', DT_ENTRADA = '".$acompanhamento -> DT_ENTRADA."', DT_SAIDA = '".$acompanhamento -> DT_SAIDA."', DT_DISTRIBUICAO_TECNICO = '".$acompanhamento -> DT_DISTRIBUICAO_TECNICO."', DT_DEVOLUCAO_TECNICO = '".$acompanhamento -> DT_DEVOLUCAO_TECNICO."', DT_DISTRIBUICAO_SUPERINTENDENTE = '".$acompanhamento -> DT_DISTRIBUICAO_SUPERINTENDENTE."', DT_DEVOLUCAO_SUPERINTENDENTE = '".$acompanhamento -> DT_DEVOLUCAO_SUPERINTENDENTE."' WHERE ID = '".$acompanhamento -> ID."'") 
	or die (mysqli_error($conexao_com_banco));
}

?>