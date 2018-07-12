<?php 
include('../head.php');
include('../body.php');
if($_SESSION['funcao'] != 'TI'){
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home.php?mensagem=Você não tem permissão para acessar essa página.&resultado=falha'>";
}
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Servidores inativos</p>
	</div>
	
	<?php include('../includes/mensagem.php') ?>
	
	<div class="container caixa-conteudo">
		<div class="row">
		
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<?php if($_SESSION['funcao'] == 'TI'){ ?>	
							<div class="row">
								<div class="col-sm-10">
									<div class="input-group margin-bottom-sm">
										<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Busque por qualquer termo da tabela" id="search" autofocus="autofocus" />
									</div>
								</div>
								<div class="col-sm-2 pull-right">
									<a href="cadastrar.php" id="botao-cadastrar">
									<i class="fa fa-plus-circle"></i> Novo servidor</a>
								</div>
							</div>
						<?php } else{ ?>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group margin-bottom-sm">
										<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Busque por qualquer termo da tabela e status" id="search" autofocus="autofocus" />
									</div>
								</div>
							</div>
						<?php } ?>


					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 300px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th><center>CPF</center></th>
									<th><center>Nome</center></th>
									<th><center>Ação</center></th>
								</tr>	
							</thead>
							<tbody>
								<?php 
									$lista = retorna_servidores_status("INATIVO", $conexao_com_banco);
									while($r = mysqli_fetch_object($lista)){ $id = $r->ID 
								?>
								
									<tr>
										<td>
											<center>
												<?php echo $r->CD_SERVIDOR; ?>
											</center>
										</td>
										<td>
											<center>
												<?php echo $r->NM_SERVIDOR; ?>
											</center>
										</td>								
										<td>
											<center>
											
												<a href="logica/editar.php?operacao=status&status=ATIVO&id=<?php echo $id ?>">		
													<button type='button' class='btn btn-secondary btn-sm' title="Reativar">
														<i class="fa fa-plus-square" aria-hidden="true"></i>
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
		<!-- informa o número de processos que está "comigo" -->
		<div class="pull-right" style="margin-right: 50px; margin-top: 20px;" id="qtde"></div>
	</div>


<?php include('../foot.php')?>