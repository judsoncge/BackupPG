<?php 
include('head.php');
include('body.php');
$data = date("Y-m-d");
?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
<p><h2>Bem vindo(a) ao Painel de Gestão, <?php echo $_SESSION["nome"] ?>!</h2></p>

<?php if($_SESSION['permissao-visualizar-relatorio-orgao']=='sim'){ ?>
<center>
	<p>Hoje, até agora, <b>entraram</b> <?php echo retorna_processos_entraram_hoje($conexao_com_banco); ?> processos.</p>
	<p>Hoje, até agora, <b>saíram</b> <?php echo retorna_processos_sairam_hoje($conexao_com_banco); ?> processos.</p>
	<p>Hoje, <?php echo retorna_processos_prazo_hoje($conexao_com_banco); ?> processos <b>vencem o prazo</b>.
	<?php if($_SESSION["permissao-visualizar-todos-processos"]=="sim"){ ?>
		<a href="processos/todos.php?filtro=<?php echo arruma_data($data) ?>">Ver</a>
	<?php } ?>
	</p>
</center>
  <div class="container caixa-conteudo">
    <div class="row">
      <div class="col-md-12" style="margin-left: 20px;">
	  Total de processos (ativos, arquivados e saíram): <b><?php $numero_total = retorna_numero_processos($conexao_com_banco); 
		echo $numero_total ?></b>
      </div>
    </div>
    <div class="row linha-grafico">
		  <div class="col-md-4">
				<div class="grafico" id="processos-ativos" >
				<b>Total</b>: <?php echo retorna_numero_processos_ativos($conexao_com_banco) ?><br><br>
					<?php 
					$lista = retorna_setores($conexao_com_banco);
					while($r = mysqli_fetch_object($lista)){
						echo $r->NM_SETOR. ": <b>". retorna_numero_processos_setor($r->CD_SETOR,$conexao_com_banco) . "</b><br>"; 
					} 
					?>
				</div>
		  </div>
		 
		  <div class="col-md-4">
				<div class="grafico" id="processos-finalizacao">
				<b>Em andamento</b>: <?php echo retorna_numero_processos_status('Em andamento',$conexao_com_banco) ?>
				<br><br>
				<?php 
					$lista = retorna_setores($conexao_com_banco);
					while($r = mysqli_fetch_object($lista)){
						echo $r->NM_SETOR. ":<b>". retorna_numero_processos_setor_status($r->CD_SETOR, 'Em andamento', $conexao_com_banco) . "</b><br>"; 
					} 
				?>
				</div>
		 </div>
		 
		  <div class="col-md-4">
				<div class="grafico" id="processos-finalizacao">
				<b>Atrasados</b>: <?php echo retorna_numero_processos_status('Atrasado',$conexao_com_banco) ?><br><br>
					<?php 
					$lista = retorna_setores($conexao_com_banco);
					while($r = mysqli_fetch_object($lista)){
						echo $r->NM_SETOR. ":<b>". retorna_numero_processos_setor_status($r->CD_SETOR, 'Atrasado', $conexao_com_banco) . "</b><br>"; 
					} 
					?>
				</div>
		 </div>
		 
    </div>  
	
	<div class="row linha-grafico">
		<div class="col-md-6">
				<div class="grafico" id="processos-finalizacao">
				<b>Finalizados pelo setor</b>: <?php echo retorna_numero_processos_status('Finalizado pelo setor',$conexao_com_banco) ?><br><br>
					<?php 
					$lista = retorna_setores($conexao_com_banco);
					while($r = mysqli_fetch_object($lista)){
						echo $r->NM_SETOR. ":<b>". retorna_numero_processos_setor_status($r->CD_SETOR, 'Finalizado pelo setor', $conexao_com_banco) . "</b><br>"; 
					} 
					?>
				</div>
		 </div>
		 <div class="col-md-6">
				<div class="grafico" id="processos-finalizacao">
				<b>Finalizados pelo gabinete</b>: <?php echo retorna_numero_processos_status('Finalizado pelo gabinete',$conexao_com_banco) ?><br><br>
					<?php 
					$lista = retorna_setores($conexao_com_banco);
					while($r = mysqli_fetch_object($lista)){
						echo $r->NM_SETOR. ":<b>". retorna_numero_processos_setor_status($r->CD_SETOR, 'Finalizado pelo gabinete', $conexao_com_banco) . "</b><br>"; 
					} 
					?>
				</div>
		 </div>
	</div>
    
    
	<div class="row linha-grafico">
      <div class="col-md-3">
        <div class="grafico" id="processos-finalizacao">
		<b>Foram arquivados</b>:<br><br>
			<?php 
				echo "<h1 class='grafico-numero'>". retorna_numero_processos_status('Arquivado', $conexao_com_banco) . "</h1>"; 
			?>
		</div>
      </div>
	  <div class="col-md-3">
        <div class="grafico" id="processos-arquivados-e-saiu">
		<b>Saíram do órgão</b>:<br><br>
			<?php 
				echo "<h1 class='grafico-numero'>". retorna_numero_processos_status('Saiu', $conexao_com_banco) . "</h1>"; 
			?>
		</div>
      </div>
	
	<div class="col-md-3">
        <div class="grafico" id="processos-finalizacao">
			<b>Entraram e saíram indivualmente</b> no mês atual neste ano:<br><br>
			Entraram: <?php echo retorna_processos_entraram_mes_individual(date('m'), date('Y'), $conexao_com_banco); ?> <br>Saíram: <?php echo retorna_processos_sairam_mes_individual(date('m'), date('Y'), $conexao_com_banco); ?>
		</div>
      </div>
	 <div class="col-md-3">
        <div class="grafico" id="processos-finalizacao">
			<b>Entraram e saíram acumuladamente</b> no mês atual neste ano:<br><br>
			Entraram: <?php echo retorna_processos_entraram_mes_acumulado(date('m'), date('Y'), $conexao_com_banco); ?> <br>Saíram: <?php echo retorna_processos_sairam_mes_acumulado(date('m'), date('Y'), $conexao_com_banco); ?>
		</div>
      </div>	
	
      
	</div> 
	<div class="row linha-grafico">
      <div class="col-md-6">
        <div class="grafico" id="processos-finalizacao">
			Processos que <b>entraram e saíram indivualmente</b> por mês neste ano</b>:<br><br>
			<h4>Janeiro:</h4> Entraram: <?php echo retorna_processos_entraram_mes_individual('01', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_individual('01', date('Y'), $conexao_com_banco); ?>
			<h4>Fevereiro:</h4> Entraram: <?php echo retorna_processos_entraram_mes_individual('02', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_individual('02', date('Y'), $conexao_com_banco); ?>
			<h4>Março:</h4> Entraram: <?php echo retorna_processos_entraram_mes_individual('03', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_individual('03', date('Y'), $conexao_com_banco); ?>
			<h4>Abril:</h4> Entraram: <?php echo retorna_processos_entraram_mes_individual('04', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_individual('04', date('Y'), $conexao_com_banco); ?>
			<h4>Maio:</h4> Entraram: <?php echo retorna_processos_entraram_mes_individual('05', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_individual('05', date('Y'), $conexao_com_banco); ?>
			<h4>Junho:</h4> Entraram: <?php echo retorna_processos_entraram_mes_individual('06', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_individual('06', date('Y'), $conexao_com_banco); ?>
			<h4>Julho:</h4> Entraram: <?php echo retorna_processos_entraram_mes_individual('07', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_individual('07', date('Y'), $conexao_com_banco); ?>
			<h4>Agosto:</h4> Entraram: <?php echo retorna_processos_entraram_mes_individual('08', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_individual('08', date('Y'), $conexao_com_banco); ?>
			<h4>Setembro:</h4> Entraram: <?php echo retorna_processos_entraram_mes_individual('09', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_individual('09', date('Y'), $conexao_com_banco); ?>
			<h4>Outubro:</h4> Entraram: <?php echo retorna_processos_entraram_mes_individual('10', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_individual('10', date('Y'), $conexao_com_banco); ?>
			<h4>Novembro:</h4> Entraram: <?php echo retorna_processos_entraram_mes_individual('11', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_individual('11', date('Y'), $conexao_com_banco); ?>
			<h4>Dezembro:</h4> Entraram: <?php echo retorna_processos_entraram_mes_individual('12', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_individual('12', date('Y'), $conexao_com_banco); ?>
		</div>
      </div>
	 <div class="col-md-6">
        <div class="grafico" id="processos-finalizacao">
			Processos que <b>entraram e saíram acumuladamente</b> por mês neste ano</b>:<br><br>
			<h4>Janeiro:</h4> Entraram: <?php echo retorna_processos_entraram_mes_acumulado('01', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_acumulado('01', date('Y'), $conexao_com_banco); ?>
			<h4>Fevereiro:</h4> Entraram: <?php echo retorna_processos_entraram_mes_acumulado('02', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_acumulado('02', date('Y'), $conexao_com_banco); ?>
			<h4>Março:</h4> Entraram: <?php echo retorna_processos_entraram_mes_acumulado('03', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_acumulado('03', date('Y'), $conexao_com_banco); ?>
			<h4>Abril:</h4> Entraram: <?php echo retorna_processos_entraram_mes_acumulado('04', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_acumulado('04', date('Y'), $conexao_com_banco); ?>
			<h4>Maio:</h4> Entraram: <?php echo retorna_processos_entraram_mes_acumulado('05', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_acumulado('05', date('Y'), $conexao_com_banco); ?>
			<h4>Junho:</h4> Entraram: <?php echo retorna_processos_entraram_mes_acumulado('06', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_acumulado('06', date('Y'), $conexao_com_banco); ?>
			<h4>Julho:</h4> Entraram: <?php echo retorna_processos_entraram_mes_acumulado('07', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_acumulado('07', date('Y'), $conexao_com_banco); ?>
			<h4>Agosto:</h4> Entraram: <?php echo retorna_processos_entraram_mes_acumulado('08', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_acumulado('08', date('Y'), $conexao_com_banco); ?>
			<h4>Setembro:</h4> Entraram: <?php echo retorna_processos_entraram_mes_acumulado('09', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_acumulado('09', date('Y'), $conexao_com_banco); ?>
			<h4>Outubro:</h4> Entraram: <?php echo retorna_processos_entraram_mes_acumulado('10', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_acumulado('10', date('Y'), $conexao_com_banco); ?>
			<h4>Novembro:</h4> Entraram: <?php echo retorna_processos_entraram_mes_acumulado('11', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_acumulado('11', date('Y'), $conexao_com_banco); ?>
			<h4>Dezembro:</h4> Entraram: <?php echo retorna_processos_entraram_mes_acumulado('12', date('Y'), $conexao_com_banco); ?> . Saíram: <?php echo retorna_processos_sairam_mes_acumulado('12', date('Y'), $conexao_com_banco); ?>
		</div>
      </div>
	</div> 	
  </div>
<?php } ?>

<?php if($_SESSION['permissao-visualizar-relatorio-orgao']=='sim' or $_SESSION['permissao-visualizar-relatorio-setor']=='sim'){ ?>
	<div class="container caixa-conteudo">
		<?php $lista = retorna_servidores_relatorio_pessoa($conexao_com_banco);
			while($r = mysqli_fetch_object($lista)){ ?>
				<div class="row linha-grafico">
					
					<div class="grafico2" id="processos-ativos" >
						<div class="col-md-5">
							<center>
								<div class='box-servidor2'>
									<img src='../registros/fotos/<?php echo $r->NM_ARQUIVO_FOTO ?>' class='servidor-img2'></img>
								</div>
								<div style="margin-top:10px;"><b><?php echo $r->NM_SERVIDOR . " " . $r->SNM_SERVIDOR ?></b></div>
							</center>
						</div>	
						<div class="col-md-7">	
								
								<!-- Número total de processos que estão com o servidor -->
								<h5>
									Está com: 
										<a href="processos/todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?>">
											<?php $total = retorna_numero_processos_com_servidor($r->CD_SERVIDOR,$conexao_com_banco); 
											echo $total; 
											?>
										</a> 
									processo(s).
								</h5>
								
								<hr>
								<!-- Número de processos em andamento que estão com o servidor -->
								<!-- Está com: -->
								<a href="processos/todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?> Em andamento">
									<b>
										<?php 
											$numero_total = retorna_numero_processos_com_servidor_status($r->CD_SERVIDOR,"Em andamento",$conexao_com_banco); 
											if($total!=0){
												$porcentagem = ($numero_total/$total)*100;
												$porcentagem = number_format($porcentagem, 1);
												echo $numero_total . " (" . $porcentagem . "%)";
											}else{
												echo $numero_total;
											} 
										?>
									</b>
								</a> 
								processo(s) em andamento.
								
								<br>
								
								<!-- Número de processos atrasados que estão com o servidor -->
								<!-- Está com: -->
								<a href="processos/todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?> Atrasado">
									<b>
										<?php 
											$numero_total = retorna_numero_processos_com_servidor_status($r->CD_SERVIDOR,"Atrasado",$conexao_com_banco); 
											if($total!=0){
												$porcentagem = ($numero_total/$total)*100;
												$porcentagem = number_format($porcentagem, 1);
												echo $numero_total . " (" . $porcentagem . "%)";
											}else{
												echo $numero_total;
											} 
										?>
									</b>
								</a> 
								processo(s) atrasados.
								
								<br>
								
								<!-- Número de processos finalizados pelo setor que estão com o servidor -->
								<!-- Está com: -->
								<a href="processos/todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?> Finalizado pelo setor">
									<b>
										<?php 
											$numero_total = retorna_numero_processos_com_servidor_status($r->CD_SERVIDOR,"Finalizado pelo setor",$conexao_com_banco); 
											if($total!=0){
												$porcentagem = ($numero_total/$total)*100;
												$porcentagem = number_format($porcentagem, 1);
												echo $numero_total . " (" . $porcentagem . "%)";
											}else{
												echo $numero_total;
											} 
										?>
									</b>
								</a> 
								processo(s) finalizados pelo setor.
								
								<br>
								
								<!-- Número de processos finalizados pelo gabinete que estão com o servidor -->
								<!-- Está com: -->
								<a href="processos/todos.php?filtro=<?php echo $r -> NM_SERVIDOR ?> Finalizado pelo gabinete">
									<b>
										<?php 
											$numero_total = retorna_numero_processos_com_servidor_status($r->CD_SERVIDOR,"Finalizado pelo gabinete",$conexao_com_banco); 
											if($total!=0){
												$porcentagem = ($numero_total/$total)*100;
												$porcentagem = number_format($porcentagem, 1);
												echo $numero_total . " (" . $porcentagem . "%)";
											}else{
												echo $numero_total;
											} 
										?>
									</b>
								</a> 
								processo(s) finalizados pelo gabinete.
						</div>
					</div>
				</div>
		<?php } ?>
	</div>
<?php } ?> 
  
  
  
  
</div>
