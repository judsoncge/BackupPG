<?php 
include("../head.php");include("../body.php");
if($_SESSION['funcao'] != 'TI'){
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home.php?mensagem=Você não tem permissão para acessar essa página.&resultado=falha'>";
}
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Cadastro de servidor</p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="logica/cadastrar.php" enctype="multipart/form-data"> 
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Nome</label>
										<input class="form-control" id="nome" name="nome" placeholder="Digite o nome (somente letras)" 
										type="text" maxlength="255" minlength="4" pattern="[a*A*-z*Z*]*+" required/>
									</div> 
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">CPF</label>
										<input class="form-control" id="CPF" name="CPF" placeholder="Digite o CPF" type="text" required/>				  
									</div>				
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Setor</label>
										<select class="form-control" id="setor" name="setor" required/>
											<option value="">Selecione</option>
											
											<?php $lista = retorna_setores($conexao_com_banco);
											
											while($r = mysqli_fetch_object($lista)){ ?>
											
												<option value="<?php echo $r->ID ?>">
												
												<?php echo $r->NM_SETOR; ?>
												
												</option>
												
											<?php } ?>
										</select>
									</div> 
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Função no sistema</label>
										<select class="form-control" id="funcao" name="funcao" required />
											
											<option value="">Selecione</option>
											
											<option value="PROTOCOLO">PROTOCOLO	</option>
											<option value="SUPERINTENDENTE">SUPERINTENDENTE</option>
											<option value="ASSESSOR TÉCNICO">ASSESSOR TÉCNICO</option>
											<option value="TÉCNICO ANALISTA">TÉCNICO ANALISTA</option>
											<option value="GABINETE">GABINETE</option>
											<option value="CONTROLADOR">CONTROLADOR</option>
											<option value="TI">TI</option>
											<option value="COMUNICAÇÃO">COMUNICAÇÃO</option>
											<option value="CHEFE DE GABINETE">CHEFE DE GABINETE</option>
											<option value="TÉCNICO ANALISTA CORREÇÃO">TÉCNICO ANALISTA CORREÇÃO</option>
											
										</select>
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
	</div>
</div>

</div>
<!-- /#Conteúdo da Página/-->

</div>

<?php include('../foot.php')?>