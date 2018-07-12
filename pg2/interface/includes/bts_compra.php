<div class="row linha-modal-processo">
	
	<?php //$permissao = retorna_permissao($_SESSION['CPF'],'AUTORIZAR_COMPRA',$conexao_com_banco); if($permissao=='sim'){ ?>
	<?php if($status=='Solicitado'){ ?>
			<div class='row'>
				<form name="autorizar" method="POST" action="../componentes/compra/logica/editar.php?sessionId=<?php echo $num ?>&operacao=autorizar&compra=<?php echo $id ?>" enctype="multipart/form-data">
					<div class="col-md-8">
							<label class="control-label" for="exampleInputEmail1">Prazo</label>
							<input class="form-control tipo-data" id="prazo" name="prazo" type="date" required/>
					</div>							
					<div class="col-md-2">				 
							<button type="submit" class="btn btn-sm btn-success" name="submit" value="Send" style="margin-top:32px;">Autorizar</button>		
					</div>
				</form>
				<div class="col-md-2">
					<a href='../componentes/compra/logica/editar.php?sessionId=<?php echo $num ?>&operacao=recusar&compra=<?php echo $id ?>'><button type="submit" class="btn btn-sm btn-success" name="submit" value="Send" style="margin-top:32px;">Recusar</button></a>
				</div>
			</div>
	<?php } ?>
<?php //} ?>
	
	<?php //$permissao = retorna_permissao($_SESSION['CPF'],'AUTORIZAR_COMPRA',$conexao_com_banco); if($permissao=='sim'){ ?>
	<?php if($status=='Compra autorizada'){ ?>
			<div class='row'>
				<div class="col-sm-2 col-xs-12 pull-left">
					<!-- Somente algumas pessoas podem abrir um processo -->
					<a href="abrir-processo.php?sessionId=<?php echo $num ?>&compra=<?php echo $id ?>&prazo=<?php echo $prazo ?>&detalhes=<?php echo $descricao ?>" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Abrir processo</a>
				</div>
			</div>
	<?php } ?>	
<?php //} ?>
	
</div>