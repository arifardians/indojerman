<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>Form Soal Lesen 1</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<form action="#"  class="form-horizontal" >
			
			<div class="control-group">
				<label class="control-label">Judul<span class="required">*</span></label>
				<label class="controls" style="margin-top:5px;"> <strong><?php echo $lesen->title; ?></strong> </label>
			</div>
			
			<div class="control-group">
				<label class="control-label">Image Upload</label>
				<div class="controls">
					<?php $image =  $lesen->image; ?>
					<?php if(isset($image) AND !empty($image)): ?>
						<img src="<?php echo base_url().''.$image;?>" max-width="300px"/>		
					<?php else: ?>		
						<img src="<?php echo base_url();?>assets/img/no_image.gif" alt="" />
					<?php endif; ?>
					
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Text<span class="required">*</span></label>
				<label class="controls" style="margin-top:6px;"><?php echo $lesen->text; ?></label>
			</div>

			<div class="form-actions">
				<!-- <button type="submit" name="submit" class="btn blue">  <i class="fa fa-edit"></i> Edit</button> -->
				<a href="<?php echo base_url()?>lesen_1/<?php echo $lesen->id?>" class="btn green"> <i class="fa fa-edit"></i> Edit</a>
				<a href="<?php echo base_url()?>lesen_1" class="btn"> <i class="fa fa-reply-all"> Cancel </i></a>
			</div>
		</form>
		<!-- END FORM-->
	</div>

</div> 
