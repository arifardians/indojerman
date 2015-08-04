<h3 class="page-title"> Berita <small>CRUD berita</small> </h3>

<ul class="breadcrumb">
	<li>
		<i class="fa fa-home"></i> <a href="#"> Home</a> &nbsp; <i class="fa fa-angle-right"></i> &nbsp;
	</li>
	<li>
		<a href="#"> Berita </a>
	</li>
</ul> 

<br>
	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption"><i class="icon-reorder"></i>Form Soal Structure</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="#portlet-config" data-toggle="modal" class="config"></a>
				<a href="javascript:;" class="reload"></a>
				<a href="javascript:;" class="remove"></a>
			</div>
		</div>
		<div class="portlet-body form">
			<!-- BEGIN FORM-->
			<form action="<?php echo base_url()?>index.php/back_end/berita_controller/add" method="post" id="form_sample_2" class="form-horizontal" enctype="multipart/form-data">
				<div class="alert alert-error hide">
					<button class="close" data-dismiss="alert"></button>
					Terdapat kesalahan pada input data. Coba periksa kembali. 
				</div>
				<div class="alert alert-success hide">

					<button class="close" data-dismiss="alert"></button>
					Input data berhasil!
				</div>
				<div class="control-group">
					<label class="control-label">Judul<span class="required">*</span></label>
					<div class="controls">
						<input type="text" name="judul" placeholder="nama kategori" class="span6 m-wrap">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Image Upload</label>
					<div class="controls">
						<div class="fileupload fileupload-new" data-provides="fileupload">
							<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
								<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
							</div>
							<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
							<div>
								<span class="btn btn-file"><span class="fileupload-new">Select image</span>
								<span class="fileupload-exists">Change</span>
								<input type="file" class="default" /></span>
								<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
							</div>
						</div>
					</div>
				</div>

	
				<div class="control-group">
					<label class="control-label">Isi berita<span class="required">*</span></label>
					<div class="controls">
						<textarea class="span10 ckeditor m-wrap" name="isi" rows="3" placeholder="isi berita"></textarea>
					</div>
				</div>

				<div class="form-actions">
					<button type="submit" name="submit" class="btn green">Submit</button>
					<a href="<?php echo base_url()?>berita" class="btn"> <i class="fa fa-mail-reply"> Cancel </i></a>
				</div>
			</form>
			<!-- END FORM-->
		</div>

	</div> 
