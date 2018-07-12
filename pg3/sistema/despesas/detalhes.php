<?php 
include('../head.php');
include('../body.php');
$ano = date('Y');
$mes = date('m');
$informacoes = retorna_informacoes_despesa($_GET['despesa'], $conexao_com_banco);
$id = $informacoes['ID_DESPESA'];
?>


<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Despesa <?php echo retorna_nome_despesa($informacoes['CD_DESPESA'], $conexao_com_banco); ?></p>
	</div>
	<p><h3>Valor solicitado: <?php echo "R$ " . arruma_numero($informacoes['VLR_DESPESA']);?></h3></p>
	<?php include('../includes/resumo_caixa.php'); ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="row" style="margin-top: 10px;">
						<div class="col-md-12">
						
							<?php 
								
								if($informacoes['NM_STATUS'] != 'Pago' and $informacoes['NM_STATUS'] != 'Pago atrasado'){	
									include('botoes.php'); 
								} 
							?>
							
							<?php include('dados_despesa.php'); ?>
							
							<?php include('historico.php'); ?>
							
							<?php 
							
								if($informacoes['NM_STATUS'] != 'Pago' and $informacoes['NM_STATUS'] != 'Pago atrasado'){	
									include('../includes/enviar-mensagem.php'); 
								} 
							?>
							
							<?php include('anexos.php'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<?php include('../foot.php')?>