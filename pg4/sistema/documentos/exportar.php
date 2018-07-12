<?php 
include('../banco-dados/conectar.php');
include('../funcoes.php');



$ano = date('Y');
$mes = date('m');
$valor = retorna_caixa_mes_ano($mes, $ano, $conexao_com_banco);
$stylesheet  = '';
$stylesheet .= file_get_contents('../../interface/css/font-awesome.min.css');
$stylesheet .= file_get_contents('../../interface/css/bootstrap.css');
$stylesheet .= file_get_contents('../../interface/css/estilo.css');

	//iniciar buffer
ob_start();


	//pegar conteúdo do buffer, inserir  na variável e limpar memória
$html = ob_get_clean();

	//converte o conteúdo para utf-8
$html = utf8_encode($html);

$html .= '
	<style type="text/css">
	'.stylesheet.'
		p, h3{
			font-family:Arial, sans-serif;
			color:#333;
		}
		#cabecalho_pdf{
			margin-top: -40px;
			width:120%;
			margin-left: -60px;
			margin-right: -60px;
		}
		#rodape{
			position:absolute;
			bottom:20px;
			left:50%;
			margin-left:-115px;
			font-size:10pt;
		}

		#linha-rodape{
			position: absolute;
			bottom: 30px;
			width: 85%;
		}

		#assinatura_tecnico{
			position:relative;
			text-align: center;
			margin-top: 480px;
			margin-left:auto;
			margin-right:auto;
			font-size:11pt;
		}

		#assinatura_superintendente, #assinatura_data{
			position:relative;
			text-align: center;
			margin-top: 10px;
			margin-left:auto;
			margin-right:auto;
			font-size:11pt;
		}

		#imagem-usuario{
			width: 160px;
			height: 100%;
			max-height: 160px;
			position:absolute;
			margin-top:45px;
		}
		#texto{
			position:absolute;
			margin-top:300px;
		}

		#info-basica{
			font-size: 12pt;
			position:absolute;
			margin-top:120px;
			padding:10px;
			width:470px;
			right:60px;
			border-style: solid;
			border-width: 1px;
			border-color: rgba(0,0,0,0.3);
			background: rgba(236, 240, 241,0.3);
		}

		.info{
			padding-bottom: 5px;
			padding-top: 5px;
			font-size: 12pt;
		}
		.tg  {
			border-collapse:collapse;
			border-spacing:0;
			border-color:#ccc;
			width:670px;
		}
		.tg td{
			font-family:Arial, sans-serif;
			font-size:14px;
			padding:5px;
			border-style:solid;
			border-width:1px;
			overflow:hidden;
			word-break:normal;
			border-color:#ccc;
			color:#333;
			background-color:#fff;
		}
		.tg th{
			font-family:Arial, sans-serif;
			font-size:14px;
			font-weight:normal;
			padding:10px 5px;
			border-style:solid;
			border-width:1px;
			overflow:hidden;
			word-break:normal;
			border-color:#ccc;
			color:#333;
			background-color:#f0f0f0;
		}
		.tg .tg-4eph{
			background-color:#f9f9f9
		}
		.tabela-fluxo {
			table-layout: fixed;
			font-size: 12px;
			width: 1056px;	
		}
		td {
			padding: 7px;
			width: 62px;			
			font-weight: normal;
			text-align: center;
			border-bottom: 1px solid #eceeef;
		}
		th {
			width: 62px;
			text-align: center;
			border-bottom: 2px solid #eceeef;
		}
		
		

	</style>';
	$titulo = $_POST['titulo'];
	$header = '<img src="../../interface/img/cabecalho_relatorio.png" id="cabecalho_pdf">	
	<div style="font-size: 40px; color: white; text-align: center; width: 755px; margin-left: 181px; margin-top: -100px; margin-bottom: 80px; font-weight: bold; font-family: "Myriad Pro", Myriad, "Liberation Sans", "Nimbus Sans L", "Helvetica Neue", Helvetica, Arial, sans-serif;">'.$titulo.'</div>';
		
	$html .= $_POST['html'];


	//incluir a classe MPDF
	include("../../interface/mpdf60/mpdf.php");

	//criar o objeto
	$mpdf = new mPDF('utf-8', 'A4');
	//$mpdf->showImageErrors = true;
	$mpdf->setAutoTopMargin = 'stretch';
	
	$mpdf->setAutoBottomMargin = 'stretch';
	
	$mpdf -> SetHTMLHeader($header);
	
	$mpdf->allow_charset_conversion = true;

	$mpdf->charset_in = 'UTF-8';
	//echo $header;
	//echo $html;
	$mpdf->WriteHTML($html);

	$mpdf->Output('teste.pdf','I');

	exit();
	

?>