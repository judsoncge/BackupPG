<div class="row linha-modal-processo">
	<form method='POST' action='../componentes/processo/logica/editar.php?sessionId=<?php echo $num ?>&operacao=prazos&processo=<?php echo $numero_processo ?>&prazo=<?php echo $prazo ?>&prazo_final=<?php echo $prazo_final ?>' enctype='multipart/form-data'>	
		<?php $permissao = retorna_permissao($_SESSION['CPF'],'PRAZO_PROCESSO',$conexao_com_banco); if($permissao=='sim'){ ?>
			<div class="col-md-5">
				<div class="form-group">
					<label class="control-label" for="exampleInputEmail1">Prazo parcial</label>
					<input  class="form-control tipo-data" value='<?php echo $prazo ?>' id="prazo" name="prazo" type="date" maxlength="100" value='<?php echo $prazo ?>' required/>
				</div>  
			</div>
		<?php } ?>
								
		<?php $permissao2 = retorna_permissao($_SESSION['CPF'],'PRAZO_FINAL_PROCESSO',$conexao_com_banco); if($permissao2=='sim'){ ?>
			<div class="col-md-5">
				<div class="form-group">
					<label class="control-label" for="exampleInputEmail1">Prazo final</label>
					<input class="form-control tipo-data" value='<?php echo $prazo_final ?>' id="prazo_final" name="prazo_final" type="date" value='<?php echo $prazo_final ?>' required/>
				</div>  
			</div>
		<?php } ?>	
		
		<?php if($permissao=='sim' or $permissao2=='sim'){ ?>
			<div class="col-md-2">
				<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar'>Definir &nbsp;&nbsp;<i class="fa fa-check-circle" aria-hidden="true"></i></button>
			</div>
		<?php } ?>	
	</form>
</div>