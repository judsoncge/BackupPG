<?php
$cpf = $_GET['pessoa'];
$retornoquery = mysqli_query($conexao_com_banco, "SELECT * FROM pessoa WHERE CPF='$cpf'");
while($result = mysqli_fetch_array($retornoquery)){
	$nome = $result['nome'];
	$sobrenome = $result['sobrenome'];
	$matricula = $result['matricula'];
	$cargo = $result['cargo'];
	$situacao_funcional = $result['situacao_funcional'];
	$nivel = $result['nivel'];
	$graduacao = $result['graduacao'];
	$data_nomeacao = $result['data_nomeacao'];
	$email_institucional = $result['email_institucional'];
	$setor = $result['setor'];
	$grupo = $result['grupo'];
	$salario = $result['salario'];
	$cedido_por = $result['cedido_por'];
	$foto = $result['foto'];
	$dados_gerais = $result['anexo_dados_gerais'];
	$comprovante = $result['anexo_comprovante_residencia'];
	$diploma = $result['anexo_diploma'];
}
$retornoquery2 = mysqli_query($conexao_com_banco, "SELECT * FROM permissao WHERE Pessoa_CPF='$cpf'");
while($result2 = mysqli_fetch_array($retornoquery2)){
	
	$abrir_chamado_pessoa=$result2['abrir_chamado_pessoa'];
	$fechar_chamado=$result2['fechar_chamado'];
	$nota_chamado=$result2['nota_chamado'];
	$visualizar_todos_chamados=$result2['visualizar_todos_chamados'];
	$visualizar_financeiro=$result2['visualizar_financeiro'];
	$cadastrar_comunicacao=$result2['cadastrar_comunicacao'];
	$visualizar_processo=$result2['visualizar_processo'];
	$abrir_processo=$result2['abrir_processo'];
	$analisar_processo=$result2['analisar_processo'];
	$prazo_processo=$result2['prazo_processo'];
	$prazo_final_processo=$result2['prazo_final_processo'];
	$arquivar_processo=$result2['arquivar_processo'];
	$saida_processo=$result2['saida_processo'];
	$visualizar_processo_todos=$result2['visualizar_processo_todos'];
	$destino_tramitacao_processo=$result2['destino_tramitacao_processo'];
	$concluir_processo=$result2['concluir_processo'];
	$finalizar_processo=$result2['finalizar_processo'];
	$voltar_processo=$result2['voltar_processo'];
	$visualizar_servidores=$result2['visualizar_servidores'];
	$visualizar_documento=$result2['visualizar_documento'];
	$visualizar_documento_todos=$result2['visualizar_documento_todos'];
	$aprovar_documento=$result2['aprovar_documento'];
	$sugestao_documento=$result2['sugestao_documento'];
	$visualizar_indice_produtividade=$result2['visualizar_indice_produtividade'];
	$avaliar_todos=$result2['avaliar_todos'];
	$ser_avaliado=$result2['ser_avaliado'];

}
?>