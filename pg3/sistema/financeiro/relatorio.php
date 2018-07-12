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
			margin-top: -60px;
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
		
		

	</style>

	<img src="../../interface/img/cabecalho_relatorio_financeiro.png"/ id="cabecalho_pdf">
	<div id="page-content-wrapper" style="margin-bottom: 0px;">
	<div class="container titulo-pagina" style="margin-bottom: 0px;">
		<p style="margin-bottom: 0px;"><h2 style="margin-bottom: 0px;">Lançamentos de '.$ano.'</h2></p>
<p ><h4 style="margin-bottom: -20px; padding-bottom: 0px;">Valor do caixa do mês atual: R$ '.arruma_numero(retorna_caixa_mes_ano($mes, $ano, $conexao_com_banco)).'</h4></p>
<p><h4 style="margin-bottom: -20px; padding-bottom: 0px;">Autorizado para empenho/pagamento: R$ '.arruma_numero(retorna_caixa_autorizado_empenho($mes, $ano, $conexao_com_banco)).'</h4></p>
<p><h4 style="margin-bottom: -20px; padding-bottom: 0px;">Disponível (atual): R$ '.arruma_numero(retorna_caixa_disponivel($mes, $ano, $conexao_com_banco)).'</h4></p>
<p><h4>Gerado em: '.date('d/m/Y H:i:s').'</h4></p></div>';
		
	$html .='<div style="page-break-inside: avoid">
		<div>
			<h3>Receitas</h3>
		</div>
		<table class="table tabela-dados tabela-fluxo">
			<thead>
				<tr>
					<th style="text-align: left; padding-left: 0px;">Descrição</th>
					<th>Jan</th>
					<th>Fev</th>
					<th>Mar</th>
					<th>Abr</th>
					<th>Mai</th>
					<th>Jun</th>
					<th>Jul</th>
					<th>Ago</th>
					<th>Set</th>
					<th>Out</th>
					<th>Nov</th>
					<th>Dez</th>
				</tr>	
			</thead>
			<tbody>
			<tr>
				<td style="text-align: left; padding-left: 0px; font-weight: bold; width: 151px">Saldo do mês anterior</td>
	';
	for ($i = 1;$i < 13;$i ++) {
		$html .='<td style="text-align: center; color: blue;">';		
		if ($i == 1) { 
			$html .='-</td>';
		} else if ($i <= $mes) {
			$html .= arruma_numero(retorna_saldo($i-1, $ano, $conexao_com_banco)).'</td>';
		} else if ($i>$mes) {
			$html .= '0,00</td>';
		}
	}
	$html .='</tr>';
	$lista = retorna_receitas_ano($ano,$conexao_com_banco); 
					while($r = mysqli_fetch_object($lista)) {
						$html .='<tr>
							<td style="text-align: left; padding-left: 0px; font-weight: bold; width: 151px;">'.retorna_nome_receita($r->CD_RECEITA,$conexao_com_banco).'</td>';
							
							for($i = 1;$i < 13;$i ++) {
								$html .='<td style="text-align: center; color: blue">'.arruma_numero(retorna_valor_receita($r->CD_RECEITA,$i,$ano,$conexao_com_banco)).'</td>';
							}
						$html .='</tr>';
							
						
					}	
						
				$html .='</tbody>
		</table>
		</div>';
	$html .=' <div style="page-break-inside: avoid">
	<div>
			<h3>Despesas fixas</h3>
		</div>
		<table class="table tabela-dados tabela-fluxo">
			<thead>
				<tr>
					<th style="text-align: left; padding-left: 0px;">Descrição</th>
					<th>Jan</th>
					<th>Fev</th>
					<th>Mar</th>
					<th>Abr</th>
					<th>Mai</th>
					<th>Jun</th>
					<th>Jul</th>
					<th>Ago</th>
					<th>Set</th>
					<th>Out</th>
					<th>Nov</th>
					<th>Dez</th>
				</tr>	
			</thead>
			<tbody>';
	$lista = retorna_despesas_tipo('Fixa', $ano, $conexao_com_banco); 
					while($r = mysqli_fetch_object($lista)) {
						$html .='<tr>
							<td style="text-align: left; padding-left: 0px; font-weight: bold; width: 151px;">'.retorna_nome_despesa($r->CD_DESPESA,$conexao_com_banco).'</td>';
							
							for($i = 1;$i < 13;$i ++) {
								$html .='<td style="text-align: center; color: red;">'.arruma_numero(retorna_valor_despesa($r->CD_DESPESA,$i,$ano,$conexao_com_banco)).'</td>';
							}
						$html .='</tr>';
							
						
					}	
						
				$html .='</tbody>
		</table></div>';
	
	$html .='<div style="page-break-inside: avoid">
	<div>
		<h3>Despesas variáveis</h3>
	</div>
	<table class="table tabela-dados tabela-fluxo">
		<thead>
			<tr>
				<th style="text-align: left; padding-left: 0px;">Descrição</th>
				<th>Jan</th>
				<th>Fev</th>
				<th>Mar</th>
				<th>Abr</th>
				<th>Mai</th>
				<th>Jun</th>
				<th>Jul</th>
				<th>Ago</th>
				<th>Set</th>
				<th>Out</th>
				<th>Nov</th>
				<th>Dez</th>
			</tr>	
		</thead>
		<tbody>';
	$lista = retorna_despesas_tipo('Variável', $ano, $conexao_com_banco); 
		while($r = mysqli_fetch_object($lista)) {
			$html .='<tr>
				<td style="text-align: left; padding-left: 0px; font-weight: bold; width: 151px;">'.retorna_nome_despesa($r->CD_DESPESA,$conexao_com_banco).'</td>';
				
				for($i = 1;$i < 13;$i ++) {
					$html .='<td style="text-align: center; color: red;">'.arruma_numero(retorna_valor_despesa($r->CD_DESPESA,$i,$ano,$conexao_com_banco)).'</td>';
				}
			$html .='</tr>';
				
			
		}	
						
		$html .='</tbody>
		</table></div>';
	$html .='<div style="page-break-inside: avoid">
			<div>
				<h3>Saldo</h3>
			 </div>	
				<table class="table table-hover tabela-dados tabela-fluxo">
					<thead>
						<tr>
							<th style="text-align: left; padding-left: 0px;">Descrição</th>
							<th>Jan</th>
							<th>Fev</th>
							<th>Mar</th>
							<th>Abr</th>
							<th>Mai</th>
							<th>Jun</th>
							<th>Jul</th>
							<th>Ago</th>
							<th>Set</th>
							<th>Out</th>
							<th>Nov</th>
							<th>Dez</th>
						</tr>	
					</thead>
					<tbody>
						<tr>
							<td style="text-align: left; padding-left: 0px; font-weight: bold; width: 151px;">Total de Receitas</td>';
							for($i=1;$i<13;$i++){
								if($i<=$mes){
									$html .='<td style="color: blue;">'.arruma_numero(retorna_total_receitas_mes_ano($i, $ano, $conexao_com_banco)).'</td>';
								}else{
									$html .='<td style="color: blue;">0,00</td>';
								}
							}
						$html .='</tr>
						<tr>
							<td style="text-align: left; padding-left: 0px; font-weight: bold; width: 151px;">Total de Despesas Fixas</td>';
							for($i = 1;$i < 13;$i ++) {
								$html .='<td style="color: red;">'.arruma_numero(
								retorna_total_despesas_mes_ano_tipo($i, $ano, 'Fixa', $conexao_com_banco)
								).'</td>';
							}
						$html .='</tr>
						<tr>
							<td style="text-align: left; padding-left: 0px; font-weight: bold; width: 151px;">Total de Despesas Variáveis</td>';
							for( $i = 1;$i < 13;$i ++) {
								$html .='<td style="color: red;">'.arruma_numero(retorna_total_despesas_mes_ano_tipo($i, $ano, 'Variável', $conexao_com_banco)).'</td>';										
							}
						$html .='</tr>
						<tr>
							<td style="text-align: left; padding-left: 0px; font-weight: bold; width: 151px;">Saldo</td>';
							for ($i = 1;$i < 13;$i ++){
								if($i <= $mes) {
									$html .='<td>'.arruma_numero(retorna_saldo($i, $ano, $conexao_com_banco)).'</td>';
								}else{
									$html .='<td>0,00</td>';
								}
							}
						$html .='</tr>
					</tbody>
			</table>
		</div></div>';
	


	$html .='
	<!--
	<div id="linha-rodape"><hr></div>

  	<div id="rodape"><p>Gerado pelo Painel de Gestão</p></div>
  	-->
';


	//incluir a classe MPDF
	include("../../interface/mpdf60/mpdf.php");

	//criar o objeto
	$mpdf = new mPDF('utf-8', 'A4-L');

	$mpdf->allow_charset_conversion = true;

	$mpdf->charset_in = 'UTF-8';

	$mpdf->WriteHTML($html);

	$mpdf->Output('Fluxo_de_Caixa_'.date('d-m-Y').'.pdf','I');

	exit();
	

?>