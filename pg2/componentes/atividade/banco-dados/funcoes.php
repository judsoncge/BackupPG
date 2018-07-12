<?php
function finalizar_atividade($cd_atividade, $conexao_com_banco) {
	$venceu = false;
	$anexo = false;
	if ($cd_atividade != -1) {
		$atividade = mysqli_query($conexao_com_banco, "Select * FROM tb_atividades WHERE ID='$cd_atividade' ") or die (mysqli_error($conexao_com_banco));
		$atividade = mysqli_fetch_row($atividade);
		if (date('Y-m-d H:i:s') > date($atividade[3])) {
			$venceu = true;
		} else {
			$venceu = false;
		}
		$anexos = mysqli_query($conexao_com_banco, "Select count(*) FROM tb_anexos WHERE CD_REFERENTE='ATIVIDADE_$cd_atividade' ") or die (mysqli_error($conexao_com_banco));
		$anexos = mysqli_fetch_row($anexos);
		if ($anexos[0] > 0) {
			$anexo = true;
		} else {
			$anexo = false;
		}
		$status = '';		
		if ($venceu == false && $anexo == true) {
			$status = 'CONCLUÍDO';
		} else if ($venceu == true && $anexo == true) {
			$status = 'CONCLUÍDO COM ATRASO';
		} else if ($anexo == false) {
			$status = 'FALTA ANEXO';
		}
		$success = mysqli_query($conexao_com_banco, "UPDATE tb_atividades set NM_STATUS = '$status' WHERE ID='$cd_atividade' ") or die (mysqli_error($conexao_com_banco));
		if ($success != false) {
			return $status;
			
		} else {
			return 'Falhou';
		}
	} else {		
		return 'Falhou';
	}
}

?>