<br>
<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>Form Soal Horen 1</div>
		
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<form action="<?php echo base_url()?>horen_1/<?php echo $horen->id;?>" method="post" id="form_sample_2" class="form-horizontal" enctype="multipart/form-data">
			
			<div class="control-group">
				<label class="control-label">Question<span class="required">*</span></label>
				<div class="controls">
				 	<label style="margin-top:7px;">	<?php echo $horen->question; ?> </label>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">sound file</label>
				<div class="controls">
					<label style="margin-top:7px;"> <?php echo base_url().$horen->sound;?> </label>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Explanation<span class="required">*</span></label>
				<div class="controls">
					<label style="margin-top:7px;"><?php echo $horen->explanation; ?> </label> 
				</div>
			</div>

			<div class="form-actions">
				<a href="<?php echo base_url()?>horen_1/<?php echo $horen->id; ?>" class="btn green"> <i class="fa fa-edit"> Edit </i></a>
				<a href="<?php echo base_url()?>horen_1" class="btn"> <i class="fa fa-mail-reply"> Cancel </i></a>
			</div>
		</form>
		<!-- END FORM-->
	</div>

</div> 
