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
		}
		#cabecalho_pdf{
			padding-top: -30px;
			width:100%;
		}
		#rodape{
			position:absolute;
			bottom:40px;
			left:50%;
			margin-left:-110px;
			font-size:10pt;
		}

		#imagem-usuario{
			width: 170px;
			position:absolute;
			margin-top:150px;
		}
		#texto{
			position:absolute;
			margin-top:370px;
		}

		#info-basica{
			position:absolute;
			margin-top:150px;
			padding:20px;
			width:450px;
			right:56px;
			border-style: solid;
			border-width: 1px;
			border-color: rgba(0,0,0,0.3);
			background: rgba(236, 240, 241,0.3);
		}

		.info{
			padding-bottom: 10px;
		}
		.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc; width:680px;}
		.tg td{font-family:Arial, sans-serif;font-size:14px;padding:20px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
		.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
		.tg .tg-4eph{background-color:#f9f9f9}

		#diploma, #documento, #comprovante{
			border-style:solid;
			border-width:1px;
			border-color:#ccc;
			width:100%;
			height:100%;
		}

	</style>

	<img src="img/cabecalho_pdf.png"/ id="cabecalho_pdf">

	
	<div id="imagem-usuario"><img src="../registros/fotos/'.$_GET['foto'].'"/></div>
		
	<div id="info-basica">
		<p class="info"><b>Nome</b>: '.$_GET['nome'].'</p>
		<p class="info"><b>Setor</b>: '.$_GET['setor'].'</p>
		<p class="info"><b>Cargo</b>: '.$_GET['cargo'].'</p>
		<p class="info"><b>E-mail institucional</b>: '.$_GET['email'].'</p>
	</div>
	
	<div id="texto">
		<table class="tg">
		  <tr>
		    <td class="tg-031e"><b>Matrícula</b>: '.$_GET['matricula'].'</th>
		    <td class="tg-031e"><b>CPF</b>: '.$_GET['cpf'].'</th>
		  </tr>
		  <tr>
		    <td class="tg-4eph"><b>Situação Funcional</b>: '.$_GET['situacao'].'</td>
		    <td class="tg-4eph"><b>Graduação</b>: '.$_GET['graduacao'].'</td>
		  </tr>
		  <tr>
		    <td class="tg-031e"><b>Data de nomeação</b>: '.$_GET['nomeacao'].'</td>
		    <td class="tg-031e"><b>Grupo (Conforme Decreto 43.794)</b>: '.$_GET['grupo'].'</td>
		  </tr>
		  <tr>
		    <td class="tg-4eph"><b>Salário</b>: '.$_GET['salario'].'</td>
		    <td class="tg-4eph"><b>Cedido pelo órgao</b>:'.$_GET['cedido'].'</td>
		  </tr>
		</table>
	</div>

  	<div id="rodape"><p>Gerado pelo Painel de Gestão CGE</p></div>

  	<div id="documento">
  		<img src="../registros/dados/'.$_GET['dados'].'"/>
  	</div>
  	<div id="rodape"><p>Gerado pelo Painel de Gestão CGE</p></div>
  	<div id="diploma">
  		<img src="../registros/diplomas/'.$_GET['diploma'].'"/>
  	</div>
	<div id="comprovante">
  		<img src="../registros/comprovantes/'.$_GET['comprovante'].'"/>
  	</div>
  	<div id="rodape"><p>Gerado pelo Painel de Gestão CGE</p></div>

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