<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
include('../nucleo-aplicacao/queries/retorna_info_documento_sucor_editar.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Edição de Documento</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/monitoramento-sucor/logica/editar.php?documento=<?php echo $id ?>" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Número do processo</label>
									<input class="form-control" value='<?php echo $numero_processo  ?>' id="numero_processo" name="numero_processo" placeholder="Digite o número do processo" type="text"/>	
								</div>  
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo de atividade</label>
									<select class="form-control" id="atividade" name="tipo_atividade" required/>
										<option value="<?php echo $tipo_atividade  ?>"><?php echo $tipo_atividade  ?></option>
										<option value="SIC">SIC</option>
										<option value="Ouvidoria">Ouvidoria</option>
										<option value="Correição">Correição</option>
										<option value="Anti-Corrupção">Anti-Corrupção</option>
										<option value="Portal da Transparência">Portal da Transparência</option>
									</select>	
								</div>  
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo de documento</label>
									<select class="form-control" id="documento" name="tipo_documento" required/>
										<option value="<?php echo $tipo_documento  ?>"><?php echo $tipo_documento  ?></option>
										<option value="Despacho">Despacho</option>
										<option value="Parecer">Parecer</option>
										<option value="Relatório">Relatório</option>
										<option value="Ofício">Ofício</option>
										<option value="Memorando">Memorando</option>
										<option value="Resposta ao Interessado">Resposta ao Interessado</option>
									</select>	
								</div>  
							</div>
							
							 
							</div>
			
				<div class="row">	
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Interessado</label>
							<input class="form-control" value='<?php echo $interessado  ?>' id="interessado" name="interessado" placeholder="Digite o interessado" type="text" maxlength="50" required/>	
						</div>  
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Data de entrada</label>
							<input class="form-control tipo-data" value='<?php echo $data_entrada  ?>' id="data_entrada" name="data_entrada" type="date" required />	
						</div>  
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Prazo para a resposta</label>
							<input class="form-control tipo-data" value='<?php echo $prazo_resposta  ?>'  id="prazo_resposta" name="prazo_resposta" type="date" required />	
						</div>  
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Prioridade</label>
									<select class="form-control" id="prioridade" name="prioridade" required/>
										<option value="<?php echo $prioridade  ?>"><?php echo $prioridade_nome  ?></option>
										<option value="4">Baixa</option>
										<option value="3">Média</option>
										<option value="2">Alta</option>
										<option value="1">Urgente</option>
									</select>	
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

<!-- /#Conteúdo da Página/-->

</div>
<!-- /#wrapper -->

<script type="text/javascript">
	/*menu lateral*/
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});

</script>
<?php include('footer.php')?>