<h3 class="page-title"> Structure Item <small>Detail soal structure</small> </h3>

<ul class="breadcrumb">
	<li>
		<i class="icon-home"></i> <a href="#"> Home</a> <i class="icon-angle-right"></i>
	</li>
	<li>
		<a href="#">Soal structure</a>
	</li>
</ul> 

<br>
<div class="span11">
	<div class="portlet box yellow">
		<div class="portlet-title">
			<div class="caption"><i class="icon-reorder"></i>Detail Soal Structure</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="#portlet-config" data-toggle="modal" class="config"></a>
				<a href="javascript:;" class="reload"></a>
				<a href="javascript:;" class="remove"></a>
			</div>
		</div>
	
		<div class="portlet-body form">
			<!-- BEGIN FORM-->
			<form action="#" class="form-horizontal">
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
						<textarea class="span8 m-wrap" name="soal" rows="3" disabled><?php echo $soal[0]['soal'] ?></textarea>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Jenis Soal<span class="required">*</span></label>
					<div class="controls">
						<select class="span6 m-wrap" name="jenis_soal" disabled>
							<option value="">Pilih kategori...</option>
							<?php foreach ($jenis_soal as $item): ?>
								<?php if($item['id'] == $soal[0]['id_jenis_soal']): ?>
									<option value="<?php echo $item['id'] ?>" selected="selected"> <?php echo $item['jenis'] ?></option>
								<?php else: ?>
									<option value="<?php echo $item['id'] ?>"> <?php echo $item['jenis'] ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
													
						</select>
					</div>
				</div>
		
				<div class="control-group">
					<label class="control-label">Penjelasan<span class="required">*</span></label>
					<div class="controls">
						<textarea class="span10 ckeditor m-wrap" name="penjelasan" rows="6" disabled><?php echo $soal[0]['penjelasan'] ?></textarea>
						<div id="editor2_error"></div>
					</div>
				</div>

				<?php 
					/*echo "<pre>"; 
					print_r($options);*/
				?>
				<?php $i = 1; ?>
				<?php foreach ($options as $option): ?>
				 <div class="control-group">
					<label class="control-label">Opsi <?php echo $i ?></label>	
					<div class="controls">
						<input type="text" name="opsi<?php echo $i ?>" disabled class="span6 m-wrap" value="<?php echo $option['opsi'] ?>">
					</div>				
				</div> 
				<?php $i++; ?>
				<?php endforeach; ?>

				<?php $i = 1; ?>
			 	<div class="control-group">
					<label class="control-label"> Jawaban Benar : </label>
					<div class="controls">
						<select class="small m-wrap" tabindex="1" name="answer" disabled>
							<?php foreach ($options as $option): ?>
								<?php if($option['nilai'] == 1): ?>
									<option value="<?php echo $i ?>" selected="selected">Opsi <?php echo $i?></option>
								<?php else: ?>
									<option value="<?php echo $i ?>">Opsi <?php echo $i?></option>
								<?php endif;?>
								<?php $i++; ?>
							<?php endforeach; ?>
						</select>
					</div>
				</div>  

					
				<div class="form-actions">
					<a href="<?php echo base_url()?>soal_str/<?php echo $soal[0]['id'] ?>" class="btn blue"> <i class="fa fa-edit"></i>Edit</a>
					<a href="<?php echo base_url()?>soal_str" class="btn yellow"> <i class="fa fa-reply-all"></i> Back to index</a>
				</div>
			</form>
			<!-- END FORM-->
		</div>

	</div> 
</div>