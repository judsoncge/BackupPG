<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('head.php'); 
include('body.php');
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
					<form name="cadastro" method="POST" action="../componentes/documento/logica/editar.php?operacao=info&sessionId=<?php echo $num ?>&documento=<?php echo $id ?>&pagina=<?php echo $_GET['pagina'] ?>" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
						<?php if($numero_processo!=''){ ?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Número do processo</label>
									<input readonly class="form-control" id="numero_processo" value="<?php echo $numero_processo ?>" name="numero_processo" placeholder="Digite o número do processo" type="text"/>	
								</div>  
							</div>
						<?php }else{ ?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Número do processo</label>
									<select class="form-control" id="numero_processo" name="numero_processo"/>
										<option value="">Selecione o processo</option>
										<?php $lista = retorna_processos_com_servidor($_SESSION['CPF'],$conexao_com_banco);
										while($r = mysqli_fetch_object($lista)){ ?>
										<option value="<?php echo $r->CD_PROCESSO ?>"><?php echo $r->CD_PROCESSO?></option>
										<?php } ?>
									</select>
								</div>  
							</div>
						<?php } ?>
						<?php if($numero_processo==''){ ?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo de atividade</label>
									<select class="form-control" id="atividade" name="tipo_atividade" required/>
										<option value="<?php echo $tipo_atividade ?>"><?php echo $tipo_atividade ?></option>
										<option value="Ação judicial">Ação judicial</option>
										<option value="Adiantamento">Adiantamento</option>
										<option value="Adoção de providências">Adoção de providências</option>
										<option value="Anti-Corrupção">Anti-Corrupção</option>
										<option value="Aposentadoria">Aposentadoria</option>
										<option value="Aquisição">Aquisição</option>
										<option value="Ascensão de nível">Ascensão de nível</option>
										<option value="Auditorias ordinárias">Auditorias ordinárias</option>
										<option value="Auditorias especiais">Auditorias especiais</option>
										<option value="Balancete">Balancete</option>
										<option value="CEIS">CEIS</option>
										<option value="Consultas de órgãos internos">Consultas de órgãos internos</option>
										<option value="Contrato">Contrato</option>
										<option value="Convênio">Convênio</option>
										<option value="Correição">Correição</option>
										<option value="Designação">Designação</option>
										<option value="Despesas Exercícios Anteriores PF">Despesas Exercícios Anteriores PF</option>
										<option value="Despesas Exercícios Anteriores PJ">Despesas Exercícios Anteriores PJ</option>
										<option value="Diárias">Diárias</option>
										<option value="Diversos">Diversos</option>
										<option value="Encaminhamento de documentos">Encaminhamento de documentos</option>
										<option value="Exercícios anteriores">Exercícios anteriores</option>
										<option value="FECOEP">FECOEP</option>
										<option value="Indenização por arma de fogo">Indenização por arma de fogo</option>
										<option value="Informação">Informação</option>
										<option value="Monitoramento">Monitoramento</option>
										<option value="Ouvidoria">Ouvidoria</option>
										<option value="Pagamento">Pagamento</option>
										<option value="Passagem Aérea">Passagem Aérea</option>
										<option value="Pedido de informação">Pedido de informação</option>
										<option value="Prestação de contas">Prestação de contas</option>
										<option value="Portal da Transparência">Portal da Transparência</option>	
										<option value="Reclamação">Reclamação</option>	
										<option value="Relatório">Relatório</option>	
										<option value="Ressarcimento">Ressarcimento</option>	
										<option value="Requerimento e retroativo">Requerimento e retroativo</option>	
										<option value="SIC">SIC</option>
										<option value="Solicitação">Solicitação</option>
										<option value="Outros">Outros</option>
									</select>	
								</div>  
							</div>
							<?php }else{ ?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo de atividade</label>
									<select class="form-control" id="atividade" name="tipo_atividade" required/>
										<option value="<?php echo $tipo_atividade ?>"><?php echo $tipo_atividade ?></option>
									</select>	
								</div>  
							</div>
							<?php } ?>
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
										<option value="Apresentação">Apresentação</option>
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
							<input class="form-control tipo-data" value='<?php echo $entrada ?>' id="data_entrada" name="data_entrada" type="date" required />	
						</div>  
					</div>
					<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Prazo para a resposta</label>
								<input class="form-control tipo-data" value='<?php echo $prazo ?>' id="prazo" name="prazo" type="date" required />	
							</div>  
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
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
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="comment">Descrição do fato:</label>
							<input class="form-control" id="descricao_fato" name="descricao_fato" type="text" maxlength="300" 
							value='<?php echo $descricao_fato ?>' required/>
						</div>	
					</div>	
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="comment">Texto do documento:</label>
	  						<textarea class="form-control" rows="12" id="texto_documento" name="texto_documento"><?php echo $texto_documento ?></textarea>
						</div>	
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
							<button type='submit' class='btn btn-sm btn-info pull-right' name='submit' value='Send' id='botao-tramitar'>Atualizar informações &nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
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
<?php include('foot.php')?>