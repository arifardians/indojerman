<div>
	latihan json 
</div>

<div id="result">
	
</div>
<script type="text/javascript">
	function getData(){
	    $.ajax({
	        url: 'htpp://192.168.1.137/master/index.php/back_end/test_controller',//url
	        type:'get',//bisa post bisa get
	        data: '',
	        beforeSend: function(){
	            //menampilkan loading...
	        },
	        success: function(response){
	            $(".result").html(response);
	        }
	    })
	}

	function getSaveParam(){
		AndroidFunction.getSaveParam("work");
		return "work";
	}
</script>