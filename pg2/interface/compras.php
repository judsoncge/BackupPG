<?php include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php');
?>

<!-- Conteúdo da Página -->
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Compras em andamento</p>
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
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Buscar pela descrição, processo, mês, ano, valor ou status" id="search" autofocus="autofocus" />
								</div>
							</div>
							<?php $permissao = retorna_permissao($_SESSION['CPF'],'ABRIR_PROCESSO',$conexao_com_banco); if($permissao=='sim'){ ?>
								<div class="col-sm-2 col-xs-12 pull-right">
									<!-- Somente algumas pessoas podem abrir um processo -->
									<a href="solicitar-compra.php?sessionId=<?php echo $num ?>" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Solicitação</a>
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 300px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Solicitante</th>
									<th>Processo</th>
									<th>Data da Solicitação</th>
									<th>Prazo</th>
									<th>Valor</th>
									<th>Status</th>
									<th><center>+</center></th>
								</tr>	
							</thead>
							<tbody>
								<?php 
								$lista = retorna_compras_andamento_servidor($_SESSION['CPF'], $conexao_com_banco);
								while($r = mysqli_fetch_object($lista)){ 
								?>
								<tr>
									<td><?php echo retorna_nome_servidor($r -> CD_SERVIDOR_SOLICITANTE, $conexao_com_banco); ?></td>
									<td><a href='processo-detalhes.php?sessionId=<?php echo $num ?>&processo=<?php echo $r -> CD_PROCESSO ?>&pagina='><?php echo $r -> CD_PROCESSO; ?></a></td>
									<td><?php echo arruma_data($r -> DT_SOLICITACAO) ?></td>
									<td><?php echo arruma_data($r -> DT_PRAZO); ?></td>
									<td><?php if($r-> VLR_COMPRA==0){echo 'Sem valor definido';}else{echo arruma_numero($r-> VLR_COMPRA);} ?></td>	
									<td><?php echo $r-> NM_STATUS; ?></td>					
									<td>
										<center>
											<a href='compra-detalhes.php?sessionId=<?php echo $num ?>&compra=<?php echo $r -> CD_COMPRA ?>'>
											<button id='detalhes' type='button' class='btn btn-default btn-sm' data-toggle='modal'
											><i class='fa fa-eye' aria-hidden='true'></i></button></a>
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