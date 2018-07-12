<?php
include('../../banco-dados/conectar.php');


session_start(); 

if($_GET['operacao']=='fechar'){
//gravando o novo status do chamado numa variável de sessão	
$edita_status_chamado = "Resolvido";
//pegando a data e hora atual da ação
date_default_timezone_set('America/Bahia');
//gravando a data e hora de fechamento do chamado numa variável de sessão
$edita_data_fechamento = date('Y-m-d H:i:s');
//gravando o id do chamado numa variável de sessão
$id_chamado = $_GET['chamado'];
}

if($_GET['operacao']=='mensagem'){
	
$mensagem = $_POST['resposta'];

$mensagem = "DISSE: " . $mensagem;

$falante = $_SESSION["CPF"];

date_default_timezone_set('America/Bahia');

$data_mensagem = date('Y-m-d H:i:s');

$processo = $_GET["processo"];

$id = $processo . $data_mensagem;
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);
$id = str_replace(' ', '', $id);

include('../banco-dados/editar_historico.php');
		
}

if($_GET['operacao']=='tramitar'){

		$origem = $_SESSION['CPF'];

		$destino = $_POST['tramitar'];
		
		$resposta = $_POST['resposta'];
		
		$prazo_salvo = $_GET['prazo'];
		
		$prazo_final_salvo = $_GET['prazo_final'];


		if(isset($_POST['prazo_final']) and isset($_POST['prazo']) and $_POST['prazo_final']!=null and $_POST['prazo']!=null ){
			
			date_default_timezone_set('America/Bahia');
			
			$prazo_final = $_POST['prazo_final'];
			
			$prazo = $_POST['prazo'];	
			
			$data_hoje = date('Y-m-d H:i:s');

			$data = date('Y-m-d');
			
			
			if($prazo < $data or $prazo_final < $data){
				
				echo "<script>history.back();</script>";
				echo "<script>alert('Os prazos não podem ser menores que a data de hoje.')</script>"; 
				die();
				
			}else if($prazo_final == null){
				
				echo "<script>history.back();</script>";
				echo "<script>alert('Defina primeiro o prazo final para ser arquivado ou sair do órgão.')</script>"; 
				die();
				
			}else if($prazo > $prazo_final){
				
				echo "<script>history.back();</script>";
				echo "<script>alert('O prazo para o servidor e superintendente analisarem o processo não pode ser maior que o prazo para arquivamento ou saída do processo.')</script>"; 
				die();
			}		
		
		}
		
					
				$query = "SELECT nome FROM pessoa WHERE CPF='$destino'";
					
					$lista = mysqli_query($conexao_com_banco, $query);
					
					while($resultado = mysqli_fetch_array($lista)){
					
						$nome_destino = $resultado['nome'];
						
						$nome_destino = strtoupper($nome_destino);
						
					}

				$query = "SELECT setor FROM pessoa WHERE CPF='$destino'";
					
					$lista = mysqli_query($conexao_com_banco, $query);
					
					while($resultado = mysqli_fetch_array($lista)){
					
						$setor_destino = $resultado['setor'];	
						
					}
					
				$query = "SELECT analisar_processo FROM permissao WHERE Pessoa_CPF='$destino'";
					
					$lista = mysqli_query($conexao_com_banco, $query);
					
					while($resultado = mysqli_fetch_array($lista)){
					
						$pode_analisar = $resultado['analisar_processo'];
						
					}
					
				$query = "SELECT prazo_processo FROM permissao WHERE Pessoa_CPF='$origem'";
					
					$lista = mysqli_query($conexao_com_banco, $query);
					
					while($resultado = mysqli_fetch_array($lista)){
					
					$prazo_processo = $resultado['prazo_processo'];
						
					}
					
				$query = "SELECT analisar_processo FROM permissao WHERE Pessoa_CPF='$origem'";
					
					$lista = mysqli_query($conexao_com_banco, $query);
					
					while($resultado = mysqli_fetch_array($lista)){
					
					$pode_analisar2 = $resultado['analisar_processo'];
						
					}
					
				$query = "SELECT prazo_final_processo FROM permissao WHERE Pessoa_CPF='$origem'";
					
					$lista = mysqli_query($conexao_com_banco, $query);
					
					while($resultado = mysqli_fetch_array($lista)){
					
					$prazo_final_processo = $resultado['prazo_final_processo'];
						
					}
					
		
					$processo = $_GET["processo"];

					$mensagem = "TRAMITOU O PROCESSO  PARA " . $nome_destino; 

					date_default_timezone_set('America/Bahia');

					$data_tramitacao = date('Y-m-d H:i:s');
					
					$id_tramitacao = "TRAMITACAO_PROCESSO_" . $processo . $data_tramitacao;
					$id_tramitacao = str_replace('.', '', $id_tramitacao);
					$id_tramitacao = str_replace('-', '', $id_tramitacao);
					$id_tramitacao = str_replace(':', '', $id_tramitacao);
					$id_tramitacao = str_replace(' ', '', $id_tramitacao);

					$id = "HISTORICO_PROCESSO_" . $processo . $data_tramitacao;
					$id = str_replace('.', '', $id);
					$id = str_replace('-', '', $id);
					$id = str_replace(':', '', $id);
					$id = str_replace(' ', '', $id);

					$id2 = $id . "2";
					$id3 = $id . "3";
					$id4 = $id . "4";

					$query_verificacao = "SELECT Pessoa_CPF_responsavel FROM historico_processo 
					WHERE Processo_numero='$processo' and acao='Responsável' and Pessoa_CPF_responsavel='$destino'";
					
					$search = mysqli_query($conexao_com_banco, $query_verificacao);
				
					if(mysqli_num_rows($search) == 0){
					
							if($pode_analisar == 'Sim'){

									$mensagem2 = "É RESPONSÁVEL PELO PROCESSO."; 
										
									mysqli_query($conexao_com_banco, 

									"INSERT INTO historico_processo (id, Processo_numero,  mensagem, Pessoa_CPF_responsavel, data_mensagem, acao)

									VALUES

									('$id2', '$processo', '$mensagem2', '$destino' , '$data_tramitacao', 'Responsável')

									")

									 or die(mysqli_error($conexao_com_banco));
										
										
							}
					
					
					}
					
					include('../banco-dados/editar_tramitacao.php');
				
				
			

			

}

if($_GET['operacao']=='sair'){

$processo = $_GET["processo"];

$status = 'Saiu';

$pessoa_tramitou = $_SESSION["CPF"];

$mensagem = "DEU SAÍDA NO PROCESSO";
 
date_default_timezone_set('America/Bahia');

$data_saida = date('Y-m-d H:i:s');

$meses = array(
    '01'=>'Janeiro',
    '02'=>'Fevereiro',
    '03'=>'Março',
    '04'=>'Abril',
    '05'=>'Maio',
    '06'=>'Junho',
    '07'=>'Julho',
    '08'=>'Agosto',
    '09'=>'Setembro',
    '10'=>'Outubro',
    '11'=>'Novembro',
    '12'=>'Dezembro'
);

$mes_saida = $meses[date('m')];

$id = "HISTORICO_PROCESSO_" . $processo . $data_saida;
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);
$id = str_replace(' ', '', $id);

include('../banco-dados/editar_sair.php');
		
}

if($_GET['operacao']=='arquivar'){

$processo = $_GET['processo'];

$pessoa_arquivou = $_SESSION["CPF"];

date_default_timezone_set('America/Bahia');

$data_hoje = date('Y-m-d H:i:s');

$meses = array(
    '01'=>'Janeiro',
    '02'=>'Fevereiro',
    '03'=>'Março',
    '04'=>'Abril',
    '05'=>'Maio',
    '06'=>'Junho',
    '07'=>'Julho',
    '08'=>'Agosto',
    '09'=>'Setembro',
    '10'=>'Outubro',
    '11'=>'Novembro',
    '12'=>'Dezembro'
);

$mes_saida = $meses[date('m')];

$mensagem = 'ARQUIVOU O PROCESSO';

if($_GET['situacao_final']=='Em andamento'){
	$situacao_final = 'Finalizado';
}else if($_GET['situacao_final']=='Finalização em atraso'){
	$situacao_final = 'Finalizado com atraso';
}

$id = "HISTORICO_PROCESSO_" . $processo . $data_hoje;
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);
$id = str_replace(' ', '', $id);

include('../banco-dados/editar_arquivar.php');
		
}
	
		


if($_GET['operacao']=='status'){

$processo = $_GET["processo"];

$status = $_GET["status"];

$pessoa_tramitou = $_SESSION["CPF"];

if($status == "Saiu"){
	$mensagem = "DEU SAÍDA NO PROCESSO";
}else{
	$mensagem = "ARQUIVOU O PROCESSO";
}
 
date_default_timezone_set('America/Bahia');

$data_saida = date('Y-m-d H:i:s');

$meses = array(
    '01'=>'Janeiro',
    '02'=>'Fevereiro',
    '03'=>'Março',
    '04'=>'Abril',
    '05'=>'Maio',
    '06'=>'Junho',
    '07'=>'Julho',
    '08'=>'Agosto',
    '09'=>'Setembro',
    '10'=>'Outubro',
    '11'=>'Novembro',
    '12'=>'Dezembro'
);

$mes_saida = $meses[date('m')];

$id = "HISTORICO_PROCESSO_" . $processo . $data_saida;
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);
$id = str_replace(' ', '', $id);

include('../banco-dados/editar_status.php');
		
}

if($_GET['operacao']=='concluir'){

$processo = $_GET['processo'];


	if($_GET['anterior']=='Análise em atraso'){
	
	$situacao = 'Concluído com atraso';	
	$mensagem = "CONCLUIU O PROCESSO, PORÉM COM ATRASO.";

	}else{
	
	$situacao = 'Concluído';
	$mensagem = "CONCLUIU O PROCESSO.";
	}

$pessoa_concluiu = $_SESSION["CPF"];


date_default_timezone_set('America/Bahia');

$data_hoje = date('Y-m-d H:i:s');

$id = "HISTORICO_PROCESSO_" . $processo . $data_hoje;
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);
$id = str_replace(' ', '', $id);


include('../banco-dados/editar_situacao.php');
		
}

if($_GET['operacao']=='finalizar'){

$processo = $_GET['processo'];


	if($_GET['anterior']=='Finalização em atraso'){
	
	$situacao = 'Finalizado com atraso';
    $mensagem = "FINALIZOU O PROCESSO, PORÉM COM ATRASO.";

	}else{
	
	$situacao = 'Finalizado';
	$mensagem = "FINALIZOU O PROCESSO";
	}

$pessoa_concluiu = $_SESSION["CPF"];

date_default_timezone_set('America/Bahia');

$data_hoje = date('Y-m-d H:i:s');

$id = "HISTORICO_PROCESSO_" . $processo . $data_hoje;
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);
$id = str_replace(' ', '', $id);

include('../banco-dados/editar_situacao_final.php');
		
}


if($_GET['operacao']=='prazo'){

$processo = $_GET["processo"];

$prazo = $_POST["prazo"];

$prazo_final = $_GET["prazo_final"];

date_default_timezone_set('America/Bahia');

$data_entrada = $_GET["entrada"];

$data_hoje = date('Y-m-d H:i:s');
$data = date('Y-m-d');

$id = $processo . $data_hoje;
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);
$id = str_replace(' ', '', $id);

$pessoa_prazo = $_SESSION['CPF'];

$mensagem = 'ATUALIZOU O PRAZO PARA ANÁLISE DO PROCESSO PARA '. date('d/m/Y', strtotime($prazo));

if($prazo >= $data and $prazo <= $prazo_final){
	include('../banco-dados/editar_prazo_responsavel.php');
}else if($prazo < $data){
	echo "<script>history.back();</script>";
	echo "<script>alert('O prazo não pode ser menor que a data de hoje.')</script>"; 
}else if($prazo_final == null){
	echo "<script>history.back();</script>";
	echo "<script>alert('Defina primeiro o prazo final para ser arquivado ou sair do órgão.')</script>"; 
}else if($prazo > $prazo_final){
	echo "<script>history.back();</script>";
	echo "<script>alert('O prazo para o servidor e superintendente analisarem o processo não pode ser maior que o prazo para arquivamento ou saída do processo.')</script>"; 
}
	
}


if($_GET['operacao']=='prazofinal'){

$processo = $_GET["processo"];

$prazo = $_GET["prazo"];

$prazo_final = $_POST["prazo_final"];

date_default_timezone_set('America/Bahia');

$data_entrada = $_GET["entrada"];

$data_hoje = date('Y-m-d H:i:s');
$data = date('Y-m-d');

$id = $processo . $data_hoje;
$id = str_replace('.', '', $id);
$id = str_replace('-', '', $id);
$id = str_replace(':', '', $id);
$id = str_replace(' ', '', $id);

$pessoa_prazo = $_SESSION['CPF'];

$mensagem = 'ATUALIZOU O PRAZO PARA ARQUIVAMENTO OU SAÍDA PARA '. date('d/m/Y', strtotime($prazo_final));

if($prazo_final < $data or $prazo_final < $data_entrada){
	echo "<script>history.back();</script>";
	echo "<script>alert('O prazo final deve ser maior que a data de hoje ou da data de entrada do processo.')</script>"; 
}else if($prazo > $prazo_final){
	echo "<script>history.back();</script>";
	echo "<script>alert('O prazo para o servidor e superintendente analisarem o processo não pode ser maior que o prazo para arquivamento ou saída do processo.')</script>"; 
}else{
	include('../banco-dados/editar_prazo_final_responsavel.php');
}



}




?>