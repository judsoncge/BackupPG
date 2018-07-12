<?php 
include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php');
include('../nucleo-aplicacao/queries/retorna_info_bem_patrimonial_editar.php');
verifica_caixa($conexao_com_banco);
atualiza_caixa($conexao_com_banco);
?>


<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Bem patrimonial <?php echo $descricao ?></p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="row" style="margin-top: 10px;">
						<div class="col-md-12">
						
							<?php include('includes/info_bem_patrimonial.php');	 ?>
							

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