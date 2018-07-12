<?php include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php'); 
include('../componentes/odp/conectar2.php');
include('../nucleo-aplicacao/retornar-dados-odp.php')
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Servidores estaduais que exerceram atividade empresária na condição de sócio administrador ou sócio gerente.</p>
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
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Buscar pelo CPF, Nome do servidor, Órgão do servidor, CNPJ, Nome da empresa, Vínculo empresarial do servidor e Órgão que recebeu" id="search" autofocus="autofocus" />
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 300px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>CPF</th>
									<th>Nome</th>
									<th>Órgão do servidor</th>
									<th>CNPJ</th>
									<th>Empresa</th>
									<th>Vínculo</th>
									<th>Órgão que recebeu</th>
									<th>Valor</th>
								</tr>	
							</thead>
							<tbody>
								<?php $lista = retorna_servidores_fornecem($conexao_com_banco2);
								while($r = mysqli_fetch_object($lista)){?>
								
								<tr>
									<td><?php echo $r -> NR_CPF ?></td>
									<td><?php echo $r -> NO_PESSOA ?></td>
									<td><?php echo $r -> DESC_ORGAO ?></td>
									<td><?php echo $r -> NR_CGC ?></td>
									<td><?php echo $r -> NOME_FAVORECIDO ?></td>
									<td><?php echo $r -> NO_VINCULO ?></td>
									<td><?php echo $r -> ORGAO_DESCRICAO ?></td>
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