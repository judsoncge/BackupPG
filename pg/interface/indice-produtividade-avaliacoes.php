<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
$permissao = retorna_permissao_pessoa($_SESSION['CPF'],'visualizar_indice_produtividade',$conexao_com_banco); if($permissao=='Não'){
	echo "<script>history.back();</script>";
	echo "<script>alert('Você não tem permissão para estar nesta página')</script>";
}
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Avaliações do mês de <?php echo arruma_data_mes2(date('m')-1) . ' de ' . date('Y')?></p>
	</div>
	<div class="container caixa-conteudo">
		
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-sm-12">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Buscar pelo beneficiário, valor pago, quantidade de diárias, destino ou ano" id="search" />
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 320px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Servidor avaliado</th>
									<th>Tipo</th>
									<th>Nota geral</th>
									<th>Ponto extra</th>
																	
									<th id="ano">Ano</th>
								</tr>	
							</thead>
					<tbody>
								<?php $lista = retorna_avaliacoes($conexao_com_banco);
								while($r = mysqli_fetch_object($lista)){ $data=$r -> data_avaliacao;?>
								
								<tr>
									<td><?php $pessoa = retorna_nome_pessoa($r -> servidor_avaliado, $conexao_com_banco); echo $pessoa ?></td>
									<td><?php echo $r -> tipo_avaliacao ?></td>
									<td><?php echo $r -> nota_avaliacao ?></td>
									<td><?php if(($r->ponto_extra == 0 or $r->ponto_extra == null) and $r->nota_avaliacao!=10){ ?>
											<center>
											<form name="cadastro" method="POST" action="../componentes/indice-produtividade/edita_extra.php?
												tipo=<?php echo $r->tipo_avaliacao ?>
												&id=<?php echo $r->id?>
												&servidor=<?php echo $r->servidor_avaliado ?>
												&mes=<?php echo $r -> mes_referencia ?>
												&ano=<?php echo $r -> ano_referencia ?>
												&notaanterior=<?php echo $r -> nota_avaliacao ?>" enctype="multipart/form-data">
													<div class="row">
														<div class="col-md-3">
															<input class="form-control" id="" name="extra" placeholder="Dar pontos extras" type="number" max="10" min="0.1" step="0.1" required/>
														</div>
														<div class="col-md-7">
															<input class="form-control" id="" name="justificativa" placeholder="Justificativa" type="text"/>
														</div>
														<div class="col-md-2">
															<button class="btn btn-sm btn-info pull-right" id="" style="margin-right:10px; border-radius:0px;"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;Gravar</button>
														</div>
													</div>
											</form></center>
											<?php } ?></td>
								</tr>
								
								</div>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

</div>
<!-- /#Conteúdo da Página/-->

</div>
<!-- /#wrapper -->


<!-- chamando o bootstrap novamente para o modal funcionar -->
<script type="text/javascript" src="js/bootstrap.js"></script>

<script type="text/javascript">
	/*menu lateral*/
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>

<?php include('footer.php')?>