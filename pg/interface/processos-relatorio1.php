<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php')
?>
<!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
    <script type="text/javascript">
  
      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart', 'bar']});


      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(processosAtivos);
      google.charts.setOnLoadCallback(processosAnalise);
      google.charts.setOnLoadCallback(processosFinalizacao);
      google.charts.setOnLoadCallback(processosarquivadosEsaiu);
	    google.charts.setOnLoadCallback(processosPorMes);
      google.charts.setOnLoadCallback(processosPorMesIndividual);
    
      

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.


      
      function processosAtivos() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'link', 'Número'],
          ['Protocolo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Protocolo', <?php $numero_total = retorna_numero_processos_status(date('Y'), "PRO",  $conexao_com_banco); echo $numero_total ?>],
          ['Gabinete', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Gabinete', <?php $numero_total = retorna_numero_processos_status(date('Y'), "GAB",  $conexao_com_banco); echo $numero_total ?>],
          ['SUPAD', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=SUPAD', <?php $numero_total = retorna_numero_processos_status2(date('Y'), "SUPAD", "SUP-SUPAD",  $conexao_com_banco); echo $numero_total ?>],
          ['SUCOF', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=SUCOF', <?php $numero_total = retorna_numero_processos_status2(date('Y'), "SUCOF", "SUP-SUCOF",  $conexao_com_banco); echo $numero_total ?>],
          ['SUCOR', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=SUCOR', <?php $numero_total = retorna_numero_processos_status2(date('Y'), "SUCOR", "SUP-SUCOR",  $conexao_com_banco); echo $numero_total ?>],
          ['ADM', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Administrativo', <?php $numero_total = retorna_numero_processos_status(date('Y'), "ADM",  $conexao_com_banco); echo $numero_total ?>],
          ['AGT', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Assessoria de Governança e Transparência', <?php $numero_total = retorna_numero_processos_status(date('Y'), "AGT",  $conexao_com_banco); echo $numero_total ?>],
          ['TI', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Tecnologia da Informação', <?php $numero_total = retorna_numero_processos_status(date('Y'), "TI",  $conexao_com_banco); echo $numero_total ?>],
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 2]);

        var options = {
          title: 'PROCESSOS ATIVOS NO ÓRGÃO: <?php $numero_total = retorna_numero_processos_ativos(date('Y'),$conexao_com_banco); echo $numero_total ?>',
          colors: ['#3498db','#f1c40f','#16a085','#9b59b6', '#d35400', '#e67e22', '#1abc9c'], pieSliceText: 'value'
        };

        var chart = new google.visualization.PieChart( 
          document.getElementById('processos-ativos'));
        chart.draw(view, options);

        var selectHandler = function(e) {
         window.location = data.getValue(chart.getSelection()[0]['row'], 1 );
        }

        // Add our selection handler.
        google.visualization.events.addListener(chart, 'select', selectHandler);
      }


	  
	  function processosAnalise() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'link', 'Número'],
          ['Sem prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Aberto', <?php $numero_total = retorna_numero_processos_situacao(date('Y'),"Aberto", $conexao_com_banco); echo $numero_total ?>],
          ['No prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Em andamento', <?php $numero_total = retorna_numero_processos_situacao(date('Y'),"Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Em atraso', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Análise em atraso', <?php $numero_total = retorna_numero_processos_situacao(date('Y'),"Análise em atraso", $conexao_com_banco); echo $numero_total ?>]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 2]);

        var options = {
          title: 'PROCESSOS EM ANÁLISE: <?php $numero_total = retorna_numero_processos_analise(date('Y'),$conexao_com_banco); echo $numero_total ?>',
          colors: ['#95a5a6','#2ecc71','#e74c3c']
        };

        var chart = new google.visualization.PieChart( 
          document.getElementById('processos-analise'));
        chart.draw(view, options);

        var selectHandler = function(e) {
         window.location = data.getValue(chart.getSelection()[0]['row'], 1 );
        }

        // Add our selection handler.
        google.visualization.events.addListener(chart, 'select', selectHandler);
      }
    

  function processosFinalizacao() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'link', 'Número'],
          ['Sem prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Aberto', <?php $numero_total = retorna_numero_processos_situacao_final(date('Y'),"Aberto", $conexao_com_banco); echo $numero_total ?>],
          ['No prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Em andamento', <?php $numero_total = retorna_numero_processos_situacao_final(date('Y'),"Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Em atraso', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Análise em atraso', <?php $numero_total = retorna_numero_processos_situacao_final(date('Y'),"Finalização em atraso", $conexao_com_banco); echo $numero_total ?>]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 2]);

        var options = {
          title: 'PROCESSOS EM FINALIZAÇÃO: <?php $numero_total = retorna_numero_processos_finalizacao(date('Y'),$conexao_com_banco); echo $numero_total ?>',
          colors: ['#7f8c8d','#2ecc71','#e74c3c']
        };

        var chart = new google.visualization.PieChart( 
          document.getElementById('processos-finalizacao'));
        chart.draw(view, options);

        var selectHandler = function(e) {
         window.location = data.getValue(chart.getSelection()[0]['row'], 1 );
        }

        // Add our selection handler.
        google.visualization.events.addListener(chart, 'select', selectHandler);
      }
    
    
  function processosarquivadosEsaiu() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'link', 'Número'],
          ['Arquivados', 'processos-arquivados.php?sessionId=<?php echo $num ?>&filtro=Arquivado', <?php $numero_total = retorna_numero_processos_status(date('Y'),"Arquivado", $conexao_com_banco); echo $numero_total ?>],
          ['Saíram', 'processos-sairam.php?sessionId=<?php echo $num ?>&filtro=Saiu', <?php $numero_total = retorna_numero_processos_status(date('Y'),"Saiu", $conexao_com_banco); echo $numero_total ?>]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 2]);

        var options = {
          title: 'PROCESSOS ARQUIVADOS OU QUE SAÍRAM: <?php $numero_total = retorna_numero_processos_inativos(date('Y'),$conexao_com_banco); echo $numero_total ?>',
          colors: ['#f1c40f','#d35400']
        };

        var chart = new google.visualization.PieChart( 
          document.getElementById('processos-arquivados-e-saiu'));
        chart.draw(view, options);

        var selectHandler = function(e) {
         window.location = data.getValue(chart.getSelection()[0]['row'], 1 );
        }

        // Add our selection handler.
        google.visualization.events.addListener(chart, 'select', selectHandler);
      }


     function processosPorMes() {
        var data = google.visualization.arrayToDataTable([
          ['', 'Entraram', 'Resolvidos'],
          ['Janeiro', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "01", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "01", $conexao_com_banco); echo $numero_total ?>],
          ['Fevereiro', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "02", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "02", $conexao_com_banco); echo $numero_total ?>],
          ['Março', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "03", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "03", $conexao_com_banco); echo $numero_total ?>],
          ['Abril', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "04", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "04", $conexao_com_banco); echo $numero_total ?>],
          ['Maio', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "05", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "05", $conexao_com_banco); echo $numero_total ?>],
          ['Junho', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "06", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "06", $conexao_com_banco); echo $numero_total ?>],
          ['Julho', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "07", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "07", $conexao_com_banco); echo $numero_total ?>],
          ['Agosto', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "08", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "08", $conexao_com_banco); echo $numero_total ?>],
          ['Setembro', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "09", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "09", $conexao_com_banco); echo $numero_total ?>],
          ['Outubro', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "10", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "10", $conexao_com_banco); echo $numero_total ?>],
          ['Novembro', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "11", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "11", $conexao_com_banco); echo $numero_total ?>],
          ['Dezembro', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "12", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "12", $conexao_com_banco); echo $numero_total ?>],
          
        ]);

        var options = {
          chart: {
            title: 'Relação entre os processos que entraram e foram resolvidos (acumulado)',
            subtitle: 'Ano <?php echo date('Y') ?>',
          },
          bars: 'vertical',
          vAxis: {format: 'decimal'},
          colors: ['#2980b9', '#1b9e77']
        };

        var chart = new google.charts.Bar(document.getElementById('processos-por-mes'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }


    function processosPorMesIndividual() {
        var data = google.visualization.arrayToDataTable([
          ['', 'Entraram', 'Saíram ou Arquivados'],
		  ['Janeiro', <?php $numero_total = retorna_numero_processos_entraram_mes_individual(date('Y'), "01", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes_individual(date('Y'), "01", $conexao_com_banco); echo $numero_total ?>],
          ['Fevereiro', <?php $numero_total = retorna_numero_processos_entraram_mes_individual(date('Y'), "02", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes_individual(date('Y'), "02", $conexao_com_banco); echo $numero_total ?>],
          ['Março', <?php $numero_total = retorna_numero_processos_entraram_mes_individual(date('Y'), "03", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes_individual(date('Y'), "03", $conexao_com_banco); echo $numero_total ?>],
          ['Abril', <?php $numero_total = retorna_numero_processos_entraram_mes_individual(date('Y'), "04", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes_individual(date('Y'), "04", $conexao_com_banco); echo $numero_total ?>],
          ['Maio', <?php $numero_total = retorna_numero_processos_entraram_mes_individual(date('Y'), "05", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes_individual(date('Y'), "05", $conexao_com_banco); echo $numero_total ?>],
          ['Junho', <?php $numero_total = retorna_numero_processos_entraram_mes_individual(date('Y'), "06", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes_individual(date('Y'), "06", $conexao_com_banco); echo $numero_total ?>],
          ['Julho', <?php $numero_total = retorna_numero_processos_entraram_mes_individual(date('Y'), "07", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes_individual(date('Y'), "07", $conexao_com_banco); echo $numero_total ?>],
          ['Agosto', <?php $numero_total = retorna_numero_processos_entraram_mes_individual(date('Y'), "08", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes_individual(date('Y'), "08", $conexao_com_banco); echo $numero_total ?>],
          ['Setembro', <?php $numero_total = retorna_numero_processos_entraram_mes_individual(date('Y'), "09", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes_individual(date('Y'), "09", $conexao_com_banco); echo $numero_total ?>],
          ['Outubro', <?php $numero_total = retorna_numero_processos_entraram_mes_individual(date('Y'), "10", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes_individual(date('Y'), "10", $conexao_com_banco); echo $numero_total ?>],
          ['Novembro', <?php $numero_total = retorna_numero_processos_entraram_mes_individual(date('Y'), "11", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes_individual(date('Y'), "11", $conexao_com_banco); echo $numero_total ?>],
          ['Dezembro', <?php $numero_total = retorna_numero_processos_entraram_mes_individual(date('Y'), "12", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes_individual(date('Y'), "12", $conexao_com_banco); echo $numero_total ?>],
          
        ]);

        var options = {
          chart: {
            title: 'Relação entre os processos que entraram e foram resolvidos (entraram e saíram no mesmo mês)',
            subtitle: 'Ano <?php echo date('Y') ?>',
          },
          bars: 'vertical',
          vAxis: {format: 'decimal'},
          colors: ['#2980b9', '#1b9e77']
        };

        var chart = new google.charts.Bar(document.getElementById('processos-por-mes-individual'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

    </script>

  
    
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
    <div class="container menu-home">
    <div class="btn-group" role="group" aria-label="...">
              <a href="processos-relatorio1.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">Visão Geral</button></a>
              <a href="processos-relatorio2.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">Por Setor</button></a>
              <a href="processos-relatorio3.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">Por Pessoa</button></a>
              <a href="processos-relatorio-geral.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">Relatório Executivo</button></a>
              <!-- <a href="home3.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">SUPAD</button></a> -->
     </div>
  </div>
  

  <div class="container caixa-conteudo">
    <div class="row">
      <div class="col-md-12" style="margin-left: 20px;">
        Total de processos (ativos e inativos): <b><?php $numero_total = retorna_numero_processos(date('Y'),$conexao_com_banco); echo $numero_total ?></b>
      </div>
    </div>
    <div class="row linha-grafico">
      <div class="col-md-6">
        <div class="grafico" id="processos-ativos" ></div>
      </div>
      <div class="col-md-6">
        <div class="grafico" id="processos-analise"></div>
      </div>
    </div>  
    <div class="row linha-grafico">
      <div class="col-md-6">
        <div class="grafico" id="processos-finalizacao"></div>
      </div>
	  <div class="col-md-6">
        <div class="grafico" id="processos-arquivados-e-saiu"></div>
      </div>
	</div>
          
    <div class="row linha-grafico">
      <div class="col-md-12">
        <div class='grafico' id="processos-por-mes"></div>
      </div>
    </div>
    <div class="row linha-grafico">
      <div class="col-md-12">
        <div class='grafico' id="processos-por-mes-individual"></div>
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
