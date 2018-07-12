<?php include('../componentes/sessao/iniciar-sessao.php');
include('head.php');
include('body.php'); 

?>
<script type="text/javascript">
var retorno;
var mapa_exibicao;
var nomes_mes = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

var servidor;
function inicializar_mes() {
	var mapa_status = {
	'Total':0,
	'Realizadas_Prazo': 0,
	'Realizadas_Vencidas': 0,
	'Incompletas': 0,
	'Vencidas': 0,
	'Aberta': 0	
	};
return mapa_status;	
}
function inicializar_mapa(){
	var mapa_ano = {}, i;
	for (i = 0; i < 12; i++) {
		mapa_ano[i] = inicializar_mes();
	}
	return mapa_ano;
}
function listar_servidor(cd_servidor) {
	servidor = cd_servidor;
	listar_atividades();
}
function listar_atividades() {
	$.ajax({ 
	url: url + '/servicos/atividades.php',
	data: {
	 'acao': 'Relatar',
	 'sessionId':sessionId,
	 'servidor':servidor,
	 'ano': new Date().getFullYear()
	 },
	type: 'get',
	success: function(data) {
		data = $.parseJSON(data);			
		retorno = data;
		mapa_exibicao = inicializar_mapa();
		for (var i = 0; i < data.length; i++) { 
			if (data[i].Status === 'EM ANDAMENTO') {
				mapa_exibicao[parseInt(data[i].Mes) - 1]['Aberta'] = parseInt(data[i].Contagem); 
			}
			if (data[i].Status === 'CONCLUÍDO') {
				mapa_exibicao[parseInt(data[i].Mes) - 1]['Realizadas_Prazo'] = parseInt(data[i].Contagem); 
			}
			if (data[i].Status === 'CONCLUÍDO COM ATRASO') {
				mapa_exibicao[parseInt(data[i].Mes) - 1]['Realizadas_Vencidas'] = parseInt(data[i].Contagem); 
			}
			if (data[i].Status === 'VENCEU') {
				mapa_exibicao[parseInt(data[i].Mes) - 1]['Vencidas'] = parseInt(data[i].Contagem); 
			}	
			if (data[i].Status === 'FALTA ANEXO') {
				mapa_exibicao[parseInt(data[i].Mes) - 1]['Incompletas'] = parseInt(data[i].Contagem); 
			}			
			mapa_exibicao[parseInt(data[i].Mes) - 1]['Total'] += parseInt(data[i].Contagem); 
			
		}
		$("#atividades-geral").empty();
		for (i = 0; i < 12; i++) {
			$("#atividades-geral").append('<tr><td>' + nomes_mes[i] + '</td><td style="text-align: center;">' + mapa_exibicao[i]['Aberta'] + '</td><td style="text-align: center;">' + mapa_exibicao[i]['Realizadas_Prazo'] + '</td><td style="text-align: center;">' + mapa_exibicao[i]['Realizadas_Vencidas'] + '</td><td style="text-align: center;">' + mapa_exibicao[i]['Incompletas'] + '</td><td style="text-align: center;">' + mapa_exibicao[i]['Vencidas'] + '</td><td style="text-align: center;">' + mapa_exibicao[i]['Total'] + '</td>' +
			'<td style="text-align: center;"><a href="javascript:void(0);" onclick="listar_atividades_mes(' + i + ')"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a></td>' +
			'</tr>');
		};
		$("#servidor option[value='" + servidor + "']").attr('selected', 'selected');
		
		
	}
	});
}

function listar_atividades_mes(mes) {
	$.ajax({ 
	url: url + '/servicos/atividades.php',
	data: {
	 'acao': 'Listar',
	 'sessionId':sessionId,
	 'servidor':servidor,
	 'ano': new Date().getFullYear(),
	 'mes': mes + 1
	 },
	type: 'get',
	success: function(data) {
		var color = '', texto = '';
		data = $.parseJSON(data);			
		retorno = data;
		$("#atividades-mes").empty();
		for (var i = 0; i < data.length; i++) { 
			if (data[i].NM_STATUS === 'CONCLUÍDO') {
				color = 'color:green;';
			}
			else if (data[i].NM_STATUS === 'FALTA ANEXO') {
				color = 'color:orange;';
			}
			else if (data[i].NM_STATUS === 'CONCLUÍDO COM ATRASO') {
				color = 'color:red;';
			}			
			texto = '<tr id="atividade-' + data[i].ID + '"><td style=" max-width: 320px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;}">' + data[i].TX_DESCRICAO + 
			'</td><td style="text-align: center;">' + formatar_data(data[i].DT_VENCIMENTO) +
			'</td><td style="text-align: center;">' + formatar_data(data[i].DT_CRIADO) + '</td>' + 
			'<td style="text-transform: capitalize; ' + color + '">' + data[i].NM_STATUS + '</td>'+
			'<td style="text-align: center;">';
			if (data[i].NM_ARQUIVO) {
				texto += '<a href="../registros/anexos/' + data[i].NM_ARQUIVO + '" download><i class="fa fa-download" aria-hidden="true"></i>';
			} else {
				texto += '<i class="fa fa-times" aria-hidden="true"></i>';
			}
			texto += '<td style="text-align: center;">';
			if (data[i].NM_STATUS.indexOf('CONCLUÍDO') === -1) {
				texto += '<a href="javascript:void(0);" onclick="remover_atividade(' + data[i].ID + ')">' +
			'<button type="button" class="btn btn-secondary btn-sm" title="Excluir" ><i class="fa fa-trash" aria-hidden="true"></i></button></a>';
			} else {
				texto += '<i class="fa fa-times" aria-hidden="true"></i>';
			}
			 
			texto += '</td></tr>';
			$("#atividades-mes").append(texto);
		}
		$(".geral").delay(500);
		$(".mes").delay(700)
		$(".geral").addClass('closed');
		$(".mes").removeClass('closed');
		
	}
	});


}

function formatar_data(data) {
	data = new Date(data);
	var mes = (data.getMonth() + 1), dia = data.getDate();
	if (mes < 10) {
		mes = '0' + mes;
	}
	if (dia < 10) {
		dia = '0' + dia;
	}
	
	return  dia + '/' + mes + '/' + data.getFullYear();
}
function remover_atividade(id) {
	$.ajax({ 
		url: url + '/servicos/atividades.php',
		data: {
		 'acao': 'Remover',
		 'sessionId':sessionId,
		 'id':id
		 },
		type: 'get',
		success: function(data) {
			if ($.trim(data) === 'Sucesso') {			
				$('#atividade-' + id).hide();
				listar_atividades();
			}
		}
    });


}
function retornar() {	
	$(".geral").delay(700);
	$(".mes").delay(500)
	$(".geral").removeClass('closed');
	$(".mes").addClass('closed');
}

(function(){
	if (getParameterByName('cd_servidor')) {
		servidor = getParameterByName('cd_servidor');		
		listar_atividades();
	}
})();
</script>
<style>
.slider {
	padding: 0px;
	overflow: auto;
	max-width: 100%;
	transition-property: all;
	transition-duration: .5s;
	transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
}
.slider > table {
	margin-left: 15px;
	margin-right: 15px;
	width: 97%;

}
.slider.closed {
	max-width: 0;
	overflow: hidden;
}
</style>
<!-- Conteúdo da Página -->
<div id="page-content-wrapper">
	<div class="container titulo-pagina">
		<p>Atividades</p>
	</div>
	<?php include('includes/mensagem.php') ?>
	<div class="container caixa-conteudo">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="well">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group">
									<select class="form-control" id="servidor" name="servidor" onChange="listar_servidor(this.value);" required/>
									<option value="">Selecione o servidor</option>
									<?php $lista = retorna_servidores($conexao_com_banco);
									while($r = mysqli_fetch_object($lista)){ ?>
									<option value="<?php echo $r->CD_SERVIDOR ?>"><?php echo $r->NM_SERVIDOR ?></option><?php } ?>
									</select>
								</div>								
							</div>
							<?php $permissao = retorna_permissao($_SESSION['CPF'],'CADASTRAR_ATIVIDADE',$conexao_com_banco); if($permissao=='sim'){ ?>
								<div class="col-sm-2 col-xs-12 pull-right">
									<!-- Somente algumas pessoas podem abrir um processo -->
									<a href="cadastro-atividade.php?sessionId=<?php echo $num ?>" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-circle"></i> Atividade</a>
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-12 table-responsive geral slider" style="width: 100%; height: 320px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Mês</th>
									<th style="text-align: center;">Abertas</th>
									<th style="text-align: center;">Realizadas (prazo)</th>
									<th style="text-align: center;">Realizadas (atraso)</th>
									<th style="text-align: center;">Falta anexo</th>	
									<th style="text-align: center;">Vencidas</th>									
									<th style="text-align: center;">Total</th>
									<th style="text-align: center;">+</th>
								</tr>	
							</thead>
							<tbody id="atividades-geral">
								
							</tbody>
						</table>
					</div>
					
						
					<div class="col-md-12 table-responsive mes slider closed" style="width: 100%; height: 320px;">
						<div style="padding: 0px 15px; min-height: 230px;">
						<table class="table table-hover tabela-dados">
							<thead>
								<tr>
									<th>Descrição</th>
									<th>Vencimento</th>
									<th>Criação</th>
									<th>Status</th>
									<th>Anexo</th>
									<th>Ação</th>
								</tr>	
							</thead>
							<tbody id="atividades-mes">
								
								
							</tbody>
						</table>
						</div>
						<div class="col-md-12">
							<a href="javascript:void(0);" onclick="retornar()">
								<button type="submit" class="btn btn-default">Retornar</button>
							</a>
						</div>						
					</div>
					
				
				
				
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /#Conteúdo da Página/-->

<!-- chamando o bootstrap novamente para o modal funcionar -->
<script type="text/javascript" src="js/bootstrap.js"></script>

<script type="text/javascript">
	/*menu lateral*/
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>

<?php include('foot.php')?>