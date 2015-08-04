<!-- ajax to initiate header -->
<div id="header_crud"></div>
<input type="hidden" id="horen_id" value="<?php echo $horen->id;?>">
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<input type="hidden" id="router_class" value="<?php echo $this->router->class; ?>">
<!-- end ajax to initiate header -->


<div id="view_horen"></div>

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>Form Soal Horen 1</div>
	</div>

	<div class="portlet-body form">
		<br>
		<form action="<?php echo base_url()?>horen_1_opsi_add/<?php echo $horen->id; ?>" method="post" id="form_sample_2" class="form-horizontal" enctype="multipart/form-data">
			<div class="control-group">
				<label class="control-label">Text<span class="required">*</span></label>
				<div class="controls">
					<textarea name="text" class="span10 m-wrap" rows="2" placeholder="Input Text"></textarea>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Image Upload <span class="required">*</span> </label>
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
				<label class="control-label">Hint</label>
				<div class="controls">
					<textarea class="span10 ckeditor m-wrap" name="hint"></textarea>
				</div>
			</div>

			<?php 
				$opsi1 = array('label' => 'False', 'value' => 0 );
				$opsi2 = array('label' => 'True', 'value' => 1);
				$options = array();

				array_push($options, $opsi1); 
				array_push($options, $opsi2);
			?>

			<div class="control-group">
				<label class="control-label">Nilai <span class="required">*</span> </label>
				<div class="controls">
					<select class="medium m-wrap" tabindex="1" name="value">
						<?php foreach ($options as $option):?>
							<option value="<?php echo $option['value'] ?>"> <?php echo $option['label']; ?> </option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="form-actions">
				<button type="submit" name="submit" class="btn green">Submit</button>
				<a href="<?php echo base_url()?>horen_1_prev/<?php echo $horen->id; ?>" class="btn"> <i class="fa fa-mail-reply"> Cancel </i></a>
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>
<script src="<?php echo base_url()?>assets/scripts/back_end_header/load_header_back_end.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/scripts/back_end_header/horen_1_load_view.js" type="text/javascript"></script>

  