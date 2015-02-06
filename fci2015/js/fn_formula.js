	var contador = 1;
	  
	function validateFrom()
	{															
		var input = $( "#forma_proyecto input, textarea" );
		var bsubmit = true;
		
		input.each(function(index, elem) {
			if($.trim($(elem).val()) == 0){
				alert('Debe llenar todos los campos.');
				$(elem).focus();
				bsubmit = false;
				return false;
			}				
		});
		
		
		if(bsubmit){
			$( "#forma_proyecto" ).submit();
		}
		
										
	}
	
	function agregarParticipante()
	{
		contador = contador + 1;		
		$.post("formula_participante.php", {contador : contador}, function(data) {
			$("#div_participantes").append(data);
		});
		
		if(contador == 4){
			$('#btn_agregarParticipante').css('display','none');
		}
	}