<?php 
include('../head.php');
include('../body.php');
if($_SESSION['funcao'] != 'GABINETE' and $_SESSION['funcao'] != 'TI' and $_SESSION['funcao'] != 'PROTOCOLO'){
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home.php?mensagem=Você não tem permissão para acessar essa página.&resultado=falha'>";
}
$id = $_GET['id']; 
$tabela = "tb_processos";
include('../includes/verificacao-id.php');
$informacoes = retorna_informacoes($tabela, $id, $conexao_com_banco);

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
		<p>Edição do processo <?php echo $informacoes["CD_PROCESSO"] ?></p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="logica/editar.php?operacao=info&id=<?php echo $informacoes['ID'] ?>&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&entrada=<?php echo $informacoes['DT_ENTRADA'] ?>" enctype="multipart/form-data"> 
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Número do processo</label>
										<div class="row">
											<div class="col-md-4">
												<input class="form-control" id="numero_processo1" name="numero_processo1" placeholder="Órgão" type="text" maxlength="6" value="<?php echo $numero_processo1 ?>" required />
											</div>
											<div class="col-md-4">
												<input class="form-control" id="numero_processo2" name="numero_processo2" placeholder="Número" type="text" maxlength="6" value="<?php echo $numero_processo2 ?>" required />
											</div>
											<div class="col-md-4">
												<input class="form-control" id="numero_processo3" name="numero_processo3" placeholder="Ano" type="text" maxlength="4" value="<?php echo $numero_processo3 ?>" required />
											</div>
										</div>
									</div>  
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Assunto</label>
										<select class="form-control" id="assunto" name="assunto" required/>
											<option value="<?php echo $informacoes["ID_ASSUNTO"] ?>"><?php echo retorna_nome_assunto($informacoes["ID_ASSUNTO"], $conexao_com_banco) ?></option>
											<?php include('../includes/assuntos.php'); ?>
										</select>
									</div>  
								</div>
							</div>
							<div class="row">						
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Órgão Interessado</label>
										<select class="form-control" id="orgao" name="orgao" required/>
											<option value="<?php echo $informacoes["ID_ORGAO_INTERESSADO"] ?>"><?php echo retorna_nome_orgao($informacoes["ID_ORGAO_INTERESSADO"], $conexao_com_banco) ?></option>
											<?php include('../includes/orgaos.php'); ?>
										</select>
									</div>  
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Nome do Interessado</label>
										<input class="form-control" id="interessado" name="interessado" placeholder="Digite o interessado" type="text" maxlength="255" value="<?php echo $informacoes["NM_INTERESSADO"] ?>" required />
									</div>  
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Detalhes</label>
										<input class="form-control" id="detalhes" name="detalhes" placeholder="Digite os detalhes do processo" type="text" maxlength="255" value="<?php echo $informacoes["NM_DETALHES"] ?>" required />
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
	</div>
</div>

</div>
<!-- /#Conteúdo da Página/-->

</div>

<?php include('../foot.php')?>