<?php 
include('../head.php');
include('../body.php');
?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Solicitações de Sobrestado</p>
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
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> 
									<input type="text" class="input-search form-control" alt="tabela-dados" 
									placeholder="Busque por qualquer termo da tabela" id="search"/>
								</div>
							</div>
						</div>
					</div>
						
					<?php 
						
						$lista = retorna_lista_solicitacoes_sobrestado($conexao_com_banco);
						
					?>
					
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 300px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th><center>Número</center></th>
									<th><center>Solicitante</center></th>
									<th><center>Justificativa</center></th>
									<th><center>Data da Solicitação</center></th>
									<th><center>Ação</center></th>
								</tr>	
							</thead>
							<tbody>
								<?php 
									
									$l = mysqli_num_rows($lista);
									
									while($r = mysqli_fetch_object($lista)){ 
									
									$id = $r->ID;
									
									$id_processo = $r->ID_PROCESSO;
									
								?>
								<tr>
									<td>
										<center>
											<?php echo retorna_numero_processo($r->ID_PROCESSO, $conexao_com_banco) ?>
										</center>
									</td>
									<td>
										<center>
											<?php echo retorna_nome_servidor($r->ID_SERVIDOR_SOLICITANTE, $conexao_com_banco) ?>
										</center>
									</td>
									<td>
										<center>
											<?php echo $r->NM_JUSTIFICATIVA ?>
										</center>
									</td>
									<td>
										<center>
											<?php echo date_format(new DateTime($r->DT_SOLICITACAO), 'd/m/Y')?>
										</center>
									</td>
									<td>
										<?php if($r->NM_STATUS == 'SOLICITADO'){ ?>		
											<center>
												<a href="logica/editar.php?operacao=aceitar_sobrestado&id=<?php echo $id ?>&id_processo=<?php echo $id_processo ?>">ACEITAR</a>
						
												<a href="logica/editar.php?operacao=recusar_sobrestado&id=<?php echo $id ?>&id_processo=<?php echo $id_processo ?>">RECUSAR</a>
											</center>
										<?php } 
										
										if($r->NM_STATUS == 'ACEITO'){ ?>		
											<center>
												<a href="logica/editar.php?operacao=desmarcar_sobrestado&id=<?php echo $id_processo ?>">Desmarcar Sobrestado</a>
											</center>
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
</div>
</div>


<?php include('../foot.php')?>