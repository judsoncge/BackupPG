<?php 

//iniciar buffer
ob_start();

include('../componentes/banco-dados/conectar.php');
//pegar os dados do documento sucor para a geração do documento
$id = $_GET['documento'];
$tipo_documento = $_GET['tipo'];
$texto = $_GET['texto'];

$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM processo WHERE numero_processo='$id'");

while($result = mysqli_fetch_array($retornoquery)){
	$numero_processo = $result['numero_processo'];
	$descricao = $result['descricao'];
	
}


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
        
        #interessado{
            margin-top: 60px;
        }

	</style>

	<img src="img/'.$tipo_documento.'.png"/ id="sucor_pdf">
        
        <p id="numero_processo"><b>Número do Processo</b>: '.$numero_processo.'</p>
		
               
         <p><b>Assunto</b>: '.$descricao.'</p>
        
        
        
  		<p>'.$texto.'</p>
    ';

	//incluir a classe MPDF
	include("mpdf60/mpdf.php");

	//criar o objeto
	$mpdf = new mPDF();

	$mpdf->allow_charset_conversion = true;

	$mpdf->charset_in = 'UTF-8';

	$mpdf->WriteHTML($html);

	$mpdf->Output(''.$tipo_documento.'_PROCESSO_'.$numero_processo.'.pdf','I');

	exit();

?>