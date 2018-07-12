<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Mês de <?php $mes = date('m')-1; $ano = date('Y'); echo arruma_data_mes2($mes) ?>: <?php echo retorna_quantidade_total_chamados_mes($mes, $ano, $conexao_com_banco); ?> chamados no total</h2></p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
		

			<div class="col-lg-6">
				<div class="container">
					<h2>Pessoas que mais fizeram chamados:<br><br></h2>
					<?php $lista = retorna_quantidade_chamados_mes($mes, $ano, $conexao_com_banco);
						  while($r = mysqli_fetch_object($lista)){ 
						  
					echo $r->nome .": ". $r->contador . "<br>";
					
					  
						  
						  }	  
					?>
				</div>
			</div>
			
			<div class="col-lg-6">
				<div class="container">
					<h2>Problemas mais requisitados:<br><br></h2>
					<?php $lista = retorna_quantidade_problemas_chamados_mes($mes, $ano, $conexao_com_banco);
						  while($r = mysqli_fetch_object($lista)){ 
						  
					echo $r->natureza_problema .": ". $r->contador . "<br>";
					
					  
						  
						  }	  
					?>
				</div>
			</div>
			
			
		</div>
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

<?php include('footer.php')?>