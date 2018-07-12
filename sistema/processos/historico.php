<div class="row linha-modal-processo" style='max-height: 200px; overflow: auto;'>
	<div class="col-md-12">
		<label><b>Histórico do processo</b>:</label>
		<br>
		<?php
		
		$lista2 = retorna_historico_processo($informacoes['ID'], $conexao_com_banco);
		
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
			
			if($r2-> NM_ACAO == "EDIÇÃO" or $r2->NM_ACAO == "ABERTURA" or $r2->NM_ACAO == "SAÍDA" or $r2->NM_ACAO == "VOLTAR"){
					$rgb = "rgba(46, 204, 113, 0.3)";
					
			} else if($r2-> NM_ACAO == "MENSAGEM" or $r2-> NM_ACAO == "LÍDER" or $r2-> NM_ACAO == "RESPONSÁVEIS" or $r2-> NM_ACAO == "APENSAR" or $r2-> NM_ACAO == "REMOVER APENSO" or $r2-> NM_ACAO == "MUDANÇA DE PRAZO" or $r2-> NM_ACAO == "ANEXAR" or $r2-> NM_ACAO == "EXCLUIR ANEXO"){
					$rgb = "rgba(243, 156, 18, 0.4)";
					
			} else if($r2-> NM_ACAO == "TRAMITAÇÃO" or $r2-> NM_ACAO == "RETORNAR PROCESSO"){
					$rgb = "rgba(46, 204, 113, 0.3)";
					
			} else if($r2-> NM_ACAO == "CONCLUSÃO"){
					$rgb = "rgba(189, 195, 199, 1.0)";
					
			} else if($r2-> NM_ACAO == "FINALIZAÇÃO" or $r2-> NM_ACAO == "FINALIZAÇÃO DESFEITA" or $r2-> NM_ACAO == "ARQUIVAMENTO" or $r2-> NM_ACAO == "DESARQUIVAMENTO"){ 
					$rgb = "rgba(127, 140, 141, 1.0)";
					
			} else if($r2-> NM_ACAO == "URGENTE" or $r2-> NM_ACAO == "SOBRESTADO"){ 
					$rgb = "rgba(155, 89, 182,1.0)";
					
			} else if($r2-> NM_ACAO == "CONFIRMAR PROCESSO"){ 
					$rgb = "rgba(39, 174, 96,1.0)";
					
			} else if($r2-> NM_ACAO == "RETORNAR PROCESSO" or $r2-> NM_ACAO == "REMOVER RESPONSÁVEL"){ 
					$rgb = "rgba(243, 156, 18,1.0)";
					
			}
			include("../includes/personalizacao_historico.php");
		}	
		?>
	</div>
</div>