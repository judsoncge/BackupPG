<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
date_default_timezone_set('America/Bahia');
?>
   
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-md-10">
				<h5 style="margin-left:25px;">Avaliação referente ao mês de <?php $ano=date('Y'); $mes = date('m')-1; echo arruma_data_mes2($mes);?></h5>
			</div>
			<!--<div class="col-md-2">	
				<a href="relatorioavaliacao-geral.php?sessionId=<?php echo $num ?>" target="_blank"><button type="button" class="btn pull-right">Gerar relatório do setor</button></a>
			</div>-->
		</div>
		<div class="row">
			<div class="col-md-12">
				<center><h5>Média do setor no momento: <?php $geral = retorna_nota_geral_setor_mes($conexao_com_banco); $geral = number_format($geral, 1, '.', '.') ; echo $geral ?></h5></center>
			</div>
		</div>
		
			<?php $lista = retorna_avaliar($conexao_com_banco);
			while($r = mysqli_fetch_object($lista)){ 				
			
				include('includes/calcula_notas.php');
		
			?>
				<div class="row linha-grafico">
					
					<div class="grafico2">
						<div class="col-md-5">
							<center>
								<div class='box-servidor2'>
									<img src='../registros/fotos/<?php echo $r->foto ?>' class='servidor-img2'></img>
								</div>
								<div style="margin-top:10px;"><b><?php $nome_completo = $r->nome . " " . $r->sobrenome; echo $nome_completo; ?></b></div>
							</center>
						</div>	
						
					
						
						<div class="col-md-7">
								<div class="row" style="padding-top:10px;">
									
									
									<div class="col-md-8">
										<h2>Nota Geral: <?php echo number_format($nota_geral, 1); ?></h2>
									</div>
									
										
								
									
									<div class="col-md-4">
										<a href="relatorioavaliacao.php?sessionId=<?php echo $num ?>&
										cargo=<?php echo $r->cargo ?>&
										foto=<?php echo $r->foto?>&
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
										processos_mes=<?php echo $total_processos_mes ?>&
										processos_concluidos=<?php echo $processos_concluidos ?>&
										processos_concluidos_atraso=<?php echo $processos_concluidos_atraso ?>&
										horas_esperadas=<?php echo $horas_esperadas ?>&
										horas_trabalhadas=<?php echo $horas_trabalhadas ?>&
										horas_abonadas=<?php echo $horas_abonadas ?>&
										justificativa=<?php echo $justificativa ?>" target="_blank"><button type="button" class="btn">Gerar relatório</button></a>
									</div>

								</div>
								<hr>
								<div class="row">
									<div class="col-md-12">
										<h4>Produtividade: <b><?php if($nota_produtividade==null){echo 'Sem nota';}else{ echo $nota_produtividade; } ?></b></h4>
										
											<h6>Total de documentos criados: <?php echo $total_documentos_criados; ?></h6>
											<h6>Total de documentos com sugestão: <?php echo $total_documentos_com_sugestao; ?></h6>
											<h6>Total de documentos sem sugestão: <?php echo $total_documentos_sem_sugestao; ?></h6>
										<hr>
										<h4>Cumprimento de prazo: <b><?php if($nota_cumprimento==null){echo 'Sem nota';}else{ echo $nota_cumprimento; } ?></b></h4>
										
											<h6>Total de processos no mês: <?php echo $total_processos_mes; ?></h6>
											<h6>Total de concluídos no prazo: <?php echo $processos_concluidos; ?></h6>
											<h6>Total de concluídos com atraso: <?php echo $processos_concluidos_atraso; ?></h6>
										<hr>
										<h4>Assiduidade: <b><?php if($nota_assiduidade==null){echo 'Sem nota';}else{ echo $nota_assiduidade; } ?></b></h4>
										
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
