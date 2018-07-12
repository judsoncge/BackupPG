<?php include('../componentes/sessao/iniciar-sessao.php'); include('header.php'); include('body-padrao.php'); ?>

<!-- Conteúdo da Página -->
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Processos que estão comigo</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-sm-10">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Buscar por número do processo ou situação ou situação final" id="search"/>
								</div>
							</div>
							<div class="col-sm-2 col-xs-12 pull-right">
								<!-- Somente algumas pessoas podem abrir um processo -->
								<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'abrir_processo',$conexao_com_banco); if($permissao=='Sim'){ ?> <a href="abrir-processo.php?sessionId=<?php echo $num ?>" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Abrir processo</a><?php } ?>
							</div>
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 300px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Processo</th>
									<th>Prazo parcial</th>
									<th>Prazo final</th>
									<th>Situação</th>
									<th>Situação final</th>
									<th><center>+</center></th>
									<!-- Somente algumas pessoas que podem abrir um processo podem editá-lo -->
									<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'abrir_processo',$conexao_com_banco); if($permissao=='Sim'){ ?>
									<th><center><i class="fa fa-pencil" aria-hidden="true"></i></center></th>
									<?php } ?>
								</tr>	
							</thead>
							<tbody>
								<?php $lista = retorna_processo_comigo($conexao_com_banco);
								
								$total = 0; 
								while($r = mysqli_fetch_object($lista)){ 
								$total = $total+1; 
								$tipo = $r -> tipo;
								$processo = $r -> numero_processo; 
								$prazo = $r -> prazo; 
								$prazo_final = $r -> prazo_final; 
								$data_entrada = $r -> data_entrada; 
								$descricao = $r -> descricao;
								?>

								<?php 
									if($r -> situacao == 'Análise em atraso' or $r -> situacao_final == 'Finalização em atraso'){ ?>
									<!-- Se o processo estiver com análise ou finalização em atraso, a linha da tabela fica vermelha -->
										<tr style="background-color: #e74c3c; color:white;">
											<td><?php echo $r -> numero_processo; ?></td>
											<td><?php echo arruma_data($r -> prazo) ?></td>
											<td><?php echo arruma_data($r -> prazo_final) ?></td>
											<td><?php echo $r->situacao; ?></td>	
											<td><?php echo $r->situacao_final; ?></td>	
										    <!-- botão que quando apertado abre o modal -->
											<td>
												<center>
														<a href='processo-detalhes.php?sessionId=<?php echo $num ?>&processo=<?php echo $processo ?>'>
														<button id='detalhes' type='button' class='btn btn-default btn-sm' data-toggle='modal'
														data-target='#<?php echo $r -> id ?>'><i class='fa fa-eye' aria-hidden='true'></i></button></a>
													</center>
											</td>
											<!-- Somente algumas pessoas que podem abrir um processo podem editá-lo -->
											<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'abrir_processo',$conexao_com_banco); if($permissao=='Sim'){ ?>
											<td><center><a href="edita-processo.php?sessionId=<?php echo $num ?>&processo=<?php echo $r -> numero_processo ?>"><button type='button' class='btn btn-secondary btn-sm' title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></button></a></center></td>
											<?php } ?>
											
											<td id="ano-item"><?php echo $r -> ano ?></td>
										</tr>

								<?php }else{?>
										<!-- Se não tiver atrasado, a linha fica normal -->
										<tr>
											<td><?php echo $r -> numero_processo; ?></td>
											<td><?php echo arruma_data($r -> prazo) ?></td>
											<td><?php echo arruma_data($r -> prazo_final) ?></td>
											<td><?php echo $r->situacao; ?></td>	
											<td><?php echo $r->situacao_final; ?></td>	
										    <!-- botão que quando apertado abre o modal -->
											<td>
												<center>
														<a href='processo-detalhes.php?sessionId=<?php echo $num ?>&processo=<?php echo $processo ?>'>
														<button id='detalhes' type='button' class='btn btn-default btn-sm' data-toggle='modal'
														data-target='#<?php echo $r -> id ?>'><i class='fa fa-eye' aria-hidden='true'></i></button></a>
													</center>
											</td>											<!-- Somente algumas pessoas que podem abrir um processo podem editá-lo -->
											<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'abrir_processo',$conexao_com_banco); if($permissao=='Sim'){ ?><td><center><a href="edita-processo.php?sessionId=<?php echo $num ?>&processo=<?php echo $r -> numero_processo ?>"><button type='button' class='btn btn-secondary btn-sm' title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></button></a></center></td><?php } ?>
											<td id="ano-item"><?php echo $r -> ano ?></td>
										</tr>
								<?php }?>
											
								
							
					</div>
					<?php } ?>	
					</tbody>
					</table>
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

<?php include('footer.php')?>