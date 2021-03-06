<h3 class="page-title"> Reading Item <small>Foam soal reading</small> </h3>

<ul class="breadcrumb">
	<li>
		<i class="fa fa-home"></i> &nbsp; <a href="#"> Home</a> &nbsp; <i class="fa fa-angle-right"></i> &nbsp;
	</li>
	<li>
		<a href="#">Soal reading</a>
	</li>
</ul> 

<br>
	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption"><i class="icon-reorder"></i>Form Reading Text</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="#portlet-config" data-toggle="modal" class="config"></a>
				<a href="javascript:;" class="reload"></a>
				<a href="javascript:;" class="remove"></a>
			</div>
		</div>
		<div class="portlet-body form">
			<!-- BEGIN FORM-->
			<form action="<?php echo base_url()?>index.php/back_end/soalreading_controller/edit/<?php echo $reading_text['id']?>" method="post" id="form_sample_2" class="form-horizontal" enctype="multipart/form-data">
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
						<input type="text" name="judul" data-required="1" class="span6 m-wrap" value="<?php echo $reading_text['judul'] ?>" />
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Jenis Soal<span class="required">*</span></label>
					<div class="controls">
						<select class="span6 m-wrap" name="jenis_soal">
							<option value="">Pilih kategori...</option>
							<?php 
							foreach ($jenis_soal as $item):?>
							<?php if($reading_text['id_jenis_soal'] == $item['id']): ?>
								<option value="<?php echo $item['id'] ?>" selected="selected"><?php echo $item['jenis'] ?></option>
							<?php else: ?>
								<option value="<?php echo $item['id'] ?>" selected="selected"><?php echo $item['jenis'] ?></option>
							<?php endif; ?>
						<?php endforeach; ?>
						</select>
					</div>
				</div>
		
				<div class="control-group">
					<label class="control-label">Isi Artikel<span class="required">*</span></label>
					<div class="controls">
						<textarea class="span12 ckeditor m-wrap" name="isi" rows="6" data-error-container="#editor2_error"><?php echo $reading_text['isi'] ?></textarea>
						<div id="editor2_error"></div>
					</div>
				</div>

				
				<div class="form-actions">
					<button type="submit" name="submit" class="btn green">Submit</button>
					<a href="<?php echo base_url();?>index.php/back_end/soalreading_controller/" class="btn"> <span> <i class="fa fa-reply-all"></i></span> Cancel  </a>
				</div>
			</form>
			<!-- END FORM-->
		</div>
	</div> 

