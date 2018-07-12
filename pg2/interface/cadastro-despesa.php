<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('head.php'); 
include('body.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
<div class="container titulo-pagina">
	<p>Cadastre uma nova despesa</p>
</div>
<?php include('includes/mensagem.php'); ?>
<div class="container well">
	<div class="row">
		<div class="col-lg-12">
			<div class="container">
				<form name="cadastro" method="POST" action="../componentes/despesa/logica/cadastrar.php?sessionId=<?php echo $num ?>&operacao=despesa" enctype="multipart/form-data"> <!-- login.php -->  
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Tipo</label>
								<select class="form-control" id="tipo" name="tipo" required/>
										<option value="">Selecione o tipo da despesa</option>
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
								<input class="form-control" placeholder='Digite a descrição (máx 500 carac.)' type='text' id='descricao' name='descricao' maxlength='500'/>
							</div>	
						</div>
						<div class="col-md-4">
	                        <label class="control-label" for="data">Data de vencimento:</label>
							<input class="form-control" type="date" id='data' name='data' required/>
						</div>
					</div>
					<div class="row">
                        <div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Mês:</label>
										<select class="form-control" id="mes" name="mes" required/>
											<option value="">Selecione o mês</option>
											<option value="1">Janeiro</option>
											<option value="2">Fevereiro</option>
											<option value="3">Março</option>
											<option value="4">Abril</option>
											<option value="5">Maio</option>
											<option value="6">Junho</option>
											<option value="7">Julho</option>
											<option value="8">Agosto</option>
											<option value="9">Setembro</option>
											<option value="10">Outubro</option>
											<option value="11">Novembro</option>
											<option value="12">Dezembro</option>
										</select>
							</div>	
						</div>
						<div class="col-md-4">
	                        <label class="control-label" for="exampleInputEmail1">Ano:</label>
							<select class="form-control" name="ano" required/>
							<option value="<?php echo date('Y') ?>"><?php echo date('Y') ?></option>
							</select>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Valor</label>
								<input class="form-control" placeholder='Digite o valor da despesa' onkeypress="mascara(this,mreais)" type="float" id='valor' name='valor' required/>
							</div>	
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label" for="arquivo_anexo">Enviar anexo</label><br>
								<input type="file" class="" name="arquivo_anexo" id="arquivo_anexo"/>
							</div>
						</div>	
					</div>
					<div class="row" id="cad-button">
						<div class="col-md-12">
							<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Cadastrar</button>
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