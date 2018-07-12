<?php 
ini_set('memory_limit', '256M');
include("../banco-dados/conectar.php");
include("../funcoes.php");
session_start();
//iniciar buffer
ob_start();
$query = NULL;
$status = NULL;
$lugar = NULL;

if(isset($_GET['busca_query'])) {
	$query = str_replace('*','%',$_GET['busca_query']);
}
if(isset($_GET['lugar'])) {
	$lugar = $_GET['lugar'];
}
if(isset($_GET['status'])) {
	$status = $_GET['status'];
}

$lista = listar_processos_pdf($query, $lugar, $status, $conexao_com_banco);


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
	include("../../interface/mpdf60/mpdf.php");

	//criar o objeto
	
	$mpdf = new mPDF('L');
	
	$mpdf->allow_charset_conversion = true;

	$mpdf->charset_in = 'UTF-8';

	$mpdf->WriteHTML($html);

	$mpdf->Output('Processos.pdf','I');
	


	exit();

?>