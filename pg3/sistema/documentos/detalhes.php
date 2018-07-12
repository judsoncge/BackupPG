<?php 
include('../head.php');
include('../body.php');
$informacoes = retorna_informacoes_documento($_GET['documento'], $conexao_com_banco);
$id = $informacoes['CD_DOCUMENTO'];
$prazo = retorna_prazo_processo($informacoes['CD_PROCESSO'], $conexao_com_banco);
$prazo_final = retorna_prazo_final_processo($informacoes['CD_PROCESSO'], $conexao_com_banco);
?>

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Documento sobre <?php echo $informacoes['NM_ATIVIDADE'] ?></p>
	</div>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					
					<?php 
					
					if(($informacoes['NM_STATUS'] != 'Resolvido' and $informacoes['CD_SERVIDOR_LOCALIZACAO']==$_SESSION['CPF']) or ($informacoes['NM_STATUS'] != 'Resolvido' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $informacoes['NM_STATUS'] == 'Ativo' and ($informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor'] or $informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor-subordinado'])) or ($informacoes['NM_STATUS'] != 'Resolvido' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim')){
						include('botoes.php'); 
					}
					
					include('informacoes.php');
					
					include('historico.php');
					
					if(($informacoes['NM_STATUS'] != 'Resolvido' and $informacoes['CD_SERVIDOR_LOCALIZACAO']==$_SESSION['CPF']) or ($informacoes['NM_STATUS'] != 'Resolvido' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $informacoes['NM_STATUS'] == 'Ativo' and ($informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor'] or $informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor-subordinado'])) or ($informacoes['NM_STATUS'] != 'Resolvido' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim')){
						include('../includes/enviar-mensagem.php');
					}
					
					if(($_SESSION['permissao-sugestao-documento'] == 'sim' and $informacoes['NM_STATUS'] != 'Aprovado' and $informacoes['CD_SERVIDOR_LOCALIZACAO']==$_SESSION['CPF']) or ($_SESSION['permissao-sugestao-documento'] == 'sim' and $informacoes['NM_STATUS'] != 'Aprovado' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $informacoes['NM_STATUS'] == 'Ativo' and ($informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor'] or $informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor-subordinado'])) or ($_SESSION['permissao-sugestao-documento'] == 'sim' and $informacoes['NM_STATUS'] != 'Aprovado' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim')){
						include('sugestao.php');
					}
					
					include('anexos.php');
									
					if(($informacoes['NM_STATUS'] != 'Resolvido' and $informacoes['CD_SERVIDOR_LOCALIZACAO']==$_SESSION['CPF']) or ($informacoes['NM_STATUS'] != 'Resolvido' and  $_SESSION['permissao-fazer-operacoes-outros-setor']=='sim' and $informacoes['NM_STATUS'] == 'Ativo' and ($informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor'] or $informacoes['CD_SETOR_LOCALIZACAO']==$_SESSION['setor-subordinado'])) or ($informacoes['NM_STATUS'] != 'Resolvido' and $_SESSION['permissao-fazer-operacoes-outros-orgao']=='sim')){
						include('enviar.php'); 
					}
					?>
								
				</div>
			</div>
		</div>
	</div>
</div>

<?php include('../foot.php')?>