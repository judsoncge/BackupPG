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
		<p>Processo <?php echo $informacoes["CD_PROCESSO"]; ?></p>	
	</div>
	
	<?php include('../includes/mensagem.php') ?>
	
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
			
					} 
					?>
					
					<div class="row linha-modal-processo">
						<div class="col-md-12">
							<b>STATUS</b>:         
								<?php echo $informacoes["NM_STATUS"] ?>
							<br>
							
							<br>
							<b>Está com</b>:         
								<?php echo retorna_nome_servidor($informacoes["ID_SERVIDOR_LOCALIZACAO"], $conexao_com_banco) ?>
							<br>
							<b>No Setor</b>:         
								<?php echo retorna_sigla_setor($informacoes["ID_SETOR_LOCALIZACAO"], $conexao_com_banco) ?>
							<br>
							
							<br>
							<b>Número</b>:         
								<?php echo $informacoes["CD_PROCESSO"] ?>
							<br>
							<b>Assunto</b>:
								<?php 
									echo retorna_nome_assunto($informacoes["ID_ASSUNTO"], $conexao_com_banco); 
								?>
							<br>
							<b>Detalhes</b>:	
								<?php 
									echo $informacoes["NM_DETALHES"];
								?>
							<br>
							
							
							
							<br>
							<b>Órgão interessado</b>:	
								<?php 
									echo retorna_nome_orgao($informacoes["ID_ORGAO_INTERESSADO"], $conexao_com_banco);
								?><br>
							
							<b>Nome do interessado</b>:	
								<?php 
									echo $informacoes["NM_INTERESSADO"];
								?><br>
							
							
							
							<br>
							
							<b>Dias no órgão</b>:
								<?php echo $informacoes["NR_DIAS"] ?><br>
								
							<b>Dias em sobrestado</b>:
							<?php echo $informacoes["NR_DIAS_SOBRESTADO"] ?><br>	
							
							<b>Data de entrada</b>:
								<?php echo date_format(new DateTime($informacoes["DT_ENTRADA"]), 'd/m/Y')?><br>
							
							<b>Prazo</b>:
								<?php echo date_format(new DateTime($informacoes["DT_PRAZO"]), 'd/m/Y')?><br>
							
							<b>Data de saída</b>:
								<?php if($informacoes["DT_SAIDA"] != '0000-00-00'){
										echo date_format(new DateTime($informacoes["DT_SAIDA"]), 'd/m/Y');
								} ?>
						</div>
					</div>
					
					<?php include('historico.php'); ?>
					
				</div>
			</div>
		</div>
	</div>
</div>

<?php include('../foot.php')?>