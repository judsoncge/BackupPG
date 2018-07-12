<?php 
include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php');
include('../nucleo-aplicacao/queries/retorna_info_documento_editar.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Documento sobre <?php echo $tipo_atividade?></p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					
					<?php 
					
					if($status != 'Resolvido'){
						include('includes/bts_documento.php'); 
					}
					
					include('includes/info_documento.php');

					include('includes/historico_documento.php');
					
					if($status != 'Resolvido'){
						include('includes/mensagem_documento.php');
					}
					$permissao = retorna_permissao($_SESSION['CPF'],'SUGESTAO_DOCUMENTO',$conexao_com_banco);
					if($permissao == 'sim' and $status != 'Aprovado' and $status != 'Resolvido'){
						include('includes/sugestao_documento.php');
					}
					
					include('includes/anexos_documento.php');
									
					if($status != 'Resolvido'){
						include('includes/enviar_documento.php'); 
					}
					?>
								
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

<?php include('foot.php')?>