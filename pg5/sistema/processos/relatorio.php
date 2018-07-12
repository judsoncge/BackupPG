<?php 
include('../head.php');
include('../body.php');
?>

<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Relatório</p>
	</div>
	
<div class="container caixa-conteudo">
	
	<div class="row linha-grafico">
		<div class="col-md-12" style="height: 40px;">
			<div class="grafico" id="processos-ativos" >
				<center>
					<b>
						Total de processos: (ativos, arquivados e saíram): 
					
						<?php 
							$total = retorna_quantidade_processos($conexao_com_banco);
							
							echo $total;
						?>
					</b>
				</center>
			</div>	
		</div>
	</div>
		
	<div class="row linha-grafico">		
		<div class="col-md-12">
			<div class="grafico" id="processos-ativos" >
				<center>
					<b>
						<?php 
							$total_ativos = retorna_quantidade_processos_ativos($conexao_com_banco);
							
							echo "Total de ativos: " . $total_ativos;
						
							$total_ativos = retorna_quantidade_processos_ativos_atraso(0, $conexao_com_banco);
							
							echo " (" . $total_ativos . " dentro do prazo e ";
						
							$total_ativos = retorna_quantidade_processos_ativos_atraso(1, $conexao_com_banco);
							
							echo $total_ativos . " atrasados)";
						?>
					</b>
				</center>
				
				<br>
				<br>
				
				<table class="table table-bordered">
					<thead>
						<tr>
							<th><center>Setor</center></th>
							<th>Total (No prazo + Atrasados)</th>
							<th>Em andamento</th>
							<th>Finalizados pelo Setor</th>
							<th>Finalizados pelo Gabinete</th>
						</tr>
					</thead>
					</body>
					
						<?php
							$lista = retorna_setores($conexao_com_banco);
							
							while($setor = mysqli_fetch_object($lista)){
								
								$nome = $setor->NM_SETOR;
								
								$ativos = retorna_quantidade_processos_ativos_setor($setor->ID, $conexao_com_banco);
								
								$noPrazo = retorna_quantidade_processos_ativos_setor_atraso($setor->ID, 0, $conexao_com_banco);
								
								$atrasados = retorna_quantidade_processos_ativos_setor_atraso($setor->ID, 1, $conexao_com_banco);
								
								$emAndamento = retorna_quantidade_processos_status_setor($setor->ID, "EM ANDAMENTO", $conexao_com_banco);
								
								$finalizadosPeloSetor = retorna_quantidade_processos_status_setor($setor->ID, "FINALIZADO PELO SETOR", $conexao_com_banco);
								
								$finalizadosPeloGabinete = retorna_quantidade_processos_status_setor($setor->ID, "FINALIZADO PELO GABINETE", $conexao_com_banco);
						
								
								echo 
								
								"<tr>
									<td><center>$nome                   </center></td>
									<td>
										<center>
											$ativos	($noPrazo + $atrasados)		
										</center>
									</td>
									<td><center>$emAndamento            </center></td>
									<td><center>$finalizadosPeloSetor   </center></td>
									<td><center>$finalizadosPeloGabinete</center></td>
								</tr>";	
	
							}
						?>
					</tbody>	
				</table>		
			</div>
		</div>
	</div>
	<div class="row linha-grafico">		
		<div class="col-md-12">
			<div class="grafico" id="processos-ativos" >
				<center>
					<b>
						<?php 
							$media_total = retorna_media_dias_processo($conexao_com_banco);
							
							echo "Tempo médio dos processos no órgão: " . $media_total;
						?>
					</b>
				</center>
					
						<table class="table table-bordered">
							<thead>
								
									<tr>
										<th><center>Assunto</center></th>
										<th><center>Média</center></th>
									</tr>
					
							</thead>
							<tbody>
					
								<?php
									$lista = retorna_media_dias_por_assunto($conexao_com_banco);
									
									while($ranking = mysqli_fetch_object($lista)){
										
										$nome = $ranking->NM_ASSUNTO;
										
										$media = $ranking->MEDIA;
										
										echo 
										
										"<tr>
											<td><center>$nome </center></td>
											<td><center>$media</center></td>
										</tr>";	
			
									}
								?>
								
							</tbody>	
						</table>
				</center>
			</div>
		</div>
	</div>
</div>
