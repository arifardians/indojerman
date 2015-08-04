<div class="container">
            <div class="navbar">
                <div class="navbar-inner">
				
                    <!-- BEGIN LOGO (you can use logo image instead of text)-->
                    <a class="brand logo-v1" href="<?php echo base_url(); ?>">
                        <h2> <strong><font color="#0DA3E2"> INDOJER</font><font color="#7C858E">MAN</font> </strong> </h2>
                        <!-- <img src="<?php echo base_url(); ?>assets/img/logo_blue.png" id="logoimg" alt=""> -->
                    </a>
                    <!-- END LOGO -->

                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->

                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li class="<?php echo $this->uri->segment(1)==''? 'active':''; ?>"> <a href="<?php echo base_url();?>"> Home </a> </li>
                            <li class="dropdown <?php echo $this->uri->segment(1) == 'jenis_tutorial' OR $this->uri->segment(1) == 'detail_tutorial'? 'active':''; ?>">
                                <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">
                                    Tutorial
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php  
                                      $categories =  kategori_helper();
                                     ?>
                                    <?php foreach ($categories as $category): ?>
                                        <li> <a href="<?php echo base_url();?>jenis_tutorial/<?php echo $category->id?>"><?php echo $category->nama; ?></a> </li>
                                     <?php endforeach; ?>   
                                    
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">
                                    Latihan Lesen
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url();?>lesen_practice/teil_1">Lesen Teil 1</a></li>
                                    <li><a href="<?php echo base_url();?>lesen_practice/teil_2">Lesen Teil 2</a></li>
                                    <li><a href="<?php echo base_url();?>lesen_practice/teil_3">Lesen Teil 3</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">
                                    Latihan Hören 
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url();?>horen_practice/teil_1">Hören Teil 1</a></li>
                                    <li><a href="<?php echo base_url();?>horen_practice/teil_2">Hören Teil 2</a></li>
                                    <li><a href="<?php echo base_url();?>horen_practice/teil_3">Hören Teil 3</a></li>
                                </ul>
                            </li>      
                            
                            <li><a href="<?php echo base_url();?>contacts">Hubungi kami</a></li>
                           
                            <?php if($this->session->userdata('is_logged_in')==TRUE): ?>
                            <li class="dropdown"> 
                                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">
                                <?php echo $this->session->userdata('email'); ?></a> 
                                <ul class="dropdown-menu">
                                    <li> <a href="<?php echo base_url()?>my_dashboard">Dashboad</a> </li>
                                    <!-- <li> <a href="#"> Pengaturan </a></li>
                                    <li> <a href="#"> Statistik </a> </li> -->
                                    <li> <a href="<?php echo base_url()?>logout"> Logout </a> </li>
                                </ul>
                            </li>    
                            <?php else:  ?>
                            <li><a href="<?php echo base_url();?>login_user">Login</a></li>
                            <?php endif; ?>
                            <li class="menu-search">
                                <span class="sep"></span>
                                <i class="icon-search search-btn"></i>
                            </li>
                        </ul>
                        <div class="search-box">
                            <div class="input-append">
                                <form>
                                    <input style="background:#fff;" class="m-wrap" type="text" placeholder="Search" />
                                    <button type="submit" class="btn theme-btn">Go</button>
                                </form>
                            </div>
                        </div>                            
                    </div>
                    <!-- BEGIN TOP NAVIGATION MENU -->
                </div>
            </div>
        </div>    