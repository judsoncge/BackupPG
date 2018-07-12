	<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php')
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Fluxo de caixa</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-sm-12">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Buscar pela despesa, ou qualquer valor" />
								</div>
							</div>
							<!-- <div class="col-sm-2 col-xs-12 pull-right">
								<a href="cadastro-combustivel.php?sessionId=<?php echo $num ?>" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Novo Combustível</a>
							</div> -->
						</div>
					</div>
					<h4 style="padding-left: 20px; padding-bottom: 10px; padding-top: 10px; font-weight:100">Controle Financeiro</h4>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 450px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Despesa</th>
									<th>Saldo inicial</th>
									<th>Cota mensal</th>
									<th>Cota extra</th>
									<th>Empenhado</th>
									<th>Saldo atual</th>
									<th id="ano">Mês/Ano</th>
									<th><center>Ver detalhes</center></th>
									
								</tr>	
							</thead>
							<tbody>
								<?php include('../nucleo-aplicacao/queries/retorna_combustiveis.php'); 
								while($r = mysqli_fetch_object($qr)){ 
								include('../nucleo-aplicacao/arrumar_dados_combustivel_exibicao.php'); 
								?>
								<tr>
									<td><?php echo $r -> numero_empenho ?></td>
									<td><?php echo $r -> Veiculo_placa ?></td>
									<td><?php echo $data_abastecimento ?></td>
									<td><?php echo $r -> valor_litro ?></td>
									<td><?php echo $r -> quantidade_litro ?></td>	
									<td><?php echo $r -> quantidade_litro ?></td>		
									
									<td id="ano-item"><!-- <?php echo $r -> ano ?> -->06/2016</td>
								    <td><center><button id='abre-modal' type='button' class='btn btn-default btn-sm' data-toggle='modal' 
									data-target='#<?php echo $r -> numero_empenho ?>'><i class='fa fa-eye' aria-hidden='true'></i></button></center></td>
									
									
								</tr>

								<div class='modal fade' id='<?php echo $r -> numero_empenho ?>' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
								<div class='modal-dialog modal-lg'>
									<div class='modal-content'>
										<div class='modal-header'>
											<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
											<h4 class='modal-title' id='myModalLabel'> Combustível <?php echo $r -> numero_empenho ?></h4>
										</div>
										<div class='modal-body'>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Número do empenho: <b><?php echo $r -> numero_empenho ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Placa do veículo: <b><?php echo $r -> Veiculo_placa ?></b></label>
												</div>												
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Data de abastecimento: <b><?php echo $r -> data_abastecimento ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Valor do litro abastecido: <b>R$ <?php echo $r -> valor_litro ?></b></label>
												</div>																
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Quantidade de litros: <b><?php echo $r -> quantidade_litro ?></b></label>
												</div>
											</div>
										</div>
										<div class='modal-footer'>
											<a href='edita-combustivel.php?sessionId=<?php echo $num ?>&empenho=<?php echo $r->numero_empenho ?>' name='submit' value='Send' id='btn-editar'><button type='submit' class='btn btn-sm btn-default btn-block pull-right' name='submit' value='Send' id='btn-editar'>Editar combustível &nbsp;&nbsp;<i class='fa fa-pencil-square' aria-hidden='true'></i></button>
											</a>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</tbody>
				</table>
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