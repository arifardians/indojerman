<!-- ajax to initiate header -->
<div id="header_crud"></div>
<input type="hidden" id="lesen_id" value="<?php echo $lesen->id;?>">
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<input type="hidden" id="router_class" value="<?php echo $this->router->class; ?>">

<!-- end ajax to initiate header -->


<div id="view_lesen"></div>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>Form Soal Lesen 1</div>
		
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<form action="<?php echo base_url()?>lesen_1_add_soal/<?php echo $lesen->id;?>" method="post" id="form_sample_2" class="form-horizontal" enctype="multipart/form-data">
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
				<label class="control-label">Statement<span class="required">*</span></label>
				<div class="controls">
					<textarea name="statement" class="span10 m-wrap" rows="2" placeholder="input statement"></textarea>
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
					<select class="medium m-wrap" tabindex="1" name="answer">
						<?php foreach ($options as $option):?>
							<option value="<?php echo $option['value'] ?>"> <?php echo $option['label']; ?> </option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			
			<div class="form-actions">
				<button type="submit" name="submit" class="btn blue">Submit</button>
				<a href="<?php echo base_url()?>lesen_1/<?php echo $lesen->id;?>" class="btn"> <i class="fa fa-mail-reply"> Cancel </i></a>
			</div>
		</form>
		<!-- END FORM-->
	</div>

</div> 


<script src="<?php echo base_url()?>assets/scripts/back_end_header/load_header_back_end.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/scripts/back_end_header/lesen_1_load_view.js" type="text/javascript"></script>
