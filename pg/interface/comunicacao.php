<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
$permissao = retorna_permissao_pessoa($_SESSION['CPF'],'cadastrar_comunicacao',$conexao_com_banco); if($permissao=='Não'){
	echo "<script>history.back();</script>";
	echo "<script>alert('Você não tem permissão para estar nesta página')</script>";
}
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Comunicação</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-sm-10">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Buscar pelo item, título, data, ou status" id="search"/>
								</div>
							</div>
							<div class="col-sm-2 col-xs-12 pull-right">
								<a href="cadastro-comunicacao.php?sessionId=<?php echo $num ?>" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Novo Item</a>
							</div>
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 320px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Item</th>
									<th>Título</th>
									<th>Data</th>
									<th>Status</th>
                                    <th><center>Pré-visualizar</center></th>
                                    <th><center>Ações</center></th>
								</tr>	
							</thead>
							<tbody>
											<?php $lista = retorna_dados("comunicacao", $conexao_com_banco);
											while($r = mysqli_fetch_object($lista)){ 
												$id = $r-> id; 
											?>
											
											<tr>
												
												<td><?php echo $r -> item ?></td>
												<td><?php echo $r -> titulo ?></td>
												<td><?php echo arruma_data($r -> data_publicacao) ?></td>
												<td><?php echo $r -> status ?></td>
																				
												
												<td><center><button id='abre-modal' type='button' class='btn btn-default btn-sm' data-toggle='modal' data-target="#<?php echo $id ?>"><i class='fa fa-eye' aria-hidden='true'></i></button></center></td>
                                                
                                                <td>
                                                    <center>
                                                    <?php if($r -> status == 'Aberta'){ ?>
                                                        <a href="../componentes/comunicacao/logica/editar_status.php?id=<?php echo $id ?>&status=Submetida" button type='button' class='btn btn-secondary btn-sm' title="Publicar"><i class="fa fa-arrow-up" aria-hidden="true"></i></button></a>
                                                    <?php }else {?>
                                                        <a href="../componentes/comunicacao/logica/editar_status.php?id=<?php echo $id ?>&status=Aberta"><button type='button' class='btn btn-secondary btn-sm' title="Retirar"><i class="fa fa-arrow-down" aria-hidden="true"></i></button></a>
                                                    <?php } ?>
                                                    <a href="edita-comunicacao.php?sessionId=<?php echo $num ?>&comunicacao=<?php echo $id ?>"><button type='button' class='btn btn-secondary btn-sm' title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                                                    
                                                    <a href="../componentes/comunicacao/logica/editar_status.php?id=<?php echo $id ?>&status=Excluída"><button type='button' class='btn btn-secondary btn-sm' title="Limpar"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                                                    </center>
                                                </td>
                                                
                                    
										<?php   $lista2 = retorna_anexos_documento($id,$conexao_com_banco); 
												while($r2 = mysqli_fetch_object($lista2)){ 
												$imagem = $r2->caminho; }?>
                                 
                                        
										<?php if($r -> item == 'Comunicação Interna' or $r -> item == 'Rede Social' or $r -> item == 'Se vira nos 5'){ ?>
											 
												<div id="<?php echo $id ?>" class="modal fade" role="dialog">
												  <div class="modal-dialog modal-lg">

													<!-- Modal content-->
													<div class="modal-content">
													  <div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<div class="modal-title">
															<center><p class="comunicacao-cabecalho"><?php echo $r->titulo ?></p></center>
																<!--SLIDE-->
																  <ul class="rslides" >
																  <?php $lista3 = retorna_anexos_documento($id, $conexao_com_banco);
																  while($r3 = mysqli_fetch_object($lista3)){ ?>
																	<li class="modal-card-foto2">
																	  <img src="../registros/fotos-noticias/<?php echo $r3->caminho ?>" alt="">
																	</li>
																  <?php } ?>
																  </ul>
																  <!--/SLIDE-->
														</div>
													  </div>
													   
													  <div class="modal-body">
														<p>Publicado em: <?php echo arruma_data($r->data_publicacao) ?></p>
														<p><?php echo $r->texto ?></p>
													  </div>
												
													</div>

												  </div>
													</div>
											
										 <?php } ?>
												
										<?php if($r -> item == 'CGE News' or $r -> item == 'CGE em Movimento' or $r -> item == 'Mural de Comunicação Interna'){ ?>	
										<div id="<?php echo $id ?>" class="modal fade" role="dialog">
											<div class="modal-dialog modal-lg">
												<!-- Modal content-->
												<div class="modal-content">
												  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
														<div class="modal-title">
															<center><p class="comunicacao-cabecalho"><?php echo $r->titulo ?></p></center>
															<img src="../registros/fotos-noticias/<?php echo $imagem ?>"/ class="modal-card-foto">  
														</div>
												  </div>
												</div>
											</div>
									     </div>	
                                        <?php } ?>        
									<?php } ?>
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


<!-- chamando o bootstrap novamente para o modal funcionar -->
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/js_responsiveslides.js"></script>
 <link rel="stylesheet" href="css/responsiveslides.css">

<script>
  $(function() {
    $(".rslides").responsiveSlides();
  });
</script>

<script type="text/javascript">
	/*menu lateral*/
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>

<?php include('footer.php')?>