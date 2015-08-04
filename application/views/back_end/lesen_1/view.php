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
		<br>
		<a href="<?php echo base_url()?>lesen_1_add_soal/<?php echo $lesen->id ?>" class="btn blue"> <span><i class="fa fa-plus-circle"></i></span> Tambah Soal </a>
		<br/><br/>
		<?php 
			echo $this->table->generate();
			
		?>
		<div id="pagination">
			&nbsp;
			<?php echo $this->pagination->create_links(); ?>
			&nbsp;
		</div>
		<div class="form-actions">
			<a href="<?php echo base_url()?>index.php/back_end/soalreading_controller/index" class="btn"> <i class="fa fa-reply-all"></i> Back to Main Page</a>
		</div>
	</div>
</div>
<script src="<?php echo base_url()?>assets/scripts/back_end_header/load_header_back_end.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/scripts/back_end_header/lesen_1_load_view.js" type="text/javascript"></script>

