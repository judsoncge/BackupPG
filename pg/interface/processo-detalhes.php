<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
include('../nucleo-aplicacao/queries/retorna_info_processo_editar.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Processo <?php echo $numero_processo ?> 	
		<?php if($status == 'Saiu'){	?>
		<a href="../componentes/processo/logica/editar_voltar.php?processo=<?php echo $numero_processo ?>">
		<button type='submit' class='btn btn-sm btn-success pull-right' name='submit' value='Send' id='botao-dar-saida'>
		Colocar processo de volta&nbsp;&nbsp;<i class="fa fa-external-link-square" aria-hidden="true"></i></button></a>	
		<?php } ?>		
</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="row" style="margin-top: 10px;">
						<div class="col-md-12">
						
							<?php include('includes/label_situacao_processo.php'); ?>
							
							<?php 
							
							if($status != 'Saiu' and $status != 'Arquivado'){	
									include('includes/bts_processo.php'); 
								} 
							
							
							?>
							
							<?php include('includes/info_processo_modal.php'); ?>
							
							<?php include('includes/documentos_processo.php'); ?>
							
							<?php include('includes/mensagem_historico_processo.php'); ?>

							<?php
							if($status != 'Saiu' and $status != 'Arquivado'){		
								
									include('includes/tramitacao.php'); 
								
							}
							?>
						
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /#Conteúdo da Página/-->

<!-- chamando o bootstrap novamente para o modal funcionar -->
<script type="text/javascript" src="js/bootstrap.js"></script>

<script type="text/javascript">
	/*menu lateral*/
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>

<?php include('footer.php')?>