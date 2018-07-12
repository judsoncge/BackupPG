<?php 

//iniciar buffer
ob_start();


	//pegar conteúdo do buffer, inserir  na variável e limpar memória
$html = ob_get_clean();

	//converte o conteúdo para utf-8
$html = utf8_encode($html);

	$html .= '
	<style type="text/css">
		p{
			font-family:Arial, sans-serif;
			color:#333;
            text-align: justify;
		}        
		
		#cabecalho{
			position:absolute;
			margin-top:-70px;
			margin-right:-60px;
			margin-left:-60px;
			width:1000px;
		}

	</style>

	<img src="'.$_GET['grafico1'].'" id="cabecalho"/><br>
		
	
        
    ';




	//incluir a classe MPDF
	include("mpdf60/mpdf.php");

	//criar o objeto
	$mpdf = new mPDF();

	$mpdf->allow_charset_conversion = true;

	$mpdf->charset_in = 'UTF-8';

	$mpdf->WriteHTML($html);

	$mpdf->Output('relatorio.pdf','I');

	exit();

?>