<?php include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php'); ?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Todas as assiduidades</p>
	</div>
	<?php include('includes/mensagem.php') ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-sm-10">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Buscar por nome do servidor, nome do mês ou número do ano" id="search"/>
								</div>
							</div>
							<?php $permissao = retorna_permissao($_SESSION['CPF'],'AVALIAR_ASSIDUIDADE',$conexao_com_banco); if($permissao=='sim'){ ?>
								<div class="col-sm-2 col-xs-12 pull-right">
									<a href="avaliar-assiduidade.php?sessionId=<?php echo $num ?>" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Avaliar assiduidade</a>
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 300px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Servidor</th>
									<th>Mês</th>
									<th>Ano</th>
									<th>Esp.</th>
									<th>Trab.</th>
									<th>Abon.</th>
									<th>Nota</th>
									<th><center>Nota extra</center></th>
								</tr>	
							</thead>
							<tbody>
								<?php $lista = retorna_assiduidades($conexao_com_banco); $total = 0; 
								while($r = mysqli_fetch_object($lista)){ $total = $total+1; ?>
									<tr>
										<td><?php echo retorna_nome_servidor($r -> CD_SERVIDOR,$conexao_com_banco); ?></td>
										<td><?php echo arruma_data_mes2($r -> NR_MES) ?></td>
										<td><?php echo $r -> NR_ANO ?></td>
										<td><?php echo $r -> HR_ESPERADAS ?>h</td>
										<td><?php echo $r -> HR_TRABALHADAS ?>h</td>
										<td><?php echo $r -> HR_ABONADAS ?>h</td>
										<td><?php echo $r -> NR_NOTA ?></td>
										<?php $permissao = retorna_permissao($_SESSION['CPF'],'NOTA_EXTRA_INDICE_PRODUTIVIDADE',$conexao_com_banco); 
										if($r -> NR_NOTA_EXTRA == '0' and $permissao=='sim'){ ?>
											<td>
												<center>
													<form name="cadastro" method="POST" action="../componentes/indice-produtividade/logica/editar.php?sessionId=<?php echo $num ?>&operacao=extra&tipo=tb_produtividade&id=<?php echo $r->ID?>&servidor=<?php echo $r->CD_SERVIDOR ?>&mes=<?php echo $r -> NR_MES ?>&ano=<?php echo $r -> NR_ANO ?>&notaanterior=<?php echo $r -> NR_NOTA ?>" enctype="multipart/form-data">
														<div class="row">
															<div class="col-md-4">
																<input class="form-control" id="" name="extra" placeholder="Ponto extra" type="number" step="any" required/>
															</div>
															<div class="col-md-6">
																<input class="form-control" id="" name="justificativa" placeholder="Justificativa" type="text"/>
															</div>
															<div class="col-md-1">
																<button class="btn btn-sm btn-info pull-right" id="" style="margin-right:-15px; border-radius:0px;"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
															</div>
														</div>
													</form>
												</center>
											</td>
										<?php }else{ ?>
											<td>
												<center>
													<?php echo $r -> NR_NOTA_EXTRA . " / " . $r -> NM_JUSTIFICATIVA ?>
												</center>
											</td>
										<?php } ?>
									</tr>

								<?php } ?>			
					
						</tbody>
					</table>
				</div>
					
					
				</div>
			</div>
		</div>
	</div>
	<!-- informa o número de processos que está "comigo" -->
	<div class="pull-right" style="margin-right: 50px; margin-top: 20px;" id="qtde"></div>
</div>
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