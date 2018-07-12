<?php 
include('../head.php');
include('../body.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Chamados ativos</p>
	</div>
	<?php include('../includes/mensagem.php') ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<?php include("verificacao_chamados_resolvidos.php") ?>
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 300px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th><center>Abertura            </center></th>
									<th><center>Natureza do problema</center></th>
									<th><center>Solicitante         </center></th>
									<th><center>Status              </center></th>
									<th><center>Avaliação           </center></th>
									<th><center>Ação                </center></th>
								</tr>	
							</thead>
							<tbody>
								<?php 
								
								if($_SESSION['funcao'] == 'TI'){
									$lista = retorna_chamados_ativos($conexao_com_banco);
								}else{
									$lista = retorna_chamados_ativos_servidor($_SESSION['id'], $conexao_com_banco);
								}
								
								while($r = mysqli_fetch_object($lista)){ $id = $r->ID ;
									//se ele for da TI e tiver chamados resolvidos e com avaliação, o chamado será destacado em amarelo para que ele possa encerrá-lo
										
										if($_SESSION['funcao'] == 'TI' and $r->NM_STATUS == 'RESOLVIDO' and $r->NM_AVALIACAO != "SEM AVALIAÇÃO"){
									?>
										<tr style="background-color:#f1c40f;">
										
									<?php 
									//se ele não for da TI e tiver chamados resolvidos e sem avaliação, o chamado será destacado em amarelo para que ele possa dar a nota
									
										}elseif($_SESSION['funcao'] != 'TI' and $r->NM_STATUS == 'RESOLVIDO' and $r->NM_AVALIACAO == "SEM AVALIAÇÃO"){ ?>
										
										<tr style="background-color:#f1c40f;">
									
									<?php //se não houver nenhuma dessas situações, o chamado não é destacado
										}else{ ?>
									
										<tr>
									
									<?php } ?>
									
										<td>
											<center>
												<?php echo date_format(new DateTime($r->DT_ABERTURA), 'd/m/Y H:i:s') ?>
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
												<?php echo $r -> NM_STATUS ?>
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