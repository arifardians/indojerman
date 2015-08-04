	function load_header_crud(){
		var base_url = $("#base_url").val();
		var router   = $("#router_class").val();
		var url 	 = base_url;
		

		if(router == 'lesen_1_controller'){
			url = url+ "index.php/back_end/lesen_1_controller/ajax_header"; 
		}else if(router == 'lesen_2_controller'){
			url = url + "index.php/back_end/lesen_2_controller/ajax_header"; 
		}else if(router == 'lesen_3_controller'){
			url = url + "index.php/back_end/lesen_3_controller/ajax_header"; 
		}else if(router == 'horen_1_controller'){
			url = url + "index.php/back_end/horen_1_controller/ajax_header";
		}else if(router == 'horen_2_controller'){
			url = url + "index.php/back_end/horen_2_controller/ajax_header";
		}else if(router == 'horen_3_controller'){
			url = url + "index.php/back_end/horen_3_controller/ajax_header";
		}

		var result 	 = $.get(url);
		result.done(function(data){
			$("#header_crud").empty().append(data);
		});
	}

	
	$(document).ready(function(){
		load_header_crud();
	});
