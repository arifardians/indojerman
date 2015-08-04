<!-- ajax to initiate header -->
<div id="header_crud"></div>
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<input type="hidden" id="router_class" value="<?php echo $this->router->class; ?>">

<!-- end ajax to initiate header -->

<br>
<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>Form Soal Lesen 1</div>
		
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<form action="<?php echo base_url()?>horen_1_add" method="post" id="form_sample_2" class="form-horizontal" enctype="multipart/form-data">
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
				<label class="control-label">Question<span class="required">*</span></label>
				<div class="controls">
					<textarea name="question" class="span10 ckeditor m-wrap"></textarea>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Sound (max 5 Mb)<span class="required">*</span></label>
				<div class="controls">
					<input type="file" name="sound">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Explanation<span class="required">*</span></label>
				<div class="controls">
					<textarea class="span10 ckeditor m-wrap" name="explanation"></textarea>
				</div>
			</div>

			<div class="form-actions">
				<button type="submit" name="submit" class="btn green">Submit</button>
				<a href="<?php echo base_url()?>lesen_1" class="btn"> <i class="fa fa-mail-reply"> Cancel </i></a>
			</div>
		</form>
		<!-- END FORM-->
	</div>

</div> 

<script src="<?php echo base_url()?>assets/scripts/back_end_header/load_header_back_end.js" type="text/javascript"></script>
