<?php

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

?>