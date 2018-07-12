<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('head.php'); 
include('body.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
<div class="container titulo-pagina">
	<p>Selecione o mês e o ano do relatório</p>
</div>
<?php include('includes/mensagem.php'); ?>
<div class="container caixa-conteudo">
	<div class="container well">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/indice-produtividade/redirecionar.php?sessionId=<?php echo $num ?>" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
							<div class="col-md-5">
	                                    <label class="control-label" for="exampleInputEmail1">Mês:</label>
										<select class="form-control" id="mes" name="mes" required/>
											<option value="">Selecione o mês</option>
											<option value="01">Janeiro</option>
											<option value="02">Fevereiro</option>
											<option value="03">Março</option>
											<option value="04">Abril</option>
											<option value="05">Maio</option>
											<option value="06">Junho</option>
											<option value="07">Julho</option>
											<option value="08">Agosto</option>
											<option value="09">Setembro</option>
											<option value="10">Outubro</option>
											<option value="11">Novembro</option>
											<option value="12">Dezembro</option>
										</select>
	                        </div>
							<div class="col-md-5">
	                                        <label class="control-label" for="exampleInputEmail1">Ano:</label>
											<select class="form-control" name="ano" required/>
												<option value="">Selecione o ano</option>
												<?php $i = date('Y'); while($i >= 2016 ){ ?>
													<option value="<?php echo $i ?>"><?php echo $i ?></option>
												<?php $i--;} ?>
											</select>
	                        </div>
	                        <div class="col-md-2">
								<div class="form-group">
									<button type="submit" class="btn btn-sm btn-success" name="submit" value="Send" style="margin-top:32px;">Ver relatório</button>
								</div>	
							</div>
						</div>
					</form>
				</div>
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
<?php include('foot.php')?>