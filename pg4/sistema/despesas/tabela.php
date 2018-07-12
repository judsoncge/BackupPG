<?php include('../includes/mensagem.php') ?>
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
							<?php if($_SESSION['permissao-cadastrar-despesa']=='sim'){ ?>
								<div class="col-sm-2 col-xs-12 pull-right">
									<a href="cadastrar.php" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Despesa</a>
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
									<th><center><i class="fa fa-pencil" aria-hidden="true"></center></i></th>
								</tr>	
							</thead>
							<tbody>
								<?php while($r = mysqli_fetch_object($lista)){ ?>
								<tr>
									<td><?php echo $r -> NM_DESPESA ?></td>
									<td><?php echo arruma_data($r -> DT_VENCIMENTO) ?></td>
									<td><?php echo "R$ " . arruma_numero($r -> VLR_DESPESA) ?></td>
									<td><?php echo $r -> NM_STATUS ?></td>
								    <td>									
										<a href='detalhes.php?despesa=<?php echo $r -> ID_DESPESA ?>'><button id='detalhes' type='button' class='btn btn-default btn-sm'><i class='fa fa-eye' aria-hidden='true'></i></button></a>
									</td>
									<?php if($r -> NM_STATUS == 'Solicitado' or $r -> NM_STATUS == 'Recusado' and $_SESSION['permissao-excluir-despesa']=='sim'){ ?>
										<td>
											<a href="logica/excluir.php?operacao=despesa&despesa=<?php echo $r -> ID_DESPESA ?>" onclick="return confirm('Você tem certeza que deseja apagar esta despesa?');">
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