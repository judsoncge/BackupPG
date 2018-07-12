<?php
include('../banco-dados/conectar.php');
include('../funcoes.php');
session_start();


function verificar($map, $linha) {	
	if ($linha -> SETOR_ORIGEM == 'GAB' && ($linha -> CARGO_DESTINO == 'Assessor Técnico' || $linha -> CARGO_DESTINO == 'Superintendente') ) {
				$map['DT_ENTRADA_SETOR'] = $linha -> DT;
				$map['SETOR_RESPONSAVEL'] =  str_replace('SUP-','',$linha ->SETOR_DESTINO);
			}
			if (array_key_exists('SETOR_RESPONSAVEL',$map) && $map['SETOR_RESPONSAVEL'] == str_replace('SUP-','',$linha ->SETOR_DESTINO)) {				
				if (($linha -> CARGO_ORIGEM == 'Assessor Técnico' || $linha -> CARGO_ORIGEM == 'Superintendente')
					&& $linha -> CARGO_DESTINO == 'Assessor de Controle Interno' &&
				$map['SETOR_RESPONSAVEL'] == str_replace('SUP-','',$linha ->SETOR_ORIGEM)) {
					
					if (!array_key_exists('DT_DISTRIBUICAO_TECNICO', $map) || date($linha -> DT) < date($map['DT_DISTRIBUICAO_TECNICO'] )){
						$map['DT_DISTRIBUICAO_TECNICO'] = $linha -> DT;
					}
				}
				if ($linha -> CARGO_ORIGEM == 'Assessor de Controle Interno' && $linha -> CARGO_DESTINO == 'Superintendente') {
					if (!array_key_exists('DT_DEVOLUCAO_TECNICO', $map) || date($linha -> DT) < date($map['DT_DEVOLUCAO_TECNICO'] )){
						$map['DT_DEVOLUCAO_TECNICO'] = $linha -> DT;
					}
					if (!array_key_exists('DT_DISTRIBUICAO_SUPERINTENDENTE', $map) || date($linha -> DT) > date($map['DT_DISTRIBUICAO_SUPERINTENDENTE'] )){
						$map['DT_DISTRIBUICAO_SUPERINTENDENTE'] = $linha -> DT;
					}
				}
				if ($linha -> CARGO_ORIGEM == 'Superintendente' && ($linha -> CARGO_DESTINO == 'Assessor Técnico' || $linha -> SETOR_DESTINO == 'GAB')) {
					$map['DT_DEVOLUCAO_SUPERINTENDENTE'] = $linha -> DT;
				}
			}
			if ($linha -> SETOR_DESTINO == 'GAB') {
				$map['DT_SAIDA_SETOR'] = $linha -> DT;
			}
			return $map;
}



$query = "SELECT tp.CD_PROCESSO, p.NM_ORGAO_INTERESSADO ORGAO, p.NM_INTERESSADO INTERESSADO, DT_TRAMITACAO DT, CONCAT(so.NM_SERVIDOR, ' ', so.SNM_SERVIDOR) NM_ORIGEM, so.CD_SETOR SETOR_ORIGEM, so.CD_SERVIDOR CD_ORIGEM, so.NM_CARGO as CARGO_ORIGEM, CONCAT(sd.NM_SERVIDOR, ' ', sd.SNM_SERVIDOR) NM_DESTINO  , sd.CD_SETOR SETOR_DESTINO, sd.CD_SERVIDOR CD_DESTINO, sd.NM_CARGO as CARGO_DESTINO, p.ID_ASSUNTO ASSUNTO FROM `tb_tramitacao_processos` tp LEFT JOIN `tb_servidores` so on tp.CD_SERVIDOR_ORIGEM = so.CD_SERVIDOR LEFT JOIN `tb_servidores` sd ON tp.CD_SERVIDOR_DESTINO = sd.CD_SERVIDOR LEFT JOIN `tb_processos` p on tp.CD_PROCESSO = p.CD_PROCESSO  WHERE sd.CD_SETOR IN ('SUP-SUCOR', 'SUCOR') OR so.CD_SETOR IN ('SUP-SUCOR','SUCOR')";
	
	$processos = mysqli_query($conexao_com_banco, $query);
	$resultados = array();
	$retorno = array();
	
	while ($linha = mysqli_fetch_object($processos)){		
		//$resultados[] = $linha;
		
		if (!array_key_exists($linha -> CD_PROCESSO, $resultados)) {			
			$processo = array();
			$processo['CD_PROCESSO'] = $linha -> CD_PROCESSO;
			$processo['ORGAO'] = $linha -> ORGAO;
			$processo['INTERESSADO'] = $linha -> INTERESSADO;
			$processo['VALOR'] = 'EMPTY';
			$processo['ASSUNTO'] = $linha -> ASSUNTO;
			
			$resultados[$linha -> CD_PROCESSO] = verificar($processo, $linha);
			
		} else {
			$resultados[$linha -> CD_PROCESSO] = verificar($resultados[$linha -> CD_PROCESSO], $linha);
			
		}
		if ($linha -> SETOR_DESTINO == 'GAB') {
			$retorno[] = $resultados[$linha -> CD_PROCESSO];
			unset($resultados[$linha -> CD_PROCESSO]);
		}
	}
		echo json_encode($retorno);
		?>