<?php 
include('../head.php');
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-editar-servidores'], $conexao_com_banco);
$informacoes = retorna_informacoes_servidor($_GET['servidor'], $conexao_com_banco);	

?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Editar dados de <?php echo $informacoes['NM_SERVIDOR'] ?></p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="logica/editar.php?operacao=info&servidor=<?php echo $informacoes['CD_SERVIDOR'] ?>" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Nome</label>
									<input value="<?php echo $informacoes['NM_SERVIDOR']?>"  class="form-control" id="nome" name="nome" placeholder="Digite o nome (somente letras)" type="text" maxlength="50" minlength="4" pattern="[a*A*-z*Z*]*+" />
								</div> 
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Sobrenome</label>
									<input class="form-control" value="<?php echo $informacoes['SNM_SERVIDOR'] ?>" id="nome" name="sobrenome" placeholder="Digite o sobrenome (somente letras)" type="text" maxlength="100" pattern="[a*A*-z*Z*]*+"/>
								</div> 
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Cargo</label>
									<select class="form-control" id="cargo" name="cargo" />
										<option value="<?php echo $informacoes['NM_CARGO'] ?>"><?php echo $informacoes['NM_CARGO'] ?></option>
										<option value="Controlador Geral">Controlador Geral</option>
										<option value="Superintendente">Superintendente</option>
										<option value="Chefe de Gabinete">Chefe de Gabinete</option>
										<option value="Assessor de Comunicação">Assessor de Comunicação</option>
										<option value="Assessor de Governança e Transparência">Assessor de Governança e Transparência</option>
										<option value="Gerente Executivo Administrativo">Gerente Executivo Administrativo</option>
										<option value="Gerente Executivo de Planejamento, Orçamento, Finanças e Contabilidade">Gerente Executivo de Planejamento, Orçamento, Finanças e Contabilidade</option>
										<option value="Assessor de Controle Interno">Assessor de Controle Interno</option>
										<option value="Assessor Técnico de Correição e Ouvidoria">Assessor Técnico de Correição e Ouvidoria</option>
										<option value="Assessor Técnico de Suprimentos">Assessor Técnico de Suprimentos</option>
										<option value="Assessor Técnico">Assessor Técnico</option>
										<option value="Assessor Técnico de Controle Financeiro">Assessor Técnico de Controle Financeiro</option>
										<option value="Assessor Técnico de S. Gerais">Assessor Técnico de S. Gerais</option>
										<option value="Assistente de Administração">Assistente de Administração</option>
										<option value="Assistente de Serviços Administrativos">Assistente de Serviços Administrativos</option>
										<option value="Assessor Técnico de Frotas">Assessor Técnico de Frotas</option>
										<option value="Assessor Técnico de Controle do Consumo Interno">Assessor Técnico de Controle do Consumo Interno</option>
										<option value="Assessor Técnico Executivo de Valorização de Pessoas">Assessor Técnico Executivo de Valorização de Pessoas</option>
										<option value="Assessor Técnico Executivo de Tecnologia da Informação">Assessor Técnico Executivo de Tecnologia da Informação</option>
										<option value="Assessor Técnico de Auditagem">Assessor Técnico de Auditagem</option>
										<option value="Analista de Tecnologia da Informação">Analista de Tecnologia da Informação</option>
										<option value="Analista de Informações">Analista de Informações</option>
									</select>	
								</div> 
							</div>
							<div class="col-md-3">
									<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Função</label>
									<select class="form-control" id="funcao" name="funcao">
										<option value="<?php echo $informacoes['NM_FUNCAO'] ?>"><?php echo $informacoes['NM_FUNCAO'] ?></option>
										<option value="Protocolo">Protocolo</option>
										<option value="Assessor Técnico Gabinete">Assessor Técnico Gabinete</option>
										<option value="Assessor Técnico Setor">Assessor Técnico Setor</option>
										<option value="Analisa Processo">Analisa Processo</option>
										<option value="Superintendente">Superintendente</option>
										<option value="Superintendente sem assessor">Superintendente sem assessor</option>
									</select>	
								</div> 
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">CPF</label>
									<input value="<?php echo $informacoes['CD_SERVIDOR'] ?>" class="form-control" id="CPF" name="CPF" placeholder="Digite o CPF" type="text" />				  
								</div>				
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label  class="control-label" for="exampleInputEmail1">Situação Funcional</label>
									<select class="form-control" id="situacao-funcional" name="situacao-funcional" />
									<option value="<?php echo $informacoes['NM_SITUACAO_FUNCIONAL'] ?>"><?php echo $informacoes['NM_SITUACAO_FUNCIONAL'] ?></option>
									<option value="Efetivo">Efetivo</option>
									<option value="Comissionado">Comissionado</option>
									<option value="Bolsista">Bolsista</option>
								</select>
							</div>	
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Nível</label>
								<input value="<?php echo $informacoes['NM_NIVEL'] ?>" class="form-control" id="nivel" name="nivel" placeholder="Digite o nível" type="text" maxlength="5" />
							</div>	
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Graduação</label>
								<input value="<?php echo $informacoes['NM_GRADUACAO'] ?>" class="form-control" id="graduacao" name="graduacao" placeholder="Digite o graduação" type="text" />				  
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Data de Nomeação</label>
								<input value="<?php echo $informacoes['DT_NOMEACAO'] ?>" class="form-control tipo-data" id="nomeacao" name="nomeacao" placeholder="Ex.: dd/mm/aaaa" type="date"/>				  
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">E-mail institucional</label>
								<input value="<?php echo $informacoes['NM_EMAIL'] ?>" class="form-control" id="email_institucional" name="email_institucional" placeholder="Digite o e-mail institucional" type="text"/>				  
							</div>
						</div>						
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Setor</label>
								<select class="form-control" id="setor" name="setor" />
									<option value="<?php echo $informacoes['CD_SETOR'] ?>"><?php echo  retorna_nome_setor($informacoes['CD_SETOR'],$conexao_com_banco) ?></option>
									<?php $lista = retorna_setores($conexao_com_banco);
									while($r = mysqli_fetch_object($lista)){ ?>
									<option value="<?php echo $r->CD_SETOR ?>"><?php echo $r->NM_SETOR ?></option><?php } ?>
								</select>
						  </div>  
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Grupo (Conforme Decreto 43.794)</label>
								<select class="form-control" id="grupo" name="grupo"/>
									<option value="<?php echo $informacoes['NM_GRUPO'] ?>"><?php echo $informacoes['NM_GRUPO'] ?></option>
									<option value="I">I</option>
									<option value="II">II</option>
									<option value="III">III</option>
									<option value="IV">IV</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Salário</label>
								<input value="<?php echo $informacoes['VLR_SALARIO'] ?>" class="form-control" id="salario" name="salario" placeholder="Digite uma salário" onkeypress="mascara(this,mreais)" type="float" maxlength="10"/>
							</div> 						
						</div> 
					</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Cedido por outro órgão</label>
									<input value="<?php echo $informacoes['NM_CEDIDO'] ?>" class="form-control" id="cedido_por" name="cedido_por" placeholder="Informe o órgão que o servidor pertence" type="text"/>				  
								</div>
							</div>
							<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="exampleInputEmail1">Matrícula</label>
										<input value="<?php echo $informacoes['NM_MATRICULA'] ?>" class="form-control" id="matricula" name="matricula" placeholder="Digite a matrícula (ex. 00099-9)" type="text" maxlength="7"/>
									</div>  
							</div>
						
						</div>	
						<div class="row">			
							<div class="col-md-12">
								<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Atualizar informações</button>
							</div>
						</div>	
					</div>		
					<hr>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include('../foot.php')?>