<h3 class="page-title"> Soal Reading <small>CRUD soal reading</small> </h3>

<ul class="breadcrumb">
	<li>
		<i class="fa fa-home"></i> &nbsp; <a href="#"> Home</a> &nbsp; <i class="fa fa-angle-right"></i> &nbsp;
	</li>
	<li>
		<a href="#">Soal reading</a>
	</li>
</ul>

<br>
<div class="portlet box light-grey">
	<div class="portlet-title">
		<div class="caption"><i class="icon-globe"></i>Table soal reading</div>
		<div class="tools">
			<a href="javascript:;" class="reload"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body">
		<a href="<?php echo base_url()?>read_text_add" class="btn green"> <i class="fa fa-plus-circle"></i> Tambah Artikel</a>
		<br>
		<br>
		<?php
			echo $this->table->generate();
		?>
		<div id="pagination">
			&nbsp;
			<?php echo $this->pagination->create_links(); ?>
			&nbsp;
		</div>
	</div>
</div>
