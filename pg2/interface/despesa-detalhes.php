<?php 
include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php');
include('../nucleo-aplicacao/queries/retorna_info_despesa_editar.php');
verifica_caixa($conexao_com_banco);
atualiza_caixa($conexao_com_banco);
$ano = date('Y');
$mes = date('m');
?>


<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Despesa <?php echo $nome_despesa ?></p>
	</div>
	<p><h3>Valor solicitado: <?php echo "R$ " . arruma_numero($valor_despesa);?></h3></p>
	<?php include('includes/resumo_caixa.php'); ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="row" style="margin-top: 10px;">
						<div class="col-md-12">
						
							<?php 
								
								if($status != 'Pago' and $status != 'Recusado'){	
									include('includes/bts_despesa.php'); 
								} 
							?>
							
							<?php include('includes/info_despesa.php'); ?>
							
							<?php include('includes/historico_despesa.php'); ?>
							
							<?php 
							
							if($status != 'Pago' and $status != 'Recusado'){	
									include('includes/mensagem_despesa.php'); 
								} 
							?>
							
							<?php include('includes/anexos_despesa.php'); ?>
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