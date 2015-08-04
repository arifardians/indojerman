<h3 class="page-title"> Tutorial <small>CRUD tutorial</small> </h3>

<ul class="breadcrumb">
	<li>
		<i class="fa fa-home"></i> <a href="#"> Home</a> &nbsp; <i class="fa fa-angle-right"></i> &nbsp;
	</li>
	<li>
		<a href="#"> Tutorial</a>
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
		<form action="<?php echo base_url()?>index.php/back_end/tutorial_controller/edit/<?php echo $tutorial->id ?>" method="post" id="form_sample_2" class="form-horizontal" enctype="multipart/form-data">
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
				<label class="control-label">Judul Tutorial<span class="required">*</span></label>
				<div class="controls">
					<textarea name="judul" class="span10 m-wrap" rows="2" placeholder="judul tutorial" ><?php echo $tutorial->judul;?></textarea>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Kategori tutorial <span class="required">*</span></label>
				<div class="controls">
					<select name="kategori" class="span6 m-wrap">
						<?php foreach ($kategories as $kategori): ?>
							<?php if($kategori->id == $tutorial->id_kategori): ?>
								<option value="<?php echo $kategori->id ?>" selected = "selected"> <?php echo $kategori->nama?></option>
							<?php else: ?>
								<option value="<?php echo $kategori->id ?>"> <?php echo $kategori->nama ?></option>
							<?php endif; ?>
						<?php endforeach; ?>	
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Deskripsi</label>
				<div class="controls">
					<textarea class="span10 m-wrap" name="deskripsi" rows="3" placeholder="deskripsi *(max 150 karakter)" ><?php echo $tutorial->deskripsi; ?></textarea>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Image Upload</label>
				<div class="controls">
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
							<?php $image =  $tutorial->image; ?>
							<?php if(isset($image) AND !empty($image)): ?>
								<img src="<?php echo base_url().''.$image;?>">		
							<?php else: ?>		
							<img src="<?php echo base_url();?>assets/img/no_image.gif" alt="" />
							<?php endif; ?>
						</div>
						<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
						<div>
							<span class="btn btn-file"><span class="fileupload-new">Select image</span>
							<span class="fileupload-exists">Change</span>
							<input type="file" name="image" class="default" /></span>
							<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
						</div>
					</div>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Materi<span class="required">*</span></label>
				<div class="controls">
					<textarea class="span10 ckeditor m-wrap" name="materi" rows="12" placeholder="materi tutorial"><?php echo $tutorial->materi ?></textarea>
				</div>
			</div>

			<div class="form-actions">
				<button type="submit" name="submit" class="btn blue"> Submit </button>
				<a href="<?php echo base_url()?>tutorial" class="btn"> <i class="fa fa-mail-reply"> Cancel </i></a>
			</div>
		</form>
		<!-- END FORM-->
	</div>

</div> 

