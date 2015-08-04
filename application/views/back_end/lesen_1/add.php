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
		<form action="<?php echo base_url()?>lesen_1_add" method="post" id="form_sample_2" class="form-horizontal" enctype="multipart/form-data">
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
				<label class="control-label">Judul<span class="required">*</span></label>
				<div class="controls">
					<textarea name="title" class="span10 m-wrap" rows="2" placeholder="judul text soal"></textarea>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Image Upload</label>
				<div class="controls">
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
							<img src="<?php echo base_url();?>assets/img/no_image.gif" alt="" />
						</div>
						<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
						<div>
							<span class="btn btn-file"><span class="fileupload-new">Select image</span>
							<span class="fileupload-exists">Change</span>
							<input type="file" name="image" class="default" /></span>
							<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
						</div>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Text<span class="required">*</span></label>
				<div class="controls">
					<textarea class="span10 ckeditor m-wrap" name="text" rows="12" placeholder="teks soal"></textarea>
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
