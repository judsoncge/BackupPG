<div class="row linha-modal-processo" style='max-height: 200px; overflow: auto;'>
	
	<div class="col-md-12">
		
		<label><b>Histórico do chamado</b>:</label>
		
		<br>
		
		<?php
		
		$lista2 = retorna_historico_chamado($informacoes['ID'], $conexao_com_banco);
		
		while($r2 = mysqli_fetch_object($lista2)){ 
			
			$lista3 = retorna_servidor($r2->ID_SERVIDOR, $conexao_com_banco);
			
			$result = mysqli_fetch_array($lista3);													
			
			$mensagem = '';
			
			$data = date_format(new DateTime($r2->DT_MENSAGEM), 'd/m/Y H:i:s');
			
			if($result == null){
			
				$foto = 'default.jpg';
				$nome = 'Ex-servidor';
			
			}else{
				$foto = $result['NM_ARQUIVO_FOTO'];
				$nome = $result['NM_SERVIDOR'];
			}
			
			if($r2->NM_ACAO == "ABERTURA" or $r2->NM_ACAO == "RESOLUÇÃO" or $r2->NM_ACAO == "ENCERRAMENTO" or $r2->NM_ACAO == "AVALIAÇÃO"){
				$rgb = "rgba(46, 204, 113,0.3)";
			
			} else if($r2-> NM_ACAO == "MENSAGEM"){
				$rgb = "rgba(243, 156, 18,0.4)";
				
			}

			include("../includes/personalizacao_historico.php");
		}	?>
	</div>
</div>
													
													