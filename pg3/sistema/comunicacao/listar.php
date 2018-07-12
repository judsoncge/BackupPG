<?php 
include('../head.php');
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-visualizar-comunicacao'], $conexao_com_banco);
?>
<script type="text/javascript" src="<?php echo $ROOT ?>/interface/js/js_responsiveslides.js"></script>
<link rel="stylesheet" href="<?php echo $ROOT ?>/interface/css/responsiveslides.css">


<script>
  $(function() {
    $(".rslides").responsiveSlides();
  });
</script>


<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Comunicação</p>
	</div>
	<?php include('../includes/mensagem.php') ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-sm-10">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> 
									<input type="text" class="input-search form-control" alt="tabela-dados" 
									placeholder="Buscar pelo item, data, ou status" id="search"/>
								</div>
							</div>
							<?php if($_SESSION['permissao-cadastrar-comunicacao']=='sim'){ ?>
								<div class="col-sm-2 col-xs-12 pull-right">
									<a href="cadastrar.php" 
									class="btn btn-sm btn-info pull-right">
									<i class="fa fa-plus-circle"></i> Novo Item</a>
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 320px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Item</th>
									<th>Data</th>
									<th>Status</th>
                                    <th><center>Pré-visualizar</center></th>
                                    <th><center>Ações</center></th>
								</tr>	
							</thead>
							<tbody>
										<?php $lista = retorna_comunicacoes($conexao_com_banco);
										while($r = mysqli_fetch_object($lista)){ 
											$id = $r-> CD_COMUNICACAO; 
										?>
										
										<tr>
											
											<td><?php echo $r -> NM_ITEM ?></td>
											<td><?php echo arruma_data($r -> DT_PUBLICACAO) ?></td>
											<td><?php echo $r -> NM_STATUS ?></td>
																			
											
											<td><center><button id='abre-modal' type='button' class='btn btn-default btn-sm' data-toggle='modal' 
											data-target="#<?php echo $id ?>"><i class='fa fa-eye' aria-hidden='true'></i></button></center></td>
											
											<td>
												<center>
												<?php if($_SESSION['permissao-editar-comunicacao']=='sim'){ ?>
													<?php if($r -> NM_STATUS == 'Aberta'){ ?>
														<a href="logica/editar.php?operacao=status&id=<?php echo $id ?>&status=Submetida" button type='button' class='btn btn-secondary btn-sm' title="Publicar"><i class="fa fa-arrow-up" aria-hidden="true"></i></button></a>
													<?php }else {?>
														<a href="logica/editar.php?operacao=status&id=<?php echo $id ?>&status=Aberta"><button type='button' class='btn btn-secondary btn-sm' title="Retirar"><i class="fa fa-arrow-down" aria-hidden="true"></i></button></a>
													<?php } ?>
													<a href="editar.php?comunicacao=<?php echo $id ?>"><button type='button' class='btn btn-secondary btn-sm' title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
												<?php } ?>
												<?php if($_SESSION['permissao-excluir-comunicacao']=='sim'){ ?>
													<a href="logica/excluir.php?operacao=excluir&id=<?php echo $id ?>"><button type='button' class='btn btn-secondary btn-sm' title="Limpar"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
												<?php } ?>
												</center>
											</td>
											
								
									<?php   $lista2 = retorna_anexos_comunicacao($id,$conexao_com_banco); 
											while($r2 = mysqli_fetch_object($lista2)){									
											$imagem = $r2->NM_ARQUIVO; ?>
							 
									
									<?php if($r -> NM_ITEM == 'Comunicação Externa' or $r -> NM_ITEM == 'Rede Social' or $r -> NM_ITEM == 'Se vira nos 5'){ ?>
										 
											<div id="<?php echo $id ?>" class="modal fade" role="dialog">
											  <div class="modal-dialog modal-lg">

												<!-- Modal content-->
												<div class="modal-content">
												  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<div class="modal-title">
														<center><p class="comunicacao-cabecalho"><?php echo $r->NM_TITULO ?></p></center>
															<!--SLIDE-->
															  <ul class="rslides" >
															  <?php $lista3 = retorna_anexos_comunicacao($id, $conexao_com_banco);
															  while($r3 = mysqli_fetch_object($lista3)){ ?>
																<li class="modal-card-foto2">
																  <img src="../../registros/fotos-noticias/<?php echo $r3->NM_ARQUIVO ?>" alt="">
																</li>
															  <?php } ?>
															  </ul>
															  <!--/SLIDE-->
													</div>
												  </div>
												   
												  <div class="modal-body">
													<p>Publicado em: <?php echo arruma_data($r->DT_PUBLICACAO) ?></p>
													<p><?php echo $r->NM_TEXTO ?></p>
												  </div>
											
												</div>

											  </div>
												</div>
										
									 <?php } ?>
											
									<?php if($r -> NM_ITEM == 'CGE News' or $r -> NM_ITEM == 'CGE em Movimento' or $r -> NM_ITEM == 'Mural de Comunicação Interna'){ ?>	
									<div id="<?php echo $id ?>" class="modal fade" role="dialog">
										<div class="modal-dialog modal-lg">
											<!-- Modal content-->
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
													<div class="modal-title">
														<center><p class="comunicacao-cabecalho"><?php echo $r -> NM_TITULO ?></p></center>
														<img src="../../registros/fotos-noticias/<?php echo $imagem ?>"/ class="modal-card-foto">  
													</div>
											  </div>
											</div>
										</div>
									 </div>	
									<?php } ?>        
											<?php }} ?>
                                </tr>
							</tbody>
						</table>
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


<?php include('../foot.php')?>