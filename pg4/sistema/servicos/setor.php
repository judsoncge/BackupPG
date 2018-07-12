
<?php
include('../banco-dados/conectar.php');
date_default_timezone_set('America/Bahia');
session_start();
if(isset($_GET['acao']) && !empty($_GET['acao'])) {
    $acao  = $_GET['acao'];
	switch($acao) {
        case 'Listar Tecnicos' : 
			$setor = '';
			if(isset($_GET['setor']) && !empty($_GET['setor'])) {
				$setor = $_GET['setor'];
			}
			
			listar_tecnicos($setor, $conexao_com_banco);
			break;	
			
		case 'Listar Assuntos' : 
			$setor = '';
			if(isset($_GET['setor']) && !empty($_GET['setor'])) {
				$setor = $_GET['setor'];
			}
			
			listar_assuntos($setor, $conexao_com_banco);
			break;
			
    }	
}

function listar_tecnicos($setor, $conexao_com_banco) {
	$setor = str_replace('SUP-','',$setor);
	$sup_setor = 'SUP-'.$setor;
	$busca_query = '';
	if (!empty($setor)) {
		$busca_query = " WHERE CD_SETOR = '$setor' OR CD_SETOR = '$sup_setor'";
	}
	$query = "Select *, CONCAT(NM_SERVIDOR, ' ', SNM_SERVIDOR) as NM_SERVIDOR_COMPLETO FROM `tb_servidores` $busca_query ORDER BY NM_SERVIDOR ASC";
	$processos = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($processos)){
		
		$resultados[] = $linha;
	};
	
	
	$total = mysqli_fetch_array($processos); 
	
	header('total: '.$total['total_processos']);	
	echo json_encode($resultados);
	
	
}

function listar_assuntos($setor, $conexao_com_banco) {
	$sup_setor = 'SUP-'.$setor;
	$busca_query = '';
	if (!empty($setor)) {
		$busca_query = " WHERE CD_SETOR_RESPONSAVEL = '$setor' OR CD_SETOR_RESPONSAVEL = '$sup_setor'";
	}
	$query = "Select * FROM `tb_assuntos_processos` $busca_query ORDER BY NM_ASSUNTO ASC";
	//echo $query;
	$processos = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($processos)){
		
		$resultados[] = $linha;
	};	
	$total = mysqli_fetch_array($processos); 
	
	header('total: '.$total['total_processos']);	
	echo json_encode($resultados);
	
	
}

function listar_processos_pdf($busca_query, $lugar, $setor, $status,  $situacao, $conexao_com_banco) {

	if (!empty($busca_query)) {
		$busca_query = " WHERE (p.CD_PROCESSO LIKE '%$busca_query%' OR NM_STATUS LIKE '%$busca_query%' OR s.CD_SERVIDOR LIKE '%$busca_query%' OR s.NM_SERVIDOR LIKE '%$busca_query%' OR p.ID_ASSUNTO LIKE '%$busca_query%' OR s.CD_SETOR LIKE '%$busca_query%')";
	}
	if (empty($busca_query) && !empty($status)) {
		$busca_query = " WHERE NM_STATUS = '$status'";
	} else if (!empty($status)) {
		$busca_query .= " AND NM_STATUS = '$status'";
	}
	
	if (!empty($lugar)) {
		if (!empty($setor) && $lugar == 'setor') {
			$lugar = ' CD_SETOR_LOCALIZACAO = "'.$setor.'" ';
		} else if ($lugar == 'setor') {
			$lugar = ' CD_SETOR_LOCALIZACAO IN (SELECT CD_SETOR FROM tb_servidores WHERE CD_SERVIDOR = "'.$_SESSION['CPF'].'") ';
		} else if ($lugar == 'comigo') {		
			$lugar = ' CD_SERVIDOR_LOCALIZACAO = "'.$_SESSION['CPF'].'" ';
		}
		if (empty($busca_query)) {
			$busca_query = ' WHERE '.$lugar;
		} else {
			$busca_query .= ' AND '.$lugar;
		}
	}
	$query = "Select p.*, s.NM_SERVIDOR as NM_SERVIDOR_LOCALIZACAO FROM `tb_processos` p LEFT JOIN `tb_servidores` s ON p.CD_SERVIDOR_LOCALIZACAO = s.CD_SERVIDOR $busca_query ORDER BY NR_URGENCIA DESC, DT_PRAZO ASC";
	$processos = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($processos)){
		$resultados[] = $linha;
	};
	

	echo json_encode($resultados);
	
	
}

function retornar_processo($cd_processo, $conexao_com_banco) {
	$ano = date('Y');
	
	$query = "SELECT * FROM `tb_processos` WHERE CD_PROCESSO = '$cd_processo'";
	$atividades = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($atividades)){		
		$resultados[] = $linha;
	};		
	echo json_encode($resultados);
	
}

function listar_tramitacao($cd_servidor, $conexao_com_banco) {
	$query = "SELECT p.NR_URGENCIA, p.ID_ASSUNTO , t.ID as CD_TRAMITACAO, s.CD_SETOR as SETOR, t.CD_PROCESSO as CD_PROCESSO, t.DT_TRAMITACAO as DT_TRAMITACAO, t.RECEBIDO as RECEBIDO, CONCAT(s.NM_SERVIDOR, ' ', s.SNM_SERVIDOR) as NM_SERVIDOR_ORIGEM FROM `tb_tramitacao_processos` t LEFT JOIN tb_servidores s on s.CD_SERVIDOR = t.CD_SERVIDOR_ORIGEM LEFT JOIN `tb_processos` p on t.CD_PROCESSO = p.CD_PROCESSO WHERE t.CD_SERVIDOR_DESTINO = '$cd_servidor' AND t.RECEBIDO = 0 ORDER BY p.NR_URGENCIA DESC, p.CD_PROCESSO ASC";
	$processos = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($processos)){
		$resultados[] = $linha;
	};
	

	echo json_encode($resultados);
}

function resolver_tramitacao($cd_tramitacao, $status, $conexao_com_banco) {
	$data_confirmacao = date('Y-m-d H:i:s'); 
	$retorno = mysqli_query($conexao_com_banco, "UPDATE `tb_tramitacao_processos` SET RECEBIDO = '$status', DT_CONFIRMACAO = '$data_confirmacao' WHERE ID = '$cd_tramitacao'");
	
	$status_retorno = new stdClass;
	if (!$retorno) {
		$status_retorno -> status = 'Falhou';
	} else {
		if ($status == 2) {
			retornar_tramitacao($cd_tramitacao, $conexao_com_banco);
		}
		
		$status_retorno -> status = 'Ok';
	}
	echo json_encode($status_retorno);
}

function retornar_tramitacao($cd_tramitacao, $conexao_com_banco) {
	
	$query = "SELECT t.ID as CD_TRAMITACAO, s.CD_SETOR as SETOR, t.CD_PROCESSO as CD_PROCESSO, t.CD_SERVIDOR_ORIGEM as CD_SERVIDOR_DESTINO, t.CD_SERVIDOR_DESTINO as CD_SERVIDOR_ORIGEM, t.RECEBIDO as RECEBIDO, CONCAT(s.NM_SERVIDOR, ' ', s.SNM_SERVIDOR) as NM_SERVIDOR_DESTINO FROM `tb_tramitacao_processos` t LEFT JOIN tb_servidores s on s.CD_SERVIDOR = t.CD_SERVIDOR_ORIGEM WHERE t.ID = '$cd_tramitacao'";
	$atividades = mysqli_query($conexao_com_banco, $query);
	
	
	$tramitacao = mysqli_fetch_object($atividades);
	$cd_setor_destino = $tramitacao -> SETOR;
	$cd_servidor_destino = $tramitacao -> CD_SERVIDOR_DESTINO;
	$nm_servidor_destino =  strtoupper($tramitacao -> NM_SERVIDOR_DESTINO);
	$cd_processo = $tramitacao -> CD_PROCESSO;
	$cd_servidor_origem = $tramitacao -> CD_SERVIDOR_ORIGEM;

	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_SETOR_LOCALIZACAO='$cd_setor_destino', CD_SERVIDOR_LOCALIZACAO='$cd_servidor_destino' WHERE CD_PROCESSO='$cd_processo'") 
    or die (mysqli_error($conexao_com_banco));
	
	$data_tramitacao = date('Y-m-d H:i:s'); 
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_tramitacao_processos (CD_PROCESSO, CD_SERVIDOR_ORIGEM, CD_SERVIDOR_DESTINO, DT_TRAMITACAO) VALUES ('$cd_processo', '$cd_servidor_origem', '$cd_servidor_destino', '$data_tramitacao')")
	or die (mysqli_error($conexao_com_banco));
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE CD_PROCESSO='$cd_processo'");
	if(mysqli_num_rows($resultado) > 0){
		
		mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_SERVIDOR_LOCALIZACAO='$cd_servidor_destino', CD_SETOR_LOCALIZACAO='$cd_setor_destino' WHERE CD_PROCESSO='$cd_processo'") or die (mysqli_error($conexao_com_banco));
	
		
	}	
	
	$data_hora_atual = date('Y-m-d H:i:s'); 
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_processos (CD_PROCESSO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$cd_processo', 'DEVOLVEU O PROCESSO PARA $nm_servidor_destino', '$cd_servidor_origem', '$data_hora_atual', 'Retornar Processo')")
	or die (mysqli_error($conexao_com_banco));
	
}

function atualizar_acompanhamento($conexao_com_banco) {
	$query = "Select * FROM `tb_servidores` WHERE NM_CARGO = 'Superintendente'";
	$superintendentes = mysqli_query($conexao_com_banco, $query);	
	
	while ($linha = mysqli_fetch_object($superintendentes)){	
		mysqli_query($conexao_com_banco, "UPDATE `tb_acompanhamento_processo` tap RIGHT JOIN (SELECT d.acompanhamento ID, CD_PROCESSO, SUM(periodo) dias FROM (SELECT ap.CD_PROCESSO, ap.ID acompanhamento, DATEDIFF((SELECT IF(MIN(DT_TRAMITACAO) IS NULL, CURDATE(), MIN(DT_TRAMITACAO)) DT_SAIDA FROM `tb_tramitacao_processos` p2 WHERE p2.CD_SERVIDOR_ORIGEM = p.CD_SERVIDOR_DESTINO AND p2.ID > p.ID AND p2.CD_PROCESSO = p.CD_PROCESSO AND DATE_FORMAT(p2.DT_TRAMITACAO, '%m-%d-%y') >= DATE_FORMAT(ap.DT_ENTRADA, '%m-%d-%y') AND DATE_FORMAT(p2.DT_TRAMITACAO, '%m-%d-%y') <= DATE_FORMAT(if(ap.DT_SAIDA IS NULL or ap.DT_SAIDA = '0000-00-00 00:00:00', CURDATE(), ap.DT_SAIDA), '%m-%d-%y')), DT_TRAMITACAO) periodo FROM `tb_tramitacao_processos` p RIGHT JOIN `tb_acompanhamento_processo` ap on ap.CD_PROCESSO = p.CD_PROCESSO WHERE CD_SERVIDOR_DESTINO = '".$linha -> CD_SERVIDOR."' AND DATE_FORMAT(p.DT_TRAMITACAO, '%m-%d-%y') = DATE_FORMAT(ap.DT_ENTRADA, '%m-%d-%y') AND DATE_FORMAT(p.DT_TRAMITACAO, '%m-%d-%y') <= DATE_FORMAT(if(ap.DT_SAIDA IS NULL or ap.DT_SAIDA = '0000-00-00 00:00:00', CURDATE(), ap.DT_SAIDA), '%m-%d-%y') AND ap.CD_SETOR_RESPONSAVEL = '".str_replace('SUP-','',$linha -> CD_SETOR)."' AND ap.DT_ENTRADA IS NOT NULL AND ap.DT_ENTRADA <> '0000-00-00 00:00:00') d group by d.acompanhamento) resumo on resumo.ID = tap.ID SET tap.NR_DIAS_SUPERINTENDENTE = resumo.dias")
		or die (mysqli_error($conexao_com_banco));	
	};	
	
}

function listar_acompanhamentos($busca_query, $periodo, $dt_inicial, $dt_final, $setor, $max, $offset,$conexao_com_banco) {

	if (!empty($busca_query)) {
		$busca_query = " WHERE (p.CD_PROCESSO LIKE '%$busca_query%' OR p.NM_INTERESSADO LIKE '%$busca_query%' OR p.ID_ORGAO_INTERESSADO LIKE '%$busca_query%')";
	}
	if (empty($busca_query) && !empty($periodo)) {
		$busca_query = " WHERE p.NR_DIAS_SUPERINTENDENTE '$periodo'";
	} else if (!empty($status)) {
		$busca_query .= " AND p.NR_DIAS_SUERINTENDENTE '$periodo'";
	}
	if (empty($busca_query) && !empty($dt_inicial)) {
		$busca_query = " WHERE p.DT_ENTRADA >= '$dt_inicial'";
	} else if (!empty($dt_inicial)) {
		$busca_query .= " AND p.DT_ENTRADA >= '$dt_inicial'";
	}
	
	if (empty($busca_query) && !empty($dt_final)) {
		$busca_query = " WHERE p.DT_ENTRADA <= '$dt_final'";
	} else if (!empty($dt_final)) {
		$busca_query .= " AND p.DT_ENTRADA <= '$dt_final'";
	}
	
	if (empty($busca_query) && !empty($setor)) {
		$busca_query = " WHERE p.CD_SETOR_RESPONSAVEL = '$setor'";
	} else if (!empty($status)) {
		$busca_query .= " AND p.CD_SETOR_RESPONSAVEL '$setor'";
	}

	$query = "Select p.*, CONCAT(s.NM_SERVIDOR, ' ', s.SNM_SERVIDOR) as NM_SERVIDOR_RESPONSAVEL, NM_ASSUNTO as NM_ASSUNTO , CONCAT(s2.NM_SERVIDOR, ' ', s2.SNM_SERVIDOR) as NM_SUPERINTENDENTE_RESPONSAVEL, p2.NM_STATUS STATUS_PROCESSO, o.NM_ORGAO as NM_ORGAO_INTERESSADO FROM `tb_acompanhamento_processo` p LEFT JOIN `tb_servidores` s ON p.CD_SERVIDOR_RESPONSAVEL = s.CD_SERVIDOR LEFT JOIN `tb_assuntos_processos` a ON p.ID_ASSUNTO = a.ID LEFT JOIN `tb_servidores` s2 on s2.CD_SERVIDOR = p.CD_SUPERINTENDENTE_RESPONSAVEL LEFT JOIN `tb_processos` p2 on p.CD_PROCESSO = p2.CD_PROCESSO LEFT JOIN `tb_orgaos` o ON o.ID = o.ID_ORGAO_INTERESSADO $busca_query LIMIT $max OFFSET $offset ";
	//echo $query;
	$processos = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($processos)){		
		$resultados[] = $linha;
	};
	
	$query_total = "Select count(*) as total_processos FROM `tb_acompanhamento_processo` p LEFT JOIN `tb_servidores` s ON p.CD_SERVIDOR_RESPONSAVEL = s.CD_SERVIDOR $busca_query";
	$resultado_total = mysqli_query($conexao_com_banco, $query_total);
	
	$total = mysqli_fetch_array($resultado_total); 
	
	header('total: '.$total['total_processos']);	
	echo json_encode($resultados);
	
	
}

function atualizar_valor_acompanhamento($id_acompanhamento, $valor, $conexao_com_banco) {
	$retorno = mysqli_query($conexao_com_banco, "UPDATE `tb_acompanhamento_processo` SET VLR_PROCESSO = '$valor' WHERE ID = '$id_acompanhamento'");
	
	$status_retorno = new stdClass;
	if (!$retorno) {
		$status_retorno -> status = 'Falhou';
	} else {		
		$status_retorno -> status = 'Ok';
	}
	echo json_encode($status_retorno);
	
}

?>