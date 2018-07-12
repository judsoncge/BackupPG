<?php

ini_set('max_execution_time', 10000);

date_default_timezone_set('America/Bahia');
$ROOT = ' http://'.$_SERVER['SERVER_NAME'].'/';
$ROOT_SISTEMA = $_SERVER['DOCUMENT_ROOT'].'/sistema';
include('anexo/logica/funcoes.php');
include('acompanhamento-processo/logica/funcoes.php');

function retorna_pode_mexer_processo_outros($set_loc, $status, $conexao_com_banco){
	
	if((($set_loc == $_SESSION['setor'] or $set_loc == $_SESSION['setor-subordinado'])
		 and $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim')
		 or
		 $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim'){
			return true;
		 }
	else{
			return false;
	}
	
}

function retorna_nome_orgao($orgao, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_ORGAO FROM tb_orgaos WHERE ID='$orgao'");
	
	$nome = mysqli_fetch_row($resultado);
	
	return $nome[0];

}

function retorna_orgaos($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_orgaos ORDER BY CD_ORGAO");
	
	return $resultado;

}

function retorna_proximo_fluxo_processo($funcao, $status, $processo, $assunto, $conexao_com_banco){
	
	if($funcao == 'Protocolo'){
		
		$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SERVIDOR, NM_SERVIDOR, SNM_SERVIDOR, CD_SETOR, NM_FUNCAO FROM tb_servidores WHERE NM_FUNCAO='Assessor Técnico Gabinete' LIMIT 1");
		
	}else if(($funcao == 'Assessor Técnico Gabinete') and ($status == 'Em andamento' or $status == 'Atrasado')){
		
		$assunto = retorna_assunto_processos($assunto, $conexao_com_banco);
	
		if(!$assunto || !$assunto -> CD_SETOR_RESPONSAVEL || $assunto -> CD_SETOR_RESPONSAVEL == ''){
			echo "<script>alert('O setor responsável não está definido para esse assunto. Não sei para quem tramitar! =(');</script>";
			
			echo "<script>history.back();</script>";
			
			die();
		
		}
		
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
			echo "<script>alert('Finalize o processo para poder tramitar!')</script>";
			echo "<script>history.back()</script>";
			die();
			
		}elseif($status == 'Finalizado pelo gabinete'){
			$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SERVIDOR, NM_SERVIDOR, SNM_SERVIDOR, CD_SETOR, NM_FUNCAO FROM tb_servidores WHERE NM_FUNCAO='Protocolo' ORDER BY RAND() LIMIT 1");
		}
		
		
		
	}else if($funcao == 'Assessor Técnico Setor'){
		
		$lider = retorna_lider_processo($processo, $conexao_com_banco);
		
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
			echo "<script>alert('Finalize o processo para poder tramitar!')</script>";
			echo "<script>history.back()</script>";
			die();
		}else{
			
			$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SERVIDOR, NM_SERVIDOR, SNM_SERVIDOR, CD_SETOR FROM tb_servidores WHERE NM_FUNCAO='Assessor Técnico Gabinete' LIMIT 1");
		}

	}
	
	$dados_destino = mysqli_fetch_row($resultado);
	
	return $dados_destino;

}

function retorna_passou_superintendente($setor, $processo, $conexao_com_banco){
	
	$recebeu = $_SESSION['CPF'];
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SERVIDOR_ORIGEM FROM tb_tramitacao_processos WHERE CD_PROCESSO='$processo' AND CD_SERVIDOR_DESTINO='$recebeu' AND CD_SERVIDOR_ORIGEM=(SELECT CD_SERVIDOR FROM tb_servidores WHERE CD_SETOR='$setor' AND NM_FUNCAO='Superintendente')");
	
	if(mysqli_affected_rows($conexao_com_banco)==0){
		return false;
		
	}else{
		return true;
		
	}

}

function retorna_status_processo($processo, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_STATUS FROM tb_processos WHERE CD_PROCESSO='$processo'");
	
	$status = mysqli_fetch_row($resultado);
	
	return $status[0];
	
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

function retorna_setor_responsavel_assunto_processo($assunto_processo, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SETOR_RESPONSAVEL FROM tb_assuntos_processos WHERE ID='$assunto_processo'");
	
	$setor = mysqli_fetch_row($resultado);
	
	return $setor[0];
	
}

function retorna_assunto_processo($processo, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT ID_ASSUNTO FROM tb_processos WHERE CD_PROCESSO='$processo'");
	
	$assunto = mysqli_fetch_row($resultado);
	
	return $assunto[0];

}

function retorna_assunto_processos($assunto, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_assuntos_processos WHERE ID='$assunto'");
	
	$assunto = mysqli_fetch_object($resultado);
	
	return $assunto;

}

function retorna_funcao_servidor($servidor, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_FUNCAO FROM tb_servidores WHERE CD_SERVIDOR='$servidor'");
	
	$funcao = mysqli_fetch_row($resultado);
	
	return $funcao[0];

}


function somar_data($data, $dias, $meses = 0, $ano = 0)
{
   //passe a data no formato yyyy-mm-dd
   $data = explode("-", $data);
   $nova_data = date("Y-m-d", mktime(0, 0, 0, $data[1] + $meses, $data[2] + $dias, $data[0] + $ano) );
   return $nova_data;
}

function retorna_assuntos_processos($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT ID, NM_ASSUNTO FROM tb_assuntos_processos ORDER BY NM_ASSUNTO");
	
	return $resultado;

}

function retorna_nome_assunto($assunto, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_ASSUNTO FROM tb_assuntos_processos WHERE ID='$assunto'");
	
	$nome = mysqli_fetch_row($resultado);
	
	return $nome[0];

}

function retorna_processos_prazo_hoje($conexao_com_banco){
	
	$data = date("Y-m-d");
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT count(*) FROM tb_processos WHERE DT_PRAZO='$data'");
	
	$quantidade = mysqli_fetch_row($resultado);
	
	return $quantidade[0];

}

function retorna_processos_sairam_hoje($conexao_com_banco){
	
	$data = date("Y-m-d");
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT count(*) FROM tb_processos WHERE DT_SAIDA='$data'");
	
	$quantidade = mysqli_fetch_row($resultado);
	
	return $quantidade[0];

}

function retorna_processos_entraram_hoje($conexao_com_banco){
	
	$data = date("Y-m-d");
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT count(*) FROM tb_processos WHERE DT_ENTRADA='$data'");
	
	$quantidade = mysqli_fetch_row($resultado);
	
	return $quantidade[0];

}

function retorna_log_servidor($servidor, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM log WHERE CD_SERVIDOR='$servidor' ORDER BY DT_ACAO desc");
	
	return $resultado;

}

function retorna_servidores_relatorio_pessoa($conexao_com_banco){
	
	$setor = $_SESSION['setor'];
	$subordinado = $_SESSION['setor-subordinado'];
	
	if($_SESSION['permissao-visualizar-relatorio-orgao']=="sim"){
		
		$resultado =  mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores order by NM_SERVIDOR");
		return $resultado;
		
	}elseif($_SESSION['permissao-visualizar-relatorio-setor']=="sim"){
		
		$resultado2 = mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores WHERE CD_SETOR='$setor' or CD_SETOR='$subordinado' order by NM_SERVIDOR");
		return $resultado2;
	}
	
	

}

function verificar_permissao_pagina($permissao, $conexao_com_banco){
	if($permissao=='não'){
		echo "<script>alert('Você não tem permissão para estar nessa página!')</script>";
		echo "<script>history.back()</script>";
		die();
	}
}

function retorna_pode_excluir_receita($valor_receita_excluir, $mes, $ano, $conexao_com_banco){
	
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT SUM(VLR_DESPESA) FROM tb_despesas WHERE NR_MES='$mes' AND NR_ANO='$ano' AND NM_STATUS='Pago'");

	$valor_despesas = mysqli_fetch_row($resultado);
	
	$resultado2 = mysqli_query($conexao_com_banco, "SELECT SUM(VLR_RECEITA) FROM tb_receitas WHERE NR_MES='$mes' AND NR_ANO='$ano'");
	
	$valor_receitas = mysqli_fetch_row($resultado2);
	
	$diferenca = $valor_receitas[0]-$valor_receita_excluir;
	
	if($diferenca >= $valor_despesas[0]){
		return true;
	}else{
		return false;
	}

}


function retorna_menor_valor_documentos_processo($processo, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT MIN(VLR_DOCUMENTO) FROM tb_documentos WHERE CD_PROCESSO='$processo' AND
	NM_DOCUMENTO='Cotação de preço'");
	
	$valor = mysqli_fetch_row($resultado);
	
	return $valor[0];
	
}

function retorna_pode_gerar_despesa($processo, $conexao_com_banco){
	
	mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE CD_PROCESSO='$processo' AND
	NM_DOCUMENTO='Publicação no Diário'");
	
	if(mysqli_affected_rows($conexao_com_banco) == 0){
		return false;
	}
	
	mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE CD_PROCESSO='$processo' AND
	NM_DOCUMENTO='Termo de Referência'");
	
	if(mysqli_affected_rows($conexao_com_banco) == 0){
		return false;
	}
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT count(*) FROM tb_documentos WHERE CD_PROCESSO='$processo' AND NM_DOCUMENTO='Cotação de Preço'");
	
	$cotacoes = mysqli_fetch_row($resultado);
	
	if($cotacoes[0] < 3){
		return false;
	}

	$resultado = mysqli_query($conexao_com_banco, "SELECT count(*) FROM tb_documentos WHERE CD_PROCESSO='$processo' AND NM_DOCUMENTO='Certidão Negativa'");
	
	$certidoes = mysqli_fetch_row($resultado);
	
	if($certidoes[0] < 3){
		return false;
	}
	
	return true;
	
}

function retorna_tem_prazo_processo($processo, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT DT_PRAZO, DT_PRAZO_FINAL FROM tb_processos WHERE CD_PROCESSO='$processo'");
	
	$lista = mysqli_fetch_array($resultado);
	
	if($lista['DT_PRAZO']=='0000-00-00' or $lista['DT_PRAZO_FINAL']=='0000-00-00'){
		return false;
	}else{
		return true;
	}
}

function retorna_processos_com_servidor($CPF, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT p.*, s.NM_SERVIDOR AS NM_SERVIDOR_LOCALIZACAO FROM tb_processos AS p LEFT JOIN tb_servidores s on p.CD_SERVIDOR_LOCALIZACAO = s.CD_SERVIDOR WHERE CD_SERVIDOR_LOCALIZACAO='$CPF' and NM_STATUS!='Arquivado' and NM_STATUS!='Saiu' ORDER BY NR_URGENCIA DESC, CD_PROCESSO");
	
	return $resultado;
	
}

function retorna_processos_setor($setor, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT p.*, s.NM_SERVIDOR AS NM_SERVIDOR_LOCALIZACAO FROM tb_processos AS p LEFT JOIN tb_servidores s on p.CD_SERVIDOR_LOCALIZACAO = s.CD_SERVIDOR WHERE CD_SETOR_LOCALIZACAO='$setor' or CD_SETOR_LOCALIZACAO=(SELECT CD_SETOR_SUBORDINADO FROM tb_setores WHERE CD_SETOR='$setor') and NM_STATUS!='Arquivado' and NM_STATUS!='Saiu' ORDER BY NR_URGENCIA DESC, p.CD_PROCESSO");
	
	return $resultado;
	
}

function retorna_processos_apensar($processo, $conexao_com_banco){
	
	$setor = $_SESSION['setor'];
	
	$setor_sub = $_SESSION['setor-subordinado'];
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_processos WHERE (CD_SETOR_LOCALIZACAO='$setor' or CD_SETOR_LOCALIZACAO='$setor_sub') and CD_PROCESSO_APENSADO='' and CD_PROCESSO!='$processo' and NM_STATUS!='Arquivado' and NM_STATUS!='Saiu' ORDER BY NR_URGENCIA DESC, CD_PROCESSO");
	
	return $resultado;
	
}

function retorna_todos_processos($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT p.*, s.NM_SERVIDOR AS NM_SERVIDOR_LOCALIZACAO FROM tb_processos AS p LEFT JOIN tb_servidores s on p.CD_SERVIDOR_LOCALIZACAO = s.CD_SERVIDOR ORDER BY NR_URGENCIA DESC, p.CD_PROCESSO");
	
	return $resultado;
	
}

function retorna_processos_status($status, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT p.*, s.NM_SERVIDOR AS NM_SERVIDOR_LOCALIZACAO FROM tb_processos AS p LEFT JOIN tb_servidores s on p.CD_SERVIDOR_LOCALIZACAO = s.CD_SERVIDOR WHERE NM_STATUS='$status' ORDER BY NR_URGENCIA DESC, p.CD_PROCESSO");
	
	return $resultado;
	
}

function retorna_informacoes_despesa($despesa, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_despesas WHERE ID_DESPESA='$despesa'");
	
	$informacoes = mysqli_fetch_array($resultado);
	
	return $informacoes;
	
}


function retorna_informacoes_servidor($servidor, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores WHERE CD_SERVIDOR='$servidor'");
	
	$informacoes = mysqli_fetch_array($resultado);
	
	return $informacoes;
	
}

function retorna_informacoes_processo($processo, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_processos WHERE CD_PROCESSO='$processo'");
	
	$informacoes = mysqli_fetch_array($resultado);
	
	return $informacoes;
	
}

function retorna_existe_compra_processo($processo, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_STATUS FROM tb_compras WHERE CD_PROCESSO='$processo'");
	
	$status = mysqli_fetch_row($resultado);
	
	return $status[0];
	
}

function retorna_responsaveis_processo($processo, $conexao_com_banco){
		
	$query = "SELECT tb_responsaveis_processos.CD_SERVIDOR, tb_servidores.NM_SERVIDOR FROM tb_servidores, tb_responsaveis_processos WHERE tb_servidores.CD_SERVIDOR = tb_responsaveis_processos.CD_SERVIDOR and CD_PROCESSO='$processo'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
		
	return $resultado;
	
}

function retorna_documentos_processo($processo, $conexao_com_banco){
		
	$query = "SELECT * FROM tb_documentos WHERE CD_PROCESSO='$processo'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
		
	return $resultado;
	
}

function retorna_apensos_processo($processo, $conexao_com_banco){
		
	$query = "SELECT * FROM tb_processos WHERE CD_PROCESSO_APENSADO='$processo'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
		
	return $resultado;
	
}

function retorna_compra_processo($processo, $conexao_com_banco){
	
	$query = "SELECT * FROM tb_compras WHERE CD_PROCESSO='$processo'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
		
	return $resultado;
	
}

function retorna_historico_processo($processo, $conexao_com_banco){
		
	$query = "SELECT * FROM tb_historico_processos WHERE CD_PROCESSO='$processo' order by DT_MENSAGEM desc";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
		
	return $resultado;
	
}

function retorna_podem_ser_responsaveis_processo($processo, $conexao_com_banco){
	
	$cpf = $_SESSION['CPF'];
		
	$setor = $_SESSION['setor'];
	
	$setor_sub = $_SESSION['setor-subordinado'];
		
	$query = "SELECT DISTINCT tb_servidores.CD_SERVIDOR, tb_servidores.NM_SERVIDOR, tb_servidores.SNM_SERVIDOR
	FROM tb_servidores, permissao WHERE tb_servidores.CD_SERVIDOR = permissao.CD_SERVIDOR and permissao.SER_RESPONSAVEL_PROCESSO='sim' and tb_servidores.CD_SETOR='$setor' or tb_servidores.CD_SETOR='$setor_sub' and tb_servidores.CD_SERVIDOR not in(SELECT CD_SERVIDOR FROM tb_responsaveis_processos WHERE CD_PROCESSO='$processo') order by tb_servidores.NM_SERVIDOR";

	$resultado = mysqli_query($conexao_com_banco, $query);
		
	return $resultado;
	
}

function retorna_servidores_tramitar($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT s.CD_SERVIDOR, s.NM_SERVIDOR, s.SNM_SERVIDOR FROM permissao p, tb_servidores s WHERE p.CD_SERVIDOR = s.CD_SERVIDOR and p.DESTINO_PROCESSO='sim' ORDER BY s.NM_SERVIDOR");
	
	return $resultado;
	
}

function retorna_servidores_tramitar2($estacom, $conexao_com_banco){
	$resultados = array();
	$setor = $_SESSION['setor'];
	
	$setor_sub = $_SESSION['setor-subordinado'];
	if ($_SESSION['funcao'] == 'Superintendente' || $_SESSION['funcao'] == 'Protocolo' || $_SESSION['funcao'] == 'Assessor Técnico Setor' || $_SESSION['funcao'] == 'Assessor Técnico Gabinete' || $_SESSION['funcao'] == 'Superintendente sem assessor' ) {
		$query = "SELECT NM_SERVIDOR, SNM_SERVIDOR, CD_SETOR AS OPT, CD_SERVIDOR  FROM `tb_servidores` WHERE NM_FUNCAO = 'Assessor Técnico Setor' OR NM_FUNCAO = 'Assessor Técnico Gabinete' OR NM_FUNCAO = 'Superintendente sem assessor' OR NM_FUNCAO = 'Protocolo'  GROUP BY CD_SETOR";
		
		$resultado = mysqli_query($conexao_com_banco, $query);
		
		
		while ($linha = mysqli_fetch_object($resultado)){
			$resultados[] = $linha;
		};
	}
	$query = "SELECT NM_SERVIDOR, SNM_SERVIDOR, CONCAT(CD_SETOR, ' - ', NM_SERVIDOR,' ' ,SNM_SERVIDOR) AS OPT, CD_SERVIDOR  FROM `tb_servidores` WHERE CD_SETOR = '$setor_sub' OR CD_SETOR = '$setor' OR CD_SETOR = 'SUP-$setor' GROUP BY CD_SERVIDOR  ORDER BY NM_SERVIDOR";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	while ($linha = mysqli_fetch_object($resultado)){
		$resultados[] = $linha;
	};
	
		
	return $resultados;
	
}

function retorna_prazo_processo($id_processo, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT DT_PRAZO FROM tb_processos WHERE CD_PROCESSO='$id_processo'");
	
	$prazo = mysqli_fetch_row($resultado);
	
	return $prazo[0];
		
}

function retorna_prazo_final_processo($id_processo, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT DT_PRAZO_FINAL FROM tb_processos WHERE CD_PROCESSO='$id_processo'");
	
	$prazo_final = mysqli_fetch_row($resultado);
	
	return $prazo_final[0];
		
}

function listar_processos_pdf($busca_query, $lugar, $status, $conexao_com_banco) {
	if (!empty($busca_query)) {
		$busca_query = " WHERE (p.CD_PROCESSO LIKE '%$busca_query%' OR p.NM_TIPO LIKE '%$busca_query%' OR NM_STATUS LIKE '%$busca_query%' OR s.CD_SERVIDOR LIKE '%$busca_query%' OR s.NM_SERVIDOR LIKE '%$busca_query%' OR p.DS_PROCESSO LIKE '%$busca_query%' OR s.CD_SETOR LIKE '%$busca_query%')";
	}
	if (empty($busca_query) && !empty($status)) {
		$busca_query = " WHERE NM_STATUS = '$status'";
	} else if (!empty($status)) {
		$busca_query .= " AND NM_STATUS = '$status'";
	}

	if (!empty($lugar)) {
		if ($lugar == 'setor') {
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
	$query = "Select p.*, s.NM_SERVIDOR as NM_SERVIDOR_LOCALIZACAO FROM `tb_processos` p LEFT JOIN `tb_servidores` s ON p.CD_SERVIDOR_LOCALIZACAO = s.CD_SERVIDOR $busca_query";
	$atividades = mysqli_query($conexao_com_banco, $query) or die (mysqli_error($conexao_com_banco));;
	
	return $atividades;
}

function retorna_numero_chamados_sem_nota($requisitante, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM tb_chamados WHERE NM_STATUS='Resolvido' and NM_NOTA='Sem nota' and CD_SERVIDOR_REQUISITANTE='$requisitante'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_total_chamados_mes($mes, $ano, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_chamados WHERE month(DT_ABERTURA)='$mes' and year(DT_ABERTURA)='$ano'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}


function retorna_chamados($conexao_com_banco){
	
	$permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_TODOS_CHAMADO',$conexao_com_banco); 
	
	if($permissao=='sim'){
		
		$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_chamados WHERE NM_STATUS!='Encerrado' ORDER BY DT_ABERTURA DESC");
		
	}else{
		
		$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_chamados WHERE NM_STATUS!='Encerrado' and CD_SERVIDOR_REQUISITANTE='".$_SESSION['CPF']."' ORDER BY DT_ABERTURA DESC");
		
	}
	
	return $resultado;
	
}


function retorna_quantidade_problemas_chamados_mes($mes, $ano, $conexao_com_banco){
	
	$query = "SELECT NM_NATUREZA, count(*) as contador from tb_chamados WHERE month(DT_ABERTURA)='$mes' 
	and year(DT_ABERTURA)='$ano' group by NM_NATUREZA ORDER by contador desc";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}

function retorna_quantidade_chamados_mes_servidor($mes, $ano, $conexao_com_banco){
	
	if($mes==0){
		$mes=12;
		$ano=$ano-1;
	}
	
	$query = "SELECT tb_servidores.NM_SERVIDOR, count(*) as contador from tb_chamados, tb_servidores WHERE 
	tb_servidores.CD_SERVIDOR=tb_chamados.CD_SERVIDOR_REQUISITANTE and month(DT_ABERTURA)='$mes' and 
	year(DT_ABERTURA)='$ano' group by CD_SERVIDOR_REQUISITANTE ORDER by contador desc";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
	
}

function retorna_quantidade_chamados_mes_problema($mes, $ano, $cpf, $conexao_com_banco){

	if($mes==0){
		$mes=12;
		$ano=$ano-1;
	}
	
	$query = "SELECT NM_NATUREZA, count(*) as contador from tb_chamados WHERE month(DT_ABERTURA)='$mes' 
	and year(DT_ABERTURA)='$ano' group by NM_NATUREZA ORDER by contador desc";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}

function retorna_historico_chamado($chamado, $conexao_com_banco){
	
	$query = "SELECT * FROM tb_historico_chamados WHERE CD_CHAMADO='$chamado' order by DT_MENSAGEM desc";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}

function retorna_informacoes_chamado($chamado, $conexao_com_banco) {

	$resultado = mysqli_query($conexao_com_banco, "SELECT c.*, s.NM_SERVIDOR FROM tb_chamados c left join tb_servidores s on c.CD_SERVIDOR_REQUISITANTE = s.CD_SERVIDOR WHERE c.CD_CHAMADO = '$chamado'");
	
	$informacoes = mysqli_fetch_array($resultado);
	
	return $informacoes;
	
	
}


function retorna_informacoes_documento($documento, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE CD_DOCUMENTO='$documento'");
	
	$informacoes = mysqli_fetch_array($resultado);
	
	return $informacoes;
	
}

function retorna_nome_setor_servidor($estacom, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SETOR, NM_SERVIDOR FROM tb_servidores WHERE CD_SERVIDOR='$estacom'");

	$informacoes = mysqli_fetch_array($resultado);
	
	return $informacoes;
	
}























function retorna_permissao($cpf, $permissao, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT $permissao FROM permissao WHERE CD_SERVIDOR='$cpf'");
	
	$permissao = mysqli_fetch_row($resultado);
	
	return $permissao[0];
	
}

function retorna_servidores($conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores order by NM_SERVIDOR");
	
	return $resultado;
	
}

function retorna_processos($conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_processos WHERE NM_STATUS='Ativo' order by DT_PRAZO");
	
	return $resultado;
	
}

function retorna_dados_processo($cd_processo, $conexao_com_banco) {
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_processos WHERE CD_PROCESSO='$cd_processo'");
	
	$processo = mysqli_fetch_object($resultado);
	
	return $processo;
}

function retorna_quantidade_processos($conexao_com_banco){
	$quantidade_processos = mysqli_query($conexao_com_banco, "SELECT count(*) FROM tb_processos WHERE NM_STATUS='Ativo' order by DT_PRAZO");
	
	return $quantidade_processos;
}

function retorna_pagamentos($conexao_com_banco){
	$pagamentos = mysqli_query($conexao_com_banco, "SELECT p.*, t.NM_DESPESA FROM tb_pagamentos p LEFT JOIN tb_tipos_despesas.CD_DESPESA = t.CD_PAGAMENTO");
	
	return $pagamentos;
}

function retorna_caixa_mes_ano($mes, $ano, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT VLR_CAIXA FROM tb_caixa WHERE NR_ANO='$ano' and NR_MES='$mes'");
	
	$valor = mysqli_fetch_row($resultado);
	
	return $valor[0];

}

function retorna_caixa_disponivel($mes, $ano, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT VLR_CAIXA FROM tb_caixa WHERE NR_ANO='$ano' and NR_MES='$mes'");
	
	$caixa = mysqli_fetch_row($resultado);
	
	$resultado2 = mysqli_query($conexao_com_banco, "SELECT SUM(VLR_DESPESA) FROM tb_despesas WHERE NR_ANO='$ano' and NR_MES='$mes' AND NM_STATUS='Empenho autorizado' or NM_STATUS='Empenhado' or NM_STATUS='Pagamento autorizado'");
	
	$empenhados = mysqli_fetch_row($resultado2);
	
	$disponivel = $caixa[0] - $empenhados[0];
	
	return $disponivel;

}

function retorna_caixa_autorizado_empenho($mes, $ano, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT SUM(VLR_DESPESA) FROM tb_despesas WHERE NR_ANO='$ano' and NR_MES='$mes' AND NM_STATUS='Empenho autorizado' or NM_STATUS='Empenhado' or NM_STATUS='Pagamento autorizado'");
	
	$autorizados = mysqli_fetch_row($resultado);
	
	return $autorizados[0];

}


function retorna_tipos_receitas($conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_tipos_receitas WHERE CD_RECEITA!='000000001'");
	
	return $resultado;
	
}

function retorna_tipos_despesas($conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_tipos_despesas ORDER BY NM_DESPESA");
	
	return $resultado;
	
}

function retorna_tipos_pagamentos($conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_tipos_pagamentos");
	
	return $resultado;
	
}

function retorna_receitas_ano($ano, $conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT DISTINCT(r.CD_RECEITA), t.NM_RECEITA AS NM_RECEITA FROM tb_receitas AS r LEFT JOIN tb_tipos_receitas t ON r.CD_RECEITA = t.CD_RECEITA WHERE NR_ANO='$ano' order by NR_MES");
	
	return $resultado;
	
}

function retorna_receitas($conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT r.*, t.NM_RECEITA AS NM_RECEITA FROM tb_receitas AS r LEFT JOIN tb_tipos_receitas t ON r.CD_RECEITA = t.CD_RECEITA order by NR_ANO, NR_MES DESC");
	
	return $resultado;
	
}

function retorna_informacoes_receita($id_receita, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_receitas WHERE ID='$id_receita'");
	
	$informacoes = mysqli_fetch_array($resultado);
	
	return $informacoes;
	
}

function atualizar_caixa($mes, $ano, $valor, $conexao_com_banco){
		
	mysqli_query($conexao_com_banco, "UPDATE tb_caixa SET VLR_CAIXA=VLR_CAIXA+$valor WHERE NR_ANO='$ano' and NR_MES='$mes'");
	
	if($mes != 12){
		for($i=$mes+1;$i<=12;$i++){
			mysqli_query($conexao_com_banco, "UPDATE tb_caixa SET VLR_CAIXA=VLR_CAIXA+$valor WHERE NR_ANO='$ano' and NR_MES='$i'");
		}
	}
	
	
}

function retorna_despesas_ano($ano,$conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT d.*, t.NM_DESPESA as NM_DESPESA FROM tb_despesas d LEFT JOIN tb_tipos_despesas t ON d.CD_DESPESA = t.CD_DESPESA WHERE NR_ANO='$ano' AND NM_STATUS!='Pago' and NM_STATUS!='Recusado' and NM_STATUS!='Pago atrasado' ORDER BY DT_VENCIMENTO desc");
	
	return $resultado;

}

function retorna_despesas($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT d.*, t.NM_DESPESA as NM_DESPESA FROM tb_despesas d LEFT JOIN tb_tipos_despesas t ON d.CD_DESPESA = t.CD_DESPESA ORDER BY DT_VENCIMENTO desc");
	
	return $resultado;

}

function retorna_despesas_tipo($tipo, $ano, $conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT DISTINCT(d.CD_DESPESA), t.NM_DESPESA as NM_DESPESA FROM tb_despesas d LEFT JOIN tb_tipos_despesas t ON d.CD_DESPESA = t.CD_DESPESA WHERE d.NR_ANO='$ano' and t.NM_TIPO='$tipo' and d.NM_STATUS='Pago' or NM_STATUS='Pago atrasado' ORDER BY NM_DESPESA");
	
	return $resultado;
	
}


function retorna_nome_receita($codigo, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_RECEITA FROM tb_tipos_receitas WHERE CD_RECEITA='$codigo'");
	
	$nome = mysqli_fetch_row($resultado);
	
	return $nome[0];
	
}

function retorna_nome_despesa($codigo, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_DESPESA FROM tb_tipos_despesas WHERE CD_DESPESA='$codigo'");
	
	$nome = mysqli_fetch_row($resultado);
	
	return $nome[0];
	
}

function retorna_tipo_despesa($codigo, $conexao_com_banco) {
	$resultado = mysqli_query($conexao_com_banco, "SELECT CD_DESPESA FROM tb_despesas WHERE ID_DESPESA='$codigo'");
	
	$nome = mysqli_fetch_row($resultado);
	
	return $nome[0];
}

function retorna_valor_receita($codigo,$mes,$ano,$conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT VLR_RECEITA FROM tb_receitas WHERE CD_RECEITA='$codigo' and NR_MES='$mes' and NR_ANO='$ano'");
	
	$valor = mysqli_fetch_row($resultado);
	
	return $valor[0];

}

function retorna_valor_despesa($codigo,$mes,$ano,$conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT sum(VLR_DESPESA) FROM tb_despesas WHERE CD_DESPESA='$codigo' and NR_MES='$mes' and NR_ANO='$ano'");
	
	$valor = mysqli_fetch_row($resultado);
	
	return $valor[0];

}

function retorna_valor_despesa_paga($codigo,$mes,$ano,$conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT sum(VLR_DESPESA) FROM tb_despesas WHERE CD_DESPESA='$codigo' and NR_MES='$mes' and NR_ANO='$ano' and NM_STATUS = 'Pago' or NM_STATUS = 'Pago com atraso'");
	
	$valor = mysqli_fetch_row($resultado);
	
	return $valor[0];

}

function retorna_valor_despesa_paga_descricao($codigo,$descricao,$mes,$ano,$conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT sum(VLR_DESPESA) FROM tb_despesas WHERE CD_DESPESA='$codigo' and DS_DESPESA='$descricao' and NR_MES='$mes' and NR_ANO='$ano' and NM_STATUS = 'Pago' or NM_STATUS = 'Pago com atraso'");
	
	$valor = mysqli_fetch_row($resultado);
	
	return $valor[0];

}

function retorna_descricao_receita($codigo,$mes,$ano,$conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT DS_RECEITA FROM tb_receitas WHERE CD_RECEITA='$codigo' and NR_MES='$mes' and NR_ANO='$ano'");
	
	$descricao = mysqli_fetch_row($resultado);
	
	return $descricao[0];

}

function retorna_descricao_despesa($codigo,$mes,$ano,$conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT DS_DESPESA FROM tb_despesas WHERE CD_DESPESA='$codigo' and NR_MES='$mes' and NR_ANO='$ano'");
	
	$descricao = mysqli_fetch_row($resultado);
	
	return $descricao[0];

}

function retorna_descricoes_despesa($codigo,$ano,$conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT DISTINCT(DS_DESPESA) as DS_DESPESA, CD_DESPESA FROM tb_despesas WHERE CD_DESPESA='$codigo' and NR_ANO='$ano' and NM_STATUS='Pago' or NM_STATUS='Pago atrasado'");
	
	return $resultado;

}

function retorna_meses_valores_despesa_descricao($codigo, $descricao, $ano, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NR_MES, VLR_DESPESA FROM tb_despesas WHERE CD_DESPESA='$codigo' and DS_DESPESA='$descricao' and NR_ANO='$ano'");
	
	return $resultado;
	
}

function retorna_total_receitas_mes_ano($mes, $ano, $conexao_com_banco){
	
	if($mes==1){
		$resultado = mysqli_query($conexao_com_banco, "SELECT SUM(VLR_RECEITA) FROM tb_receitas WHERE NR_MES='$mes' and NR_ANO='$ano'");
	
		$total = mysqli_fetch_row($resultado);
	
		return $total[0];
	
	}else{
		$resultado = mysqli_query($conexao_com_banco, "SELECT SUM(VLR_RECEITA) FROM tb_receitas WHERE NR_MES='$mes' and NR_ANO='$ano'");
	
		$total = mysqli_fetch_row($resultado);
		
		$saldo_mes_anterior = retorna_saldo($mes-1,$ano, $conexao_com_banco);
		
		return $total[0]+$saldo_mes_anterior;
	}
	
	
	
	
}

function retorna_total_despesas_mes_ano_tipo($mes, $ano, $tipo, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT SUM(VLR_DESPESA) AS SOMATORIO FROM tb_despesas,tb_tipos_despesas WHERE tb_despesas.CD_DESPESA = tb_tipos_despesas.CD_DESPESA AND NR_MES='$mes' and NR_ANO='$ano' and NM_TIPO='$tipo' and tb_despesas.NM_STATUS='Pago' or tb_despesas.NM_STATUS='Pago atrasado'");
	
	$total = mysqli_fetch_row($resultado);
	
	return $total[0];
	
	
}

function retorna_total_despesas_mes_ano($mes, $ano, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT SUM(VLR_DESPESA) FROM tb_despesas WHERE NR_MES='$mes' and NR_ANO='$ano' and NM_STATUS='Pago' and NM_status='Pago atrasado'");
	
	$total = mysqli_fetch_row($resultado);
	
	return $total[0];
	
	
}

function retorna_servidor_codigo($cpf, $conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores WHERE CD_SERVIDOR='$cpf'");
	
	return $resultado;
	
}

function retorna_setores($conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_setores");
	
	return $resultado;
	
}

function retorna_nome_setor($setor, $conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_SETOR FROM tb_setores WHERE CD_SETOR='$setor'");
	
	$nome = mysqli_fetch_row($resultado);
	
	return $nome[0];
	
}

function retorna_comunicacao($id, $conexao_com_banco) {

	$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM tb_comunicacao WHERE CD_COMUNICACAO='$id'");

	$result = mysqli_fetch_array($retornoquery);

	return $result;
}	

function retorna_comunicacoes($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_comunicacao WHERE NM_STATUS='Aberta' or NM_STATUS='Submetida' order by DT_PUBLICACAO desc");
	
	return $resultado;
	
}

function retorna_comunicacoes_tipo($item, $status, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_comunicacao WHERE NM_ITEM='$item' and NM_STATUS='$status' order by DT_PUBLICACAO desc");
	
	return $resultado;
	
}

function retorna_comunicacoes_submetidas($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_comunicacao WHERE NM_STATUS='Submetida' order by DT_PUBLICACAO desc");
	
	return $resultado;
	
}

function retorna_servidor($cpf, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores WHERE CD_SERVIDOR='$cpf'");
	
	return $resultado;
	
}


function retorna_nome_servidor($cpf, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_SERVIDOR FROM tb_servidores WHERE CD_SERVIDOR='$cpf'");
	
	if(mysqli_affected_rows($conexao_com_banco)==0){
		return $cpf;
	}else{
		$nome = mysqli_fetch_row($resultado);
	
		return $nome[0];
	}
}


function retorna_sobrenome_servidor($cpf, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT SNM_SERVIDOR FROM tb_servidores WHERE CD_SERVIDOR='$cpf'");
	
	if(mysqli_affected_rows($conexao_com_banco)==0){
		return $cpf;
	}else{
		$nome = mysqli_fetch_row($resultado);
	
		return $nome[0];
	}
}


function retorna_foto_servidor($cpf, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_ARQUIVO_FOTO FROM tb_servidores WHERE CD_SERVIDOR='$cpf'");
	
	$foto = mysqli_fetch_row($resultado);
	
	return $foto[0];
	
}

function retorna_setor_servidor($cpf, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SETOR FROM tb_servidores WHERE CD_SERVIDOR='$cpf'");
	
	$setor = mysqli_fetch_row($resultado);
	
	return $setor[0];
	
}

function retorna_dados_servidor($cpf, $conexao_com_banco) {
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores WHERE CD_SERVIDOR='$cpf'");
	
	$servidor = mysqli_fetch_object($resultado);
	
	return $servidor;
}

function retorna_historico_despesa($despesa, $conexao_com_banco){
	
	$query = "SELECT * FROM tb_historico_despesas WHERE ID_DESPESA='$despesa' order by DT_MENSAGEM desc";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}

function retorna_historico_compra($compra, $conexao_com_banco){
	
	$query = "SELECT * FROM tb_historico_compras WHERE CD_COMPRA='$compra' order by DT_MENSAGEM desc";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}


function retorna_historico_documento($documento, $conexao_com_banco){
	
	$query = "SELECT * FROM tb_historico_documentos WHERE CD_DOCUMENTO='$documento' order by DT_MENSAGEM desc";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}








function retorna_numero_processos_com_servidor($cpf, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE CD_SERVIDOR_LOCALIZACAO='$cpf'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}


function retorna_numero_processos_com_servidor_status($cpf, $status, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE CD_SERVIDOR_LOCALIZACAO='$cpf' AND NM_STATUS='$status'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_com_servidor_situacao2($cpf, $situacao, $situacao2, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE CD_SERVIDOR_LOCALIZACAO='$cpf' AND NM_SITUACAO='$situacao'
	and NM_SITUACAO_FINAL='$situacao2'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_com_servidor_situacao_final($cpf, $situacao, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE CD_SERVIDOR_LOCALIZACAO='$cpf' AND NM_SITUACAO_FINAL='$situacao'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_ativos($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE NM_STATUS!='Arquivado' and NM_STATUS!='Saiu'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}



function retorna_numero_processos($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_setor($setor, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE CD_SETOR_LOCALIZACAO='$setor' and NM_STATUS!='Arquivado' and NM_STATUS!='Saiu'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_setor_mes_ano($setor, $mes, $ano, $conexao_com_banco){
	
	$subordinado = retorna_subordinado($setor, $conexao_com_banco);
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE (CD_SETOR_LOCALIZACAO='$setor' or  
	CD_SETOR_LOCALIZACAO='$subordinado') and NM_STATUS='Ativo' and month(DT_ENTRADA)='$mes' and year(DT_ENTRADA)='$ano'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_porcentagem_processos_ativos_mes_setor($setor, $mes, $ano, $conexao_com_banco){
	
	$subordinado = retorna_subordinado($setor, $conexao_com_banco);
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE NM_STATUS='Ativo' and 
	month(DT_ENTRADA)='$mes' and year(DT_ENTRADA)='$ano'");
	
	$todo = mysqli_fetch_row($resultado);
	
	$resultado2 = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE (CD_SETOR_LOCALIZACAO='$setor' or  
	CD_SETOR_LOCALIZACAO='$subordinado') and NM_STATUS='Ativo' and month(DT_ENTRADA)='$mes' and year(DT_ENTRADA)='$ano'");
	
	$parte = mysqli_fetch_row($resultado2);
	
	$percentual = ($parte[0]/$todo[0]) * 100;
	
	return $percentual;
	
}

function retorna_processos_resolvidos_ano($ano, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE (NM_STATUS='Arquivado' or 
	NM_STATUS='Saiu') and year(DT_ENTRADA)='$ano'");
	
	$quantidade = mysqli_fetch_row($resultado);
	
	return $quantidade[0];
	
}

function retorna_processos_arquivados_ano($ano, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE NM_STATUS='Arquivado' and year(DT_ENTRADA)='$ano'");
	
	$quantidade = mysqli_fetch_row($resultado);
	
	return $quantidade[0];
	
}

function retorna_processos_sairam_ano($ano, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE NM_STATUS='Saiu' and year(DT_ENTRADA)='$ano'");
	
	$quantidade = mysqli_fetch_row($resultado);
	
	return $quantidade[0];
	
}

function retorna_porcentagem_arquivados_ano($ano, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE (NM_STATUS='Arquivado' or 
	NM_STATUS='Saiu') and year(DT_ENTRADA)='$ano'");
	
	$todo = mysqli_fetch_row($resultado);
	
	$resultado2 = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE NM_STATUS='Arquivado' and year(DT_ENTRADA)='$ano'");
	
	$parte = mysqli_fetch_row($resultado2);
	
	$percentual = ($parte[0]/$todo[0]) * 100;
	
	return $percentual;
	
}

function retorna_porcentagem_sairam_ano($ano, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE (NM_STATUS='Arquivado' or 
	NM_STATUS='Saiu') and year(DT_ENTRADA)='$ano'");
	
	$todo = mysqli_fetch_row($resultado);
	
	$resultado2 = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE NM_STATUS='Saiu' and year(DT_ENTRADA)='$ano'");
	
	$parte = mysqli_fetch_row($resultado2);
	
	$percentual = ($parte[0]/$todo[0]) * 100;
	
	return $percentual;
	
}

function retorna_processos_resolvidos_tipo_ano($ano, $tipo, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE (NM_STATUS='Saiu' or NM_STATUS='Arquivado')
	and (year(DT_ENTRADA)='$ano') and (NM_TIPO='$tipo')");
	
	$quantidade = mysqli_fetch_row($resultado);
	
	return $quantidade[0];
	
}

function retorna_porcentagem_resolvidos_tipo_ano($ano, $tipo, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE (NM_STATUS='Saiu' or NM_STATUS='Arquivado')
	and (year(DT_ENTRADA)='$ano')");
	
	$todo = mysqli_fetch_row($resultado);
	
	$resultado2 = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE (NM_STATUS='Saiu' or NM_STATUS='Arquivado')
	and (year(DT_ENTRADA)='$ano') and (NM_TIPO='$tipo')");
	
	$parte = mysqli_fetch_row($resultado2);
	
	$percentual = ($parte[0]/$todo[0]) * 100;
	
	return $percentual;
	
}

function retorna_numero_processos_situacao($situacao, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE NM_SITUACAO='$situacao'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_situacao_ano($ano, $situacao, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE NM_SITUACAO='$situacao'
	and year(DT_ENTRADA)='$ano'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_situacao_final_ano($ano, $situacao, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE NM_SITUACAO_FINAL='$situacao'
	and year(DT_ENTRADA)='$ano'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_setor_situacao_ano($ano, $situacao, $setor, $conexao_com_banco){
	
	$subordinado = retorna_subordinado($setor, $conexao_com_banco);
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE (CD_SETOR_LOCALIZACAO='$setor' 
	or CD_SETOR_LOCALIZACAO='$subordinado') and NM_SITUACAO='$situacao' and year(DT_ENTRADA)='$ano'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_setor_situacao_final_ano($ano, $situacao, $setor,  $conexao_com_banco){
	
	$subordinado = retorna_subordinado($setor, $conexao_com_banco);
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE (CD_SETOR_LOCALIZACAO='$setor' 
	or CD_SETOR_LOCALIZACAO='$subordinado') and NM_SITUACAO_FINAL='$situacao' and year(DT_ENTRADA)='$ano'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_sem_prazo($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE (DT_PRAZO='0000-00-00' or DT_PRAZO_FINAL='0000-00-00') and NM_STATUS='Ativo'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}



function retorna_numero_processos_setor_sem_prazo($setor, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE CD_SETOR_LOCALIZACAO='$setor' and (DT_PRAZO='0000-00-00' or DT_PRAZO_FINAL='0000-00-00') and NM_STATUS='Ativo'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}


function retorna_numero_processos_setor_status($setor, $status, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE CD_SETOR_LOCALIZACAO='$setor' and NM_STATUS='$status'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_situacao_final($situacao, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE NM_SITUACAO_FINAL='$situacao'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_setor_situacao_final($setor, $situacao, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE CD_SETOR_LOCALIZACAO='$setor' and NM_SITUACAO_FINAL='$situacao' and NM_STATUS='Ativo'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_status($status, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE NM_STATUS='$status'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_status_setor($status, $setor, $conexao_com_banco){
	
	$subordinado = retorna_subordinado($setor, $conexao_com_banco);
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE NM_STATUS='$status'
	and (CD_SETOR_LOCALIZACAO='$setor' or CD_SETOR_LOCALIZACAO='$subordinado')");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_porcentagem_processos_status_setor($status, $setor, $conexao_com_banco){
	
	$subordinado = retorna_subordinado($setor, $conexao_com_banco);
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE NM_STATUS='Ativo'");
	
	$todo = mysqli_fetch_row($resultado);
	
	$resultado2 = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE (CD_SETOR_LOCALIZACAO='$setor' or  
	CD_SETOR_LOCALIZACAO='$subordinado') and NM_STATUS='Ativo'");
	
	$parte = mysqli_fetch_row($resultado2);
	
	$percentual = ($parte[0]/$todo[0]) * 100;
	
	return $percentual;
	
}

function retorna_processos_entraram_mes_individual($mes, $ano, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE month(DT_ENTRADA)='$mes' and year(DT_ENTRADA)='$ano'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];

}

function retorna_processos_entraram_mes_acumulado($mes, $ano, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE month(DT_ENTRADA)<='$mes' and year(DT_ENTRADA)='$ano'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];

}

function retorna_processos_sairam_mes_individual($mes, $ano, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE month(DT_SAIDA)='$mes' and year(DT_SAIDA)='$ano'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];

}

function retorna_processos_sairam_mes_acumulado($mes, $ano, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE month(DT_SAIDA)<='$mes' and year(DT_SAIDA)='$ano'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];

}





function retorna_processos_responsavel_data($mes, $ano, $pessoa, $conexao_com_banco){
	
	$query = "SELECT count(*) FROM tb_responsaveis_processos WHERE CD_SERVIDOR = '$pessoa' AND CD_PROCESSO IN 
	(SELECT CD_PROCESSO FROM tb_processos WHERE MONTH(DT_ENTRADA)='$mes' AND YEAR(DT_ENTRADA)='$ano' AND NM_SITUACAO='Concluído' 
	or NM_SITUACAO='Concluído com atraso')";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_processos_concluidos_atraso($mes, $ano, $pessoa, $conexao_com_banco){
	
	$query = "SELECT count(*) FROM tb_responsaveis_processos WHERE CD_SERVIDOR = '$pessoa' AND CD_PROCESSO IN 
	(SELECT CD_PROCESSO FROM tb_processos WHERE MONTH(DT_ENTRADA)='$mes' AND YEAR(DT_ENTRADA)='$ano' AND NM_SITUACAO='Concluído com atraso')";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_processos_concluidos_prazo($mes, $ano, $pessoa, $conexao_com_banco){
	
	$query = "SELECT count(*) FROM tb_responsaveis_processos WHERE CD_SERVIDOR = '$pessoa' AND CD_PROCESSO IN 
	(SELECT CD_PROCESSO FROM tb_processos WHERE MONTH(DT_ENTRADA)='$mes' AND YEAR(DT_ENTRADA)='$ano' AND NM_SITUACAO='Concluído')";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_nota_extra($tabela, $mes, $ano, $servidor, $conexao_com_banco){
	
	$query = "SELECT NR_NOTA_EXTRA FROM $tabela WHERE NR_MES='$mes' and NR_ANO='$ano' and CD_SERVIDOR='$servidor'";
	
	$lista = mysqli_query($conexao_com_banco, $query);
	
	$resultado = mysqli_fetch_array($lista);
	
	$nota = $resultado['NR_NOTA_EXTRA'];
	
	return $nota;
	
}


function retorna_numero_sugestoes_nota($mes, $ano, $cpf, $conexao_com_banco){
	
	$query = "SELECT distinct(tb_documentos.CD_DOCUMENTO) FROM tb_historico_documentos,tb_documentos WHERE 
	tb_historico_documentos.CD_DOCUMENTO = tb_documentos.CD_DOCUMENTO and tb_historico_documentos.NM_ACAO='Sugestão' 
	and tb_documentos.CD_SERVIDOR_CRIACAO='$cpf' and Month(tb_documentos.DT_CRIACAO)='$mes' and Year(tb_documentos.DT_CRIACAO)='$ano'
	and tb_documentos.NM_STATUS='Resolvido'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$sugestoes_consideradas = 0;
		
	while($r = mysqli_fetch_object($resultado)){
		
		$total_sugestao = retorna_numero_sugestoes($r->CD_DOCUMENTO, $conexao_com_banco);
		
		$total_sugestao = $total_sugestao-1;
		
		if($total_sugestao>0){	
			$sugestoes_consideradas = $sugestoes_consideradas + $total_sugestao;
		}
	}
	
	return $sugestoes_consideradas;
	
}


function retorna_numero_sugestoes($documento, $conexao_com_banco){
	
	$query = "SELECT count(tb_historico_documentos.NM_ACAO) FROM tb_historico_documentos,tb_documentos WHERE 
	tb_historico_documentos.CD_DOCUMENTO = tb_documentos.CD_DOCUMENTO and tb_historico_documentos.NM_ACAO='Sugestão' 
	and tb_documentos.CD_DOCUMENTO='$documento'";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];

}

function retorna_quantidade_documentos_com_sugestao($mes, $ano, $cpf, $conexao_com_banco){
	
	$query = "SELECT count(DISTINCT tb_documentos.CD_DOCUMENTO) FROM tb_historico_documentos,tb_documentos WHERE 
	tb_historico_documentos.CD_DOCUMENTO = tb_documentos.CD_DOCUMENTO and tb_historico_documentos.NM_ACAO='Sugestão' 
	and tb_documentos.CD_SERVIDOR_CRIACAO='$cpf' and Month(tb_documentos.DT_CRIACAO)='$mes' and Year(tb_documentos.DT_CRIACAO)='$ano'
	and tb_documentos.NM_STATUS='Resolvido'";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_quantidade_documentos_criados_servidor($mes, $ano, $cpf, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_documentos WHERE month(DT_CRIACAO)='$mes' 
	and year(DT_CRIACAO)='$ano' and CD_SERVIDOR_CRIACAO='$cpf' and NM_STATUS='Resolvido'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_documentos_com_servidor($CPF, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT d.*, s.NM_SERVIDOR as NM_SERVIDOR_CRIACAO, s2.NM_SERVIDOR as NM_SERVIDOR_LOCALIZACAO  FROM tb_documentos d LEFT JOIN tb_servidores s ON d.CD_SERVIDOR_CRIACAO = s.CD_SERVIDOR LEFT JOIN tb_servidores s2 ON d.CD_SERVIDOR_LOCALIZACAO = s2.CD_SERVIDOR  WHERE NM_STATUS!='Resolvido' AND CD_SERVIDOR_LOCALIZACAO='$CPF' ORDER BY NR_PRIORIDADE");
	
	return $resultado;
	
}

function retorna_documentos_criados_servidor($CPF, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT d.*, s.NM_SERVIDOR as NM_SERVIDOR_CRIACAO, s2.NM_SERVIDOR as NM_SERVIDOR_LOCALIZACAO  FROM tb_documentos d LEFT JOIN tb_servidores s ON d.CD_SERVIDOR_CRIACAO = s.CD_SERVIDOR LEFT JOIN tb_servidores s2 ON d.CD_SERVIDOR_LOCALIZACAO = s2.CD_SERVIDOR  WHERE NM_STATUS!='Resolvido' AND CD_SERVIDOR_CRIACAO='$CPF' ORDER BY NR_PRIORIDADE");
	
	return $resultado;
	
}

function retorna_documentos_setor($setor, $conexao_com_banco){
	
	$subordinado = retorna_subordinado($setor, $conexao_com_banco);
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT d.*, s.NM_SERVIDOR AS NM_SERVIDOR_CRIACAO, s2.NM_SERVIDOR AS NM_SERVIDOR_LOCALIZACAO FROM tb_documentos d LEFT JOIN tb_servidores s ON d.CD_SERVIDOR_CRIACAO = s.CD_SERVIDOR LEFT JOIN tb_servidores s2 ON d.CD_SERVIDOR_LOCALIZACAO = s2.CD_SERVIDOR  WHERE NM_STATUS!='Resolvido' AND CD_SETOR_LOCALIZACAO='$setor' or CD_SETOR_LOCALIZACAO='$subordinado' ORDER BY NR_PRIORIDADE");
	
	return $resultado;
	
}

function retorna_documentos($conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT d.*, s.NM_SERVIDOR AS NM_SERVIDOR_CRIACAO, s2.NM_SERVIDOR AS NM_SERVIDOR_LOCALIZACAO  FROM tb_documentos d LEFT JOIN tb_servidores s ON d.CD_SERVIDOR_CRIACAO = s.CD_SERVIDOR LEFT JOIN tb_servidores s2 ON d.CD_SERVIDOR_LOCALIZACAO = s2.CD_SERVIDOR  WHERE NM_STATUS!='Resolvido' ORDER BY NR_PRIORIDADE");
	
	return $resultado;
	
}

function retorna_assiduidades($conexao_com_banco){
	
    $permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_TODOS_ORGAO_INDICE_PRODUTIVIDADE',$conexao_com_banco); 
    	
	if($permissao=='sim'){
	
		$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_assiduidade ORDER BY NR_ANO, NR_MES DESC");	
	
	}else{
		
		$setor = $_SESSION['setor'];
		
		$subordinado = retorna_subordinado($setor, $conexao_com_banco);
			
		$resultado = mysqli_query($conexao_com_banco, 
		"SELECT * FROM tb_assiduidade 
		INNER JOIN tb_servidores
		ON (tb_assiduidade.CD_SERVIDOR=tb_servidores.CD_SERVIDOR)
		WHERE tb_servidores.CD_SETOR='$setor' OR tb_servidores.CD_SETOR='$subordinado' 
		ORDER BY NR_ANO, NR_MES DESC");	 
	
	}
	
	return $resultado;	
	
}

function retorna_cumprimentos_de_prazo($conexao_com_banco){
	
	 $permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_TODOS_ORGAO_INDICE_PRODUTIVIDADE',$conexao_com_banco); 
    	
	if($permissao=='sim'){
	
		$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_cumprimento_prazo ORDER BY NR_ANO, NR_MES DESC");	
	
	}else{
		
		$setor = $_SESSION['setor'];
		
		$subordinado = retorna_subordinado($setor, $conexao_com_banco);
			
		$resultado = mysqli_query($conexao_com_banco, 
		"SELECT * FROM tb_cumprimento_prazo 
		INNER JOIN tb_servidores
		ON (tb_cumprimento_prazo.CD_SERVIDOR=tb_servidores.CD_SERVIDOR)
		WHERE tb_servidores.CD_SETOR='$setor' OR tb_servidores.CD_SETOR='$subordinado' 
		ORDER BY NR_ANO, NR_MES DESC");	 
	
	}
	
	return $resultado;		
	
	
}

function retorna_produtividades($conexao_com_banco){
	
	 $permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_TODOS_ORGAO_INDICE_PRODUTIVIDADE',$conexao_com_banco); 
    	
	if($permissao=='sim'){
	
		$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_produtividade ORDER BY NR_ANO, NR_MES DESC");	
	
	}else{
		
		$setor = $_SESSION['setor'];
		
		$subordinado = retorna_subordinado($setor, $conexao_com_banco);
			
		$resultado = mysqli_query($conexao_com_banco, 
		"SELECT * FROM tb_produtividade 
		INNER JOIN tb_servidores
		ON (tb_produtividade.CD_SERVIDOR=tb_servidores.CD_SERVIDOR)
		WHERE tb_servidores.CD_SETOR='$setor' OR tb_servidores.CD_SETOR='$subordinado' 
		ORDER BY NR_ANO, NR_MES DESC");	 
	
	}
	
	return $resultado;		
	
	
}

function retorna_media_geral($mes, $ano, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT AVG(NR_NOTA) FROM tb_indice_produtividade WHERE NR_MES='$mes' and NR_ANO='$ano'");
	
	$nota = mysqli_fetch_row($resultado);
	
	return $nota[0];
	
}

function retorna_media_geral_setor($mes, $ano, $setor, $conexao_com_banco){
	
	$subordinado = retorna_subordinado($setor, $conexao_com_banco);
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT AVG(NR_NOTA) FROM tb_indice_produtividade, tb_servidores WHERE
    tb_indice_produtividade.CD_SERVIDOR = tb_servidores.CD_SERVIDOR and NR_MES='$mes' and NR_ANO='$ano' and (tb_servidores.CD_SETOR='$setor'
	or tb_servidores.CD_SETOR='$subordinado')");
	
	$nota = mysqli_fetch_row($resultado);
	
	return $nota[0];
	
}

function retorna_quantidade_processo_resolvidos_dias($dia, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM `tb_processos` WHERE NR_DIAS<=$dia and 
	NM_STATUS='Arquivado' or NM_STATUS='Saiu'");
	
	$quantidade = mysqli_fetch_row($resultado);
	
	return $quantidade[0];
	
}

function retorna_media_dias_processo_mes($mes, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT AVG(DATEDIFF(DT_SAIDA,DT_ENTRADA)) FROM `tb_processos` 
	WHERE (MONTH(DT_ENTRADA)=$mes) and (NM_STATUS='Arquivado' or NM_STATUS='Saiu')");
	
	$quantidade = mysqli_fetch_row($resultado);
	
	return $quantidade[0];
	
}

function retorna_servidores_avaliados($conexao_com_banco){
	
	$permissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_TODOS_ORGAO_INDICE_PRODUTIVIDADE',$conexao_com_banco); 
	
	if($permissao=='sim'){
		
		$resultado = mysqli_query($conexao_com_banco, "SELECT distinct NM_SERVIDOR, SNM_SERVIDOR, tb_servidores.CD_SERVIDOR,
		NM_ARQUIVO_FOTO, NM_CARGO FROM permissao,tb_servidores WHERE tb_servidores.CD_SERVIDOR=permissao.CD_SERVIDOR and 
		permissao.SER_AVALIADO_INDICE_PRODUTIVIDADE='sim' order by NM_SERVIDOR");
	
	}else{
		
		$setor = $_SESSION['setor'];
		
		$subordinado = retorna_subordinado($setor, $conexao_com_banco);
			
		$resultado = mysqli_query($conexao_com_banco, "SELECT distinct NM_SERVIDOR, SNM_SERVIDOR, tb_servidores.CD_SERVIDOR,
		NM_ARQUIVO_FOTO, NM_CARGO FROM permissao,tb_servidores WHERE tb_servidores.CD_SERVIDOR=permissao.CD_SERVIDOR and 
		permissao.SER_AVALIADO_INDICE_PRODUTIVIDADE='sim' and tb_servidores.CD_SETOR='$setor' or 
		tb_servidores.CD_SETOR='$subordinado' order by NM_SERVIDOR");	 

	}
	
	return $resultado;	
	
}

function retorna_assiduidade($mes, $ano, $cpf, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_assiduidade WHERE NR_MES='$mes' and NR_ANO='$ano' and CD_SERVIDOR='$cpf'");
	
	return $resultado;	
	
}

function retorna_cumprimento_prazo($mes, $ano, $cpf, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_cumprimento_prazo WHERE NR_MES='$mes' and NR_ANO='$ano' and CD_SERVIDOR='$cpf'");
	
	return $resultado;	
	
}

function retorna_produtividade($mes, $ano, $cpf, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_produtividade WHERE NR_MES='$mes' and NR_ANO='$ano' and CD_SERVIDOR='$cpf'");
	
	return $resultado;	
	
}

function retorna_nota_geral($mes, $ano, $cpf, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NR_NOTA FROM tb_indice_produtividade WHERE NR_MES='$mes' and NR_ANO='$ano' and CD_SERVIDOR='$cpf'");
	
	$nota = mysqli_fetch_row($resultado);
	
	return $nota[0];
	
}

function retorna_subordinado($setor, $conexao_com_banco){
	
	$lista = mysqli_query($conexao_com_banco, "SELECT CD_SETOR_SUBORDINADO FROM tb_setores WHERE CD_SETOR='$setor'");
	
	$resultado = mysqli_fetch_array($lista);
	
	$subordinado = $resultado['CD_SETOR_SUBORDINADO'];

	return $subordinado;

}

function retorna_bens_patrimoniais($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_bem_patrimonial");
	
	return $resultado;	

}

function retorna_rmb($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_rmb");
	
	return $resultado;
	
}

function retorna_compras_andamento_servidor($cpf, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_compras WHERE CD_SERVIDOR_SOLICITANTE='$cpf' and NM_STATUS!='Paga com atraso' and NM_STATUS!='Paga'");
	
	return $resultado;
	
}

function retorna_compras($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_compras");
	
	return $resultado;
	
}

function retira_caracteres_especiais($nome_arquivo){
	
	$nome_arquivo = str_replace(" ","_",$nome_arquivo);
	
	$nome_arquivo = str_replace("á","a",$nome_arquivo);
	$nome_arquivo = str_replace("Á","A",$nome_arquivo);
	$nome_arquivo = str_replace("à","a",$nome_arquivo);
	$nome_arquivo = str_replace("ã","a",$nome_arquivo);
	$nome_arquivo = str_replace("Ã","A",$nome_arquivo);
	$nome_arquivo = str_replace("â","a",$nome_arquivo);
	$nome_arquivo = str_replace("ä","a",$nome_arquivo);
	
	$nome_arquivo = str_replace("é","e",$nome_arquivo);
	$nome_arquivo = str_replace("è","e",$nome_arquivo);
	$nome_arquivo = str_replace("ê","e",$nome_arquivo);
	$nome_arquivo = str_replace("ë","e",$nome_arquivo);
	
	$nome_arquivo = str_replace("í","i",$nome_arquivo);
	$nome_arquivo = str_replace("ì","i",$nome_arquivo);
	$nome_arquivo = str_replace("î","i",$nome_arquivo);
	$nome_arquivo = str_replace("ï","i",$nome_arquivo);
	
	$nome_arquivo = str_replace("ó","o",$nome_arquivo);
	$nome_arquivo = str_replace("ò","o",$nome_arquivo);
	$nome_arquivo = str_replace("õ","o",$nome_arquivo);
	$nome_arquivo = str_replace("ô","o",$nome_arquivo);
	$nome_arquivo = str_replace("ö","o",$nome_arquivo);
	
	$nome_arquivo = str_replace("ú","u",$nome_arquivo);
	$nome_arquivo = str_replace("ù","u",$nome_arquivo);
	$nome_arquivo = str_replace("û","u",$nome_arquivo);
	$nome_arquivo = str_replace("ü","u",$nome_arquivo);
	
	$nome_arquivo = str_replace("ç","c",$nome_arquivo);
	
	$nome_arquivo = str_replace("Á","A",$nome_arquivo);
	$nome_arquivo = str_replace("À","A",$nome_arquivo);
	$nome_arquivo = str_replace("Ã","A",$nome_arquivo);
	$nome_arquivo = str_replace("Â","A",$nome_arquivo);
	$nome_arquivo = str_replace("Ä","A",$nome_arquivo);
	
	$nome_arquivo = str_replace("É","E",$nome_arquivo);
	$nome_arquivo = str_replace("È","E",$nome_arquivo);
	$nome_arquivo = str_replace("Ê","E",$nome_arquivo);
	$nome_arquivo = str_replace("Ë","E",$nome_arquivo);
	
	$nome_arquivo = str_replace("Í","I",$nome_arquivo);
	$nome_arquivo = str_replace("Ì","I",$nome_arquivo);
	$nome_arquivo = str_replace("Î","I",$nome_arquivo);
	$nome_arquivo = str_replace("Ï","I",$nome_arquivo);
	
	$nome_arquivo = str_replace("Ó","O",$nome_arquivo);
	$nome_arquivo = str_replace("Ò","O",$nome_arquivo);
	$nome_arquivo = str_replace("Õ","O",$nome_arquivo);
	$nome_arquivo = str_replace("Ô","O",$nome_arquivo);
	$nome_arquivo = str_replace("Ö","O",$nome_arquivo);
	
	$nome_arquivo = str_replace("Ú","U",$nome_arquivo);
	$nome_arquivo = str_replace("Ù","U",$nome_arquivo);
	$nome_arquivo = str_replace("Û","U",$nome_arquivo);
	$nome_arquivo = str_replace("Ü","U",$nome_arquivo);
	
	$nome_arquivo = str_replace("Ç","C",$nome_arquivo);
	
	return $nome_arquivo;
		
}

function arruma_id($id){
	
	$id = str_replace('.', '', $id);
	$id = str_replace('-', '', $id);
	$id = str_replace(':', '', $id);
	$id = str_replace(' ', '', $id);
	
	return $id;
	
}



function arruma_numero($numero){

  return number_format($numero,2,',','.');

 }


function arruma_data($data){
	
	if($data == null or $data == '0000-00-00' or $data == '0000-00-00 00:00:00'){
		$data = "Sem data";
	}else{
		$data = date("d/m/Y", strtotime($data));
	}

	return $data;

}


function arruma_data_ano($data){
	
	if($data == null or $data == '0000-00-00'){
		$data = "Sem data";
	}else{
		$data = date("Y", strtotime($data));
	}

	return $data;

}

function arruma_data_mes($data){
	
	if($data == null or $data == '0000-00-00'){
		$data = "Sem data";
	}else{
		$data = date("m", strtotime($data));
		if($data == 1){
			$data = "Janeiro";
		}else if($data == 2){
			$data = "Fevereiro";
		}else if($data == 3){
			$data = "Março";
		}else if ($data == 4){
			$data = "Abril";
		}else if ($data == 5){
			$data = "Maio";
		}else if($data == 6){
			$data = "Junho";
		}else if($data == 7){
			$data = "Julho";
		}else if($data == 8){
			$data = "Agosto";
		}else if($data == 9){
			$data = "Setembro";
		}else if($data == 10){
			$data = "Outubro";
		}else if($data == 11){
			$data = "Novembro";
		}else if($data == 12){
			$data = "Dezembro";
		}else{
			$data = "Mês inválido!";
		}
	}

	return $data;

}

function arruma_data_mes2($mes){
	
	if($mes == null or $mes == '0000-00-00'){
		$mes = "Sem data";
	}else{
		
		if($mes == 1){
			$mes = "Janeiro";
		}else if($mes == 2){
			$mes = "Fevereiro";
		}else if($mes == 3){
			$mes = "Março";
		}else if ($mes == 4){
			$mes = "Abril";
		}else if ($mes == 5){
			$mes = "Maio";
		}else if($mes == 6){
			$mes = "Junho";
		}else if($mes == 7){
			$mes = "Julho";
		}else if($mes == 8){
			$mes = "Agosto";
		}else if($mes == 9){
			$mes = "Setembro";
		}else if($mes == 10){
			$mes = "Outubro";
		}else if($mes == 11){
			$mes = "Novembro";
		}else if($mes == 12){
			$mes = "Dezembro";
		}else{
			$mes = "Mês inválido!";
		}
	}

	return $mes;

}

function arruma_numero_mes($data){
	
	
		if($data == 1){
			$data = "Janeiro";
		}else if($data == 2){
			$data = "Fevereiro";
		}else if($data == 3){
			$data = "Março";
		}else if ($data == 4){
			$data = "Abril";
		}else if ($data == 5){
			$data = "Maio";
		}else if($data == 6){
			$data = "Junho";
		}else if($data == 7){
			$data = "Julho";
		}else if($data == 8){
			$data = "Agosto";
		}else if($data == 9){
			$data = "Setembro";
		}else if($data == 10){
			$data = "Outubro";
		}else if($data == 11){
			$data = "Novembro";
		}else if($data == 12){
			$data = "Dezembro";
		}else{
			$data = "Mês inválido!";
		}
	

	return $data;

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

function arruma_data2($data){
	
	if($data == "0000-00-00 00:00:00"){
		$data = "Sem data";
	}else{
		$data = date("d/m/Y H:i:s", strtotime($data));
	}

	return $data;

}

function arruma_CPF($CPF){
	
	$CPF = str_replace('-', '', $CPF);
	$CPF = str_replace('.', '', $CPF);
	
	return $CPF;
	
}

function arruma_classificacao_contabil($classificacao_contabil){
	
    $classificacao_contabil = str_replace('.', '', $classificacao_contabil);
	
	return $classificacao_contabil;
	
}

function arruma_numero_processo($numero_processo){
	
    $numero_processo = str_replace(" ","",$numero_processo);
	
	$numero_processo = str_replace("/","",$numero_processo);
	
	return $numero_processo;
	
}

function atualiza_produtividade($mes, $ano, $conexao_com_banco){
	
	$search = mysqli_query($conexao_com_banco, "SELECT * FROM tb_produtividade WHERE NR_MES='$mes' and NR_ANO='$ano'");
	
	$data_hoje =  date('Y-m-d H:i:s');
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SERVIDOR FROM permissao WHERE SER_AVALIADO_INDICE_PRODUTIVIDADE='sim'");
		
		if(mysqli_num_rows($search) == 0){
			
			while($r = mysqli_fetch_object($resultado)){	
			
				$pessoa = $r->CD_SERVIDOR;
				
				$total_documentos_criados = retorna_quantidade_documentos_criados_servidor($mes, $ano, $pessoa, $conexao_com_banco);
				
				$total_documentos_com_sugestao = retorna_quantidade_documentos_com_sugestao($mes, $ano, $pessoa, $conexao_com_banco);
				
				$total_sugestoes = retorna_numero_sugestoes_nota($mes, $ano, $pessoa, $conexao_com_banco);
				
				$total_sem_sugestao = $total_documentos_criados - $total_documentos_com_sugestao;
					
				if($total_documentos_criados == 0){
					$produtividade = 0;
				}else if($total_sugestoes != 0){
						$sugestoes = $total_sugestoes*0.2;
				$produtividade = 10 - $sugestoes;
				}else{
					$produtividade = 10;
				}
			
		
				$id = 'PRODUTIVIDADE_'.$pessoa.$data_hoje;
				
				$id = str_replace('.', '', $id);
				$id = str_replace('-', '', $id);
				$id = str_replace(':', '', $id);
				$id = str_replace(' ', '', $id);
				
				$produtividade = number_format($produtividade, 1, '.', '.');
				
				if($produtividade > 10){
					$produtividade = 10;
				}

				mysqli_query($conexao_com_banco, "INSERT INTO tb_produtividade (ID, CD_SERVIDOR, NR_MES, NR_ANO, NR_DOCUMENTOS, NR_DOCUMENTOS_SEM_SUGESTAO, NR_DOCUMENTOS_COM_SUGESTAO, NR_NOTA) VALUES ('$id', '$pessoa', '$mes', '$ano', '$total_documentos_criados', '$total_sem_sugestao', '$total_documentos_com_sugestao', '$produtividade')") or die (mysqli_error($conexao_com_banco));
			}
		}else{
			
			while($r = mysqli_fetch_object($resultado)){	
			
				$pessoa = $r->CD_SERVIDOR;
				
				$total_documentos_criados = retorna_quantidade_documentos_criados_servidor($mes, $ano, $pessoa, $conexao_com_banco);
				
				$total_documentos_com_sugestao = retorna_quantidade_documentos_com_sugestao($mes, $ano, $pessoa, $conexao_com_banco);
				
				$total_sugestoes = retorna_numero_sugestoes_nota($mes, $ano, $pessoa, $conexao_com_banco);
					
				$total_sem_sugestao = $total_documentos_criados - $total_documentos_com_sugestao;
					
				if($total_documentos_criados == 0){
					$produtividade = 0;
				}else if($total_sugestoes != 0){
					$sugestoes = $total_sugestoes*0.25;
					$produtividade = 10 - $sugestoes;
				}else{
					$produtividade = 10;
				}
			
				$nota_extra = retorna_nota_extra('tb_produtividade', $mes, $ano, $pessoa, $conexao_com_banco);	
				
				$produtividade = $produtividade+$nota_extra;
				
				if($produtividade > 10){
					$produtividade = 10;
				}
				
				mysqli_query($conexao_com_banco, "UPDATE tb_produtividade SET NR_DOCUMENTOS='$total_documentos_criados', NR_DOCUMENTOS_SEM_SUGESTAO='$total_sem_sugestao', NR_DOCUMENTOS_COM_SUGESTAO='$total_documentos_com_sugestao', NR_NOTA='$produtividade' WHERE CD_SERVIDOR='$pessoa' and NR_MES='$mes' and NR_ANO='$ano'")	or die (mysqli_error($conexao_com_banco));
			}
		
	}
	
}

function atualiza_cumprimento_prazo($mes, $ano, $conexao_com_banco){
	
	$search = mysqli_query($conexao_com_banco, "SELECT * FROM tb_cumprimento_prazo WHERE NR_MES='$mes' and NR_ANO='$ano'");
	
	$data_hoje =  date('Y-m-d H:i:s');
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SERVIDOR FROM permissao WHERE SER_AVALIADO_INDICE_PRODUTIVIDADE='sim'");
	
	if(mysqli_num_rows($search) == 0){
		
			while($r = mysqli_fetch_object($resultado)){	
			
				$pessoa = $r->CD_SERVIDOR;
			
				$total_processos = retorna_processos_responsavel_data($mes, $ano, $pessoa, $conexao_com_banco);
				
				$total_processos_concluidos_prazo = retorna_processos_concluidos_prazo($mes, $ano, $pessoa, $conexao_com_banco);
			
				$total_processos_concluidos_atraso = $total_processos - $total_processos_concluidos_prazo;
				
				if($total_processos_concluidos_prazo == 0){
					$cumprimento_prazo = 0;
				}else{
					$cumprimento_prazo = (($total_processos_concluidos_prazo)/($total_processos))*10;
				}
	
				$id = 'CUMPRIMENTO_PRAZO_'.$pessoa.$data_hoje;
				
				$id = str_replace('.', '', $id);
				$id = str_replace('-', '', $id);
				$id = str_replace(':', '', $id);
				$id = str_replace(' ', '', $id);
				
				$cumprimento_prazo = number_format($cumprimento_prazo, 1, '.', '.');
				
				if($cumprimento_prazo > 10){
					$cumprimento_prazo = 10;
				}

				mysqli_query($conexao_com_banco, "INSERT INTO tb_cumprimento_prazo (ID, CD_SERVIDOR, NR_MES, NR_ANO, NR_PROCESSOS, 	NR_PROCESSOS_CONCLUIDOS, NR_PROCESSOS_CONCLUIDOS_ATRASO, NR_NOTA) VALUES ('$id', '$pessoa', '$mes', '$ano', '$total_processos', '$total_processos_concluidos_prazo', '$total_processos_concluidos_atraso', '$cumprimento_prazo')") or die (mysqli_error($conexao_com_banco));
			}
		}else{
			
			while($r = mysqli_fetch_object($resultado)){	
			
				$pessoa = $r->CD_SERVIDOR;
			
				$total_processos = retorna_processos_responsavel_data($mes, $ano, $pessoa, $conexao_com_banco);
				
				$total_processos_concluidos_prazo = retorna_processos_concluidos_prazo($mes, $ano, $pessoa, $conexao_com_banco);
				
				$total_processos_concluidos_atraso = $total_processos - $total_processos_concluidos_prazo;
			
				if($total_processos_concluidos_prazo == 0){
					$cumprimento_prazo = 0;
				}else{
					$cumprimento_prazo = (($total_processos_concluidos_prazo)/($total_processos))*10;
				}
				
				$nota_extra = retorna_nota_extra('tb_cumprimento_prazo', $mes, $ano, $pessoa, $conexao_com_banco);	
				
				$cumprimento_prazo = $cumprimento_prazo+$nota_extra;
				
				if($cumprimento_prazo > 10){
					$cumprimento_prazo = 10;
				}
				
				mysqli_query($conexao_com_banco, "UPDATE tb_cumprimento_prazo SET NR_PROCESSOS='$total_processos', NR_PROCESSOS_CONCLUIDOS='$total_processos_concluidos_prazo', NR_PROCESSOS_CONCLUIDOS_ATRASO='$total_processos_concluidos_atraso', NR_NOTA='$cumprimento_prazo' WHERE CD_SERVIDOR='$pessoa' and NR_MES='$mes' and NR_ANO='$ano'")	or die (mysqli_error($conexao_com_banco));
		}
	}

}


function atualiza_nota_geral($mes, $ano, $conexao_com_banco){
	
	$search = mysqli_query($conexao_com_banco, "SELECT * FROM tb_indice_produtividade WHERE NR_MES='$mes' and NR_ANO='$ano'");
	
	$data_hoje =  date('Y-m-d H:i:s');
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SERVIDOR FROM permissao WHERE SER_AVALIADO_INDICE_PRODUTIVIDADE='sim'");
	
	if(mysqli_num_rows($search) == 0){
		
			while($r = mysqli_fetch_object($resultado)){	
				
			$pessoa = $r->CD_SERVIDOR;
		
			$resultado_assiduidade = retorna_assiduidade($mes, $ano, $r->CD_SERVIDOR, $conexao_com_banco);
			$result = mysqli_fetch_array($resultado_assiduidade);
			$nota_assiduidade = $result['NR_NOTA'];
			
			$resultado_cumprimento = retorna_cumprimento_prazo($mes, $ano, $r->CD_SERVIDOR, $conexao_com_banco); 
			$result = mysqli_fetch_array($resultado_cumprimento);
			$nota_cumprimento = $result['NR_NOTA'];	
			
			$resultado_produtividade = retorna_produtividade($mes, $ano, $r->CD_SERVIDOR, $conexao_com_banco); 
			$result = mysqli_fetch_array($resultado_produtividade);
			$nota_produtividade = $result['NR_NOTA'];
					
			$nota_geral = ($nota_assiduidade + $nota_cumprimento + $nota_produtividade)/3;
	
		
			$id = 'INDICE_PRODUTIVIDADE_'.$pessoa.$data_hoje;
			
			$id = str_replace('.', '', $id);
			$id = str_replace('-', '', $id);
			$id = str_replace(':', '', $id);
			$id = str_replace(' ', '', $id);
			
			$nota_geral = number_format($nota_geral, 1, '.', '.');

			mysqli_query($conexao_com_banco, "INSERT INTO tb_indice_produtividade (ID, CD_SERVIDOR, NR_MES, NR_ANO,  NR_NOTA) 
			VALUES ('$id', '$pessoa', '$mes', '$ano', '$nota_geral')") or die (mysqli_error($conexao_com_banco));
		}
	}else{
		
			while($r = mysqli_fetch_object($resultado)){	
				
				$pessoa = $r->CD_SERVIDOR;
			
				$resultado_assiduidade = retorna_assiduidade($mes, $ano, $r->CD_SERVIDOR, $conexao_com_banco);
				$result = mysqli_fetch_array($resultado_assiduidade);
				$nota_assiduidade = $result['NR_NOTA'];
				
				$resultado_cumprimento = retorna_cumprimento_prazo($mes, $ano, $r->CD_SERVIDOR, $conexao_com_banco); 
				$result = mysqli_fetch_array($resultado_cumprimento);
				$nota_cumprimento = $result['NR_NOTA'];	
				
				$resultado_produtividade = retorna_produtividade($mes, $ano, $r->CD_SERVIDOR, $conexao_com_banco); 
				$result = mysqli_fetch_array($resultado_produtividade);
				$nota_produtividade = $result['NR_NOTA'];
						
				$nota_geral = ($nota_assiduidade + $nota_cumprimento + $nota_produtividade)/3;
				
			
			
				mysqli_query($conexao_com_banco, "UPDATE tb_indice_produtividade SET NR_NOTA='$nota_geral' WHERE NR_MES='$mes' 
				and NR_ANO='$ano' and CD_SERVIDOR='$pessoa'") or die (mysqli_error($conexao_com_banco));
		}
	}

}


function atualiza_nota_geral_servidor($mes, $ano, $servidor, $conexao_com_banco){
			
	$resultado_assiduidade = retorna_assiduidade($mes, $ano, $servidor, $conexao_com_banco);
	$result = mysqli_fetch_array($resultado_assiduidade);
	$nota_assiduidade = $result['NR_NOTA'];
		
	$resultado_cumprimento = retorna_cumprimento_prazo($mes, $ano, $servidor, $conexao_com_banco); 
	$result = mysqli_fetch_array($resultado_cumprimento);
	$nota_cumprimento = $result['NR_NOTA'];	
				
	$resultado_produtividade = retorna_produtividade($mes, $ano, $servidor, $conexao_com_banco); 
	$result = mysqli_fetch_array($resultado_produtividade);
	$nota_produtividade = $result['NR_NOTA'];
						
	$nota_geral = ($nota_assiduidade + $nota_cumprimento + $nota_produtividade)/3;
				
	mysqli_query($conexao_com_banco, "UPDATE tb_indice_produtividade SET NR_NOTA='$nota_geral' WHERE NR_MES='$mes' 
	and NR_ANO='$ano' and CD_SERVIDOR='$servidor'") or die (mysqli_error($conexao_com_banco));
	
}	

function verifica_prazo($conexao_com_banco){
	
	$data_hoje = date('Y-m-d');
	
	$query = "SELECT * FROM tb_processos WHERE NM_STATUS='Ativo'";
	   
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	while($r = mysqli_fetch_object($resultado)){ 
	
		$processo = $r->CD_PROCESSO;
		
		if($data_hoje <= $r->DT_PRAZO and $r->DT_PRAZO != '0000-00-00' and $r->NM_SITUACAO!='Concluído' and $r->NM_SITUACAO!='Concluído com atraso'){
			
			mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NM_SITUACAO='Análise em andamento' WHERE CD_PROCESSO='$processo'");
		
		}else if($data_hoje > $r->DT_PRAZO and $r->DT_PRAZO != '0000-00-00' and $r->NM_SITUACAO!='Concluído' and $r->NM_SITUACAO!='Concluído com atraso'){
			
			mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NM_SITUACAO='Análise em atraso' WHERE CD_PROCESSO='$processo'");
			
		}

	}
	
}

function verifica_prazo_final($conexao_com_banco){
	
	$data_hoje = date('Y-m-d');
	
	$query = "SELECT * FROM tb_processos WHERE NM_STATUS='Ativo'";
	   
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	while($r = mysqli_fetch_object($resultado)){ 
	
		$processo = $r->CD_PROCESSO;
		
		if($data_hoje <= $r->DT_PRAZO_FINAL and $r->DT_PRAZO_FINAL != '0000-00-00' and $r->NM_SITUACAO_FINAL!='Finalizado' and $r->NM_SITUACAO_FINAL!='Finalizado com atraso'){
			
			mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NM_SITUACAO_FINAL='Finalização em andamento' WHERE CD_PROCESSO='$processo'");
		
		}else if($data_hoje > $r->DT_PRAZO_FINAL and $r->DT_PRAZO_FINAL != '0000-00-00' and $r->NM_SITUACAO_FINAL!='Finalizado' and $r->NM_SITUACAO_FINAL!='Finalizado com atraso'){
			
			mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NM_SITUACAO_FINAL='Finalização em atraso' WHERE CD_PROCESSO='$processo'");
			
		}

	}
	
}

function atualiza_dias($conexao_com_banco){
	
		mysqli_query($conexao_com_banco, "UPDATE tb_processos SET NR_DIAS=DATEDIFF(CURDATE(), DT_ENTRADA) WHERE NM_STATUS!='Arquivado'
		and NM_STATUS!='Saiu'");
	
}

function verifica_caixa($conexao_com_banco){
	
	$ano = date('Y');
	
	$search = mysqli_query($conexao_com_banco, "SELECT * FROM tb_caixa WHERE NR_ANO = '$ano'");
	
	if(mysqli_num_rows($search) == 0){
		for($i=1;$i<13;$i++){
			mysqli_query($conexao_com_banco, "INSERT INTO tb_caixa VALUES ('A', '$ano', '$i', '0')");
		}		
	}
}


//retirada de http://codigofonte.uol.com.br/codigos/funcao-que-calcula-os-feriados-brasileiros-em-php
function dias_feriados($ano = null)
{
	if ($ano === null)
	{
	$ano = intval(date('Y'));
	}

	$pascoa     = easter_date($ano); // Limite de 1970 ou após 2037 da easter_date PHP consulta http://www.php.net/manual/pt_BR/function.easter-date.php
	$dia_pascoa = date('j', $pascoa);
	$mes_pascoa = date('n', $pascoa);
	$ano_pascoa = date('Y', $pascoa);

	$feriados = array(
	// Tatas Fixas dos feriados Nacionail Basileiras
	mktime(0, 0, 0, 1,  1,   $ano), // Confraternização Universal - Lei nº 662, de 06/04/49
	mktime(0, 0, 0, 4,  21,  $ano), // Tiradentes - Lei nº 662, de 06/04/49
	mktime(0, 0, 0, 5,  1,   $ano), // Dia do Trabalhador - Lei nº 662, de 06/04/49
	mktime(0, 0, 0, 9,  7,   $ano), // Dia da Independência - Lei nº 662, de 06/04/49
	mktime(0, 0, 0, 10,  12, $ano), // N. S. Aparecida - Lei nº 6802, de 30/06/80
	mktime(0, 0, 0, 11,  2,  $ano), // Todos os santos - Lei nº 662, de 06/04/49
	mktime(0, 0, 0, 11, 15,  $ano), // Proclamação da republica - Lei nº 662, de 06/04/49
	mktime(0, 0, 0, 12, 25,  $ano), // Natal - Lei nº 662, de 06/04/49

	// These days have a date depending on easter
	mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 48,  $ano_pascoa),//2ºferia Carnaval
	mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 47,  $ano_pascoa),//3ºferia Carnaval	
	mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 2 ,  $ano_pascoa),//6ºfeira Santa  
	mktime(0, 0, 0, $mes_pascoa, $dia_pascoa     ,  $ano_pascoa),//Pascoa
	mktime(0, 0, 0, $mes_pascoa, $dia_pascoa + 60,  $ano_pascoa),//Corpus Cirist
	);

	sort($feriados);

	return $feriados;
}


function retorna_data($data, $dia) {
	$nova_data = '';
	$mudar_data = '-';
	if (cal_days_in_month(CAL_GREGORIAN, date('m',$data), date('Y', $data)) < $dia){
		
		$nova_data = strtotime( date("Y",$data).'-'.date("m",$data).'-'.cal_days_in_month(CAL_GREGORIAN, date('m',$data),date('Y', $data)));
	} else {
		$nova_data = strtotime( date("Y",$data).'-'.date("m",$data).'-'.$dia);	
	}	
	$i = 0;
	for($i = 0; $i < 5 && ( date('w', $nova_data) == 0 || date('w', $nova_data) == 6 || in_array($nova_data, dias_feriados($ano_))); $i++ )
	{
		if (date('d', $nova_data) == 1) {
			$mudar_data = '+';
		}
		$nova_data = strtotime($mudar_data."1 day", $nova_data);
		
	}
	return $nova_data;
}

function retorna_permissoes_servidor($servidor, $conexao_com_banco) {
	
	$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM permissao WHERE CD_SERVIDOR='$servidor'");

	$permissoes = mysqli_fetch_fields($retornoquery);
	
	return $permissoes;
}

function retorna_saldo($mes,$ano,$conexao_com_banco){
	
		$retornoquery = mysqli_query($conexao_com_banco, "SELECT VLR_CAIXA FROM tb_caixa WHERE NR_MES='$mes' and NR_ANO='$ano'");
		
		$saldo = mysqli_fetch_row($retornoquery);
		
		return $saldo[0];
	
	
}

function retorna_superitendente_setor($setor, $conexao_com_banco) {
	$setor = str_replace('SUP-','',$setor);
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores WHERE NM_CARGO='Superintendente' AND CD_SETOR='$setor' OR CD_SETOR='SUP-$setor'") or die (mysqli_error($conexao_com_banco));
	
	$superintendente = mysqli_fetch_object($resultado);
	
	return $superintendente;
	
}

function atualizar_status_tramitacao($cd_tramitacao, $status, $cd_servidor, $conexao_com_banco) {
	$data_confirmacao = date('Y-m-d H:i:s'); 
	$retorno = mysqli_query($conexao_com_banco, "UPDATE `tb_tramitacao_processos` SET RECEBIDO = '$status', DT_CONFIRMACAO = '$data_confirmacao', CD_SERVIDOR_CONFIRMOU = '$cd_servidor' WHERE ID = '$cd_tramitacao'");
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
		

?>