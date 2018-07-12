</div>
</body>
	<!-- script para acionar o busca com múltiplos itens. a importação do restante do script está no header -->
	<script>
	  if ($('input#search').length){
			$('input#search').quicksearch('table tbody tr');
	  }  
	</script>
	<script type="text/javascript">
	window.onload = function(){
		$('#apensos').multipleSelect();
		$('#responsaveis').multipleSelect();
		
	}
	</script>
</html>