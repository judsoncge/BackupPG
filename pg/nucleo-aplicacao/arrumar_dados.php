<?php
function arruma_numero($numero){

$numero = str_replace('.', ',', $numero);

if (!strpos($numero,  ',')) {
	$numero = $numero . ",00";
  }
  
  return $numero;
}


function arruma_data($data){
	
	if($data == null or $data == '0000-00-00'){
		$data = "Sem data";
	}else{
		$data = date("d/m/Y", strtotime($data));
	}

	return $data;

}


function arruma_data_ano($data){
	
	if($data == null or $data == '0000-00-00'){
		$data = "Sem data";
	}else{
		$data = date("Y", strtotime($data));
	}

	return $data;

}

function arruma_data_mes($data){
	
	if($data == null or $data == '0000-00-00'){
		$data = "Sem data";
	}else{
		$data = date("m", strtotime($data));
		if($data == 1){
			$data = "Janeiro";
		}else if($data == 2){
			$data = "Fevereiro";
		}else if($data == 3){
			$data = "Março";
		}else if ($data == 4){
			$data = "Abril";
		}else if ($data == 5){
			$data = "Maio";
		}else if($data == 6){
			$data = "Junho";
		}else if($data == 7){
			$data = "Julho";
		}else if($data == 8){
			$data = "Agosto";
		}else if($data == 9){
			$data = "Setembro";
		}else if($data == 10){
			$data = "Outubro";
		}else if($data == 11){
			$data = "Novembro";
		}else if($data == 12){
			$data = "Dezembro";
		}else{
			$data = "Mês inválido!";
		}
	}

	return $data;

}

function arruma_data_mes2($mes){
	
	if($mes == null or $mes == '0000-00-00'){
		$mes = "Sem data";
	}else{
		
		if($mes == 1){
			$mes = "Janeiro";
		}else if($mes == 2){
			$mes = "Fevereiro";
		}else if($mes == 3){
			$mes = "Março";
		}else if ($mes == 4){
			$mes = "Abril";
		}else if ($mes == 5){
			$mes = "Maio";
		}else if($mes == 6){
			$mes = "Junho";
		}else if($mes == 7){
			$mes = "Julho";
		}else if($mes == 8){
			$mes = "Agosto";
		}else if($mes == 9){
			$mes = "Setembro";
		}else if($mes == 10){
			$mes = "Outubro";
		}else if($mes == 11){
			$mes = "Novembro";
		}else if($mes == 12){
			$mes = "Dezembro";
		}else{
			$mes = "Mês inválido!";
		}
	}

	return $mes;

}

function arruma_prioridade($prioridade){
	
	$retorno = "";
	
	 if($prioridade == 1){
		$retorno = 'Urgente'; 
	 }else if($prioridade == 2){
		 $retorno = 'Alta'; 
	 }else if($prioridade == 3){
		 $retorno = 'Média'; 
	 }else if($prioridade == 4){
		 $retorno = 'Baixa'; 
	 }
	return $retorno;

}

function arruma_data2($data){
	
	if($data == "0000-00-00 00:00:00"){
		$data = "Sem data";
	}else{
		$data = date("d/m/Y H:i:s", strtotime($data));
	}

	return $data;

}

function arruma_CPF($CPF){
	
	$CPF = str_replace('-', '', $CPF);
	$CPF = str_replace('.', '', $CPF);
	
	return $CPF;
	
}

function arruma_classificacao_contabil($classificacao_contabil){
	
    $classificacao_contabil = str_replace('.', '', $classificacao_contabil);
	
	return $classificacao_contabil;
	
}

function arruma_numero_processo($numero_processo){
	
    $numero_processo = str_replace(" ","",$numero_processo);
	
	$numero_processo = str_replace("/","",$numero_processo);
	
	return $numero_processo;
	
}


?>