<?php

function cadastrar_atividade($conexao_com_banco, $descricao, $dt_vencimento, $cd_servidor) {
	$dt_criado = date('Y-m-d H:i:s');
	$status = 'EM ANDAMENTO';
	if ($dt_criado > $dt_vencimento) {
		$status = 'VENCEU';
	}
	//inserindo o novo chamado no banco de dados
	mysqli_query($conexao_com_banco, "INSERT INTO `tb_atividades` (`CD_ATIVIDADE`, `TX_DESCRICAO`, `DT_CRIADO`, `DT_VENCIMENTO`, `CD_SERVIDOR`, `NM_STATUS`) VALUES (NULL, '$descricao', '$dt_criado', '$dt_vencimento', '$cd_servidor', '$status');") or die (mysqli_error($conexao_com_banco));
	
	return mysqli_insert_id($conexao_com_banco);
}


function finalizar_atividade($cd_atividade, $conexao_com_banco) {
	$venceu = false;
	$anexo = false;
	if ($cd_atividade != -1) {
		$atividade = mysqli_query($conexao_com_banco, "Select * FROM tb_atividades WHERE CD_ATIVIDADE='$cd_atividade' ") or die (mysqli_error($conexao_com_banco));
		$atividade = mysqli_fetch_row($atividade);
		if (date('Y-m-d H:i:s') > date($atividade[3])) {
			$venceu = true;
		} else {
			$venceu = false;
		}
		$anexos = mysqli_query($conexao_com_banco, "Select count(*) FROM tb_anexos_atividade WHERE CD_ATIVIDADE='$cd_atividade' ") or die (mysqli_error($conexao_com_banco));
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
		$success = mysqli_query($conexao_com_banco, "UPDATE tb_atividades set NM_STATUS = '$status' WHERE CD_ATIVIDADE='$cd_atividade' ") or die (mysqli_error($conexao_com_banco));
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