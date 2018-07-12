<?php

ini_set('max_execution_time', 1000);

date_default_timezone_set('America/Bahia');

function retorna_servidores_fornecem($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT SOCIOS.NR_CPF, SOCIOS.NO_PESSOA, SERVIDORES.DESC_ORGAO, VINCULOS.NR_CGC, EMPENHOS.NOME_FAVORECIDO, VINCULOS.NO_VINCULO, EMPENHOS.VALOR, EMPENHOS.ORGAO_DESCRICAO
	FROM socios AS SOCIOS

	INNER JOIN vinculos AS VINCULOS ON (SOCIOS.NR_CPF = VINCULOS.NR_CPF)
	INNER JOIN servidores AS SERVIDORES ON (VINCULOS.NR_CPF = SERVIDORES.CPF_SERVIDOR)
	INNER JOIN empenhado_derivada AS EMPENHOS ON (VINCULOS.NR_CGC = EMPENHOS.CNPJ_FAVORECIDO)

	WHERE VINCULOS.NO_VINCULO IN ('SOCIO ADMINISTRADOR', 'SOCIO GERENTE')	
	AND SERVIDORES.DESC_SITUACAO IN 
	('CESSAO COM ONUS', 'ABONO FAMILIA', 'LICENCA SEM REMUNERACAO', 'AFASTAMENTO SEM ONUS', 'CESSAO SEM ONUS', 'LICENCA COM REMUNERACAO',
	'ATIVO', 'AUXILIO MATERNIDADE', 'EX-DIRETOR ARSAL', 'CADASTRO PENDENTE', 
	'PREVIDENCIA DE ORIGEM', 'AFASTAMENTO COM ONUS', 'CASSACAO DA APOSENTADORIA')");
	
	return $resultado;
	
}

function retorna_fracionamento_despesas($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT ORGAO_DESCRICAO, DESCRICAO_NATUREZA, ROUND(SUM(VALOR),2) AS VALOR
	FROM empenhado_derivada 
	WHERE TIPO_LICITACAO IN ('05', '06')
	GROUP BY ORGAO_DESCRICAO, DESCRICAO_NATUREZA
	HAVING SUM(VALOR) > 8000
	ORDER BY VALOR DESC");
	
	return $resultado;
	
}

function retorna_empresas_forneceram_ceisAL($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT CNPJ_FAVORECIDO, NOME_FAVORECIDO, DATA_REGISTRO, VALOR FROM empenhado_derivada inner join emp_inidoneas_al ON CNPJ_FAVORECIDO = CNPJ_CPF AND DATA_REGISTRO BETWEEN DATA_INICIAL AND DATA_FINAL");
	
	return $resultado;
	
}

function retorna_empresas_forneceram_ceisBR($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT CNPJ_FAVORECIDO, NOME_FAVORECIDO, DATA_REGISTRO, VALOR FROM empenhado_derivada inner join emp_inidoneas_br ON CNPJ_FAVORECIDO = CPF_CNPJ_SANCIONADO AND DATA_REGISTRO BETWEEN DATA_INICIO_SANCAO AND DATA_FINAL_SANCAO");
	
	return $resultado;
	
}

function retorna_total_fracionado($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT ORGAO_DESCRICAO, DESCRICAO_NATUREZA, ROUND(SUM(VALOR),2) AS VALOR
	FROM empenhado_derivada 
	WHERE TIPO_LICITACAO IN ('05', '06')
	GROUP BY ORGAO_DESCRICAO, DESCRICAO_NATUREZA
	HAVING SUM(VALOR) > 8000
	ORDER BY VALOR DESC");
	
	$somatorio = 0;
	
	while($r = mysqli_fetch_object($resultado)){
		
		$somatorio = $somatorio + $r->VALOR;
		
	}
	
	return $somatorio;
	
	
	
}

function retorna_quantidade_empresas_inidoneas_br($conexao_com_banco){
	
	$query = "SELECT COUNT(DISTINCT(CNPJ_FAVORECIDO)) FROM empenhado_derivada inner join emp_inidoneas_br ON CNPJ_FAVORECIDO = CPF_CNPJ_SANCIONADO AND DATA_REGISTRO BETWEEN DATA_INICIO_SANCAO AND DATA_FINAL_SANCAO";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_quantidade_empresas_inidoneas_al($conexao_com_banco){
	
	$query = "SELECT COUNT(DISTINCT(CNPJ_FAVORECIDO)) FROM empenhado_derivada inner join emp_inidoneas_al ON CNPJ_FAVORECIDO = CNPJ_CPF AND DATA_REGISTRO BETWEEN DATA_INICIAL AND DATA_FINAL";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_empresas_mesmo_endereco($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NR_CEP, DS_LOGRADOURO, DS_NUMERO, NO_BAIRRO, COUNT(*) AS QUANTIDADE FROM empresas GROUP BY NR_CEP, DS_LOGRADOURO, DS_NUMERO, NO_BAIRRO HAVING COUNT(*) > 1 ORDER BY NR_CEP");
	
	return $resultado;
	
	
	
}



?>