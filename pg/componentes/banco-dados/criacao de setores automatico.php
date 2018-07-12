<?php
// inclui a conexão
include_once('conectar.php');

// Abre o Arquvio no Modo r (para leitura)
$arquivo = fopen ('teste setores.csv', 'r');

// Lê o conteúdo do arquivo
while(!feof($arquivo))
{
// Pega os dados da linha
$linha = fgets($arquivo, 1024);

// Divide as Informações das celulas para poder salvar
$dados = explode(';', $linha);

ini_set('max_execution_time', 300);
// Verifica se o Dados Não é o cabeçalho ou não esta em branco
if($dados[0] != 'numero' && !empty($linha))
{
mysqli_query($conexao_com_banco, 'INSERT INTO setor (codigo, nome) 


VALUES ("'.$dados[0].'", "'.$dados[1].'")');

}
}
echo "acabou tudo";
// Fecha arquivo aberto
fclose($arquivo);
?>