<?php 
include('../head.php'); 
include('../body.php');
verificar_permissao_pagina($_SESSION['permissao-visualizar-relatorio-orgao'], $conexao_com_banco);
date_default_timezone_set('America/Bahia');
$ano = isset($_POST['ano'])?$_POST['ano']:date('Y');
$mes = isset($_POST['mes'])?$_POST['mes']:date('m');
?>

<script src="../../interface/js/highcharts.js"></script>
<script src="../../interface/js/exporting.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="css/print.css" media="print" /> -->

<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
    <div class="container titulo-pagina">
        <p>Relatório Executivo</p>
        <h5 style="margin-top: -15px; position: absolute;"><?php echo arruma_data_mes2($mes);?></h5>
        <div class="row">    
            <div class="col-md-2">
                <button type="button" class="btn botao-dashboard" id="botao_imprimir">Imprimir relatório</button> 
            </div>
        </div>
    </div>

	<div class="container caixa-conteudo" id="impressao">

            <style type="text/css">

                *{
                    font-family: 'Arial', sans-serif;
                    /*vertical-align: initial;*/
                }


                /*gráficos de processos relatório geral*/
                #barra1, #pizza1, #pizza2, #pizza3, #pizza4, #coluna1, #coluna2, #coluna3, #linha1, #nota_cge{
                    box-shadow: 0 2px 2px rgba(0,0,0,0.2);
                }

                #nota_cge{
                    text-align: center; 
                    background-color: white; 
                    padding: 14px; 
                    /*box-shadow: 0px 2px 5px rgba(0,0,0,0.2);*/
                    }

                #nota_cge p{
                    font-size: 100pt; 
                    padding-top: 21px; 
                    padding-bottom: 21px;
                }
                table#nota_cge{
                    width: 300px;
                }
                table#nota_cge tr td{
                    padding: 10px;
                }
                #titulo-print, #cabecalho, #autor, #cabecalho_mes{
                    display: none;
                }

                @media print{
                    .row{
                        margin: 50px 0 50px 0;
                    }
                    #cabecalho{
                       display: block;
                       width: 100%;
                       position: fixed;
                       top: 0;
                    }
                    #cabecalho_mes{
                        display: initial;
                        position: fixed;
                        top: 0;
                        color: white;
                        margin-left: -30px;
                        margin-top: 110px;
                        font-size: 24pt;
                        color: #ffffff;
                        font-weight: bold;
                        z-index: 200;
                    }
                    #primeira-row{
                        padding-top: 150px;
                    }
                    #barra1, #pizza1, #pizza2, #pizza3, #pizza4, #coluna1, #coluna2, #coluna3, #linha1, #nota_cge{
                        box-shadow: 0 0px 0px rgba(0,0,0,0.0);
                    }
                    #row-segunda-pagina{
                        padding-top: 250px;
                    }
                    th, td {
                        border-bottom: 1px solid #ddd;
                    }
                    #autor{
                        display: initial;
                        position: fixed;
                        bottom: 0;
                        text-align: center;
                        color: grey;
                        font-size: 9pt;
                        z-index: 99;
                    }
                }


            </style>

        
        <img id="cabecalho" src="../../interface/img/relatorio_executivo.png"/>
        <center>
            <p id="cabecalho_mes"><?php echo arruma_data_mes2($mes) ?> de <?php echo $ano ?></p>
        </center>


        <div class="row" id="primeira-row">
            <div class="col-md-12">
                <table width="100%">
                    <tr>
                        <td width="60%">
                            <div id="barra1" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
                        </td>
                        <td width="20%">
                            <table id="nota_cge" width="100%">
                                <tr>
                                    <td colspan="4">DESEMPENHO DA <b>CGE</b></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><p><?php $nota = number_format(retorna_media_geral($mes, $ano, $conexao_com_banco), 1, '.', '.'); echo $nota;?></p></td>
                                </tr>
                                <tr>
                                    <td><?php $nota = number_format(retorna_media_geral_setor($mes, $ano, 'SUP-SUCOF', $conexao_com_banco), 1, '.', '.'); echo $nota;?></td>
                                    <td><?php $nota = number_format(retorna_media_geral_setor($mes, $ano, 'SUP-SUPAD', $conexao_com_banco), 1, '.', '.'); echo $nota;?></td>
                                    <td><?php $nota = number_format(retorna_media_geral_setor($mes, $ano, 'SUP-SUCOR', $conexao_com_banco), 1, '.', '.'); echo $nota;?></td>
                                </tr>
                                <tr>
                                    <td>SUCOF</td>
                                    <td>SUPAD</td>
                                    <td>SUCOR</td>
                                </tr>                  
                            </table>    
                        </td>
                    </tr>
                </table>
            </div>    
        </div>
        <div class="row">   
            <div class="col-md-12"> 
                <table width="100%">    
                    <tr>
                        <td width="45%">
                            <div id="pizza1" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                        </td>
                        <td width="45%">
                            <div id="pizza2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                        </td>
                    </tr>
                </table>
            </div>    
        </div>
        <div class="row">    
            <div class="col-md-12">
                <table width="100%">    
                    <tr>
                        <td width="45%">
                            <div id="pizza3" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                        </td>
                        <td width="45%">
                            <div id="pizza4" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                        </td>
                    </tr>
                </table>            
            </div>
        </div> 
        <div class="row" id="row-segunda-pagina">
            <div class="col-md-12">
                <table width="100%">    
                    <tr>
                        <td width="45%">
                            <div id="coluna1" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                        </td>
                        <td width="45%">
                            <div id="coluna2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                        </td>
                    </tr>
                </table>            
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table width="100%">    
                    <tr>
                        <td width="40%">
                            <div id="coluna3" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                        </td>
                        <td width="40%">
                            <div id="linha1" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                        </td>
                    </tr>
                </table>            
            </div>
        </div> 
        <div id="autor">Elaborado pela Assessoria de Governança e Transparência - CGE/AL</div>
	</div>
</div>
<!-- /#Conteúdo da Página/-->





<script type="text/javascript">
    /*menu lateral*/
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

<script>
    document.getElementById('botao_imprimir').onclick = function() {
        var conteudo = document.getElementById('impressao').innerHTML,
        tela_impressao = window.open('');
        tela_impressao.document.write(conteudo);
        tela_impressao.window.print();
        tela_impressao.window.close();
    };
</script>

<script>

$('#export').click(function () {
	
    var obj = {},
        chart;
    
    chart = $('#pizza1').highcharts();
    obj.svg = chart.getSVG();
    obj.type = 'image/png';
    obj.width = 650; 
    obj.async = true;
    
    
    $.ajax({
        type: 'post',
        url: chart.options.exporting.url,        
        data: obj, 
        success: function (data) {            
            var exportUrl = this.url,
                export_pizza1 = $("#export_pizza1");
            $('<img>').attr('src', exportUrl + data).attr('width','650px').appendTo(export_pizza1);
            $('<a>or Download Here</a>').attr('href',exportUrl + data).appendTo(export_pizza1);
            $('img').fadeIn();
        }        
    });


});

$(function () {
    Highcharts.chart('pizza1', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: '<?php echo retorna_processos_entraram_mes_individual($mes, $ano, $conexao_com_banco); ?> ENTRARAM SÓ NESSE MÊS'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.0f}, {point.x:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y:.0f}, {point.x:.1f}%',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Percentual',
            colorByPoint: true,
            data: [{
                name: 'SUCOF',
                x: <?php echo retorna_porcentagem_processos_ativos_mes_setor('SUP-SUCOF', $mes, $ano, $conexao_com_banco) ?>,
                y: <?php echo retorna_numero_processos_setor_mes_ano('SUP-SUCOF', $mes, $ano, $conexao_com_banco) ?>,
                color: '#3498db'
            }, {
                name: 'SUPAD',
                x: <?php echo retorna_porcentagem_processos_ativos_mes_setor('SUP-SUPAD', $mes, $ano, $conexao_com_banco) ?>,
                y: <?php echo retorna_numero_processos_setor_mes_ano('SUP-SUPAD', $mes, $ano, $conexao_com_banco) ?>,
                /*sliced: true,
                selected: true,*/
                color: '#9b59b6'
            }, {
                name: 'SUCOR',
                x: <?php echo retorna_porcentagem_processos_ativos_mes_setor('SUP-SUCOR', $mes, $ano, $conexao_com_banco) ?>,
                y: <?php echo retorna_numero_processos_setor_mes_ano('SUP-SUCOR', $mes, $ano, $conexao_com_banco) ?>,
                color: '#f1c40f'
            }, {
                name: 'ADM',
                x: <?php echo retorna_porcentagem_processos_ativos_mes_setor('ADM', $mes, $ano, $conexao_com_banco) ?>,
                y: <?php echo retorna_numero_processos_setor_mes_ano('ADM', $mes, $ano, $conexao_com_banco) ?>,
                color: '#e67e22'
            }, {
                name: 'GAB',
                x: <?php echo retorna_porcentagem_processos_ativos_mes_setor('GAB', $mes, $ano, $conexao_com_banco) ?>,
                y: <?php echo retorna_numero_processos_setor_mes_ano('GAB', $mes, $ano, $conexao_com_banco) ?>,
                color: '#2ecc71'
            }]
        }]
    });
});


$(function () {
    Highcharts.chart('pizza2', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: '<?php echo retorna_numero_processos_status('Ativo',$conexao_com_banco) ?> ACUMULADOS ATÉ ESSE MÊS'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.0f}, {point.x:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y:.0f}, {point.x:.1f}%',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Percentual',
            colorByPoint: true,
            data: [{
                name: 'SUCOF',
                x: <?php echo retorna_porcentagem_processos_status_setor('Ativo', 'SUP-SUCOF', $conexao_com_banco) ?>,
                y: <?php echo retorna_numero_processos_status_setor('Ativo', 'SUP-SUCOF', $conexao_com_banco) ?>,
                color: '#3498db'
            }, {
                name: 'SUPAD',
                x: <?php echo retorna_porcentagem_processos_status_setor('Ativo', 'SUP-SUPAD', $conexao_com_banco) ?>,
                y: <?php echo retorna_numero_processos_status_setor('Ativo', 'SUP-SUPAD', $conexao_com_banco) ?>,
                /*sliced: true,
                selected: true,*/
                color: '#9b59b6'
            }, {
                name: 'SUCOR',
                x: <?php echo retorna_porcentagem_processos_status_setor('Ativo', 'SUP-SUCOR', $conexao_com_banco) ?>,
                y: <?php echo retorna_numero_processos_status_setor('Ativo', 'SUP-SUCOR', $conexao_com_banco) ?>,
                color: '#f1c40f'
            }, {
                name: 'ADM',
                x: <?php echo retorna_porcentagem_processos_status_setor('Ativo', 'ADM', $conexao_com_banco) ?>,
                y: <?php echo retorna_numero_processos_status_setor('Ativo', 'ADM', $conexao_com_banco) ?>,
                color: '#e67e22'
            }, {
                name: 'GABIN',
                x: <?php echo retorna_porcentagem_processos_status_setor('Ativo', 'GAB', $conexao_com_banco) ?>,
                y: <?php echo retorna_numero_processos_status_setor('Ativo', 'GAB', $conexao_com_banco) ?>,
                color: '#2ecc71'
            }]
        }]
    });
});



$(function () {
    Highcharts.chart('pizza3', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: '<?php echo retorna_processos_resolvidos_ano($ano, $conexao_com_banco); ?> PROCESSOS RESOLVIDOS EM <?php echo $ano; ?>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.0f}, {point.x:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y:.0f}, {point.x:.1f}%',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                }
            }
        },
        series: [{
            name: 'Percentual',
            colorByPoint: true,
            data: [{
                name: 'Saíram',
                x: <?php echo retorna_porcentagem_sairam_ano($ano, $conexao_com_banco) ?>,
                y: <?php echo retorna_processos_sairam_ano($ano, $conexao_com_banco) ?>,
                color: '#3498db'
            }, {
                name: 'Arquivados',
                x: <?php echo retorna_porcentagem_arquivados_ano($ano, $conexao_com_banco) ?>,
                y: <?php echo retorna_processos_arquivados_ano($ano, $conexao_com_banco) ?>,
                /*sliced: true,
                selected: true,*/
                color: '#9b59b6'
            }]
        }]
    });
});


$(function () {

    $(document).ready(function () {

        // Build the chart
        Highcharts.chart('pizza4', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'PROCESSOS RESOLVIDOS POR TIPO EM <?php echo $ano ?>'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.0f}, {point.x:.1f}%',
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Percentual',
                colorByPoint: true,
                data: [{
                    name: 'Interno',
                    x: <?php echo retorna_porcentagem_resolvidos_tipo_ano($ano, 'Processo Interno', $conexao_com_banco) ?>,
                    y: <?php echo retorna_processos_resolvidos_tipo_ano($ano, 'Processo Interno', $conexao_com_banco) ?>,
                    color: '#1abc9c'
                }, {
                    name: 'Externo',
					x: <?php echo retorna_porcentagem_resolvidos_tipo_ano($ano, 'Processo Externo', $conexao_com_banco) ?>,
                    y: <?php echo retorna_processos_resolvidos_tipo_ano($ano, 'Processo Externo', $conexao_com_banco) ?>,
                    color: '#27ae60'
                }, {
                    name: 'Administrativo',
					x: <?php echo retorna_porcentagem_resolvidos_tipo_ano($ano, 'Processo Administrativo', $conexao_com_banco) ?>,
                    y: <?php echo retorna_processos_resolvidos_tipo_ano($ano, 'Processo Administrativo', $conexao_com_banco) ?>,
                    color: '#9b59b6'
                }, {
                    name: 'LAI',
					x: <?php echo retorna_porcentagem_resolvidos_tipo_ano($ano, 'LAI', $conexao_com_banco) ?>,
                    y: <?php echo retorna_processos_resolvidos_tipo_ano($ano, 'LAI', $conexao_com_banco) ?>,
                    color: '#e74c3c'
                }, {
                    name: 'Judiciário',
					x: <?php echo retorna_porcentagem_resolvidos_tipo_ano($ano, 'Judiciário', $conexao_com_banco) ?>,
                    y: <?php echo retorna_processos_resolvidos_tipo_ano($ano, 'Judiciário', $conexao_com_banco) ?>,
                    color: '#d35400'
                }, {
                    name: 'Outros',
					x: <?php echo retorna_porcentagem_resolvidos_tipo_ano($ano, 'Outros', $conexao_com_banco) ?>,
                    y: <?php echo retorna_processos_resolvidos_tipo_ano($ano, 'Outros', $conexao_com_banco) ?>,
                    color: '#7f8c8d'
                }]
            }]
        });
    });
});
    $(function () {
    Highcharts.chart('barra1', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'RANKING DA EXECUÇÃO DOS PROCESSOS DE <?php echo $ano ?>'
        },
        xAxis: {
            categories: ['CGE', 'SUCOF', 'SUPAD', 'SUCOR', 'ADM', 'GABIN']
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total fruit consumption'
            }
        },
        legend: {
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [ {
            name: 'Sem prazo',
            data: [<?php echo retorna_numero_processos_situacao_ano($ano, 'Aberto',$conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_ano($ano,'Aberto','SUP-SUCOF', $conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_ano($ano,'Aberto','SUP-SUPAD',$conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_ano($ano,'Aberto','SUP-SUCOR',$conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_ano($ano,'Aberto','ADM', $conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_ano($ano,'Aberto','GAB',$conexao_com_banco) ?>],
            color: '#95a5a6'
        }, {
            name: 'Análise no prazo',
			data: [<?php echo retorna_numero_processos_situacao_ano($ano, 'Análise em andamento', $conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_ano($ano,'Análise em andamento','SUP-SUCOF', $conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_ano($ano,'Análise em andamento','SUP-SUPAD', $conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_ano($ano,'Análise em andamento', 'SUP-SUCOR', $conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_ano($ano,'Análise em andamento','ADM', $conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_ano($ano,'Análise em andamento','GAB',$conexao_com_banco) ?>],
            color: '#2ecc71'
        }, {
            name: 'Análise em atraso',
            data: [<?php echo retorna_numero_processos_situacao_ano($ano, 'Análise em atraso',$conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_ano($ano,'Análise em atraso','SUP-SUCOF', $conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_ano($ano,'Análise em atraso','SUP-SUPAD',$conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_ano($ano,'Análise em atraso','SUP-SUCOR',$conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_ano($ano,'Análise em atraso','ADM', $conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_ano($ano,'Análise em atraso','GAB',$conexao_com_banco) ?>],
            color: '#d35400'
        }, {
            name: 'Finalização no prazo',
            data: [<?php echo retorna_numero_processos_situacao_final_ano($ano, 'Finalização em andamento',$conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_final_ano($ano,'Finalização em andamento','SUP-SUCOF', $conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_final_ano($ano,'Finalização em andamento','SUP-SUPAD',$conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_final_ano($ano,'Finalização em andamento','SUP-SUCOR',$conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_final_ano($ano,'Finalização em andamento','ADM', $conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_final_ano($ano,'Finalização em andamento','GAB',$conexao_com_banco) ?>],
            color: '#2980b9'
        }, {
            name: 'Finalização em atraso',
            data: [<?php echo retorna_numero_processos_situacao_final_ano($ano, 'Finalização em atraso',$conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_final_ano($ano,'Finalização em atraso','SUP-SUCOF', $conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_final_ano($ano,'Finalização em atraso','SUP-SUPAD',$conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_final_ano($ano,'Finalização em atraso','SUP-SUCOR',$conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_final_ano($ano,'Finalização em atraso','ADM', $conexao_com_banco) ?>, <?php echo retorna_numero_processos_setor_situacao_final_ano($ano,'Finalização em atraso','GAB',$conexao_com_banco) ?>],
            color: '#e74c3c'
        }]
    });
});






$(function () {
    Highcharts.chart('coluna1', {

        chart: {
            type: 'column'
        },

        title: {
            text: 'COMPORTAMENTO DOS PROCESSOS NO MÊS'
        },

        xAxis: {
            categories: ['<?php $mes_anterior2 = $mes-2; 
								$ano_anterior2=$ano;
								if($mes_anterior2==-1){
									$mes_anterior2=11;
									$ano_anterior2=$ano-1;
								}else 
								if($mes_anterior2==0){
									$mes_anterior2=12;
									$ano_anterior2=$ano-1;
								} 
								echo arruma_data_mes2($mes_anterior2) ?>',
			
			'<?php 				$mes_anterior = $mes-1; 
								$ano_anterior=$ano; 
								if($mes_anterior==0){
									$mes_anterior=12;
									$ano_anterior=$ano-1;
								} 
								echo arruma_data_mes2($mes_anterior) ?>', 
			
			'<?php 				echo arruma_data_mes2($mes) ?>']
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Quantidade de processos'
            }
        },

        tooltip: {
            formatter: function () {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>' +
                    'Total: ' + this.point.stackTotal;
            }
        },

        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },

        series: [{
            name: 'Entraram',
            data: [<?php echo retorna_processos_entraram_mes_individual($mes_anterior2, $ano_anterior2, $conexao_com_banco); ?>,
			<?php echo retorna_processos_entraram_mes_individual($mes_anterior, $ano_anterior, $conexao_com_banco); ?>,
			<?php echo retorna_processos_entraram_mes_individual($mes, $ano, $conexao_com_banco); ?>],
            stack: 'male',
            color: '#27ae60'
        }, {
            name: 'Vindo do mês anterior',
            data: [<?php $ano_anterior4=0;
						 $mes_anterior3=$mes_anterior2-1; 
						 $ano_anterior3=$ano;
						 if($mes_anterior3==0){
							$mes_anterior3=12;
							$ano_anterior3=$ano_anterior3--;
						 } else if ($mes_anterior3==-1){
							$mes_anterior3=11;
							$ano_anterior3=$ano_anterior3--;
						 }
						 
						 $mes_anterior4 = $mes_anterior3 - 1;
						 
						 if($mes_anterior4==0){
							$mes_anterior4=12;
							$ano_anterior4=$ano_anterior4--;
						 } else if ($mes_anterior4==-1){
							$mes_anterior4=11;
							$ano_anterior4=$ano_anterior4--;
						 }
						 
						 
						 echo retorna_processos_entraram_mes_individual($mes_anterior3, $ano_anterior3, $conexao_com_banco) + retorna_processos_entraram_mes_individual($mes_anterior4, $ano_anterior4, $conexao_com_banco) - retorna_processos_sairam_mes_individual($mes_anterior3, $ano_anterior3, $conexao_com_banco) - retorna_processos_sairam_mes_individual($mes_anterior4, $ano_anterior4, $conexao_com_banco);?>, 
					<?php 
						 echo retorna_processos_entraram_mes_individual($mes_anterior2, $ano_anterior2, $conexao_com_banco) + retorna_processos_entraram_mes_individual($mes_anterior3, $ano_anterior3, $conexao_com_banco) - retorna_processos_sairam_mes_individual($mes_anterior2, $ano_anterior2, $conexao_com_banco) - retorna_processos_sairam_mes_individual($mes_anterior3, $ano_anterior3, $conexao_com_banco);?>,
					<?php 
						 echo retorna_processos_entraram_mes_individual($mes_anterior, $ano_anterior, $conexao_com_banco) + retorna_processos_entraram_mes_individual($mes_anterior2, $ano_anterior2, $conexao_com_banco) - retorna_processos_sairam_mes_individual($mes_anterior, $ano_anterior, $conexao_com_banco) - retorna_processos_sairam_mes_individual($mes_anterior2, $ano_anterior2, $conexao_com_banco);?>],
            stack: 'male',
            color: '#2ecc71'
        }, {
            name: 'Déficit',
            data: [<?php $entraram = retorna_processos_entraram_mes_individual($mes_anterior2, $ano_anterior2, $conexao_com_banco) + retorna_processos_entraram_mes_individual($mes_anterior3, $ano_anterior3, $conexao_com_banco) - retorna_processos_sairam_mes_individual($mes_anterior3, $ano_anterior3, $conexao_com_banco);
						 $sairam = retorna_processos_sairam_mes_individual($mes_anterior2, $ano_anterior2, $conexao_com_banco);
						 $deficit = $entraram - $sairam;
					     echo $deficit; ?>,
				   <?php $entraram = retorna_processos_entraram_mes_individual($mes_anterior, $ano_anterior, $conexao_com_banco) + $deficit;
						 $sairam = retorna_processos_sairam_mes_individual($mes_anterior, $ano_anterior, $conexao_com_banco);
						 $deficit2 = $entraram - $sairam;
					     echo $deficit2;?>, 
				   <?php $entraram = retorna_processos_entraram_mes_individual($mes, $ano, $conexao_com_banco) + $deficit2;
						 $sairam = retorna_processos_sairam_mes_individual($mes, $ano, $conexao_com_banco);
						 $deficit3 = $entraram - $sairam;
					     echo $deficit3;?>],
            stack: 'female',
            color: '#bdc3c7'
        }, {
            name: 'Saíram',
            data: [<?php echo retorna_processos_sairam_mes_individual($mes_anterior2, $ano_anterior2, $conexao_com_banco); ?>,
			<?php echo retorna_processos_sairam_mes_individual($mes_anterior, $ano_anterior, $conexao_com_banco); ?>,
			<?php echo retorna_processos_sairam_mes_individual($mes, $ano, $conexao_com_banco); ?>],
            stack: 'female',
            color: '#3498db'
        }]
    });
});




$(function () {
    Highcharts.chart('coluna2', {

        chart: {
            type: 'column'
        },

        title: {
            text: 'QUANTIDADE DE PROCESSOS EM 2016'
        },

        xAxis: {
            categories: ['<?php echo arruma_data_mes2($mes_anterior2) ?>',
						 '<?php echo arruma_data_mes2($mes_anterior) ?>', 
			         	 '<?php echo arruma_data_mes2($mes) ?>']
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Quantidade de processos'
            }
        },

        tooltip: {
            formatter: function () {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>' +
                    'Total: ' + this.point.stackTotal;
            }
        },

        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },

        series: [{
            name: 'Entraram',
            data: [<?php echo retorna_processos_entraram_mes_acumulado($mes_anterior2, $ano_anterior2, $conexao_com_banco)?> ,
			<?php echo retorna_processos_entraram_mes_acumulado($mes_anterior, $ano_anterior, $conexao_com_banco)?> ,
			<?php echo retorna_processos_entraram_mes_acumulado($mes, $ano, $conexao_com_banco)?>],
            stack: 'male',
			color: '#27ae60'
        }, {
            name: 'Vindo do mês anterior',
			data: [<?php echo retorna_processos_entraram_mes_acumulado($mes_anterior3, $ano_anterior3, $conexao_com_banco) - retorna_processos_sairam_mes_acumulado($mes_anterior3, $ano_anterior3, $conexao_com_banco);?>, 
				   <?php echo retorna_processos_entraram_mes_acumulado($mes_anterior2, $ano_anterior2, $conexao_com_banco) - retorna_processos_sairam_mes_acumulado($mes_anterior2, $ano_anterior2, $conexao_com_banco);?>,
				   <?php echo retorna_processos_entraram_mes_acumulado($mes_anterior, $ano_anterior, $conexao_com_banco) - retorna_processos_sairam_mes_acumulado($mes_anterior, $ano_anterior, $conexao_com_banco);?>],
            stack: 'male',
            color: '#2ecc71'
        }, {
            name: 'Déficit',
            data: [<?php echo retorna_processos_entraram_mes_acumulado($mes_anterior2, $ano_anterior2, $conexao_com_banco) + retorna_processos_entraram_mes_acumulado($mes_anterior3, $ano_anterior3, $conexao_com_banco) - retorna_processos_sairam_mes_acumulado($mes_anterior3, $ano_anterior3, $conexao_com_banco) - retorna_processos_sairam_mes_acumulado($mes_anterior2, $ano_anterior2, $conexao_com_banco) ?>, 
			<?php echo retorna_processos_entraram_mes_acumulado($mes_anterior, $ano_anterior, $conexao_com_banco) + retorna_processos_entraram_mes_acumulado($mes_anterior2, $ano_anterior2, $conexao_com_banco) - retorna_processos_sairam_mes_acumulado($mes_anterior2, $ano_anterior2, $conexao_com_banco) - retorna_processos_sairam_mes_acumulado($mes_anterior, $ano_anterior, $conexao_com_banco)?>, 
			<?php echo retorna_processos_entraram_mes_acumulado($mes, $ano, $conexao_com_banco) + retorna_processos_entraram_mes_acumulado($mes_anterior, $ano_anterior, $conexao_com_banco) - retorna_processos_sairam_mes_acumulado($mes_anterior, $ano_anterior, $conexao_com_banco) - retorna_processos_sairam_mes_acumulado($mes, $ano, $conexao_com_banco)?>],
            stack: 'female',
			color: '#bdc3c7'
        }, {
            name: 'Saíram',
            data: [<?php echo retorna_processos_sairam_mes_acumulado($mes_anterior2, $ano_anterior2, $conexao_com_banco)?>,
			<?php echo retorna_processos_sairam_mes_acumulado($mes_anterior, $ano_anterior, $conexao_com_banco)?>,
			<?php echo retorna_processos_sairam_mes_acumulado($mes, $ano, $conexao_com_banco)?>],
            stack: 'female',
			color: '#3498db'
        }]
    });
});






$(function () {
    Highcharts.chart('coluna3', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'TEMPO DE RESOLUÇÃO DOS PROCESSOS'
        },
        xAxis: {
            categories: [
                'Até 15 dias',
                'Até 30 dias',
                'Até 45 dias',
                'Até 60 dias',
                'Até 120 dias'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Dias no órgão'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                showInLegend: false,
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
            name: 'Quantidade ',
            data: [<?php echo retorna_quantidade_processo_resolvidos_dias(15, $conexao_com_banco) ?>,
			<?php echo retorna_quantidade_processo_resolvidos_dias(30, $conexao_com_banco)-retorna_quantidade_processo_resolvidos_dias(15, $conexao_com_banco) ?>, 
			<?php echo retorna_quantidade_processo_resolvidos_dias(45, $conexao_com_banco)-retorna_quantidade_processo_resolvidos_dias(30, $conexao_com_banco) ?>, 
			<?php echo retorna_quantidade_processo_resolvidos_dias(60, $conexao_com_banco)-retorna_quantidade_processo_resolvidos_dias(45, $conexao_com_banco) ?>, 
			<?php echo retorna_quantidade_processo_resolvidos_dias(120, $conexao_com_banco)-retorna_quantidade_processo_resolvidos_dias(60, $conexao_com_banco) ?>],
            color: '#3498db'
        }]
    });
});



$(function () {
    Highcharts.chart('linha1', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'TEMPO MÉDIO DE RESOLUÇÃO DOS PROCESSOS'
        },
        xAxis: {
            categories: ['<?php $mes_anterior2 = $mes-2; 
								$ano_anterior2=$ano;
								if($mes_anterior2==-1){
									$mes_anterior2=11;
									$ano_anterior2=$ano-1;
								}else 
								if($mes_anterior2==0){
									$mes_anterior2=12;
									$ano_anterior2=$ano-1;
								} 
								echo arruma_data_mes2($mes_anterior2) ?>',
			
			'<?php 				$mes_anterior = $mes-1; 
								$ano_anterior=$ano; 
								if($mes_anterior==0){
									$mes_anterior=12;
									$ano_anterior=$ano-1;
								} 
								echo arruma_data_mes2($mes_anterior) ?>', 
			
			'<?php 				echo arruma_data_mes2($mes) ?>']
        },
        yAxis: {
            title: {
                text: 'Dias no órgão'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: true,
                showInLegend: false
            }
        },
        series: [{
            name: 'Dias',
            data: [<?php echo number_format(retorna_media_dias_processo_mes($mes_anterior2, $conexao_com_banco), 1, '.', '.')  ?>,
			<?php echo number_format(retorna_media_dias_processo_mes($mes_anterior, $conexao_com_banco), 1, '.', '.')  ?>, 
			<?php echo number_format(retorna_media_dias_processo_mes($mes, $conexao_com_banco), 1, '.', '.') ?>]
        }]
    });
});



</script>

