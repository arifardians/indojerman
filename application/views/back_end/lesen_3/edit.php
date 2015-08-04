<!-- ajax to initiate header -->
<div id="header_crud"></div>
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<input type="hidden" id="router_class" value="<?php echo $this->router->class; ?>">
<!-- end ajax to initiate header -->

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>Form Opsi Lesen 2</div>
	</div>

	<div class="portlet-body form">
		<br>
		<form action="<?php echo base_url()?>lesen_3/<?php echo $lesen->id;?>" method="post" id="form_sample_2" class="form-horizontal" enctype="multipart/form-data">
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
				<label class="control-label">Petunjuk<span class="required">*</span></label>
				<div class="controls">
					<textarea name="clue" class="span10 ckeditor m-wrap"><?php echo $lesen->clue;?></textarea>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Image Upload <span class="required">*</span> </label>
				<div class="controls">
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
							<?php $image =  $lesen->image; ?>
							<?php if(isset($image) AND !empty($image)): ?>
								<img src="<?php echo base_url().''.$image;?>">		
							<?php else: ?>		
							<img src="<?php echo base_url();?>assets/img/no_image.gif" alt="" />
							<?php endif; ?>
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
				<label class="control-label">Statement</label>
				<div class="controls">
					<textarea class="span10 ckeditor m-wrap" name="statement"><?php echo $lesen->statement;?></textarea>
				</div>
			</div>

			<?php 
				$opsi1 = array('label' => 'Richtig', 'value' => 1);
				$opsi2 = array('label' => 'Falsch', 'value' => 0 );
				$options = array();

				array_push($options, $opsi1); 
				array_push($options, $opsi2);
			?>

			<div class="control-group">
				<label class="control-label">Nilai <span class="required">*</span> </label>
				<div class="controls">
					<select class="medium m-wrap" tabindex="1" name="value">
						<?php foreach ($options as $option):?>
							<?php if($option['value'] == $lesen->value): ?>
								<option value="<?php echo $option['value'] ?>" selected="selected"> <?php echo $option['label']; ?> </option>
							<?php else: ?>
								<option value="<?php echo $option['value'] ?>"> <?php echo $option['label']; ?> </option>								
							<?php endif; ?>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="form-actions">
				<button type="submit" name="submit" class="btn green">Submit</button>
				<a href="<?php echo base_url()?>lesen_3" class="btn"> <i class="fa fa-mail-reply"> Cancel </i></a>
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>
<script src="<?php echo base_url()?>assets/scripts/back_end_header/load_header_back_end.js" type="text/javascript"></script>
	
