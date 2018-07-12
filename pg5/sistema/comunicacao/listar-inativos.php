<?php 
include('../head.php');
include('../body.php');
if($_SESSION['funcao'] != 'COMUNICAÇÃO' and $_SESSION['funcao'] != 'TI'){
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home.php?mensagem=Você não tem permissão para acessar essa página.&resultado=falha'>";
}
?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Comunicação Inativa</p>
	</div>
	<?php include('../includes/mensagem.php') ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-sm-10">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> 
									<input type="text" class="input-search form-control" alt="tabela-dados" 
									placeholder="Busque por qualquer termo da tabela" id="search"/>
								</div>
							</div>
							<?php if($_SESSION['funcao'] == 'COMUNICAÇÃO' or $_SESSION['funcao'] == 'TI'){ ?>
								<div class="col-sm-2 pull-right">
									<a href="cadastrar.php" id="botao-cadastrar">
									<i class="fa fa-plus-circle"></i> Comunicação</a>
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 320px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Chapéu</th>
									<th>Título</th>
									<th>Data</th>
									<th>Status</th>
                                    <th>Ação </th>
								</tr>	
							</thead>
							<tbody>
								<?php 
								$lista = retorna_comunicacoes_inativas($conexao_com_banco);
								while($r = mysqli_fetch_object($lista)){		
									$id = $r->ID;	
								?>
								<tr>
									<td><?php echo $r->NM_CHAPEU ?></td>
									<td><?php echo $r->NM_TITULO ?></td>
									<td>
										<center>
											<?php echo date_format(new DateTime($r->DT_PUBLICACAO), 'd/m/Y') ?>
										</center>
									</td>
									<td><?php echo $r->NM_STATUS ?></td>
									<td>	
										<center>
											<a href="detalhes.php?id=<?php echo $id ?>">
												<button type='button' class='btn btn-secondary btn-sm' title="Detalhes e operações">
													<i class="fa fa-eye" aria-hidden="true"></i>
												</button>
											</a>
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
</div>

</div>
<!-- /#Conteúdo da Página/-->

</div>
<!-- /#wrapper -->


<?php include('../foot.php')?>