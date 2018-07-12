
	<div class="row linha-modal-processo" style='max-height: 200px; overflow: auto;'>
		<div class="col-md-12">
			<label>Histórico do documento:</label>
			<br>
			<?php 
			$lista2 = retorna_historico_documento($id, $conexao_com_banco);
			while($r2 = mysqli_fetch_object($lista2)){ 


				$mensagem = '';
				$data = arruma_data2($r2->data_mensagem);
				$foto = retorna_foto_pessoa($r2->pessoa, $conexao_com_banco);
				$nome = retorna_nome_pessoa($r2->pessoa, $conexao_com_banco);

				if ($r2-> acao == "Ação") { ?>
				<div style=' border: solid 1px rgba(0,0,0,0.1); box-shadow: 1px 1px 1px rgba(0,0,0,0.3); padding: 5px 0 5px 10px; border-radius: 5px; width:auto; background-color: rgba(236, 240, 241,0.4); margin: 5px 0 5px 5px;'>[<?php echo $data ?>] <img class='foto-mensagem' src='../registros/fotos/<?php echo $foto ?>' title=<?php echo $nome ?>> <?php echo $r2->mensagem ?></div>
				<?php } 
				else if($r2-> acao == "Mensagem"){?>
				<div style=' border: solid 1px rgba(0,0,0,0.1); box-shadow: 1px 1px 1px rgba(0,0,0,0.3); padding: 5px 0 5px 10px; border-radius: 5px; width:auto; background-color: rgba(46, 204, 113,0.3); margin: 5px 0 5px 5px;'>[<?php echo $data ?>] <img class='foto-mensagem' src='../registros/fotos/<?php echo $foto ?>' title=<?php echo $nome ?>> <?php echo $r2->mensagem ?></div>

				<?php }
				else if($r2-> acao == "Edição Resposta"){?>
				<div style=' border: solid 1px rgba(0,0,0,0.1); box-shadow: 1px 1px 1px rgba(0,0,0,0.3); padding: 5px 0 5px 10px; border-radius: 5px; width:auto; background-color: rgba(46, 204, 110,0.6); margin: 5px 0 5px 5px;'>[<?php echo $data ?>] <img class='foto-mensagem' src='../registros/fotos/<?php echo $foto ?>' title=<?php echo $nome ?>> <?php echo $r2->mensagem ?></div>

				<?php }

				else if($r2-> acao == "Edição Fato"){?>
				<div style=' border: solid 1px rgba(0,0,0,0.1); box-shadow: 1px 1px 1px rgba(0,0,0,0.3); padding: 5px 0 5px 10px; border-radius: 5px; width:auto; background-color: rgba(46, 204, 113,0.9); margin: 5px 0 5px 5px;'>[<?php echo $data ?>] <img class='foto-mensagem' src='../registros/fotos/<?php echo $foto ?>' title=<?php echo $nome ?>> <?php echo $r2->mensagem ?></div>

				<?php }

				else if($r2-> acao == "Sugestão"){?>
				<div style=' border: solid 1px rgba(0,0,0,0.1); box-shadow: 1px 1px 1px rgba(0,0,0,0.3); padding: 5px 0 5px 10px; border-radius: 5px; width:auto; background-color: rgba(46, 204, 113,0.9); margin: 5px 0 5px 5px;'>[<?php echo $data ?>] <img class='foto-mensagem' src='../registros/fotos/<?php echo $foto ?>' title=<?php echo $nome ?>> <?php echo $r2->mensagem ?></div>

				<?php }

				else if($r2-> acao == "Aprovação"){?>
				<div style=' border: solid 1px rgba(0,0,0,0.1); box-shadow: 1px 1px 1px rgba(0,0,0,0.3); padding: 5px 0 5px 10px; border-radius: 5px; width:auto; background-color: rgba(46, 204, 50,0.9); margin: 5px 0 5px 5px;'>[<?php echo $data ?>] <img class='foto-mensagem' src='../registros/fotos/<?php echo $foto ?>' title=<?php echo $nome ?>> <?php echo $r2->mensagem ?></div>

				<?php }
			}	?>
		</div>
	</div>
	<?php if($r->status != 'Aprovado'){ ?>
	<form name='teste' method='POST' action='../componentes/documento/logica/editar_historico.php?documento=<?php echo $id ?>&pessoa=<?php echo $_SESSION['CPF'] ?>' enctype='multipart/form-data'>
		<div class='row linha-modal-processo'>
			<div class='col-md-10'>
				<div class='form-group'>
					<label for='comment'>Nova mensagem:</label>
					<input type='text' class='form-control' rows='1' id='comment' name='mensagem' maxlength="300"></input>
				</div>	
			</div>
			<div class="col-md-2">
				<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-enviar-mensagem'><i class='fa fa-comments fa-lg' aria-hidden='true'></i></button>
			</div>
		</div>
	</form>
	<?php } ?>
