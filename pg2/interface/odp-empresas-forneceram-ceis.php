<?php include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php'); 
include('../componentes/odp/conectar2.php');
include('../nucleo-aplicacao/retornar-dados-odp.php')
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Empresas que forneceram para o Estado de Alagoas em situação de inidoneidade, com registro no CEIS/AL</p>
		<p>Total: <?php echo retorna_quantidade_empresas_inidoneas_al($conexao_com_banco2)?> empresas</p>
	</div>
	<?php include('includes/mensagem.php') ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-sm-12">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Buscar pelo CNPJ, nome do órgão" id="search" autofocus="autofocus" />
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 300px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>CNPJ</th>
									<th>Nome do órgão</th>
									<th>Data do registro</th>
									<th>Valor</th>
								</tr>	
							</thead>
							<tbody>
								<?php $lista = retorna_empresas_forneceram_ceisAL($conexao_com_banco2);
								while($r = mysqli_fetch_object($lista)){?>
								
								<tr>
									<td><?php echo $r -> CNPJ_FAVORECIDO ?></td>
									<td><?php echo $r -> NOME_FAVORECIDO ?></td>
									<td><?php echo arruma_data($r -> DATA_REGISTRO) ?></td>
									<td><?php echo "R$ " . arruma_numero($r -> VALOR) ?></td>
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