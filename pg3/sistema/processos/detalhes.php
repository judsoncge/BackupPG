<?php 
include('../head.php');
include('../body.php');
$informacoes = retorna_informacoes_processo($_GET['processo'], $conexao_com_banco);
$id = $informacoes['CD_PROCESSO'];
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
		<?php if ($informacoes['URGENTE'] == 1) {?>	
			<i class="fa fa-exclamation-triangle"></i>
		<?php	}?>	
					
		
		Processo <?php echo $informacoes['CD_PROCESSO'] ?> 	
			<?php if($informacoes['NM_STATUS'] == 'Saiu' and $_SESSION['permissao-voltar-processo']=='sim'){	?>	
				<a href="logica/editar.php?operacao=voltar&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&prazo_final='<?php echo $informacoes['DT_PRAZO_FINAL'] ?>">
				<button type='submit' class='btn btn-sm btn-success' name='submit' value='Send' id='botao-dar-saida'>
				Colocar processo de volta&nbsp;&nbsp;<i class="fa fa-external-link-square" aria-hidden="true"></i></button></a>	
			<?php } ?>	
			
			<?php if($informacoes['NM_STATUS'] == 'Arquivado' and $_SESSION['permissao-desarquivar-processo']=='sim'){	?>	
				<a href="logica/editar.php?operacao=desarquivar&processo=<?php echo $informacoes['CD_PROCESSO'] ?>&prazo_final='<?php echo $informacoes['DT_PRAZO_FINAL'] ?>'">
				<button type='submit' class='btn btn-sm btn-success' name='submit' value='Send' id='botao-dar-saida'>
				Desarquivar&nbsp;&nbsp;<i class="fa fa-external-link-square" aria-hidden="true"></i></button></a>	
			<?php } ?>	
		</p>
	</div>
	<?php
		echo '<center>Prazo para o servidor e superintendente analisarem o processo: <b>'. arruma_data($informacoes['DT_PRAZO']) .' ('.$informacoes['NM_SITUACAO'].')</b><br>';
		echo 'Prazo para o processo ser arquivado ou sair do órgão: <b>'. arruma_data($informacoes['DT_PRAZO_FINAL']). ' ('.$informacoes['NM_SITUACAO_FINAL'].')</b><br></center>';  
	?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="row" style="margin-top: 10px;">
						<div class="col-md-12">
						
							<?php 
							
							if(($informacoes['NM_STATUS'] != 'Saiu' and $informacoes['NM_STATUS'] != 'Arquivado' and $informacoes['CD_SERVIDOR_LOCALIZACAO']==$_SESSION['CPF']) or ($informacoes['NM_STATUS'] != 'Saiu' and $informacoes['NM_STATUS'] != 'Arquivado' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $informacoes['NM_STATUS'] == 'Ativo' and ($informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor'] or $informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor-subordinado'])) or ($informacoes['NM_STATUS'] != 'Saiu' and $informacoes['NM_STATUS'] != 'Arquivado' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim')){
								include('botoes.php');
							 }
							
							 include('informacoes.php'); 
							
							 include('lista-responsaveis.php');
							
							 include('documentos-processo.php'); 
							
							 include('historico.php');
												
							 if(($informacoes['NM_STATUS'] != 'Saiu' and $informacoes['NM_STATUS'] != 'Arquivado' and $informacoes['CD_SERVIDOR_LOCALIZACAO']==$_SESSION['CPF']) or ($informacoes['NM_STATUS'] != 'Saiu' and $informacoes['NM_STATUS'] != 'Arquivado' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $informacoes['NM_STATUS'] == 'Ativo' and ($informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor'] or $informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor-subordinado'])) or ($informacoes['NM_STATUS'] != 'Saiu' and $informacoes['NM_STATUS'] != 'Arquivado' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim')){
									include('../includes/enviar-mensagem.php'); 
								} 
							
							if(($_SESSION['permissao-definir-prazo-processo']=='sim' and $_SESSION['permissao-definir-prazo-final-processo']=='sim' and $informacoes['NM_STATUS'] != 'Saiu' and$informacoes['NM_STATUS'] != 'Arquivado' and $informacoes['CD_SERVIDOR_LOCALIZACAO']==$_SESSION['CPF']) or ($_SESSION['permissao-definir-prazo-processo']=='sim' and $_SESSION['permissao-definir-prazo-final-processo']=='sim' and $informacoes['NM_STATUS'] != 'Saiu' and $informacoes['NM_STATUS'] != 'Arquivado' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $informacoes['NM_STATUS'] == 'Ativo' and ($informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor'] or $informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor-subordinado'])) or ($_SESSION['permissao-definir-prazo-processo']=='sim' and $_SESSION['permissao-definir-prazo-final-processo']=='sim' and $informacoes['NM_STATUS'] != 'Saiu' and $informacoes['NM_STATUS'] != 'Arquivado' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim')){
									include('definir-prazos.php'); 
								} 
				
							if(($_SESSION['permissao-definir-responsaveis-processo']='sim' and $informacoes['NM_STATUS'] != 'Saiu' and $informacoes['NM_STATUS'] != 'Arquivado' and $informacoes['CD_SERVIDOR_LOCALIZACAO']==$_SESSION['CPF']) or ($_SESSION['permissao-definir-responsaveis-processo']='sim' and $informacoes['NM_STATUS'] != 'Saiu' and $informacoes['NM_STATUS'] != 'Arquivado' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $informacoes['NM_STATUS'] == 'Ativo' and ($informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor'] or $informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor-subordinado'])) or ($_SESSION['permissao-definir-responsaveis-processo']='sim' and $informacoes['NM_STATUS'] != 'Saiu' and $informacoes['NM_STATUS'] != 'Arquivado' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim')){
									include('definir-responsaveis.php'); 
								} 
						
							if(($informacoes['NM_STATUS'] != 'Saiu' and $informacoes['NM_STATUS'] != 'Arquivado' and $informacoes['CD_SERVIDOR_LOCALIZACAO']==$_SESSION['CPF']) or ($informacoes['NM_STATUS'] != 'Saiu' and $informacoes['NM_STATUS'] != 'Arquivado' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $informacoes['NM_STATUS'] == 'Ativo' and ($informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor'] or $informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor-subordinado'])) or ($informacoes['NM_STATUS'] != 'Saiu' and $informacoes['NM_STATUS'] != 'Arquivado' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim')){
								include('tramitar.php'); 
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