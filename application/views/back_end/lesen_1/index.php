<!-- ajax to initiate header -->
<div id="header_crud"></div>
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<input type="hidden" id="router_class" value="<?php echo $this->router->class; ?>">
<!-- end ajax to initiate header -->


<div class="portlet box green
">
	<div class="portlet-title">
		<div class="caption"><i class="icon-globe"></i>Table list of lesen</div>
	</div>
	<div class="portlet-body">
		<a href="<?php echo base_url()?>lesen_1_add" class="btn green"><i class="fa fa-plus-circle"></i> Tambah Soal</a>
		<br> &nbsp;
		<br>

		<?php
			echo $this->table->generate();
		?>
		<div class="my-pagination">
			&nbsp;
			<?php echo $this->pagination->create_links(); ?>
			&nbsp;
		</div>
	</div>
</div>

<?php echo $this->router->class; ?>

<script src="<?php echo base_url()?>assets/scripts/back_end_header/load_header_back_end.js" type="text/javascript"></script>
