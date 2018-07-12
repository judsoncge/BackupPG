<?php 

	  $nome_gerador = $_SESSION['nome'] . " " . $_SESSION['sobrenome'];
	  
	  $cargo_gerador = $_SESSION['cargo'];
	  
	  $nota_geral = retorna_nota_geral($mes, $ano, $r->CD_SERVIDOR, $conexao_com_banco); 

	  $resultado_assiduidade = retorna_assiduidade($mes, $ano, $r->CD_SERVIDOR, $conexao_com_banco);
	  
			$result = mysqli_fetch_array($resultado_assiduidade);
			$horas_esperadas = $result['HR_ESPERADAS'];
			$horas_trabalhadas = $result['HR_TRABALHADAS'];
			$horas_abonadas = $result['HR_ABONADAS'];
			$justificativa = $result['NM_JUSTIFICATIVA'];
			$nota_assiduidade = $result['NR_NOTA'];		
			$nota_extra_assiduidade = $result['NR_NOTA_EXTRA'];
	 
	  $resultado_cumprimento = retorna_cumprimento_prazo($mes, $ano, $r->CD_SERVIDOR, $conexao_com_banco); 
	  
			$result = mysqli_fetch_array($resultado_cumprimento);
			$total_processos = $result['NR_PROCESSOS'];
			$processos_concluidos = $result['NR_PROCESSOS_CONCLUIDOS'];
			$processos_concluidos_atraso = $result['NR_PROCESSOS_CONCLUIDOS_ATRASO'];
			$nota_cumprimento = $result['NR_NOTA'];	
			$nota_extra_cumprimento = $result['NR_NOTA_EXTRA'];
		
	  
	  $resultado_produtividade = retorna_produtividade($mes, $ano, $r->CD_SERVIDOR, $conexao_com_banco); 
	  
			$result = mysqli_fetch_array($resultado_produtividade);
			$total_documentos_criados = $result['NR_DOCUMENTOS'];
			$total_documentos_com_sugestao = $result['NR_DOCUMENTOS_COM_SUGESTAO'];
			$total_documentos_sem_sugestao = $result['NR_DOCUMENTOS_SEM_SUGESTAO'];
			$nota_produtividade = $result['NR_NOTA'];
			$nota_extra_produtividade = $result['NR_NOTA_EXTRA'];
	  
?>