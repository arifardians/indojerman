<!-- BEGIN SIDEBAR MENU -->
			<ul class="page-sidebar-menu">
				<li>
					<div class="sidebar-toggler hidden-phone"> </div>
				</li>
				<li>
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<!-- <form class="sidebar-search">
						<div class="input-box">
							<a href="javascript:;" class="remove"></a>
							<input type="text" placeholder="Search..." />
							<input type="button" class="submit" value=" " />
						</div>
					</form> -->
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
				<li class="start <?php echo $this->router->class == 'dashboard_controller' ? 'active' : '' ?>">
					<a href="<?php echo base_url()?>dashboard">
					<i class="fa fa-home"></i>
					<span class="title">Dashboard</span>
					<span class="selected"></span>
					</a>
				</li>

				<!-- BEGIN FRONT DEMO -->
				<li class="tooltips <?php echo $this->router->class == 'soalstructure_controller'
									|| $this->router->class == 'soalreading_controller'
									|| $this->router->class == 'soallistening_controller' ? 'active' : ''  ?>"
									data-placement="right" data-original-title="Dashboar&nbsp;Untuk&nbsp;Artikel&nbsp;Admin">
					<a href="javascript:;">
					<i class="fa fa-file"></i>
					<span class="title">Soal</span>
					<span class="arrow <?php echo $this->router->class == 'soalstructure_controller'
									|| $this->router->class == 'soalreading_controller'
									|| $this->router->class == 'soallistening_controller' ? 'open' : ''  ?>"></span>
					<span class="selected"></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php echo $this->router->class == 'soalreading_controller'? 'active' : '' ?>">
							<a href="<?php echo base_url();?>read_text">Reading</a>
						</li>
						<li class="<?php echo $this->router->class == 'soalstructure_controller' ?'active':'' ?>">
							<a href="<?php echo base_url()?>soal_str">Structure</a>
						</li>
						<li class="<?php echo $this->router->class == 'soallistening_controller' ? 'active' : '' ?>">
							<a href="<?php echo base_url()?>soal_lst">Listening</a>
						</li>
					</ul>
				</li> 

				<li class="tooltips <?php echo $this->router->class == 'lesen_1_controller'
												   || $this->router->class == 'lesen_2_controller'
												   || $this->router->class == 'lesen_3_controller' ? 'active': '' ?>" 
												   data-placement="right" data-original-title="Dashboar&nbsp;Untuk&nbsp;Lesen&nbsp;Admin">
					<a href="javascript:;">
						<i class="fa fa-book"></i>
						<span class="title"> Lesen</span>
						<span class="arrow <?php echo $this->router->class == 'lesen_1_controller'
												   || $this->router->class == 'lesen_2_controller'
												   || $this->router->class == 'lesen_3_controller' ? 'open': '' ?>"></span>
						<span class="selected"></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php echo $this->router->class == 'lesen_1_controller' ? 'active' : '' ?>">
							<a href="<?php echo base_url(); ?>lesen_1"> Lesen Teil 1</a>
						</li>
						<li class="<?php echo $this->router->class == 'lesen_2_controller' ? 'active' : '' ?>">
							<a href="<?php echo base_url(); ?>lesen_2"> Lesen Teil 2</a>
						</li>
						<li class="<?php echo $this->router->class == 'lesen_3_controller' ? 'active' : '' ?>">
							<a href="<?php echo base_url();?>lesen_3"> Lesen Teil 3</a>
						</li>
					</ul>
				</li>

				<!-- HOREN SIDEBAR -->
				<li class="tooltips <?php echo $this->router->class == 'horen_1_controller'
												   || $this->router->class == 'horen_2_controller'
												   || $this->router->class == 'horen_3_controller' ? 'active': '' ?>" 
												   data-placement="right" data-original-title="Dashboar&nbsp;Untuk&nbsp;Horen&nbsp;Admin">
					<a href="javascript:;">
						<i class="fa fa-book"></i>
						<span class="title"> Horen</span>
						<span class="arrow <?php echo $this->router->class == 'horen_1_controller'
												   || $this->router->class == 'horen_2_controller'
												   || $this->router->class == 'horen_3_controller' ? 'open': '' ?>"></span>
						<span class="selected"></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php echo $this->router->class == 'horen_1_controller' ? 'active' : '' ?>">
							<a href="<?php echo base_url(); ?>horen_1"> Horen Teil 1</a>
						</li>
						<li class="<?php echo $this->router->class == 'horen_2_controller' ? 'active' : '' ?>">
							<a href="<?php echo base_url(); ?>horen_2"> Horen Teil 2</a>
						</li>
						<li class="<?php echo $this->router->class == 'horen_3_controller' ? 'active' : '' ?>">
							<a href="<?php echo base_url();?>horen_3"> Horen Teil 3</a>
						</li>
					</ul>
				</li>
				<!-- END HOREN SIDEBAR -->

				<!-- END FRONT DEMO -->
				<li class="tooltips <?php echo $this->router->class == 'kategori_controller'
											|| $this->router->class == 'tutorial_controller' ? 'active': '' ?>">
					<a href="javascript:;">
					<i class="fa fa-book"></i>
					<span class="title"> Tutorial</span>
					<span class="arrow <?php echo $this->router->class == 'kategori_controller'
											   || $this->router->class == 'tutorial_controller' ? 'open': '' ?>"></span>
					<span class="selected"></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php echo $this->router->class == 'kategori_controller' ? 'active' : '' ?>">
							<a href="<?php echo base_url()?>kategori">Kategori Tutorial</a>
						</li>
						<li class="<?php echo $this->router->class == 'tutorial_controller' ? 'active' : '' ?>">
							<a href="<?php echo base_url()?>tutorial">Tutorial</a>
						</li>
					</ul>
				</li>
				<li class="<?php echo $this->router->class == 'usergroup_controller'
								  ||  $this->router->class == 'user_controller' ? 'active' : '' ?>">
					<a href="javascript:;">
					<i class="fa fa-users"></i>
					<span class="title">Users</span>
					<span class="arrow <?php echo $this->router->class == 'usergroup_controller'
								  			  ||  $this->router->class == 'user_controller' ? 'open' : '' ?>"></span>
					<span class="selected"></span>
					</a>
					<ul class="sub-menu">
						<li class="<?php echo $this->router->class == 'user_controller' ? 'active' : '' ?>">
							<a href="<?php echo base_url()?>user">User</a>
						</li>
						<li class="<?php echo $this->router->class == 'usergroup_controller' ? 'active' : '' ?>">
							<a href="<?php echo base_url()?>user_group">User Group</a>
						</li>
					</ul>
				</li>
				<li class="<?php echo $this->router->class == 'berita_controller' ? 'active' : '' ?>">
					<a href="<?php echo base_url()?>berita">
					<i class="fa fa-mortar-board"></i>
					<span class="title">News</span>
					<span class="selected"></span>
					</a>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class="fa fa-star"></i>
					<span class="title">Testimony</span>
					</a>
				</li>
			</ul>
			<!-- END SIDEBAR MENU -->
