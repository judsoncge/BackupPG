<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
$permissao = retorna_permissao_pessoa($_SESSION['CPF'],'cadastrar_financeiro',$conexao_com_banco); if($permissao=='Não'){
	echo "<script>history.back();</script>";
	echo "<script>alert('Você não tem permissão para estar nesta página')</script>";
}
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Empenhos</p>
	</div>
	<div class="container caixa-conteudo">
		
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-sm-12">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="número de empenho, tipo da despesa e datas" id="search"/>
								</div>
							</div>
							</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 320px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Número empenho</th>
									<th>Despesa</th>
									<th>Data de empenho</th>
									<th>Data de pagamento</th>
									<th>Valor</th>
									<th><center>Ver detalhes ou pagar</center></th>
								</tr>	
							</thead>
							<tbody>
								<?php $lista = retorna_dados("empenho", $conexao_com_banco);
								while($r = mysqli_fetch_object($lista)){ ?>
								<tr>
								
									<td><?php echo $r -> numero_empenho ?></td>
									<td><?php $str = $r -> id_despesa; $res = explode("_", $str); echo $res[0];  ?></td>
									<td><?php echo arruma_data($r -> data_empenho) ?></td>
									<td><?php echo arruma_data($r -> data_pagamento) ?></td>
									<td>R$ <?php echo arruma_numero($r -> valor_empenhado) ?></td>
														
								   <td><center><button id='abre-modal' type='button' class='btn btn-default btn-sm' data-toggle='modal' 
									data-target='#<?php echo $r -> numero_empenho ?>'><i class='fa fa-eye' aria-hidden='true'></i></button></center></td>
								</tr>

								<div class='modal fade' id='<?php echo $r -> numero_empenho ?>' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
								<div class='modal-dialog modal-lg'>
									<div class='modal-content'>
										<div class='modal-header'>
											<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
											<h4 class='modal-title' id='myModalLabel'> Empenho <?php echo $r -> numero_empenho ?> de <?php echo $res[0]?></h4>
										</div>
										<div class='modal-body'>
											<div class="row">
												<div class="col-md-4">
													<label class="control-label" for="exampleInputEmail1">Data de empenho: <b><?php echo arruma_data($r -> data_empenho) ?></b></label>
												</div>
												<div class="col-md-4">
													<label class="control-label" for="exampleInputEmail1">Valor: <b><?php echo arruma_numero($r -> valor_empenhado) ?></b></label>
												</div>
												<div class="col-md-4">
													<label class="control-label" for="exampleInputEmail1">Data de pagamento: <b><?php echo arruma_data($r -> data_pagamento) ?></b></label>
												</div>
												
											</div>
											</div>
										<div class='modal-footer'>
										<?php if($r->ordem_bancaria == null){ ?>
													<div class="row">
															<form method='POST' action='../componentes/empenho/logica/editar.php?empenho=<?php echo $r->numero_empenho ?>' enctype='multipart/form-data'>	
																<div class="col-md-6">
																	<input class="form-control" id="bancaria" name="bancaria" placeholder="Digite o número da ordem bancária" type="text" maxlength="" required/>
																</div>
											
																<div class="col-md-6">
																	<button type='submit' class='btn btn-sm btn-default btn-block pull-right' name='submit2' value='Send' id='btn-editar'>Efetuar pagamento</button>
																</div>	
															</form>				
														</div>
											<?php }else{ ?>
													<div class="row">
														
														Este empenho já está pago!
														
														</div>
											<?php } ?>		

											
										</div>	
										
										<div class="row">
										<hr>
										
										<div class="col-md-12">
											<a href='../componentes/empenho/logica/excluir.php?id=<?php echo $r -> numero_empenho ?>' name='submit' value='Send' id='btn-editar'><button type='submit' class='btn btn-sm btn-default btn-block pull-right' name='submit' value='Send' id='btn-editar'>Excluir empenho &nbsp;&nbsp;<i class='fa fa-pencil-square' aria-hidden='true'></i></button></a>
										</div>	
										
										
										
										</div>
									
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