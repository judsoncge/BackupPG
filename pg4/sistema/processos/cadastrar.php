<?php 
include('../head.php');
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-abrir-processo'], $conexao_com_banco);
$pagina = $_GET['pagina'];
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Abrir processo</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
				<?php if(isset($_GET['documento'])){ ?>
					<form name="cadastro" method="POST" action="logica/cadastrar.php?documento=<?php echo $_GET['documento'] ?>&pagina=<?php echo $pagina ?>" enctype="multipart/form-data"> <!-- login.php --> 
				<?php } if(isset($_GET['compra'])){ ?>
					<form name="cadastro" method="POST" action="logica/cadastrar.php?compra=<?php echo $_GET['compra'] ?>&prazo=<?php echo $_GET['prazo'] ?>&pagina=<?php echo $pagina ?>" enctype="multipart/form-data"> <!-- login.php --> 
				<?php }else{ ?>
					<form name="cadastro" method="POST" action="logica/cadastrar.php?pagina=<?php echo $pagina ?>" enctype="multipart/form-data"> <!-- login.php -->  
				<?php } ?>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Número do processo</label>
									<div class="row">
										<div class="col-md-4">
											<input class="form-control" id="numero_processo1" name="numero_processo1" placeholder="Órgão" type="text" maxlength="6" required/>
										</div>
										<div class="col-md-4">
											<input class="form-control" id="numero_processo2" name="numero_processo2" placeholder="Número" type="text" maxlength="6" required/>
										</div>
										<div class="col-md-4">
											<input class="form-control" id="numero_processo3" name="numero_processo3" placeholder="Ano" type="text" maxlength="4" required/>
										</div>
									</div>
								</div>  
							</div>
							
							<?php if(isset($_GET["assunto"])){ ?>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Assunto</label>
									<input type='text' readonly class="form-control" id="assunto" name="assunto" value='<?php echo retorna_nome_assunto($_GET['assunto'], $conexao_com_banco)?>'/>
								</div>
							</div>
							<?php }else{ ?>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Assunto</label>
									<select class="form-control" id="assunto" name="assunto" required/>
										<option value="">Selecione o assunto</option>
										<?php include('../includes/assunto_processo_documento.php'); ?>
									</select>
								</div>  
							</div>
							<?php } ?>
						</div>
						<div class="row">							
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Órgão Interessado</label>
									<select class="form-control" id="orgao" name="orgao" required/>
										<option value="">Selecione o Órgão Interessado</option>
										<?php include('../includes/orgao_interessado_processo.php'); ?>
									</select>
								</div>  
							</div>
						</div>
						<div class="row">
							<?php if(isset($_GET["interessado"])){ ?>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Interessado</label>
										<input readonly class="form-control" id="interessado" name="interessado" placeholder="Digite o interessado" type="text" maxlength="50" value='<?php echo $_GET["interessado"] ?>' required/>
									</div>  
								</div>
							<?php }else{ ?>				
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Nome do Interessado</label>
										<input class="form-control" id="interessado" name="interessado" placeholder="Digite o interessado" type="text" maxlength="50" required/>
									</div>  
								</div>
							<?php } ?>
							<?php if(isset($_GET["detalhes"])){ ?>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Detalhes</label>
										<input value='<?php echo $_GET["detalhes"] ?>' class="form-control" id="detalhes" name="detalhes" placeholder="Digite os detalhes do processo" type="text" maxlength="100" readonly required/>
									</div>  
								</div>
							<?php }else{ ?>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Detalhes</label>
										<input class="form-control" id="detalhes" name="detalhes" placeholder="Digite os detalhes do processo" type="text" maxlength="100" required/>
									</div>  
								</div>
							<?php } ?>
					
						</div>
							
				<div class="row" id="cad-button">
					<div class="col-md-12">
						<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Abrir processo</button>
					</div>
				</div>	
			</form>	
		</div>
		</div>
		</div>
		</div>
		</div>
		<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Cadastrar órgão</p>
	</div>
	<div class="container caixa-conteudo" style="min-height: 200px;">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
				
					<form name="cadastro_orgao" method="POST" action="logica/editar.php?operacao=cadastrar_orgao" enctype="multipart/form-data"> 
									
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="cd_orgao">Sigla do Órgão</label>
									<div class="row">
										<div class="col-md-8">
											<input class="form-control" id="cd_orgao" name="cd_orgao" placeholder="Sigla do Órgão" type="text" required/>
										</div>							
									</div>
								</div>  
							</div>	
							<div class="col-md-8">
								<div class="form-group">
									<label class="control-label" for="nm_orgao">Nome do Órgão</label>
									<div class="row">
										<div class="col-md-12">
											<input class="form-control" id="nm_orgao" name="nm_orgao" placeholder="Nome do Órgão" type="text" required/>
										</div>							
									</div>
								</div>  
							</div>								
							
							
						</div>
						
				<div class="row" id="cad-button">
					<div class="col-md-12">
						<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Cadastrar órgão</button>
					</div>
				</div>	
			</form>	
		</div>
	</div>
</div>
</div>
</div>

<?php include('../foot.php')?>