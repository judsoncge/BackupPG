<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php')

?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Documentos que estão comigo</p>
	</div>
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
								<div class="col-sm-2 col-xs-12 pull-right">
									<a href="cadastro-documento.php?sessionId=<?php echo $num ?>" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i>Novo Documento</a>
								</div>
								
						</div>
					</div>
						<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 320px;">
							<table class="table table-hover tabela-dados">
								<thead>
									<tr>
										<th>Número do processo</th>
										<th>Atividade</th>
										<th>Tipo</th>
										<th>Prazo para resposta</th>
										<th>Status</th>
										<th><center>Ver detalhes</center></th>
										<th>Excluir</th>
									</tr>	
								</thead>
								<tbody>
									<?php $lista = retorna_documentos_comigo($conexao_com_banco);
										while($r = mysqli_fetch_object($lista)){ 
											$id = $r->id ?>
											<tr>
												<td><?php echo $r -> Processo_numero ?></td>
												<td><?php echo $r -> tipo_atividade ?></td>
												<td><?php echo $r -> tipo_documento ?></td>
												<td><?php echo arruma_data($r -> prazo) ?></td>
												<td><?php echo $r -> status ?></td>
												
												
												<td>
													<center>
														<a href='documento-detalhes.php?sessionId=<?php echo $num ?>&documento=<?php echo $id ?>'>
														<button id='detalhes' type='button' class='btn btn-default btn-sm' data-toggle='modal'
														data-target='#<?php echo $r -> id ?>'><i class='fa fa-eye' aria-hidden='true'></i></button></a>
													</center>
												</td>
												<td>
												<?php if($r->status=='Em análise'){ ?>
												<a href='../componentes/documento/logica/excluir.php?documento=<?php echo $id ?>'>
												<button type='button' class='btn btn-secondary btn-sm' title="Excluir">
												<i class="fa fa-trash" aria-hidden="true"></i></button></a>
												<?php } ?>
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

<?php include('footer.php')?>