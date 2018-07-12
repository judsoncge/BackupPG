<div class='row linha-modal-processo'>
	<table class="table table-hover tabela-dados">
        <thead>
			<tr>
				<th>Anexos</th>
				<?php if($informacoes['NM_STATUS']!='Pago' or $informacoes['NM_STATUS']!='Pago atrasado' or $informacoes['NM_STATUS']!='Recusado'){ ?>
					<th>Excluir</th>
				<?php } ?>
			</tr>
        </thead>
        <tbody>    
		<?php $lista2 = retorna_anexos_despesa($id, $conexao_com_banco); 
				while($r2 = mysqli_fetch_object($lista2)){ ?>
					<tr>
						<td><a href="../../registros/anexos/<?php echo $r2->NM_ARQUIVO ?>" download><?php echo $r2->NM_ARQUIVO ?></a></td>
						 <?php if($informacoes['NM_STATUS']!='Pago' and $informacoes['NM_STATUS']!='Pago atrasado' and $informacoes['NM_STATUS']!='Recusado'){ ?>
							<td>
								<a href="logica/excluir.php?operacao=anexo_despesa&despesa=<?php echo $id ?>&id=<?php echo $r2 -> ID_DESPESA ?>&nome=<?php echo $r2 -> NM_ARQUIVO ?>">
									<button type='button' class='btn btn-secondary btn-sm' title="Excluir anexo">
										<i class="fa fa-trash" aria-hidden="true"></i>
									</button>
								</a>
							</td>
						<?php } ?>
				   </tr>
				<?php } ?>
                <?php if($informacoes['NM_STATUS']!='Pago' and $informacoes['NM_STATUS']!='Pago atrasado' and $informacoes['NM_STATUS']!='Recusado'){ ?>
					<tr>
						<form name='teste' method='POST' action='logica/editar.php?operacao=anexo&despesa=<?php echo $id ?>' enctype='multipart/form-data'>
							<td>
								<input type="file" class="" name="arquivo_anexo" id="imagem-comunicacao"/>
							</td>
							<td>
								<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar' style="margin-top:0; max-width: 140px;" onclick="play()";>Anexar &nbsp;&nbsp;
									<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
								</button>
							</td>
						</form>
					</tr> 
				<?php } ?>
        </tbody>
	</table>
</div>