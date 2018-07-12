<?php
include('../head.php');
include('../body.php'); 
verificar_permissao_pagina($_SESSION['permissao-visualizar-financeiro'], $conexao_com_banco);
$mes = date('m'); 
$ano = date('Y'); 
?>

<script type="text/javascript">
	function mostrarDetalhes(id){
		$('.' + id).toggle();
	}
</script>


<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
	<div>
		<div style="display: inline-block;">
			<p>Lançamentos de <?php echo $ano ?></p>
		</div>
		  
		  <div style="
			display: inline-block;
			float: right;
			height: 100%;">
				<a  href="relatorio-analitico.php" class="btn btn-sm btn-info" style="vertical-align:;vertical-align: middle;"  download><i class="fa fa-list"></i> Baixar Relatório Analítico</a>
			</div>   
	</div>
		
		
		</p>
		<?php include('../includes/resumo_caixa.php'); ?>
	</div>
	<?php include('../includes/mensagem.php') ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; padding: 20px 15px;">
						<div class="row">
							<div class="col-sm-6">
								<h3>Receitas</h3>
							</div>			
						</div>
							<table class="table table-hover tabela-dados tabela-fluxo">
								<thead>
									<tr>
										<th>Descrição</th>
										<th>Jan</th>
										<th>Fev</th>
										<th>Mar</th>
										<th>Abr</th>
										<th>Mai</th>
										<th>Jun</th>
										<th>Jul</th>
										<th>Ago</th>
										<th>Set</th>
										<th>Out</th>
										<th>Nov</th>
										<th>Dez</th>
									</tr>	
								</thead>
								<tbody>
								<tr>
									<td>Saldo do mês anterior</td>
									<?php for($i=1;$i<13;$i++){ ?>
											<?php if($i==1){ ?>
												<td>-</td>
											<?php }else if($i<=$mes){ ?>
												<td><?php echo arruma_numero(retorna_saldo($i-1, $ano, $conexao_com_banco)) ?></td>
											<?php }else if($i>$mes){ ?>
												<td><?php echo "0,00"; ?></td>
											<?php } ?>
									<?php } ?>
								</tr>
									
									<?php $lista = retorna_receitas_ano($ano,$conexao_com_banco);
									while($r = mysqli_fetch_object($lista)){ ?>
										<tr>
											<td><?php echo $r->NM_RECEITA;?></td>
											
											<?php for($i=1;$i<13;$i++){ ?>
												<td>
													<?php 
														$valor_receita = retorna_valor_receita($r->CD_RECEITA,$i,$ano,$conexao_com_banco); 
														echo arruma_numero($valor_receita); 
													?><br>
												</td>
											<?php } ?>
										</tr>
									<?php } ?>	
								</tbody>
						</table>
					</div>
					
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; padding: 20px 15px;">
						<div class="row">
							<div class="col-sm-6">
								<h3>Despesas fixas</h3>
							</div>	
						</div>
							<table class="table table-hover tabela-dados tabela-fluxo">
								<thead>
									<tr>
										<th>Descrição</th>
										<th>Jan</th>
										<th>Fev</th>
										<th>Mar</th>
										<th>Abr</th>
										<th>Mai</th>
										<th>Jun</th>
										<th>Jul</th>
										<th>Ago</th>
										<th>Set</th>
										<th>Out</th>
										<th>Nov</th>
										<th>Dez</th>
									</tr>	
								</thead>
								<tbody>
									<?php 
									$lista = retorna_despesas_tipo('Fixa', $ano, $conexao_com_banco); 
									while($r = mysqli_fetch_object($lista)){ $codigo = $r->CD_DESPESA;
									?>
									
										<tr>
											<td><a href="javascript:void(0)" onclick="mostrarDetalhes('<?php echo str_replace(".","",$r->CD_DESPESA);  ?>')"><i class="fa fa-plus-circle"></i> </a><?php echo $r->NM_DESPESA;  ?></td>
											
											<?php for($i=1;$i<13;$i++){ ?>
												<td>
													<?php $valor_despesa = retorna_valor_despesa_paga($r->CD_DESPESA,$i,$ano,$conexao_com_banco); 
													echo arruma_numero($valor_despesa);
													?>
												</td>
											<?php } ?>
										</tr>
									
								
									<?php 
									$lista2 = retorna_descricoes_despesa($codigo, $ano, $conexao_com_banco); 
									while($r2 = mysqli_fetch_object($lista2)){ 
									?>
										<tr style="display:none;" class="<?php echo str_replace(".","",$r->CD_DESPESA) ?>">
											<td id="despesa-abs"><?php echo $r2->DS_DESPESA;  ?></td>
											
											<?php for($i=1;$i<13;$i++){ ?>
												<td id="despesa-abs">
													<?php $valor_despesa = retorna_valor_despesa_paga_descricao($r2->CD_DESPESA,$r2->DS_DESPESA,$i,$ano,$conexao_com_banco); 
													echo arruma_numero($valor_despesa);
													?>
												</td>
											<?php } ?>
										</tr>
									<?php } ?>
									
								<?php } ?>
								
								</tbody>
						</table>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; padding: 20px 15px;">
						<div class="row">
							<div class="col-sm-6">
								<h3>Despesas variáveis</h3>
							</div>	
						</div>
							<table class="table table-hover tabela-dados tabela-fluxo">
								<thead>
									<tr>
										<th>Descrição</th>
										<th>Jan</th>
										<th>Fev</th>
										<th>Mar</th>
										<th>Abr</th>
										<th>Mai</th>
										<th>Jun</th>
										<th>Jul</th>
										<th>Ago</th>
										<th>Set</th>
										<th>Out</th>
										<th>Nov</th>
										<th>Dez</th>
									</tr>	
								</thead>
								<tbody>
									<?php 
									$lista = retorna_despesas_tipo('Variável', $ano, $conexao_com_banco); 
									while($r = mysqli_fetch_object($lista)){ $codigo = $r->CD_DESPESA;
									?>
									
										<tr>
											<td><a href="javascript:void(0)" onclick="mostrarDetalhes('<?php echo str_replace(".","",$r->CD_DESPESA);  ?>')"><i class="fa fa-plus-circle"></i> </a><?php echo $r->NM_DESPESA;  ?></td>
											
											<?php for($i=1;$i<13;$i++){ ?>
												<td>
													<?php $valor_despesa = retorna_valor_despesa_paga($r->CD_DESPESA,$i,$ano,$conexao_com_banco); 
													echo arruma_numero($valor_despesa);
													?>
												</td>
											<?php } ?>
										</tr>
									
								
									<?php 
									$lista2 = retorna_descricoes_despesa($codigo, $ano, $conexao_com_banco); 
									while($r2 = mysqli_fetch_object($lista2)){ 
									?>
										<tr style="display:none;" class="<?php echo str_replace(".","",$r->CD_DESPESA) ?>">
											<td id="despesa-abs"><?php echo $r2->DS_DESPESA;  ?></td>
											
											<?php for($i=1;$i<13;$i++){ ?>
												<td id="despesa-abs">
													<?php $valor_despesa = retorna_valor_despesa_paga_descricao($r2->CD_DESPESA,$r2->DS_DESPESA,$i,$ano,$conexao_com_banco); 
													echo arruma_numero($valor_despesa);
													?>
												</td>
											<?php } ?>
										</tr>
									<?php } ?>
									
								<?php } ?>
								</tbody>
						</table>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; padding: 20px 15px;">
						<div class="row">
							<div class="col-sm-12">
								<h3>Saldo</h3>
							</div>
						</div>
							<table class="table table-hover tabela-dados tabela-fluxo">
								<thead>
									<tr>
										<th>Descrição</th>
										<th>Jan</th>
										<th>Fev</th>
										<th>Mar</th>
										<th>Abr</th>
										<th>Mai</th>
										<th>Jun</th>
										<th>Jul</th>
										<th>Ago</th>
										<th>Set</th>
										<th>Out</th>
										<th>Nov</th>
										<th>Dez</th>
									</tr>	
								</thead>
								<tbody>
									<tr>
										<td><?php echo "Total de Receitas" ?></td>
										<?php for($i=1;$i<13;$i++){ ?>
											<?php if($i<=$mes){ ?>
												<td><?php $total_receitas = retorna_total_receitas_mes_ano($i, $ano, $conexao_com_banco); echo arruma_numero($total_receitas); ?></td>
											<?php }else{ ?>
												<td><?php echo "0,00"; ?></td>
											<?php } ?>
										<?php } ?>
									</tr>
									<tr>
										<td><?php echo "Total de Despesas Fixas" ?></td>
										<?php for($i=1;$i<13;$i++){ ?>
											<td><?php $total_despesas_fixas = retorna_total_despesas_mes_ano_tipo($i, $ano, 'Fixa', $conexao_com_banco); echo arruma_numero($total_despesas_fixas); ?></td>
										<?php } ?>
									</tr>
									<tr>
										<td><?php echo "Total de Despesas Variáveis" ?></td>
										<?php for($i=1;$i<13;$i++){ ?>
											<td><?php $total_despesas_variaveis = retorna_total_despesas_mes_ano_tipo($i, $ano, 'Variável', $conexao_com_banco); echo arruma_numero($total_despesas_variaveis); ?></td>										
										<?php } ?>
									</tr>
									<tr>
										<td><?php echo "Saldo" ?></td>
										<?php for($i=1;$i<13;$i++){ ?>
											<?php if($i<=$mes){ ?>
												<td><?php echo arruma_numero(retorna_saldo($i, $ano, $conexao_com_banco)) ?></td>
											<?php }else{ ?>
												<td><?php echo "0,00"; ?></td>
											<?php } ?>
										<?php } ?>
									</tr>
								</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include('../foot.php')?>