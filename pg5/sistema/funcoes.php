<?php

ini_set('max_execution_time', 10000);

date_default_timezone_set('America/Bahia');

$ROOT = ' http://'.$_SERVER['SERVER_NAME'].'/';

//Funções diversas de funções

function somar_data($data, $dias, $meses = 0, $ano = 0){
   $data = explode("-", $data);
   $nova_data = date("Y-m-d", mktime(0, 0, 0, $data[1] + $meses, $data[2] + $dias, $data[0] + $ano) );
   return $nova_data;
}

function retorna_data_datetime_local($tabela, $nome_campo_data, $id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT DATE_FORMAT($nome_campo_data, '%Y-%m-%dT%H:%i') AS data FROM $tabela WHERE ID='$id'");	

	$data = mysqli_fetch_row($resultado);
	
	return $data[0];	
	
}

function retorna_nome_orgao($orgao, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_ORGAO FROM tb_orgaos WHERE ID='$orgao'");
	
	$nome = mysqli_fetch_row($resultado);
	
	return $nome[0];

}



function retorna_campos_permissoes_visualizar($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'tb_permissoes' AND COLUMN_NAME LIKE 'VISUALIZAR_%'");

	return $resultado;

}

function retorna_campos_permissoes_gerenciar($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'tb_permissoes' AND COLUMN_NAME LIKE 'GERENCIAR_%'");

	return $resultado;

}

function retorna_campos_permissoes_diversas($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'tb_permissoes' AND COLUMN_NAME NOT LIKE 'VISUALIZAR_%' AND COLUMN_NAME NOT LIKE 'GERENCIAR_%' AND COLUMN_NAME NOT LIKE 'ID%'");

	return $resultado;

}

function retorna_campos_permissoes($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'tb_permissoes' AND COLUMN_NAME NOT LIKE 'ID%'");

	return $resultado;
	
}

function cadastrar_anexo($file, $caminho){
	
	//verifica se de fato é um arquivo que foi anexado
	if(is_file($file['tmp_name'])){

		//a variavel recebe o nome do arquivo anexado pelo usuário
		$novo_anexo = $file['name'];
		
		//a variavel recebe o novo nome sem os caracteres especiais 
		$novo_anexo = retira_caracteres_especiais($novo_anexo);
		
		//verifica se este anexo já está gravado na pasta	
		if(file_exists($caminho.$novo_anexo)){ 
				
				//se sim, coloca um número na frente do anexo, para diferenciar o nome
				$a = 1;
				while(file_exists($caminho."[$a]".$novo_anexo."")){
				$a++;
				}
				//a variavel recebe [1]nome caso já tenha um gravado, [2]nome caso já tenham dois gravados na pasta, e assim por diante
				$novo_anexo = "[".$a."]".$novo_anexo;
			}
		
		//salva o arquivo na pasta de acordo com o tipo de anexo
		move_uploaded_file($file['tmp_name'], $caminho.$novo_anexo);
		
		return $novo_anexo;
			
	}

}


function retira_caracteres_especiais($string){
	
	$string = str_replace(" ","-",$string);
	
	$string = str_replace("á","a",$string);
	$string = str_replace("Á","A",$string);
	$string = str_replace("à","a",$string);
	$string = str_replace("ã","a",$string);
	$string = str_replace("Ã","A",$string);
	$string = str_replace("â","a",$string);
	$string = str_replace("ä","a",$string);
	
	$string = str_replace("é","e",$string);
	$string = str_replace("è","e",$string);
	$string = str_replace("ê","e",$string);
	$string = str_replace("ë","e",$string);
	
	$string = str_replace("í","i",$string);
	$string = str_replace("ì","i",$string);
	$string = str_replace("î","i",$string);
	$string = str_replace("ï","i",$string);
	
	$string = str_replace("ó","o",$string);
	$string = str_replace("ò","o",$string);
	$string = str_replace("õ","o",$string);
	$string = str_replace("ô","o",$string);
	$string = str_replace("ö","o",$string);
	
	$string = str_replace("ú","u",$string);
	$string = str_replace("ù","u",$string);
	$string = str_replace("û","u",$string);
	$string = str_replace("ü","u",$string);
	
	$string = str_replace("ç","c",$string);
	
	$string = str_replace("Á","A",$string);
	$string = str_replace("À","A",$string);
	$string = str_replace("Ã","A",$string);
	$string = str_replace("Â","A",$string);
	$string = str_replace("Ä","A",$string);
	
	$string = str_replace("É","E",$string);
	$string = str_replace("È","E",$string);
	$string = str_replace("Ê","E",$string);
	$string = str_replace("Ë","E",$string);
	
	$string = str_replace("Í","I",$string);
	$string = str_replace("Ì","I",$string);
	$string = str_replace("Î","I",$string);
	$string = str_replace("Ï","I",$string);
	
	$string = str_replace("Ó","O",$string);
	$string = str_replace("Ò","O",$string);
	$string = str_replace("Õ","O",$string);
	$string = str_replace("Ô","O",$string);
	$string = str_replace("Ö","O",$string);
	
	$string = str_replace("Ú","U",$string);
	$string = str_replace("Ù","U",$string);
	$string = str_replace("Û","U",$string);
	$string = str_replace("Ü","U",$string);
	
	$string = str_replace("Ç","C",$string);
	
	return $string;
		
}

//Funções de componentes em geral


function retorna_informacoes($tabela, $id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM $tabela WHERE ID='$id'");
	
	$informacoes = mysqli_fetch_array($resultado);
	
	return $informacoes;
	
}

//Funções de órgãos

function retorna_orgaos($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_orgaos");
	
	return $resultado;
		
}

//Funções de notificações

function retorna_notificacoes_servidor($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_notificacoes WHERE ID_SERVIDOR_NOTIFICADO = '$id' ORDER BY NM_STATUS, DT_NOTIFICACAO DESC");
	
	return $resultado;
	
}

function marcar_visualizada_notificacao($id, $conexao_com_banco){
	
	$data_atual = date('Y-m-d H:i:s');
	
	mysqli_query($conexao_com_banco, "UPDATE tb_notificacoes SET NM_STATUS = 'VISUALIZADA', DT_VISUALIZACAO = '$data_atual' WHERE ID='$id'");
	
}

function retorna_quantidade_notificacoes_nao_visualizadas_usuario($id, $conexao_com_banco){

	$resultado = mysqli_query($conexao_com_banco, "SELECT count(*) FROM tb_notificacoes WHERE ID_SERVIDOR_NOTIFICADO='$id' AND NM_STATUS = 'NÃO VISUALIZADA'");
	
	$quantidade = mysqli_fetch_row($resultado);
	
	return $quantidade[0];
	
}


//Funções de servidores

function retorna_servidores($conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores order by NM_SERVIDOR");
	
	return $resultado;
	
}

function retorna_servidores_status($status, $conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores WHERE NM_STATUS = '$status' order by NM_SERVIDOR");
	
	return $resultado;
	
}

function retorna_servidores_status_filtro($status, $conexao_com_banco){
	
	
	$id = $_SESSION['id'];
	
	$funcao = $_SESSION["funcao"];

	$setor = $_SESSION["setor"];

	$setor_sub = $_SESSION['setor-subordinado'];
	
	$setor_sup = retorna_setor_superior($setor, $conexao_com_banco);

	if($funcao=='PROTOCOLO' or $funcao=='SUPERINTENDENTE' or $funcao=='ASSESSOR TÉCNICO' or $funcao=='GABINETE' or $funcao=='COMUNICAÇÃO' or $funcao=='TÉCNICO ANALISTA CORREÇÃO'){ 

		$resultado = mysqli_query($conexao_com_banco, 

		"SELECT ID, NM_SERVIDOR FROM tb_servidores WHERE NM_STATUS = '$status' AND (ID_SETOR = '$setor' OR ID_SETOR = '$setor_sub' OR ID_SETOR = '$setor_sup') order by NM_SERVIDOR"
		
		);

	}elseif($funcao=='TÉCNICO ANALISTA' or $funcao=='OUTRO'){	
		
		$resultado = mysqli_query($conexao_com_banco, 

		"SELECT ID, NM_SERVIDOR FROM tb_servidores WHERE NM_STATUS = '$status' and ID='$id' order by NM_SERVIDOR"
		
		);


	}elseif($funcao=='CONTROLADOR' or $funcao=='CHEFE DE GABINETE' or $funcao=='TI'){
		
		$resultado = mysqli_query($conexao_com_banco, 

		"SELECT ID, NM_SERVIDOR FROM tb_servidores WHERE NM_STATUS = '$status' order by NM_SERVIDOR"
		
		);

	}
	
	return $resultado;
	
}


function retorna_nome_servidor($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_SERVIDOR FROM tb_servidores WHERE ID='$id'");

	$nome = mysqli_fetch_row($resultado);
	
	return $nome[0];
	
	
}

function retorna_funcao_servidor($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_FUNCAO FROM tb_servidores WHERE ID='$id'");

	$funcao = mysqli_fetch_row($resultado);
	
	return $funcao[0];
	
	
}

function retorna_nome_completo_servidor($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_SERVIDOR FROM tb_servidores WHERE ID='$id'");

	$nome = mysqli_fetch_row($resultado);
	
	return $nome[0] . " " . $nome[1];
	
	
}

function retorna_setor_servidor($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT ID_SETOR FROM tb_servidores WHERE ID='$id'");

	$setor = mysqli_fetch_row($resultado);
	
	return $setor[0];
	
	
}

function retorna_cargo_servidor($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_CARGO FROM tb_servidores WHERE ID='$id'");

	$cargo = mysqli_fetch_row($resultado);
	
	return $cargo[0];

}




//Funções de setores

function retorna_setores($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_setores");

	return $resultado;
	
}

function retorna_setores_filtro($conexao_com_banco){
	
	$id = $_SESSION['id'];
	
	$funcao = $_SESSION["funcao"];

	$setor = $_SESSION["setor"];

	$setor_sub = $_SESSION['setor-subordinado'];
	
	$setor_sup = retorna_setor_superior($setor, $conexao_com_banco);

	if($funcao=='PROTOCOLO' or $funcao=='SUPERINTENDENTE' or $funcao=='ASSESSOR TÉCNICO' or $funcao=='GABINETE' or $funcao=='COMUNICAÇÃO' or $funcao=='TÉCNICO ANALISTA CORREÇÃO'){ 

		$resultado = mysqli_query($conexao_com_banco, 

		"SELECT ID, NM_SETOR FROM tb_setores WHERE ID='$setor' or ID='$setor_sub' or ID='$setor_sup'"
		
		);

	}elseif($funcao=='TÉCNICO ANALISTA' or $funcao=='OUTRO'){	
		
		$resultado = mysqli_query($conexao_com_banco, 

		"SELECT ID, NM_SETOR FROM tb_setores WHERE ID='$setor'"
		
		);


	}elseif($funcao=='CONTROLADOR' or $funcao=='CHEFE DE GABINETE' or $funcao=='TI'){
		
		$resultado = mysqli_query($conexao_com_banco, 

		"SELECT ID, NM_SETOR FROM tb_setores"
		
		);

	}
	
	return $resultado;
	
}

function retorna_sigla_setor($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT CD_SETOR FROM tb_setores WHERE ID='$id'");

	$nome = mysqli_fetch_row($resultado);
	
	return $nome[0];
	
	
}

function retorna_nome_setor($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_SETOR FROM tb_setores WHERE ID='$id'");

	$nome = mysqli_fetch_row($resultado);
	
	return $nome[0];
	
}

function retorna_setor_superior($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT ID FROM tb_setores WHERE ID_SETOR_SUBORDINADO='$id'");

	$setor_superior = mysqli_fetch_row($resultado);
	
	return $setor_superior[0];

}

//Funções de assuntos

function retorna_assuntos($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_assuntos_processos ORDER BY NM_ASSUNTO");
	
	return $resultado;
	
}

function retorna_nome_assunto($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_ASSUNTO FROM tb_assuntos_processos WHERE ID='$id'");
	
	$nome = mysqli_fetch_row($resultado);
	
	return $nome[0];

}

function retorna_dias_prazo_assunto($conexao_com_banco, $id){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NR_DIAS_PRAZO FROM tb_assuntos_processos WHERE ID='$id'");	
	
	$dias = mysqli_fetch_row($resultado);
	
	return $dias[0];
	
}

//Funções de processos

function retorna_lista_solicitacoes_sobrestado($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_processos_sobrestados ORDER BY DT_SOLICITACAO");
	
	return $resultado;

}

function retorna_quantidade_solicitacoes_sobrestado($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT count(*) FROM tb_processos_sobrestados WHERE NM_STATUS = 'SOLICITADO'");
	
	$quantidade = mysqli_fetch_row($resultado);
	
	return $quantidade[0];
	
}

function retorna_media_dias_processo($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT TRUNCATE(AVG(NR_DIAS), 0) MEDIA FROM tb_processos WHERE NM_STATUS IN ('ARQUIVADO', 'SAIU')");
	
	$media = mysqli_fetch_row($resultado);
	
	return $media[0];
	
}

function retorna_media_dias_por_assunto($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT a.NM_ASSUNTO, TRUNCATE(AVG(p.NR_DIAS), 0) MEDIA FROM tb_processos p, tb_assuntos_processos a WHERE p.ID_ASSUNTO = a.ID AND NM_STATUS IN ('ARQUIVADO', 'SAIU') GROUP BY p.ID_ASSUNTO ORDER BY MEDIA DESC");
	
	return $resultado; 
	
}

function retorna_quantidade_processos_ativos($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT count(*) FROM tb_processos WHERE NM_STATUS IN ('EM ANDAMENTO', 'FINALIZADO PELO SETOR', 'FINALIZADO PELO GABINETE')");

	$quantidade = mysqli_fetch_row($resultado);
	
	return $quantidade[0];
	
}

function retorna_quantidade_processos_ativos_atraso($atraso, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT count(*) FROM tb_processos WHERE NM_STATUS IN ('EM ANDAMENTO', 'FINALIZADO PELO SETOR', 'FINALIZADO PELO GABINETE') AND BL_ATRASADO = $atraso");

	$quantidade = mysqli_fetch_row($resultado);
	
	return $quantidade[0];
	
}

function retorna_quantidade_processos_ativos_setor($setor, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT count(*) FROM tb_processos WHERE NM_STATUS IN ('EM ANDAMENTO', 'FINALIZADO PELO SETOR', 'FINALIZADO PELO GABINETE') AND ID_SETOR_LOCALIZACAO = '$setor'");

	$quantidade = mysqli_fetch_row($resultado);
	
	return $quantidade[0];
	
}

function retorna_quantidade_processos_status($status, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT count(*) FROM tb_processos WHERE NM_STATUS = '$status'");

	$quantidade = mysqli_fetch_row($resultado);
	
	return $quantidade[0];
	
}

function retorna_quantidade_processos_ativos_setores($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT s.CD_SETOR SETOR, count(p.ID) QUANTIDADE FROM tb_processos p, tb_setores s WHERE p.ID_SETOR_LOCALIZACAO = s.ID and p.NM_STATUS IN ('EM ANDAMENTO', 'FINALIZADO PELO SETOR', 'FINALIZADO PELO GABINETE') GROUP BY p.ID_SETOR_LOCALIZACAO");
	
	return $resultado;
	
}

function retorna_quantidade_processos_ativos_setor_atraso($setor, $atraso, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT count(*) FROM tb_processos WHERE NM_STATUS IN ('EM ANDAMENTO', 'FINALIZADO PELO SETOR', 'FINALIZADO PELO GABINETE') AND ID_SETOR_LOCALIZACAO = $setor AND BL_ATRASADO = $atraso");
	
	$quantidade = mysqli_fetch_row($resultado);
	
	return $quantidade[0];
	
	
}

function retorna_quantidade_processos_status_setor($setor, $status, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT count(*) FROM tb_processos WHERE ID_SETOR_LOCALIZACAO = $setor AND NM_STATUS = '$status'");
	
	$quantidade = mysqli_fetch_row($resultado);
	
	return $quantidade[0];
	
}

function retorna_quantidade_processos($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT count(*) FROM tb_processos");

	$quantidade = mysqli_fetch_row($resultado);
	
	return $quantidade[0];
	
}

function retorna_status_processo($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT NM_STATUS FROM tb_processos WHERE ID='$id'");

	$status = mysqli_fetch_row($resultado);
	
	return $status[0];
	
} 

function retorna_id_processo($numero_processo, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT ID FROM tb_processos WHERE CD_PROCESSO='$numero_processo'");	
	
	$id = mysqli_fetch_row($resultado);
	
	return $id[0];
	
}

function retorna_nome_status_processo($status){
	
	if($status){ 
		return "EM ANDAMENTO";
	}elseif($status==2){
		return "ATRASADO";
	}elseif($status==3){
		return "FINALIZADO PELO SETOR";
	}elseif($status==4){
		return "FINALIZADO PELO GABINETE";
	}elseif($status==5){
		return "ARQUIVADO";
	}elseif($status==6){
		return "SAIU";
	}
	
}

function retorna_lista_processos_ativos($conexao_com_banco){
	
	$id = $_SESSION['id'];
	
	$funcao = $_SESSION["funcao"];
	
	$setor = $_SESSION["setor"];
	
	$setor_sub = $_SESSION['setor-subordinado'];
	
	$setor_sup = retorna_setor_superior($setor, $conexao_com_banco);
	
	if($funcao=='PROTOCOLO' or $funcao=='SUPERINTENDENTE' or $funcao=='ASSESSOR TÉCNICO' or $funcao=='GABINETE' or $funcao=='COMUNICAÇÃO' or $funcao=='TÉCNICO ANALISTA CORREÇÃO'){ 
	
		$resultado = mysqli_query($conexao_com_banco, 
	
		"SELECT * FROM tb_processos WHERE (ID_SETOR_LOCALIZACAO='$setor' or ID_SETOR_LOCALIZACAO='$setor_sub' or ID_SETOR_LOCALIZACAO='$setor_sup') and NM_STATUS NOT IN ('ARQUIVADO', 'SAIU') ORDER BY BL_URGENCIA DESC, NR_DIAS DESC"
		
		);
	
	}elseif($funcao=='TÉCNICO ANALISTA' or $funcao=='OUTRO'){	
		
		$resultado = mysqli_query($conexao_com_banco, 
	
		"SELECT * FROM tb_processos WHERE (ID_SERVIDOR_LOCALIZACAO='$id') and NM_STATUS NOT IN ('ARQUIVADO', 'SAIU') ORDER BY BL_URGENCIA DESC, NR_DIAS DESC"
		
		);
	
	
	}elseif($funcao=='CONTROLADOR' or $funcao=='CHEFE DE GABINETE' or $funcao=='TI'){
		
		$resultado = mysqli_query($conexao_com_banco, 
	
		"SELECT * FROM tb_processos WHERE NM_STATUS NOT IN ('ARQUIVADO', 'SAIU') ORDER BY BL_URGENCIA DESC, NR_DIAS DESC"
		
		);
	
	}
	
	
	return $resultado;
		
}

function retorna_lista_processos_recebidos($conexao_com_banco){
	
	$id = $_SESSION['id'];
	
	$setor = $_SESSION["setor"];
	
	$setor_sub = $_SESSION['setor-subordinado'];
	
	$setor_sup = retorna_setor_superior($setor, $conexao_com_banco);
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT p.* FROM tb_tramitacao_processos t, tb_processos p WHERE t.ID_PROCESSO = p.ID AND t.ID_SERVIDOR_DESTINO = $id AND t.BL_RECEBIDO = 0 AND t.ID_SETOR_ORIGEM != '$setor_sub' AND t.ID_SETOR_ORIGEM != '$setor_sup'");
	
	return $resultado;
		
}

function retorna_lista_processos_inativos($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, 
	
	"SELECT * FROM tb_processos WHERE NM_STATUS IN ('ARQUIVADO', 'SAIU') ORDER BY DT_SAIDA desc)");
	
	return $resultado;
		
}


function retorna_recebido_processo($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_tramitacao_processos WHERE BL_RECEBIDO=0 and ID_PROCESSO='$id'");
	
	$recebido = mysqli_num_rows($resultado);
	
	if(!$recebido){
		return true;
	}else{
		return false;
	}
	
	
}

function retorna_responsaveis_processo($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT DISTINCT(ID_SERVIDOR) FROM tb_responsaveis_processos WHERE ID_PROCESSO='$id'");
	
	return $resultado;
	
}

function retorna_responsavel_lider_processo($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT ID_SERVIDOR FROM tb_responsaveis_processos WHERE ID_PROCESSO='$id' AND BL_LIDER=1");
	
	$responsavel = mysqli_fetch_row($resultado);
	
	return $responsavel[0];
	
}

function retorna_tem_tramitacao_processo($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT MAX(ID) FROM tb_tramitacao_processos WHERE ID_PROCESSO='$id'");
	
	$tem = mysqli_affected_rows($conexao_com_banco);
	
	if($tem > 0){
		
		$id = mysqli_fetch_row($resultado);
		
		return $id[0];
		
	}else{
		
		return 0;
	
	}
	
	
}

function retorna_tem_responsavel_processo($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_responsaveis_processos WHERE ID_PROCESSO='$id'");
	
	$tem = mysqli_affected_rows($conexao_com_banco);
	
	if($tem > 0){
		
		return true;
		
	}else{
		
		return false;
	
	}
	
	
}

function retorna_historico_processo($processo, $conexao_com_banco){
		
	$query = "SELECT * FROM tb_historico_processos WHERE ID_PROCESSO='$processo' order by DT_MENSAGEM desc";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
		
	return $resultado;
	
}


function retorna_servidor($id, $conexao_com_banco){
		
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_servidores WHERE ID='$id'");
	
	return $resultado;
	
}

function retorna_servidores_tramitar($conexao_com_banco){
	
	$id = $_SESSION["id"];
	
	$funcao = $_SESSION["funcao"];
	
	$setor = $_SESSION["setor"];
	
	$setor_sub = $_SESSION['setor-subordinado'];
	
	if($funcao=='PROTOCOLO'){ 
	
		$resultado = mysqli_query($conexao_com_banco, 
	
		"SELECT * FROM tb_servidores WHERE NM_FUNCAO IN ('GABINETE') AND NM_STATUS = 'ATIVO' ORDER BY NM_SERVIDOR"
		
		);
	
	
	}elseif($funcao=='GABINETE'){
		
		$resultado = mysqli_query($conexao_com_banco, 
	
		"SELECT * FROM tb_servidores WHERE NM_FUNCAO IN ('ASSESSOR TÉCNICO', 'PROTOCOLO','SUPERINTENDENTE','COMUNICAÇÃO') AND NM_STATUS = 'ATIVO' ORDER BY NM_SERVIDOR"
		
		);
	
	
	}elseif($funcao=='SUPERINTENDENTE' or $funcao=='ASSESSOR TÉCNICO'){
		
		$resultado = mysqli_query($conexao_com_banco, 
	
		"SELECT * FROM tb_servidores WHERE (ID_SETOR='$setor' OR ID_SETOR='$setor_sub' OR NM_FUNCAO='GABINETE' OR NM_FUNCAO = 'SUPERINTENDENTE') AND NM_STATUS = 'ATIVO' ORDER BY NM_SERVIDOR"
		
		);
	
	}elseif($funcao=='TÉCNICO ANALISTA'){
		
		$setor_superior = retorna_setor_superior($setor, $conexao_com_banco);
		
		$resultado = mysqli_query($conexao_com_banco, 
	
		"SELECT * FROM tb_servidores WHERE NM_FUNCAO IN ('SUPERINTENDENTE', 'ASSESSOR TÉCNICO', 'TÉCNICO ANALISTA CORREÇÃO') AND (ID_SETOR='$setor_superior' or ID_SETOR='$setor') AND NM_STATUS = 'ATIVO' ORDER BY NM_SERVIDOR"
		
		);
	
	}elseif($funcao=='TÉCNICO ANALISTA CORREÇÃO'){
		
		$setor_superior = retorna_setor_superior($setor, $conexao_com_banco);
		
		$resultado = mysqli_query($conexao_com_banco, 
	
		"SELECT * FROM tb_servidores WHERE ID_SETOR='$setor_superior' or ID_SETOR = '$setor' AND NM_STATUS = 'ATIVO' ORDER BY NM_SERVIDOR"	
		
		);
	
	}elseif($funcao=='CONTROLADOR' or $funcao=='CHEFE DE GABINETE' or $funcao=='COMUNICACAO' or $funcao=='TI'){
		
		$setor_superior = retorna_setor_superior($setor, $conexao_com_banco);
		
		$resultado = mysqli_query($conexao_com_banco, 
	
		"SELECT * FROM tb_servidores WHERE NM_STATUS = 'ATIVO' ORDER BY NM_SERVIDOR"
		
		);
	
	}
	
	
	return $resultado;
	
}

function retorna_podem_ser_responsaveis_processo($processo, $conexao_com_banco){
		
	$setor = $_SESSION['setor'];
	
	$setor_sub = $_SESSION['setor-subordinado'];
		
	$query = "SELECT ID, NM_SERVIDOR FROM tb_servidores WHERE (ID_SETOR='$setor' or ID_SETOR='$setor_sub') and ID not in(SELECT ID_SERVIDOR FROM tb_responsaveis_processos WHERE ID_PROCESSO='$processo') and NM_STATUS = 'ATIVO' order by NM_SERVIDOR";

	$resultado = mysqli_query($conexao_com_banco, $query);
		
	return $resultado;
	
}

function retorna_servidor_origem($id_tramitacao, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT ID_SERVIDOR_ORIGEM FROM tb_tramitacao_processos WHERE ID='$id_tramitacao'");
	
	$origem = mysqli_fetch_row($resultado);
	
	return $origem[0];
	
}

function retorna_lista_nao_lideres_processo($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT r.ID_SERVIDOR, s.NM_SERVIDOR FROM tb_responsaveis_processos r, tb_servidores s WHERE r.ID_SERVIDOR = s.ID AND r.BL_LIDER = 0 AND NM_STATUS = 'ATIVO' AND r.ID_PROCESSO='$id'");
	
	return $resultado;
	
}

function retorna_processos_apensados($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT ID_PROCESSO_APENSADO FROM tb_processos_apensados WHERE ID_PROCESSO_MAE = '$id'");
	
	return $resultado;
		
}

function retorna_numero_processo($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT CD_PROCESSO FROM tb_processos WHERE ID='$id'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_processo_mae($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT ID_PROCESSO_MAE FROM tb_processos_apensados WHERE ID_PROCESSO_APENSADO='$id'");
	
	$mae = mysqli_fetch_row($resultado);
	
	return $mae[0];
	
	
}

function retorna_processos_apensar($id, $conexao_com_banco){
	
	$servidor = $_SESSION['id'];
	
	if($_SESSION['funcao'] == 'TI'){
		
		$resultado = mysqli_query($conexao_com_banco, "SELECT ID, CD_PROCESSO FROM tb_processos WHERE (ID!='$id' and NM_STATUS!='ARQUIVADO' and NM_STATUS!='SAIU') ORDER BY CD_PROCESSO, BL_URGENCIA DESC");
		
	}else{
		
		$resultado = mysqli_query($conexao_com_banco, "SELECT ID, CD_PROCESSO FROM tb_processos WHERE (ID!='$id' and NM_STATUS!='ARQUIVADO' and NM_STATUS!='SAIU') and (ID_SERVIDOR_LOCALIZACAO = '$servidor') ORDER BY BL_URGENCIA DESC");
		
	}
	
	
	
	
	return $resultado;
	
}

function retorna_prazo_processo($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT DT_PRAZO FROM tb_processos WHERE ID='$id'");
	
	$prazo = mysqli_fetch_row($resultado);
	
	return $prazo[0];
	
}

function retorna_boleano_filho($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_processos_apensados WHERE ID_PROCESSO_APENSADO='$id'");
	
	$n = mysqli_affected_rows($conexao_com_banco);
	
	if($n > 0){
		return true;
	}else{
		return false;
	}
	
}

function retorna_maior_prazo_apensados($id, $apensados, $conexao_com_banco){
	
	$ids_query = "('$id',";
	
	for ($i=0;$i<count($apensados);$i++){
		
		$ids_query .= "'$apensados[$i]',";
	}
	
	$ids_query .= ")";
	
	//tirando a virgula da ultima data na query. ex: ('data1', 'data2', 'data3',) fica ('data1', 'data2', 'data3')
	$ids_query = str_replace(",)", ")", $ids_query);
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT MAX(DT_PRAZO) FROM tb_processos WHERE ID IN $ids_query");
	
	$maior_prazo = mysqli_fetch_row($resultado);
	
	return $maior_prazo[0];
	
}

function retorna_documentos_processo($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_documentos WHERE ID_PROCESSO = '$id' ORDER BY DT_CRIACAO");
	
	return $resultado;
	
}

function retorna_assunto_processo($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT ID_ASSUNTO FROM tb_processos WHERE ID = '$id'");
	
	$assunto = mysqli_fetch_row($resultado);
	
	return $assunto[0];
	
}

function retorna_setor_finalizou($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT s.ID_SETOR, MAX(hp.DT_MENSAGEM) FROM tb_servidores s, tb_historico_processos hp WHERE s.ID = hp.ID_SERVIDOR and hp.ID_PROCESSO='$id' and hp.NM_ACAO='FINALIZAÇÃO'"); 
	
	$setor = mysqli_fetch_row($resultado);
	
	return $setor[0];
	
}

function retorna_solicitacao_sobrestado_status($id, $status, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT ID, ID_SERVIDOR_SOLICITANTE, NM_JUSTIFICATIVA FROM tb_processos_sobrestados WHERE NM_STATUS = '$status' AND ID_PROCESSO = '$id'");
	
	$assunto = mysqli_fetch_row($resultado);
	
	return $assunto;
	
}

//Funções de arquivos

function retorna_lista_arquivos_status($status, $conexao_com_banco){
	
	$servidor = $_SESSION['id'];
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_arquivos WHERE NM_STATUS = '$status' AND (ID_SERVIDOR_CRIACAO = '$servidor' OR ID_SERVIDOR_ENVIADO = '$servidor') ORDER BY DT_CRIACAO desc");
	
	return $resultado;
 
}


function retorna_lista_arquivos_ativos($conexao_com_banco){
	
	$servidor = $_SESSION['id'];
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_arquivos WHERE NM_STATUS IN ('ATIVO', 'APROVADO') AND (ID_SERVIDOR_CRIACAO = '$servidor' OR ID_SERVIDOR_ENVIADO = '$servidor') ORDER BY DT_CRIACAO desc");
	
	return $resultado;
 
}

//Funções de Função

function retorna_funcoes($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_funcoes");
	
	return $resultado;
	
}

//Funções de Chamados


function retorna_numero_chamados_resolvidos_sem_nota($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_chamados WHERE NM_STATUS='RESOLVIDO' and NM_AVALIACAO='SEM AVALIAÇÃO' and ID_SERVIDOR_REQUISITANTE='$id'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_chamados_resolvidos_com_nota($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM tb_chamados WHERE NM_STATUS='RESOLVIDO' and NM_AVALIACAO!='SEM AVALIAÇÃO'");
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_chamados_ativos($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_chamados WHERE NM_STATUS != 'ENCERRADO' ORDER BY FIELD(NM_STATUS, 'ABERTO', 'RESOLVIDO'), FIELD(NM_AVALIACAO, 'SEM AVALIAÇÃO', 'PÉSSIMO', 'RUIM', 'REGULAR', 'BOM', 'EXCELENTE'), DT_ABERTURA desc");
	
	return $resultado;

}

function retorna_chamados_ativos_servidor($id, $conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_chamados WHERE NM_STATUS != 'ENCERRADO' AND	ID_SERVIDOR_REQUISITANTE = '$id' ORDER BY DT_ABERTURA desc, FIELD(NM_STATUS, 'RESOLVIDO', 'ABERTO'), FIELD(NM_AVALIACAO, 'SEM AVALIACAO', 'PÉSSIMO', 'RUIM', 'REGULAR', 'BOM', 'EXCELENTE')");
	
	return $resultado;

}

function retorna_chamados_encerrados($conexao_com_banco){
	
	$resultado = mysqli_query($conexao_com_banco, "SELECT * FROM tb_chamados WHERE NM_STATUS = 'ENCERRADO' ORDER BY DT_ENCERRAMENTO desc");
	
	return $resultado;
}

function retorna_historico_chamado($id, $conexao_com_banco){
		
	$query = "SELECT * FROM tb_historico_chamados WHERE ID_CHAMADO='$id' order by DT_MENSAGEM desc";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
		
	return $resultado;
	
}

//Funções de comunicação 

function retorna_comunicacoes_ativas($conexao_com_banco){
	
	$query = "SELECT * FROM tb_comunicacao WHERE NM_STATUS != 'INATIVA' ORDER BY DT_PUBLICACAO DESC";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
		
	return $resultado;
	
}

function retorna_comunicacoes_inativas($conexao_com_banco){
	
	$query = "SELECT * FROM tb_comunicacao WHERE NM_STATUS = 'INATIVA' ORDER BY DT_PUBLICACAO DESC";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
		
	return $resultado;
	
}

function retorna_imagens_comunicacao($id, $conexao_com_banco){
	
	$query = "SELECT * FROM tb_anexos_comunicacao WHERE ID_COMUNICACAO = '$id'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
		
	return $resultado;
	
	
}

function retorna_imagens_tamanho_comunicacao($pequena, $id, $conexao_com_banco){
	
	$query = "SELECT * FROM tb_anexos_comunicacao WHERE BL_PEQUENA = $pequena AND ID_COMUNICACAO = '$id'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
		
	return $resultado;
	
}

function retorna_cinco_comunicacoes_publicadas($conexao_com_banco){
	
	$query = "SELECT * FROM tb_comunicacao WHERE NM_STATUS = 'PUBLICADA' ORDER BY DT_PUBLICACAO DESC LIMIT 5";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
		
	return $resultado;
	
}

function retorna_comunicacoes_publicadas($conexao_com_banco){
	
	$query = "SELECT * FROM tb_comunicacao WHERE NM_STATUS = 'PUBLICADA' ORDER BY DT_PUBLICACAO DESC";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
		
	return $resultado;
	
}

?>