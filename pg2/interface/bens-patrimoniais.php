<?php include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php'); 
verifica_caixa($conexao_com_banco);
atualiza_caixa($conexao_com_banco);
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Bens patrimoniais</p>
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
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Nº do patrimônio, descrição" id="search"/>
								</div>
							</div>
							<?php //$permissao = retorna_permissao_pessoa($_SESSION['CPF'],'cadastrar_financeiro',$conexao_com_banco); if($permissao=='Sim'){ ?>
							<div class="col-sm-2 col-xs-12 pull-right">
								<a href="cadastro-bem-patrimonial.php?sessionId=<?php echo $num ?>" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Novo Bem</a>
							</div>
							<?php //} ?>
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 320px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Classificação contábil</th>
									<th>Nº do patrimônio</th>
									<th>Descrição</th>
									<th>Valor da aquisição</th>
									<th>Valor líquido</th>
									<th><center>Ver detalhes</center></th>
									<th><center>Ação</center></th>
								</tr>	
							</thead>
							<tbody>
								<?php $lista = retorna_bens_patrimoniais($conexao_com_banco);
								while($r = mysqli_fetch_object($lista)){ ?>
								<tr>
									<td><?php echo $r -> NM_DENOMINACAO ?></td>
									<td><?php echo $r -> NM_PATRIMONIO ?></td>
									<td><?php echo $r -> DS_DESCRICAO ?></td>
									<td>R$ <?php echo arruma_numero($r -> VLR_AQUISICAO) ?></td>
									<td>R$ <?php echo arruma_numero($r -> VLR_LIQUIDO) ?></td>			
								    <td>
										<center>
											<a href='bem-patrimonial-detalhes.php?sessionId=<?php echo $num ?>&bem-patrimonial=<?php echo $r -> ID ?>'><button id='detalhes' type='button' class='btn btn-default btn-sm' data-toggle='modal'
											><i class='fa fa-eye' aria-hidden='true'></i></button></a>
										</center>
									</td>
									<td>
										<center>
											<a href='edita-bem-patrimonial.php?sessionId=<?php echo $num ?>&bem-patrimonial=<?php echo $id ?>&pagina='>
											<button type='button' class='btn btn-secondary btn-sm' title="Editar" >
											<i class="fa fa-pencil" aria-hidden="true"></i></button></a>
														
											<a href="../componentes/bem-patrimonial/logica/excluir.php?sessionId=<?php echo $num ?>&bem=<?php echo $r -> ID ?>&pagina=">
											<button type='button' class='btn btn-secondary btn-sm' title="Excluir" >
											<i class="fa fa-trash" aria-hidden="true"></i></button></a>
										</center>
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