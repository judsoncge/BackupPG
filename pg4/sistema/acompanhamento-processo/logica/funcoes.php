<?php

include($ROOT_SISTEMA.'/acompanhamento-processo/banco-dados/funcoes.php');


function registrar_tramitacao($cd_processo, $servidor_origem, $servidor_destino, $dt_tramitacao, $conexao_com_banco) {
	$processo = retorna_dados_processo($cd_processo, $conexao_com_banco);
	
	$setor_origem = str_replace('SUP-','',$servidor_origem -> CD_SETOR);
	$setor_destino = str_replace('SUP-','',$servidor_destino -> CD_SETOR);


	if ($setor_origem == $setor_destino) { 			
		$acompanhamento = retorna_acompanhamento_processo_aberto($cd_processo, $setor_origem, $conexao_com_banco);
		
		//Registrando operações internas
		if ($setor_origem == $setor_destino && $acompanhamento != NULL) {			
			//Assessor técnico distribuiu o processo para Assessor de Controle Interno
			if ($servidor_origem -> NM_FUNCAO == 'Assessor Técnico Setor' && $servidor_destino -> NM_FUNCAO == 'Analisa Processo' ) {
				$acompanhamento -> DT_DISTRIBUICAO_TECNICO = $dt_tramitacao;
				$acompanhamento -> CD_SERVIDOR_RESPONSAVEL = $servidor_destino -> CD_SERVIDOR;
			} else if (($servidor_origem -> NM_FUNCAO == 'Superintendente' || $servidor_origem -> NM_FUNCAO == 'Superintendente sem assessor') && $servidor_destino -> NM_FUNCAO == 'Analisa Processo' && (!array_key_exists('CD_SERVIDOR_RESPONSAVEL',$acompanhamento) || empty($acompanhamento -> CD_SERVIDOR_RESPONSAVEL))) {
				$acompanhamento -> DT_DISTRIBUICAO_TECNICO = $dt_tramitacao;
				$acompanhamento -> CD_SERVIDOR_RESPONSAVEL = $servidor_destino -> CD_SERVIDOR;
				
			}
			//Assessor de Controle Interno enviou ao Superintendente para avaliação
			//Regra seguida: Guardar a primeira interação (ignorar as datas após a correção do superintendente)
			if ($servidor_origem -> NM_FUNCAO == 'Analisa Processo' && ($servidor_destino -> NM_FUNCAO == 'Superintendente' || $servidor_destino -> NM_FUNCAO == 'Superintendente sem assessor')) {
				if (!array_key_exists('DT_DEVOLUCAO_TECNICO',$acompanhamento) || $acompanhamento -> DT_DEVOLUCAO_TECNICO == '0000-00-00 00:00:00' || $acompanhamento -> DT_DEVOLUCAO_TECNICO > $dt_tramitacao) {
					$acompanhamento -> DT_DEVOLUCAO_TECNICO = $dt_tramitacao;
				}
			}
			//Superintendente recebeu processo
			//Regra seguida: Guardar a ultima interação (o período do processo com o superintendente só conta a partir da útlima vez que o Assessor de Controle Interno enviou)
			if ($servidor_origem -> NM_FUNCAO == 'Analisa Processo' && ($servidor_destino -> NM_FUNCAO == 'Superintendente' || $servidor_destino -> NM_FUNCAO == 'Superintendente sem assessor')) {
				
				if (!array_key_exists('DT_DISTRIBUICAO_SUPERINTENDENTE',$acompanhamento) || $acompanhamento -> DT_DISTRIBUICAO_SUPERINTENDENTE == '0000-00-00 00:00:00' || $acompanhamento -> DT_DISTRIBUICAO_SUPERINTENDENTE < $dt_tramitacao) {
					$acompanhamento -> DT_DISTRIBUICAO_SUPERINTENDENTE = $dt_tramitacao;
				}
			}
			//Superintendente concluiu processo
			//Regra seguida: Guardar a ultima interação (Caso o superintendente tenha recebido mais de uma vez o processo do Assessor técnico, essas interações serão ignoradas)
			if (($servidor_origem -> NM_FUNCAO == 'Superintendente' || $servidor_origem -> NM_FUNCAO == 'Superintendente sem assessor') && $servidor_destino -> NM_FUNCAO == 'Assessor Técnico Setor') {
				if (!array_key_exists('DT_DEVOLUCAO_SUPERINTENDENTE',$acompanhamento) || $acompanhamento -> DT_DEVOLUCAO_SUPERINTENDENTE == '0000-00-00 00:00:00' || $acompanhamento -> DT_DEVOLUCAO_SUPERINTENDENTE < $dt_tramitacao) {
					$acompanhamento -> DT_DEVOLUCAO_SUPERINTENDENTE = $dt_tramitacao;
				}
				
				
			}
			atualizar_acompanhamento_processo($conexao_com_banco, $acompanhamento);
		}
		
		}
		
	
	
}

?>