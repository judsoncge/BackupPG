<?php 

//retorna todas as informacoes do processo
$informacoes = retorna_informacoes($tabela, $id, $conexao_com_banco);

//verifica se o processo está ativo (nem saiu e nem foi arquivado)
$ativo = (($informacoes['NM_STATUS']!='ARQUIVADO' and $informacoes['NM_STATUS']!='SAIU')) ? true : false;
//retorna se ja foi confirmada a tramitacao 
$recebido = retorna_recebido_processo($id, $conexao_com_banco);


//retorna se o processo ja tem um responsavel definido
$tem_responsavel = retorna_tem_responsavel_processo($informacoes["ID"], $conexao_com_banco);
//retorna a lista de responsaveis do processo
$responsaveis = retorna_responsaveis_processo($id, $conexao_com_banco);
//retorna o responsavel lider do processo
$responsavel_lider = retorna_responsavel_lider_processo($id, $conexao_com_banco);


//retorna o id do processo mae (se houver)
$id_mae = retorna_processo_mae($id, $conexao_com_banco);
//retorna a lista de processos apensados (se houver)
$apensados = retorna_processos_apensados($id, $conexao_com_banco);
//retorna se o processo é apensado a algum outro
$apensado = retorna_boleano_filho($id, $conexao_com_banco);


//retorna se ja existe alguma tramitacao do processo (para caso do processo ser recem criado e nao precisar de confirmacao de recebido)
$tem_tramitacao = retorna_tem_tramitacao_processo($informacoes["ID"], $conexao_com_banco);

?>