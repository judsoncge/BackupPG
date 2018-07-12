<?php include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php'); 
?>

<!-- Conteúdo da Página -->
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Todos os processos ativos que estão no meu setor</p>
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
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Buscar por número do processo ou situação ou situação final" id="search" autofocus="autofocus" />
								</div>
							</div>
							<div class="col-sm-2 col-xs-12 pull-right">
									<a href="pdf-processos.php?sessionId=<?php echo $num ?>&tipo=setor" class="btn btn-sm btn-info pull-right"><i class="fa fa-file"></i> Gerar PDF</a>
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
									<th>Está com</th>
									<th>Dias no órgão</th>
									<th><center>+</center></th>
									<!-- Somente algumas pessoas que podem abrir um processo podem editá-lo -->
									<th><center><i class="fa fa-pencil" aria-hidden="true"></i></center></th>
								</tr>	
							</thead>
							<tbody>
								<?php $lista = retorna_processos_setor($_SESSION['setor'],$conexao_com_banco);
								
								$total = 0; 
								while($r = mysqli_fetch_object($lista)){ 
								$total = $total+1; 
								
								?>

								<?php 
									if($r -> NM_SITUACAO == 'Análise em atraso' or $r -> NM_SITUACAO_FINAL == 'Finalização em atraso'){ ?>
									<!-- Se o processo estiver com análise ou finalização em atraso, a linha da tabela fica vermelha -->
									<tr style="background-color: #e74c3c; color:white;"> <?php } ?>
										<tr>	
											<td><?php echo $r -> CD_PROCESSO; ?></td>
											<td><?php echo arruma_data($r -> DT_PRAZO) ?></td>
											<td><?php echo arruma_data($r -> DT_PRAZO_FINAL) ?></td>
											<td><?php echo $r-> NM_SITUACAO; ?></td>	
											<td><?php echo $r-> NM_SITUACAO_FINAL; ?></td>	
											<td><?php echo retorna_nome_servidor($r-> CD_SERVIDOR_LOCALIZACAO, $conexao_com_banco); ?></td>	
											<td><?php echo $r-> NR_DIAS; ?></td>	
										    <!-- botão que quando apertado abre o modal -->
											<?php $permissao = retorna_permissao($_SESSION['CPF'],'FAZER_OPERACOES_OUTROS_SETOR',$conexao_com_banco); 
											if($permissao=='sim' or $r-> CD_SERVIDOR_LOCALIZACAO == $_SESSION['CPF']){ ?>
											<td>
												<center>
														<a href='processo-detalhes.php?sessionId=<?php echo $num ?>&processo=<?php echo $r -> CD_PROCESSO ?>
														&pagina=-setor'><button id='detalhes' type='button' class='btn btn-default btn-sm' data-toggle='modal'
														data-target='#<?php echo $r -> id ?>'><i class='fa fa-eye' aria-hidden='true'></i></button></a>
												</center>
											</td>
											<?php } ?>
											<!-- Somente algumas pessoas que podem abrir um processo podem editá-lo -->
											<td>
												<center>
													<?php $permissao = retorna_permissao($_SESSION['CPF'],'EDITAR_PROCESSO',$conexao_com_banco); $permissao2 = retorna_permissao($_SESSION['CPF'],'FAZER_OPERACOES_OUTROS_SETOR',$conexao_com_banco); if($permissao=='sim' and $permissao2=='sim'){ ?>
														<a href="edita-processo.php?sessionId=<?php echo $num ?>&processo=<?php echo $r -> CD_PROCESSO ?>&pagina=-setor"><button type='button' class='btn btn-secondary btn-sm' title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
													<?php } ?>
													<?php $permissao = retorna_permissao($_SESSION['CPF'],'EXCLUIR_PROCESSO',$conexao_com_banco); $permissao2 = retorna_permissao($_SESSION['CPF'],'FAZER_OPERACOES_OUTROS_SETOR',$conexao_com_banco); if($permissao=='sim' and $permissao2=='sim'){?>
														<a href="../componentes/processo/logica/excluir.php?sessionId=<?php echo $num ?>&processo=<?php echo $r -> CD_PROCESSO ?>&pagina=-setor"><button type='button' class='btn btn-secondary btn-sm' title="Excluir"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
													<?php } ?>
												</center>
											</td>
											
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