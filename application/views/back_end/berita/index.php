<h3 class="page-title"> Berita <small>CRUD berita </small> </h3>

<ul class="breadcrumb">
	<li>
		<i class="fa fa-home"></i> <a href="#"> Home</a> &nbsp; <i class="fa fa-angle-right"></i> &nbsp;
	</li>
	<li>
		<a href="#">berita</a>
	</li>
</ul>


<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption"><i class="icon-globe"></i>Table list of news</div>
		<div class="tools">
			<a href="javascript:;" class="reload"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body">
		<br>
		<a href="<?php echo base_url()?>berita_add" class="btn green"><i class="fa fa-plus-circle"></i> Tambah Soal</a>
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

