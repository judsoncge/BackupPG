<div class="row linha-modal-processo" style='max-height: 200px; overflow: auto;'>
	<div class="col-md-12">
		<label><b>Histórico do documento</b>:</label>
		<br>
		<?php
		
		$lista2 = retorna_historico_documento($id, $conexao_com_banco);
		
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
				
			if($r2->NM_ACAO == "Criação"){
				$rgb = "rgba(46, 204, 113, 0.3)";
						
			} else if($r2-> NM_ACAO == "Mensagem" or $r2-> NM_ACAO == "Sugestão" or $r2-> NM_ACAO == "Anexo" or $r2-> NM_ACAO == "Edição" or $r2-> NM_ACAO == "Envio"){
				$rgb = "rgba(243, 156, 18, 0.4)";
				
			} else if($r2-> NM_ACAO == "Aprovação" or $r2-> NM_ACAO == "Desaprovação" or $r2-> NM_ACAO == "Resolução"){ 
				$rgb = "rgba(189, 195, 199, 1.0)";

			} 
			
			include("../includes/personalizacao_historico.php");
			
		}			
		?>
	</div>
</div>
													
													