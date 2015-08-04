function load_view_horen(){
		var horen_id = $("#horen_id").val();
		var base_url = $("#base_url").val();

		var url = base_url+"horen_1_ajax/"+horen_id;
		var result = $.get(url); 
		result.done(function(data){
			$("#view_horen").empty().append(data);
		}); 
	}
	$(document).ready(function(){
		load_view_horen();
	});