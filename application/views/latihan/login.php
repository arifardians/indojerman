<!DOCTYPE html>
<html>
<head>
	<title>Latihan controller</title>
	<link href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	
</head>
<body>
<form action="<?php echo base_url()?>index.php/back_end/latihan_controller/login" method="post" >
	<label>Username</label> : <input type="text" name="username"> <br>
	<label>password</label> : <input type="password" name="password"> <br>
	<button type="submit" name="submit" class="btn btn-info">Submit</button>
	
</form>

</body>
</html>