<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
include('../nucleo-aplicacao/queries/retorna_info_processo_editar.php');	
$permissao = retorna_permissao_pessoa($_SESSION['CPF'],'abrir_processo',$conexao_com_banco); if($permissao=='Não'){
	echo "<script>history.back();</script>";
	echo "<script>alert('Você não tem permissão para estar nesta página')</script>";
}
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Edite o processo</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/processo/logica/editar_info.php?processo=<?php echo $id ?>" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Número do processo</label>
									<div class="row">
										<div class="col-md-4">
											<input class="form-control" value=<?php echo $numero_processo1 ?> id="numero_processo1" name="numero_processo1" placeholder="Órgão" type="text" maxlength="6" required/>
										</div>
										<div class="col-md-4">
											<input class="form-control" value=<?php echo $numero_processo2 ?> id="numero_processo2" name="numero_processo2" placeholder="Número" type="text" maxlength="6" required/>
										</div>
										<div class="col-md-4">
											<input class="form-control" value=<?php echo $numero_processo3 ?> id="numero_processo3" name="numero_processo3" placeholder="Ano" type="text" maxlength="4" required/>
										</div>
									</div>
								</div>  
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo do processo</label>
									<select class="form-control" name="tipo" required/>
										<option value="<?php echo $tipo ?>"><?php echo $tipo ?></option>
										<option value="Processo Interno">Processo Interno</option>
										<option value="Processo Externo">Processo Externo</option>
										<option value="Processo Administrativo">Processo Administrativo</option>
										<option value="LAI">LAI</option>
										<option value="Ouvidoria">Ouvidoria</option>
										<option value="Judiciário">Judiciário</option>
										<option value="Outros">Outros</option>
									</select>
								</div>  
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Assunto</label>
									<select class="form-control"  id="descricao" name="descricao" required/>
										<option value="<?php echo $descricao ?>"><?php echo $descricao ?></option>
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
										<option value="Monitoramento">Monitoramento</option>
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
							
						</div>
						<div class="row">
							<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Detalhes</label>
										<input value='<?php echo $detalhes ?>' class="form-control" id="detalhes" name="detalhes" placeholder="Digite os detalhes do processo" type="text" maxlength="100" required/>
									</div>  
							</div>
							<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Interessado</label>
										<input class="form-control" id="interessado" name="interessado" placeholder="Digite o interessado" type="text" maxlength="50" value='<?php echo $interessado ?>' required/>
									</div>  
							</div>
						</div>
				<div class="row" id="cad-button">
					<div class="col-md-12">
						<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Editar informações</button>
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