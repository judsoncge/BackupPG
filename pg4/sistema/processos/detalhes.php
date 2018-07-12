<?php 
include('../head.php');
include('../body.php');
$informacoes = retorna_informacoes_processo($_GET['processo'], $conexao_com_banco);
$responsaveis_processo = retorna_responsaveis_processo($informacoes['CD_PROCESSO'], $conexao_com_banco);
$id = $informacoes['CD_PROCESSO'];
$mexer_processo_outros = retorna_pode_mexer_processo_outros($informacoes['CD_SETOR_LOCALIZACAO'], $informacoes['NM_STATUS'], $conexao_com_banco);
echo 'aqui: '.retorna_processo_em_tramitacao($id, $conexao_com_banco);
$em_tramitacao = retorna_processo_em_tramitacao($id, $conexao_com_banco);
$pagina = $_GET['pagina'];
?>

<script type="text/javascript">	
$(document).ready(function(){
	$('#responsaveis').multipleSelect();
});
</script>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>
		<?php if ($informacoes['NR_URGENCIA'] == 1) {?>	
			<i class="fa fa-exclamation-triangle"></i>
		<?php	}?>	
					
		
		Processo <?php echo $informacoes['CD_PROCESSO'] ?> 	
		
		<?php if($informacoes['CD_PROCESSO_APENSADO'] == '' and $informacoes['NM_STATUS'] == 'Saiu' and $_SESSION['permissao-voltar-processo']=='sim'){	?>	
				<a href="logica/editar.php?operacao=voltar&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&assunto=<?php echo $informacoes['ID_ASSUNTO'] ?>&pagina=comigo">
				<button type='submit' class='btn btn-sm btn-success' name='submit' value='Send' id='botao-dar-saida'>
				Voltar para o órgão&nbsp;&nbsp;<i class="fa fa-external-link-square" aria-hidden="true"></i></button></a>	
			<?php } ?>	
		
		<?php if($informacoes['CD_PROCESSO_APENSADO'] == '' and $informacoes['NM_STATUS'] == 'Arquivado' and $_SESSION['permissao-desarquivar-processo']=='sim'){	?>	
				<a href="logica/editar.php?operacao=desarquivar&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&prazo='<?php echo $informacoes['DT_PRAZO'] ?>&pagina=comigo">
				<button type='submit' class='btn btn-sm btn-success' name='submit' value='Send' id='botao-dar-saida'>
				Desarquivar&nbsp;&nbsp;<i class="fa fa-external-link-square" aria-hidden="true"></i></button></a>	
		<?php } ?>
				
		</p>		
	</div>
	
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="row" style="margin-top: 10px;">
						<div class="col-md-12">
						<?php	
						
							if($informacoes['CD_SERVIDOR_LOCALIZACAO']!=$_SESSION['CPF'] and $mexer_processo_outros == false){
								echo '<center><div class="alert alert-warning">&#9888; Este processo está com outra pessoa e você não tem a permissão de executar algumas operações nos processos com outras pessoas.</div></center>';
							 }
							 
							 if($em_tramitacao){
								echo '<center><div class="alert alert-warning">&#9888; Este processo ainda não teve sua tramitação confirmada e portanto não pode ser editado.</div></center>';
							 }
						
						
							 if($informacoes['CD_PROCESSO_APENSADO']!=''){
								echo '<center><div class="alert alert-warning">&#9888; Este processo é apenso de outro processo. Portanto, algumas operações só poderão ser efetuadas no seu processo-mãe.</div></center>';
							 }
							 
							 if($informacoes['NR_URGENCIA']==1 and $informacoes['NM_STATUS']!='Arquivado' and  $informacoes['NM_STATUS']!='Saiu'){
								echo '<center><div class="alert alert-warning">&#9888; ESTE PROCESSO É URGENTE!</div></center>';
							 }
							 
							 if($informacoes['NM_STATUS']=='Atrasado'){
								echo '<center><div class="alert alert-danger" role="alert">&#9760; ESTE PROCESSO ESTÁ ATRASADO!</div></center>';
							 }
							
							if(($informacoes['CD_SERVIDOR_LOCALIZACAO']==$_SESSION['CPF'] or $mexer_processo_outros == true) and $em_tramitacao == false){
								include('botoes.php');
							}

							 if(($informacoes['CD_SERVIDOR_LOCALIZACAO']==$_SESSION['CPF'] or $mexer_processo_outros == true) and $informacoes['CD_PROCESSO_APENSADO']=='' and $_SESSION['permissao-urgencia-processo']=='sim' and $em_tramitacao == false){
								include('definir-urgencia.php'); 
							 }
							 
							 include('informacoes.php');
							
							 include('lista-responsaveis.php');
							 
							 include('lider-processo.php');
							
							 include('documentos-processo.php');
							 
							 if($informacoes['CD_PROCESSO_APENSADO']==''){
								include('apensos-processo.php'); 
							 }
							 
							 include('historico.php');
							 
							 if($informacoes['NM_STATUS']!='Saiu' and $informacoes['NM_STATUS']!='Arquivado'){
								 
								 if(($informacoes['CD_SERVIDOR_LOCALIZACAO']==$_SESSION['CPF'] or $mexer_processo_outros == true) and $em_tramitacao == false){
									include('../includes/enviar-mensagem.php'); 
								 } 
								
								 if(($informacoes['CD_SERVIDOR_LOCALIZACAO']==$_SESSION['CPF'] or $mexer_processo_outros == true) and $_SESSION['permissao-definir-prazo-processo']=='sim' and $informacoes['CD_PROCESSO_APENSADO']=='' and $em_tramitacao == false){
									 include('definir-prazos.php'); 
								 }
								 
								 if(($informacoes['CD_SERVIDOR_LOCALIZACAO']==$_SESSION['CPF'] or $mexer_processo_outros == true) and $_SESSION['permissao-definir-responsaveis-processo']=='sim' and $informacoes['CD_PROCESSO_APENSADO']=='' and $em_tramitacao == false){
									 include('definir-responsaveis.php'); 
									 include('definir-lider.php');
								 }
							
								if(($informacoes['CD_SERVIDOR_LOCALIZACAO']==$_SESSION['CPF'] or $mexer_processo_outros == true) and $informacoes['CD_PROCESSO_APENSADO']=='' and $_SESSION['permissao-definir-apenso-processo']=='sim' and $em_tramitacao == false){
									include('definir-processos-apensados.php');
								}
								
								if(($informacoes['CD_SERVIDOR_LOCALIZACAO']==$_SESSION['CPF'] or $mexer_processo_outros == true) and $informacoes['CD_PROCESSO_APENSADO']=='' and $em_tramitacao == false){
									include('tramitar.php'); 
								}
								
							 }
							
							?>							
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>

<?php include('../foot.php')?>