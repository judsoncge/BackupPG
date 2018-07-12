<?php 
include('../componentes/sessao/iniciar-sessao.php');
include('header.php'); 
include('body-padrao.php');
$permissao = retorna_permissao_pessoa($_SESSION['CPF'],'visualizar_servidores',$conexao_com_banco); if($permissao=='Não'){
	echo "<script>history.back();</script>";
	echo "<script>alert('Você não tem permissão para estar nesta página')</script>";
}
?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Quadro de servidores</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="row">
						<center>
							<?php $lista = retorna_dados("pessoa", $conexao_com_banco);
								while($r = mysqli_fetch_object($lista)){ ?>
								<div class='col-md-3'>
									<div class='box-servidor'>
										<img src='../registros/fotos/<?php echo $r->foto ?>' class='servidor-img'>
									</div>
									<button id='abre-modal' type='button' class='btn' data-toggle='modal' data-target='#<?php echo arruma_CPF($r->CPF) ?>'><div class='nome_servidor'><?php echo $r -> nome ?></div></button>
								</div>

							<div id='<?php echo arruma_CPF($r->CPF) ?>' class='modal fade' role='dialog'>
							<div class='modal-dialog'>
								<div class='modal-content'>
									<div class='modal-header'>
										<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>×</span></button>
										<h4 class='modal-title modal-header'></h4>
										<center>
											<div class='modal-box-servidor'>
												<img src='../registros/fotos/<?php echo $r->foto ?>' class='modal-servidor-img'>
											</div>
										</center>
										<h3><?php echo $r->nome ?></h3><h5><?php echo $r->cargo ?></h5>
									</div>
									<div class='modal-body'>
										<?php if($r->cedido_por==null){ ?>
											<div class='row'>
												<div class='col-md-12'>
													<p class='text-justify'>
														O(A) servidor(a) <?php echo $r -> nome ?> <?php echo $r -> sobrenome ?>, de CPF <?php echo $r -> CPF ?> e matrícula <?php echo $r -> matricula ?>, 
														trabalha na Controladoria Geral do Estado de Alagoas no cargo de <?php echo $r -> cargo ?>, 
														no setor de <?php echo $r -> setor ?> vinculado como <?php echo $r -> situacao_funcional ?>. Possui gradução em 
														<?php echo $r -> graduacao ?>, e-mail institucional <?php echo $r -> email_institucional ?>, foi nomeado em <?php echo arruma_data($r->data_nomeacao) ?> e atualmente
														recebe o valor de R$ <?php echo $r -> salario ?> reais como vencimento mensal. Este(a) servidor(a) pertence ao grupo <?php echo $r -> grupo ?> conforme o Decreto 43.794.
													</p>
												</div>
											</div>
										<?php }else{ ?>
											<div class='row'>
												<div class='col-md-12'>
													<p class='text-justify'>
														O(A) servidor(a) <?php echo $r -> nome ?> <?php echo $r -> sobrenome ?>, de CPF <?php echo $r -> CPF ?> e matrícula <?php echo $r -> matricula ?>, 
														trabalha na Controladoria Geral do Estado de Alagoas no cargo de <?php echo $r -> cargo ?>, 
														no setor de <?php echo $r -> setor ?> vinculado como <?php echo $r -> situacao_funcional ?>. Possui gradução em 
														<?php echo $r -> graduacao ?>, e-mail institucional <?php echo $r -> email_institucional ?>, foi nomeado em <?php echo arruma_data($r->data_nomeacao) ?> e atualmente
														é cedido pelo órgão <?php echo $r -> cedido_por ?>. Este(a) servidor(a) pertence ao grupo <?php $r -> grupo ?> conforme o Decreto 43.794.
													</p>
												</div>
											</div>
									    <?php }	?>
									</div>
									<div class='modal-footer'>
											<!--<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>-->
											<div class='row'>
												<div class='col-md-6'>
													<a href='edita-pessoa.php?sessionId=<?php echo $num ?>&pessoa=<?php echo $r -> CPF ?>' ><button type='submit' class='btn btn-sm btn-default btn-block pull-right' name='submit' value='Send' id='btn-print-servidor'>Editar dados &nbsp;&nbsp;<i class='fa fa-pencil' aria-hidden='true'></i></button></a>
												</div>
												<div class='col-md-6'>
													<a href='pdf.php?nome=<?php echo $r->nome?>&cpf=<?php echo $r->CPF ?>&setor=<?php echo $r->setor ?>&cargo=<?php echo $r->cargo ?>
													&email=<?php echo $r->email_institucional ?>&matricula=<?php echo $r->matricula ?>&situacao=<?php echo $r->situacao_funcional ?>
													&graduacao=<?php echo $r->graduacao ?>&nomeacao=<?php echo arruma_data($r -> data_nomeacao) ?>&grupo=<?php echo $r->grupo ?>&salario=<?php echo $r->salario ?>
													&cedido=<?php echo $r->cedido_por ?>&foto=<?php echo $r->foto ?>&dados=<?php echo $r->anexo_dados_gerais ?>&comprovante=<?php echo $r->anexo_comprovante_residencia ?>
													&diploma=<?php echo $r->anexo_diploma?>' target='_blank'><button type='submit' class='btn btn-sm btn-default btn-block pull-right' name='submit' value='Send' id='btn-print-servidor'>Ficha funcional &nbsp;&nbsp;<i class='fa fa-print' aria-hidden='true'></i></button></a>
												</div>
												
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
<?php include('footer.php')?>