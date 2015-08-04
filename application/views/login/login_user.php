 <!-- BEGIN BREADCRUMBS -->   
    <div class="row-fluid breadcrumbs margin-bottom-40">
        <div class="container">
            <div class="span4">
                <h1><?php echo $title ?></h1>
            </div>
            <div class="span8">
                <ul class="pull-right breadcrumb">
                    <?php for ($i=0; $i < count($breadcrumbs) ; $i++): ?>
                        <?php if($i == count($breadcrumbs)-1): ?>
                            <li class="active"><?php echo $breadcrumbs[$i]['title'] ?></li>
                        <?php else: ?>    
                        <li><a href="<?php echo $breadcrumbs[$i]['link'] ?>"><?php echo $breadcrumbs[$i]['title'] ?></a> <span class="divider">/</span></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    </div>
 <!-- END BREADCRUMBS -->
 <!-- BEGIN CONTAINER -->   
    <div class="container min-hight">
        <!-- BEGIN ABOUT INFO -->   
        <div class="row-fluid margin-bottom-30">
            <!-- BEGIN REGISTER BLOCK-->
            <div class="span5 space-mobile">
                <form action="<?php echo base_url();?>register_user" class="form-horizontal" method="POST">
                    <div class="control-group">
                            <h2>Belum punya akun ? Daftar disini !</h2>
                        <div class="controls">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">First Name</label>
                        <div class="controls">
                            <input type="text" name="first_name" class="m-wrap" placeholder="First Name">
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label">Last Name</label>
                        <div class="controls">
                            <input type="text" name="last_name" class="m-wrap" placeholder="Last Name">
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input type="text" name="email" class="m-wrap" placeholder="Email">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Password</label>
                        <div class="controls">
                            <input type="password" name="password" class="m-wrap" placeholder="Password">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Re-type Password</label>
                        <div class="controls">
                            <input type="password" name="password_confirmation" class="m-wrap" placeholder="Password Confirmation">
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls ">
                            <button type="submit" name="submit" class="btn blue">Register</button>
                        </div>
                    </div>
                </form>
            </div>    
            <!-- END REGISTER BLOCK-->

            <!-- BEGIN LOGIN BLOCK -->               
            <div class="span5 space-mobile">
                <h2 align="left">Login Indojerman</h2>
                <!-- BEGIN FORM LOGIN -->
                    <form action="<?php echo base_url();?>login_user" method="POST" class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">Username</label>
                            <div class="controls">
                                <input type="text" name="username" class="m-wrap" placeholder="Email">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Password</label>
                            <div class="controls">
                                <input type="password" name="password" class="m-wrap" placeholder="Password">
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" name="submit" class="btn blue">Login</button>
                                <span>&nbsp;&nbsp;&nbsp;</span>
                                <a href="#" class="m-wrap">Lupa password ? </a>
                            </div>
                        </div>
                    </form>
                <!-- END FORM LOGIN -->

            </div>
            <!-- END LOGIN BLOCK --> 
        </div>
        <!-- END ABOUT INFO --> 
    </div>   
 <!-- END CONTAINER -->   
