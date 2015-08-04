<!-- ajax to initiate header -->
<div id="header_crud"></div>
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<input type="hidden" id="router_class" value="<?php echo $this->router->class; ?>">
<!-- end ajax to initiate header -->

<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>Form Soal Lesen 1</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<form action="#"  class="form-horizontal" >
			
			<div class="control-group">
				<label class="control-label">Petunjuk<span class="required">*</span></label>
				<label class="controls" style="margin-top:5px;"> <?php echo $lesen->clue; ?> </label>
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
				<label class="control-label">Statement<span class="required">*</span></label>
				<label class="controls" style="margin-top:6px;"> <strong>  <?php echo $lesen->statement; ?></strong></label>
			</div>

			<div class="control-group">
				<label class="control-label">Value<span class="required">*</span></label>
				<?php $answer = $lesen->value == 1? 'Richtig' : 'Falsch'; ?>
				<label class="controls" style="margin-top:6px;"><?php echo $answer; ?></label>
			</div>

			<div class="form-actions">
				<!-- <button type="submit" name="submit" class="btn blue">  <i class="fa fa-edit"></i> Edit</button> -->
				<a href="<?php echo base_url()?>lesen_3/<?php echo $lesen->id?>" class="btn green"> <i class="fa fa-edit"></i> Edit</a>
				<a href="<?php echo base_url()?>lesen_3" class="btn"> <i class="fa fa-reply-all"> Cancel </i></a>
			</div>
		</form>
		<!-- END FORM-->
	</div>

</div> 
<script src="<?php echo base_url()?>assets/scripts/back_end_header/load_header_back_end.js" type="text/javascript"></script>

