<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
include('../nucleo-aplicacao/queries/retorna_info_documento_editar.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Documento sobre <?php echo $tipo_atividade?> (<?php echo $status ?>)</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="row" style="margin-top: 10px;">
						<div class="col-md-12">
							<?php $lista = retorna_documentos_todos($conexao_com_banco);?>
							<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'aprovar_documento',$conexao_com_banco); if($permissao=='Sim' and  $status != 'Aprovado' and $status != 'Resolvido'){     ?>
							<a href='../componentes/documento/logica/editar_aprovar.php?documento=<?php echo $id ?>&pessoa=<?php echo $_SESSION['CPF'] ?>'><button type='submit' class='btn btn-sm btn-info pull-left' style="margin-right:10px;">Aprovar</button></a>
							<?php } ?>
							<?php if($status=='Aprovado'){?>
							<a href='pdf-documento.php?tipo_atividade=<?php echo $tipo_atividade ?>&processo=<?php echo $numero_processo ?>&tipo=<?php echo $tipo_documento ?>&resposta=<?php echo $texto_documento ?>&interessado=<?php echo $interessado ?>' target="_blank"><button type='submit' class='btn btn-sm btn-info pull-left' style="margin-right:10px;">Gerar PDF</button></a>
							<a href='../componentes/documento/logica/editar_resolver.php?documento=<?php echo $id ?>&pessoa=<?php echo $_SESSION['CPF'] ?>'><button type='submit' class='btn btn-sm btn-info pull-left' >Marcar como Resolvido</button></a>
							<?php } ?>

							<?php if($status=='Em análise'){ ?>
							<a href='edita-documento.php?sessionId=<?php echo $num ?>&documento=<?php echo $id ?>'><button type='submit' class='btn btn-sm btn-info pull-left' >Editar Dados</button></a>
							<?php } ?>

							<?php if($tipo_documento=='Memorando'){$permissao = retorna_permissao_pessoa($_SESSION['CPF'],'abrir_processo',$conexao_com_banco); if($permissao=='Sim'){ ?>
							<a href='abrir-processo.php?sessionId=<?php echo $num ?>&documento=<?php echo $id ?>&assunto=<?php echo $tipo_atividade ?>&detalhes=<?php echo $descricao_fato ?>&interessado=<?php echo $interessado ?>'><button type='submit' class='btn btn-sm btn-info pull-right' >Abrir um processo</button></a>
							<?php }} ?>
						</div>
					</div>
					<hr>

					<?php include('includes/info_documento_modal.php'); ?>

					<?php include('includes/mensagem_historico_documento.php'); ?>

					<?php include('includes/textos_anexos_enviar.php'); ?>
								
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /#Conteúdo da Página/-->

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