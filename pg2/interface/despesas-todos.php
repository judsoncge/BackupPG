<?php include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php'); 
verifica_caixa($conexao_com_banco);
atualiza_caixa($conexao_com_banco);
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Despesas</p>
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
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Nome da despesa, Status" id="search"/>
								</div>
							</div>
							<?php $permissao = retorna_permissao($_SESSION['CPF'],'CADASTRAR_DESPESA',$conexao_com_banco); if($permissao=='sim'){ ?>
								<div class="col-sm-2 col-xs-12 pull-right">
									<a href="cadastro-despesa.php?sessionId=<?php echo $num ?>" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Despesa</a>
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 320px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Nome</th>
									<th>Data de vencimento</th>
									<th>Valor</th>
									<th>Status</th>
									<th>+</th>
									<th>Ação</th>
								</tr>	
							</thead>
							<tbody>
								<?php $lista = retorna_despesas_todos(date('Y'),$conexao_com_banco);
								while($r = mysqli_fetch_object($lista)){ ?>
								<tr>
									<td><?php echo retorna_nome_despesa($r -> CD_DESPESA, $conexao_com_banco) ?></td>
									<td><?php echo arruma_data($r -> DT_VENCIMENTO) ?></td>
									<td><?php echo "R$ " . arruma_numero($r -> VLR_DESPESA) ?></td>
									<td><?php echo $r -> NM_STATUS ?></td>
								    <td>									
										<a href='despesa-detalhes.php?sessionId=<?php echo $num ?>&despesa=<?php echo $r -> ID ?>
										&pagina='><button id='detalhes' type='button' class='btn btn-default btn-sm'><i class='fa fa-eye' aria-hidden='true'></i></button></a>
									</td>
									<?php if($r -> NM_STATUS == 'Solicitado'){ ?>
									<td>
										<a href='edita-despesa.php?sessionId=<?php echo $num ?>&despesa=<?php echo $r -> ID ?>&pagina='>
										<button type='button' class='btn btn-secondary btn-sm' title="Editar" >
										<i class="fa fa-pencil" aria-hidden="true"></i></button></a>
										
										<a href="../componentes/despesa/logica/excluir.php?sessionId=<?php echo $num ?>&despesa=<?php echo $r -> ID ?>&pagina=">
										<button type='button' class='btn btn-secondary btn-sm' title="Excluir" ><i class="fa fa-trash" aria-hidden="true"></i></button></a>
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
	<div class="pull-right" style="margin-right: 50px; margin-top: 20px;" id="qtde"></div>
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