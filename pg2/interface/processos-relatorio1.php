<?php 
include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php');
?>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
    <div class="container menu-home">
    <div class="btn-group" role="group" aria-label="...">
              <a href="processos-relatorio1.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">Visão Geral</button></a>
              <a href="processos-relatorio3.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">Por Pessoa</button></a>
             
              <!-- <a href="home3.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">SUPAD</button></a> -->
     </div>
  </div>
  

  <div class="container caixa-conteudo">
    <div class="row">
      <div class="col-md-12" style="margin-left: 20px;">
        Total de processos (ativos, arquivados e saíram): <b><?php $numero_total = retorna_numero_processos($conexao_com_banco); 
		echo $numero_total ?></b>
      </div>
    </div>
    <div class="row linha-grafico">
      <div class="col-md-6">
        <div class="grafico" id="processos-ativos" >
		Processos <b>ativos</b> no órgão: <?php echo retorna_numero_processos_status('Ativo',$conexao_com_banco) ?> <br><br>
		Por setor:<br><br>
			<?php 
			$lista = retorna_setores($conexao_com_banco);
			while($r = mysqli_fetch_object($lista)){
				echo $r->NM_SETOR. "</b>: ". retorna_numero_processos_setor($r->CD_SETOR,$conexao_com_banco) . "<br>"; 
			} 
			?>
		</div>
      </div>
      <div class="col-md-6">
        <div class="grafico" id="processos-analise">
		Processos <b>sem prazo</b> no órgão: <?php echo retorna_numero_processos_situacao('Aberto',$conexao_com_banco) ?> <br><br>
		Por setor: <br><br>
			<?php 
			$lista = retorna_setores($conexao_com_banco);
			while($r = mysqli_fetch_object($lista)){
				echo $r->NM_SETOR. "</b>: ". retorna_numero_processos_setor_situacao($r->CD_SETOR, 'Aberto',$conexao_com_banco) . "<br>"; 
			} 
			?>
		</div>
      </div>
    </div>  
    <div class="row linha-grafico">
      <div class="col-md-6">
        <div class="grafico" id="processos-finalizacao">
		Processos com <b>análise no prazo</b> no órgão: <?php echo retorna_numero_processos_situacao('Análise em andamento',$conexao_com_banco) ?><br><br>
		Por setor: <br><br>
			<?php 
			$lista = retorna_setores($conexao_com_banco);
			while($r = mysqli_fetch_object($lista)){
				echo $r->NM_SETOR. "</b>: ". retorna_numero_processos_setor_situacao($r->CD_SETOR, 'Análise em andamento', $conexao_com_banco) . "<br>"; 
			} 
			?>
		</div>
      </div>
	  <div class="col-md-6">
        <div class="grafico" id="processos-arquivados-e-saiu">
		Processos com <b>análise em atraso</b> no órgão: <?php echo retorna_numero_processos_situacao('Análise em atraso',$conexao_com_banco) ?><br><br>
		Por setor: <br><br>
			<?php 
			$lista = retorna_setores($conexao_com_banco);
			while($r = mysqli_fetch_object($lista)){
				echo $r->NM_SETOR. "</b>: ". retorna_numero_processos_setor_situacao($r->CD_SETOR, 'Análise em atraso', $conexao_com_banco) . "<br>"; 
			} 
			?>
		</div>
      </div>
	</div>
    <div class="row linha-grafico">
      <div class="col-md-6">
        <div class="grafico" id="processos-finalizacao">
		Processos com <b>Finalização no prazo</b> no órgão: <?php echo retorna_numero_processos_situacao_final('Finalização em andamento',$conexao_com_banco) ?><br><br>
		Por setor: <br><br>
			<?php 
			$lista = retorna_setores($conexao_com_banco);
			while($r = mysqli_fetch_object($lista)){
				echo $r->NM_SETOR. "</b>: ". retorna_numero_processos_setor_situacao_final($r->CD_SETOR, 'Finalização em andamento', $conexao_com_banco) . "<br>"; 
			} 
			?>
		</div>
      </div>
	  <div class="col-md-6">
        <div class="grafico" id="processos-arquivados-e-saiu">
		Processos com <b>Finalização em atraso</b> no órgão: <?php echo retorna_numero_processos_situacao_final('Finalização em atraso',$conexao_com_banco) ?><br><br>
		Por setor: <br><br>
			<?php 
			$lista = retorna_setores($conexao_com_banco);
			while($r = mysqli_fetch_object($lista)){
				echo $r->NM_SETOR. "</b>: ". retorna_numero_processos_setor_situacao_final($r->CD_SETOR, 'Finalização em atraso', $conexao_com_banco) . "<br>"; 
			} 
			?>
		</div>
      </div>
	</div>  
	<div class="row linha-grafico">
      <div class="col-md-6">
        <div class="grafico" id="processos-finalizacao">
		Processos que <b>foram arquivados</b>:<br><br>
			<?php 
				echo "<h1 class='grafico-numero'>". retorna_numero_processos_status('Arquivado', $conexao_com_banco) . "</h1>"; 
			?>
		</div>
      </div>
	  <div class="col-md-6">
        <div class="grafico" id="processos-arquivados-e-saiu">
		Processos que <b>saíram do órgão</b>:<br><br>
			<?php 
				echo "<h1 class='grafico-numero'>". retorna_numero_processos_status('Saiu', $conexao_com_banco) . "</h1>"; 
			?>
		</div>
      </div>
	</div> 
	<div class="row linha-grafico">
      <div class="col-md-6">
        <div class="grafico" id="processos-finalizacao">
			Processos que <b>entraram e saíram indivualmente</b> no mês atual neste ano</b>:<br><br>
			Entraram: <?php echo retorna_processos_entraram_mes_individual(date('m'), date('Y'), $conexao_com_banco); ?> .<br> Saíram: <?php echo retorna_processos_sairam_mes_individual(date('m'), date('Y'), $conexao_com_banco); ?>
		</div>
      </div>
	 <div class="col-md-6">
        <div class="grafico" id="processos-finalizacao">
			Processos que <b>entraram e saíram acumuladamente</b> no mês atual neste ano</b>:<br><br>
			Entraram: <?php echo retorna_processos_entraram_mes_acumulado(date('m'), date('Y'), $conexao_com_banco); ?> .<br> Saíram: <?php echo retorna_processos_sairam_mes_acumulado(date('m'), date('Y'), $conexao_com_banco); ?>
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
