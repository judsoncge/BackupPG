<?php include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php'); 
verifica_caixa($conexao_com_banco);
atualiza_caixa($conexao_com_banco);
$ano = date('Y');
$mes = date('m');
$valor = retorna_caixa_mes_ano($mes, $ano, $conexao_com_banco);
?>

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
				<a  href="relatoriofinanceiro.php?sessionId=<?php echo $num ?>" class="btn btn-sm btn-info" style="vertical-align:;vertical-align: middle;" super;"="" download=""><i class="fa fa-list"></i> Baixar Relatório</a>
			</div>
        
	</div>
		
		
		</p>
		<?php include('includes/resumo_caixa.php'); ?>
	</div>
	<?php include('includes/mensagem.php') ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; padding: 20px 15px;">
						<div class="row">
							<div class="col-sm-6">
								<h3>Receitas</h3>
							</div>
							<?php $permissao = retorna_permissao($_SESSION['CPF'],'CADASTRAR_RECEITA',$conexao_com_banco); if($permissao=='sim'){ ?>			
								<div class="col-sm-6">
									<a href="cadastro-receita.php?sessionId=<?php echo $num ?>" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Receita</a>
								</div>
							<?php } ?>
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
									
									<?php $lista = retorna_receitas($ano,$conexao_com_banco); 
									while($r = mysqli_fetch_object($lista)){ ?>
										<tr>
											<td><?php $nome_receita = retorna_nome_receita($r->CD_RECEITA,$conexao_com_banco); echo $nome_receita;  ?></td>
											
											<?php for($i=1;$i<13;$i++){ ?>
												<td><?php $valor_receita = retorna_valor_receita($r->CD_RECEITA,$i,$ano,$conexao_com_banco); echo arruma_numero($valor_receita) ; ?></td>
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
							<div class="col-sm-6">
								<a href="cadastro-despesa.php?sessionId=<?php echo $num ?>" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Despesa</a>
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
									<?php $lista = retorna_despesas_tipo('Fixa', $ano, $conexao_com_banco); 
								while($r = mysqli_fetch_object($lista)){ ?>
									<tr>
										<td><?php $nome_despesa = retorna_nome_despesa($r->CD_DESPESA,$conexao_com_banco); echo $nome_despesa;  ?></td>
										
										<?php for($i=1;$i<13;$i++){ ?>
											<td><?php $valor_despesa = retorna_valor_despesa_paga($r->CD_DESPESA,$i,$ano,$conexao_com_banco); echo arruma_numero($valor_despesa) ; ?></td>
										<?php } ?>
										
									</tr>
								<?php } ?>
								</tbody>
						</table>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; padding: 20px 15px;">
						<div class="row">
							<div class="col-sm-6">
								<h3>Despesas variáveis</h3>
							</div>	
							<div class="col-sm-6">
								<a href="cadastro-despesa.php?sessionId=<?php echo $num ?>" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Despesa</a>
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
									<?php $lista = retorna_despesas_tipo('Variável', $ano, $conexao_com_banco); 
								while($r = mysqli_fetch_object($lista)){ ?>
									<tr>
										<td><?php $nome_despesa = retorna_nome_despesa($r->CD_DESPESA,$conexao_com_banco); echo $nome_despesa;  ?></td>
										
										<?php for($i=1;$i<13;$i++){ ?>
											<td><?php $valor_despesa = retorna_valor_despesa_paga($r->CD_DESPESA,$i,$ano,$conexao_com_banco); echo arruma_numero($valor_despesa) ; ?></td>
										<?php } ?>
									
									</tr>
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