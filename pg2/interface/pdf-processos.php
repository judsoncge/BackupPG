<?php 
include("../nucleo-aplicacao/retornar_dados.php");
include('../componentes/sessao/iniciar-sessao.php');
include("../nucleo-aplicacao/arrumar_dados.php");
//iniciar buffer
ob_start();

$tipo = $_GET['tipo'];

if($tipo=='setor'){
	$lista = retorna_processos_setor($_SESSION['setor'],$conexao_com_banco);
}else if($tipo=='todos'){
	$lista = retorna_processos($conexao_com_banco);
}

	//pegar conteúdo do buffer, inserir  na variável e limpar memória
$html = ob_get_clean();

	//converte o conteúdo para utf-8
$html = utf8_encode($html);

$html .= '
		
		<style type="text/css">
			
			#print-table{
				transform: rotateX(45deg);
			}
                
        </style>        

		<div class="col-md-12 table-responsive">
			<table class="table table-hover tabela-dados" id="print-table">
				<thead>
					<tr>
						<th>Processo</th>
						<th>Prazo parcial</th>
						<th>Prazo final</th>
						<th>Situação</th>
						<th>Situação final</th>
						<th>Está com</th>
						<th>Dias</th>
					</tr>	
				</thead>
				<tbody>
					';

while($r = mysqli_fetch_object($lista)){ 
	$html .= '	
					<tr>
						<td><center>'.$r -> CD_PROCESSO.'</center></td>
						<td><center>'.arruma_data($r -> DT_PRAZO).'</center></td>
						<td><center>'.arruma_data($r -> DT_PRAZO_FINAL).'</center></td>
						<td><center>'.$r-> NM_SITUACAO.'</center></td>	
						<td><center>'.$r-> NM_SITUACAO_FINAL.'</center></td>	
						<td><center>'.retorna_nome_servidor($r-> CD_SERVIDOR_LOCALIZACAO, $conexao_com_banco).'</center></td>	
						<td><center>'.$r-> NR_DIAS.'</center></td>	
					</tr>
				
';
}

$html.= '		</tbody>
			</table>
		</div>';

	//incluir a classe MPDF
	include("mpdf60/mpdf.php");

	//criar o objeto
	
	
	$mpdf = new mPDF('L');
	
	$mpdf->allow_charset_conversion = true;

	$mpdf->charset_in = 'UTF-8';

	$mpdf->WriteHTML($html);

	$mpdf->Output('Processos.pdf','I');
	


	exit();

?>