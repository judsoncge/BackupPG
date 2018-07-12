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
		<p>Chamados inativos</p>
	</div>
	<?php include('../includes/mensagem.php') ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-sm-12">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Busque por qualquer termo da tabela" id="search" autofocus="autofocus" />
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 300px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th><center>Abertura            </center></th>
									<th><center>Fechamento          </center></th>
									<th><center>Natureza do problema</center></th>
									<th><center>Solicitante         </center></th>
									<th><center>Avaliação           </center></th>
									<th><center>Ação                </center></th>
								</tr>	
							</thead>
							<tbody>
							<?php 
							
							$lista = retorna_chamados_encerrados($conexao_com_banco);
							
							while($r = mysqli_fetch_object($lista)){ $id = $r->ID ?>
								<tr>
									<td>
										<center>
											<?php echo date_format(new DateTime($r->DT_ABERTURA), 'd/m/Y  H:i:s') ?>
										</center>
									</td>
									<td>
										<center>
											<?php echo date_format(new DateTime($r->DT_ENCERRAMENTO), 'd/m/Y  H:i:s') ?>
										</center>
									</td>
									<td>
										<center>
											<?php echo $r -> NM_NATUREZA ?>
										</center>
									</td>
									<td>
										<center>
											<?php echo retorna_nome_servidor($r -> ID_SERVIDOR_REQUISITANTE, $conexao_com_banco)?>
										</center>
									</td>
									<td>
										<center>
											<?php echo $r -> NM_AVALIACAO ?>
										</center>
									</td>
									
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
	<!-- informa o número de processos que está "comigo" -->
	<div class="pull-right" style="margin-right: 50px; margin-top: 20px;" id="qtde"></div>
</div>


<?php include('../foot.php')?>