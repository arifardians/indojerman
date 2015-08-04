<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>Form Soal Lesen 1</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<form action="#"  class="form-horizontal" >
			
			<div class="control-group">
				<label class="control-label">Pertanyaan<span class="required">*</span></label>
				<label class="controls" style="margin-top:5px;"> <strong><?php echo $lesen->question; ?></strong> </label>
			</div>
			
			
			<div class="control-group">
				<label class="control-label">Penjelasan<span class="required">*</span></label>
				<label class="controls" style="margin-top:6px;"><?php echo $lesen->explanation; ?></label>
			</div>

			<div class="form-actions">
				<a href="<?php echo base_url()?>lesen_2/<?php echo $lesen->id?>" class="btn green"> <i class="fa fa-edit"></i> Edit</a>
				<a href="<?php echo base_url()?>lesen_2" class="btn"> <i class="fa fa-reply-all"> Cancel </i></a>
			</div>
		</form>
		<!-- END FORM-->
	</div>

</div> 
