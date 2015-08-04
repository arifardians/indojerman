<!-- BEGIN GOOGLE MAP -->
    <div class="row-fluid">
        <div id="map" class="gmaps margin-bottom-40" style="height:400px;"></div>
    </div>
    <!-- END GOOGLE MAP -->

    <!-- BEGIN CONTAINER -->   
    <div class="container min-hight">
        <div class="row-fluid">
            <div class="span9">
                <h2>Contact Form</h2>
                <p>Lorem ipsum dolor sit amet, Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat consectetuer adipiscing elit, sed diam nonummy nibh euismod tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                <div class="space20"></div>
                <!-- BEGIN FORM-->
                <form action="#" class="horizontal-form margin-bottom-40">
                    <div class="control-group">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input type="text" class="m-wrap span12" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" >Email <span class="color-red">*</span></label>
                        <div class="controls">
                            <input type="text" class="m-wrap span12" >
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" >Message</label>
                        <div class="controls">
                            <textarea class="m-wrap span12" rows="8"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn theme-btn"><i class="icon-ok"></i> Send</button>
                    <button type="button" class="btn">Cancel</button>
                </form>
                <!-- END FORM-->                  
            </div>

            <div class="span3">
                <h2>Our Contacts</h2>
                <address>
                    <strong>Indojerman, Org.</strong><br>
                    Jln. Kejawan Gebang<br>
                    Sukolilo, 601111<br>
                    <abbr title="Phone">P:</abbr> -
                </address>
                <address>
                    <strong>Email</strong><br>
                    <a href="mailto:#">info@indojerman.or.id</a><br>
                    <a href="mailto:#">support@indojerman.or.id</a>
                </address>
                <ul class="social-icons margin-bottom-10">
                    <li><a href="#" data-original-title="facebook" class="social_facebook"></a></li>
                    <li><a href="#" data-original-title="github" class="social_github"></a></li>
                    <li><a href="#" data-original-title="Goole Plus" class="social_googleplus"></a></li>
                    <li><a href="#" data-original-title="linkedin" class="social_linkedin"></a></li>
                    <li><a href="#" data-original-title="rss" class="social_rss"></a></li>
                </ul>

                <div class="clearfix margin-bottom-30"></div>

                <h2>About Us</h2>
                <p>Sediam nonummy nibh euismod tation ullamcorper suscipit</p>
                <ul class="unstyled">
                    <li><i class="icon-ok"></i> Officia deserunt molliti</li>
                    <li><i class="icon-ok"></i> Consectetur adipiscing </li>
                    <li><i class="icon-ok"></i> Deserunt fpicia</li>
                </ul>                                
            </div>            
        </div>
    </div>
    <!-- END CONTAINER -->

<script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/gmaps/gmaps.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/front_end/scripts/contact-us.js"></script>  
<script type="text/javascript">
    jQuery(document).ready(function() {    
           //App.init();
           ContactUs.init();
        });
</script>