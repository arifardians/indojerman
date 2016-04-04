<h3 class="page-title"> Admin Dashboard <small></small> </h3>

<ul class="breadcrumb">
	<li>
		<i class="fa fa-home"></i> <a href="#"> Dashboard</a> 
	</li>
</ul>


<!-- BEGIN DASHBOARD STATS -->
<div class="row-fluid">
	<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
		<div class="dashboard-stat blue">
			<div class="visual">
				<i class="fa fa-users fa-2x"></i>
			</div>
			<div class="details">
				<div class="number">
					<?php echo $total_user ?>
				</div>
				<div class="desc">                           
					Total User
				</div>
			</div>
			<a class="more" href="#">
			View more <i class="m-icon-swapright m-icon-white"></i>
			</a>                 
		</div>
	</div>
	<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
		<div class="dashboard-stat green">
			<div class="visual">
				<i class="fa fa-shopping-cart fa-2x"></i>
			</div>
			<div class="details">
				<div class="number"><?php echo $total_exam; ?></div>
				<div class="desc">Total Exams</div>
			</div>
			<a class="more" href="#">
			View more <i class="m-icon-swapright m-icon-white"></i>
			</a>                 
		</div>
	</div>
	<div class="span3 responsive" data-tablet="span6  fix-offset" data-desktop="span3">
		<div class="dashboard-stat purple">
			<div class="visual">
				<i class="fa fa-globe fa-2x"></i>
			</div>
			<div class="details">
				<div class="number"><?php echo round($average_horen, 2) ?></div>
				<div class="desc">Average Horen Score</div>
			</div>
			<a class="more" href="#">
			View more <i class="m-icon-swapright m-icon-white"></i>
			</a>                 
		</div>
	</div>
	<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
		<div class="dashboard-stat yellow">
			<div class="visual">
				<i class="fa fa-bar-chart fa-2x"></i>
			</div>
			<div class="details">
				<div class="number"><?php echo round($average_lesen, 2) ?></div>
				<div class="desc">Average Lesen Score</div>
			</div>
			<a class="more" href="#">
			View more <i class="m-icon-swapright m-icon-white"></i>
			</a>                 
		</div>
	</div>
</div>
<!-- END DASHBOARD STATS -->
<!-- BEGIN ALERTS PORTLET-->
<!-- <div class="portlet ">
	<div class="portlet-title">
		<div class="caption"><i class="icon-cogs"></i>Alerts</div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="#portlet-config" data-toggle="modal" class="config"></a>
			<a href="javascript:;" class="reload"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body">
		<div class="alert">
			<button class="close" data-dismiss="alert"></button>
			<strong>Warning!</strong> Your monthly traffic is reaching limit.
		</div>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert"></button>
			<strong>Success!</strong> The page has been added.
		</div>
		<div class="alert alert-info">
			<button class="close" data-dismiss="alert"></button>
			<strong>Info!</strong> You have 198 unread messages.
		</div>
		<div class="alert alert-error">
			<button class="close" data-dismiss="alert"></button>
			<strong>Error!</strong> The daily cronjob has failed.
		</div>
	</div>
</div> -->
<!-- END ALERTS PORTLET-->
