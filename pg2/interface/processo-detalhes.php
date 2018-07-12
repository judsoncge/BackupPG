<?php 
include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php');
include('../nucleo-aplicacao/queries/retorna_info_processo_editar.php');
?>


<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Processo <?php echo $numero_processo ?> 	
			<?php $permissao = retorna_permissao($_SESSION['CPF'],'VOLTAR_PROCESSO',$conexao_com_banco); if($status == 'Saiu' and $permissao=='sim'){	?>	
				<a href="../componentes/processo/logica/editar.php?sessionId=<?php echo $num ?>&operacao=voltar&processo=<?php echo $numero_processo ?>">
				<button type='submit' class='btn btn-sm btn-success' name='submit' value='Send' id='botao-dar-saida'>
				Colocar processo de volta&nbsp;&nbsp;<i class="fa fa-external-link-square" aria-hidden="true"></i></button></a>	
			<?php } ?>	
			
			<?php $permissao = retorna_permissao($_SESSION['CPF'],'DESARQUIVAR_PROCESSO',$conexao_com_banco); if($status == 'Arquivado' and $permissao=='sim'){	?>	
				<a href="../componentes/processo/logica/editar.php?sessionId=<?php echo $num ?>&operacao=desarquivar&processo=<?php echo $numero_processo ?>&prazo_final='<?php echo $prazo_final ?>'">
				<button type='submit' class='btn btn-sm btn-success' name='submit' value='Send' id='botao-dar-saida'>
				Desarquivar&nbsp;&nbsp;<i class="fa fa-external-link-square" aria-hidden="true"></i></button></a>	
			<?php } ?>	
		</p>
	</div>
	<?php include('includes/info_prazo_processo.php')  ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="row" style="margin-top: 10px;">
						<div class="col-md-12">
						
							<?php 
								
								if($status != 'Saiu' and $status != 'Arquivado'){	
									include('includes/bts_processo.php'); 
								} 
							?>
							
							<?php include('includes/info_processo.php'); ?>
							
							<?php include('includes/documentos_processo.php'); ?>
							
							<?php include('includes/documentos_compra_processo.php'); ?>
							
							<?php include('includes/historico_processo.php'); ?>
							
							<?php 
							
							if($status != 'Saiu' and $status != 'Arquivado'){	
									include('includes/mensagem_processo.php'); 
								} 
							?>
							
							<?php 
							
							if($status != 'Saiu' and $status != 'Arquivado'){	
									include('includes/prazos_processo.php'); 
								} 
							?>

							<?php 
							$permissao = retorna_permissao($_SESSION['CPF'],'DEFINIR_RESPONSAVEIS_PROCESSO',$conexao_com_banco);
							
							if($status != 'Saiu' and $status != 'Arquivado' and $permissao=='sim'){	
									include('includes/responsaveis_processo.php'); 
								} 
							?>

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
	$('#responsaveis').multipleSelect();
</script>



<script type="text/javascript">
    audio = document.getElementById('audio');

	function play(){
	    audio.play();
	}
</script>


<?php include('foot.php')?>