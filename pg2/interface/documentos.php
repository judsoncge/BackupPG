<?php 
include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php');

?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Documentos ativos que estão comigo</p>
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
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Buscar pela atividade, documento, pessoa, data, status" id="search"/>
								</div>
							</div>							
							
							<?php $permissao = retorna_permissao($_SESSION['CPF'],'CADASTRAR_DOCUMENTO',$conexao_com_banco); if($permissao=='sim'){ ?>
								<div class="col-sm-2 col-xs-12 pull-right">
									<a href="cadastro-documento.php?sessionId=<?php echo $num ?>" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i>Novo Documento</a>
								</div>
							<?php } ?>
	
						
						</div>
					</div>
						<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 320px;">
							<table class="table table-hover tabela-dados">
								<thead>
									<tr>
										<th>Número do processo</th>
										<th>Tipo</th>
										<th>Prazo para resposta</th>
										<th>Status</th>
										<th>Criado por</th>
										<th><center>Ver detalhes</center></th>
										<th><center>Ação</center></th>
									</tr>	
								</thead>
								<tbody>
									<?php $lista = retorna_documentos_com_servidor($_SESSION['CPF'],$conexao_com_banco);
										while($r = mysqli_fetch_object($lista)){ 
											$id = $r->CD_DOCUMENTO ?>
											<tr>
												<td><a href='processo-detalhes.php?sessionId=<?php echo $num ?>&processo=<?php echo $r -> CD_PROCESSO ?>'><?php echo $r -> CD_PROCESSO ?></a></td>
												<td><?php echo $r -> NM_DOCUMENTO ?></td>
												<td><?php echo arruma_data($r -> DT_PRAZO) ?></td>
												<td><?php echo $r -> NM_STATUS ?></td>
												<td><?php echo retorna_nome_servidor($r -> CD_SERVIDOR_CRIACAO, $conexao_com_banco) ?></td>
												<td>
													<center>
														<a href='documento-detalhes.php?sessionId=<?php echo $num ?>&documento=<?php echo $id ?>'>
														<button id='detalhes' type='button' class='btn btn-default btn-sm' data-toggle='modal'
														><i class='fa fa-eye' aria-hidden='true'></i></button></a>
													</center>
												</td>
												<td>
													<center>
													<?php $permissao = retorna_permissao($_SESSION['CPF'],'EDITAR_DOCUMENTO',$conexao_com_banco); if($permissao=='sim'){	?>
														<a href='edita-documento.php?sessionId=<?php echo $num ?>&documento=<?php echo $id ?>&pagina='>
														<button type='button' class='btn btn-secondary btn-sm' title="Editar" >
														<i class="fa fa-pencil" aria-hidden="true"></i></button></a>
													
													<?php } $permissao = retorna_permissao($_SESSION['CPF'],'EXCLUIR_DOCUMENTO',$conexao_com_banco); if($permissao=='sim'){	?>
													
														<a href="../componentes/documento/logica/excluir.php?sessionId=<?php echo $num ?>&documento=<?php echo $r -> CD_DOCUMENTO ?>&pagina=">
														<button type='button' class='btn btn-secondary btn-sm' title="Excluir" >
														<i class="fa fa-trash" aria-hidden="true"></i></button></a>
													
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
	<div class="pull-right" style="margin-right: 50px; margin-top: 20px;" id="qtde"></div>
	</div>
</div>
<!-- /#Conteúdo da Página/-->

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