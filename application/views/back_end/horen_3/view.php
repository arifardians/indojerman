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
					<label style="margin-top:7px;"><?php echo $horen->question;?></label>
				</div>
			</div>	

			<div class="control-group">
				<label class="control-label">Sound <span class="required">*</span> </label>
				<div class="controls">
					<audio src="<?php echo base_url().$horen->sound; ?>" preload="auto" />
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Text<span class="required">*</span></label>
				<div class="controls">
					<label style="margin-top:7px;"><?php echo $horen->text;?></label>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Hint</label>
				<div class="controls">
					<label style="margin-top:7px;"><?php echo $horen->hint;?></label>
				</div>
			</div>

			<?php $i = 1; ?>
			<?php foreach ($options as $option): ?>
			<div class="control-group">
				<label class="control-label">Opsi <?php echo $i ?></label>	
				<div class="controls">
					<label style="margin-top:7px;"><?php echo $option->text;?></label>
				</div>				
			</div>
			<?php $i++; ?>
			<?php endforeach; ?>

		 	<div class="control-group">
				<label class="control-label"> Jawaban Benar : </label>
				<div class="controls">
					<?php $i = 1; ?>
					<?php foreach ($options as $option):?>
						<?php if($option->value == 1): ?>
							<label style="margin-top:7px;"><?php echo "opsi ".$i;?></label>
						<?php endif; ?>
						<?php $i++; ?>
					<?php endforeach; ?>
				</div>
			</div> 

				
			<div class="form-actions">
				<a href="<?php echo base_url()?>horen_3/<?php echo $horen->id;?>" class="btn blue"> <i class="fa fa-edit"> Edit </i></a>
				<a href="<?php echo base_url()?>horen_3" class="btn"> <i class="fa fa-mail-reply"> Cancel </i></a>
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
