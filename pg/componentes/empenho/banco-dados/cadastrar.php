<?php

//cadastrando no banco de dados
mysqli_query($conexao_com_banco, "INSERT INTO empenho (numero_empenho, id_despesa, data_empenho, valor_empenhado) 
VALUES ('$novo_empenho', '$novo_id_despesa', '$novo_data_empenho','$novo_valor_empenhado')") 
or die (mysqli_error($conexao_com_banco));

echo "<script>history.back();</script>"; 
echo "<script>alert('Empenhado com sucesso!')</script>";



?>