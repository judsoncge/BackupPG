<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
include('../nucleo-aplicacao/queries/retorna_info_documento_editar.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Edição de <?php echo $tipo_documento ?></p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/documento/logica/editar.php?documento=<?php echo $id ?>" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
						
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Número do processo</label>
									<input readonly class="form-control" id="numero_processo" value="<?php echo $numero_processo ?>" name="numero_processo" placeholder="Digite o número do processo" type="text"/>	
								</div>  
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo de atividade</label>
									<select class="form-control" id="atividade" name="tipo_atividade" required/>
										<option value="<?php echo $tipo_atividade ?>"><?php echo $tipo_atividade ?></option>
										<option value="Adiantamento">Adiantamento</option>
										<option value="Anti-Corrupção">Anti-Corrupção</option>
										<option value="Aposentadoria">Aposentadoria</option>
										<option value="Auditorias ordinárias">Auditorias ordinárias</option>
										<option value="Auditorias especiais">Auditorias especiais</option>
										<option value="Balancete">Balancete</option>
										<option value="CEIS">CEIS</option>
										<option value="Consultas de órgãos internos">Consultas de órgãos internos</option>
										<option value="Contrato">Contrato</option>
										<option value="Convênio">Convênio</option>
										<option value="Correição">Correição</option>
										<option value="Despesas Exercícios Anteriores PF">Despesas Exercícios Anteriores PF</option>
										<option value="Despesas Exercícios Anteriores PJ">Despesas Exercícios Anteriores PJ</option>
										<option value="Diárias">Diárias</option>
										<option value="Exercícios anteriores">Exercícios anteriores</option>
										<option value="FECOEP">FECOEP</option>
										<option value="Monitoramento">Monitoramento</option>
										<option value="Ouvidoria">Ouvidoria</option>
										<option value="Pagamento de docentes">Pagamento de docentes</option>
										<option value="Pagamento de indenização por arma de fogo e drogas">Pagamento de indenização por arma de fogo e drogas</option>
										<option value="Passagem Aérea">Passagem Aérea</option>
										<option value="Prestação de contas">Prestação de contas</option>
										<option value="Portal da Transparência">Portal da Transparência</option>	
										<option value="SIC">SIC</option>
										<option value="Outros">Outros</option>
									</select>	
								</div>  
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo de documento</label>
									<select class="form-control" id="documento" name="tipo_documento" required/>
										<option value="<?php echo $tipo_documento ?>"><?php echo $tipo_documento ?></option>
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
							<input class="form-control" value="<?php echo $interessado ?>" id="interessado" name="interessado" placeholder="Digite o interessado" type="text" maxlength="50" required/>	
						</div>  
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Data de entrada</label>
							<input readonly class="form-control tipo-data" value='<?php echo $data_entrada ?>' id="data_entrada" name="data_entrada" type="date" required />	
						</div>  
					</div>
					
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Prazo para a resposta (para o processo concluir)</label>
							<input readonly class="form-control tipo-data" value='<?php echo $prazo ?>' id="prazo" name="prazo" type="date" required />	
						</div>  
					</div>
				
				</div>
				<div class="row">
				<div class="col-md-10">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Prioridade</label>
								<select class="form-control" id="prioridade" name="prioridade" required/>
									<option value="<?php echo $prioridade ?>"><?php echo arruma_prioridade($prioridade) ?></option>
									<option value="4">Baixa</option>
									<option value="3">Média</option>
									<option value="2">Alta</option>
									<option value="1">Urgente</option>
								</select>	
						</div>  
						
				</div>		
				
				
				
				
				
					<div class="col-md-2">
						<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Editar informações</button>
					</div>
				
				</div>
			</form>
	
			
				<hr>
					<h3>Edição de anexos</h3>
				
			<div class="col-md-12 table-responsive" style="overflow: auto; width: 100%; height: auto; margin-top: 20px;">
                                    <table class="table table-hover tabela-dados">
                                        <thead>
                                            <tr>
                                                <th>Anexos</th>
                                                <th>Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody>    
                                            <?php $lista2 = retorna_anexos_documento($id, $conexao_com_banco); while($r2 = mysqli_fetch_object($lista2)){ ?>
                                            <tr>
                                                <td><?php echo $r2 -> caminho; ?> <b></td>
                                                <td><a href="../componentes/anexo/logica/excluir.php?id=<?php echo $r2 -> id ?>"><button type='button' class='btn btn-secondary btn-sm' title="Excluir anexo"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td>
                                            
                                            </tr>
											<?php } ?>
                                            <tr>
												<form name='teste' method='POST' action='../componentes/anexo/logica/cadastrar.php?documento=<?php echo $id ?>&pessoa=<?php echo $_SESSION['CPF']?>' enctype='multipart/form-data'>
													<td colspan="2"><input type="file" class="" name="arquivo_anexo" id="imagem-comunicacao"/>
													<button type='submit' class='btn btn-sm btn-info pull-right' >Gravar</button></td>
												</form>
                                            </tr>    
                                            
										</tbody>
										</table>
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

</script>
<?php include('footer.php')?>