<?php 
include('../head.php');
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-visualizar-servidores'], $conexao_com_banco);
$lista = retorna_servidores($conexao_com_banco);
?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<?php include('../includes/mensagem.php'); ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="row">
						<center>
							<?php while($r = mysqli_fetch_object($lista)){ ?>
								<div class='col-md-3'>
									<div class='box-servidor'>
										<img src='../../registros/fotos/<?php echo $r->NM_ARQUIVO_FOTO ?>' class='servidor-img'>
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
												<img src='../../registros/fotos/<?php echo $r->NM_ARQUIVO_FOTO ?>' class='modal-servidor-img'>
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
										<div class='modal-foot'>
											<div class='row'>
												<?php if($_SESSION['permissao-editar-servidores']=='sim'){ ?>
													<div class='col-md-4'>
														<a href='editar-informacoes.php?servidor=<?php echo $r -> CD_SERVIDOR ?>' ><button type='submit' class='btn btn-sm btn-default btn-block pull-right' name='submit' value='Send' id='btn-print-servidor'>Dados &nbsp;&nbsp;<i class='fa fa-pencil' aria-hidden='true'></i></button></a>
													</div>
													<div class='col-md-4'>
														<a href='editar-permissoes.php?servidor=<?php echo $r -> CD_SERVIDOR ?>' ><button type='submit' class='btn btn-sm btn-default btn-block pull-right' name='submit' value='Send' id='btn-print-servidor'>Permissões &nbsp;&nbsp;<i class='fa fa-pencil' aria-hidden='true'></i></button></a>
													</div>
												<?php } ?>
												
												<?php if($_SESSION['permissao-excluir-servidores']=='sim'){ ?>
													<div class='col-md-4'>
														<a href='logica/excluir.php?servidor=<?php echo $r -> CD_SERVIDOR ?>' onclick="return confirm('Você tem certeza que deseja apagar este servidor?');"><button type='submit' class='btn btn-sm btn-default btn-block pull-right' name='submit' value='Send' id='btn-print-servidor'>Excluir &nbsp;&nbsp;<i class='fa fa-trash' aria-hidden='true'></i></button></a>
													</div>
												<?php } ?>	
												
											</div>		
										</div>
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
<?php include('../foot.php')?>