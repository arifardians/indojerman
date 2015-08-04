function load_view_lesen(){
		var lesen_id = $("#lesen_id").val();
		var base_url = $("#base_url").val();
		
		var url = base_url+"index.php/back_end/lesen_2_controller/ajax_view_lesen_2/"+lesen_id;
		var result = $.get(url); 
		result.done(function(data){
			$("#view_lesen").empty().append(data);
		}); 
	}
	$(document).ready(function(){
		load_view_lesen();
	});