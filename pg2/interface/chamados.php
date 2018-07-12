<?php include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php'); ?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Chamados</p>
	</div>
	<?php include('includes/mensagem.php') ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-sm-10">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Buscar pela data, natureza, solicitante, status" id="search" autofocus="autofocus" />
								</div>
							</div>
							<?php 
							$n = retorna_numero_chamados_sem_nota($_SESSION['CPF'], $conexao_com_banco);
							$permissao = retorna_permissao($_SESSION['CPF'],'ABRIR_CHAMADO',$conexao_com_banco);
							if($n == 0 and $permissao=='sim'){ ?>
							<div class="col-sm-2 pull-right">
								<a href="abrir-chamado.php?sessionId=<?php echo $num ?>" class="btn btn-sm btn-info pull-right">
								<i class="fa fa-plus-circle"></i> Abrir Chamado</a>
							</div>
							<?php } else { ?>
							Você tem <?php echo sizeof($n) ?> chamado(s) sem nota. Dê nota para o(s) que falta(m) e depois você poderá abrir um chamado.
							<?php } ?>
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 300px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Data de abertura</th>
									<th>Natureza do problema</th>
									<th>Solicitante</th>
									<th>Status</th>
									<th>Nota</th>
									<th><center>Ver detalhes</center></th>
									<th><center>Ação</center></th>
								</tr>	
							</thead>
							<tbody>
								<?php $lista = retorna_chamados($conexao_com_banco);
								while($r = mysqli_fetch_object($lista)){ $id = $r->ID?>
								
								<tr>
									<td><?php echo arruma_data2($r -> DT_ABERTURA) ?></td>
									<td><?php echo $r -> NM_NATUREZA ?></td>
									<td><?php echo retorna_nome_servidor($r -> CD_SERVIDOR_REQUISITANTE, $conexao_com_banco)?></td>
									<td><?php echo $r -> NM_STATUS ?></td>
									<td><?php echo $r -> NM_NOTA ?></td>
									
								   <td><center><a href='chamado-detalhes.php?sessionId=<?php echo $num ?>&chamado=<?php echo $r -> ID ?>'>
										<button id='detalhes' type='button' class='btn btn-default btn-sm' data-toggle='modal'
										data-target='#<?php echo $r -> id ?>'><i class='fa fa-eye' aria-hidden='true'></i></button></a>
									</center></td>
									<?php $permissao = retorna_permissao($_SESSION['CPF'],'EXCLUIR_CHAMADO',$conexao_com_banco); if($permissao=='sim'){ ?>
										<td><center>
											<a href='../componentes/chamado/logica/excluir.php?sessionId=<?php echo $num ?>
											&chamado=<?php echo $id ?>'><button type='button' class='btn btn-secondary btn-sm' 
											title="Excluir"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
										</center></td>		
									<?php } ?>	
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