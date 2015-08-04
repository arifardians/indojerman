<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 2.3.2
Version: 1.4
Author: KeenThemes
Website: http://www.keenthemes.com/preview/?theme=metronic
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>Indojerman | Admin Dashboard</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->        
	<link href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url()?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url()?>assets/back_end/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url()?>assets/back_end/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url()?>assets/back_end/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url()?>assets/back_end/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="<?php echo base_url()?>assets/back_end/css/themes/style.css" rel="stylesheet" type="text/css" id="style_color"/>
	<!-- <link href="<?php echo base_url()?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/> -->
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL PLUGIN STYLES --> 
	<link href="<?php echo base_url()?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url()?>assets/back_end/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" >
	<link href="<?php echo base_url()?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet" type="text/css">
	<link  href="<?php echo base_url()?>assets/pages/css/error.css" rel="stylesheet" type="text/css">
	<!-- <link href="<?php echo base_url()?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" /> -->
	<!-- <link href="<?php echo base_url()?>assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/> -->
	<!-- <link href="<?php echo base_url()?>assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" media="screen"/> -->
	<!-- <link href="<?php echo base_url()?>assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/> -->
	<!-- END PAGE LEVEL PLUGIN STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES --> 
	<!-- <link href="<?php echo base_url()?>assets/css/pages/tasks.css" rel="stylesheet" type="text/css" media="screen"/> -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/select2/select2_metro.css" /> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/data-tables/DT_bootstrap.css" /> -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/chosen-bootstrap/chosen/chosen.css" /> -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" /> -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/bootstrap-html5/bootstrap-wysihtml5.css" /> -->
	<!-- END PAGE LEVEL STYLES -->

	<link rel="shortcut icon" href="favicon.ico" />
	<script src="<?php echo base_url()?>assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
	
	<script src="<?php echo base_url()?>assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>  
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
	<!-- BEGIN HEADER -->   
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<?php echo $_header ?>
	</div>

	<div class="page-container">
		<div class="page-sidebar nav-collapse collapse">
			<?php echo $_sidebar?>
		</div>
		<div class="page-content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<!-- load dinamic content -->
						<?php echo $_content; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="footer">
		<?php echo $_footer ?>
	</div>

	
	
    
	<script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
	<script src="<?php echo base_url()?>assets/plugins/ckeditor/ckeditor.js" type="text/javascript" ></script>
	
	<!--[if lt IE 9]>
	<script src="assets/plugins/excanvas.min.js"></script>
	<script src="assets/plugins/respond.min.js"></script>  
	<![endif]-->   
	<script src="<?php echo base_url()?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
	<script src="<?php echo base_url()?>assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
	<script src="<?php echo base_url();?>assets/scripts/jquery.dataTables.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js" type="text/javascript"></script>
	
	<script src="<?php echo base_url()?>assets/scripts/app.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets/scripts/table-editable.js" type="text/javascript"></script>
	<!-- END PAGE LEVEL SCRIPTS -->  
	<script>
		jQuery(document).ready(function() {    
		   App.init(); // initlayout and core plugins
		   TableEditable.init();
		});
	</script>
</body>
</html>