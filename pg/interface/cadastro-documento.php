<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');

?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Cadastro de Novo Documento</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/documento/logica/cadastrar.php?documento" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
						
							<?php if(isset($_GET["processo"])){ ?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Número do processo</label>
									<input readonly class="form-control" id="numero_processo" value="<?php echo $_GET["processo"] ?>" name="numero_processo" placeholder="Digite o número do processo" type="text"/>	
								</div>  
							</div>
							<?php }else{ ?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Número do processo</label>
									<select class="form-control" id="numero_processo" name="numero_processo"/>
										<option value="">Selecione o processo</option>
										<?php $lista = retorna_processo_comigo($conexao_com_banco);
										while($r = mysqli_fetch_object($lista)){ ?>
										<option value="<?php echo $r->numero_processo ?>"><?php echo $r->numero_processo?></option>
										<?php } ?>
									</select>
								</div>  
							</div>
							<?php } ?>
							
							<?php if(isset($_GET["tipo"])){ ?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo de documento</label>
									<input readonly class="form-control" id="tipo_documento" value="<?php echo $_GET["tipo"] ?>" name="tipo_documento" placeholder="Digite o número do processo" type="text" required/>	
								</div>  
							</div>
							<?php }else{ ?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo de documento</label>
									<select class="form-control" id="documento" name="tipo_documento" required/>
										<option value="">Selecione o documento</option>
										<?php $permissao = retorna_permissao_pessoa($_SESSION['CPF'],'cadastrar_despacho',$conexao_com_banco); 
										if($permissao=='Sim'){ ?>
											<option value="Despacho">Despacho</option>
										<?php } ?>
										<option value="Parecer">Parecer</option>
										<option value="Relatório">Relatório</option>
										<option value="Ofício">Ofício</option>
										<option value="Memorando">Memorando</option>
										<option value="Resposta ao Interessado">Resposta ao Interessado</option>
										<option value="Outros">Outros</option>
									</select>	
								</div>  
							</div>
							<?php } ?>
							
							<?php if(isset($_GET["descricao"])){ ?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo de atividade</label>
									<input readonly class="form-control" id="atividade" value="<?php echo $_GET["descricao"] ?>" name="tipo_atividade" placeholder="Digite o número do processo" type="text" required/>	
	
								</div>  
							</div>
							<?php }else{ ?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo de atividade</label>
									<select class="form-control" id="atividade" name="tipo_atividade" required/>
										<option value="">Selecione uma atividade</option>
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
										<option value="Denúncia">Denúncia</option>
										<option value="Designação">Designação</option>
										<option value="Despesas Exercícios Anteriores PF">Despesas Exercícios Anteriores PF</option>
										<option value="Despesas Exercícios Anteriores PJ">Despesas Exercícios Anteriores PJ</option>
										<option value="Diárias">Diárias</option>
										<option value="Diversos">Diversos</option>
										<option value="Encaminhamento de documentos">Encaminhamento de documentos</option>
										<option value="Exercícios anteriores">Exercícios anteriores</option>
										<option value="FECOEP">FECOEP</option>
										<option value="Indenização por arma de fogo">Indenização por arma de fogo</option>
										<option value="Inspeção">Inspeção</option>
										<option value="Monitoramento">Monitoramento</option>
										<option value="Ouvidoria">Ouvidoria</option>
										<option value="Pagamentos">Pagamentos</option>
										<option value="Passagem Aérea">Passagem Aérea</option>
										<option value="Pedido de informação">Pedido de informação</option>
										<option value="Prestação de contas">Prestação de contas</option>
										<option value="Portal da Transparência">Portal da Transparência</option>	
										<option value="Reclamação">Reclamação</option>	
										<option value="Relatório">Relatório</option>	
										<option value="Ressarcimento">Ressarcimento</option>	
										<option value="SIC">SIC</option>
										<option value="Solicitações">Solicitações</option>
										<option value="Outros">Outros</option>
									</select>	
								</div>  
							</div>
							<?php } ?>

							
							 
						</div>
			
				<div class="row">
					<?php if(isset($_GET["interessado"])){ ?>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Interessado</label>
							<input readonly class="form-control" id="interessado" value='<?php echo $_GET["interessado"] ?>' name="interessado" placeholder="Digite o interessado" type="text" maxlength="50" required/>	
						</div>    
					</div>	
					<?php }else{ ?>	
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Interessado</label>
							<input class="form-control" id="interessado" name="interessado" placeholder="Digite o interessado" type="text" maxlength="50" required/>	
						</div>  
					</div>
					<?php } ?>
					<?php if(isset($_GET["entrada"])){ ?>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Data de entrada</label>
							<input readonly class="form-control tipo-data" value='<?php echo $_GET["entrada"] ?>' id="data_entrada" name="data_entrada" type="date" />	
						</div>  
					</div>
					<?php }else{ ?>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Data de entrada</label>
							<input class="form-control tipo-data" id="data_entrada" name="data_entrada" type="date" />	
						</div>  
					</div>
					<?php } ?>
					
					
					
					<?php 
					if(isset($_GET["prazo"])){ ?>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Prazo para a resposta</label>
							<input <?php $prazo=$_GET["prazo"]; if($prazo!='0000-00-00'){ ?> readonly <?php }?>  class="form-control tipo-data" value='<?php echo $_GET["prazo"] ?>' id="prazo" name="prazo" type="date"/>	
						</div>  
					</div>
					<?php }else{ ?>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Prazo para a resposta</label>
							<input class="form-control tipo-data" id="prazo" name="prazo" type="date" />	
						</div>  
					</div>
					<?php } ?>
				</div>
				<div class="row">
				<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="exampleInputEmail1">Prioridade</label>
								<select class="form-control" id="prioridade" name="prioridade" required/>
									<option value="">Selecione a prioridade</option>
									<option value="4">Baixa</option>
									<option value="3">Média</option>
									<option value="2">Alta</option>
									<option value="1">Urgente</option>
								</select>	
						</div>  
						
				</div>		
				</div>
				<div class="row">
				<?php if(isset($_GET["descricao"])){ ?>
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="comment">Descrição do fato:</label>
							<input readonly class="form-control" id="descricao_fato" name="descricao_fato" type="text" maxlength="300" value='<?php echo $_GET["descricao"] ?>' required/>
						</div>	
					</div>
				<?php }else{ ?>
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="comment">Descrição do fato:</label>
							<input class="form-control" id="descricao_fato" name="descricao_fato" type="text" maxlength="300" required/>
						</div>	
					</div>
				<?php } ?>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="comment">Texto do documento:</label>
	  						<textarea class="form-control" rows="12" id="texto_documento" name="texto_documento">Sem texto</textarea>
						</div>	
					</div>
				
				</div>
				<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Enviar anexo</label><br>
								<input type="file" class="" name="arquivo_anexo" id="arquivo_anexo"/>
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