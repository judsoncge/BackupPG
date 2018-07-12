<?php 
include('../head.php');
include('../body.php');
$id = $_GET['id']; 
$tabela = "tb_processos";
include('../includes/verificacao-id.php');
include('dados-detalhes.php');
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">				
		<p>Processo <?php echo $informacoes["CD_PROCESSO"];
		
			if($ativo){
				
			   if($informacoes["BL_ATRASADO"]){
					
					echo "<font color='red'> (ATRASADO)</font>";
				
				}
			   
			   else{
				   
					echo "<font color='green'> (DENTRO DO PRAZO)</font>";
				} 
			}
			?>
			
		</p>	
	</div>
	
	<?php include('../includes/mensagem.php') ?>
				
	<div class="container">
		
		<?php if($ativo and !$apensado){
				//somente o recebido do processo mae (caso tenha apenso) e atualizado
				if(!$recebido and $tem_tramitacao!=0 and $_SESSION['funcao'] != 'TI'){ 
					//para fazer qualquer operacao inicialmente, o servidor deve confirmar se recebeu o processo fisico ou nao
					?>
				
					<div class="row linha-modal-processo">
						<center>
								<div class="alert alert-warning">O processo físico foi recebido?
								<a href='logica/editar.php?id=<?php echo $id ?>&operacao=recebido&tramitacao=<?php echo $tem_tramitacao ?>'>Sim</a>
								/
								<a href='logica/editar.php?id=<?php echo $id ?>&operacao=devolvido&tramitacao=<?php echo $tem_tramitacao ?>'>Não</a>
							</div>
						</center>
					</div>
				
					<?php //o restante da pagina so aparece depois que o servidor confirma se recebeu o processo fisico. caso clique em nao, o sistema tramita o processo virtual de volta para quem tramitou.
					exit();
				}
		} ?>
			
			
	</div>
	
	
	
	<?php //aqui verifica se o processo tem alguma solicitação de sobrestado
	if($ativo and !$informacoes["BL_SOBRESTADO"] and ($_SESSION['funcao'] == 'CONTROLADOR' or $_SESSION['funcao'] == 'CHEFE DE GABINETE' or $_SESSION['funcao'] == 'TI')){
		$solicitacao = retorna_solicitacao_sobrestado_status($id, "SOLICITADO", $conexao_com_banco);
		if(count($solicitacao)>=1){ ?>
			<div class="alert alert-warning">
				<center>
					Você tem uma nova solicitação de sobrestado:<br>
					
					<?php 
						echo "<b>".retorna_nome_servidor($solicitacao[1], $conexao_com_banco)."</b>: ".$solicitacao[2];  
					?> 
					
					<br>
					
					<a href="logica/editar.php?operacao=aceitar_sobrestado&id=<?php echo $solicitacao[0]?>&id_processo=<?php echo $id?>"><button type='submit' class='btn btn-sm btn-info' name='submit' value='Send' id='botao-dar-saida'>Aceitar</button></a>
					
					<a href="logica/editar.php?operacao=recusar_sobrestado&id=<?php echo $solicitacao[0]?>&id_processo=<?php echo $id?>"><button type='submit' class='btn btn-sm btn-info' name='submit' value='Send' id='botao-dar-saida'>Recusar</button></a>
				</center>
			</div>
	<?php }
	} ?>
	
	
	
	<?php //caso ele nao esteja ativo, pode voltar ou ser desarquivado
	if(!$ativo and $informacoes["NM_STATUS"]=='SAIU' and ($_SESSION['funcao'] == 'PROTOCOLO' or $_SESSION['funcao'] == 'TI')){ ?> 
		<a href="logica/editar.php?operacao=voltar&id=<?php echo $id ?>"> 
			Voltar processo 
		</a>
	<?php } 
	
	if(!$ativo and ($informacoes["NM_STATUS"]=='ARQUIVADO') and ($_SESSION['funcao'] == 'SUPERINTENDENTE' or $_SESSION['funcao'] == 'ASSESSOR TÉCNICO' or $_SESSION['funcao'] == 'GABINETE' or $_SESSION['funcao'] == 'TI')){ ?> 
		<a href="logica/editar.php?operacao=desarquivar&id=<?php echo $id ?>"> 
			Desarquivar processo 
		</a>
	<?php } ?>
	
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
				
					<?php 
					if($ativo){ 
						//se o processo for urgente, aparece um aviso 
						if($informacoes["BL_URGENCIA"]){ ?>
							<center>
								<div class="alert alert-warning">&#9888; ESTE PROCESSO É URGENTE!</div>
							</center>

						<?php } 
						//se o processo tiver em sobrestado, aparece um aviso 
						if($informacoes["BL_SOBRESTADO"]){ ?>

						<center>
							<div class="alert alert-warning">&#9888; ESTE PROCESSO ESTÁ EM SOBRESTADO!</div>
						</center>

						<?php } 
						
						if(($recebido and !$apensado) or $_SESSION['funcao'] == 'TI'){
							
							//botoes de urgencia, sobrestado, editar e excluir
							include("botoes.php");
							//botoes de fluxo (finalizar, arquivar, sair etc)
							include("acoes.php");	
						}
					
					} 
					
					include("informacoes.php"); ?>
					
					<?php $lista_documentos = retorna_documentos_processo($id, $conexao_com_banco);
					//se nao tiver nenhum documento, nao imprime a tabela
					if($lista_documentos->num_rows != 0){ 
						include("tabela_documentos.php"); 
					}
					?>

				</div>
			</div>
		</div>
		
		<div class="container">
		
			<?php 
			
				include("historico.php"); 
				
				//nao se pode mexer em processos arquivados ou que sairam
				if($ativo){
					
					include("../includes/enviar-mensagem.php");
					
					if($_SESSION['funcao'] == 'SUPERINTENDENTE' or $_SESSION['funcao'] == 'ASSESSOR TÉCNICO' or $_SESSION['funcao'] == 'GABINETE' or $_SESSION['funcao'] == 'TI'){
						include("solicitar-sobrestado.php");
					}
					
					if($_SESSION['funcao'] == 'SUPERINTENDENTE' or $_SESSION['funcao'] == 'ASSESSOR TÉCNICO' or $_SESSION['funcao'] == 'TÉCNICO ANALISTA' or $_SESSION['funcao'] == 'TÉCNICO ANALISTA CORREÇÃO' or $_SESSION['funcao'] == 'GABINETE' or $_SESSION['funcao'] == 'TI'){
						include("anexar-documento.php");
					}
				
					//nao se pode mexer em processos sao apensados a outro processo
					if(!$apensado){
						
						//se não tiver nenhum responsável, o sistema trava até ele definir.
						if(!$tem_responsavel and ($_SESSION['funcao'] == 'SUPERINTENDENTE' or $_SESSION['funcao'] == 'ASSESSOR TÉCNICO' or $_SESSION['funcao'] == 'TI')){
						
							include("definir-responsaveis.php");
							
							//o usuario so podera mexer no processo depois que definir os responsaveis
							exit();
							
						//se já tiver um responsável, definir responsáveis aparece para caso depois o servidor queira por mais um, porém o sistema não trava pois já tem um definido.
						}elseif($tem_responsavel and ($_SESSION['funcao'] == 'SUPERINTENDENTE' or $_SESSION['funcao'] == 'ASSESSOR TÉCNICO' or $_SESSION['funcao'] == 'TI')){
							
							include("definir-responsaveis.php");
							
							include("definir-responsavel-lider.php");
							
							//o sistema trava para caso não exista um responsavel lider do processo
							if($responsavel_lider == NULL){
								exit();
							}
						}
						
						//se tiver a permissao de apensar processo, abre o codigo
						if($_SESSION['funcao'] == 'SUPERINTENDENTE' or $_SESSION['funcao'] == 'ASSESSOR TÉCNICO' or $_SESSION['funcao'] == 'TÉCNICO ANALISTA' or $_SESSION['funcao'] == 'GABINETE' or $_SESSION['funcao'] == 'TI' or $_SESSION['funcao'] == 'PROTOCOLO'){
							include("apensar-processo.php");
						}
					
						
						include("tramitar.php");	
					}else{ 
					//nao se pode mexer em processo que esta apensado em outro processo, somente o processo mae e permitido executar as operacoes
					?>
						<div class="alert alert-warning">
							<center>Este processo está apensado a outro processo e portanto todas as operações só poderão ser executadas no processo-mãe</center>
						</div>
					<?php } 
				}
			?>
		
		</div>
	</div>
</div>

<?php include('../foot.php')?>