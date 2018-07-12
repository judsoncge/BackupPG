
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
			
			if(isset($_GET['status']) && !empty($_GET['status'])) {
				$status = $_GET['status'];
			}
			
			listar_documentos($query, $lugar, $status, $max, $offset,$conexao_com_banco);
			break;	
			
		case 'Retornar' : 
			$cd_servidor = $_SESSION['CPF'];
			$cd_processo = 0;
			if(isset($_GET['processo']) && !empty($_GET['processo'])) {
				$cd_processo = $_GET['processo'];
			}
			retornar_documento($cd_processo, $conexao_com_banco);
			break;	
		
    }	
}

function listar_documentos($busca_query, $lugar, $status, $max, $offset,$conexao_com_banco) {

	if (!empty($busca_query)) {
		$busca_query = " WHERE (d.CD_PROCESSO LIKE '%$busca_query%' OR d.NM_DOCUMENTO LIKE '%$busca_query%' OR a.NM_ASSUNTO LIKE '%$busca_query%' OR d.NM_STATUS LIKE '%$busca_query%' OR s.CD_SERVIDOR LIKE '%$busca_query%' OR s.NM_SERVIDOR LIKE '%$busca_query%' OR d.DS_DOCUMENTO LIKE '%$busca_query%' OR d.CD_SETOR_LOCALIZACAO LIKE '%$busca_query%')";
	}
	if (empty($busca_query) && !empty($status)) {
		$busca_query = " WHERE d.NM_STATUS = '$status'";
	} else if (!empty($status)) {
		$busca_query .= " AND d.NM_STATUS = '$status'";
	}

	if (!empty($lugar)) {
		if ($lugar == 'setor') {
			$lugar = ' d.CD_SETOR_LOCALIZACAO IN (SELECT CD_SETOR FROM tb_servidores WHERE CD_SERVIDOR = "'.$_SESSION['CPF'].'") ';
		} else if ($lugar == 'comigo') {		
			$lugar = ' d.CD_SERVIDOR_LOCALIZACAO = "'.$_SESSION['CPF'].'" ';
		}
		if (empty($busca_query)) {
			$busca_query = ' WHERE '.$lugar;
		} else {
			$busca_query .= ' AND '.$lugar;
		}
	}
	$query = "Select d.*, s.NM_SERVIDOR as NM_SERVIDOR_LOCALIZACAO, s2.NM_SERVIDOR as NM_SERVIDOR_CRIACAO FROM `tb_documentos` d LEFT JOIN `tb_servidores` s ON d.CD_SERVIDOR_LOCALIZACAO = s.CD_SERVIDOR LEFT JOIN `tb_servidores` s2 ON d.CD_SERVIDOR_CRIACAO = s2.CD_SERVIDOR LEFT JOIN `tb_assuntos_processos` a  ON d.ID_ASSUNTO = a.ID $busca_query ORDER BY d.DT_CRIACAO DESC LIMIT $max OFFSET $offset";
	//echo $query;
	$atividades = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($atividades)){
		
		 if(($_SESSION['permissao-editar-documento']=='sim' and  $linha -> NM_STATUS == 'Em análise' and $linha ->CD_SERVIDOR_LOCALIZACAO==$_SESSION['CPF']) or ($_SESSION['permissao-editar-documento']=='sim' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $linha -> NM_STATUS == 'Em análise' and ($linha ->CD_SETOR_LOCALIZACAO==$_SESSION['setor'] or $linha ->CD_SETOR_LOCALIZACAO==$_SESSION['setor-subordinado'])) or ($_SESSION['permissao-editar-documento']=='sim' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim' and $linha -> NM_STATUS == 'Em análise')){
			$linha -> EDITAR = TRUE;
		} else {
			$linha -> EDITAR = FALSE;			
		}
		
		if(($_SESSION['permissao-excluir-documento']=='sim' and  $linha -> NM_STATUS == 'Em análise' and $linha ->CD_SERVIDOR_LOCALIZACAO==$_SESSION['CPF']) or ($_SESSION['permissao-excluir-documento']=='sim' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $linha -> NM_STATUS == 'Em análise' and ($linha ->CD_SETOR_LOCALIZACAO==$_SESSION['setor'] or $linha ->CD_SETOR_LOCALIZACAO==$_SESSION['setor-subordinado'])) or ($_SESSION['permissao-excluir-documento']=='sim' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim' and $linha -> NM_STATUS == 'Em análise')){
			$linha -> EXCLUIR = TRUE;
		} else {
			$linha -> EXCLUIR = FALSE;			
		}	
		
		$linha -> NR_PRIORIDADE = arruma_prioridade($linha -> NR_PRIORIDADE);
		
		$resultados[] = $linha;
	};
	
	$query_total = "Select count(*) as total_documentos FROM `tb_documentos` d LEFT JOIN `tb_servidores` s ON d.CD_SERVIDOR_LOCALIZACAO = s.CD_SERVIDOR LEFT JOIN `tb_servidores` s2 ON d.CD_SERVIDOR_CRIACAO = s2.CD_SERVIDOR LEFT JOIN `tb_assuntos_processos` a  ON d.ID_ASSUNTO = a.ID $busca_query";
	//echo $query_total;
	$resultado_total = mysqli_query($conexao_com_banco, $query_total);
	
	$total = mysqli_fetch_array($resultado_total); 

	header('total: '.$total['total_documentos']);	
	echo json_encode($resultados);
	
	
}

function retornar_documento($cd_documento, $conexao_com_banco) {
	$ano = date('Y');
	
	$query = "SELECT * FROM `tb_documentos` WHERE ID = '$cd_documento'";
	$atividades = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($atividades)){
		$resultados[] = $linha;
	};		
	echo json_encode($resultados);
	
}

function arruma_prioridade($prioridade){
	
	$retorno = "";
	
	 if($prioridade == 1){
		$retorno = 'Urgente'; 
	 }else if($prioridade == 2){
		 $retorno = 'Alta'; 
	 }else if($prioridade == 3){
		 $retorno = 'Média'; 
	 }else if($prioridade == 4){
		 $retorno = 'Baixa'; 
	 }
	return $retorno;

}

?>