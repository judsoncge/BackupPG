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
     
      google.charts.setOnLoadCallback(processosProtocolo);
      google.charts.setOnLoadCallback(processosGabinete);
      google.charts.setOnLoadCallback(processosSUPSUPAD);
      google.charts.setOnLoadCallback(processosSUPAD);
      google.charts.setOnLoadCallback(processosSUPSUCOF);
      google.charts.setOnLoadCallback(processosSUCOF);
      google.charts.setOnLoadCallback(processosSUPSUCOR);
      google.charts.setOnLoadCallback(processosSUCOR);
      google.charts.setOnLoadCallback(processosADM);
      google.charts.setOnLoadCallback(processosAGT);
      google.charts.setOnLoadCallback(processosTI);
      google.charts.setOnLoadCallback(processosarquivadosEsaiu);


      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      


      function processosProtocolo() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'link', 'Número'],
          ['Abertos', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Aberto Protocolo', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "PRO", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Finalização concluída no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Finalizado Protocolo', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "PRO", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Finalização concluída em atraso', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Finalizado com atraso Protocolo', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "PRO", "Análise em atraso", $conexao_com_banco); echo $numero_total ?>]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 2]);

        var options = {
          title: 'Processos no setor PROTOCOLO: <?php $numero_total = retorna_numero_processos_status(date('Y'), "PRO" , $conexao_com_banco) ; echo $numero_total ?>',
          colors: ['#3498db','#2ecc71','#e74c3c'], pieSliceText: 'value'
        };

        var chart = new google.visualization.PieChart( 
          document.getElementById('processos-protocolo'));
        chart.draw(view, options);

        var selectHandler = function(e) {
         window.location = data.getValue(chart.getSelection()[0]['row'], 1 );
        }

        // Add our selection handler.
        google.visualization.events.addListener(chart, 'select', selectHandler);
      }


      function processosGabinete() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'link', 'Número'],
          ['Abertos', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Aberto Gabinete', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "GAB", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Finalização no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Em andamento Gabinete', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "GAB", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Finalização em atraso', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Finalizado com atraso Gabinete', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "GAB", "Finalização em atraso", $conexao_com_banco); echo $numero_total ?>],
          ['Finalização concluída no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Finalizado com atraso Gabinete', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "GAB", "Finalizado", $conexao_com_banco); echo $numero_total ?>],
          ['Finalização concluída em atraso', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Finalizado com atraso Gabinete', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "GAB", "Finalizado com atraso", $conexao_com_banco); echo $numero_total ?>]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 2]);

        var options = {
          title: 'Processos no setor GABINETE: <?php $numero_total = retorna_numero_processos_status(date('Y'), "GAB" , $conexao_com_banco) ; echo $numero_total ?>',
          colors: ['#3498db','#2ecc71','#e74c3c','#2c3e50', '#d35400'], pieSliceText: 'value'
        };

        var chart = new google.visualization.PieChart( 
          document.getElementById('processos-gabinete'));
        chart.draw(view, options);

        var selectHandler = function(e) {
         window.location = data.getValue(chart.getSelection()[0]['row'], 1 );
        }

        // Add our selection handler.
        google.visualization.events.addListener(chart, 'select', selectHandler);
      }
	  
	  function processosSUPSUPAD() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'link', 'Número'],
          ['Abertos', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Aberto Superintendência SUPAD', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUPAD", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Análise no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Em andamento Superintendência SUPAD', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUPAD", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Análise em atraso', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Análise em atraso Superintendência SUPAD', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUPAD", "Análise em atraso", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Concluído Superintendência SUPAD',<?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUPAD", "Concluído", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída com atraso',  'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Concluído com atraso Superintendência SUPAD', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUPAD", "Concluído com atraso", $conexao_com_banco); echo $numero_total ?>]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 2]);

        var options = {
          title: 'Processos no setor Superintendência SUPAD: <?php $numero_total = retorna_numero_processos_status(date('Y'),"SUP-SUPAD", $conexao_com_banco) ; echo $numero_total ?>',
          colors: ['#3498db','#2ecc71','#e74c3c','#2c3e50', '#d35400'], pieSliceText: 'value'
        };

        var chart = new google.visualization.PieChart( 
          document.getElementById('processos-sup-supad'));
        chart.draw(view, options);

        var selectHandler = function(e) {
         window.location = data.getValue(chart.getSelection()[0]['row'], 1 );
        }

        // Add our selection handler.
        google.visualization.events.addListener(chart, 'select', selectHandler);
      }


      function processosSUPAD() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'link', 'Número'],
          ['Abertos', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Aberto SUPAD', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUPAD", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Análise no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Em andamento SUPAD', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUPAD", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Análise em atraso', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Análise em atraso SUPAD', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUPAD", "Análise em atraso", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Concluído SUPAD',<?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUPAD", "Concluído", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída com atraso',  'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Concluído com atraso SUPAD', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUPAD", "Concluído com atraso", $conexao_com_banco); echo $numero_total ?>]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 2]);

        var options = {
          title: 'Processos no setor SUPAD: <?php $numero_total = retorna_numero_processos_status(date('Y'),"SUPAD", $conexao_com_banco) ; echo $numero_total ?>',
          colors: ['#3498db','#2ecc71','#e74c3c','#2c3e50', '#d35400'], pieSliceText: 'value'
        };

        var chart = new google.visualization.PieChart( 
          document.getElementById('processos-supad'));
        chart.draw(view, options);

        var selectHandler = function(e) {
         window.location = data.getValue(chart.getSelection()[0]['row'], 1 );
        }

        // Add our selection handler.
        google.visualization.events.addListener(chart, 'select', selectHandler);
      }
	  
	  function processosSUPSUCOF() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'link', 'Número'],
          ['Abertos', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Aberto Superintendência SUCOF', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOF", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Análise no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Em andamento Superintendência SUCOF', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOF", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Análise em atraso', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Análise em atraso Superintendência SUCOF', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOF", "Análise em atraso", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Concluído Superintendência SUCOF',<?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOF", "Concluído", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída com atraso',  'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Concluído com atraso Superintendência SUCOF', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOF", "Concluído com atraso", $conexao_com_banco); echo $numero_total ?>]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 2]);

        var options = {
          title: 'Processos no setor Superintendência SUCOF: <?php $numero_total = retorna_numero_processos_status(date('Y'),"SUP-SUCOF", $conexao_com_banco) ; echo $numero_total ?>',
          colors: ['#3498db','#2ecc71','#e74c3c','#2c3e50', '#d35400'], pieSliceText: 'value'
        };

        var chart = new google.visualization.PieChart( 
          document.getElementById('processos-sup-sucof'));
        chart.draw(view, options);

        var selectHandler = function(e) {
         window.location = data.getValue(chart.getSelection()[0]['row'], 1 );
        }

        // Add our selection handler.
        google.visualization.events.addListener(chart, 'select', selectHandler);
      }

      function processosSUCOF() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'link', 'Número'],
          ['Abertos', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Aberto SUCOF', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUCOF", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Análise no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Em andamento SUCOF', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUCOF", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Análise em atraso', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Análise em atraso SUCOF', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUCOF", "Análise em atraso", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Concluído SUCOF',<?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUCOF", "Concluído", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída com atraso',  'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Concluído com atraso SUCOF', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUCOF", "Concluído com atraso", $conexao_com_banco); echo $numero_total ?>]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 2]);

        var options = {
          title: 'Processos no setor SUCOF: <?php $numero_total = retorna_numero_processos_status(date('Y'),"SUCOF", $conexao_com_banco) ; echo $numero_total ?>',
          colors: ['#3498db','#2ecc71','#e74c3c','#2c3e50', '#d35400'], pieSliceText: 'value'
        };

        var chart = new google.visualization.PieChart( 
          document.getElementById('processos-sucof'));
        chart.draw(view, options);

        var selectHandler = function(e) {
         window.location = data.getValue(chart.getSelection()[0]['row'], 1 );
        }

        // Add our selection handler.
        google.visualization.events.addListener(chart, 'select', selectHandler);
      }
	  
	  function processosSUPSUCOR() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'link', 'Número'],
          ['Abertos', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Aberto Superintendência SUCOR', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOR", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Análise no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Em andamento Superintendência SUCOR', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOR", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Análise em atraso', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Análise em atraso Superintendência SUCOR', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOR", "Análise em atraso", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Concluído Superintendência SUCOR',<?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOR", "Concluído", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída com atraso',  'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Concluído com atraso Superintendência SUCOR', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOR", "Concluído com atraso", $conexao_com_banco); echo $numero_total ?>]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 2]);

        var options = {
          title: 'Processos no setor Superintendência SUCOR: <?php $numero_total = retorna_numero_processos_status(date('Y'),"SUP-SUCOR", $conexao_com_banco) ; echo $numero_total ?>',
          colors: ['#3498db','#2ecc71','#e74c3c','#2c3e50', '#d35400'], pieSliceText: 'value'
        };

        var chart = new google.visualization.PieChart( 
          document.getElementById('processos-sup-sucor'));
        chart.draw(view, options);

        var selectHandler = function(e) {
         window.location = data.getValue(chart.getSelection()[0]['row'], 1 );
        }

        // Add our selection handler.
        google.visualization.events.addListener(chart, 'select', selectHandler);
      }


      function processosSUCOR() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'link', 'Número'],
          ['Abertos', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Aberto SUCOR', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUCOR", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Análise no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Em andamento SUCOR', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUCOR", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Análise em atraso', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Análise em atraso SUCOR', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUCOR", "Análise em atraso", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Concluído SUCOR',<?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUCOR", "Concluído", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída com atraso',  'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Concluído com atraso SUCOR', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUCOR", "Concluído com atraso", $conexao_com_banco); echo $numero_total ?>]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 2]);

        var options = {
          title: 'Processos no setor SUCOR: <?php $numero_total = retorna_numero_processos_status(date('Y'),"SUCOR", $conexao_com_banco) ; echo $numero_total ?>',
          colors: ['#3498db','#2ecc71','#e74c3c','#2c3e50', '#d35400'], pieSliceText: 'value'
        };

        var chart = new google.visualization.PieChart( 
          document.getElementById('processos-sucor'));
        chart.draw(view, options);

        var selectHandler = function(e) {
         window.location = data.getValue(chart.getSelection()[0]['row'], 1 );
        }

        // Add our selection handler.
        google.visualization.events.addListener(chart, 'select', selectHandler);
      }

      function processosADM() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'link', 'Número'],
          ['Abertos', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Aberto Administrativo', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "ADM", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Análise no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Em andamento Administrativo', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "ADM", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Análise em atraso', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Análise em atraso Administrativo', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "ADM", "Análise em atraso", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Concluído Administrativo',<?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "ADM", "Concluído", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída com atraso',  'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Concluído com atraso Administrativo', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "ADM", "Concluído com atraso", $conexao_com_banco); echo $numero_total ?>]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 2]);

        var options = {
          title: 'Processos no setor Administrativo: <?php $numero_total = retorna_numero_processos_status(date('Y'),"ADM", $conexao_com_banco) ; echo $numero_total ?>',
          colors: ['#3498db','#2ecc71','#e74c3c','#2c3e50', '#d35400'], pieSliceText: 'value'
        };

        var chart = new google.visualization.PieChart( 
          document.getElementById('processos-adm'));
        chart.draw(view, options);

        var selectHandler = function(e) {
         window.location = data.getValue(chart.getSelection()[0]['row'], 1 );
        }

        // Add our selection handler.
        google.visualization.events.addListener(chart, 'select', selectHandler);
      }

      
	  /*não funciona essa função*/
	  function processosarquivadosEsaiu() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'link', 'Número'],
          ['Arquivados', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Arquivado', <?php $numero_total = retorna_numero_processos_status(date('Y'),"Arquivado", $conexao_com_banco); echo $numero_total ?>],
          ['Saíram', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Saiu', <?php $numero_total = retorna_numero_processos_status(date('Y'),"Saiu", $conexao_com_banco); echo $numero_total ?>]
          
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 2]);

        var options = {
          title: 'No Arquivo e fora do órgão: <?php $numero_total = retorna_numero_processos_inativos(date('Y'),$conexao_com_banco); echo $numero_total ?>',
          colors: ['#f1c40f','#d35400'], pieSliceText: 'value'
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

    </script>

	
    
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">

	<div class="container menu-home">
		<div class="btn-group" role="group" aria-label="...">
              <a href="processos-relatorio1.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">Visão Geral</button></a>
              <a href="processos-relatorio2.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">Por Setor</button></a>
              <a href="processos-relatorio3.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">Por Servidor</button></a>
              <!-- <a href="home3.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">SUPAD</button></a> -->
	   </div>
	</div>

	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-md-12" style="margin-left: 20px;">
				Total de processos na CGE em 2016: <b><?php $numero_total = retorna_numero_processos(date('Y'),$conexao_com_banco); echo $numero_total ?></b>
			</div>
		</div>
		<div class="row  linha-grafico">
			<div class="col-md-6">
				<div class="grafico" id="processos-protocolo" ></div>
			</div>
			<div class="col-md-6">
				<div class="grafico" id="processos-gabinete"></div>
			</div>
		</div>
		<div class="row  linha-grafico">
		  <div class="col-md-6">
			   <div class="grafico" id="processos-sup-supad" ></div>
		  </div>
		  <div class="col-md-6">
			   <div class="grafico" id="processos-supad" ></div>
		  </div>
		</div>
		<div class="row  linha-grafico">
		  <div class="col-md-6">
			   <div class="grafico" id="processos-sup-sucof" ></div>
		  </div>
		  <div class="col-md-6">
			   <div class="grafico" id="processos-sucof" ></div>
		  </div>
		</div>
		<div class="row  linha-grafico">
		  <div class="col-md-6">
			   <div class="grafico" id="processos-sup-sucor" ></div>
		  </div>
		  <div class="col-md-6">
			   <div class="grafico" id="processos-sucor" ></div>
		  </div>
		</div>
		<div class="row  linha-grafico">
		  <div class="col-md-6">
			   <div class="grafico" id="processos-adm" ></div>
		  </div>
		  <div class="col-md-6">
        <div class="grafico" id="processos-arquivados-e-saiu" ></div>
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
