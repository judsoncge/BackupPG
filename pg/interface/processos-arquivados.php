<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php')
?>

<!-- Conteúdo da Página -->
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Processos Arquivados</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-sm-12">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Buscar número do processo, descrição, mês, ou responsável" id="search"/>
								</div>
							</div>
							
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 300px;">
				
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Processo</th>
									<th>Tipo</th>
									<th>Descrição</th>
									<th>Data de arquivamento</th>
									<th><center>+</center></th>
									
								</tr>	
							</thead>
							<tbody>
								<?php $lista = retorna_processo_status('Arquivado',$conexao_com_banco);
								
								$total = 0; 
								while($r = mysqli_fetch_object($lista)){ 
								$total = $total+1; 
								$tipo = $r -> tipo;
								$processo = $r -> numero_processo; 
								$data_saida = $r -> data_saida; 
								$prazo_final = $r -> prazo_final; 
								$data_entrada = $r -> data_entrada; 
								
								?>
								<tr>
									<td><?php echo $r -> numero_processo; ?></td>
									<td><?php echo $r -> tipo; ?></td>
									<td><?php echo $r -> descricao ?></td>
									<td><?php echo arruma_data($r -> data_saida) ?></td>
									<td>
										<center>
											<a href='processo-detalhes.php?sessionId=<?php echo $num ?>&processo=<?php echo $processo ?>'>
											<button id='detalhes' type='button' class='btn btn-default btn-sm' data-toggle='modal' data-target='#<?php echo $r -> id ?>'><i class='fa fa-eye' aria-hidden='true'></i></button></a>
										</center>
									</td>
									
									<td id="ano-item"><?php echo $r -> ano ?></td>
								</tr>
								
											
								
						</div>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
	
</div>
<div class="pull-right" style="margin-right: 50px; margin-top: 20px;" id="qtde"></div>

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