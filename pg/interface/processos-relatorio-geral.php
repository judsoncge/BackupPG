<?php 
include('../componentes/sessao/iniciar-sessao.php'); 
include('header.php'); 
include('body-padrao.php');
date_default_timezone_set('America/Bahia');
?>


<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>
<script type="text/javascript" src="js/export_processos.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="css/print.css" media="print" /> -->




<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
    <div class="container titulo-pagina">
        <p>Relatório Executivo - CGE</p>
        <h5 style="margin-top: -15px; position: absolute;"><?php $ano=date('Y'); $mes = date('m')-1; echo arruma_data_mes2($mes);?></h5>
        <div class="row">    
            <div class="col-md-10">
                <div class="btn-group" role="group" aria-label="...">
                  <a href="processos-relatorio1.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">Visão Geral</button></a>
                  <a href="processos-relatorio2.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">Por Setor</button></a>
                  <a href="processos-relatorio3.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">Por Pessoa</button></a>
                  <a href="processos-relatorio-geral.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">Relatório Executivo</button></a>
                  <!-- <a href="home3.php?sessionId=<?php echo $num ?>"><button type="button" class="btn botao-dashboard">SUPAD</button></a> -->     
                </div>          
            </div>
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
                       display: inline;
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

        
        <img id="cabecalho" src="img/relatorio_executivo.png"/>
        <center>
            <p id="cabecalho_mes">Outubro de 2016</p>
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
                                    <td colspan="4"><p>9,5</p></td>
                                </tr>
                                <tr>
                                    <td>9,5</td>
                                    <td>8,5</td>
                                    <td>10</td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <td>SUCOF</td>
                                    <td>SUPAD</td>
                                    <td>SUCOR</td>
                                    <td>ADM</td>
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

