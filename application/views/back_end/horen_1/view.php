<!-- ajax to initiate header -->
<div id="header_crud"></div>
<input type="hidden" id="horen_id" value="<?php echo $horen->id;?>">
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<input type="hidden" id="router_class" value="<?php echo $this->router->class; ?>">
<!-- end ajax to initiate header -->


<div id="view_horen"></div>

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>Form Options Horen 1</div>
	</div>

	<div class="portlet-body form">
		<br>
		<a href="<?php echo base_url()?>horen_1_opsi_add/<?php echo $horen->id ?>" class="btn blue"> <span><i class="fa fa-plus-circle"></i></span> Tambah Option </a>
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
			<a href="<?php echo base_url()?>horen_1" class="btn"> <i class="fa fa-reply-all"></i> Back to Main Page</a>
		</div>
	</div>
</div>
<script src="<?php echo base_url()?>assets/scripts/back_end_header/load_header_back_end.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/scripts/back_end_header/horen_1_load_view.js" type="text/javascript"></script>

