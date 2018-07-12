<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
<div class="container titulo-pagina">
	<p>Log do usuário</p>
</div>
<div class="container well">
	<div class="row">
		<div class="col-lg-12">
			<div class="container">
				<b>Log de uso em chamado:</b><br><br>
					<?php $lista = retorna_dados_historico_chamado_log($_SESSION['CPF'], $conexao_com_banco);
								while($r = mysqli_fetch_object($lista)){ ?>
						<b>Data:</b> <?php echo arruma_data2($r->data_mensagem) ?><br>
						<b>Ocorrência:</b> <?php echo $r->mensagem ?><br><br>
						
								<?php } ?>
							
								
			<br>					
			</div>
			<div class="container">
				<b>Log de uso em processo:</b><br><br>
					<?php $lista = retorna_dados_historico_processo_log($_SESSION['CPF'], $conexao_com_banco);
								while($r = mysqli_fetch_object($lista)){ ?>
						<b>Data:</b> <?php echo arruma_data2($r->data_mensagem) ?><br>
						<b>Ocorrência:</b> <?php echo $r->mensagem ?><br><br>
						
								<?php } ?>
							
								
			<br>					
			</div>
			<div class="container">
				<b>Log de uso em documento:</b><br><br>
					<?php $lista = retorna_dados_historico_documento_log($_SESSION['CPF'], $conexao_com_banco);
								while($r = mysqli_fetch_object($lista)){ ?>
						<b>Data:</b> <?php echo arruma_data2($r->data_mensagem) ?><br>
						<b>Ocorrência:</b> <?php echo $r->mensagem ?><br><br>
						
								<?php } ?>
							
								
								
			</div>
			
			
		</div>
	</div>
</div>
</div>

</div>
<!-- /#Conteúdo da Página/-->

</div>
<!-- /#wrapper -->

<script type="text/javascript">
	/*menu lateral*/
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});


	/*tipo de telefone*/
/*	$("#tipo").on('change', function(){
		$('.opcao').hide();
		$('#' + this.value).fadeIn("slow");
	});*/

</script>
<?php include('footer.php')?>