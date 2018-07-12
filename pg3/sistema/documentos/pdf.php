<?php 

//iniciar buffer
ob_start();

include('../banco-dados/conectar.php');
//pegar os dados do documento sucor para a geração do documento
$texto_resposta = $_GET['resposta'];
$tipo_documento = $_GET['tipo'];

$interessado = $_GET['interessado'];

$tipo_atividade = $_GET['tipo_atividade'];
if(isset($_GET['processo'])){
$processo = $_GET['processo'];
}
if(isset($_GET['descricao'])){
$descricao = $_GET['descricao'];
}



	//pegar conteúdo do buffer, inserir  na variável e limpar memória
$html = ob_get_clean();

	//converte o conteúdo para utf-8
$html = utf8_encode($html);

if ($tipo_documento=='Memorando'){
	$html .= '
	<style type="../../interface/text/css">
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

	<img src="../../interface/img/'.$tipo_documento.'.png" id="cabecalho"/><br>
		
	
        <p>'.$texto_resposta.'</p>
    ';
}else{
	$html .= '
	<style type="../../interface/text/css">
		p{
			font-family:Arial, sans-serif;
			color:#333;
            text-align: justify;
		}        
        
        #info-basic{
            margin-top: 40px;
        }
		
		#cabecalho{
			position:absolute;
			margin-top:-70px;
			margin-right:-60px;
			margin-left:-60px;
			width:1000px;
		}

	</style>

	<img src="../../interface/img/'.$tipo_documento.'.png" id="cabecalho"/><br>

		<div id="info-basic">
			<b>PROCESSO: '.$processo.'</b><br>
			<b>INTERESSADO: '.$interessado.'</b><br>	
			<b>ASSUNTO: '.$descricao.'</b><br>	
		</div>	
		
		
	
        <p>'.$texto_resposta.'</p>
    ';
}



	//incluir a classe MPDF
	include("../../interface/mpdf60/mpdf.php");

	//criar o objeto
	$mpdf = new mPDF();

	$mpdf->allow_charset_conversion = true;

	$mpdf->charset_in = 'UTF-8';

	$mpdf->WriteHTML($html);

	$mpdf->Output(''.$tipo_documento.'_'.$interessado.'.pdf','I');

	exit();

?>