<?php 
include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php');
date_default_timezone_set('America/Bahia');
$mes = $_GET['mes'];
$ano = $_GET['ano'];
if(($mes < 1 or $mes > 12)){
	echo "<script>alert('Mês inválido!')</script>";
	echo "<script>history.back()</script>";
	die();
}
include('../nucleo-aplicacao/atualiza_notas.php');
atualiza_produtividade($mes, $ano, $conexao_com_banco);
atualiza_cumprimento_prazo($mes, $ano, $conexao_com_banco);
atualiza_nota_geral($mes, $ano, $conexao_com_banco);
$permmissao = retorna_permissao($_SESSION['CPF'],'VISUALIZAR_TODOS_ORGAO_INDICE_PRODUTIVIDADE',$conexao_com_banco); 
?>
   
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-md-10">
				<h5 style="margin-left:25px;">Avaliação referente ao mês de <?php echo arruma_data_mes2($mes);?>/<?php echo $ano;?></h5>
			</div>
			<!--<div class="col-md-2">	
				<a href="relatorioavaliacao-geral.php?sessionId=<?php echo $num ?>" target="_blank"><button type="button" class="btn pull-right">Gerar relatório do setor</button></a>
			</div>-->
		</div>
		<div class="row">
			<div class="col-md-12">
				<center><h5>Média geral: <?php if($permissao=='sim'){$geral = retorna_media_geral($mes, $ano, $conexao_com_banco);}else{$geral = retorna_media_geral_setor($mes, $ano, $_SESSION['setor'], $conexao_com_banco);} $geral = number_format($geral, 1, '.', '.'); echo $geral; ?></h5></center>
			</div>
		</div>
		
			<?php $lista = retorna_servidores_avaliados($conexao_com_banco);
			while($r = mysqli_fetch_object($lista)){ 				
			
				include('includes/calcula_notas.php');
		
			?>
				<div class="row linha-grafico">
					
					<div class="grafico2">
						<div class="col-md-5">
							<center>
								<div class='box-servidor2'>
									<img src='../registros/fotos/<?php echo $r->NM_ARQUIVO_FOTO ?>' class='servidor-img2'></img>
								</div>
								<div style="margin-top:10px;"><b><?php $nome_completo = $r->NM_SERVIDOR . " " . $r->SNM_SERVIDOR; echo $nome_completo; ?></b></div>
							</center>
						</div>	
						<div class="col-md-7">
								<div class="row" style="padding-top:10px;">
									<div class="col-md-8">
										<h2>Nota Geral: <?php echo number_format($nota_geral, 1); ?></h2>
									</div>

									<div class="col-md-4">
										<a href="relatorioavaliacao.php?sessionId=<?php echo $num ?>&
										cargo=<?php echo $r->NM_CARGO ?>&
										foto=<?php echo $r->NM_ARQUIVO_FOTO?>&
										geralsetor=<?php echo $geral ?>&
										geral=<?php echo number_format($nota_geral, 1) ?>&
										produtividade=<?php echo $nota_produtividade ?>&
										cumprimento=<?php echo $nota_cumprimento ?>&
										assiduidade=<?php echo $nota_assiduidade ?>&
										mes=<?php echo arruma_data_mes2($mes) ?>&
										ano=<?php echo $ano ?>&
										nome=<?php echo $nome_completo ?>&
										nome_gerador=<?php echo $nome_gerador ?>&
										cargo_gerador=<?php echo $cargo_gerador ?>&
										documentos_criados=<?php echo $total_documentos_criados ?>&
										documentos_com_sugestao=<?php echo $total_documentos_com_sugestao ?>&
										documentos_sem_sugestao=<?php echo $total_documentos_sem_sugestao ?>&
										processos_mes=<?php echo $total_processos ?>&
										processos_concluidos=<?php echo $processos_concluidos ?>&
										processos_concluidos_atraso=<?php echo $processos_concluidos_atraso ?>&
										horas_esperadas=<?php echo $horas_esperadas ?>&
										horas_trabalhadas=<?php echo $horas_trabalhadas ?>&
										horas_abonadas=<?php echo $horas_abonadas ?>&
										justificativa=<?php echo $justificativa ?>&
										extra_assiduidade=<?php echo $nota_extra_assiduidade ?>&
										extra_cumprimento=<?php echo $nota_extra_cumprimento ?>&
										extra_produtividade=<?php echo $nota_extra_produtividade ?>" 
										target="_blank"><button type="button" class="btn">Gerar relatório</button></a>
									</div>

								</div>
								<hr>
								<div class="row">
									<div class="col-md-12">
										<h4>Produtividade: <b><?php echo number_format($nota_produtividade, 1, '.', '.'); if($nota_extra_produtividade!=0){echo " (extra: ". $nota_extra_produtividade . ")";}?></b></h4>
										
										
											<h6>Total de documentos criados: <?php echo $total_documentos_criados; ?></h6>
											<h6>Total de documentos com sugestão: <?php echo $total_documentos_com_sugestao; ?></h6>
											<h6>Total de documentos sem sugestão: <?php echo $total_documentos_sem_sugestao; ?></h6>
										<hr>
										<h4>Cumprimento de prazo: <b><?php echo number_format($nota_cumprimento, 1, '.', '.'); if($nota_extra_cumprimento!=0){echo " (extra: ". $nota_extra_cumprimento . ")";}?></b></h4>
										
											<h6>Total de processos no mês: <?php echo $total_processos; ?></h6>
											<h6>Total de concluídos no prazo: <?php echo $processos_concluidos; ?></h6>
											<h6>Total de concluídos com atraso: <?php echo $processos_concluidos_atraso; ?></h6>
										<hr>
										<h4>Assiduidade: <b><?php echo number_format($nota_assiduidade, 1, '.', '.'); if($nota_extra_assiduidade!=0){echo " (extra: ". $nota_extra_assiduidade . ")";}?></b></h4>
										
											<h6>Total de horas esperadas: <?php echo $horas_esperadas; ?></h6>
											<h6>Total de horas trabalhadas: <?php echo $horas_trabalhadas; ?></h6>
											<h6>Total de horas abonadas: <?php echo $horas_abonadas; ?></h6>
											<h6>Justificativas de abonos: <?php echo $justificativa; ?></h6>
										
										
										
									</div>
								</div>
																		
								
						</div>
						
					
					</div>
					
				</div>
		<?php } ?>

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
