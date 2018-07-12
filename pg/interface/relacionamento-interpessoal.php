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
		<p>Relacionamento Interpessoal</p>
	</div>
	<div class="container caixa-conteudo">
		
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<!-- <div class="well">
						<div class="row">
							<div class="col-sm-12">
								<div class="input-group margin-bottom-sm">
									<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span> <input type="text" class="input-search form-control" alt="tabela-dados" placeholder="Buscar pelo servidor" />
								</div>
							</div>
							
						</div>
					</div> -->
					<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: 500px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th class="col-xs-8 col-sm-8 col-md-8 col-lg-8">Servidor</th>
									<th class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Nota</th>
									<th class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Ação</th>

								</tr>	
							</thead>
					<tbody>
					<?php $lista = retorna_tecnico_avaliar($conexao_com_banco);
						while($r = mysqli_fetch_object($lista)){?>
						<form name="cadastro" method="POST" action="../componentes/relacionamento-interpessoal/logica/cadastrar.php" enctype="multipart/form-data">
									<tr>
										<td class="col-xs-8 col-sm-8 col-md-8 col-lg-8"><input class="form-control" id="avaliado" name="avaliado" placeholder="" type="text" value="<?php $avaliado = retorna_nome_pessoa($r -> CPF, $conexao_com_banco); echo $avaliado ?>" readonly/></td>
										<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input class="form-control" id="nota" name="nota" placeholder="" type="number" value="<?php echo $nota ?>"/></td>
										<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><button type="submit" class="btn btn-sm btn-info" name="submit" value="Send" >Gravar</button></td>
									</tr>
						</form>
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