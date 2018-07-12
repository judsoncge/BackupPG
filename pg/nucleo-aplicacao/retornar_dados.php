<?php


ini_set('max_execution_time', 1000);

date_default_timezone_set('America/Bahia');

function retorna_dados($tabela, $conexao_com_banco){
	
	if($tabela=="chamado"){
		$permissao = retorna_permissao_pessoa($_SESSION['CPF'],'visualizar_todos_chamados',$conexao_com_banco); if($permissao=='Sim'){
			
			$query = "SELECT * FROM chamado WHERE status != 'Encerrado' order by data_abertura desc";
	
		}else{
			$query =  "SELECT * FROM chamado WHERE status != 'Encerrado' and Pessoa_CPF_requisitante='".$_SESSION['CPF']."' order by data_abertura desc";
			
		}
		
	}else if($tabela=="pessoa"){
	
		$query = "SELECT * FROM pessoa order by nome";

	}else if($tabela=="comunicacao"){
	
		$query = "SELECT * FROM comunicacao where status != 'Excluída' order by data_publicacao desc";

	}else if($tabela=="processo"){
		
		$query = "SELECT * FROM processo order by data_entrada desc";
		
	}else if($tabela=="setor"){
		
		$query = "SELECT * FROM setor order by nome";
		
	}else if($tabela=="almoxarifado"){
		
		$query = "SELECT * FROM almoxarifado order by item";
		
	}else if($tabela=="empenho"){
		
		$query = "SELECT * FROM empenho order by data_empenho desc";
		
	}else if($tabela=="medida"){
		
		$query = "SELECT distinct medida FROM almoxarifado";
		
	}else if($tabela=="rmb"){
		
		$query = "SELECT * FROM rmb";
		
	
	}else{
		$query = "SELECT * FROM ".$tabela." order by id desc";

	}
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;

}

function retorna_historico_processo($numero_processo, $conexao_com_banco){
	
	$query = "SELECT * FROM historico_processo WHERE Processo_numero='$numero_processo' order by data_mensagem desc";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}

function retorna_documento_maior_data($id, $conexao_com_banco){
	
	$query = "SELECT pessoa, max(data_mensagem) FROM historico_documento WHERE Documento_id='$id'";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}

function retorna_documentos_sem_processo($conexao_com_banco){
	
	$query = "SELECT * FROM documento WHERE Processo_numero=''";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}


function retorna_documentos_sem_processo_mensagem($conexao_com_banco){
	
	$query = "SELECT mensagem, Documento_id FROM historico_documento, documento WHERE historico_documento.Documento_id=documento.id 
	and mensagem like 'ENVIOU O DOCUMENTO PARA %' and documento.Processo_numero=''";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}


function retorna_dias_processo($numero_processo, $conexao_com_banco){
	
	$query = "SELECT datediff(CURRENT_DATE(), data_entrada) FROM processo WHERE numero_processo='$numero_processo'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];

}



function retorna_cpf_parte_nome($nome_pessoa, $conexao_com_banco){
	
	$query = "SELECT CPF FROM pessoa WHERE nome like '$nome_pessoa%'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];

}




function retorna_quantidade_chamados_mes($mes, $ano, $conexao_com_banco){
	
	$query = "SELECT pessoa.nome, count(*) as contador from chamado, pessoa WHERE pessoa.CPF=chamado.Pessoa_CPF_requisitante 
	and month(data_abertura)='$mes' and year(data_abertura)='$ano' group by Pessoa_CPF_requisitante ORDER by contador desc";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}

function retorna_quantidade_problemas_chamados_mes($mes, $ano, $conexao_com_banco){
	
	$query = "SELECT natureza_problema, count(*) as contador from chamado WHERE month(data_abertura)='$mes' 
	and year(data_abertura)='$ano' group by natureza_problema ORDER by contador desc";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}

function retorna_quantidade_total_chamados_mes($mes, $ano, $conexao_com_banco){
	
	$query = "SELECT count(*) from chamado WHERE month(data_abertura)='$mes' and year(data_abertura)='$ano'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}






function retorna_documentos_enviados($conexao_com_banco){
	
	$pessoa = $_SESSION['CPF'];
	
	$query = "SELECT distinct (historico_documento.Documento_id) 
	id, interessado, tipo_documento,tipo_atividade,estacom,criadopor,data_criacao,data_entrada, prazo, Processo_numero, status, prioridade,texto_documento,descricao_fato
	FROM historico_documento,documento WHERE historico_documento.Documento_id=documento.id 
	and historico_documento.pessoa='$pessoa' and documento.estacom!='$pessoa' and status != 'Resolvido' ";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}

function retorna_pessoas_tramitar($conexao_com_banco){
	
	$query = "SELECT nome,sobrenome, CPF FROM pessoa, permissao WHERE pessoa.CPF=permissao.Pessoa_CPF and permissao.destino_tramitacao_processo='Sim' order by pessoa.nome";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}

function retorna_processos_todos($conexao_com_banco){
	
	$permissao = retorna_permissao_pessoa($_SESSION['CPF'],'visualizar_processo_todos',$conexao_com_banco); 
	
	$setor = $_SESSION['setor'];
		
		if($permissao=='Sim'){
	
			$query = "SELECT * FROM processo WHERE status != 'Arquivado' and status != 'Saiu' order by prazo_final";
			
		}else{
			
			$query2 = "SELECT subordinado FROM setor WHERE codigo='$setor'";
	
			$lista = mysqli_query($conexao_com_banco, $query2);
	
			while($resultado2 = mysqli_fetch_array($lista)){
	
					$subordinado = $resultado2['subordinado'];
		
			}
			
			$query = "SELECT * FROM processo WHERE status='$setor' or status='$subordinado' and status != 'Arquivado' and status != 'Saiu' order by prazo_final";
			
		}
		

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}

function retorna_documentos_todos($conexao_com_banco){
	
	$pessoa = $_SESSION['CPF'];
	
	$permissao = retorna_permissao_pessoa($pessoa,'visualizar_documento_todos',$conexao_com_banco); 
	
	$setor = $_SESSION['setor'];
	
	$query2 = "SELECT subordinado FROM setor WHERE codigo='$setor'";
	
	$lista2 = mysqli_query($conexao_com_banco, $query2);
	
	$subordinado='';
	
	while($resultado2 = mysqli_fetch_array($lista2)){
	
		$subordinado = $resultado2['subordinado'];
		
	}
		
		if($permissao=='Sim'){
	
			$query = "SELECT * FROM documento order by prazo";
			
		}else{
			
			$query = "SELECT * FROM documento, pessoa WHERE documento.estacom = pessoa.CPF and (pessoa.setor='$setor' or pessoa.setor='$subordinado')";
			
		}
		

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}


function retorna_avaliar($conexao_com_banco){
	
	$setor = $_SESSION['setor'];
	
	$cpf = $_SESSION['CPF'];
	
	
	$permissao = retorna_permissao_pessoa($_SESSION['CPF'],'visualizar_indice_produtividade_todos',$conexao_com_banco); 
	
		if($permissao=='Sim'){
			
			$query = "SELECT distinct nome, sobrenome, CPF, foto, cargo FROM permissao,pessoa WHERE 
			pessoa.CPF=permissao.Pessoa_CPF and ser_avaliado='Sim' and CPF != '$cpf' order by nome";
			
		}else{
	
	
			$query2 = "SELECT subordinado FROM setor WHERE codigo='$setor'";
			
			$lista2 = mysqli_query($conexao_com_banco, $query2);
			
			while($resultado2 = mysqli_fetch_array($lista2)){
			
				$subordinado = $resultado2['subordinado'];
				
			}
			
			$query = "SELECT distinct nome, sobrenome, CPF, foto, cargo FROM permissao,pessoa WHERE 
			pessoa.CPF=permissao.Pessoa_CPF and ser_avaliado='Sim' and 
			pessoa.setor='$setor' or pessoa.setor='$subordinado' and CPF != '000.000.000-00' and CPF != '$cpf' order by nome";
			
			}
			
			$resultado = mysqli_query($conexao_com_banco, $query);
			
			return $resultado;
	
}


function retorna_avaliacoes($conexao_com_banco){
	
	$setor = $_SESSION['setor'];
	
	$cpf = $_SESSION['CPF'];
	
	$mes = date('m')-1;
	
	$ano = date('Y');
	
	
	$permissao = retorna_permissao_pessoa($_SESSION['CPF'],'visualizar_indice_produtividade_todos',$conexao_com_banco); 
	
		if($permissao=='Sim'){
			
			$query = "SELECT * FROM indice_produtividade WHERE mes_referencia='$mes' 
			and ano_referencia='$ano' and tipo_avaliacao!='GERAL' order by nota_avaliacao";
			
		}else{
	
	
			$query2 = "SELECT subordinado FROM setor WHERE codigo='$setor'";
			
			$lista2 = mysqli_query($conexao_com_banco, $query2);
			
			while($resultado2 = mysqli_fetch_array($lista2)){
			
				$subordinado = $resultado2['subordinado'];
				
			}
			
			$query = "SELECT * FROM indice_produtividade,pessoa WHERE pessoa.CPF=indice_produtividade.servidor_avaliado 
			and mes_referencia='$mes' and ano_referencia='$ano' and tipo_avaliacao!='GERAL' 
			and (pessoa.setor='$setor' or pessoa.setor='$subordinado') order by nota_avaliacao";
			
			}
			
			$resultado = mysqli_query($conexao_com_banco, $query);
			
			return $resultado;
	
}





function retorna_nota_tecnico($avaliado , $conexao_com_banco){
	
	$query = "SELECT * FROM avaliacao_interpessoal WHERE avaliado='$avaliado' order by avaliado";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;

}


function retorna_comunicacao($item, $status, $conexao_com_banco){
	
	$query = "SELECT * FROM comunicacao WHERE item='$item' and status='$status' order by data_publicacao desc";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;

}

function retorna_comunicacao_todas($status, $conexao_com_banco){
    
    $query = "SELECT * FROM comunicacao where status='$status' order by data_publicacao desc";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
}

function retorna_documentos_processo($numero_processo, $conexao_com_banco){
    
    $query = "SELECT * FROM documento where Processo_numero='$numero_processo' order by data_criacao";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
}

function retorna_anexos_documento($id, $conexao_com_banco){
	
	$query = "SELECT * FROM anexo WHERE id_referente='$id'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}

function retorna_anexos_documento_primeiro($id, $conexao_com_banco){
	
	$query = "SELECT * FROM anexo WHERE id_referente='$id' LIMIT 1";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}


function retorna_despachos($numero_processo, $conexao_com_banco){
	
	$query = "SELECT * FROM despacho WHERE numero_processo='$numero_processo'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}


function retorna_historico_chamado($chamado, $conexao_com_banco){
	
	$query = "SELECT * FROM historico_chamado WHERE Chamado_numero='$chamado' order by data_mensagem desc";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}

function retorna_historico_documento($documento, $conexao_com_banco){
	
	$query = "SELECT * FROM historico_documento WHERE Documento_id='$documento' order by data_mensagem desc";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}

function retorna_empenho_sem_pagamento($conexao_com_banco){
	
	$query = "SELECT * FROM empenho WHERE data_pagamento='0000-00-00'";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}

function retorna_servidores($conexao_com_banco){
	
	$setor = $_SESSION['setor'];
	
	$query = "SELECT subordinado FROM setor WHERE codigo='$setor'";
	
	$lista = mysqli_query($conexao_com_banco, $query);
	
	while($resultado = mysqli_fetch_array($lista)){
	
	$subordinado = $resultado['subordinado'];
		
	}
	
	$query2 = "SELECT * FROM pessoa WHERE setor='$setor' or setor='$subordinado' order by nome";

	$resultado2 = mysqli_query($conexao_com_banco, $query2);
	
	return $resultado2;
	
}

function retorna_dados_historico_processo($falante, $conexao_com_banco){
			
	$query = "SELECT * FROM pessoa WHERE CPF='$falante' ";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
		
}

function retorna_dados_historico_chamado($requisitante, $conexao_com_banco){
			
	$query = "SELECT * FROM pessoa WHERE CPF='$requisitante'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
		
}

function retorna_dados_historico_chamado_log($requisitante, $conexao_com_banco){
			
	$query = "SELECT * FROM historico_chamado WHERE pessoa='$requisitante' order by data_mensagem";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
		
}

function retorna_dados_historico_processo_log($requisitante, $conexao_com_banco){
			
	$query = "SELECT * FROM historico_processo WHERE Pessoa_CPF_responsavel='$requisitante' order by data_mensagem";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
		
}

function retorna_dados_historico_documento_log($requisitante, $conexao_com_banco){
			
	$query = "SELECT * FROM historico_documento WHERE pessoa='$requisitante' order by data_mensagem";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
		
}

function retorna_empenho_id_despesa($id, $conexao_com_banco){
	
	$query = "SELECT * FROM empenho WHERE id_despesa='$id'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
		
}

function retorna_falta_empenhar($valor_total, $id, $conexao_com_banco){
	
	$query = "SELECT sum(valor_empenhado) as total FROM empenho WHERE id_despesa='$id'";
	
	$lista = mysqli_query($conexao_com_banco, $query);
	
	while($resultado = mysqli_fetch_array($lista)){
	
	$total = $resultado['total'];
		
	}
	
	return $valor_total - $total;
		
}

function retorna_nome_pessoa($CPF, $conexao_com_banco){
	
	$query = "SELECT nome FROM pessoa WHERE CPF='$CPF'";
	
	$lista = mysqli_query($conexao_com_banco, $query);
	
	while($resultado = mysqli_fetch_array($lista)){
	
	$nome = $resultado['nome'];
		
	}
	
	return $nome;
		
}



function retorna_setor_pessoa($CPF, $conexao_com_banco){
	
	$query = "SELECT setor FROM pessoa WHERE CPF='$CPF'";
	
	$lista = mysqli_query($conexao_com_banco, $query);
	
	while($resultado = mysqli_fetch_array($lista)){
	
	$nome = $resultado['setor'];
		
	}
	
	return $nome;
		
}



function retorna_permissao_pessoa($CPF, $permissao, $conexao_com_banco){
	
	$query = "SELECT $permissao as p FROM permissao WHERE Pessoa_CPF='$CPF'";
	
	$lista = mysqli_query($conexao_com_banco, $query);
	
	while($resultado = mysqli_fetch_array($lista)){
	
		$perm = $resultado['p'];
		
	}
	
	return $perm;
		
}

function retorna_foto_pessoa($CPF, $conexao_com_banco){
	
	$query = "SELECT foto FROM pessoa WHERE CPF='$CPF'";
	
	$lista = mysqli_query($conexao_com_banco, $query);
	
	while($resultado = mysqli_fetch_array($lista)){
	
	$foto = $resultado['foto'];
		
	}
	
	return $foto;
		
}

function retorna_nome_setor($codigo, $conexao_com_banco){
	
	$query = "SELECT nome FROM setor WHERE codigo='$codigo'";
	
	$lista = mysqli_query($conexao_com_banco, $query);
	
	$nome='';
	
	while($resultado = mysqli_fetch_array($lista)){
	
	$nome = $resultado['nome'];
		
	}
	
	return $nome;
		
}

function retorna_passaram_processo($processo, $conexao_com_banco){
		
	$query = "SELECT distinct nome FROM pessoa, historico_processo WHERE pessoa.CPF = historico_processo.Pessoa_CPF_responsavel and Processo_numero='$processo'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
		
	return $resultado;
	
}

function retorna_pessoas_setor($setor, $conexao_com_banco){
	
	if($_SESSION['cargo'] == 'Superintendente'){
		
		$query = "SELECT subordinado FROM setor WHERE codigo='$setor'";
	
		$lista = mysqli_query($conexao_com_banco, $query);
	
		while($resultado = mysqli_fetch_array($lista)){
		
			$subordinado = $resultado['subordinado'];
		
		}
				
			$query = "SELECT * FROM pessoa WHERE setor = '$setor' or setor = '$subordinado' order by nome";
	
	}else{
	
			$query = "SELECT * FROM pessoa WHERE setor = '$setor' order by nome";
			
			}

	$resultado = mysqli_query($conexao_com_banco, $query);
		
	return $resultado;
	
}

function retorna_pessoas_setor2($setor1, $setor2, $conexao_com_banco){
	
		$query = "SELECT * FROM pessoa WHERE setor = '$setor1' or setor = '$setor2' order by nome";

		$resultado = mysqli_query($conexao_com_banco, $query);
		
		return $resultado;
	
}

function verifica_prazo($conexao_com_banco){
	
	
	
	$data_hoje = date('Y-m-d');
	
	$query = "SELECT * FROM processo WHERE status not like 'Arquivado' and status not like 'Saiu'";
	   
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$processo = $r->numero_processo;
	
	while($r = mysqli_fetch_object($resultado)){ 
	
		$processo = $r->numero_processo;
		
		if($data_hoje <= $r->prazo and $r->prazo != '0000-00-00' and $r->situacao!='Concluído' and $r->situacao!='Concluído com atraso'){
			
			mysqli_query($conexao_com_banco, "UPDATE processo SET situacao='Em andamento' WHERE numero_processo='$processo'");
		
		}else if($data_hoje > $r->prazo and $r->prazo != '0000-00-00' and $r->situacao!='Concluído' and $r->situacao!='Concluído com atraso'){
			
			mysqli_query($conexao_com_banco, "UPDATE processo SET situacao='Análise em atraso' WHERE numero_processo='$processo'");
			
		}

	}
	
}

function verifica_prazo_final($conexao_com_banco){
	
	
	
	$data_hoje = date('Y-m-d');
	
	$query = "SELECT * FROM processo WHERE status not like 'Arquivado' and status not like 'Saiu'";
	   
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$processo = $r->numero_processo;
	
	while($r = mysqli_fetch_object($resultado)){ 
	
		$processo = $r->numero_processo;
		
		if($data_hoje <= $r->prazo_final and $r->prazo_final != '0000-00-00' and $r->situacao_final!='Finalizado' and $r->situacao_final!='Finalizado com atraso'){
			
			mysqli_query($conexao_com_banco, "UPDATE processo SET situacao_final='Em andamento' WHERE numero_processo='$processo'");
		
		}else if($data_hoje > $r->prazo_final and $r->prazo_final != '0000-00-00' and $r->situacao_final!='Finalizado' and $r->situacao_final!='Finalizado com atraso'){
			
			mysqli_query($conexao_com_banco, "UPDATE processo SET situacao_final='Finalização em atraso' WHERE numero_processo='$processo'");
			
		}


	}
	
}

function retorna_processo_status($status, $conexao_com_banco){
	   
	   $query = "SELECT * FROM processo WHERE status='$status' order by data_entrada desc";
	   
	   $resultado = mysqli_query($conexao_com_banco, $query);
	
	   return $resultado;
	   
}

function retorna_assiduidade_data_servidor($cpf,$mes,$ano,$conexao_com_banco){
	   
	   $query = "SELECT * FROM assiduidade WHERE servidor_avaliado='$cpf' and mes_referencia='$mes' and ano_referencia='$ano'";
	   
	   $resultado = mysqli_query($conexao_com_banco, $query);
	
	   return $resultado;
	   
}

function retorna_documentos_comigo($conexao_com_banco){
	
	$estacom = $_SESSION['CPF'];
	
	$query = "SELECT * FROM documento WHERE estacom='$estacom' and status not like 'Resolvido' order by prazo asc";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
}

   
function retorna_processo_comigo($conexao_com_banco){
	
	$estacom = $_SESSION["CPF"]; 	
	   
	$query = "SELECT * FROM processo WHERE estacom='$estacom' and status!='Saiu' and status != 'Arquivado' order by prazo";

	$resultado = mysqli_query($conexao_com_banco, $query);
		
	return $resultado;
	   
	   
}

function retorna_pessoa_cpf($cpf, $conexao_com_banco){
	
	$query = "SELECT * FROM pessoa WHERE CPF='$cpf'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	return $resultado;
	
}

function retorna_numero_processos_ativos($ano, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE status not like 'Arquivado' and status not like 'Saiu' and Year(data_entrada)='$ano'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}



function retorna_numero_processos_status($ano, $status, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE status='$status' and Year(data_entrada)='$ano'";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_status2($ano, $status, $status2, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE status='$status' and Year(data_entrada)='$ano'";
	$query2 = "SELECT COUNT(*) FROM processo WHERE status='$status2' and Year(data_entrada)='$ano'";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	$resultado2 = mysqli_query($conexao_com_banco, $query2);
	
	$numero = mysqli_fetch_row($resultado);
	$numero2 = mysqli_fetch_row($resultado2);
	
	return $numero[0]+$numero2[0];
	
}

function retorna_numero_processos_analise($ano, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE situacao like 'Em andamento' 
	or situacao like 'Análise em atraso' or situacao='Aberto' and Year(data_entrada)='$ano'";
	
	$resultado = mysqli_query($conexao_com_banco, $query) or die (mysqli_error($conexao_com_banco));
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}


function retorna_numero_processos_sem_prazo_finalizacao($ano,$conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE situacao_final like 'Aberto' 
	and Year(data_entrada)='$ano'";
	
	$resultado = mysqli_query($conexao_com_banco, $query) or die (mysqli_error($conexao_com_banco));
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_sem_prazo_conclusao($ano,$conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE situacao like 'Aberto' 
	and Year(data_entrada)='$ano'";
	
	$resultado = mysqli_query($conexao_com_banco, $query) or die (mysqli_error($conexao_com_banco));
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_sem_prazo($ano,$conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE situacao like 'Aberto' and situacao_final like 'Aberto'
	and Year(data_entrada)='$ano'";
	
	$resultado = mysqli_query($conexao_com_banco, $query) or die (mysqli_error($conexao_com_banco));
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}




function retorna_nota_mes($mes, $ano, $tipo, $CPF, $conexao_com_banco){
	
	$query = "SELECT nota_avaliacao FROM indice_produtividade WHERE mes_referencia='$mes' and ano_referencia='$ano'
	and tipo_avaliacao='$tipo' and servidor_avaliado='$CPF'";
	
	$resultado = mysqli_query($conexao_com_banco, $query) or die (mysqli_error($conexao_com_banco));
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_finalizacao($ano, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE situacao_final like 'Em andamento' or situacao_final like 'Finalização em atraso' or situacao_final like 'Aberto' and Year(data_entrada)='$ano'";
	
	$resultado = mysqli_query($conexao_com_banco, $query) or die (mysqli_error($conexao_com_banco));
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}


function retorna_numero_processos_finalizados($ano, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE situacao_final like 'Finalizado' 
	or situacao_final like 'Finalização em atraso' and Year(data_entrada)='$ano'";
	
	$resultado = mysqli_query($conexao_com_banco, $query) or die (mysqli_error($conexao_com_banco));
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_analise_concluida($ano, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE situacao like 'Concluído' 
	or situacao like 'Concluído com atraso' or situacao like 'Concluído com atraso' and Year(data_entrada)='$ano'";
	
	$resultado = mysqli_query($conexao_com_banco, $query) or die (mysqli_error($conexao_com_banco));
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_inativos($ano, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE status='Arquivado' or status='Saiu' and Year(data_entrada)='$ano'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos($ano, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE Year(data_entrada)='$ano'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}



function retorna_numero_processos_situacao($ano, $situacao, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE situacao='$situacao' and Year(data_entrada)='$ano'";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_situacao_final($ano, $situacao, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE situacao_final='$situacao' and Year(data_entrada)='$ano'";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_situacao_setor($ano, $setor ,$situacao, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE status='$setor' and situacao='$situacao' and Year(data_entrada)='$ano'";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_situacao_final_setor($ano, $setor ,$situacao, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE status='$setor' and situacao_final='$situacao' and Year(data_entrada)='$ano'";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_pessoa_situacao($pessoa ,$situacao, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE estacom='$pessoa' and situacao='$situacao'";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}
function retorna_numero_processos_pessoa_situacao2($pessoa ,$situacao, $situacao_final ,$conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE estacom='$pessoa' and situacao='$situacao' and situacao_final='$situacao_final'";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_pessoa($pessoa , $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE estacom='$pessoa'";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_pessoa_situacao_final($pessoa ,$situacao, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE estacom='$pessoa' and situacao_final='$situacao'";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}



function retorna_numero_processos_situacao_setor2($ano, $setor , $setor2 , $situacao, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE status='$setor' and situacao='$situacao' and Year(data_entrada)='$ano'";
	$query2 = "SELECT COUNT(*) FROM processo WHERE status='$setor2' and situacao='$situacao' and Year(data_entrada)='$ano'";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	$resultado2 = mysqli_query($conexao_com_banco, $query2);
	
	$numero = mysqli_fetch_row($resultado);
	$numero2 = mysqli_fetch_row($resultado2);
	
	return $numero[0]+$numero2[0];
	
}

function retorna_numero_processos_entraram_mes_setor_situacao($ano, $mes, $setor, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE Year(data_entrada)='$ano' and Month(data_entrada)<='$mes' 
	and situacao='Análise em andamento' or situacao='Análise em atraso' or situacao_final='Finalização em andamento'
	or situacao_final='Finalização em atraso' ";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_entraram_mes($ano, $mes, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE Year(data_entrada)='$ano' and Month(data_entrada)<='$mes' ";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_entraram_mes_individual($ano, $mes, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE Year(data_entrada)='$ano' and Month(data_entrada)='$mes' ";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
	
}

function retorna_nota_geral_mes($mes, $ano, $cpf, $conexao_com_banco){
	
	$cumprimento_prazo = retorna_nota_mes($mes, $ano,"CUMPRIMENTO DE PRAZO", $cpf, $conexao_com_banco);
	$assiduidade = retorna_nota_mes($mes, $ano,"ASSIDUIDADE", $cpf, $conexao_com_banco);
	$produtividade = retorna_nota_mes($mes, $ano,"PRODUTIVIDADE", $cpf, $conexao_com_banco);
		
	if($assiduidade == null){
		$assiduidade = 0;
	}
	
	$nota_geral = ($cumprimento_prazo + $assiduidade + $produtividade)/3;
	
	return $nota_geral;
	
}

function retorna_numero_processos_resolvidos_mes($ano, $mes, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE (status='Arquivado' or status='Saiu') and (Year(data_saida)='$ano' and Month(data_saida)<='$mes')";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_processos_resolvidos_mes_individual($ano, $mes, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo WHERE (status='Arquivado' or status='Saiu') and (Year(data_saida)='$ano' and Month(data_saida)='$mes')";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}


function retorna_numero_processos_por_pessoa_situacao($ano, $cpf, $situacao, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM processo, historico_processo WHERE processo.numero_processo=historico_processo.Processo_numero and Pessoa_CPF_responsavel='$cpf' 
	and Year(processo.data_entrada)='$ano' and processo.situacao='$situacao'";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_documentos_com_sugestao($mes, $ano, $cpf, $conexao_com_banco){
	
	$query = "SELECT count(DISTINCT documento.id) FROM historico_documento,documento WHERE 
	historico_documento.Documento_id = documento.id and historico_documento.acao='Sugestão' 
	and documento.criadopor='$cpf' and Month(data_mensagem)='$mes' and Year(data_mensagem)='$ano'";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_sugestoes($mes, $ano, $cpf, $conexao_com_banco){
	
	$query = "SELECT count(historico_documento.acao) FROM historico_documento,documento WHERE 
	historico_documento.Documento_id = documento.id and historico_documento.acao='Sugestão' 
	and documento.criadopor='$cpf' and Month(data_mensagem)='$mes' and Year(data_mensagem)='$ano'";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}


function retorna_sugestoes_nota($mes, $ano, $cpf, $conexao_com_banco){
	
	$query = "SELECT * FROM historico_documento,documento WHERE 
	historico_documento.Documento_id = documento.id and historico_documento.acao='Sugestão' 
	and documento.criadopor='$cpf' and Month(data_mensagem)='$mes' and Year(data_mensagem)='$ano'";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$sugestoes_consideradas = 0;
		
	while($r = mysqli_fetch_array($resultado)){
		
		$total_sugestao = retorna_numero_sugestoes($r->id, $conexao_com_banco);
		
		$total_sugestao = $total_sugestao-1;
		
		if($total_sugestao>=0){	
			$sugestoes_consideradas = $sugestoes_consideradas + $total_sugestao;
		}
	}
	
	return $sugestoes_consideradas;
	
	
}


function retorna_numero_sugestoes($documento, $conexao_com_banco){
	
	$query = "SELECT count(historico_documento.acao) FROM historico_documento,documento WHERE 
	historico_documento.Documento_id = documento.id and historico_documento.acao='Sugestão' 
	and documento.id='$documento'";

	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
	
}



function retorna_tipo_sugestao_documento_pessoa($tipo,$mes, $ano, $cpf, $conexao_com_banco){
	
	$query = "SELECT count(*) FROM historico_documento,documento WHERE 
	historico_documento.Documento_id = documento.id and historico_documento.tipo='$tipo' 
	and documento.criadopor='$cpf' and Month(data_mensagem)='$mes' and Year(data_mensagem)='$ano'";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}



function retorna_documento_criado($mes, $ano, $cpf, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM documento WHERE criadopor='$cpf' and Month(data_criacao)='$mes' and Year(data_criacao)='$ano'";
		
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function verifica_processos_documento($id, $conexao_com_banco){
	$query_verificacao = "SELECT Processo_numero FROM documento WHERE id='$id'";
		
	$resultado = mysqli_query($conexao_com_banco, $query_verificacao);
	
	$processo = mysqli_fetch_row($resultado);
	
	return $processo[0];
}


function calcula_produtividade($conexao_com_banco){
	
	$hoje = date('d'); 
	
	$mes = date('m')-1;
	
	$ano = date('Y'); 
	
	$data_hoje = date('Y-m-d H:i:s');
	
	$query_verificacao = "SELECT * FROM indice_produtividade WHERE mes_referencia='$mes' and ano_referencia='$ano' and tipo_avaliacao='PRODUTIVIDADE'";
		
	$search = mysqli_query($conexao_com_banco, $query_verificacao);
	
	 if(($hoje == '01' or $hoje == '02' or $hoje == '17') and mysqli_num_rows($search) == 0){
		
		$query = "SELECT Pessoa_CPF FROM permissao WHERE analisar_processo='Sim' and ser_avaliado='Sim'";
		
		$resultado = mysqli_query($conexao_com_banco, $query);
	
	    while($r = mysqli_fetch_object($resultado)){	
			
			$pessoa = $r->Pessoa_CPF;
			
			$total_documento_criado = retorna_documento_criado($mes,$ano,$pessoa, $conexao_com_banco);
		
			$total_documentos_com_sugestao = retorna_documentos_com_sugestao($mes,$ano,$pessoa, $conexao_com_banco);
			
			$total_sugestoes = retorna_sugestoes_nota($mes,$ano,$pessoa, $conexao_com_banco);
			
			$total_sem_sugestao = $total_documento_criado - $total_documentos_com_sugestao;
			
			if($total_documento_criado == 0){
				$produtividade = 0;
			}else if($total_sugestoes != 0){
				$sugestoes = $total_sugestoes*0.25;
				$produtividade = 10 - $sugestoes;
			}else{
				$produtividade = 10;
			}
			
			$id = 'PRODUTIVIDADE_'.$pessoa.$data_hoje;
			
			$id = str_replace('.', '', $id);
			$id = str_replace('-', '', $id);
			$id = str_replace(':', '', $id);
			$id = str_replace(' ', '', $id);
			
			$produtividade = number_format($produtividade, 1, '.', '.');

			mysqli_query($conexao_com_banco, "INSERT INTO indice_produtividade (id, tipo_avaliacao, mes_referencia, ano_referencia, servidor_avaliado, nota_avaliacao)
			VALUES ('$id', 'PRODUTIVIDADE', '$mes', '$ano', '$pessoa', '$produtividade')") or die (mysqli_error($conexao_com_banco));
	
		}

	}

}

function retorna_nota_geral_setor_mes($conexao_com_banco){
	
	$mes = date('m')-1;
				
	$ano = date('Y');
				
	$setor = $_SESSION['setor'];
				
	$cpf = $_SESSION['CPF'];	
	
	$permissao = retorna_permissao_pessoa($_SESSION['CPF'],'visualizar_indice_produtividade_todos',$conexao_com_banco); 
	
		if($permissao=='Sim'){
			
			$query = "SELECT avg(nota_avaliacao) FROM indice_produtividade, pessoa 
				WHERE indice_produtividade.servidor_avaliado = pessoa.CPF
				and tipo_avaliacao = 'GERAL'
				and mes_referencia = '$mes'
				and ano_referencia = '$ano'";
			
		}else{
	
				
				$query2 = "SELECT subordinado FROM setor WHERE codigo='$setor'";
				
					$lista2 = mysqli_query($conexao_com_banco, $query2);
				
					while($resultado2 = mysqli_fetch_array($lista2)){
				
						$subordinado = $resultado2['subordinado'];
					
					}
				
				$query = "SELECT avg(nota_avaliacao) FROM indice_produtividade, pessoa 
							WHERE indice_produtividade.servidor_avaliado = pessoa.CPF
							and tipo_avaliacao = 'GERAL'
							and mes_referencia = '$mes'
							and ano_referencia = '$ano'
							and (pessoa.setor = '$setor'
							or pessoa.setor = '$subordinado')";
							
		}
				
				$resultado = mysqli_query($conexao_com_banco, $query);
				
				$numero = mysqli_fetch_row($resultado);
				
				return $numero[0];

}


function grava_nota_geral($conexao_com_banco){
	
	
	
	$mes = date('m')-1;
	
	$ano = date('Y');
	
	$data_hoje = date('Y-m-d H:i:s');
	
	$query_pessoas = "SELECT Pessoa_CPF FROM permissao WHERE ser_avaliado='Sim'";
	
	$lista = mysqli_query($conexao_com_banco, $query_pessoas);
	
	while($r = mysqli_fetch_object($lista)){
		
		$cpf = $r->Pessoa_CPF;
		
		$nota_produtividade = retorna_nota_mes($mes,$ano,"PRODUTIVIDADE", $cpf, $conexao_com_banco);
		
		$nota_cumprimento = retorna_nota_mes($mes,$ano,"CUMPRIMENTO DE PRAZO", $cpf, $conexao_com_banco); 
		
		$nota_assiduidade = retorna_nota_mes($mes,$ano,"ASSIDUIDADE", $cpf, $conexao_com_banco);
		
		$nota_geral = ($nota_produtividade+$nota_cumprimento+$nota_assiduidade)/3;
		
		$query_verificacao = "SELECT * FROM indice_produtividade WHERE mes_referencia='$mes' and ano_referencia='$ano'
		and servidor_avaliado='$cpf' and tipo_avaliacao='GERAL'";
		
		
		
		$search = mysqli_query($conexao_com_banco, $query_verificacao);
		
		$id = 'GERAL_'.$cpf.$mes.$ano;
		
		$id = str_replace('.', '', $id); 
		$id = str_replace('-', '', $id);
		$id = str_replace(':', '', $id);
		$id = str_replace(' ', '', $id);
		
		 if(mysqli_num_rows($search) == 0){
			 
			 
		
		 $query = "INSERT INTO indice_produtividade (id, tipo_avaliacao, mes_referencia, ano_referencia, servidor_avaliado, nota_avaliacao)
		 VALUES ('$id', 'GERAL', '$mes', '$ano', '$cpf', '$nota_geral')";
	
		mysqli_query($conexao_com_banco, $query);
		 
	 }else{
		 
		 
		 
			$prod = retorna_nota_mes($mes, $ano,"PRODUTIVIDADE", $cpf, $conexao_com_banco);
			$cum = retorna_nota_mes($mes, $ano,"CUMPRIMENTO DE PRAZO", $cpf, $conexao_com_banco);
			$assi = retorna_nota_mes($mes, $ano,"ASSIDUIDADE", $cpf, $conexao_com_banco);
			
			$edita_nota = ($prod + $cum + $assi)/3;

			$query2 = "UPDATE indice_produtividade SET nota_avaliacao='$edita_nota' 
			WHERE mes_referencia='$mes' and ano_referencia='$ano' and id='$id'";
		
			mysqli_query($conexao_com_banco, $query2);
	 }
		
	}
	
}



function retorna_nota_geral($cpf, $mes, $ano, $conexao_com_banco){
	
	$query = "SELECT nota_avaliacao FROM indice_produtividade WHERE mes_referencia='$mes' and ano_referencia='$ano'
		and servidor_avaliado='$cpf' and tipo_avaliacao='GERAL'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_chamados_sem_nota($requisitante, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM chamado WHERE status='Resolvido' and nota='Sem nota' and Pessoa_CPF_requisitante='$requisitante'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_total_requisicoes($requisitante, $conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM chamado WHERE Pessoa_CPF_requisitante='$requisitante'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function retorna_numero_total_chamados($conexao_com_banco){
	
	$query = "SELECT COUNT(*) FROM chamado";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}



//cumprimento de prazo
function retorna_numero_processos_concluidos($mes, $ano, $pessoa, $conexao_com_banco){
	
	$query = "SELECT DISTINCT count(*) from processo, historico_processo WHERE Processo_numero = numero_processo and (acao = 'Responsável' or acao = 'Conclusão')
	and Pessoa_CPF_responsavel = '$pessoa' and situacao = 'Concluído' and Month(data_mensagem)='$mes' and Year(data_mensagem)='$ano'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}
//cumprimento de prazo
function retorna_numero_processos_concluidos_atraso($mes, $ano, $pessoa, $conexao_com_banco){
	
	$query = "SELECT DISTINCT count(*) from processo, historico_processo WHERE Processo_numero = numero_processo and (acao = 'Responsável' or acao = 'Conclusão')
	and Pessoa_CPF_responsavel = '$pessoa' and situacao = 'Concluído com atraso' and Month(data_mensagem)='$mes' and Year(data_mensagem)='$ano'";
	
	$resultado = mysqli_query($conexao_com_banco, $query);
	
	$numero = mysqli_fetch_row($resultado);
	
	return $numero[0];
	
}

function calcula_cumprimento_prazo($conexao_com_banco){
	
	

	$hoje = date('d'); 
	
	$mes = date('m')-1; 
	
	$ano = date('Y'); 
	
	$data_hoje = date('Y-m-d H:i:s');
	
	$query_verificacao = "SELECT * FROM indice_produtividade WHERE mes_referencia='$mes' and ano_referencia='$ano' and tipo_avaliacao='CUMPRIMENTO DE PRAZO'";
		
	$search = mysqli_query($conexao_com_banco, $query_verificacao);
	
    if(($hoje == '01' or $hoje == '02' or $hoje == '17') and mysqli_num_rows($search) == 0){
		
		$query = "SELECT Pessoa_CPF FROM permissao WHERE analisar_processo='Sim' and ser_avaliado='Sim'";
		
		$resultado = mysqli_query($conexao_com_banco, $query);
	
	    while($r = mysqli_fetch_object($resultado)){	
			
			$pessoa = $r->Pessoa_CPF;
			
			$processos_concluidos_atraso = retorna_numero_processos_concluidos_atraso($mes, $ano, $pessoa, $conexao_com_banco);
		
			$processos_concluidos = retorna_numero_processos_concluidos($mes, $ano,$pessoa, $conexao_com_banco);
			
			if($processos_concluidos == 0){
				$cumprimento_prazo = 0;
			}else{
				$cumprimento_prazo = (($processos_concluidos)/($processos_concluidos+$processos_concluidos_atraso))*10;
			}
			
			$cumprimento_prazo = number_format($cumprimento_prazo,1,'.','.');
		
			$id = 'CUMPRIMENTOPRAZO_'.$pessoa.$data_hoje;
			
			$id = str_replace('.', '', $id);
			$id = str_replace('-', '', $id);
			$id = str_replace(':', '', $id);
			$id = str_replace(' ', '', $id);

			mysqli_query($conexao_com_banco, "INSERT INTO indice_produtividade (id, tipo_avaliacao, mes_referencia, ano_referencia, servidor_avaliado, nota_avaliacao)
			VALUES ('$id', 'CUMPRIMENTO DE PRAZO', '$mes', '$ano', '$pessoa', '$cumprimento_prazo')") or die (mysqli_error($conexao_com_banco));
	
		}

	}

}















?>