<?php 
include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		Relatório de chamados em <?php echo date('Y') ?>	
	</div>
	<div class="container caixa-conteudo">
		<?php $i=1; while($i<=date('m')){   ?>	
					<div class="row">
						<div class="col-lg-12">
							<div class="container">
								<p><b><?php $mes = $i; $ano = date('Y'); echo arruma_data_mes2($mes) ?>: 
								<?php echo retorna_total_chamados_mes($mes, $ano, $conexao_com_banco); ?> chamados</h2></b></p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="container">
								Pessoas que mais fizeram chamados:<br><br>
								<?php $lista = retorna_quantidade_chamados_mes_servidor($mes, $ano, $conexao_com_banco);
									  while($r = mysqli_fetch_object($lista)){ 
											echo $r->NM_SERVIDOR .": ". $r->contador . "<br>";
									  }	  
								?>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="container">
								Problemas mais requisitados:<br><br>
								<?php $lista = retorna_quantidade_problemas_chamados_mes($mes, $ano, $conexao_com_banco);
									  while($r = mysqli_fetch_object($lista)){ 
											echo $r->NM_NATUREZA .": ". $r->contador . "<br>";
									  }	  
								?>
							</div>
						</div>
					</div>
	<?php $i++; }  ?>	
	</div>
</div>

</div>
<!-- /#Conteúdo da Página/-->

</div>
<!-- /#wrapper -->


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