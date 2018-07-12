<div class="row linha-modal-processo" style='max-height: 200px; overflow: auto;'>
	<div class="col-md-12">
		<label><b>Histórico do chamado</b>:</label>
		<br>
		<?php
		$lista2 = retorna_historico_chamado($_GET['chamado'], $conexao_com_banco);
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
			if($r2->NM_ACAO == "Abertura" or $r2->NM_ACAO == "Fechamento" or $r2->NM_ACAO == "Encerramento" or $r2->NM_ACAO == "Nota"){
				$rgb = "rgba(46, 204, 113,0.3)";
			
			} else if($r2-> NM_ACAO == "Mensagem"){
				$rgb = "rgba(243, 156, 18,0.4)";
				
			}

			include("../includes/personalizacao_historico.php");
		}	?>
	</div>
</div>
													
													