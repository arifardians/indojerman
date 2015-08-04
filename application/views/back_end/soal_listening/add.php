<h3 class="page-title"> Listening Item <small>Foam soal listening</small> </h3>

<ul class="breadcrumb">
	<li>
		<i class="fa fa-home"></i> <a href="#"> Home</a> &nbsp; <i class="fa fa-angle-right"></i> &nbsp;
	</li>
	<li>
		<a href="#">Soal listening</a>
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
		<form action="<?php echo base_url()?>index.php/back_end/soallistening_controller/add" method="post" id="form_sample_2" class="form-horizontal" enctype="multipart/form-data">
			<div class="alert alert-error hide">
				<button class="close" data-dismiss="alert"></button>
				Terdapat kesalahan pada input data. Coba periksa kembali. 
			</div>
			<div class="alert alert-success hide">
				<button class="close" data-dismiss="alert"></button>
				Input data berhasil!
			</div>
			<div class="control-group">
				<label class="control-label">Soal<span class="required">*</span></label>
				<div class="controls">
					<textarea class="span8 ckeditor m-wrap" name="soal" rows="3"></textarea>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Jenis Soal<span class="required">*</span></label>
				<div class="controls">
					<select class="span6 m-wrap" name="jenis_soal">
						<option value="">Pilih kategori...</option>
						<?php foreach ($jenis_soal as $item): ?>
							<option value="<?php echo $item['id'] ?>"> <?php echo $item['jenis'] ?></option>
						<?php endforeach; ?>
												
					</select>
				</div>
			</div>
	
			<div class="control-group">
				<label class="control-label">Penjelasan<span class="required">*</span></label>
				<div class="controls">
					<textarea class="span10 ckeditor m-wrap" name="penjelasan" rows="6"></textarea>
					<div id="editor2_error"></div>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Audio (max 5 Mb)<span class="required">*</span></label>
				<div class="controls">
					<input type="file" name="audio">
				</div>
			</div>
			<?php for ($i=1; $i <=4 ; $i++): ?>
			<div class="control-group">
				<label class="control-label">Opsi <?php echo $i ?></label>	
				<div class="controls">
					<input type="text" name="opsi<?php echo $i ?>" data-required="1" class="span6 m-wrap">
				</div>				
			</div>
			<?php endfor; ?>

		 	<div class="control-group">
				<label class="control-label"> Jawaban Benar : </label>
				<div class="controls">
					<select class="small m-wrap" tabindex="1" name="answer">
						<?php for ($i=1; $i<=4 ; $i++): ?>
							<option value="<?php echo $i ?>">Opsi <?php echo $i?></option>
						<?php endfor; ?>
					</select>
				</div>
			</div> 

				
			<div class="form-actions">
				<button type="submit" name="submit" class="btn green">Submit</button>
				<a href="<?php echo base_url()?>index.php/back_end/soalstructure_controller/" class="btn"> <i class="fa fa-mail-reply"> Cancel </i></a>
			</div>
		</form>
		<!-- END FORM-->
	</div>

</div> 
