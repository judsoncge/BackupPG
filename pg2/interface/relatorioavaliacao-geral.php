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
	<style type="text/css">
		p{
			font-family:Arial, sans-serif;
			color:#333;
		}
		#cabecalho_pdf{
			margin-top: -60px;
			width:120%;
			margin-left: -60px;
			margin-right: -60px;
		}
		#rodape{
			position:absolute;
			bottom:40px;
			left:50%;
			margin-left:-115px;
			font-size:10pt;
		}

		#linha-rodape{
			position: absolute;
			bottom: 50px;
			width: 85%;
		}

		#assinatura_tecnico{
			position:relative;
			text-align: center;
			margin-top: 300px;
			margin-left:auto;
			margin-right:auto;
			font-size:11pt;
		}

		#assinatura_superintendente, #assinatura_data{
			position:relative;
			text-align: center;
			margin-top: 50px;
			margin-left:auto;
			margin-right:auto;
			font-size:11pt;
		}

		#imagem-usuario{
			width: 160px;
			height: 100%;
			max-height: 160px;
			position:absolute;
			margin-top:65px;
		}
		#texto{
			position:absolute;
			margin-top:340px;
		}

		#info-basica{
			font-size: 12pt;
			position:absolute;
			margin-top:140px;
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
		.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc; width:680px;}
		.tg td{font-family:Arial, sans-serif;font-size:14px;padding:20px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
		.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
		.tg .tg-4eph{background-color:#f9f9f9}

	</style>

	<img src="img/cabecalho_indice.png"/ id="cabecalho_pdf">

	
	<img src="../registros/fotos/'.$_GET['foto'].'" id="imagem-usuario"/>
		
	<div id="info-basica">
		<p class="info"><b>Nome</b>: '.$_GET['nome'].'</p>
		<p class="info"><b>Mês</b>: '.$_GET['mes'].'</p>
		<p class="info"><b>Nota pessoal</b>: '.$_GET['geral'].'</p>
		<p class="info"><b>Nota do setor</b>: '.$_GET['geralsetor'].'</p>
	</div>
	
	<div id="texto">
		<table class="tg">
		  <tr>
		    <td class="tg-031e"><b>Produtividade:</b></th>
		    <td class="tg-031e"><b>'.$_GET['produtividade'].'</b></th>
		  </tr>
		  <tr>
		    <td class="tg-4eph"><b>Cumprimento de prazo:</b></td>
		    <td class="tg-4eph"><b>'.$_GET['cumprimento'].'</b></td>
		  </tr>
		  <tr>
		    <td class="tg-031e"><b>Assiduidade:</b></td>
		    <td class="tg-031e"><b>'.$assiduidade.'</b></td>
		  </tr>
		</table>
	</div>

	<div id="assinatura_tecnico">
		<p>
			____________________________________________________<br>
			'.$_GET['nome'].'<br>
			'.$_GET['cargo'].'
		</p>	
	</div>

	<div id="assinatura_superintendente">
		<p>
			____________________________________________________<br>
			'.$_GET['nome_gerador'].'<br>
			'.$_GET['cargo_gerador'].'
		</p>	
	</div>


	<div id="assinatura_superintendente">
		<p>
			_______ de _________________ de _________
		</p>	
	</div>

	<div id="linha-rodape"><hr></div>

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