<div class="row linha-modal-processo" style='max-height: 200px; overflow: auto;'>
	<div class="col-md-12">
		<label><b>Histórico do processo</b>:</label>
		<br>
		<?php
		
		$lista2 = retorna_historico_processo($informacoes['CD_PROCESSO'], $conexao_com_banco);
		
		while($r2 = mysqli_fetch_object($lista2)){ 
			
			$lista3 = retorna_servidor_codigo($r2->CD_SERVIDOR, $conexao_com_banco);
			
			$result = mysqli_fetch_array($lista3);													
			
			$mensagem = '';
			
			$data = arruma_data2($r2->DT_MENSAGEM);
			
			if($result == null){
			
			$foto = 'default.jpg';
				$nome = $r2->CD_SERVIDOR;
			
			}else{
				$foto = $result['NM_ARQUIVO_FOTO'];
				$nome = $result['NM_SERVIDOR'];
			}
			
			if($r2-> NM_ACAO == "Edição" or $r2->NM_ACAO == "Abertura" or $r2->NM_ACAO == "Saída" or $r2->NM_ACAO == "Voltar"){
					$rgb = "rgba(46, 204, 113, 0.3)";
					
			} else if($r2-> NM_ACAO == "Mensagem" or $r2-> NM_ACAO == "Responsáveis" or $r2-> NM_ACAO == "Mudança de prazo"){
					$rgb = "rgba(243, 156, 18, 0.4)";
					
			} else if($r2-> NM_ACAO == "Tramitação" or $r2-> NM_ACAO == "Retornar Processo"){
					$rgb = "rgba(46, 204, 113, 0.3)";
					
			} else if($r2-> NM_ACAO == "Conclusão"){
					$rgb = "rgba(189, 195, 199, 1.0)";
					
			} else if($r2-> NM_ACAO == "Finalização" or $r2-> NM_ACAO == "Finalização desfeita" or $r2-> NM_ACAO == "Arquivamento" or $r2-> NM_ACAO == "Desarquivamento"){ 
					$rgb = "rgba(127, 140, 141, 1.0)";
					
			}
			include("../includes/personalizacao_historico.php");
		}	
		?>
	</div>
</div>
													
													