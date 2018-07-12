
<?php
include('../banco-dados/conectar.php');
session_start();
if(isset($_GET['acao']) && !empty($_GET['acao'])) {
    $acao  = $_GET['acao'];
	switch($acao) {
        case 'Listar' : 
			$offset = 0;
			$max = 10;
			$query = '';
			$status = '';
			$lugar = '';
			$setor = '';
			$situacao = '';
			$cd_servidor = $_SESSION['CPF'];
			if(isset($_GET['offset']) && !empty($_GET['offset'])) {
				$offset = $_GET['offset'];
			}
			if(isset($_GET['max']) && !empty($_GET['max']) && $_GET['max'] < 101) {
				$max = $_GET['max'];
			}
			
			if(isset($_GET['query']) && !empty($_GET['query'])) {
				$query = $_GET['query'];
			}
			
			if(isset($_GET['lugar']) && !empty($_GET['lugar'])) {
				$lugar = $_GET['lugar'];
			}
			
			if(isset($_GET['setor']) && !empty($_GET['setor'])) {
				$setor = $_GET['setor'];
			}
			
			if(isset($_GET['status']) && !empty($_GET['status'])) {
				$status = $_GET['status'];
			}
			
			if(isset($_GET['situacao']) && !empty($_GET['situacao'])) {
				$situacao = $_GET['situacao'];
				if ($situacao == 'aberto') {
					$situacao = 'Aberto';
				} else if ($situacao == 'andamento') {
					$situacao = 'Finalização em andamento';
				} else if ($situacao == 'andamento-atraso') {
					$situacao = 'Finalização em atraso';
				} else if ($situacao == 'finalizado') {
					$situacao = 'Finalizado';
				} else if ($situacao == 'finalizado-atraso') {
					$situacao = 'Finalizado com atraso';
				}
			}
			
			listar_processos($query, $lugar, $setor, $status, $situacao, $max, $offset,$conexao_com_banco);
			break;	
			
		case 'Retornar' : 
			$cd_servidor = $_SESSION['CPF'];
			$cd_processo = 0;
			if(isset($_GET['processo']) && !empty($_GET['processo'])) {
				$cd_processo = $_GET['processo'];
			}
			retornar_processo($cd_processo, $conexao_com_banco);
			break;	
		case 'Listar PDF' : 		
			$query = '';
			$status = '';
			$lugar = '';
			$situacao = '';
			$cd_servidor = $_SESSION['CPF'];	
			$setor = '';			
			if(isset($_GET['query']) && !empty($_GET['query'])) {
				$query = $_GET['query'];
			}
			
			if(isset($_GET['lugar']) && !empty($_GET['lugar'])) {
				$lugar = $_GET['lugar'];
			}
							
			if(isset($_GET['status']) && !empty($_GET['status'])) {
				$status = $_GET['status'];
			}
			
			if(isset($_GET['setor']) && !empty($_GET['setor'])) {
				$setor = $_GET['setor'];
			}
			
			if(isset($_GET['situacao']) && !empty($_GET['situacao'])) {
				$situacao = $_GET['situacao'];
				if ($situacao == 'aberto') {
					$situacao = 'Aberto';
				} else if ($situacao == 'andamento') {
					$situacao = 'Finalização em andamento';
				} else if ($situacao == 'andamento-atraso') {
					$situacao = 'Finalização em atraso';
				} else if ($situacao == 'finalizado') {
					$situacao = 'Finalizado';
				} else if ($situacao == 'finalizado-atraso') {
					$situacao = 'Finalizado com atraso';
				}
			}
			
			listar_processos_pdf($query, $lugar, $setor, $status, $situacao, $conexao_com_banco);
			break;
		case 'Listar Tramitacao':
			$cd_servidor = $_SESSION['CPF'];
			listar_tramitacao($cd_servidor, $conexao_com_banco);
			break;			
		case 'Tramitacao':
			$status = 0;
			if(isset($_GET['status']) && !empty($_GET['status'])) {
					$status = $_GET['status'];
			}
			$cd_tramitacao = -1;
			if(isset($_GET['id_tramitacao']) && !empty($_GET['id_tramitacao'])) {
					$cd_tramitacao = $_GET['id_tramitacao'];
			}
			resolver_tramitacao($cd_tramitacao, $status, $conexao_com_banco);
			break;
    }	
}

function listar_processos($busca_query, $lugar, $setor, $status, $situacao, $max, $offset,$conexao_com_banco) {

	if (!empty($busca_query)) {
		$busca_query = " WHERE (p.CD_PROCESSO LIKE '%$busca_query%' OR p.NM_TIPO LIKE '%$busca_query%' OR NM_STATUS LIKE '%$busca_query%' OR s.CD_SERVIDOR LIKE '%$busca_query%' OR s.NM_SERVIDOR LIKE '%$busca_query%' OR p.DS_PROCESSO LIKE '%$busca_query%' OR s.CD_SETOR LIKE '%$busca_query%')";
	}
	if (empty($busca_query) && !empty($status)) {
		$busca_query = " WHERE NM_STATUS = '$status'";
	} else if (!empty($status)) {
		$busca_query .= " AND NM_STATUS = '$status'";
	}
	
	if (empty($busca_query) && !empty($situacao)) {
		$busca_query = " WHERE NM_SITUACAO_FINAL = '$situacao'";
	} else if (!empty($situacao)) {
		$busca_query .= " AND NM_SITUACAO_FINAL = '$situacao'";
	}

	if (!empty($lugar)) {
		if ($lugar == 'setor' && !empty($setor)) {
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
	$query = "Select p.*, s.NM_SERVIDOR as NM_SERVIDOR_LOCALIZACAO FROM `tb_processos` p LEFT JOIN `tb_servidores` s ON p.CD_SERVIDOR_LOCALIZACAO = s.CD_SERVIDOR $busca_query ORDER BY URGENTE DESC, DT_PRAZO_FINAL ASC LIMIT $max OFFSET $offset ";
	
	$processos = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($processos)){
		if(($_SESSION['permissao-editar-processo']=='sim' and  $linha -> NM_STATUS == 'Ativo' and $linha ->CD_SERVIDOR_LOCALIZACAO==$_SESSION['CPF']) or ($_SESSION['permissao-editar-processo']=='sim' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $linha -> NM_STATUS == 'Ativo' and ($linha ->CD_SETOR_LOCALIZACAO==$_SESSION['setor'] or $linha ->CD_SETOR_LOCALIZACAO==$_SESSION['setor-subordinado'])) or ($_SESSION['permissao-editar-processo']=='sim' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim' and $linha -> NM_STATUS == 'Ativo')){
			$linha -> EDITAR = TRUE;
		} else {
			$linha -> EDITAR = FALSE;			
		}
		
		if(($_SESSION['permissao-excluir-processo']=='sim' and  $linha -> NM_STATUS == 'Ativo' and $linha ->CD_SERVIDOR_LOCALIZACAO==$_SESSION['CPF']) or ($_SESSION['permissao-excluir-processo']=='sim' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $linha -> NM_STATUS == 'Ativo' and ($linha ->CD_SETOR_LOCALIZACAO==$_SESSION['setor'] or $linha ->CD_SETOR_LOCALIZACAO==$_SESSION['setor-subordinado'])) or ($_SESSION['permissao-excluir-processo']=='sim' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim' and $linha -> NM_STATUS == 'Ativo')){
			$linha -> EXCLUIR = TRUE;
		} else {
			$linha -> EXCLUIR = FALSE;			
		}	
		$resultados[] = $linha;
	};
	
	$query_total = "Select count(*) as total_processos FROM `tb_processos` p LEFT JOIN `tb_servidores` s ON p.CD_SERVIDOR_LOCALIZACAO = s.CD_SERVIDOR $busca_query";
	$resultado_total = mysqli_query($conexao_com_banco, $query_total);
	
	$total = mysqli_fetch_array($resultado_total); 
	
	header('total: '.$total['total_processos']);	
	echo json_encode($resultados);
	
	
}

function listar_processos_pdf($busca_query, $lugar, $setor, $status,  $situacao, $conexao_com_banco) {

	if (!empty($busca_query)) {
		$busca_query = " WHERE (p.CD_PROCESSO LIKE '%$busca_query%' OR p.NM_TIPO LIKE '%$busca_query%' OR NM_STATUS LIKE '%$busca_query%' OR s.CD_SERVIDOR LIKE '%$busca_query%' OR s.NM_SERVIDOR LIKE '%$busca_query%' OR p.DS_PROCESSO LIKE '%$busca_query%' OR s.CD_SETOR LIKE '%$busca_query%')";
	}
	if (empty($busca_query) && !empty($status)) {
		$busca_query = " WHERE NM_STATUS = '$status'";
	} else if (!empty($status)) {
		$busca_query .= " AND NM_STATUS = '$status'";
	}
	
	if (empty($busca_query) && !empty($situacao)) {
		$busca_query = " WHERE NM_SITUACAO_FINAL = '$situacao'";
	} else if (!empty($situacao)) {
		$busca_query .= " AND NM_SITUACAO_FINAL = '$situacao'";
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
	$query = "Select p.*, s.NM_SERVIDOR as NM_SERVIDOR_LOCALIZACAO FROM `tb_processos` p LEFT JOIN `tb_servidores` s ON p.CD_SERVIDOR_LOCALIZACAO = s.CD_SERVIDOR $busca_query ORDER BY URGENTE DESC, DT_PRAZO_FINAL ASC";
	$processos = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	//echo $query;
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
	$query = "SELECT t.ID as CD_TRAMITACAO, s.CD_SETOR as SETOR, t.CD_PROCESSO as CD_PROCESSO, t.DT_TRAMITACAO as DT_TRAMITACAO, t.RECEBIDO as RECEBIDO, CONCAT(s.NM_SERVIDOR, ' ', s.SNM_SERVIDOR) as NM_SERVIDOR_ORIGEM FROM `tb_tramitacao_processos` t LEFT JOIN tb_servidores s on s.CD_SERVIDOR = t.CD_SERVIDOR_ORIGEM WHERE t.CD_SERVIDOR_DESTINO = '$cd_servidor' AND t.RECEBIDO = 0";
	$processos = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($processos)){
		$resultados[] = $linha;
	};
	

	echo json_encode($resultados);
}

function resolver_tramitacao($cd_tramitacao, $status, $conexao_com_banco) {
	$retorno = mysqli_query($conexao_com_banco, "UPDATE `tb_tramitacao_processos` SET RECEBIDO = '$status' WHERE ID = '$cd_tramitacao'");
	
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

?>