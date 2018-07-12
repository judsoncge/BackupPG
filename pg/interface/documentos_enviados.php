<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php')

?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Documentos que já foram enviados por mim</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-sm-12">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Buscar pela atividade, documento, pessoa, data, status" id="search"/>
								</div>
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
										<th>Está com</th>
										<th><center>Ver detalhes</center></th>
									</tr>	
								</thead>
								<tbody>
									<?php $lista = retorna_documentos_enviados($conexao_com_banco);
										while($r = mysqli_fetch_object($lista)){ 
											$id = $r->id ?>
											<tr>
												<td><?php echo $r -> Processo_numero ?></td>
												<td><?php echo $r -> tipo_atividade ?></td>
												<td><?php echo $r -> tipo_documento ?></td>
												<td><?php echo arruma_data($r -> prazo) ?></td>
												<td><?php echo $r -> status ?></td>
												<td><?php echo retorna_nome_pessoa($r->estacom, $conexao_com_banco); ?></td>
												<td>
													<center>
														<a href='documento-detalhes.php?sessionId=<?php echo $num ?>&documento=<?php echo $id ?>'>
														<button id='detalhes' type='button' class='btn btn-default btn-sm' data-toggle='modal'
														data-target='#<?php echo $r -> id ?>'><i class='fa fa-eye' aria-hidden='true'></i></button></a>
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

<?php include('footer.php')?>