<?php 

	//iniciar buffer
ob_start();

if($_GET['assiduidade']==''){
	$assiduidade = 'Sem nota';
	
}else{
	$assiduidade = $_GET['assiduidade'];
}

$nome_gerador_pdf = $_SESSION['nome'] . " " . $_SESSION['sobrenome'];

	//pegar conteúdo do buffer, inserir  na variável e limpar memória
$html = ob_get_clean();

	//converte o conteúdo para utf-8
$html = utf8_encode($html);

$html .= '
	

';


	//incluir a classe MPDF
	include("mpdf60/mpdf.php");

	//criar o objeto
	$mpdf = new mPDF();

	$mpdf->allow_charset_conversion = true;

	$mpdf->charset_in = 'UTF-8';

	$mpdf->WriteHTML($html);

	$mpdf->Output('Ficha_Cadastral_'.$_GET['nome'].'.pdf','I');

	exit();

?>