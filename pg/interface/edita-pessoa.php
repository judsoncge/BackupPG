<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
include('../nucleo-aplicacao/queries/retorna_info_pessoa_editar.php');	
?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Editar dados de <?php echo $nome ?></p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<form name="cadastro" method="POST" action="../componentes/pessoa/logica/editar.php?mf=<?php echo $foto?>&mdg=<?php echo $dados_gerais?>&mc=<?php echo $comprovante?>&md=<?php echo $diploma?>&cpf=<?php echo $cpf?>" enctype="multipart/form-data"> <!-- login.php -->  
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Nome</label>
									<input value="<?php echo $nome?>"  class="form-control" id="nome" name="nome" placeholder="Digite o nome (somente letras)" type="text" maxlength="50" minlength="4" pattern="[a*A*-z*Z*]*+" required/>
								</div> 
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Sobrenome</label>
									<input class="form-control" value="<?php echo $sobrenome?>" id="nome" name="sobrenome" placeholder="Digite o sobrenome (somente letras)" type="text" maxlength="100" pattern="[a*A*-z*Z*]*+"/>
								</div> 
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Matrícula</label>
									<input value="<?php echo $matricula?>" class="form-control" id="matricula" name="matricula" placeholder="Digite a matrícula (ex. 00099-9)" type="text" maxlength="7"/>
								</div>  
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">Cargo</label>
									<select class="form-control" id="cargo" name="cargo" required/>
										<option value="<?php echo $cargo ?>"><?php echo $cargo ?></option>
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
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="exampleInputEmail1">CPF</label>
									<input disabled value="<?php echo $cpf?>" class="form-control" id="CPF" name="CPF" placeholder="Digite o CPF" type="text" required/>				  
								</div>				
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label  class="control-label" for="exampleInputEmail1">Situação Funcional</label>
									<select class="form-control" id="situacao-funcional" name="situacao-funcional" required/>
									<option value="<?php echo $situacao_funcional?>"><?php echo $situacao_funcional?></option>
									<option value="Efetivo">Efetivo</option>
									<option value="Cargo comissionado">Cargo comissionado</option>
									<option value="Bolsista">Bolsista</option>
								</select>
							</div>	
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Nível</label>
								<input value="<?php echo $nivel?>" class="form-control" id="nivel" name="nivel" placeholder="Digite o nível" type="text" maxlength="5" />
							</div>	
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Graduação</label>
								<input value="<?php echo $graduacao?>" class="form-control" id="graduacao" name="graduacao" placeholder="Digite o graduação" type="text" required/>				  
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Data de Nomeação</label>
								<input value="<?php echo $data_nomeacao?>" class="form-control tipo-data" id="nomeacao" name="nomeacao" placeholder="Ex.: dd/mm/aaaa" type="date"/>				  
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">E-mail institucional</label>
								<input value="<?php echo $email_institucional?>" class="form-control" id="email_institucional" name="email_institucional" placeholder="Digite o e-mail institucional" type="text"/>				  
							</div>
						</div>						
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Setor</label>
								<select class="form-control" id="setor" name="setor" required/>
									<option value="<?php echo $setor?>"><?php echo $setor?></option>
									<?php $lista = retorna_dados("setor", $conexao_com_banco);
									while($r = mysqli_fetch_object($lista)){ ?>
									<option value="<?php echo $r->codigo ?>"><?php echo $r->nome ?></option><?php } ?>
								</select>
						  </div>  
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Grupo (Conforme Decreto 43.794)</label>
								<select class="form-control" id="grupo" name="grupo"/>
									<option value="<?php echo $grupo?>"><?php echo $grupo?></option>
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
								<input value="<?php echo $salario?>" class="form-control" id="salario" name="salario" placeholder="Digite uma salário" onkeypress="mascara(this,mreais)" type="float" maxlength="10"/>
							</div> 						
						</div> 
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Cedido por outro órgão</label>
								<input value="<?php echo $cedido_por?>" class="form-control" id="cedido_por" name="cedido_por" placeholder="Informe o órgão que o servidor pertence" type="text"/>				  
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Enviar foto</label><br>
								<input type="file" class="btn btn-file btn-primary btn-block" name="arquivo_foto" id="buscar-foto"/>
							</div>
						</div>	
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Enviar dados gerais</label><br>
								<input type="file" class="btn btn-file btn-primary btn-block" name="arquivo_dados" id="buscar-dados"/>
							</div> 						
						</div> 
					</div>
					<div class="row">	
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Enviar comprovante de residência</label><br>
								<input type="file" class="btn btn-file btn-primary btn-block" name="arquivo_comprovante" id="buscar-comprovante"/>
							</div>
						</div>		
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="exampleInputEmail1">Enviar diploma</label><br>
								<input type="file" class="btn btn-file btn-primary btn-block" name="arquivo_diploma" id="buscar-diploma"/>
							</div>
						</div>	
					</div>		
				<div class="row">
					<hr>
						<div class="form-group">
							
							<div class="checkbox">
								<center><label class="control-label" for="exampleInputEmail1">O que o usuário poderá fazer?</label></center><br><br>
								<div class="col-md-6">
									
									<label><input type="checkbox" class="cadastra" name="abrir_chamado_pessoa" value="Sim" <?php if($abrir_chamado_pessoa=='Sim'){?> checked <?php } ?>> Abrir um chamado no nome de outra pessoa </input></label><br>
									<label><input type="checkbox" class="cadastra" name="fechar_chamado" value="Sim" <?php if($fechar_chamado=='Sim'){?> checked <?php } ?>> Fechar um chamado</input></label><br>
									<label><input type="checkbox" class="cadastra" name="nota_chamado" value="Sim" <?php if($nota_chamado=='Sim'){?> checked <?php } ?>> Dar nota a um chamado</input></label><br>
									<label><input type="checkbox" class="cadastra" name="visualizar_todos_chamados" value="Sim" <?php if($isualizar_todos_chamados=='Sim'){?> checked <?php } ?>> Visualizar chamados de todos os outros servidores</input></label><br>
									<label><input type="checkbox" class="cadastra" name="visualizar_financeiro" value="Sim" <?php if($visualizar_financeiro=='Sim'){?> checked <?php } ?>> Visualizar financeiro</input></label><br>
									<label><input type="checkbox" class="cadastra" name="cadastrar_comunicacao" value="Sim" <?php if($cadastrar_comunicacao=='Sim'){?> checked <?php } ?>> Cadastrar comunicação</input></label><br>
									<label><input type="checkbox" class="cadastra" name="visualizar_processo" value="Sim" <?php if($visualizar_processo=='Sim'){?> checked <?php } ?>> Visualizar processo</input></label><br>
									<label><input type="checkbox" class="cadastra" name="abrir_processo" value="Sim" <?php if($abrir_processo=='Sim'){?> checked <?php } ?>> Abrir um processo</input></label><br>
									<label><input type="checkbox" class="cadastra" name="analisar_processo" value="Sim" <?php if($analisar_processo=='Sim'){?> checked <?php } ?>> Analisar processo</input></label><br>
									<label><input type="checkbox" class="cadastra" name="prazo_processo" value="Sim" <?php if($prazo_processo=='Sim'){?> checked <?php } ?>> Por prazo em um processo</input></label><br>
									<label><input type="checkbox" class="cadastra" name="prazo_final_processo" value="Sim" <?php if($prazo_final_processo=='Sim'){?> checked <?php } ?>> Por prazo final em um processo</input></label><br>
									<label><input type="checkbox" class="cadastra" name="arquivar_processo" value="Sim" <?php if($arquivar_processo=='Sim'){?> checked <?php } ?>> Arquivar um processo</input></label><br>
									<label><input type="checkbox" class="cadastra" name="saida_processo" value="Sim" <?php if($saida_processo=='Sim'){?> checked <?php } ?>> Dar saída em um processo</input></label><br>

								</div>
								
								
								
								<div class="col-md-6">
									<label><input type="checkbox" class="cadastra" name="visualizar_processo_todos" value="Sim" <?php if($visualizar_processo_todos=='Sim'){?> checked <?php } ?>> Visualizar os processos de todo o órgão</input></label><br>
									<label><input type="checkbox" class="cadastra" name="destino_tramitacao_processo" value="Sim" <?php if($destino_tramitacao_processo=='Sim'){?> checked <?php } ?>> Receber processo</input></label><br>
									<label><input type="checkbox" class="cadastra" name="concluir_processo" value="Sim" <?php if($concluir_processo=='Sim'){?> checked <?php } ?>> Concluir um processo</input></label><br>
									<label><input type="checkbox" class="cadastra" name="finalizar_processo" value="Sim" <?php if($finalizar_processo=='Sim'){?> checked <?php } ?>> Finalizar um processo</input></label><br>
									<label><input type="checkbox" class="cadastra" name="voltar_processo" value="Sim" <?php if($voltar_processo=='Sim'){?> checked <?php } ?>> Colocar processo de volta para andamento</input></label><br>
									<label><input type="checkbox" class="cadastra" name="visualizar_servidores" value="Sim" <?php if($visualizar_servidores=='Sim'){?> checked <?php } ?>> Visualizar servidores</input></label><br>
									<label><input type="checkbox" class="cadastra" name="visualizar_documento" value="Sim" <?php if($visualizar_documento=='Sim'){?> checked <?php } ?>> Visualizar documentos</input></label><br>
									<label><input type="checkbox" class="cadastra" name="visualizar_documento_todos" value="Sim" <?php if($visualizar_documento_todos=='Sim'){?> checked <?php } ?>> Visualizar os documentos de todo o órgão</input></label><br>
									<label><input type="checkbox" class="cadastra" name="aprovar_documento" value="Sim" <?php if($aprovar_documento=='Sim'){?> checked <?php } ?>> Aprovar documento</input></label><br>
									<label><input type="checkbox" class="cadastra" name="sugestao_documento" value="Sim" <?php if($sugestao_documento=='Sim'){?> checked <?php } ?>> Sugerir texto em documento</input></label><br>
									<label><input type="checkbox" class="cadastra" name="visualizar_indice_produtividade" value="Sim" <?php if($visualizar_indice_produtividade=='Sim'){?> checked <?php } ?>> Visualizar índice de produtividade</input></label><br>
									<label><input type="checkbox" class="cadastra" name="avaliar_todos" value="Sim" <?php if($avaliar_todos=='Sim'){?> checked <?php } ?>> Avaliar pessoa em tudo</input></label><br>
									<label><input type="checkbox" class="cadastra" name="ser_avaliado" value="Sim" <?php if($ser_avaliado=='Sim'){?> checked <?php } ?>> Pode ser avaliado</input></label><br><br>

									
									
								</div>	
								<div class="col-md-12">
								<a href="javascript:cadastrar_marcar()">Tudo</a> ou <a href="javascript:cadastrar_desmarcar()">Nenhum</a>
								</div>	
							</div>
							
						</div>
					</div>
					<hr>




					
				<div class="row" id="cad-button">
					<div class="col-md-12">
						<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Atualizar informações</button>
					</div>
				</div>
				
				
				
				
			</form>
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

<script type="text/javascript">
	/*buscar foto*/
	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
		numFiles = input.get(0).files ? input.get(0).files.length : 1,
		label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [numFiles, label]);
	});

		$(document).ready( function() {
			$('.btn-file :file').on('fileselect', function(event, numFiles, label) {

				var input = $(this).parents('.input-group').find(':text'),
				log = numFiles > 1 ? numFiles + ' files selected' : label;

				if( input.length ) {
					input.val(log);
				} else {
					if( log ) alert(log);
				}

			});
		});
	</script>
<?php include('footer.php')?>