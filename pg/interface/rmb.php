<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
$permissao = retorna_permissao_pessoa($_SESSION['CPF'],'visualizar_financeiro',$conexao_com_banco); if($permissao=='Não'){
	echo "<script>history.back();</script>";
	echo "<script>alert('Você não tem permissão para estar nesta página')</script>";
}
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>RMB</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-sm-12">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Buscar classificação contábil, denominação, saldo anterior, saldo atual ou ano" />
								</div>
							</div>
							<!-- <div class="col-sm-2 col-xs-12 pull-right">
								<a href="cadastro-bem-patrimonial.php?sessionId=<?php echo $num ?>" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Novo Bem</a>
							</div> -->
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 320px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Classificação contábil</th>
									<th>Denominação</th>
									<th>Saldo anterior</th>
									<th>Saldo atual</th>
									<th><center>Ver detalhes</center></th>
									<th id="ano">Ano</th>
								</tr>	
							</thead>
							<tbody>
								<?php $lista = retorna_dados("rmb", $conexao_com_banco);
								while($r = mysqli_fetch_object($lista)){ ?>
								<tr>
									<td><?php echo $r -> classificacao_contabil ?></td>
									<td><?php echo $r -> denominacao ?></td>
									<td>R$<?php echo arruma_numero($r -> saldo_anterior) ?></td>
									<td>R$<?php echo arruma_numero($r -> saldo_atual) ?></td>			
									
									
								    <td><center><button id='abre-modal' type='button' class='btn btn-default btn-sm' data-toggle='modal' 
									data-target='#<?php echo $classificacao_contabil ?>'><i class='fa fa-eye' aria-hidden='true'></i></button></center></td>
									
									<td id="ano-item"><?php echo $r -> ano ?></td>
								</tr>

								<div class='modal fade' id='<?php echo $classificacao_contabil ?>' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
								<div class='modal-dialog modal-lg'>
									<div class='modal-content'>
										<div class='modal-header'>
											<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
											<h4 class='modal-title' id='myModalLabel'> <?php echo $r -> denominacao ?></h4>
										</div>
										<div class='modal-body'>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Classificação contábil: <b><?php echo $r -> classificacao_contabil ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Saldo anterior: R$<b><?php echo arruma_numero($r -> saldo_anterior) ?></b></label>
												</div>												
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Entrada: R$<b><?php echo arruma_numero($r -> entrada) ?></b></label>
												</div>	
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Entrada extra: R$<b><?php echo arruma_numero($r -> entrada_extra) ?></b></label>
												</div>															
											</div>
											<div class="row">
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Saída: <b><?php echo $r -> saida ?></b></label>
												</div>
												<div class="col-md-6">
													<label class="control-label" for="exampleInputEmail1">Saldo atual: R$<b><?php echo arruma_numero( $r -> saldo_atual) ?></b></label>
												</div>
											</div>
										</div>
										<div class='modal-footer'>
											<!-- <a href='edita-rmb.php?sessionId=<?php echo $num ?>&empenho=<?php echo $r->numero_empenho ?>' name='submit' value='Send' id='btn-editar'><button type='submit' class='btn btn-sm btn-default btn-block pull-right' name='submit' value='Send' id='btn-editar'>Editar item de RMB &nbsp;&nbsp;<i class='fa fa-pencil-square' aria-hidden='true'></i></button> -->
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