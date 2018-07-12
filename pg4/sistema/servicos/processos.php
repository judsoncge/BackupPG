
<?php
include('../banco-dados/conectar.php');
date_default_timezone_set('America/Bahia');
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
			$dt_inicial = '';
			$dt_final = '';
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
			
			if(isset($_GET['dt_inicial']) && !empty($_GET['dt_inicial'])) {
				$dt_inicial = $_GET['dt_inicial'];
			}

			if(isset($_GET['dt_final']) && !empty($_GET['dt_final'])) {
				$dt_final = $_GET['dt_final'];
			}
			
			listar_processos($query, $lugar, $setor, $status, $dt_inicial, $dt_final, $max, $offset,$conexao_com_banco);
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
			$dt_inicial = '';
			$dt_final = '';			
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
			
			if(isset($_GET['dt_inicial']) && !empty($_GET['dt_inicial'])) {
				$dt_inicial = $_GET['dt_inicial'];
			}

			if(isset($_GET['dt_final']) && !empty($_GET['dt_final'])) {
				$dt_final = $_GET['dt_final'];
			}
			
			listar_processos_pdf($query, $lugar, $setor, $status, $dt_inicial, $dt_final, $conexao_com_banco);
			break;
		case 'Listar Tramitacao':
			//$cd_servidor = $_SESSION['CPF'];
			//if ($_SESSION['funcao'] == 'Superintendente') {
			//$cd_servidor = retornar_acessor_tecnico($_SESSION['setor'], $conexao_com_banco);
			// $cd_servidor =  $cd_servidor -> CD_SERVIDOR;
			//}
			listar_tramitacao($_SESSION['setor'], $conexao_com_banco);
			break;	

	case 'Listar Tramitacao Enviada':
			//$cd_servidor = $_SESSION['CPF'];
			//if ($_SESSION['funcao'] == 'Superintendente') {
			// $cd_servidor = retornar_acessor_tecnico($_SESSION['setor'], $conexao_com_banco);
			// $cd_servidor =  $cd_servidor -> CD_SERVIDOR;
			//}
			listar_tramitacao_enviada($_SESSION['setor'], $conexao_com_banco);
			break;				
		case 'Tramitacao':
			$status = 0;
			$cd_servidor = $_SESSION['CPF'];
			if(isset($_GET['status']) && !empty($_GET['status'])) {
					$status = $_GET['status'];
			}
			$cd_tramitacao = -1;
			if(isset($_GET['id_tramitacao']) && !empty($_GET['id_tramitacao'])) {
					$cd_tramitacao = $_GET['id_tramitacao'];
			}
			resolver_tramitacao($cd_tramitacao, $status, $cd_servidor, $conexao_com_banco);
			break;
		case 'Atualizar Acompanhamento':
			atualizar_acompanhamento($conexao_com_banco);
			break;
		case 'Listar Acompanhamento' : 
			$offset = 0;
			$max = 10;
			$query = '';
			$periodo = '';			
			$setor = '';
			$dt_inicial = '';
			$dt_final = '';
			$servidor = '';
			$assunto = '';
			$orgao = '';
			
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
			
			if(isset($_GET['periodo']) && !empty($_GET['periodo'])) {
				$lugar = $_GET['periodo'];
			}
			
			if(isset($_GET['dt_inicial']) && !empty($_GET['dt_inicial'])) {
				$dt_inicial = $_GET['dt_inicial'];
			}

			if(isset($_GET['dt_final']) && !empty($_GET['dt_final'])) {
				$dt_final = $_GET['dt_final'];
			}
			
			if(isset($_GET['servidor']) && !empty($_GET['servidor'])) {
				$servidor = $_GET['servidor'];
			}
			
			if(isset($_GET['assunto']) && !empty($_GET['assunto'])) {
				$assunto = $_GET['assunto'];
			}
			
			if(isset($_GET['setor']) && !empty($_GET['setor'])) {
				$setor = $_GET['setor'];
			}	

			if(isset($_GET['orgao']) && !empty($_GET['orgao'])) {
				$orgao = $_GET['orgao'];
			}			
		
			
			listar_acompanhamentos($query, $periodo, $dt_inicial, $dt_final, $servidor, $assunto, $setor, $orgao, $max, $offset,$conexao_com_banco);
			break;	
			
			case 'Listar Acompanhamento PDF' : 
			$query = '';
			$periodo = '';			
			$setor = '';
			$dt_inicial = '';
			$dt_final = '';
			$servidor = '';
			$assunto = '';
			$orgao = '';
			
			$cd_servidor = $_SESSION['CPF'];
		
			if(isset($_GET['query']) && !empty($_GET['query'])) {
				$query = $_GET['query'];
			}
			
			if(isset($_GET['periodo']) && !empty($_GET['periodo'])) {
				$lugar = $_GET['periodo'];
			}
			
			if(isset($_GET['dt_inicial']) && !empty($_GET['dt_inicial'])) {
				$dt_inicial = $_GET['dt_inicial'];
			}

			if(isset($_GET['dt_final']) && !empty($_GET['dt_final'])) {
				$dt_final = $_GET['dt_final'];
			}
			
			if(isset($_GET['servidor']) && !empty($_GET['servidor'])) {
				$servidor = $_GET['servidor'];
			}
			
			if(isset($_GET['assunto']) && !empty($_GET['assunto'])) {
				$assunto = $_GET['assunto'];
			}
			
			if(isset($_GET['setor']) && !empty($_GET['setor'])) {
				$setor = $_GET['setor'];
			}	

			if(isset($_GET['orgao']) && !empty($_GET['orgao'])) {
				$orgao = $_GET['orgao'];
			}			
		
			
			listar_acompanhamentos_pdf($query, $periodo, $dt_inicial, $dt_final, $servidor, $assunto, $setor, $orgao,$conexao_com_banco);
			break;	
			
			case 'Atualizar Valor Acompanhamento' : 
			$valor = '';			
			$id_acompanhamento = '';
			
			$cd_servidor = $_SESSION['CPF'];
			if(isset($_GET['valor']) && !empty($_GET['valor'])) {
				$valor = $_GET['valor'];
			}		
			
			if(isset($_GET['id']) && !empty($_GET['id'])) {
				$id_acompanhamento = $_GET['id'];
			}		
			
		
			atualizar_valor_acompanhamento($id_acompanhamento, $valor, $conexao_com_banco);		
			break;	
			
    }	
}

function listar_processos($busca_query, $lugar, $setor, $status, $dt_inicial, $dt_final, $max, $offset,$conexao_com_banco) {

	if (!empty($busca_query)) {
		$busca_query = " WHERE (p.CD_PROCESSO LIKE '%$busca_query%' OR NM_STATUS LIKE '%$busca_query%' OR s.CD_SERVIDOR LIKE '%$busca_query%' OR s.NM_SERVIDOR LIKE '%$busca_query%' OR p.ID_ASSUNTO LIKE '%$busca_query%' OR s.CD_SETOR LIKE '%$busca_query%')";
	}
	if (empty($busca_query) && !empty($status)) {
		$busca_query = " WHERE NM_STATUS = '$status'";
	} else if (!empty($status)) {
		$busca_query .= " AND NM_STATUS = '$status'";
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
	
	if (!empty($lugar)) {
		if ($lugar == 'setor' && !empty($setor)) {
			$setores = '(';
			$index = 0;
			foreach ($setor as $value) {
				if ($index != 0) {
					$setores = $setores.',';
				} else {
					$index = 1;
				}
				$setores = $setores.'"'.$value.'"';
			}
			$setores = $setores.')';
			$lugar = ' CD_SETOR_LOCALIZACAO in '.$setores.' ';
		} else if ($lugar == 'setor') {
			$lugar = ' CD_SETOR_LOCALIZACAO IN (SELECT CD_SETOR FROM tb_servidores WHERE CD_SERVIDOR = "'.$_SESSION['CPF'].'") ';
		} else if ($lugar == 'comigo') {		
			$lugar = ' CD_SERVIDOR_LOCALIZACAO = "'.$_SESSION['CPF'].'"';
		}
		if (empty($busca_query)) {
			$busca_query = ' WHERE '.$lugar;
		} else {
			$busca_query .= ' AND '.$lugar;
		}
	}
	$query = "Select p.*, s.NM_SERVIDOR as NM_SERVIDOR_LOCALIZACAO, (SELECT COUNT(*) FROM `tb_processos` p_aux WHERE p_aux.CD_PROCESSO_APENSADO = p.CD_PROCESSO) APENSO_COUNT FROM `tb_processos` p LEFT JOIN `tb_servidores` s ON p.CD_SERVIDOR_LOCALIZACAO = s.CD_SERVIDOR $busca_query ORDER BY NR_URGENCIA DESC, DT_PRAZO ASC LIMIT $max OFFSET $offset ";
	//echo $query;
	$processos = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($processos)){
		if(($_SESSION['permissao-editar-processo']=='sim' and  $linha -> NM_STATUS != 'Arquivado' and $linha -> NM_STATUS != 'Saiu' and $linha ->CD_SERVIDOR_LOCALIZACAO==$_SESSION['CPF']) or ($_SESSION['permissao-editar-processo']=='sim' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $linha -> NM_STATUS != 'Arquivado' and $linha -> NM_STATUS != 'Saiu' and ($linha ->CD_SETOR_LOCALIZACAO==$_SESSION['setor'] or $linha ->CD_SETOR_LOCALIZACAO==$_SESSION['setor-subordinado'])) or ($_SESSION['permissao-editar-processo']=='sim' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim' and $linha -> NM_STATUS != 'Arquivado' and $linha -> NM_STATUS != 'Saiu')){
			$linha -> EDITAR = TRUE;
		} else {
			$linha -> EDITAR = FALSE;			
		}
		
		if(($_SESSION['permissao-excluir-processo']=='sim' and  $linha -> NM_STATUS != 'Arquivado' and $linha -> NM_STATUS != 'Saiu' and $linha ->CD_SERVIDOR_LOCALIZACAO==$_SESSION['CPF']) or ($_SESSION['permissao-excluir-processo']=='sim' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $linha -> NM_STATUS == 'Ativo' and ($linha ->CD_SETOR_LOCALIZACAO==$_SESSION['setor'] or $linha ->CD_SETOR_LOCALIZACAO==$_SESSION['setor-subordinado'])) or ($_SESSION['permissao-excluir-processo']=='sim' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim' and $linha -> NM_STATUS != 'Arquivado' and $linha -> NM_STATUS != 'Saiu')){
			$linha -> EXCLUIR = TRUE;
		} else {
			$linha -> EXCLUIR = FALSE;			
		}	
		
		if($linha -> CD_SERVIDOR_LOCALIZACAO == $_SESSION['CPF'] and  $linha -> NM_STATUS != 'Arquivado' and $linha -> NM_STATUS != 'Saiu' AND $linha -> CD_PROCESSO_APENSADO==''){
			$linha -> AUTOTRAMITE = TRUE;
		}else{
			$linha -> AUTOTRAMITE = FALSE;
		}
		
		if($linha -> NM_STATUS == 'Atrasado'){
			$linha -> ATRASADO = TRUE;
		}else{
			$linha -> ATRASADO = FALSE;
		}
		
		if($linha -> AUTOTRAMITE == TRUE){
			$resultado = retorna_proximo_fluxo_processo($_SESSION['funcao'], $linha -> NM_STATUS, $linha -> CD_PROCESSO, $conexao_com_banco);
			if ($resultado) {
				$linha -> PROXIMOFLUXO = $resultado;
			} else {
				$linha -> AUTOTRAMITE = FALSE;
			}
			
		}
		
		$resultados[] = $linha;
	};
	
	$query_total = "Select count(*) as total_processos FROM `tb_processos` p LEFT JOIN `tb_servidores` s ON p.CD_SERVIDOR_LOCALIZACAO = s.CD_SERVIDOR $busca_query";
	$resultado_total = mysqli_query($conexao_com_banco, $query_total);
	
	$total = mysqli_fetch_array($resultado_total); 
	
	header('total: '.$total['total_processos']);	
	echo json_encode($resultados);
	
	
}

function listar_processos_pdf($busca_query, $lugar, $setor, $status, $dt_inicial, $dt_final, $conexao_com_banco) {

	if (!empty($busca_query)) {
		$busca_query = " WHERE (p.CD_PROCESSO LIKE '%$busca_query%' OR NM_STATUS LIKE '%$busca_query%' OR s.CD_SERVIDOR LIKE '%$busca_query%' OR s.NM_SERVIDOR LIKE '%$busca_query%' OR p.ID_ASSUNTO LIKE '%$busca_query%' OR s.CD_SETOR LIKE '%$busca_query%')";
	}
	if (empty($busca_query) && !empty($status)) {
		$busca_query = " WHERE NM_STATUS = '$status'";
	} else if (!empty($status)) {
		$busca_query .= " AND NM_STATUS = '$status'";
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

	if (!empty($lugar)) {
		if ($lugar == 'setor' && !empty($setor)) {
			$setores = '(';
			$index = 0;
			foreach ($setor as $value) {
				if ($index != 0) {
					$setores = $setores.',';
				} else {
					$index = 1;
				}
				$setores = $setores.'"'.$value.'"';
			}
			$setores = $setores.')';
			$lugar = ' CD_SETOR_LOCALIZACAO in '.$setores.' ';
		} else if ($lugar == 'setor') {
			$lugar = ' CD_SETOR_LOCALIZACAO IN (SELECT CD_SETOR FROM tb_servidores WHERE CD_SERVIDOR = "'.$_SESSION['CPF'].'") ';
		} else if ($lugar == 'comigo') {		
			$lugar = ' CD_SERVIDOR_LOCALIZACAO = "'.$_SESSION['CPF'].'"';
			
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

function listar_tramitacao($cd_setor, $conexao_com_banco) {
	$setor = str_replace('SUP-','',$cd_setor);
	$query = "SELECT p.NR_URGENCIA, a.NM_ASSUNTO , t.ID as CD_TRAMITACAO, s.CD_SETOR as SETOR, t.CD_PROCESSO as CD_PROCESSO, t.DT_TRAMITACAO as DT_TRAMITACAO, t.RECEBIDO as RECEBIDO, CONCAT(s.NM_SERVIDOR, ' ', s.SNM_SERVIDOR) as NM_SERVIDOR_ORIGEM, p.CD_PROCESSO_APENSADO as CD_APENSADO FROM `tb_tramitacao_processos` t LEFT JOIN tb_servidores s on s.CD_SERVIDOR = t.CD_SERVIDOR_ORIGEM LEFT JOIN `tb_processos` p on t.CD_PROCESSO = p.CD_PROCESSO LEFT JOIN `tb_assuntos_processos` a ON p.ID_ASSUNTO = a.ID  WHERE t.CD_SERVIDOR_DESTINO IN (SELECT CD_SERVIDOR FROM tb_servidores WHERE CD_SETOR = 'SUP-$setor' OR CD_SETOR = '$setor') AND t.RECEBIDO = 0 GROUP BY p.CD_PROCESSO ORDER BY t.ID DESC";
	$processos = mysqli_query($conexao_com_banco, $query) or die (mysqli_error($conexao_com_banco));;
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($processos)){
		$resultados[] = $linha;
	};
	

	echo json_encode($resultados);
}

function listar_tramitacao_enviada($cd_setor, $conexao_com_banco) {
	$setor = str_replace('SUP-','',$cd_setor);
	$query = "SELECT p.NR_URGENCIA, a.NM_ASSUNTO , t.ID as CD_TRAMITACAO, s.CD_SETOR as SETOR, t.CD_PROCESSO as CD_PROCESSO, t.DT_TRAMITACAO as DT_TRAMITACAO, t.RECEBIDO as RECEBIDO, CONCAT(s.NM_SERVIDOR, ' ', s.SNM_SERVIDOR) as NM_SERVIDOR_DESTINO , p.CD_PROCESSO_APENSADO as CD_APENSADO FROM `tb_tramitacao_processos` t LEFT JOIN tb_servidores s on s.CD_SERVIDOR = t.CD_SERVIDOR_DESTINO LEFT JOIN `tb_processos` p on t.CD_PROCESSO = p.CD_PROCESSO LEFT JOIN `tb_assuntos_processos` a ON p.ID_ASSUNTO = a.ID  WHERE t.CD_SERVIDOR_ORIGEM IN (SELECT CD_SERVIDOR FROM tb_servidores WHERE CD_SETOR = 'SUP-$setor' OR CD_SETOR = '$setor') AND t.RECEBIDO = 0 GROUP BY p.CD_PROCESSO ORDER BY t.ID DESC";
	$processos = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($processos)){
		$resultados[] = $linha;
	};
	

	echo json_encode($resultados);
}

function resolver_tramitacao($cd_tramitacao, $status, $cd_servidor ,$conexao_com_banco) {
	$data_confirmacao = date('Y-m-d H:i:s'); 
	$query = "SELECT * FROM `tb_tramitacao_processos` t WHERE t.ID = '$cd_tramitacao'";	
	$tramitacao = mysqli_fetch_object(mysqli_query($conexao_com_banco, $query));		
	$retorno = mysqli_query($conexao_com_banco, "UPDATE `tb_tramitacao_processos` SET RECEBIDO = '$status', DT_CONFIRMACAO = '$data_confirmacao', CD_SERVIDOR_CONFIRMOU = '$cd_servidor' WHERE CD_PROCESSO = '".$tramitacao->CD_PROCESSO."' AND CD_SERVIDOR_DESTINO = '".$tramitacao->CD_SERVIDOR_DESTINO."'");
	
	$status_retorno = new stdClass;
	if (!$retorno) {
		$status_retorno -> status = 'Falhou';
	} else {			
		resolver_tramitacao_unica($tramitacao, $cd_servidor, $status, $conexao_com_banco);		
		$query = "SELECT * FROM tb_processos WHERE CD_PROCESSO_APENSADO='".$tramitacao -> CD_PROCESSO."'";
		//echo $query;
		$resultado = mysqli_query($conexao_com_banco, $query);
		while($r = mysqli_fetch_object($resultado)){
			$query = "SELECT * FROM `tb_tramitacao_processos` t WHERE t.CD_SERVIDOR_DESTINO = '".$tramitacao -> CD_SERVIDOR_DESTINO."' AND t.CD_SERVIDOR_ORIGEM = '".$tramitacao -> CD_SERVIDOR_ORIGEM."' AND t.CD_PROCESSO = '".$r -> CD_PROCESSO."' AND RECEBIDO = 0 GROUP BY t.CD_PROCESSO";
			//echo $query; 			
			$atividades = mysqli_query($conexao_com_banco, $query);
			while($tramitacao = mysqli_fetch_object($atividades)){
				resolver_tramitacao_unica($tramitacao, $cd_servidor, $status, $conexao_com_banco);
			}
			
		}		
			
		$status_retorno -> status = 'Ok';
	}
	echo json_encode($status_retorno);
}

function resolver_tramitacao_unica($tramitacao, $cd_servidor, $status, $conexao_com_banco) {
	$data_confirmacao = date('Y-m-d H:i:s'); 
	mysqli_query($conexao_com_banco, "UPDATE `tb_tramitacao_processos` SET RECEBIDO = '$status', DT_CONFIRMACAO = '$data_confirmacao', CD_SERVIDOR_CONFIRMOU = '$cd_servidor' WHERE ID = '".$tramitacao -> ID."'");
	if ($status == 1) {
						
		if ($cd_servidor != $tramitacao -> CD_SERVIDOR_DESTINO) {
			tramitar($tramitacao -> ID, $cd_servidor, $conexao_com_banco);				
		}
		registrar_planilha($tramitacao -> CD_SERVIDOR_ORIGEM, $tramitacao -> CD_SERVIDOR_DESTINO, $tramitacao -> CD_PROCESSO, $data_confirmacao, $conexao_com_banco);
		
		$data_hora_atual = date('Y-m-d H:i:s'); 

		mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_processos (CD_PROCESSO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('".$tramitacao -> CD_PROCESSO."', 'CONFIRMOU O RECEBIMENTO DO PROCESSO', '$cd_servidor', '$data_hora_atual', 'Confirmar Processo')")
		or die (mysqli_error($conexao_com_banco));
			
			
		
		}
		if ($status == 2) {
			retornar_tramitacao($tramitacao -> ID, $conexao_com_banco);
		}
		if ($status == 3) {
			cancelar_tramitacao($tramitacao -> ID, $conexao_com_banco);
		}
	
}

function retorna_dados_servidor($cpf, $conexao_com_banco) {
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores WHERE CD_SERVIDOR='$cpf'");
	
	$servidor = mysqli_fetch_object($resultado);
	
	return $servidor;
}

function registrar_planilha($servidor_origem, $servidor_destino, $cd_processo, $dt_tramitacao, $conexao_com_banco) {
	$servidor_origem = retorna_dados_servidor($servidor_origem, $conexao_com_banco);
	$servidor_destino = retorna_dados_servidor($servidor_destino, $conexao_com_banco);
	$cd_setor_origem = str_replace('SUP-','',$servidor_origem -> CD_SETOR);
	$cd_setor_destino = str_replace('SUP-','',$servidor_destino -> CD_SETOR);
	if ($cd_setor_destino != $cd_setor_origem && ($cd_setor_destino != 'GAB' && $cd_setor_destino != 'PRO')) {
		cadastrar_entrada_acompanhamento_processo($cd_processo, $cd_setor_destino, $dt_tramitacao, $conexao_com_banco);
		if (($cd_setor_destino != $cd_setor_origem) && ($cd_setor_destino != 'GAB' && $cd_setor_destino != 'PRO') && ($cd_setor_origem != 'GAB' && $cd_setor_origem != 'PRO')) {
			notificar_processo_intersetor($conexao_com_banco, $cd_processo, $cd_setor_origem, $cd_setor_destino);
		}
	
	} else if ($cd_setor_destino != $cd_setor_origem) {
		cadastrar_saida_acompanhamento_processo($cd_processo, $cd_setor_origem, $dt_tramitacao, $conexao_com_banco);
	}
}


function cadastrar_entrada_acompanhamento_processo($cd_processo, $cd_setor_destino, $dt_tramitacao, $conexao_com_banco) {
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores WHERE (NM_FUNCAO='Superintendente' OR NM_FUNCAO='Superintendente sem assessor')  AND CD_SETOR='$cd_setor_destino' OR CD_SETOR='SUP-$cd_setor_destino'") or die (mysqli_error($conexao_com_banco));	
	$superintendente = mysqli_fetch_object($resultado);

	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_acompanhamento_processo (CD_PROCESSO, CD_SETOR_RESPONSAVEL, CD_SUPERINTENDENTE_RESPONSAVEL, DT_ENTRADA) VALUES ('$cd_processo', '$cd_setor_destino', '".$superintendente -> CD_SERVIDOR."', '$dt_tramitacao')") 
	or die (mysqli_error($conexao_com_banco));
	
}

function cadastrar_saida_acompanhamento_processo($cd_processo, $cd_setor_origem, $dt_tramitacao, $conexao_com_banco) {

	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_acompanhamento_processo WHERE CD_PROCESSO='$cd_processo' AND CD_SETOR_RESPONSAVEL='$cd_setor_origem' AND (DT_SAIDA IS NULL OR DT_SAIDA ='0000-00-00 00:00:00
' OR DT_SAIDA ='')") or die (mysqli_error($conexao_com_banco));
	
	$acompanhamento = mysqli_fetch_object($resultado);
	
	if (!is_null ($acompanhamento) && array_key_exists('ID',$acompanhamento)) {
			
		$acompanhamento -> DT_SAIDA = $dt_tramitacao;
		mysqli_query($conexao_com_banco, "UPDATE `tb_acompanhamento_processo` SET DT_SAIDA = '".$acompanhamento -> DT_SAIDA."' WHERE ID = '".$acompanhamento -> ID."'") 
	or die (mysqli_error($conexao_com_banco));
	
}
}

function tramitar($cd_tramitacao, $cd_servidor_destino, $conexao_com_banco) {
	$servidor_destino =  retornar_servidor($cd_servidor_destino, $conexao_com_banco);
	$query = "SELECT t.ID as CD_TRAMITACAO, s.CD_SETOR as SETOR, t.CD_PROCESSO as CD_PROCESSO, t.CD_SERVIDOR_ORIGEM, t.RECEBIDO as RECEBIDO, CONCAT(s.NM_SERVIDOR, ' ', s.SNM_SERVIDOR) as NM_SERVIDOR_ORIGEM FROM `tb_tramitacao_processos` t LEFT JOIN tb_servidores s on s.CD_SERVIDOR = t.CD_SERVIDOR_ORIGEM WHERE t.ID = '$cd_tramitacao'";
	$atividades = mysqli_query($conexao_com_banco, $query);
	
	
	$tramitacao = mysqli_fetch_object($atividades);
	$cd_setor_destino = $servidor_destino -> CD_SETOR;
	$cd_servidor_destino = $servidor_destino -> CD_SERVIDOR;
	$nm_servidor_destino =  strtoupper($servidor_destino -> NM_SERVIDOR_COMPLETO);
	$cd_processo = $tramitacao -> CD_PROCESSO;
	$cd_servidor_origem = $tramitacao -> CD_SERVIDOR_ORIGEM;
	$mensagem =	'TRAMITOU PARA SI'; 
	tramitar_processo($cd_processo, $cd_servidor_origem, $cd_servidor_destino, $cd_setor_destino, $mensagem, $conexao_com_banco);	
	
	
}

function tramitar_processo($cd_processo, $cd_servidor_origem, $cd_servidor_destino, $cd_setor_destino, $mensagem, $conexao_com_banco) {
	mysqli_query($conexao_com_banco, "UPDATE tb_processos SET CD_SETOR_LOCALIZACAO='$cd_setor_destino', CD_SERVIDOR_LOCALIZACAO='$cd_servidor_destino' WHERE CD_PROCESSO='$cd_processo'") 
    or die (mysqli_error($conexao_com_banco));
	
	$data_tramitacao = date('Y-m-d H:i:s'); 
	
	mysqli_query($conexao_com_banco, "INSERT INTO tb_tramitacao_processos (CD_PROCESSO, CD_SERVIDOR_ORIGEM, CD_SERVIDOR_DESTINO, DT_TRAMITACAO, RECEBIDO) VALUES ('$cd_processo', '$cd_servidor_origem', '$cd_servidor_destino', '$data_tramitacao', 1)")
	or die (mysqli_error($conexao_com_banco));
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE CD_PROCESSO='$cd_processo'");
	if(mysqli_num_rows($resultado) > 0){
		
		mysqli_query($conexao_com_banco, "UPDATE tb_documentos SET CD_SERVIDOR_LOCALIZACAO='$cd_servidor_destino', CD_SETOR_LOCALIZACAO='$cd_setor_destino' WHERE CD_PROCESSO='$cd_processo'") or die (mysqli_error($conexao_com_banco));
	
		
	}	
	
	$data_hora_atual = date('Y-m-d H:i:s'); 
	$acao = 'Retornar Processo';
	if ($mensagem == 'TRAMITOU PARA SI') {
		$acao = 'Tramitação';
	}
	mysqli_query($conexao_com_banco, "INSERT INTO tb_historico_processos (CD_PROCESSO, NM_MENSAGEM, CD_SERVIDOR, DT_MENSAGEM, NM_ACAO) VALUES ('$cd_processo', '$mensagem', '$cd_servidor_destino', '$data_hora_atual', '$acao')")
	or die (mysqli_error($conexao_com_banco));
	$query = "SELECT * FROM tb_processos WHERE CD_PROCESSO_APENSADO='$cd_processo'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	while($r = mysqli_fetch_object($resultado)){
		tramitar_processo($r->CD_PROCESSO, $cd_servidor_origem, $cd_servidor_destino, $cd_setor_destino, $mensagem, $conexao_com_banco);
		
	}
	
}

function retornar_tramitacao($cd_tramitacao, $conexao_com_banco) {
	
	$query = "SELECT t.ID as CD_TRAMITACAO, s.CD_SETOR as SETOR_DESTINO, s2.CD_SETOR as SETOR_ORIGEM, t.CD_PROCESSO as CD_PROCESSO, t.CD_SERVIDOR_ORIGEM as CD_SERVIDOR_DESTINO, t.CD_SERVIDOR_DESTINO as CD_SERVIDOR_ORIGEM, t.RECEBIDO as RECEBIDO, CONCAT(s.NM_SERVIDOR, ' ', s.SNM_SERVIDOR) as NM_SERVIDOR_DESTINO FROM `tb_tramitacao_processos` t LEFT JOIN tb_servidores s on s.CD_SERVIDOR = t.CD_SERVIDOR_ORIGEM LEFT JOIN tb_servidores s2 ON t.CD_SERVIDOR_DESTINO = s2.CD_SERVIDOR WHERE t.ID = '$cd_tramitacao'";
	$atividades = mysqli_query($conexao_com_banco, $query);
	
	
	$tramitacao = mysqli_fetch_object($atividades);
	$cd_setor_destino = $tramitacao -> SETOR_DESTINO;
	$cd_setor_origem = $tramitacao -> SETOR_ORIGEM;
	$cd_servidor_destino = $tramitacao -> CD_SERVIDOR_DESTINO;
	$nm_servidor_destino =  strtoupper($tramitacao -> NM_SERVIDOR_DESTINO);
	$cd_processo = $tramitacao -> CD_PROCESSO;
	$cd_servidor_origem = $tramitacao -> CD_SERVIDOR_ORIGEM;

	
	$mensagem = 'DEVOLVEU O PROCESSO PARA '.$nm_servidor_destino;
	tramitar_processo($cd_processo, $cd_servidor_origem, $cd_servidor_destino, $cd_setor_destino, $mensagem, $conexao_com_banco);	
	
	
}

function cancelar_tramitacao($cd_tramitacao, $conexao_com_banco) {
	
	$query = "SELECT t.ID as CD_TRAMITACAO, s.CD_SETOR as SETOR_DESTINO, s2.CD_SETOR as SETOR_ORIGEM, t.CD_PROCESSO as CD_PROCESSO, t.CD_SERVIDOR_ORIGEM as CD_SERVIDOR_DESTINO, t.CD_SERVIDOR_DESTINO as CD_SERVIDOR_ORIGEM, t.RECEBIDO as RECEBIDO, CONCAT(s.NM_SERVIDOR, ' ', s.SNM_SERVIDOR) as NM_SERVIDOR_DESTINO FROM `tb_tramitacao_processos` t LEFT JOIN tb_servidores s on s.CD_SERVIDOR = t.CD_SERVIDOR_ORIGEM LEFT JOIN tb_servidores s2 ON t.CD_SERVIDOR_DESTINO = s2.CD_SERVIDOR WHERE t.ID = '$cd_tramitacao'";
	$atividades = mysqli_query($conexao_com_banco, $query);
	
	
	$tramitacao = mysqli_fetch_object($atividades);
	$cd_setor_destino = $tramitacao -> SETOR_DESTINO;
	$cd_setor_origem = $tramitacao -> SETOR_ORIGEM;
	$cd_servidor_destino = $tramitacao -> CD_SERVIDOR_DESTINO;
	$nm_servidor_destino =  strtoupper($tramitacao -> NM_SERVIDOR_DESTINO);
	$cd_processo = $tramitacao -> CD_PROCESSO;
	$cd_servidor_origem = $tramitacao -> CD_SERVIDOR_ORIGEM;

	
	$mensagem = 'CANCELOU A TRAMITAÇÃO PARA'.$nm_servidor_destino;
	tramitar_processo($cd_processo, $cd_servidor_origem, $cd_servidor_destino, $cd_setor_destino, $mensagem, $conexao_com_banco);	
	
	
}

function atualizar_acompanhamento($conexao_com_banco) {
	$query = "Select * FROM `tb_servidores` WHERE NM_FUNCAO = 'Superintendente' || NM_FUNCAO = 'Superintendente sem assessor'";
	$superintendentes = mysqli_query($conexao_com_banco, $query);	
	
	while ($linha = mysqli_fetch_object($superintendentes)){	
		mysqli_query($conexao_com_banco, "UPDATE `tb_acompanhamento_processo` tap RIGHT JOIN (SELECT d.acompanhamento ID, CD_PROCESSO, SUM(periodo) dias FROM (SELECT ap.CD_PROCESSO, ap.ID acompanhamento, DATEDIFF((SELECT IF(MIN(DT_TRAMITACAO) IS NULL, CURDATE(), MIN(DT_TRAMITACAO)) DT_SAIDA FROM `tb_tramitacao_processos` p2 WHERE p2.CD_SERVIDOR_ORIGEM = p.CD_SERVIDOR_DESTINO AND p2.ID > p.ID AND p2.CD_PROCESSO = p.CD_PROCESSO AND DATE_FORMAT(p2.DT_TRAMITACAO, '%m-%d-%y') >= DATE_FORMAT(ap.DT_ENTRADA, '%m-%d-%y') AND DATE_FORMAT(p2.DT_TRAMITACAO, '%m-%d-%y') <= DATE_FORMAT(if(ap.DT_SAIDA IS NULL or ap.DT_SAIDA = '0000-00-00 00:00:00', CURDATE(), ap.DT_SAIDA), '%m-%d-%y')), DT_TRAMITACAO) periodo FROM `tb_tramitacao_processos` p RIGHT JOIN `tb_acompanhamento_processo` ap on ap.CD_PROCESSO = p.CD_PROCESSO WHERE CD_SERVIDOR_DESTINO = '".$linha -> CD_SERVIDOR."' AND DATE_FORMAT(p.DT_TRAMITACAO, '%m-%d-%y') = DATE_FORMAT(ap.DT_ENTRADA, '%m-%d-%y') AND DATE_FORMAT(p.DT_TRAMITACAO, '%m-%d-%y') <= DATE_FORMAT(if(ap.DT_SAIDA IS NULL or ap.DT_SAIDA = '0000-00-00 00:00:00', CURDATE(), ap.DT_SAIDA), '%m-%d-%y') AND ap.CD_SETOR_RESPONSAVEL = '".str_replace('SUP-','',$linha -> CD_SETOR)."' AND ap.DT_ENTRADA IS NOT NULL AND ap.DT_ENTRADA <> '0000-00-00 00:00:00') d group by d.acompanhamento) resumo on resumo.ID = tap.ID SET tap.NR_DIAS_SUPERINTENDENTE = resumo.dias")
		or die (mysqli_error($conexao_com_banco));	
	};		
}

function listar_acompanhamentos($busca_query, $periodo, $dt_inicial, $dt_final, $servidor, $assunto, $setor, $orgao, $max, $offset,$conexao_com_banco) {

	if (!empty($busca_query)) {
		$busca_query = " WHERE (p.CD_PROCESSO LIKE '%$busca_query%' OR p2.NM_INTERESSADO LIKE '%$busca_query%')";
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
	
	if (empty($busca_query) && !empty($servidor)) {
		$busca_query = " WHERE p.CD_SERVIDOR_RESPONSAVEL = '$servidor'";
	} else if (!empty($servidor)) {
		$busca_query .= " AND p.CD_SERVIDOR_RESPONSAVEL = '$servidor'";
	}
	
	if (empty($busca_query) && !empty($orgao)) {
		$busca_query = " WHERE p2.ID_ORGAO_INTERESSADO = '$orgao'";
	} else if (!empty($orgao)) {
		$busca_query .= " AND p2.ID_ORGAO_INTERESSADO = '$orgao'";
	}
	
	if (empty($busca_query) && !empty($assunto)) {
		$busca_query = " WHERE p2.ID_ASSUNTO = '$assunto'";
	} else if (!empty($assunto)) {
		$busca_query .= " AND p2.ID_ASSUNTO = '$assunto'";
	}
	
	if (empty($busca_query) && !empty($setor)) {
		$busca_query = " WHERE p.CD_SETOR_RESPONSAVEL = '".str_replace('SUP-','',$setor)."'";
	} else if (!empty($status)) {
		$busca_query .= " AND p.CD_SETOR_RESPONSAVEL = '".str_replace('SUP-','',$setor)."'";
	}

	$query = "Select p.*, p2.NM_INTERESSADO, o.NM_ORGAO, CONCAT(s.NM_SERVIDOR, ' ', s.SNM_SERVIDOR) as NM_SERVIDOR_RESPONSAVEL, NM_ASSUNTO as NM_ASSUNTO , CONCAT(s2.NM_SERVIDOR, ' ', s2.SNM_SERVIDOR) as NM_SUPERINTENDENTE_RESPONSAVEL, p2.NM_STATUS STATUS_PROCESSO,  IF(p.DT_DEVOLUCAO_TECNICO IS NULL OR p.DT_DEVOLUCAO_TECNICO = '0000-00-00 00:00:00' OR p.DT_DEVOLUCAO_TECNICO = '', 0 , (SELECT COUNT(*) FROM `tb_tramitacao_processos` WHERE CD_SERVIDOR_ORIGEM = p.CD_SERVIDOR_RESPONSAVEL AND dt_tramitacao <= if(p.dt_saida = '0000-00-00 00:00:00', CURDATE(), p.dt_saida) AND dt_tramitacao >= p.dt_distribuicao_tecnico)) as QTD_DEVOLUCOES FROM `tb_acompanhamento_processo` p LEFT JOIN `tb_servidores` s ON p.CD_SERVIDOR_RESPONSAVEL = s.CD_SERVIDOR  LEFT JOIN `tb_servidores` s2 on s2.CD_SERVIDOR = p.CD_SUPERINTENDENTE_RESPONSAVEL LEFT JOIN `tb_processos` p2 on p.CD_PROCESSO = p2.CD_PROCESSO LEFT JOIN `tb_assuntos_processos` a ON p2.ID_ASSUNTO = a.ID LEFT JOIN `tb_orgaos` o ON p2.ID_ORGAO_INTERESSADO = o.ID $busca_query LIMIT $max OFFSET $offset ";
	//echo $query;
	$processos = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($processos)){		
		$resultados[] = $linha;
	};
	
	$query_total = "Select count(*) as total_processos FROM `tb_acompanhamento_processo` p LEFT JOIN `tb_servidores` s ON p.CD_SERVIDOR_RESPONSAVEL = s.CD_SERVIDOR  LEFT JOIN `tb_servidores` s2 on s2.CD_SERVIDOR = p.CD_SUPERINTENDENTE_RESPONSAVEL LEFT JOIN `tb_processos` p2 on p.CD_PROCESSO = p2.CD_PROCESSO LEFT JOIN `tb_assuntos_processos` a ON p2.ID_ASSUNTO = a.ID $busca_query";
	$resultado_total = mysqli_query($conexao_com_banco, $query_total);
	
	$total = mysqli_fetch_array($resultado_total); 
	
	header('total: '.$total['total_processos']);	
	echo json_encode($resultados);
	
	
}

function listar_acompanhamentos_pdf($busca_query, $periodo, $dt_inicial, $dt_final, $servidor, $assunto, $setor, $orgao,$conexao_com_banco) {

	if (!empty($busca_query)) {
		$busca_query = " WHERE (p.CD_PROCESSO LIKE '%$busca_query%' OR p2.NM_INTERESSADO LIKE '%$busca_query%')";
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
	
	if (empty($busca_query) && !empty($servidor)) {
		$busca_query = " WHERE p.CD_SERVIDOR_RESPONSAVEL = '$servidor'";
	} else if (!empty($servidor)) {
		$busca_query .= " AND p.CD_SERVIDOR_RESPONSAVEL = '$servidor'";
	}
	
	if (empty($busca_query) && !empty($orgao)) {
		$busca_query = " WHERE p2.ID_ORGAO_INTERESSADO = '$orgao'";
	} else if (!empty($orgao)) {
		$busca_query .= " AND p2.ID_ORGAO_INTERESSADO = '$orgao'";
	}
	
	if (empty($busca_query) && !empty($assunto)) {
		$busca_query = " WHERE p2.ID_ASSUNTO = '$assunto'";
	} else if (!empty($assunto)) {
		$busca_query .= " AND p2.ID_ASSUNTO = '$assunto'";
	}
	
	if (empty($busca_query) && !empty($setor)) {
		$busca_query = " WHERE p.CD_SETOR_RESPONSAVEL = '".str_replace('SUP-','',$setor)."'";
	} else if (!empty($status)) {
		$busca_query .= " AND p.CD_SETOR_RESPONSAVEL = '".str_replace('SUP-','',$setor)."'";
	}

	$query = "Select p.*, p2.NM_INTERESSADO, o.NM_ORGAO, CONCAT(s.NM_SERVIDOR, ' ', s.SNM_SERVIDOR) as NM_SERVIDOR_RESPONSAVEL, NM_ASSUNTO as NM_ASSUNTO , CONCAT(s2.NM_SERVIDOR, ' ', s2.SNM_SERVIDOR) as NM_SUPERINTENDENTE_RESPONSAVEL, p2.NM_STATUS STATUS_PROCESSO, IF(p.DT_DEVOLUCAO_TECNICO IS NULL OR p.DT_DEVOLUCAO_TECNICO = '0000-00-00 00:00:00' OR p.DT_DEVOLUCAO_TECNICO = '', 0 , (SELECT COUNT(*) FROM `tb_tramitacao_processos` WHERE CD_SERVIDOR_ORIGEM = p.CD_SERVIDOR_RESPONSAVEL AND dt_tramitacao <= if(p.dt_saida = '0000-00-00 00:00:00', CURDATE(), p.dt_saida) AND dt_tramitacao >= p.dt_distribuicao_tecnico)) as QTD_DEVOLUCOES  FROM `tb_acompanhamento_processo` p LEFT JOIN `tb_servidores` s ON p.CD_SERVIDOR_RESPONSAVEL = s.CD_SERVIDOR  LEFT JOIN `tb_servidores` s2 on s2.CD_SERVIDOR = p.CD_SUPERINTENDENTE_RESPONSAVEL LEFT JOIN `tb_processos` p2 on p.CD_PROCESSO = p2.CD_PROCESSO LEFT JOIN `tb_assuntos_processos` a ON p2.ID_ASSUNTO = a.ID LEFT JOIN `tb_orgaos` o ON p2.ID_ORGAO_INTERESSADO = o.ID $busca_query";
	//echo $query;
	$processos = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($processos)){		
		$resultados[] = $linha;
	};
		
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

function retornar_acessor_tecnico($setor, $conexao_com_banco) {
	$setor = str_replace('SUP-','',$setor);
	$query = "SELECT * FROM `tb_servidores` WHERE NM_FUNCAO = 'Assessor Técnico Setor' AND (CD_SETOR = '$setor' OR CD_SETOR = 'SUP-$setor')";
	$result = mysqli_query($conexao_com_banco, $query);
	//echo $query;
	
	$acessor = mysqli_fetch_object($result);
	
	return $acessor;
	
}

function retornar_servidor($cd_servidor, $conexao_com_banco) {
	$query = "SELECT *, CONCAT(NM_SERVIDOR, ' ', SNM_SERVIDOR) as NM_SERVIDOR_COMPLETO FROM `tb_servidores` WHERE CD_SERVIDOR = '$cd_servidor'";
	$result = mysqli_query($conexao_com_banco, $query);
	//echo $query;
	
	$servidor = mysqli_fetch_object($result);
	
	return $servidor;
	
}

function retorna_processo_em_tramitacao($processo, $conexao_com_banco) {
	$resultado = mysqli_query($conexao_com_banco, "SELECT MIN(RECEBIDO) AS RECEBIDO FROM `tb_tramitacao_processos` WHERE CD_PROCESSO = '$processo' GROUP BY CD_PROCESSO ORDER BY `ID` DESC");
	
	$processo = mysqli_fetch_object($resultado);
	if ($processo != NULL) {
		return $processo -> RECEBIDO == 0;
	} else {
		return 0;
	}
	
}

function retorna_proximo_fluxo_processo($funcao, $status, $processo, $conexao_com_banco){
	$resultado = '';
	if($funcao == 'Protocolo'){
		
		$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SERVIDOR, NM_SERVIDOR, SNM_SERVIDOR, CD_SETOR, NM_FUNCAO FROM tb_servidores WHERE NM_FUNCAO='Assessor Técnico Gabinete' LIMIT 1");
		
	}else if(($funcao == 'Assessor Técnico Gabinete') and ($status == 'Em andamento' or $status == 'Atrasado')){
		
		$assunto_processo = retorna_assunto_processo($processo, $conexao_com_banco);
		
		$setor_responsavel = retorna_setor_responsavel_assunto_processo($assunto_processo, $conexao_com_banco);
		
		$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SERVIDOR, NM_SERVIDOR, SNM_SERVIDOR, CD_SETOR, NM_FUNCAO FROM tb_servidores WHERE NM_FUNCAO='Assessor Técnico Setor' and CD_SETOR='$setor_responsavel' LIMIT 1");
		
		if(mysqli_affected_rows($conexao_com_banco)==0){
			$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SERVIDOR, NM_SERVIDOR, SNM_SERVIDOR, CD_SETOR, NM_FUNCAO FROM tb_servidores WHERE NM_FUNCAO='Superintendente sem assessor' and CD_SETOR='$setor_responsavel' LIMIT 1");
		}
		
	}else if($funcao == 'Assessor Técnico Gabinete' and ($status == 'Finalizado pelo setor' or $status == 'Finalizado pelo gabinete')){
		
		if($status=='Em andamento' or $status=='Atrasado'){
			$assunto_processo = retorna_assunto_processo($processo, $conexao_com_banco);
		
			$setor_responsavel = retorna_setor_responsavel_assunto_processo($assunto_processo, $conexao_com_banco);
			
			$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SERVIDOR, NM_SERVIDOR, SNM_SERVIDOR, CD_SETOR, NM_FUNCAO FROM tb_servidores WHERE NM_FUNCAO='Assessor Técnico Setor' and CD_SETOR='$setor_responsavel' LIMIT 1");
		
			if(mysqli_affected_rows($conexao_com_banco)==0){
				$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SERVIDOR, NM_SERVIDOR, SNM_SERVIDOR, CD_SETOR, NM_FUNCAO FROM tb_servidores WHERE NM_FUNCAO='Superintendente sem assessor' and CD_SETOR='$setor_responsavel' LIMIT 1");	
			}
		}elseif($status == 'Finalizado pelo setor'){
			return 'Finalize!';
			
		}elseif($status == 'Finalizado pelo gabinete'){
			$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SERVIDOR, NM_SERVIDOR, SNM_SERVIDOR, CD_SETOR, NM_FUNCAO FROM tb_servidores WHERE NM_FUNCAO='Protocolo' ORDER BY RAND() LIMIT 1");
		}
		
		
		
	}else if($funcao == 'Assessor Técnico Setor'){
		
		$lider = retorna_lider_processo($processo, $conexao_com_banco);
		
		if($lider == ''){
			return 'Defina resp.';
		}
		
		if($status == "Em andamento" or $status == "Atrasado"){
			$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SERVIDOR, NM_SERVIDOR, SNM_SERVIDOR, CD_SETOR, NM_FUNCAO FROM tb_servidores WHERE CD_SERVIDOR='$lider'");
		}else{
			$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SERVIDOR, NM_SERVIDOR, SNM_SERVIDOR, CD_SETOR, NM_FUNCAO FROM tb_servidores WHERE NM_FUNCAO='Assessor Técnico Gabinete' LIMIT 1");
		}
	
	}else if($funcao == 'Analisa Processo'){
		
		$setor = $_SESSION['setor'];
		
		$setor_superior = retorna_setor_superior($setor, $conexao_com_banco);
		
		$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SERVIDOR, NM_SERVIDOR, SNM_SERVIDOR, CD_SETOR FROM tb_servidores WHERE NM_FUNCAO='Superintendente' AND CD_SETOR='$setor_superior' LIMIT 1");
		
	}else if($funcao == 'Superintendente'){
		
		$setor = $_SESSION['setor'];
		
		if($status == "Em andamento" or $status == "Atrasado"){
			$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SERVIDOR, NM_SERVIDOR, SNM_SERVIDOR, CD_SETOR FROM tb_servidores WHERE NM_FUNCAO='Assessor Técnico Setor' AND CD_SETOR='$setor' LIMIT 1");
		}else{
			$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SERVIDOR, NM_SERVIDOR, SNM_SERVIDOR, CD_SETOR FROM tb_servidores WHERE NM_FUNCAO='Assessor Técnico Gabinete' LIMIT 1");
		}

	}else if($funcao == 'Superintendente sem assessor'){
		
		if($status=='Em andamento' or $status=='Atrasado'){
			return 'Finalize!';
		}else{
			
			$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SERVIDOR, NM_SERVIDOR, SNM_SERVIDOR, CD_SETOR FROM tb_servidores WHERE NM_FUNCAO='Assessor Técnico Gabinete' LIMIT 1");
		}

	}
	if ($resultado == '') {
		return '';
	}
	$dados_destino = mysqli_fetch_row($resultado);
	
	return $dados_destino[1];

}

function retorna_assunto_processo($processo, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT ID_ASSUNTO FROM tb_processos WHERE CD_PROCESSO='$processo'");
	
	$assunto = mysqli_fetch_row($resultado);
	
	return $assunto[0];

}


function retorna_setor_responsavel_assunto_processo($assunto_processo, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SETOR_RESPONSAVEL FROM tb_assuntos_processos WHERE ID='$assunto_processo'");
	
	$setor = mysqli_fetch_row($resultado);
	
	return $setor[0];
	
}

function retorna_setor_superior($setor, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SETOR FROM tb_setores WHERE CD_SETOR_SUBORDINADO='$setor'");
	
	$setor = mysqli_fetch_row($resultado);
	
	return $setor[0];
	
}


function retorna_lider_processo($processo, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SERVIDOR_RESPONSAVEL_LIDER FROM tb_processos WHERE CD_PROCESSO='$processo'");
	
	$lider = mysqli_fetch_row($resultado);
	
	return $lider[0];
	
}

function notificar_processo_intersetor($conexao_com_banco, $cd_processo, $setor_origem, $setor_destino) {	
	$superintendentes = mysqli_query($conexao_com_banco, "SELECT * FROM `tb_servidores` WHERE (CD_SETOR = '$setor_destino' OR CD_SETOR = 'Sup-$setor_destino' ) AND NM_FUNCAO LIKE 'Superintendente%'");
	
	while ($superintendente = mysqli_fetch_object($superintendentes)){
		criar_notificacao($conexao_com_banco, $superintendente -> CD_SERVIDOR, $setor_origem.' tramitou o processo '.$cd_processo.' para o seu setor.','processos/detalhes.php?processo='.$cd_processo.'&pagina=geral');
	};

}

function criar_notificacao($conexao_com_banco, $responsavel, $mensagem, $link) {
	$data = date('Y-m-d H:i:s');
	mysqli_query($conexao_com_banco, "INSERT INTO notificacao (ID, TX_MENSAGEM, NM_STATUS, CD_SERVIDOR, DT_CRIADO, DT_VISUALIZADO, LINK_NOTIFICACAO) VALUES (NULL, '$mensagem', 'NOVA', '$responsavel', '$data', NULL, '$link')") or die (mysqli_error($conexao_com_banco));
	
}


?>