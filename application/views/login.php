<h3 class="page-title"> Login Controller <small>Foam login admin</small> </h3>

<ul class="breadcrumb">
	<li>
		<i class="fa fa-home"></i> <a href="#"> Home</a> &nbsp; <i class="fa fa-angle-right"></i> &nbsp;
	</li>
	<li>
		<a href="#">Login Controller</a>
	</li>
</ul> 

<br>
	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption"><i class="icon-reorder"></i>Form Soal Structure</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="#portlet-config" data-toggle="modal" class="config"></a>
				<a href="javascript:;" class="reload"></a>
				<a href="javascript:;" class="remove"></a>
			</div>
		</div>
		<div class="portlet-body form">
			<!-- BEGIN FORM-->
			<form action="<?php echo base_url()?>index.php/login_controller/check_login" method="post" id="form_sample_2" class="form-horizontal" enctype="multipart/form-data">
				<div class="alert alert-error hide">
					<button class="close" data-dismiss="alert"></button>
					Terdapat kesalahan pada input data. Coba periksa kembali. 
				</div>
				<div class="alert alert-success hide">
					<button class="close" data-dismiss="alert"></button>
					Input data berhasil!
				</div>
				
				<div class="control-group">
					<label class="control-label">Username<span class="required">*</span></label>
					<div class="controls">
						<input type="text" name="username" class="span6 m-wrap" placeholder="username" />	
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Password<span class="required">*</span></label>
					<div class="controls">
						<input type="password" name="password" class="span6 m-wrap" placeholder="password" />	
					</div>
				</div>

					
				<div class="form-actions">
					<button type="submit" name="submit" class="btn green">Submit</button>
					<a href="<?php echo base_url()?>index.php/back_end/soalstructure_controller/" class="btn"> <i class="fa fa-mail-reply"> Cancel </i></a>
				</div>
			</form>
			<!-- END FORM-->
		</div>

	</div> 
