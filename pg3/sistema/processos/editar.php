<?php 
include('../head.php'); 
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-editar-processo'], $conexao_com_banco);
$informacoes = retorna_informacoes_processo($_GET['processo'], $conexao_com_banco);	

$v_numero_processo1 = explode(" ",$informacoes['CD_PROCESSO']);
$numero_processo1 = $v_numero_processo1[0];
$v_numero_processo2 = explode("/",$informacoes['CD_PROCESSO']);
$numero_processo3 = $v_numero_processo2[1];
$numero2 =  explode(" ", $v_numero_processo2[0]);
$numero_processo2 = $numero2[1];
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
					<form name="cadastro" method="POST" action="logica/editar.php?operacao=info&processo=<?php echo $informacoes['CD_PROCESSO'] ?>" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Número do processo</label>
									<div class="row">
										<div class="col-md-4">
											<input class="form-control" value="<?php echo $numero_processo1 ?>" id="numero_processo1" name="numero_processo1" placeholder="Órgão" type="text" maxlength="6" required/>
										</div>
										<div class="col-md-4">
											<input class="form-control" value="<?php echo $numero_processo2 ?>" id="numero_processo2" name="numero_processo2" placeholder="Número" type="text" maxlength="6" required/>
										</div>
										<div class="col-md-4">
											<input class="form-control" value="<?php echo $numero_processo3 ?>" id="numero_processo3" name="numero_processo3" placeholder="Ano" type="text" maxlength="4" required/>
										</div>
									</div>
								</div>  
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Tipo do processo</label>
									<select class="form-control" name="tipo" required/>
										<option value="<?php echo $informacoes['NM_TIPO'] ?>"><?php echo $informacoes['NM_TIPO'] ?></option>
										<?php include('../includes/tipo_processo.php'); ?>
									</select>
								</div>  
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Assunto</label>
									<select class="form-control"  id="descricao" name="descricao" required/>
										<option value="<?php echo $informacoes['DS_PROCESSO'] ?>"><?php echo $informacoes['DS_PROCESSO'] ?></option>
										<?php include('../includes/assunto_processo_documento.php'); ?>
									</select>
								</div>  
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Detalhes</label>
										<input value='<?php echo $informacoes['NM_DETALHES'] ?>' class="form-control" id="detalhes" name="detalhes" placeholder="Digite os detalhes do processo" type="text" maxlength="100" required/>
									</div>  
							</div>
							<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Interessado</label>
										<input class="form-control" id="interessado" name="interessado" placeholder="Digite o interessado" type="text" maxlength="50" value='<?php echo $informacoes['NM_INTERESSADO'] ?>' required/>
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
</div>

<?php include('../foot.php')?>