$(document).ready(function(){
	$(".servidor-subitem").hide(500);
	$(".processos-subitem").hide(500);
	$(".sucor-subitem").hide(500);
	$(".indice-produtividade-subitem").hide(500);
	$(".chamado-subitem").hide(500);
	$(".odp-subitem").hide(500);
	$(".administrativo-subitem").hide(500);
	$(".atividades-subitem").hide(500);

	$("#financeiro").click(function(){
		$(".financeiro-subitem").slideToggle();
	});
	$("#chamado").click(function(){
		$(".chamado-subitem").slideToggle();
	});
	$("#servidor").click(function(){
		$(".servidor-subitem").slideToggle();
	});
	$("#processos").click(function(){
		$(".processos-subitem").slideToggle();
	});
	$("#sucor").click(function(){
		$(".sucor-subitem").slideToggle();
	});
	$("#indice-produtividade").click(function(){
		$(".indice-produtividade-subitem").slideToggle();
	});
	$("#odp").click(function(){
		$(".odp-subitem").slideToggle();
	});
	$("#administrativo").click(function(){
		$(".administrativo-subitem").slideToggle();
	});
	$("#atividades").click(function(){
		$(".atividades-subitem").slideToggle();
	});
});