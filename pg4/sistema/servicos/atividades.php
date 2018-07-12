
<?php
include('../banco-dados/conectar.php');
date_default_timezone_set('America/Bahia');
session_start();
if(isset($_GET['acao']) && !empty($_GET['acao'])) {
    $acao  = $_GET['acao'];
	switch($acao) {
        case 'Listar' : 
			$status = -1;
			$mes = -1;
			$cd_servidor = $_SESSION['CPF'];
			if(isset($_GET['servidor']) && !empty($_GET['servidor'])) {
				$cd_servidor = $_GET['servidor'];
			}
			if(isset($_GET['status']) && !empty($_GET['status'])) {
				$status = $_GET['status'];
			}
			if(isset($_GET['mes']) && !empty($_GET['mes'])) {
				$mes = $_GET['mes'];
			}
			listar_atividades($cd_servidor, $status, $mes, $conexao_com_banco);
			break;	
		case 'Listar Grupo' : 
			$cd_servidor = $_SESSION['CPF'];
			if(isset($_GET['servidor']) && !empty($_GET['servidor'])) {
				$cd_servidor = $_GET['servidor'];
			}
			listar_atividades_grupo($cd_servidor, $conexao_com_banco);
			break;	
		case 'Listar Abertas' : 
			$mes = -1;
			$cd_servidor = $_SESSION['CPF'];
			if(isset($_GET['servidor']) && !empty($_GET['servidor'])) {
				$cd_servidor = $_GET['servidor'];
			}
			if(isset($_GET['mes']) && !empty($_GET['mes'])) {
				$mes = $_GET['mes'];
			}
			listar_atividades_abertas($cd_servidor, $mes, $conexao_com_banco);
			break;	
		case 'Listar Abertas Grupo' : 
			$cd_servidor = $_SESSION['CPF'];
			if(isset($_GET['servidor']) && !empty($_GET['servidor'])) {
				$cd_servidor = $_GET['servidor'];
			}			listar_atividades_abertas_grupo($cd_servidor, $conexao_com_banco);
			break;	
		case 'Listar Abertas Tipo' : 			
			$descricao = '';
			$cd_servidor = $_SESSION['CPF'];
			if(isset($_GET['servidor']) && !empty($_GET['servidor'])) {
				$cd_servidor = $_GET['servidor'];
			}
			if(isset($_GET['id']) && !empty($_GET['id'])) {
				$descricao = retorna_descricao($_GET['id'], $conexao_com_banco);
			}
			if(isset($_GET['descricao']) && !empty($_GET['descricao'])) {
				$descricao = $_GET['descricao'];
			}
			listar_atividades_abertas_tipo($cd_servidor, $descricao, $conexao_com_banco);
			break;	
		case 'Listar Finalizadas' : 
			$cd_servidor = $_SESSION['CPF'];
			if(isset($_GET['servidor']) && !empty($_GET['servidor'])) {
				$cd_servidor = $_GET['servidor'];
			}
			$mes = -1;
			if(isset($_GET['mes']) && !empty($_GET['mes'])) {
				$mes = $_GET['mes'];
			}
			listar_atividades_finalizadas($cd_servidor, $mes, $conexao_com_banco);
			break;	
		case 'Listar Finalizadas Tipo' : 			
			$descricao = '';
			$cd_servidor = $_SESSION['CPF'];
			if(isset($_GET['servidor']) && !empty($_GET['servidor'])) {
				$cd_servidor = $_GET['servidor'];
			}
			if(isset($_GET['id']) && !empty($_GET['id'])) {
				$descricao = retorna_descricao($_GET['id'], $conexao_com_banco);
			}
			if(isset($_GET['descricao']) && !empty($_GET['descricao'])) {
				$descricao = $_GET['descricao'];
			}
			listar_atividades_finalizadas_tipo($cd_servidor, $descricao, $conexao_com_banco);
			break;				
		case 'Relatar' :
			$cd_servidor = $_SESSION['CPF'];
			if(isset($_GET['servidor']) && !empty($_GET['servidor'])) {
				$cd_servidor = $_GET['servidor'];
			}
			$ano = 0;
			if(isset($_GET['ano']) && !empty($_GET['ano'])) {
				$ano = $_GET['ano'];
			}
			relatar_atividades($cd_servidor, $ano, $conexao_com_banco);	
			break;
		case 'Remover' :
			$cd_atividade = -1;
			if(isset($_GET['id']) && !empty($_GET['id'])) {
				$cd_atividade = $_GET['id'];
			}
			remover_atividade($cd_atividade, $conexao_com_banco);
		break;
		case 'Mudar Status':
			$cd_atividade = -1;
			if(isset($_GET['id']) && !empty($_GET['id'])) {
				$cd_atividade = $_GET['id'];
			}
			$status = -1;
			if(isset($_GET['status']) && !empty($_GET['status'])) {
				$status = $_GET['status'];
			}
			alterar_status($status, $cd_atividade, $conexao_com_banco);
			break;
		case 'Verificar':
			$cd_atividade = -1;
			if(isset($_GET['id']) && !empty($_GET['id'])) {
				$cd_atividade = $_GET['id'];
			}
			verifica_anexo($cd_atividade, $conexao_com_banco);
			break;
		case 'Finalizar':
			$cd_atividade = -1;
			if(isset($_GET['id']) && !empty($_GET['id'])) {
				$cd_atividade = $_GET['id'];
			}
			finalizar_atividade($cd_atividade, $conexao_com_banco);
			break;
		case 'Atualizar':
			atualizar($conexao_com_banco);
			break;
		case 'Listar Gabinete':
			$cd_servidor = $_SESSION['CPF'];
			if(isset($_GET['servidor']) && !empty($_GET['servidor'])) {
				$cd_servidor = $_GET['servidor'];
			}
			listar_atividades_gabinete_andamento($conexao_com_banco, $cd_servidor);
			break;
		case 'Relatar Gabinete' :
			$cd_servidor = $_SESSION['CPF'];
			if(isset($_GET['servidor']) && !empty($_GET['servidor'])) {
				$cd_servidor = $_GET['servidor'];
			}
			$ano = 0;
			if(isset($_GET['ano']) && !empty($_GET['ano'])) {
				$ano = $_GET['ano'];
			}
			relatar_atividades_gabinete($conexao_com_banco, $cd_servidor, $ano);	
			break;
    }	
}

function listar_atividades($cd_servidor, $status, $mes, $conexao_com_banco) {
	$status_query = '';
	$ano = date('Y');
	$mes_query = '';
	if ($status != -1) {
		$status_query  = " AND ativ.NM_STATUS ='$status'";
	}
	if ($mes != -1) {
		$mes_query  = " AND MONTH(ativ.DT_VENCIMENTO) = '$mes'";
	}
	
	$query = "SELECT ativ.*, ane.NM_ARQUIVO FROM tb_atividades ativ left join tb_anexos_atividade ane on ativ.CD_ATIVIDADE = ane.CD_ATIVIDADE WHERE ativ.cd_servidor = '$cd_servidor' AND YEAR(ativ.DT_VENCIMENTO) = '$ano' $status_query $mes_query GROUP BY ativ.CD_ATIVIDADE order by ativ.DT_VENCIMENTO DESC";
	$atividades = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($atividades)){
		$resultados[] = $linha;
	};		
	echo json_encode($resultados);
	
}

function listar_atividades_grupo($cd_servidor, $conexao_com_banco) {
	$ano = date('Y');
	
	$query = "SELECT ativ.*, count(*) as TOTAL, (select count(*) from tb_atividades at2 where at2.TX_DESCRICAO  = ativ.TX_DESCRICAO  AND at2.NM_STATUS IN ('CONCLUÍDO COM ATRASO', 'CONCLUÍDO')) as TOTAL_FECHADO FROM tb_atividades ativ WHERE ativ.cd_servidor = '$cd_servidor' AND YEAR(ativ.DT_VENCIMENTO) = '$ano' GROUP BY TX_DESCRICAO order by ativ.DT_VENCIMENTO DESC";
	$atividades = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($atividades)){
		$resultados[] = $linha;
	};		
	echo json_encode($resultados);
	
}

function retorna_descricao($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT TX_DESCRICAO FROM tb_atividades WHERE CD_ATIVIDADE='$id'");
	
	$descricao = mysqli_fetch_row($resultado);
	
	return $descricao[0];

}

function listar_atividades_abertas($cd_servidor, $mes, $conexao_com_banco) {
	$ano = date('Y');
	$mes_query = '';
	if ($mes != -1) {
		$mes_query  = " AND MONTH(ativ.DT_VENCIMENTO) = '$mes'";
	}
	
	$query = "SELECT ativ.*, ane.NM_ARQUIVO FROM tb_atividades ativ left join tb_anexos_atividade ane on ativ.CD_ATIVIDADE = ane.CD_ATIVIDADE WHERE ativ.cd_servidor = '$cd_servidor' AND YEAR(ativ.DT_VENCIMENTO) = '$ano' AND ((ativ.NM_STATUS ='EM ANDAMENTO' $mes_query) OR (ativ.NM_STATUS = 'VENCEU')) order by ativ.DT_VENCIMENTO DESC";
	$atividades = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($atividades)){
		$resultados[] = $linha;
	};		
	echo json_encode($resultados);
	
}

function listar_atividades_abertas_grupo($cd_servidor, $conexao_com_banco) {
	$ano = date('Y');
	
	$query = "SELECT ativ.*, count(*) as TOTAL, (select count(*) from tb_atividades at2 where at2.CD_ATIVIDADE = ativ.CD_ATIVIDADE AND at2.NM_STATUS NOT IN ('EM ANDAMENTO', 'VENCEU')) as TOTAL_FECHADO FROM tb_atividades ativ WHERE ativ.cd_servidor = '$cd_servidor' AND YEAR(ativ.DT_VENCIMENTO) = '$ano' AND ((ativ.NM_STATUS ='EM ANDAMENTO') OR (ativ.NM_STATUS = 'VENCEU')) GROUP BY TX_DESCRICAO order by ativ.DT_VENCIMENTO DESC";
	$atividades = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($atividades)){
		$resultados[] = $linha;
	};		
	echo json_encode($resultados);
	
}

function listar_atividades_abertas_tipo($cd_servidor, $tipo, $conexao_com_banco) {
	$ano = date('Y');
	$tipo_query = '';
	if ($tipo != -1) {
		$tipo_query  = " AND TX_DESCRICAO = '$tipo'";
	}
	
	$query = "SELECT ativ.*, ane.NM_ARQUIVO FROM tb_atividades ativ left join tb_anexos_atividade ane on ativ.CD_ATIVIDADE = ane.CD_ATIVIDADE WHERE ativ.cd_servidor = '$cd_servidor' AND YEAR(ativ.DT_VENCIMENTO) = '$ano' $tipo_query AND ((ativ.NM_STATUS ='EM ANDAMENTO') OR (ativ.NM_STATUS = 'VENCEU')) order by ativ.DT_VENCIMENTO ASC";
	$atividades = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	while ($linha = mysqli_fetch_object($atividades)){
		$resultados[] = $linha;
	};		
	echo json_encode($resultados);
	
}



function listar_atividades_finalizadas($cd_servidor, $mes, $conexao_com_banco) {
	$status_query = '';
	$ano = date('Y');
	$mes_query = '';
	if ($mes != -1) {
		$mes_query  = " AND MONTH(DT_VENCIMENTO) = '$mes'";
	}
	
	$query = "SELECT ativ.*, ane.NM_ARQUIVO FROM tb_atividades ativ left join tb_anexos_atividade ane on ativ.CD_ATIVIDADE = ane.CD_ATIVIDADE WHERE ativ.cd_servidor = '$cd_servidor' AND YEAR(ativ.DT_VENCIMENTO) = '$ano' AND ativ.NM_STATUS NOT IN ('EM ANDAMENTO', 'VENCEU') $mes_query order by ativ.DT_VENCIMENTO DESC";
	$atividades = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($atividades)){
		$resultados[] = $linha;
	};		
	echo json_encode($resultados);
	
}

function listar_atividades_finalizadas_tipo($cd_servidor, $tipo, $conexao_com_banco) {
	$status_query = '';
	$ano = date('Y');
	$tipo_query = '';
	if ($tipo != -1) {
		$tipo_query  = " AND TX_DESCRICAO = '$tipo'";
	}
	
	$query = "SELECT ativ.*, ane.NM_ARQUIVO FROM tb_atividades ativ left join tb_anexos_atividade ane on ativ.CD_ATIVIDADE = ane.CD_ATIVIDADE WHERE ativ.cd_servidor = '$cd_servidor' AND YEAR(ativ.DT_VENCIMENTO) = '$ano' AND ativ.NM_STATUS NOT IN ('EM ANDAMENTO', 'VENCEU') $tipo_query order by ativ.DT_VENCIMENTO ASC";
	$atividades = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($atividades)){
		$resultados[] = $linha;
	};		
	echo json_encode($resultados);
	
}

function relatar_atividades($cd_servidor, $ano, $conexao_com_banco){
	$atividades;
	
	if ($ano != 0) {
		$atividades = mysqli_query($conexao_com_banco, "SELECT MONTH(DT_VENCIMENTO) As Mes, NM_STATUS AS Status, count(*) Contagem FROM tb_atividades WHERE cd_servidor = '$cd_servidor' and YEAR(DT_VENCIMENTO) = '$ano' group by MONTH(DT_VENCIMENTO), NM_STATUS");
			
	} else {
		$atividades = mysqli_query($conexao_com_banco, "SELECT MONTH(DT_VENCIMENTO) As Mes, NM_STATUS AS Status, count(*) Contagem FROM tb_atividades WHERE cd_servidor = '$cd_servidor' group by MONTH(DT_VENCIMENTO), NM_STATUS");
		}
	
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($atividades)){
		$resultados[] = $linha;
	};		
	echo json_encode($resultados);
	
}

function remover_atividade($cd_atividade, $conexao_com_banco){
	if ($cd_atividade != -1) {
		$success = mysqli_query($conexao_com_banco, "DELETE FROM tb_atividades WHERE CD_ATIVIDADE='$cd_atividade' ") or die (mysqli_error($conexao_com_banco));
		if ($success != false) {
			echo 'Sucesso';
		} else {
			echo 'Falhou';
		}
	} else {		
		echo 'Falhou';
	}
}

function alterar_status($status, $cd_atividade, $conexao_com_banco) {
	if ($cd_atividade != -1 && $status != '') {
		$success = mysqli_query($conexao_com_banco, "UPDATE tb_atividades set NM_STATUS = '$status' WHERE CD_ATIVIDADE='$cd_atividade' ") or die (mysqli_error($conexao_com_banco));
		if ($success != false) {
			echo 'Sucesso';
		} else {
			echo 'Falhou';
		}
	} else {		
		echo 'Falhou';
	}
}

function verifica_anexo($cd_atividade, $conexao_com_banco) {
	if ($cd_atividade != -1) {
		$atividades = mysqli_query($conexao_com_banco, "Select count(*) FROM tb_anexos_atividade WHERE CD_ATIVIDADE='$cd_atividade' ") or die (mysqli_error($conexao_com_banco));
		$atividades = mysqli_fetch_row($atividades);
		echo json_encode($atividades);
	} else {		
		echo 'Falhou';
	}
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
			echo $status;
			
		} else {
			echo 'Falhou';
		}
	} else {		
		echo 'Falhou';
	}
}

function atualizar($conexao_com_banco) {
	mysqli_query($conexao_com_banco, "UPDATE `tb_atividades` SET NM_STATUS = 'VENCEU' WHERE DT_VENCIMENTO < CURDATE() AND NM_STATUS IN ('FALTA ANEXO', 'EM ANDAMENTO')") or die (mysqli_error($conexao_com_banco));
		
	echo 'feito';
	
}

function listar_atividades_gabinete_andamento($conexao_com_banco, $cd_servidor) {
	$atividades = mysqli_query($conexao_com_banco, "SELECT t.CD_PROCESSO as Processo, DATEDIFF(CURDATE(),t.DT_TRAMITACAO) as Dias, t.DT_TRAMITACAO Data_Entrada FROM (SELECT * FROM (SELECT * FROM `tb_tramitacao_processos` where CD_SERVIDOR_DESTINO = '$cd_servidor' ORDER BY DT_TRAMITACAO) AS t GROUP BY t.CD_PROCESSO) AS t LEFT JOIN (SELECT * FROM (SELECT * FROM `tb_tramitacao_processos` where CD_SERVIDOR_ORIGEM = '$cd_servidor' ORDER BY DT_TRAMITACAO) AS t GROUP BY t.CD_PROCESSO) AS t2 ON t.CD_PROCESSO = t2.CD_PROCESSO WHERE t2.ID IS NULL OR t.DT_TRAMITACAO > t2.DT_TRAMITACAO and t.CD_PROCESSO NOT IN (SELECT CD_PROCESSO FROM `tb_processos` WHERE NM_STATUS NOT IN ('Arquivado', 'Saiu'))") or die (mysqli_error($conexao_com_banco));
	
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($atividades)){
		$resultados[] = $linha;
	};		
	echo json_encode($resultados);
}

function listar_atividades_gabinete_tramitadas($conexao_com_banco, $cd_servidor) {
	$atividades = mysqli_query($conexao_com_banco, "Select entrou.CD_PROCESSO, entrou.CD_SERVIDOR_DESTINO, entrou.DT_TRAMITACAO DATA_ENTRADA, saiu.DT_TRAMITACAO DATA_SAIDA, DATEDIFF(saiu.DT_TRAMITACAO, entrou.DT_TRAMITACAO) dias from (SELECT * FROM `tb_tramitacao_processos` WHERE CD_SERVIDOR_DESTINO = 'cd_servidor') as entrou, (SELECT * FROM `tb_tramitacao_processos` WHERE CD_SERVIDOR_ORIGEM = '$cd_servidor') as saiu where entrou.CD_PROCESSO = saiu.CD_PROCESSO AND DATEDIFF(saiu.DT_TRAMITACAO, entrou.DT_TRAMITACAO) >= 0") or die (mysqli_error($conexao_com_banco));
	
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($atividades)){
		$resultados[] = $linha;
	};		
	echo json_encode($resultados);
}

function listar_atividades_gabinete_tramitadas_mes($conexao_com_banco, $cd_servidor, $mes, $ano) {
	$atividades = mysqli_query($conexao_com_banco, "Select entrou.CD_PROCESSO, entrou.CD_SERVIDOR_DESTINO, entrou.DT_TRAMITACAO DATA_ENTRADA, saiu.DT_TRAMITACAO DATA_SAIDA, DATEDIFF(saiu.DT_TRAMITACAO, entrou.DT_TRAMITACAO) dias from (SELECT * FROM `tb_tramitacao_processos` WHERE CD_SERVIDOR_DESTINO = '$cd_servidor') as entrou, (SELECT * FROM `tb_tramitacao_processos` WHERE CD_SERVIDOR_ORIGEM = '$cd_servidor') as saiu where entrou.CD_PROCESSO = saiu.CD_PROCESSO AND DATEDIFF(saiu.DT_TRAMITACAO, entrou.DT_TRAMITACAO) >= 0 AND MONTH(entrou.DT_TRAMITACAO) = '$mes' AND YEAR(entrou.DT_TRAMITACAO) = '$ano'") or die (mysqli_error($conexao_com_banco));
	
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($atividades)){
		$resultados[] = $linha;
	};		
	echo json_encode($resultados);
}

function resumir_atividades_gabinete_tramitadas($conexao_com_banco, $cd_servidor) {
	$atividades = mysqli_query($conexao_com_banco, "Select entrou.CD_PROCESSO, entrou.DT_TRAMITACAO DATA_ENTRADA, saiu.DT_TRAMITACAO DATA_SAIDA, DATEDIFF(saiu.DT_TRAMITACAO, entrou.DT_TRAMITACAO) dias
,count(CASE WHEN DATEDIFF(saiu.DT_TRAMITACAO, entrou.DT_TRAMITACAO) < 4 THEN 1 END) as prazo, count(CASE WHEN DATEDIFF(saiu.DT_TRAMITACAO, entrou.DT_TRAMITACAO) > 3 THEN 1 END) as venceu

 from (
        SELECT * FROM `tb_tramitacao_processos` WHERE CD_SERVIDOR_DESTINO = '$cd_servidor') as entrou, (SELECT * FROM `tb_tramitacao_processos` WHERE CD_SERVIDOR_ORIGEM = '$cd_servidor') as saiu where entrou.CD_PROCESSO = saiu.CD_PROCESSO AND DATEDIFF(saiu.DT_TRAMITACAO, entrou.DT_TRAMITACAO) >= 0 GROUP BY MONTH(entrou.DT_TRAMITACAO)") or die (mysqli_error($conexao_com_banco));
	
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($atividades)){
		$resultados[] = $linha;
	};		
	echo json_encode($resultados);
}

function relatar_atividades_gabinete($conexao_com_banco, $cd_servidor, $ano) {
	$atividades = mysqli_query($conexao_com_banco, "SELECT resumo.CD_PROCESSO, resumo.DATA_ENTRADA, resumo.DATA_SAIDA, resumo.Dias FROM (Select entrou.CD_PROCESSO AS CD_PROCESSO, entrou.CD_SERVIDOR_DESTINO, entrou.DT_TRAMITACAO DATA_ENTRADA, saiu.DT_TRAMITACAO as DATA_SAIDA, DATEDIFF(saiu.DT_TRAMITACAO, entrou.DT_TRAMITACAO) Dias, 'FINALIZADA' as status from (SELECT * FROM `tb_tramitacao_processos` WHERE CD_SERVIDOR_DESTINO = '$cd_servidor') as entrou, (SELECT * FROM `tb_tramitacao_processos` WHERE CD_SERVIDOR_ORIGEM = '$cd_servidor') as saiu where entrou.CD_PROCESSO = saiu.CD_PROCESSO AND DATEDIFF(saiu.DT_TRAMITACAO, entrou.DT_TRAMITACAO) >= 0 AND YEAR(entrou.DT_TRAMITACAO) = '$ano' GROUP BY entrou.CD_PROCESSO, entrou.DT_TRAMITACAO) as resumo GROUP BY resumo.CD_PROCESSO, resumo.DATA_SAIDA") or die (mysqli_error($conexao_com_banco));
	
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($atividades)){
		$resultados[] = $linha;
	};	

	$atividades = mysqli_query($conexao_com_banco, "SELECT t.CD_PROCESSO as Processo, DATEDIFF(CURDATE(),t.DT_TRAMITACAO) as Dias, t.DT_TRAMITACAO DATA_ENTRADA, 'EM ANDAMENTO' as status FROM (SELECT * FROM (SELECT * FROM `tb_tramitacao_processos` where CD_SERVIDOR_DESTINO = '$cd_servidor' ORDER BY DT_TRAMITACAO) AS t GROUP BY t.CD_PROCESSO) AS t LEFT JOIN (SELECT * FROM (SELECT * FROM `tb_tramitacao_processos` where CD_SERVIDOR_ORIGEM = '$cd_servidor' ORDER BY DT_TRAMITACAO) AS t GROUP BY t.CD_PROCESSO) AS t2 ON t.CD_PROCESSO = t2.CD_PROCESSO WHERE t2.ID IS NULL OR t.DT_TRAMITACAO > t2.DT_TRAMITACAO and t.CD_PROCESSO NOT IN (SELECT CD_PROCESSO FROM `tb_processos` WHERE NM_STATUS NOT IN ('Arquivado', 'Saiu'))  AND YEAR(t.DT_TRAMITACAO) = '$ano'") or die (mysqli_error($conexao_com_banco));
	
	while ($linha = mysqli_fetch_object($atividades)){
		$resultados[] = $linha;
	};	
			
	echo json_encode($resultados);
}
?>