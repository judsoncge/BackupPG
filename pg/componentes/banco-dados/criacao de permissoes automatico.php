<?php
// inclui a conexão
include_once('conectar.php');

// Abre o Arquvio no Modo r (para leitura)
$arquivo = fopen('permissao.csv', 'r');

// Lê o conteúdo do arquivo
while(!feof($arquivo))
	

{

// Pega os dados da linha
$linha = fgets($arquivo, 1024);

// Divide as Informações das celulas para poder salvar
$dados = explode(';', $linha);

ini_set('max_execution_time', 300);
// Verifica se o Dados Não é o cabeçalho ou não esta em branco
if($dados[0] != 'id' && !empty($linha))
{
mysqli_query($conexao_com_banco, 'INSERT INTO permissao (id,Pessoa_CPF,abrir_chamado_pessoa,fechar_chamado,nota_chamado,visualizar_todos_chamados,
cadastrar_financeiro,visualizar_financeiro,cadastrar_comunicacao,abrir_processo,analisar_processo,prazo_processo,prazo_final_processo,arquivar_processo,
saida_processo,visualizar_processo_todos,concluir_processo,finalizar_processo,voltar_processo,cadastrar_servidor,visualizar_ficha_funcional_todos,
editar_servidor,visualizar_documento,visualizar_documento_todos,aprovar_documento,sugestao_documento,avaliar_relacao_interpessoal,avaliar_todos,ser_avaliado) 

VALUES ("'.$dados[0].'", "'.$dados[1].'","'.$dados[2].'","'.$dados[3].'","'.$dados[4].'","'.$dados[5].'","'.$dados[6].'","'.$dados[7].'","'.$dados[8].'"
,"'.$dados[9].'","'.$dados[10].'","'.$dados[11].'","'.$dados[12].'","'.$dados[13].'","'.$dados[14].'","'.$dados[15].'","'.$dados[16].'","'.$dados[17].'"
,"'.$dados[18].'","'.$dados[19].'","'.$dados[20].'","'.$dados[21].'","'.$dados[22].'","'.$dados[23].'","'.$dados[24].'","'.$dados[25].'","'.$dados[26].'"
,"'.$dados[27].'","'.$dados[28].'")'); 
 
 echo  $dados[1]." cadastrado<br>";

}
}

// Fecha arquivo aberto
fclose($arquivo);
?>