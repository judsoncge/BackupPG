<?php
// inclui a conexão
include_once('conectar.php');

// Abre o Arquvio no Modo r (para leitura)
$arquivo = fopen ('csvalmoxarifado.csv', 'r');

// Lê o conteúdo do arquivo
while(!feof($arquivo))
{
// Pega os dados da linha
$linha = utf8_encode(fgets($arquivo, 1024));

// Divide as Informações das celulas para poder salvar
$dados = explode(';', $linha);

ini_set('max_execution_time', 300);
// Verifica se o Dados Não é o cabeçalho ou não esta em branco

$codigo = $dados[0];
$item = $dados[1];
$medida= $dados[2];

mysqli_query($conexao_com_banco, "INSERT INTO almoxarifado (codigo, item, medida) 

VALUES ('$codigo', '$item', '$medida')") or die(mysqli_error($conexao_com_banco));

}
echo "acabou tudo";
// Fecha arquivo aberto
fclose($arquivo);
?>