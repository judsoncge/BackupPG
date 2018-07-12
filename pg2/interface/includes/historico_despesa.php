<div class="row linha-modal-processo" style='max-height: 200px; overflow: auto;'>
	<div class="col-md-12">
		<label><b>Histórico da despesa</b>:</label>
		<br>
		<?php
		$lista2 = retorna_historico_despesa($id, $conexao_com_banco);
		while($r2 = mysqli_fetch_object($lista2)){ 
			$lista3 = retorna_servidor_codigo($r2->CD_SERVIDOR, $conexao_com_banco);
			$result = mysqli_fetch_array($lista3);													
			$mensagem = '';
			$data = arruma_data2($r2->DT_MENSAGEM);
			$foto = $result['NM_ARQUIVO_FOTO'];
			$nome = $result['NM_SERVIDOR'];
			if($r2-> NM_ACAO == "Solicitação" or $r2->NM_ACAO == "Empenho"or $r2->NM_ACAO == "Edição"){?>
				<div style=' border: solid 1px rgba(0,0,0,0.1); box-shadow: 1px 1px 1px rgba(0,0,0,0.3); padding: 5px 0 5px 10px; border-radius: 5px; width:auto; background-color: rgba(46, 204, 113,0.3); margin: 5px 0 5px 5px;'>[<?php echo $data ?>] <img class='foto-mensagem' src='../registros/fotos/<?php echo $foto ?>' title=<?php echo $nome ?>> <?php echo " : " . $r2-> NM_MENSAGEM ?></div>
			<?php } else if($r2-> NM_ACAO == "Mensagem"){?>
						<div style=' border: solid 1px rgba(0,0,0,0.1); box-shadow: 1px 1px 1px rgba(0,0,0,0.3); padding: 5px 0 5px 10px; border-radius: 5px; width:auto; background-color: rgba(243, 156, 18,0.4); margin: 5px 0 5px 5px;'>[<?php echo $data ?>] <img class='foto-mensagem' src='../registros/fotos/<?php echo $foto ?>' title=<?php echo $nome ?>> <?php echo " : " . $r2-> NM_MENSAGEM ?></div>
			<?php }  else if($r2-> NM_ACAO == "Autorização de empenho" or $r2-> NM_ACAO == "Recusado"){ ?>
						<div style=' border: solid 1px rgba(0,0,0,0.1); box-shadow: 1px 1px 1px rgba(0,0,0,0.3); padding: 5px 0 5px 10px; border-radius: 5px; width:auto; background-color: rgba(189, 195, 199,1.0); margin: 5px 0 5px 5px;'>[<?php echo $data ?>] <img class='foto-mensagem' src='../registros/fotos/<?php echo $foto ?>' title=<?php echo $nome ?>> <?php echo " : " . $r2-> NM_MENSAGEM ?></div>
			<?php }	else if($r2-> NM_ACAO == "Autorização de pagamento"){ ?>
						<div style=' border: solid 1px rgba(0,0,0,0.1); box-shadow: 1px 1px 1px rgba(0,0,0,0.3); padding: 5px 0 5px 10px; border-radius: 5px; width:auto; background-color: rgba(127, 140, 141,1.0); margin: 5px 0 5px 5px;'>[<?php echo $data ?>] <img class='foto-mensagem' src='../registros/fotos/<?php echo $foto ?>' title=<?php echo $nome ?>> <?php echo " : " . $r2-> NM_MENSAGEM ?></div>
			<?php } else if($r2-> NM_ACAO == "Pagamento"){ ?>
						<div style=' border: solid 1px rgba(0,0,0,0.1); box-shadow: 1px 1px 1px rgba(0,0,0,0.3); padding: 5px 0 5px 10px; border-radius: 5px; width:auto; background-color: rgba(127, 140, 141,1.0); margin: 5px 0 5px 5px;'>[<?php echo $data ?>] <img class='foto-mensagem' src='../registros/fotos/<?php echo $foto ?>' title=<?php echo $nome ?>> <?php echo " : " . $r2-> NM_MENSAGEM ?></div>
			<?php }	
		}	?>
	</div>
</div>
													
													