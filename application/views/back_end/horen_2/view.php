<!-- ajax to initiate header -->
<div id="header_crud"></div>
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<input type="hidden" id="router_class" value="<?php echo $this->router->class; ?>">

<!-- end ajax to initiate header -->

<script src="<?php echo base_url()?>assets/scripts/audiojs/audio.min.js" type="text/javascript"></script>


<br>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>Form Soal Horen 2</div>
		
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<form action="<?php echo base_url()?>horen_2/<?php echo $horen->id; ?>" method="post" id="form_sample_2" class="form-horizontal" enctype="multipart/form-data">
			<?php $errors = $this->session->userdata('errors'); ?>
			<?php if(isset($errors) AND !empty($errors)):?>
			<div class="alert alert-error">
				<button class="btn red pull-right" data-dismiss="alert"><i class="fa fa-close"></i></button>
				Terdapat kesalahan pada input data: <br>
				<?php echo $this->session->userdata('errors'); ?> 
				<?php $this->session->unset_userdata('errors') ?>
			</div>
			<?php endif; ?>
			<div class="alert alert-success hide">
				<button class="close" data-dismiss="alert"></button>
				Input data berhasil!
			</div>
			<div class="control-group">
				<label class="control-label">Statement <span class="required">*</span></label>
				<div class="controls">
					<label style="margin-top:7px;"><?php echo $horen->statement;?></label>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Text<span class="required">*</span></label>
				<div class="controls">
					<label style="margin-top:7px;"><?php echo $horen->text;?></label>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Sound <span class="required">*</span> </label>
				<div class="controls">
					<audio src="<?php echo base_url().$horen->sound; ?>" preload="auto" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Hint<span class="required">*</span></label>
				<div class="controls">
					<label style="margin-top:7px;"><?php echo $horen->hint;?></label>
				</div>
			</div>

			
			<div class="control-group">
				<label class="control-label">Nilai <span class="required">*</span> </label>
				<div class="controls">
					<label style="margin-top:7px;"><?php echo $horen->value==1 ? 'True' : 'False';?></label>
				</div>
			</div>

			<div class="form-actions">
				<a href="<?php echo base_url()?>horen_2/<?php echo $horen->id; ?>" class="btn blue"> <i class="fa fa-edit"> Edit </i></a>
				<a href="<?php echo base_url()?>horen_2" class="btn"> <i class="fa fa-mail-reply"> Cancel </i></a>
			</div>
		</form>
		<!-- END FORM-->
	</div>

</div> 

<script src="<?php echo base_url()?>assets/scripts/back_end_header/load_header_back_end.js" type="text/javascript"></script>
<script type="text/javascript">
	audiojs.events.ready(function() {
    	var as = audiojs.createAll();
  	});
</script>
