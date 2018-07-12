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
							<?php if($_SESSION['permissao-cadastrar-receita']=='sim'){ ?>
								<div class="col-sm-2 col-xs-12 pull-right">
									<a href="cadastrar.php" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Receita</a>
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 320px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Nome</th>
									<th>Mês</th>
									<th>Ano</th>
									<th>Descrição</th>
									<th>Valor</th>
									<th><center><i class="fa fa-pencil" aria-hidden="true"></center></i></th>
								</tr>	
							</thead>
							<tbody>
								<?php $lista = retorna_receitas($conexao_com_banco);
								while($r = mysqli_fetch_object($lista)){ ?>
								<tr>
									<td><?php echo $r -> NM_RECEITA ?></td>
									<td><?php echo $r -> NR_MES ?></td>
									<td><?php echo $r -> NR_ANO ?></td>
									<td><?php echo $r -> DS_RECEITA ?></td>
									<td><?php echo "R$ " . arruma_numero($r -> VLR_RECEITA) ?></td>
									<td>
										<?php 
										$pode_excluir = retorna_pode_excluir_receita($r -> VLR_RECEITA, $r -> NR_MES, $r -> NR_ANO, $conexao_com_banco);
										if($_SESSION['permissao-excluir-receita']=='sim' and $pode_excluir==true){ ?>
											<a href="logica/excluir.php?receita=<?php echo $r -> ID ?>&ano=<?php echo $r -> NR_ANO ?>&mes=<?php echo $r -> NR_MES ?>&valor=<?php echo $r -> VLR_RECEITA ?>" onclick="return confirm('Você tem certeza que deseja apagar esta receita?');"><button type='button' class='btn btn-secondary btn-sm' title="Excluir" ><i class="fa fa-trash" aria-hidden="true"></i></button></a>
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
	</div>
	<div class="pull-right" style="margin-right: 50px; margin-top: 20px;" id="qtde"></div>