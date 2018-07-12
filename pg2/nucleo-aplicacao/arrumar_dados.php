<?php

function retira_caracteres_especiais($nome_arquivo){
	
	$nome_arquivo = str_replace(" ","_",$nome_arquivo);
	
	$nome_arquivo = str_replace("á","a",$nome_arquivo);
	$nome_arquivo = str_replace("Á","A",$nome_arquivo);
	$nome_arquivo = str_replace("à","a",$nome_arquivo);
	$nome_arquivo = str_replace("ã","a",$nome_arquivo);
	$nome_arquivo = str_replace("Ã","A",$nome_arquivo);
	$nome_arquivo = str_replace("â","a",$nome_arquivo);
	$nome_arquivo = str_replace("ä","a",$nome_arquivo);
	
	$nome_arquivo = str_replace("é","e",$nome_arquivo);
	$nome_arquivo = str_replace("è","e",$nome_arquivo);
	$nome_arquivo = str_replace("ê","e",$nome_arquivo);
	$nome_arquivo = str_replace("ë","e",$nome_arquivo);
	
	$nome_arquivo = str_replace("í","i",$nome_arquivo);
	$nome_arquivo = str_replace("ì","i",$nome_arquivo);
	$nome_arquivo = str_replace("î","i",$nome_arquivo);
	$nome_arquivo = str_replace("ï","i",$nome_arquivo);
	
	$nome_arquivo = str_replace("ó","o",$nome_arquivo);
	$nome_arquivo = str_replace("ò","o",$nome_arquivo);
	$nome_arquivo = str_replace("õ","o",$nome_arquivo);
	$nome_arquivo = str_replace("ô","o",$nome_arquivo);
	$nome_arquivo = str_replace("ö","o",$nome_arquivo);
	
	$nome_arquivo = str_replace("ú","u",$nome_arquivo);
	$nome_arquivo = str_replace("ù","u",$nome_arquivo);
	$nome_arquivo = str_replace("û","u",$nome_arquivo);
	$nome_arquivo = str_replace("ü","u",$nome_arquivo);
	
	$nome_arquivo = str_replace("ç","c",$nome_arquivo);
	
	$nome_arquivo = str_replace("Á","A",$nome_arquivo);
	$nome_arquivo = str_replace("À","A",$nome_arquivo);
	$nome_arquivo = str_replace("Ã","A",$nome_arquivo);
	$nome_arquivo = str_replace("Â","A",$nome_arquivo);
	$nome_arquivo = str_replace("Ä","A",$nome_arquivo);
	
	$nome_arquivo = str_replace("É","E",$nome_arquivo);
	$nome_arquivo = str_replace("È","E",$nome_arquivo);
	$nome_arquivo = str_replace("Ê","E",$nome_arquivo);
	$nome_arquivo = str_replace("Ë","E",$nome_arquivo);
	
	$nome_arquivo = str_replace("Í","I",$nome_arquivo);
	$nome_arquivo = str_replace("Ì","I",$nome_arquivo);
	$nome_arquivo = str_replace("Î","I",$nome_arquivo);
	$nome_arquivo = str_replace("Ï","I",$nome_arquivo);
	
	$nome_arquivo = str_replace("Ó","O",$nome_arquivo);
	$nome_arquivo = str_replace("Ò","O",$nome_arquivo);
	$nome_arquivo = str_replace("Õ","O",$nome_arquivo);
	$nome_arquivo = str_replace("Ô","O",$nome_arquivo);
	$nome_arquivo = str_replace("Ö","O",$nome_arquivo);
	
	$nome_arquivo = str_replace("Ú","U",$nome_arquivo);
	$nome_arquivo = str_replace("Ù","U",$nome_arquivo);
	$nome_arquivo = str_replace("Û","U",$nome_arquivo);
	$nome_arquivo = str_replace("Ü","U",$nome_arquivo);
	
	$nome_arquivo = str_replace("Ç","C",$nome_arquivo);
	
	return $nome_arquivo;
		
}

function arruma_id($id){
	
	$id = str_replace('.', '', $id);
	$id = str_replace('-', '', $id);
	$id = str_replace(':', '', $id);
	$id = str_replace(' ', '', $id);
	
	return $id;
	
}



function arruma_numero($numero){

  return number_format($numero,2,',','.');

 }


function arruma_data($data){
	
	if($data == null or $data == '0000-00-00' or $data == '0000-00-00 00:00:00'){
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

function arruma_numero_mes($data){
	
	
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
	

	return $data;

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