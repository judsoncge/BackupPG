<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php')
?>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(processosSUPSUCOF);
      google.charts.setOnLoadCallback(processosProtocolo);
      
      function processosSUPSUCOF() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'link', 'Número'],
          ['Abertos', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Aberto SUP-SUCOF', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOF", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Análise no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Em andamento SUP-SUCOF', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOF", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Análise em atraso', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Análise em atraso SUP-SUCOF', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOF", "Análise em atraso", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Concluído SUP-SUCOF',<?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOF", "Concluído", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída com atraso',  'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Concluído com atraso SUP-SUCOF', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOF", "Concluído com atraso", $conexao_com_banco); echo $numero_total ?>]
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


      function processosProtocolo() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'link', 'Número'],
          ['Abertos', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Aberto PRO', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "PRO", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Finalização concluída no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Finalizado PRO', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "PRO", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Finalização concluída em atraso', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Finalizado com atraso PRO', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "PRO", "Análise em atraso", $conexao_com_banco); echo $numero_total ?>]
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
          ['Abertos', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Aberto SUP-SUCOR', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOR", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Análise no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Em andamento SUP-SUCOR', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOR", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Análise em atraso', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Análise em atraso SUP-SUCOR', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOR", "Análise em atraso", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Concluído SUP-SUCOR',<?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOR", "Concluído", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída com atraso',  'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Concluído com atraso SUP-SUCOR', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOR", "Concluído com atraso", $conexao_com_banco); echo $numero_total ?>]
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
          ['Abertos', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Aberto Administrativo', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "Administrativo", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Análise no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Em andamento Administrativo', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "Administrativo", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Análise em atraso', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Análise em atraso Administrativo', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "Administrativo", "Análise em atraso", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída no prazo', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Concluído Administrativo',<?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "Administrativo", "Concluído", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída com atraso',  'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Concluído com atraso Administrativo', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "Administrativo", "Concluído com atraso", $conexao_com_banco); echo $numero_total ?>]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 2]);

        var options = {
          title: 'Processos no setor Administrativo: <?php $numero_total = retorna_numero_processos_status(date('Y'),"Administrativo", $conexao_com_banco) ; echo $numero_total ?>',
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
          title: 'title':'PROCESSOS ATIVOS NO ÓRGÃO: <?php $numero_total = retorna_numero_processos_ativos(date('Y'),$conexao_com_banco); echo $numero_total ?>',
          /*colors: ['#3498db','#2ecc71','#e74c3c','#2c3e50', '#d35400'], pieSliceText: 'value'*/
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
          colors: ['#7f8c8d','#2ecc71','#e74c3c']
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
          ['Arquivados', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Arquivado', <?php $numero_total = retorna_numero_processos_status(date('Y'),"Arquivado", $conexao_com_banco); echo $numero_total ?>],
          ['Saíram', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Saiu', <?php $numero_total = retorna_numero_processos_status(date('Y'),"Saiu", $conexao_com_banco); echo $numero_total ?>]
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
          ['Mes', 'link', 'Entraram', 'Resolvidos'],
          ['Janeiro', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Janeiro', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "01", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "01", $conexao_com_banco); echo $numero_total ?>],
          ['Fevereiro', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Fevereiro', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "02", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "02", $conexao_com_banco); echo $numero_total ?>],
          ['Março', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Março', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "03", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "03", $conexao_com_banco); echo $numero_total ?>],
          ['Abril', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Abril', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "04", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "04", $conexao_com_banco); echo $numero_total ?>],
          ['Maio', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Maio', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "05", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "05", $conexao_com_banco); echo $numero_total ?>],
          ['Junho', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Junho', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "06", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "06", $conexao_com_banco); echo $numero_total ?>],
          ['Julho', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Julho', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "07", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "07", $conexao_com_banco); echo $numero_total ?>],
          ['Agosto', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Agosto', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "08", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "08", $conexao_com_banco); echo $numero_total ?>],
          ['Setembro', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Setembro', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "09", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "09", $conexao_com_banco); echo $numero_total ?>],
          ['Outubro', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Outubro', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "10", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "10", $conexao_com_banco); echo $numero_total ?>],
          ['Novembro', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Novembro', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "11", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "11", $conexao_com_banco); echo $numero_total ?>],
          ['Dezembro', 'processos-todos.php?sessionId=<?php echo $num ?>&filtro=Dezembro', <?php $numero_total = retorna_numero_processos_entraram_mes(date('Y'), "12", $conexao_com_banco); echo $numero_total ?>, <?php $numero_total = retorna_numero_processos_resolvidos_mes(date('Y'), "12", $conexao_com_banco); echo $numero_total ?>]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 2, 3]);

        var options = {
          chart: {
            title: 'Relação entre os processos que entraram e foram resolvidos (acumulado)',
            subtitle: 'Ano <?php echo date('Y') ?>',
            colors: ['#f1c40f','#d35400']
          },
          bars: 'vertical',
          vAxis: {format: 'decimal'},
          colors: ['#2980b9', '#1b9e77']
        };

        var chart = new google.charts.Bar(document.getElementById('processos-por-mes'));
        chart.draw(view, options);

        var selectHandler = function(e) {
         window.location = data.getValue(chart.getSelection()[0]['row'], 1);
        }

        // Add our selection handler.
        google.visualization.events.addListener(chart, 'select', selectHandler);
      }



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
  </head>
  <body>
    <div id="processos-sup-sucof" style="width: 900px; height: 900px;"></div>
    <div id="processos-protocolo" style="width: 900px; height: 900px;"></div>
  </body>
</html>



function processosSUPSUCOF() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Setor');
        data.addColumn('number', 'Número');
        data.addRows([
          ['Abertos', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOF", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Análise no prazo',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOF", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Análise em atraso',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOF", "Análise em atraso", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída no prazo',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOF", "Concluído", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída com atraso',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOF", "Concluído com atraso", $conexao_com_banco); echo $numero_total ?>],
      ]);

        // Set chart options
        var options = {'title':'Processos no setor Superintendência SUCOF: <?php $numero_total = retorna_numero_processos_status(date('Y'),"SUP-SUCOF" ,
    $conexao_com_banco) ; echo $numero_total ?>', /*'width':500, 'height':300*/ colors: ['#3498db','#2ecc71','#e74c3c','#2c3e50', '#d35400'], pieSliceText: 'value'};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('processos-sup-sucof'));
        chart.draw(data, options);
      }



function processosSUPSUPAD() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Setor');
        data.addColumn('number', 'Número');
        data.addRows([
    ['Abertos', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUPAD", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Análise no prazo',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUPAD", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Análise em atraso',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUPAD", "Análise em atraso", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída no prazo',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUPAD", "Concluído", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída com atraso',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUPAD", "Concluído com atraso", $conexao_com_banco); echo $numero_total ?>],
      ]);

        // Set chart options
        var options = {'title':'Processos setor Superintendência SUPAD: <?php $numero_total = retorna_numero_processos_status(date('Y'), "SUP-SUPAD" , 
    $conexao_com_banco) ; echo $numero_total ?>', /*'width':500, 'height':300*/ colors: ['#3498db','#2ecc71','#e74c3c','#2c3e50', '#d35400'], pieSliceText: 'value'};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('processos-sup-supad'));
        chart.draw(data, options);
      }




      function processosSUPAD() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Setor');
        data.addColumn('number', 'Número');
        data.addRows([
    ['Abertos', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUPAD", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Análise no prazo',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUPAD", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Análise em atraso',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUPAD", "Análise em atraso", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída no prazo',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUPAD", "Concluído", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída com atraso',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUPAD", "Concluído com atraso", $conexao_com_banco); echo $numero_total ?>],
      ]);

        // Set chart options
        var options = {'title':'Processos setor SUPAD: <?php $numero_total = retorna_numero_processos_status(date('Y'), "SUPAD", $conexao_com_banco) ; 
    echo $numero_total ?>', /*'width':500, 'height':300*/ colors: ['#3498db','#2ecc71','#e74c3c','#2c3e50', '#d35400'], pieSliceText: 'value'};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('processos-supad'));
        chart.draw(data, options);
      }



      function processosSUCOF() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Setor');
        data.addColumn('number', 'Número');
        data.addRows([
    ['Abertos', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUCOF", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Análise no prazo',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUCOF", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Análise em atraso',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUCOF", "Análise em atraso", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída no prazo',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUCOF", "Concluído", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída com atraso',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUCOF", "Concluído com atraso", $conexao_com_banco); echo $numero_total ?>],
      ]);

        // Set chart options
        var options = {'title':'Processos no setor SUCOF: <?php $numero_total = retorna_numero_processos_status(date('Y'), "SUCOF", $conexao_com_banco) ;
    echo $numero_total ?>', /*'width':500, 'height':300*/ colors: ['#3498db','#2ecc71','#e74c3c','#2c3e50', '#d35400'], pieSliceText: 'value'};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('processos-sucof'));
        chart.draw(data, options);
      }



      function processosSUPSUCOR() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Setor');
        data.addColumn('number', 'Número');
        data.addRows([
    ['Abertos', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOR", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Análise no prazo',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOR", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Análise em atraso',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOR", "Análise em atraso", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída no prazo',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOR", "Concluído", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída com atraso',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUP-SUCOR", "Concluído com atraso", $conexao_com_banco); echo $numero_total ?>],
      ]);

        // Set chart options
        var options = {'title':'Processos no setor Superintendência SUCOR: <?php $numero_total = retorna_numero_processos_status(date('Y'), "SUP-SUCOR" ,
    $conexao_com_banco) ; echo $numero_total ?>', /*'width':500, 'height':300*/ colors: ['#3498db','#2ecc71','#e74c3c','#2c3e50', '#d35400'], pieSliceText: 'value'};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('processos-sup-sucor'));
        chart.draw(data, options);
      }


      function processosSUCOR() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Setor');
        data.addColumn('number', 'Número');
        data.addRows([
    ['Abertos', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUCOR", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Análise no prazo',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUCOR", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Análise em atraso',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUCOR", "Análise em atraso", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída no prazo',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUCOR", "Concluído", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída com atraso',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "SUCOR", "Concluído com atraso", $conexao_com_banco); echo $numero_total ?>],
      ]);

        // Set chart options
        var options = {'title':'Processos no setor SUCOR: <?php $numero_total = retorna_numero_processos_status(date('Y'), "SUCOR", $conexao_com_banco) ;
    echo $numero_total ?>', /*'width':500, 'height':300*/ colors: ['#3498db','#2ecc71','#e74c3c','#2c3e50', '#d35400'], pieSliceText: 'value'};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('processos-sucor'));
        chart.draw(data, options);
      }



      function processosADM() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Setor');
        data.addColumn('number', 'Número');
        data.addRows([
       ['Abertos', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "ADM", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Análise no prazo',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "ADM", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Análise em atraso',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "ADM", "Análise em atraso", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída no prazo',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "ADM", "Concluído", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída com atraso',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "ADM", "Concluído com atraso", $conexao_com_banco); echo $numero_total ?>],
     ]);

        // Set chart options
        var options = {'title':'Processos no setor ADMINISTRATIVO: <?php $numero_total = retorna_numero_processos_status(date('Y'), "ADM", $conexao_com_banco) 
    ; echo $numero_total ?>', /*'width':500, 'height':300*/ colors: ['#3498db','#2ecc71','#e74c3c','#2c3e50', '#d35400'], pieSliceText: 'value'};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('processos-adm'));
        chart.draw(data, options);
      }




      function processosAGT() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Setor');
        data.addColumn('number', 'Número');
        data.addRows([
      ['Abertos', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "AGT", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Análise no prazo',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "AGT", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Análise em atraso',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "AGT", "Análise em atraso", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída no prazo',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "AGT", "Concluído", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída com atraso',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "AGT", "Concluído com atraso", $conexao_com_banco); echo $numero_total ?>],
      ]);
        // Set chart options
        var options = {'title':'Processos no setor AGT: <?php $numero_total = retorna_numero_processos_status(date('Y'), "AGT", $conexao_com_banco) ;
    echo $numero_total ?>', /*'width':500, 'height':300*/ colors: ['#3498db','#2ecc71','#e74c3c','#2c3e50', '#d35400'], pieSliceText: 'value'};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('processos-agt'));
        chart.draw(data, options);
      }


      function processosTI() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Setor');
        data.addColumn('number', 'Número');
        data.addRows([
          ['Abertos', <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "TI", "Aberto",  $conexao_com_banco); echo $numero_total ?>],
          ['Análise no prazo',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "TI", "Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Análise em atraso',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "TI", "Análise em atraso", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída no prazo',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "TI", "Concluído", $conexao_com_banco); echo $numero_total ?>],
          ['Análise concluída com atraso',  <?php $numero_total = retorna_numero_processos_situacao_setor(date('Y'), "TI", "Concluído com atraso", $conexao_com_banco); echo $numero_total ?>],
     ]);

        // Set chart options
        var options = {'title':'Processos no setor TI: <?php $numero_total = retorna_numero_processos_status(date('Y'), "TI", $conexao_com_banco) ; 
    echo $numero_total ?>', /*'width':500, 'height':300*/ colors: ['#3498db','#2ecc71','#e74c3c','#2c3e50', '#d35400'], pieSliceText: 'value'};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('processos-ti'));
        chart.draw(data, options);
      }

      function processosarquivadosEsaiu() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Setor');
        data.addColumn('number', 'Número');
        data.addRows([
          ['Arquivados',  <?php $numero_total = retorna_numero_processos_status(date('Y'),"Arquivado", $conexao_com_banco); echo $numero_total ?>],
          ['Saíram',  <?php $numero_total = retorna_numero_processos_status(date('Y'),"Saiu", $conexao_com_banco); echo $numero_total ?>],
          
        ]);

        // Set chart options
        var options = {'title':'No Arquivo e fora do órgão: <?php $numero_total = retorna_numero_processos_inativos(date('Y'),$conexao_com_banco); echo $numero_total ?>', /*'width':500, 'height':300*/ colors: ['#f1c40f','#d35400'], pieSliceText: 'value'};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('processos-arquivados-e-saiu'));
        chart.draw(data, options);
      }


      function processosAtivos() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Setor');
        data.addColumn('number', 'Número');
        data.addRows([
          ['Protocolo', <?php $numero_total = retorna_numero_processos_status(date('Y'), "PRO", $conexao_com_banco); echo $numero_total ?>],
          ['Gabinete',  <?php $numero_total = retorna_numero_processos_status(date('Y'),"GAB", $conexao_com_banco); echo $numero_total ?>],
          ['SUPAD', <?php $numero_total = retorna_numero_processos_status2(date('Y'),"SUPAD", "SUP-SUPAD" , $conexao_com_banco); echo $numero_total ?>],
          ['SUCOF', <?php $numero_total = retorna_numero_processos_status2(date('Y'),"SUCOF", "SUP-SUCOF" , $conexao_com_banco); echo $numero_total ?>],
          ['SUCOR', <?php $numero_total = retorna_numero_processos_status2(date('Y'),"SUCOR", "SUP-SUCOR" , $conexao_com_banco); echo $numero_total ?>],
          ['ADM',  <?php $numero_total = retorna_numero_processos_status(date('Y'),"ADM", $conexao_com_banco); echo $numero_total ?>],
          ['AGT',  <?php $numero_total = retorna_numero_processos_status(date('Y'),"AGT", $conexao_com_banco); echo $numero_total ?>],
          ['TI',  <?php $numero_total = retorna_numero_processos_status(date('Y'),"TI", $conexao_com_banco); echo $numero_total ?>],
        ]);

        // Set chart options
        var options = {'title':'PROCESSOS ATIVOS NO ÓRGÃO: <?php $numero_total = retorna_numero_processos_ativos(date('Y'),$conexao_com_banco); echo $numero_total ?>', /*'width':500, 'height':300*/};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('processos-ativos'));
        chart.draw(data, options);
      }

      function processosAnalise() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Setor');
        data.addColumn('number', 'Número');
        data.addRows([
      ['Sem prazo',  <?php $numero_total = retorna_numero_processos_situacao(date('Y'),"Aberto", $conexao_com_banco); echo $numero_total ?>],   
          ['No prazo',  <?php $numero_total = retorna_numero_processos_situacao(date('Y'),"Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Em atraso',  <?php $numero_total = retorna_numero_processos_situacao(date('Y'),"Análise em atraso", $conexao_com_banco); echo $numero_total ?>],

        ]);

        // Set chart options
        var options = {'title':'PROCESSOS EM ANÁLISE: <?php $numero_total = retorna_numero_processos_analise(date('Y'),$conexao_com_banco); echo $numero_total ?>', /*'width':500, 'height':300*/ colors: ['#7f8c8d','#2ecc71','#e74c3c']};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('processos-analise'));
        chart.draw(data, options);
      }


      function processosFinalizacao() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Setor');
        data.addColumn('number', 'Número');
        data.addRows([
      ['Sem prazo',  <?php $numero_total = retorna_numero_processos_situacao_final(date('Y'),"Aberto", $conexao_com_banco); echo $numero_total ?>], 
          ['No prazo',  <?php $numero_total = retorna_numero_processos_situacao_final(date('Y'),"Em andamento", $conexao_com_banco); echo $numero_total ?>],
          ['Em atraso',  <?php $numero_total = retorna_numero_processos_situacao_final(date('Y'),"Finalização em atraso", $conexao_com_banco); echo $numero_total ?>],
          
        ]);

        // Set chart options
        var options = {'title':'PROCESSOS EM FINALIZAÇÃO: <?php $numero_total = retorna_numero_processos_finalizacao(date('Y'),$conexao_com_banco); echo $numero_total ?>', /*'width':500, 'height':300*/ colors: ['#7f8c8d','#2ecc71','#e74c3c']};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('processos-finalizacao'));
        chart.draw(data, options);
      }


      function processosarquivadosEsaiu() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Setor');
        data.addColumn('number', 'Número');
        data.addRows([
          ['Arquivados',  <?php $numero_total = retorna_numero_processos_status(date('Y'),"Arquivado", $conexao_com_banco); echo $numero_total ?>],
          ['Saíram',  <?php $numero_total = retorna_numero_processos_status(date('Y'),"Saiu", $conexao_com_banco); echo $numero_total ?>],
          
        ]);

        // Set chart options
        var options = {'title':'PROCESSOS ARQUIVADOS OU QUE SAÍRAM: <?php $numero_total = retorna_numero_processos_inativos(date('Y'),$conexao_com_banco); echo $numero_total ?>', /*'width':500, 'height':300*/ colors: ['#f1c40f','#d35400']};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('processos-arquivados-e-saiu'));
        chart.draw(data, options);
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