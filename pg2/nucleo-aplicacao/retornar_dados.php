<?php

ini_set('max_execution_time', 1000);

date_default_timezone_set('America/Bahia');

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

function retorna_saldo($mes,$ano,$conexao_com_banco){
	
		$total_receitas = retorna_total_receitas_mes_ano($mes, $ano, $conexao_com_banco);
		
		$total_despesas = retorna_total_despesas_mes_ano($mes ,$ano, $conexao_com_banco);
		
		$saldo = $total_receitas - $total_despesas;
		
		return $saldo;
	
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

function retorna_receitas($ano, $conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT DISTINCT(CD_RECEITA) FROM tb_receitas WHERE NR_ANO='$ano'");
	
	return $resultado;
	
}

function retorna_receitas_ano($ano, $conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_receitas WHERE NR_ANO='$ano' order by NR_MES");
	
	return $resultado;
	
}

function retorna_despesas($ano,$conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_despesas WHERE NR_ANO='$ano' AND NM_STATUS!='Pago' and NM_STATUS!='Recusado' ORDER BY DT_VENCIMENTO desc");
	
	return $resultado;

}

function retorna_despesas_todos($ano,$conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_despesas WHERE NR_ANO='$ano' ORDER BY DT_VENCIMENTO desc");
	
	return $resultado;

}

function retorna_despesas_tipo($tipo, $ano, $conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT DISTINCT(tb_despesas.CD_DESPESA) FROM tb_despesas, tb_tipos_despesas WHERE tb_despesas.CD_DESPESA = tb_tipos_despesas.CD_DESPESA and NR_ANO='$ano' and NM_TIPO='$tipo' and NM_STATUS='Pago' ORDER BY NM_DESPESA");
	
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
	$resultado = mysqli_query($conexao_com_banco, "SELECT CD_DESPESA FROM tb_despesas WHERE ID='$codigo'");
	
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
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT sum(VLR_DESPESA) FROM tb_despesas WHERE CD_DESPESA='$codigo' and NR_MES='$mes' and NR_ANO='$ano' and NM_STATUS = 'Pago'");
	
	$valor = mysqli_fetch_row($resultado);
	
	return $valor[0];

}

function retorna_descricao_receita($codigo,$mes,$ano,$conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT DS_RECEITA FROM tb_receitas WHERE CD_RECEITA='$codigo' and NR_MES='$mes' and NR_ANO='$ano'");
	
	$descricao = mysqli_fetch_row($resultado);
	
	return $descricao[0];

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
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT SUM(VLR_DESPESA) AS SOMATORIO FROM tb_despesas,tb_tipos_despesas WHERE tb_despesas.CD_DESPESA = tb_tipos_despesas.CD_DESPESA AND NR_MES='$mes' and NR_ANO='$ano' and NM_TIPO='$tipo' and tb_despesas.NM_STATUS='Pago'");
	
	$total = mysqli_fetch_row($resultado);
	
	return $total[0];
	
	
}

function retorna_total_despesas_mes_ano($mes, $ano, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT SUM(VLR_DESPESA) FROM tb_despesas WHERE NR_MES='$mes' and NR_ANO='$ano' and NM_STATUS='Pago'");
	
	$total = mysqli_fetch_row($resultado);
	
	return $total[0];
	
	
}

function retorna_servidor_codigo($cpf, $conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores WHERE CD_SERVIDOR='$cpf'");
	
	return $resultado;
	
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

function retorna_setores($conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_setores");
	
	return $resultado;
	
}

function retorna_nome_setor($setor, $conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_SETOR FROM tb_setores WHERE CD_SETOR='$setor'");
	
	$nome = mysqli_fetch_row($resultado);
	
	return $nome[0];
	
}

function retorna_comunicacoes($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_comunicacao WHERE NM_STATUS='Aberta' or NM_STATUS='Submetida' order by DT_PUBLICACAO desc");
	
	return $resultado;
	
}

function retorna_comunicacao($item, $status, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_comunicacao WHERE NM_ITEM='$item' and NM_STATUS='$status' order by DT_PUBLICACAO desc");
	
	return $resultado;
	
}

function retorna_comunicacoes_submetidas($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_comunicacao WHERE NM_STATUS='Submetida' order by DT_PUBLICACAO desc");
	
	return $resultado;
	
}

function retorna_anexos($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_anexos WHERE CD_REFERENTE='$id'");
	
	return $resultado;
	
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

function retorna_nome_anexo($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_ARQUIVO FROM tb_anexos WHERE ID='$id'");
	
	$nome = mysqli_fetch_row($resultado);
	
	return $nome[0];

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

function retorna_servidor($cpf, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores WHERE CD_SERVIDOR='$cpf'");
	
	return $resultado;
	
}


function retorna_nome_servidor($cpf, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_SERVIDOR FROM tb_servidores WHERE CD_SERVIDOR='$cpf'");
	
	$nome = mysqli_fetch_row($resultado);
	
	return $nome[0];
	
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

function retorna_historico_chamado($chamado, $conexao_com_banco){
	
	$query = "SELECT * FROM tb_historico_chamados WHERE CD_CHAMADO='$chamado' order by DT_MENSAGEM desc";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
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



function retorna_processos_com_servidor($CPF, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_processos WHERE CD_SERVIDOR_LOCALIZACAO='$CPF' and NM_STATUS='Ativo' ORDER BY DT_PRAZO");
	
	return $resultado;
	
}

function retorna_processos_setor($setor, $conexao_com_banco){
	
	$subordinado = retorna_subordinado($setor, $conexao_com_banco);
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_processos WHERE CD_SETOR_LOCALIZACAO='$setor' 
	or CD_SETOR_LOCALIZACAO='$subordinado' and NM_STATUS='Ativo' ORDER BY DT_PRAZO");
	
	return $resultado;
	
}

function retorna_numero_processos_com_servidor($cpf, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE CD_SERVIDOR_LOCALIZACAO='$cpf' and NM_STATUS='Ativo'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}


function retorna_numero_processos_com_servidor_situacao($cpf, $situacao, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE CD_SERVIDOR_LOCALIZACAO='$cpf' AND NM_SITUACAO='$situacao'");
	
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


function retorna_processos_status($status, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_processos WHERE NM_STATUS='$status' ORDER BY DT_SAIDA desc");
	
	return $resultado;
	
}

function retorna_numero_processos($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_setor($setor, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE CD_SETOR_LOCALIZACAO='$setor' and NM_STATUS='Ativo'");
	
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

function retorna_numero_processos_setor_situacao($setor, $situacao, $conexao_com_banco){
	
	$subordinado = retorna_subordinado($setor, $conexao_com_banco);
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE (CD_SETOR_LOCALIZACAO='$setor' 
	or CD_SETOR_LOCALIZACAO='$subordinado') and NM_SITUACAO='$situacao'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_situacao_final($situacao, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE NM_SITUACAO_FINAL='$situacao'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_setor_situacao_final($setor, $situacao, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_processos WHERE CD_SETOR_LOCALIZACAO='$setor' and NM_SITUACAO_FINAL='$situacao'");
	
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


function retorna_responsaveis_processo($processo, $conexao_com_banco){
		
	$query = "SELECT tb_servidores.CD_SERVIDOR, tb_servidores.NM_SERVIDOR FROM tb_servidores, tb_responsaveis_processos WHERE tb_servidores.CD_SERVIDOR = tb_responsaveis_processos.CD_SERVIDOR and CD_PROCESSO='$processo'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
		
	return $resultado;
	
}

function retorna_documentos_processo($processo, $conexao_com_banco){
		
	$query = "SELECT * FROM tb_documentos WHERE CD_PROCESSO='$processo'";
	
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

function retorna_servidores_tramitar($estacom, $conexao_com_banco){
		
	$query = "SELECT tb_servidores.CD_SERVIDOR, tb_servidores.NM_SERVIDOR, tb_servidores.SNM_SERVIDOR 
	FROM tb_servidores, permissao WHERE tb_servidores.CD_SERVIDOR=permissao.CD_SERVIDOR
    and permissao.DESTINO_PROCESSO='sim' and tb_servidores.CD_SERVIDOR!='".$estacom."' order by
	tb_servidores.NM_SERVIDOR";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
		
	return $resultado;
	
}

function retorna_podem_ser_responsaveis($processo, $conexao_com_banco){
	
	$cpf = $_SESSION['CPF'];
		
	$query = "SELECT tb_servidores.NM_SERVIDOR, tb_servidores.SNM_SERVIDOR, tb_servidores.CD_SERVIDOR
	FROM tb_servidores, permissao WHERE tb_servidores.CD_SERVIDOR = permissao.CD_SERVIDOR and permissao.SER_RESPONSAVEL_PROCESSO='sim'
	and tb_servidores.CD_SERVIDOR not in(SELECT CD_SERVIDOR FROM tb_responsaveis_processos WHERE CD_PROCESSO='$processo') order by
	tb_servidores.NM_SERVIDOR";

	$resultado = mysqli_query($conexao_com_banco, $query);
		
	return $resultado;
	
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
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE CD_SERVIDOR_LOCALIZACAO='$CPF' ORDER BY DT_PRAZO");
	
	return $resultado;
	
}

function retorna_documentos_criados_servidor($CPF, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE CD_SERVIDOR_CRIACAO='$CPF' and NM_STATUS!='Resolvido' ORDER BY DT_PRAZO");
	
	return $resultado;
	
}

function retorna_documentos_setor($setor, $conexao_com_banco){
	
	$subordinado = retorna_subordinado($setor, $conexao_com_banco);
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE CD_SETOR_LOCALIZACAO='$setor' 
	or CD_SETOR_LOCALIZACAO='$subordinado' and NM_STATUS!='Resolvido' ORDER BY DT_PRAZO");
	
	return $resultado;
	
}

function retorna_documentos($conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE NM_STATUS!='Resolvido' ORDER BY DT_PRAZO");
	
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

function retorna_existe_compra_processo($processo, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_STATUS FROM tb_compras WHERE CD_PROCESSO='$processo'");
	
	$status = mysqli_fetch_row($resultado);
	
	return $status[0];
	
}

?>