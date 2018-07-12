
<?php
include('../componentes/banco-dados/conectar.php');
include('../componentes/sessao/iniciar-sessao.php');
if(isset($_GET['acao']) && !empty($_GET['acao'])) {
    $acao  = $_GET['acao'];
	switch($acao) {
        case 'Listar' : 
			$offset = 0;
			if(isset($_GET['offset']) && !empty($_GET['offset'])) {
				$offset = $_GET['offset'];
			}
			listar_notificacoes($offset, $conexao_com_banco);
			break;
		case 'Recentes' : 
			$max = 0;
			if(isset($_GET['max']) && !empty($_GET['max'])) {
				$max = $_GET['max'];
			}
			listar_notificacoes_recentes($max, $conexao_com_banco);
			break;
        case 'Verificar' : contar_noficacoes('NOVA', $conexao_com_banco);break;
		case 'Marcar Lido' :
		if(isset($_GET['notificacao']) && !empty($_GET['notificacao'])) {
			marcar_lido($conexao_com_banco, $_GET['notificacao']);
		} else {
			marcar_todos_lidos($conexao_com_banco);
		}		
		
		break;
      
    }
}

function listar_notificacoes($offset, $conexao_com_banco){
	$user_id = $_SESSION['CPF'];
	$notificacoes = mysqli_query($conexao_com_banco, "SELECT * FROM notificacao WHERE cd_servidor = '$user_id' order by DT_CRIADO DESC limit 5 offset $offset");
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($notificacoes)){
		$resultados[] = $linha;
	};		
	echo json_encode($resultados);
	
}

function listar_notificacoes_recentes($max, $conexao_com_banco){
	$user_id = $_SESSION['CPF'];
	$notificacoes = mysqli_query($conexao_com_banco, "SELECT * FROM notificacao WHERE cd_servidor = '$user_id' and nm_status in ('NOVA', 'PRE-VISUALIZADA') order by DT_CRIADO DESC limit $max");
	$resultados = array();
	
	while ($linha = mysqli_fetch_object($notificacoes)){
		$resultados[] = $linha;
	};		
	echo json_encode($resultados);
	
}

function marcar_lido($conexao_com_banco, $notificacao) {
	$user_id = $_SESSION['CPF'];
	$data = date('Y-m-d H:i:s');
	mysqli_query($conexao_com_banco, "UPDATE notificacao SET NM_STATUS = 'VISUALIZADA', DT_VISUALIZADO = '$data' WHERE cd_servidor = '$user_id' AND ID = $notificacao");
}

function marcar_todos_lidos($conexao_com_banco) {
	$user_id = $_SESSION['CPF'];
	$data = date('Y-m-d H:i:s');
	mysqli_query($conexao_com_banco, "UPDATE notificacao SET NM_STATUS = 'PRE-VISUALIZADA' WHERE cd_servidor = '$user_id' AND NM_STATUS='NOVA'");
}

function contar_noficacoes($status,$conexao_com_banco) {
	$user_id = $_SESSION['CPF'];
	$notificacoes = mysqli_query($conexao_com_banco, "SELECT COUNT(*) FROM notificacao WHERE cd_servidor = '$user_id' AND NM_STATUS = '$status'");
	$notificacoes = mysqli_fetch_row($notificacoes);
	echo json_encode($notificacoes);
}

?>