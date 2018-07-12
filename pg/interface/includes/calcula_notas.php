<?php 

	  $nota_produtividade = retorna_nota_mes($mes, $ano,"PRODUTIVIDADE", $r->CPF, $conexao_com_banco);
	  $nota_cumprimento = retorna_nota_mes($mes, $ano,"CUMPRIMENTO DE PRAZO", $r->CPF, $conexao_com_banco); 
	  $nota_assiduidade = retorna_nota_mes($mes, $ano,"ASSIDUIDADE", $r->CPF, $conexao_com_banco);  
	  $nome_gerador = $_SESSION['nome'] . " " . $_SESSION['sobrenome'];
	  $cargo_gerador = $_SESSION['cargo'];

	  $nota_geral = retorna_nota_geral($r->CPF,$mes, $ano,$conexao_com_banco); 


	  $total_documentos_criados = retorna_documento_criado($mes, $ano, $r->CPF, $conexao_com_banco);
	  $total_documentos_com_sugestao = retorna_documentos_com_sugestao($mes, $ano, $r->CPF, $conexao_com_banco);
	  $total_documentos_sem_sugestao = $total_documentos_criados - $total_documentos_com_sugestao; 
	  $processos_concluidos_atraso = retorna_numero_processos_concluidos_atraso($mes, $ano, $r->CPF, $conexao_com_banco);
	  $processos_concluidos = retorna_numero_processos_concluidos($mes, $ano, $r->CPF, $conexao_com_banco);
	  $total_processos_mes = $processos_concluidos_atraso + $processos_concluidos;
										
	  $lista2 = retorna_assiduidade_data_servidor($r->CPF,$mes,$ano,$conexao_com_banco);
	  while($r2 = mysqli_fetch_object($lista2)){
			$horas_esperadas = $r2 -> horas_esperadas;
			$horas_trabalhadas = $r2 -> horas_trabalhadas;
			$horas_abonadas = $r2 -> horas_abonadas;
			$justificativa = $r2 -> justificativa;											
		}
?>