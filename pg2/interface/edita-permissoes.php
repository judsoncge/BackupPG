<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('head.php'); 
include('body.php');
include('../nucleo-aplicacao/queries/retorna_info_permissao_editar.php');	
?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
<div class="container titulo-pagina">
	<p>Editar permissões de <?php echo retorna_nome_servidor($cpf, $conexao_com_banco); ?></p>
</div>
<div class="container caixa-conteudo">
	<div class="row">
		<div class="col-lg-12">
			<div class="container">
				<form name="cadastro" method="POST" action="../componentes/pessoa/logica/editar.php?operacao=permissao&sessionId=<?php echo $num ?>&pessoa=<?php echo $cpf?>" enctype="multipart/form-data"> <!-- login.php -->  
					<div class="form-group">
						<div class="checkbox">
							<center><label class="control-label" for="exampleInputEmail1">O que o usuário poderá fazer?</label><br><br><br><a href="javascript:cadastrar_marcar()">Tudo</a> ou <a href="javascript:cadastrar_desmarcar()">Nenhum</a></center><br><br>
							<div class="row">
								<div class="col-md-6">
									<label><input type="checkbox" class="cadastra" name="VISUALIZAR_CHAMADO" <?php if($VISUALIZAR_CHAMADO=='sim'){?> checked <?php } ?>> Visualizar chamado </input></label><br>
									<label><input type="checkbox" class="cadastra" name="VISUALIZAR_TODOS_CHAMADO" <?php if($VISUALIZAR_TODOS_CHAMADO=='sim'){?> checked <?php } ?>> Visualizar chamados de todos os servidores </input></label><br>
									<label><input type="checkbox" class="cadastra" name="ABRIR_CHAMADO" <?php if($ABRIR_CHAMADO=='sim'){?> checked <?php } ?>> Abrir um chamado </input></label><br>
									<label><input type="checkbox" class="cadastra" name="ABRIR_TODOS_CHAMADO" <?php if($ABRIR_TODOS_CHAMADO=='sim'){?> checked <?php } ?>> Abrir um chamado no nome de outra pessoa </input></label><br>
									<label><input type="checkbox" class="cadastra" name="EDITAR_CHAMADO" <?php if($EDITAR_CHAMADO=='sim'){?> checked <?php } ?>> Editar um chamado </input></label><br>
									<label><input type="checkbox" class="cadastra" name="EXCLUIR_CHAMADO" <?php if($EXCLUIR_CHAMADO=='sim'){?> checked <?php } ?>> Excluir um chamado </input></label><br>
									<label><input type="checkbox" class="cadastra" name="FECHAR_CHAMADO" <?php if($FECHAR_CHAMADO=='sim'){?> checked <?php } ?>> Fechar um chamado </input></label><br>
									<label><input type="checkbox" class="cadastra" name="ENCERRAR_CHAMADO" <?php if($ENCERRAR_CHAMADO=='sim'){?> checked <?php } ?>> Encerrar um chamado </input></label><br>
									<label><input type="checkbox" class="cadastra" name="VISUALIZAR_RELATORIO_CHAMADO" <?php if($VISUALIZAR_RELATORIO_CHAMADO=='sim'){?> checked <?php } ?>> Visualizar relatório de chamados </input></label><br>
									<label><input type="checkbox" class="cadastra" name="VISUALIZAR_COMUNICACAO" <?php if($VISUALIZAR_COMUNICACAO=='sim'){?> checked <?php } ?>> Visualizar comunicação </input></label><br>
									<label><input type="checkbox" class="cadastra" name="CADASTRAR_COMUNICACAO" <?php if($CADASTRAR_COMUNICACAO=='sim'){?> checked <?php } ?>> Cadastrar comunicação </input></label><br>
									<label><input type="checkbox" class="cadastra" name="EDITAR_COMUNICACAO" <?php if($EDITAR_COMUNICACAO=='sim'){?> checked <?php } ?>> Editar comunicação </input></label><br>
									<label><input type="checkbox" class="cadastra" name="EXCLUIR_COMUNICACAO" <?php if($EXCLUIR_COMUNICACAO=='sim'){?> checked <?php } ?>> Excluir comunicação </input></label><br>
									<label><input type="checkbox" class="cadastra" name="VISUALIZAR_DOCUMENTO" <?php if($VISUALIZAR_DOCUMENTO=='sim'){?> checked <?php } ?>> Visualizar documento </input></label><br>
									<label><input type="checkbox" class="cadastra" name="VISUALIZAR_TODOS_SETOR_DOCUMENTO" <?php if($VISUALIZAR_TODOS_SETOR_DOCUMENTO=='sim'){?> checked <?php } ?>> Visualizar todos os documentos do setor </input></label><br>
									<label><input type="checkbox" class="cadastra" name="VISUALIZAR_TODOS_ORGAO_DOCUMENTO" <?php if($VISUALIZAR_TODOS_ORGAO_DOCUMENTO=='sim'){?> checked <?php } ?>> Visualizar todos os documentos do órgão </input></label><br>
									<label><input type="checkbox" class="cadastra" name="CADASTRAR_DOCUMENTO" <?php if($CADASTRAR_DOCUMENTO=='sim'){?> checked <?php } ?>> Cadastrar documento </input></label><br>
									<label><input type="checkbox" class="cadastra" name="EDITAR_DOCUMENTO" <?php if($EDITAR_DOCUMENTO=='sim'){?> checked <?php } ?>> Editar documento </input></label><br>
									<label><input type="checkbox" class="cadastra" name="EXCLUIR_DOCUMENTO" <?php if($EXCLUIR_DOCUMENTO=='sim'){?> checked <?php } ?>> Excluir documento </input></label><br>
									<label><input type="checkbox" class="cadastra" name="APROVAR_DOCUMENTO" <?php if($APROVAR_DOCUMENTO=='sim'){?> checked <?php } ?>> Aprovar documento </input></label><br>
									<label><input type="checkbox" class="cadastra" name="SUGESTAO_DOCUMENTO" <?php if($SUGESTAO_DOCUMENTO=='sim'){?> checked <?php } ?>> Sugestão documento </input></label><br>
									<label><input type="checkbox" class="cadastra" name="RESOLVER_DOCUMENTO" <?php if($RESOLVER_DOCUMENTO=='sim'){?> checked <?php } ?>> Resolver documento </input></label><br>
									<label><input type="checkbox" class="cadastra" name="VISUALIZAR_INDICE_PRODUTIVIDADE" <?php if($VISUALIZAR_INDICE_PRODUTIVIDADE=='sim'){?> checked <?php } ?>> Visualizar indice de produtividade </input></label><br>
									<label><input type="checkbox" class="cadastra" name="VISUALIZAR_TODOS_SETOR_INDICE_PRODUTIVIDADE" <?php if($VISUALIZAR_TODOS_SETOR_INDICE_PRODUTIVIDADE=='sim'){?> checked <?php } ?>> Visualizar indice de produtividade do setor </input></label><br>
									<label><input type="checkbox" class="cadastra" name="VISUALIZAR_TODOS_ORGAO_INDICE_PRODUTIVIDADE" <?php if($VISUALIZAR_TODOS_ORGAO_INDICE_PRODUTIVIDADE=='sim'){?> checked <?php } ?>> Visualizar indice de produtividade do órgão </input></label><br>
									<label><input type="checkbox" class="cadastra" name="AVALIAR_ASSIDUIDADE" <?php if($AVALIAR_ASSIDUIDADE=='sim'){?> checked <?php } ?>> Avaliar assiduidade </input></label><br>
									<label><input type="checkbox" class="cadastra" name="NOTA_EXTRA_INDICE_PRODUTIVIDADE" <?php if($NOTA_EXTRA_INDICE_PRODUTIVIDADE=='sim'){?> checked <?php } ?>> Dar nota extra no índice de produtividade </input></label><br>
								</div>
								<div class="col-md-6">
									<label><input type="checkbox" class="cadastra" name="SER_AVALIADO_INDICE_PRODUTIVIDADE" <?php if($SER_AVALIADO_INDICE_PRODUTIVIDADE=='sim'){?> checked <?php } ?>> Ser avaliado num índice de produtividade </input></label><br>
									<label><input type="checkbox" class="cadastra" name="VISUALIZAR_PROCESSO" <?php if($VISUALIZAR_PROCESSO=='sim'){?> checked <?php } ?>> Visualizar processo </input></label><br>
									<label><input type="checkbox" class="cadastra" name="VISUALIZAR_TODOS_SETOR_PROCESSO" <?php if($VISUALIZAR_TODOS_SETOR_PROCESSO=='sim'){?> checked <?php } ?>> Visualizar todos os processos do setor </input></label><br>
									<label><input type="checkbox" class="cadastra" name="VISUALIZAR_TODOS_ORGAO_PROCESSO" <?php if($VISUALIZAR_TODOS_ORGAO_PROCESSO=='sim'){?> checked <?php } ?>> Visualizar todos os processos do órgão </input></label><br>
									<label><input type="checkbox" class="cadastra" name="VISUALIZAR_ARQUIVADOS_PROCESSO" <?php if($VISUALIZAR_ARQUIVADOS_PROCESSO=='sim'){?> checked <?php } ?>> Visualizar os processos arquivados </input></label><br>
									<label><input type="checkbox" class="cadastra" name="VISUALIZAR_SAIRAM_PROCESSO" <?php if($VISUALIZAR_SAIRAM_PROCESSO=='sim'){?> checked <?php } ?>> Visualizar os processos que saíram </input></label><br>
									<label><input type="checkbox" class="cadastra" name="ABRIR_PROCESSO" <?php if($ABRIR_PROCESSO=='sim'){?> checked <?php } ?>> Abrir um processo </input></label><br>
									<label><input type="checkbox" class="cadastra" name="EDITAR_PROCESSO" <?php if($EDITAR_PROCESSO=='sim'){?> checked <?php } ?>> Editar um processo </input></label><br>
									<label><input type="checkbox" class="cadastra" name="EXCLUIR_PROCESSO" <?php if($EXCLUIR_PROCESSO=='sim'){?> checked <?php } ?>> Excluir um processo </input></label><br>
									<label><input type="checkbox" class="cadastra" name="DESPACHO_PROCESSO" <?php if($DESPACHO_PROCESSO=='sim'){?> checked <?php } ?>> Criar um despacho para um processo </input></label><br>
									<label><input type="checkbox" class="cadastra" name="PARECER_PROCESSO" <?php if($PARECER_PROCESSO=='sim'){?> checked <?php } ?>> Criar um parecer para um processo </input></label><br>
									<label><input type="checkbox" class="cadastra" name="CONCLUIR_PROCESSO" <?php if($CONCLUIR_PROCESSO=='sim'){?> checked <?php } ?>> Concluir um processo </input></label><br>
									<label><input type="checkbox" class="cadastra" name="FINALIZAR_PROCESSO" <?php if($FINALIZAR_PROCESSO=='sim'){?> checked <?php } ?>> Finalizar um processo </input></label><br>
									<label><input type="checkbox" class="cadastra" name="ARQUIVAR_PROCESSO" <?php if($ARQUIVAR_PROCESSO=='sim'){?> checked <?php } ?>> Arquivar um processo </input></label><br>
									<label><input type="checkbox" class="cadastra" name="SAIDA_PROCESSO" <?php if($SAIDA_PROCESSO=='sim'){?> checked <?php } ?>> Dar saída num processo </input></label><br>
									<label><input type="checkbox" class="cadastra" name="VOLTAR_PROCESSO" <?php if($VOLTAR_PROCESSO=='sim'){?> checked <?php } ?>> Voltar o processo para o órgão </input></label><br>									
									<label><input type="checkbox" class="cadastra" name="DEFINIR_RESPONSAVEIS_PROCESSO" <?php if($DEFINIR_RESPONSAVEIS_PROCESSO=='sim'){?> checked <?php } ?>> Definir responsáveis num processo </input></label><br>
									<label><input type="checkbox" class="cadastra" name="SER_RESPONSAVEL_PROCESSO" <?php if($SER_RESPONSAVEL_PROCESSO=='sim'){?> checked <?php } ?>> Ser responsável num processo </input></label><br>
									<label><input type="checkbox" class="cadastra" name="DESTINO_PROCESSO" <?php if($DESTINO_PROCESSO=='sim'){?> checked <?php } ?>> Ser um destino de tramitação num processo </input></label><br>
									<label><input type="checkbox" class="cadastra" name="PRAZO_PROCESSO" <?php if($PRAZO_PROCESSO=='sim'){?> checked <?php } ?>> Por o prazo parcial num processo </input></label><br>
									<label><input type="checkbox" class="cadastra" name="PRAZO_FINAL_PROCESSO" <?php if($PRAZO_FINAL_PROCESSO=='sim'){?> checked <?php } ?>> Por o prazo final num processo </input></label><br>
									<label><input type="checkbox" class="cadastra" name="VISUALIZAR_SERVIDORES" <?php if($VISUALIZAR_SERVIDORES=='sim'){?> checked <?php } ?>> Visualizar servidores </input></label><br>
									<label><input type="checkbox" class="cadastra" name="EDITAR_SERVIDORES" <?php if($EDITAR_SERVIDORES=='sim'){?> checked <?php } ?>> Editar um servidor </input></label><br>
									<label><input type="checkbox" class="cadastra" name="EXCLUIR_SERVIDORES" <?php if($EXCLUIR_SERVIDORES=='sim'){?> checked <?php } ?>> Excluir um servidor </input></label><br>
									<label><input type="checkbox" class="cadastra" name="VISUALIZAR_SETOR_RELATORIO" <?php if($VISUALIZAR_SETOR_RELATORIO=='sim'){?> checked <?php } ?>> Visualizar relatório do setor </input></label><br>
									<label><input type="checkbox" class="cadastra" name="VISUALIZAR_ORGAO_RELATORIO" <?php if($VISUALIZAR_ORGAO_RELATORIO=='sim'){?> checked <?php } ?>> Visualizar relatório do órgão</input></label><br>
									<label><input type="checkbox" class="cadastra" name="FAZER_OPERACOES_OUTROS_SETOR" <?php if($FAZER_OPERACOES_OUTROS_SETOR=='sim'){?> checked <?php } ?>> Fazer operações de outros no setor </input></label><br>
									<label><input type="checkbox" class="cadastra" name="FAZER_OPERACOES_OUTROS_ORGAO" <?php if($FAZER_OPERACOES_OUTROS_ORGAO=='sim'){?> checked <?php } ?>> Fazer operações de outros no órgão </input></label><br>
								</div>		
							</div>	
							<div class="row">			
								<div class="col-md-12">
									<button type="submit" class="btn btn-default" name="submit" value="Send" id="submit">Atualizar permissões</button>
								</div>
							</div>	
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
<?php include('foot.php')?>