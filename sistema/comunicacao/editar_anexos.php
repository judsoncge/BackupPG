<div class='row linha-modal-processo'>
		<?php 
		$contador = 1;
		$lista = retorna_imagens_comunicacao($id, $conexao_com_banco);
		while($anexo = mysqli_fetch_object($lista)){
			
			$id_anexo 	  = $anexo->ID;
			
			$nome_anexo   = $anexo->NM_ARQUIVO;
			//para download
			$caminho = "../../../registros/fotos-noticias/".$nome_anexo;
			 ?>
			<form name="cadastro" id="cadastro" method="POST" action="logica/editar.php?operacao=info_imagem&id=<?php echo $id_anexo ?>&anexo_atual=<?php echo $nome_anexo ?>" enctype="multipart/form-data">
				
				<div class='row'>
					<div class='col-md-12'>
						<strong>
						Nome: <?php echo $nome_anexo ?>
						
						(<a onclick="return confirm('Tem certeza que deseja apagar este registro?')" href="logica/editar.php?operacao=excluir_anexo&id=<?php echo $id_anexo ?>&caminho=<?php echo $caminho ?>" >Excluir</a>)
						</strong>
					</div>
				</div>
				
				<div class='row'>
					<div class='col-md-4'>
						Selecione a imagem (somente se quiser mudar):<br>
							<input type='file' id='selecao-arquivo' name='imagem_editar' accept='.jpg, .jpeg, .pjpeg, .gif, .png' id='imagem' />	
					</div>
					<div class='col-md-3'>
						Legenda:<br>
						<input class='form-control' id='legenda' name='legenda_editar' value='<?php echo $anexo->NM_LEGENDA ?>' placeholder='Máximo de 100 caracteres' type='text' maxlength='100' required />	
					</div>
					<div class='col-md-2' >
						Créditos:<br>
						<input class='form-control' id='creditos' name='creditos_editar' value='<?php echo $anexo->NM_CREDITOS ?>' placeholder='Máx. de 30 caracteres' type='text' maxlength='30' required />
					</div>
					<div class='col-md-2' >
						É pequena?<br>
						<select class='form-control' id='pequenas' name='pequena_editar' placeholder='Máximo de 30 caracteres' type='text' maxlength='30' required />
							<option value='<?php echo $anexo->BL_PEQUENA ?>'><?php if($anexo->BL_PEQUENA){echo "Sim";}else{echo "Não";} ?></option>
							<option value='0'>Não</option>
							<option value='1'>Sim</option>
						</select>
					</div>
					<div class='col-md-1' >
						<button type="submit" class="btn btn-sm btn-success" name="submit" value="Send" style="margin-top:32px;">Editar</button>
					</div>
				</div>
			</form>					
			<hr>
		<?php $contador++; } ?>
</div>
<div class='row linha-modal-processo'>
	<form name="cadastro" id="cadastro" method="POST" action="logica/editar.php?operacao=adicionar_anexo&id=<?php echo $id ?>" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-12">
				<label class="control-label" for="exampleInputEmail1">Adicionar imagens</label>
				<a href='javascript:void(0)' onclick="adicionarImagem();aparecerSubmit();"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12" >
				<div id="adicionarImagem">
				
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12" >
				<button type="submit" style="display: none;" class="btn btn-sm btn-success" id="submitImagens" name="submit" value="Send" style="margin-top:32px;">Adicionar</button>
			</div>
		</div>
	</form>
</div>
