<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('head.php'); 
include('body.php');
include('../nucleo-aplicacao/queries/retorna_info_despesa_editar.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
<div class="container titulo-pagina">
	<p>Edição de <?php echo $nome_despesa ?></p>
</div>
<?php include('includes/mensagem.php'); ?>
<div class="container well">
	<div class="row">
		<div class="col-lg-12">
			<div class="container">
				<form name="cadastro" method="POST" action="../componentes/despesa/logica/editar.php?sessionId=<?php echo $num ?>&operacao=info&despesa=<?php echo $id ?>" enctype="multipart/form-data"> <!-- login.php -->  
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Tipo</label>
								<select class="form-control" id="tipo" name="tipo" required/>
										<option value="<?php echo $codigo_despesa ?>"><?php echo $nome_despesa ?></option>
										<?php $lista = retorna_tipos_despesas($conexao_com_banco);
										while($r = mysqli_fetch_object($lista)){ ?>
										<option value="<?php echo $r->CD_DESPESA ?>"><?php echo $r->NM_DESPESA?></option>
										<?php } ?>
								</select>
							</div>	
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Descrição</label>
								<input class="form-control" placeholder='Digite a descrição (máx 500 carac.)' type='text' id='descricao' name='descricao' value='<?php echo $descricao_despesa ?>' maxlength='500'/>
							</div>	
						</div>
						<div class="col-md-4">
	                        <label class="control-label" for="data">Data de vencimento:</label>
							<input class="form-control" type="date" id='data' name='data' value='<?php echo $data_vencimento ?>' required/>
						</div>
					</div>
					<div class="row">
                        <div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Mês:</label>
										<select class="form-control" id="mes" name="mes" required/>
											<option value="<?php echo $mes_despesa ?>"><?php echo arruma_data_mes2($mes_despesa) ?></option>
											<?php $i = date('m'); while($i >= date('m') and  $i <= 12){ ?>
											<option value="<?php echo $i ?>"><?php echo arruma_data_mes2($i) ?></option>
											<?php $i++;} ?>
										</select>
							</div>	
						</div>
						<div class="col-md-4">
	                        <label class="control-label" for="exampleInputEmail1">Ano:</label>
							<select class="form-control" name="ano" required/>
								<option value="<?php echo $ano_despesa ?>"><?php echo $ano_despesa ?></option>
								<option value="<?php echo date('Y') ?>"><?php echo date('Y') ?></option>
							</select>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Valor</label>
								<input class="form-control" placeholder='Digite o valor da despesa' onkeypress="mascara(this,mreais)" type="float" id='valor' name='valor' value='<?php echo $valor_despesa ?>' required/>
							</div>	
						</div>
					</div>
					<div class="row" id="cad-button">
						<div class="col-md-12">
							<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Editar</button>
						</div>
				</div>
				</form>
			</div>		
		</div>
	</div>
</div>
<div class="container well">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/despesa/logica/cadastrar.php?sessionId=<?php echo $num ?>&operacao=tipo_despesa" enctype="multipart/form-data"> <!-- login.php -->  
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label" for="exampleInputEmail1">Código:</label>
											<input class="form-control" type='text' id='codigo' name='codigo'/>
										</div>	
									</div>
									<div class="col-md-3">
									<label class="control-label" for="exampleInputEmail1">Tipo:</label>
										<select class="form-control" id="tipo" name="tipo" required/>
											<option value="">Selecione o tipo</option>
											<option value="Fixa">Fixa</option>
											<option value="Variável">Variável</option>
										</select>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label" for="exampleInputEmail1">Nome da despesa:</label>
											<input class="form-control" type='text' id='nome' name='nome'/>
										</div>	
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<button type="submit" class="btn btn-sm btn-success" name="submit" value="Send" style="margin-top:32px;">Cadastrar nova despesa</button>
										</div>	
									</div>
								</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

</div>
<!-- /#Conteúdo da Página/-->

</div>
<!-- /#wrapper -->

<script type="text/javascript">
	/*menu lateral*/
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});


	/*tipo de telefone*/
/*	$("#tipo").on('change', function(){
		$('.opcao').hide();
		$('#' + this.value).fadeIn("slow");
	});*/

</script>
<?php include('foot.php')?>