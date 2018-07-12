<div class="row linha-modal-processo">
	<div class="col-md-12">
		
		<b>STATUS</b>:         
			<?php echo $informacoes["NM_STATUS"] ?>
		<br>
		
		<br>
		<b>Está com</b>:         
			<?php echo retorna_nome_servidor($informacoes["ID_SERVIDOR_LOCALIZACAO"], $conexao_com_banco) ?>
		<br>
		<b>No Setor</b>:         
			<?php echo retorna_sigla_setor($informacoes["ID_SETOR_LOCALIZACAO"], $conexao_com_banco) ?>
		<br>
		
		<br>
		<b>Número</b>:         
			<?php echo $informacoes["CD_PROCESSO"] ?>
		<br>
		<b>Assunto</b>:
			<?php 
				echo retorna_nome_assunto($informacoes["ID_ASSUNTO"], $conexao_com_banco); 
			?>
		<br>
		<b>Detalhes</b>:	
			<?php 
				echo $informacoes["NM_DETALHES"];
			?>
		<br>
		
		
		
		<br>
		<b>Órgão interessado</b>:	
			<?php 
				echo retorna_nome_orgao($informacoes["ID_ORGAO_INTERESSADO"], $conexao_com_banco);
			?><br>
		
		<b>Nome do interessado</b>:	
			<?php 
				echo $informacoes["NM_INTERESSADO"];
			?><br>
		
		
		
		<br>
		<b>Dias no órgão</b>:
			<?php echo $informacoes["NR_DIAS"] ?><br>
			
		<b>Dias em sobrestado</b>:
			<?php echo $informacoes["NR_DIAS_SOBRESTADO"] ?><br>	
								
		<b>Data de entrada</b>:
			<?php echo date_format(new DateTime($informacoes["DT_ENTRADA"]), 'd/m/Y')?><br>
		
		<b>Prazo</b>:
			<?php echo date_format(new DateTime($informacoes["DT_PRAZO"]), 'd/m/Y')?><br>
		
		<b>Data de saída</b>:
			<?php if($informacoes["DT_SAIDA"] != '0000-00-00'){
					echo date_format(new DateTime($informacoes["DT_SAIDA"]), 'd/m/Y');
			} ?><br>
		
	
		<br>
		<b>Responsáveis</b>: 
			<?php //imprime a lista de responsaveis e se o servidor tiver permissao, imprime tambem o x para um servidor ser retirado da lista de responsaveis
			while($r = mysqli_fetch_object($responsaveis)){
				
				$id_responsavel = $r->ID_SERVIDOR;
				
				echo retorna_nome_servidor($id_responsavel, $conexao_com_banco);
				
				if($ativo and ($_SESSION['funcao'] == 'SUPERINTENDENTE' or $_SESSION['funcao'] == 'ASSESSOR TÉCNICO' or $_SESSION['funcao'] == 'TI')){
					echo " <a href='logica/editar.php?id=$id&operacao=remover_responsavel&responsavel=$id_responsavel' title='remover responsável'><i class='fa fa-remove' aria-hidden='true'></i></a>";
				}
				echo ", ";
			} ?><br>
		
		<b>Responsável líder</b>:      
			<?php //imprime o responsavel lider
			echo retorna_nome_servidor($responsavel_lider, $conexao_com_banco); ?>
			<br>
		
		
		<br>
		<b>Processos apensados</b>:
			<?php 
			//imprime a lista de processos apensados ao processo atual com o link para ver seus detalhes.								
			while($r = mysqli_fetch_object($apensados)){
				
				$id_apensado = $r->ID_PROCESSO_APENSADO;
				
				echo 
				
				"<a href='detalhes.php?id=$id_apensado'>" . 
				
				retorna_numero_processo($id_apensado, $conexao_com_banco) .

				"</a>";
				
				//se tiver permissao, o usuario pode desapensar um processo
				if($ativo){
					echo " <a href='logica/editar.php?id=$id&operacao=remover_apenso&apenso=$id_apensado' title='remover apenso'><i class='fa fa-remove' aria-hidden='true'></i></a>";
				}
				echo ", ";
				
			} ?>
			<br>
		
		<b>Processo mãe</b>:
			<?php 
			//se tiver um processo mae, imprime o numero dele com o link para visualizacao de detalhes
			echo 
				
			"<a href='detalhes.php?id=$id_mae'>" . 
				
			retorna_numero_processo($id_mae, $conexao_com_banco) .

			"</a>"; 
			
			?><br>
		
		<br>
		
	</div>
</div>