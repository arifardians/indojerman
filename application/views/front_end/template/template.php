<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>INDOJERMAN</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url()?>assets/front_end/css/reset.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url()?>assets/front_end/css/style-metro.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url()?>assets/front_end/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url()?>assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" />               
    <link href="<?php echo base_url()?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url()?>assets/plugins/bxslider/jquery.bxslider.css" rel="stylesheet" />          
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/revolution_slider/css/rs-style.css" media="screen">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/revolution_slider/rs-plugin/css/settings.css" media="screen">                
    <link href="<?php echo base_url()?>assets/front_end/css/style-responsive.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="<?php echo base_url()?>assets/front_end/css/themes/blue.css" rel="stylesheet" type="text/css" id="style_color"/>    
    <link rel="shortcut icon" href="favicon.ico" />
    <script src="<?php echo base_url();?>assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
    <!--Start of Zopim Live Chat Script-->
    <script type="text/javascript">
        window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
        d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
        _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
        $.src="//v2.zopim.com/?3DbEP5R1V7OJn3XE95vNMCkN2yHDA82X";z.t=+new Date;$.
        type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
    </script>
    <!--End of Zopim Live Chat Script-->
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body>
    <!-- BEGIN HEADER -->
    <div class="front-header">
        <?php echo $_header ?>
    </div>
    <!-- END HEADER -->

   
	
    <!-- BEGIN CONTAINER -->   
    <div>
        <!-- BEGIN SERVICE BOX -->   
       <?php echo $_content; ?>
    </div>
    <!-- END CONTAINER -->

    <!-- BEGIN FOOTER -->
    <div class="front-footer">
        <?php echo $_footer; ?>
    </div>
    <!-- END FOOTER -->

    <!-- BEGIN COPYRIGHT -->
    <div class="front-copyright">
        <div class="container">
            <div class="row-fluid">
                <div class="span8">
                    <p>
                        <span class="margin-right-10">2015 © Indojerman. ALL Rights Reserved.</span> 
                        <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
                    </p>
                </div>
                <div class="span4">
                    <ul class="social-footer">
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-google-plus"></i></a></li>
                        <li><a href="#"><i class="icon-dribbble"></i></a></li>
                        <li><a href="#"><i class="icon-linkedin"></i></a></li>
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-skype"></i></a></li>
                        <li><a href="#"><i class="icon-github"></i></a></li>
                        <li><a href="#"><i class="icon-youtube"></i></a></li>
                        <li><a href="#"><i class="icon-dropbox"></i></a></li>
                    </ul>                
                </div>
            </div>
        </div>
    </div>
    <!-- END COPYRIGHT -->

    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <script src="<?php echo base_url();?>assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- 
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/back-to-top.js"></script>    
     -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bxslider/jquery.bxslider.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/fancybox/source/jquery.fancybox.pack.js"></script>    
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/hover-dropdown.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/revolution_slider/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/revolution_slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script> 
    <!--[if lt IE 9]>
    <script src="assets/plugins/respond.min.js"></script>  
    <![endif]-->   
    <!-- END CORE PLUGINS -->   
    <script src="<?php echo base_url();?>assets/front_end/scripts/app.js"></script>         
    <script src="<?php echo base_url();?>assets/front_end/scripts/index.js"></script>    
    <script type="text/javascript">
        jQuery(document).ready(function() {
            App.init();    
            App.initBxSlider();
            Index.initRevolutionSlider();                    
        });
    </script>
    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>