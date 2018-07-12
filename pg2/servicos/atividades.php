
<?php
include('../componentes/banco-dados/conectar.php');
include('../componentes/sessao/iniciar-sessao.php');
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
	
	$query = "SELECT ativ.*, ane.NM_ARQUIVO FROM tb_atividades ativ left join tb_anexos ane on concat('ATIVIDADE_', ativ.id) = ane.CD_REFERENTE WHERE ativ.cd_servidor = '$cd_servidor' AND YEAR(ativ.DT_VENCIMENTO) = '$ano' $status_query $mes_query GROUP BY ativ.id order by ativ.DT_VENCIMENTO DESC";
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
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT TX_DESCRICAO FROM tb_atividades WHERE ID='$id'");
	
	$descricao = mysqli_fetch_row($resultado);
	
	return $descricao[0];

}

function listar_atividades_abertas($cd_servidor, $mes, $conexao_com_banco) {
	$ano = date('Y');
	$mes_query = '';
	if ($mes != -1) {
		$mes_query  = " AND MONTH(ativ.DT_VENCIMENTO) = '$mes'";
	}
	
	$query = "SELECT ativ.*, ane.NM_ARQUIVO FROM tb_atividades ativ left join tb_anexos ane on concat('ATIVIDADE_', ativ.id) = ane.CD_REFERENTE WHERE ativ.cd_servidor = '$cd_servidor' AND YEAR(ativ.DT_VENCIMENTO) = '$ano' AND ((ativ.NM_STATUS ='EM ANDAMENTO' $mes_query) OR (ativ.NM_STATUS = 'VENCEU')) order by ativ.DT_VENCIMENTO DESC";
	$atividades = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($atividades)){
		$resultados[] = $linha;
	};		
	echo json_encode($resultados);
	
}

function listar_atividades_abertas_grupo($cd_servidor, $conexao_com_banco) {
	$ano = date('Y');
	
	$query = "SELECT ativ.*, count(*) as TOTAL, (select count(*) from tb_atividades at2 where at2.ID = ativ.ID AND at2.NM_STATUS NOT IN ('EM ANDAMENTO', 'VENCEU')) as TOTAL_FECHADO FROM tb_atividades ativ WHERE ativ.cd_servidor = '$cd_servidor' AND YEAR(ativ.DT_VENCIMENTO) = '$ano' AND ((ativ.NM_STATUS ='EM ANDAMENTO') OR (ativ.NM_STATUS = 'VENCEU')) GROUP BY TX_DESCRICAO order by ativ.DT_VENCIMENTO DESC";
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
	
	$query = "SELECT ativ.*, ane.NM_ARQUIVO FROM tb_atividades ativ left join tb_anexos ane on concat('ATIVIDADE_', ativ.id) = ane.CD_REFERENTE WHERE ativ.cd_servidor = '$cd_servidor' AND YEAR(ativ.DT_VENCIMENTO) = '$ano' $tipo_query AND ((ativ.NM_STATUS ='EM ANDAMENTO') OR (ativ.NM_STATUS = 'VENCEU')) order by ativ.DT_VENCIMENTO ASC";
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
	
	$query = "SELECT ativ.*, ane.NM_ARQUIVO FROM tb_atividades ativ left join tb_anexos ane on concat('ATIVIDADE_', ativ.id) = ane.CD_REFERENTE WHERE ativ.cd_servidor = '$cd_servidor' AND YEAR(ativ.DT_VENCIMENTO) = '$ano' AND ativ.NM_STATUS NOT IN ('EM ANDAMENTO', 'VENCEU') $mes_query order by ativ.DT_VENCIMENTO DESC";
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
	
	$query = "SELECT ativ.*, ane.NM_ARQUIVO FROM tb_atividades ativ left join tb_anexos ane on concat('ATIVIDADE_', ativ.id) = ane.CD_REFERENTE WHERE ativ.cd_servidor = '$cd_servidor' AND YEAR(ativ.DT_VENCIMENTO) = '$ano' AND ativ.NM_STATUS NOT IN ('EM ANDAMENTO', 'VENCEU') $tipo_query order by ativ.DT_VENCIMENTO ASC";
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
		$success = mysqli_query($conexao_com_banco, "DELETE FROM tb_atividades WHERE ID='$cd_atividade' ") or die (mysqli_error($conexao_com_banco));
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
		$success = mysqli_query($conexao_com_banco, "UPDATE tb_atividades set NM_STATUS = '$status' WHERE ID='$cd_atividade' ") or die (mysqli_error($conexao_com_banco));
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
		$atividades = mysqli_query($conexao_com_banco, "Select count(*) FROM tb_anexos WHERE CD_REFERENTE='ATIVIDADE_$cd_atividade' ") or die (mysqli_error($conexao_com_banco));
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

?>