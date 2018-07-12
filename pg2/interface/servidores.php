<?php 
include('../componentes/sessao/iniciar-sessao.php');
include('head.php'); 
include('body.php');
?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<?php include('includes/mensagem.php'); ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="row">
						<center>
							<?php $lista = retorna_servidores($conexao_com_banco);
								while($r = mysqli_fetch_object($lista)){ ?>
								<div class='col-md-3'>
									<div class='box-servidor'>
										<img src='../registros/fotos/<?php echo $r->NM_ARQUIVO_FOTO ?>' class='servidor-img'>
									</div>
									<button id='abre-modal' type='button' class='btn' data-toggle='modal' data-target='#<?php echo arruma_id($r->CD_SERVIDOR) ?>'><div class='nome_servidor'><?php echo $r -> NM_SERVIDOR ?></div></button>
								</div>

							<div id='<?php echo arruma_id($r->CD_SERVIDOR) ?>' class='modal fade' role='dialog'>
							<div class='modal-dialog'>
								<div class='modal-content'>
									<div class='modal-header'>
										<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>×</span></button>
										<h4 class='modal-title modal-header'></h4>
										<center>
											<div class='modal-box-servidor'>
												<img src='../registros/fotos/<?php echo $r->NM_ARQUIVO_FOTO ?>' class='modal-servidor-img'>
											</div>
										</center>
										<h3><?php echo $r->NM_SERVIDOR ?></h3><h5><?php echo $r->NM_CARGO ?></h5>
									</div>
									<div class='modal-body'>
										<div class='row'>
											<div class='col-md-12'>
												<p class='text-justify'>
													<center>
													<b>Nome completo</b>: <?php echo $r -> NM_SERVIDOR . "  "  . $r -> SNM_SERVIDOR ?><br>
													<b>CPF</b>: <?php echo $r -> CD_SERVIDOR ?><br>
													<b>Matrícula</b>: <?php echo $r -> NM_MATRICULA ?><br> 
													<b>Cargo</b>: <?php echo $r -> NM_CARGO ?><br> 
													<b>Setor</b>: <?php echo retorna_nome_setor($r -> CD_SETOR, $conexao_com_banco) ?> <br>
													<b>Vinculação</b>: <?php echo $r -> NM_SITUACAO_FUNCIONAL ?><br>
													<b>Graduação</b>: <?php echo $r -> NM_GRADUACAO ?><br>
													<b>E-mail</b>: <?php echo $r -> NM_EMAIL ?><br>
													<b>Nomeado em</b>: <?php echo arruma_data($r->DT_NOMEACAO) ?><br>
													<b>Salário</b>: <?php echo arruma_numero($r -> VLR_SALARIO) ?><br>
													<b>Cedido pelo órgão</b>: <?php echo $r -> NM_CEDIDO ?>
													</center>
												</p>
											</div>
										</div>
									</div>
									<hr>
									<?php $permissao = retorna_permissao($_SESSION['CPF'],'EDITAR_SERVIDORES',$conexao_com_banco); if($permissao=='sim'){ ?>
										<div class='modal-foot'>
											<div class='row'>
												<div class='col-md-6'>
													<a href='edita-pessoa.php?sessionId=<?php echo $num ?>&pessoa=<?php echo $r -> CD_SERVIDOR ?>' ><button type='submit' class='btn btn-sm btn-default btn-block pull-right' name='submit' value='Send' id='btn-print-servidor'>Editar dados &nbsp;&nbsp;<i class='fa fa-pencil' aria-hidden='true'></i></button></a>
												</div>
												<div class='col-md-6'>
													<a href='edita-permissoes.php?sessionId=<?php echo $num ?>&pessoa=<?php echo $r -> CD_SERVIDOR ?>' ><button type='submit' class='btn btn-sm btn-default btn-block pull-right' name='submit' value='Send' id='btn-print-servidor'>Editar permissões &nbsp;&nbsp;<i class='fa fa-pencil' aria-hidden='true'></i></button></a>
												</div>
											</div>		
										</div>
									<?php } ?>
								</div>
							</div>
						</div>			
 				<?php } ?>
				</center>
			</div>
		</div>
	</div>
</div>		
</div>
</div>


<!-- /#Conteúdo da Página/-->


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
<?php include('foot.php')?>