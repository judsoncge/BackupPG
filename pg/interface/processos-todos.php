<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php')
?>

<!-- Conteúdo da Página -->
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Todos os Processos</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-sm-12">
								<div class="input-group margin-bottom-sm">
									<?php if(isset($_GET['filtro'])){ ?>
										<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" value='<?php echo $_GET['filtro'] ?>' class="input-search form-control" alt="tabela-dados" placeholder="Buscar número do processo, descrição, mês, ou responsável" id="search"/>
									<?php }else{ ?>
										<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Buscar número do processo, descrição, mês, ou responsável" id="search"/>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 300px;">
				
						<table class="table table-hover tabela-dados" id="tabela-dados">
							<thead>
								<tr>
									<th>Processo</th>
									<th>Dias no órgão</th>
									<th>Está com</th>
									<th>No setor</th>
									<th>Situação</th>
									<th>Situação final</th>
									
									
									
									<th><center>+</center></th>
									<th><center>Editar</center></th>
									
								</tr>	
							</thead>
							<tbody>
								<?php $lista = retorna_processos_todos($conexao_com_banco);
								
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
									<tr style="background-color: #e74c3c; color:white;">
										<td><?php echo $r -> numero_processo; ?></td>
										
										<td><?php echo retorna_dias_processo($processo, $conexao_com_banco) ?></td>	
										<td><?php echo retorna_nome_pessoa($r->estacom, $conexao_com_banco); ?></td>
										<td><?php echo retorna_nome_setor($r->status, $conexao_com_banco); ?></td>
										<td><?php echo $r->situacao; ?></td>	
										<td><?php echo $r->situacao_final; ?></td>											
										
									    <td>
												<center>
														<a href='processo-detalhes.php?sessionId=<?php echo $num ?>&processo=<?php echo $processo ?>'>
														<button id='detalhes' type='button' class='btn btn-default btn-sm'><i class='fa fa-eye' 
														aria-hidden='true'></i></button></a>
														
												</center>
												
												
										</td>
										
										<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'abrir_processo',$conexao_com_banco); if($permissao=='Sim'){ ?>
													<td><center><a href="edita-processo.php?sessionId=<?php echo $num ?>&processo=<?php echo $r -> numero_processo ?>"><button type='button' class='btn btn-secondary btn-sm' title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></button></a></center></td>
										<?php } ?>
										
										
										<td id="ano-item"><?php echo $r -> ano ?></td>
									</tr>

								<?php }else{?>
									<tr>
										<td><?php echo $r -> numero_processo; ?></td>
										
										<td><?php echo retorna_dias_processo($processo, $conexao_com_banco) ?></td>	
										<td><?php echo retorna_nome_pessoa($r->estacom, $conexao_com_banco); ?></td>	
										<td><?php echo retorna_nome_setor($r->status, $conexao_com_banco); ?></td>
										<td><?php echo $r->situacao; ?></td>	
										<td><?php echo $r->situacao_final; ?></td>	
										
									    <td>
												<center>
														<a href='processo-detalhes.php?sessionId=<?php echo $num ?>&processo=<?php echo $processo ?>'>
														<button id='detalhes' type='button' class='btn btn-default btn-sm'>
														<i class='fa fa-eye' aria-hidden='true'></i></button></a>
													</center>
											</td>
											
										<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'abrir_processo',$conexao_com_banco); if($permissao=='Sim'){ ?>
													<td><center><a href="edita-processo.php?sessionId=<?php echo $num ?>&processo=<?php echo $r -> numero_processo ?>"><button type='button' class='btn btn-secondary btn-sm' title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></button></a></center></td>
										<?php } ?>	
										
										
										<td id="ano-item"><?php echo $r -> ano ?></td>
									</tr>
								<?php }?>
											
								
								
							</div>
						</div>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
	
</div>
<!--<div class="pull-right" style="margin-right: 50px; margin-top: 5px;" id="qtde">Total de Processos: <?php echo $total ?></div>-->
<div class="pull-right" style="margin-right: 50px; margin-top: 20px;" id="qtde"></div>
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