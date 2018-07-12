<?php
	//retirada de http://codigofonte.uol.com.br/codigos/funcao-que-calcula-os-feriados-brasileiros-em-php
	function dias_feriados($ano = null)
	{
		if ($ano === null)
		{
		$ano = intval(date('Y'));
		}

		$pascoa     = easter_date($ano); // Limite de 1970 ou após 2037 da easter_date PHP consulta http://www.php.net/manual/pt_BR/function.easter-date.php
		$dia_pascoa = date('j', $pascoa);
		$mes_pascoa = date('n', $pascoa);
		$ano_pascoa = date('Y', $pascoa);

		$feriados = array(
		// Tatas Fixas dos feriados Nacionail Basileiras
		mktime(0, 0, 0, 1,  1,   $ano), // Confraternização Universal - Lei nº 662, de 06/04/49
		mktime(0, 0, 0, 4,  21,  $ano), // Tiradentes - Lei nº 662, de 06/04/49
		mktime(0, 0, 0, 5,  1,   $ano), // Dia do Trabalhador - Lei nº 662, de 06/04/49
		mktime(0, 0, 0, 9,  7,   $ano), // Dia da Independência - Lei nº 662, de 06/04/49
		mktime(0, 0, 0, 10,  12, $ano), // N. S. Aparecida - Lei nº 6802, de 30/06/80
		mktime(0, 0, 0, 11,  2,  $ano), // Todos os santos - Lei nº 662, de 06/04/49
		mktime(0, 0, 0, 11, 15,  $ano), // Proclamação da republica - Lei nº 662, de 06/04/49
		mktime(0, 0, 0, 12, 25,  $ano), // Natal - Lei nº 662, de 06/04/49

		// These days have a date depending on easter
		mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 48,  $ano_pascoa),//2ºferia Carnaval
		mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 47,  $ano_pascoa),//3ºferia Carnaval	
		mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 2 ,  $ano_pascoa),//6ºfeira Santa  
		mktime(0, 0, 0, $mes_pascoa, $dia_pascoa     ,  $ano_pascoa),//Pascoa
		mktime(0, 0, 0, $mes_pascoa, $dia_pascoa + 60,  $ano_pascoa),//Corpus Cirist
		);

		sort($feriados);

		return $feriados;
	}
	
	
	function retorna_data($data, $dia) {
		$nova_data = '';
		$mudar_data = '-';
	if (cal_days_in_month(CAL_GREGORIAN, date('m',$data), date('Y', $data)) < $dia){
		
		$nova_data = strtotime( date("Y",$data).'-'.date("m",$data).'-'.cal_days_in_month(CAL_GREGORIAN, date('m',$data),date('Y', $data)));
	} else {
		$nova_data = strtotime( date("Y",$data).'-'.date("m",$data).'-'.$dia);	
	}	
	$i = 0;
	for($i = 0; $i < 5 && ( date('w', $nova_data) == 0 || date('w', $nova_data) == 6 || in_array($nova_data, dias_feriados($ano_))); $i++ )
	{
		if (date('d', $nova_data) == 1) {
			$mudar_data = '+';
		}
		$nova_data = strtotime($mudar_data."1 day", $nova_data);
		
	}
	return $nova_data;
	}	
	
?>