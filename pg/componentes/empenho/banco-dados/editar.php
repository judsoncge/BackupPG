<?php

mysqli_query($conexao_com_banco, "UPDATE empenho SET data_pagamento='$edita_data_pagamento', ordem_bancaria='$edita_ordem_bancaria' WHERE numero_empenho='$edita_empenho' ") or die (mysqli_error($conexao_com_banco));
 
//quantidade de linhas modificadas após a ação
$linha = mysqli_affected_rows($conexao_com_banco);
//se houve uma linha modificada, é porque o cadastro foi efetuado
if($linha>=1){         echo "<script>history.back();</script>"; echo "<script>history.back();</script>";
	echo "<script>alert('Pago com sucesso!')</script>"; 
//se nenhuma linha foi modificada, é porque houve algum problema
}else{	
	echo "<script>history.back();</script>";
	echo "<script>alert('Selecione pelo menos um campo para editar')</script>";
}


?>