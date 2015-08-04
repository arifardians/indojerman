<!-- ajax to initiate header -->
<div id="header_crud"></div>
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<input type="hidden" id="router_class" value="<?php echo $this->router->class; ?>">
<!-- end ajax to initiate header -->
<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>Form Soal Horen 3</div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="#portlet-config" data-toggle="modal" class="config"></a>
			<a href="javascript:;" class="reload"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<form action="<?php echo base_url()?>horen_3/<?php echo $horen->id; ?>" method="post" id="form_sample_2" class="form-horizontal" enctype="multipart/form-data">
			<div class="alert alert-error hide">
				<button class="close" data-dismiss="alert"></button>
				Terdapat kesalahan pada input data. Coba periksa kembali. 
			</div>
			<div class="alert alert-success hide">
				<button class="close" data-dismiss="alert"></button>
				Input data berhasil!
			</div>

			<div class="control-group">
				<label class="control-label">Question<span class="required">*</span></label>
				<div class="controls">
					<textarea class="span8 m-wrap" name="question" rows="3"><?php echo $horen->question;?></textarea>
				</div>
			</div>	

			<div class="control-group">
				<label class="control-label">Sound <span class="required">*</span> </label>
				<div class="controls">
					<audio src="<?php echo base_url().$horen->sound; ?>" preload="auto" />
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Change Sound<span class="required">*</span></label>
				<div class="controls">
					<input type="file" name="sound" class="btn">
				</div>
			</div>							
			<div class="control-group">
				<label class="control-label">Text<span class="required">*</span></label>
				<div class="controls">
					<textarea class="span10 ckeditor m-wrap" name="text" ><?php echo $horen->text;?></textarea>
					<div id="editor2_error"></div>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Hint</label>
				<div class="controls">
					<textarea class="span10 ckeditor m-wrap" name="hint" ><?php echo $horen->hint;?></textarea>
					<div id="editor2_error"></div>
				</div>
			</div>

			<?php $i = 1; ?>
			<?php foreach ($options as $option): ?>
			<div class="control-group">
				<label class="control-label">Opsi <?php echo $i ?></label>	
				<div class="controls">
					<input type="text" name="opsi<?php echo $i ?>" value="<?php echo $option->text; ?>" class="span6 m-wrap">
					<input type="hidden" name="opsi_id<?php echo $i; ?>" value="<?php echo $option->id; ?>" />
				</div>				
			</div>
			<?php $i++; ?>
			<?php endforeach; ?>

		 	<div class="control-group">
				<label class="control-label"> Jawaban Benar : </label>
				<div class="controls">
					<select class="small m-wrap" tabindex="1" name="answer">
						<?php $i = 1; ?>
						<?php foreach ($options as $option):?>
							<?php if($option->value == 1): ?>
								<option value="<?php echo $i ?>" selected>Opsi <?php echo $i?></option>
							<?php else: ?>
								<option value="<?php echo $i ?>">Opsi <?php echo $i?></option>
							<?php endif; ?>
							<?php $i++; ?>
						<?php endforeach; ?>
					</select>
				</div>
			</div> 

				
			<div class="form-actions">
				<button type="submit" name="submit" class="btn green"> <i class="fa fa-check"></i> Submit</button>
				<a href="<?php echo base_url()?>index.php/back_end/soalstructure_controller/" class="btn"> <i class="fa fa-mail-reply"> Cancel </i></a>
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>

<script src="<?php echo base_url()?>assets/scripts/back_end_header/load_header_back_end.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/scripts/audiojs/audio.min.js" type="text/javascript"></script>
<script type="text/javascript">
	audiojs.events.ready(function() {
    	var as = audiojs.createAll();
  	});
</script>
