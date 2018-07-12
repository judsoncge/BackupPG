<div class='row linha-modal-processo'>
	<table class="table table-hover tabela-dados">
        <thead>
			<tr>
				<th>Anexos</th>
				<?php if($status!='Pago' or $status!='Recusado'){ ?>
					<th>Excluir</th>
				<?php } ?>
			</tr>
        </thead>
        <tbody>    
		<?php $lista2 = retorna_anexos($id, $conexao_com_banco); 
				while($r2 = mysqli_fetch_object($lista2)){ ?>
					<tr>
						<td><a href="../registros/anexos/<?php echo $r2->NM_ARQUIVO ?>" download><?php echo $r2->NM_ARQUIVO ?></a></td>
						 <?php if($status!='Pago' or $status!='Recusado'){ ?>
							<td><a href="../componentes/anexo/logica/excluir.php?id=<?php echo $r2 -> ID ?>&atual=<?php echo $r2 -> NM_ARQUIVO ?>&pasta=anexos"><button type='button' class='btn btn-secondary btn-sm' title="Excluir anexo"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td>
						<?php } ?>
				   </tr>
				<?php } ?>
                <?php if($status!='Pago' or $status!='Recusado'){ ?>
					<tr>
						<form name='teste' method='POST' action='../componentes/anexo/logica/cadastrar.php?documento=<?php echo $id ?>&pessoa=<?php echo $_SESSION['CPF']?>&pasta=anexos' enctype='multipart/form-data'>
							<td><input type="file" class="" name="arquivo_anexo" id="imagem-comunicacao"/></td>
							<td><button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar' style="margin-top:0; max-width: 140px;" onclick="play()";>Anexar &nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button></td>
						</form>
					</tr> 
				<?php } ?>
        </tbody>
	</table>
</div>