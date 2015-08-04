<div class="row-fluid">
		<h2><strong><?php echo $title; ?></strong></h2>
	<div class="span3" style="border-right:1px solid #ddd;">
		<img src="<?php echo base_url();?>assets/img/medal.png">
		
		<div class="keterangan">Nilai Anda: </div>
		<div class="nilai"><?php echo $nilai_akhir; ?></div>
	</div>
	<div class="span6">
		<p> Selamat, anda telah menyelesaikan seluruh soal pada ujian sertifikasi untuk <strong>Bahasa Jerman</strong> ini. Terima kasih telah berpartisipasi dalam mengikuti dan mengerjakan ujian sertifikasi ini. </p>

		<div class="row-fluid">
			<div class="span3">
				<i class="fa fa-area-chart"></i> <span>Ujian</span><br/>
				<i class="fa fa-bar-chart"></i> <span>Jenis Ujian</span><br/>
				<i class="fa fa-line-chart"></i> <span>Nilai</span>
			</div>
			<div class="span6">
				: Sertifikasi A1 <br>
				: <?php echo $jenis_ujian; ?><br>
				: <?php echo $nilai_akhir; ?> <br/> <br/>
				<a href="<?php echo $button_link; ?>" class="btn blue big"><?php echo $button_label ?> <i class="fa fa-chevron-circle-right"></i> </a>
			</div>
		</div>
		
	</div>
</div>


<input type="hidden" name="no_soal" id="no_soal" value="<?php echo $i; ?>">
 <script type="text/javascript">
        var no_soal = $("#no_soal").val(); 
        // console.log("no soal : "+no_soal);
        var progress_bar = $("#progress_bar");
        var current_progress = (no_soal/3) *100; 
        progress_bar.css('width', current_progress+'%');

        var progress_text = $("#progress_text");
        progress_text.text("Progress | Selesai");

        var btn_jawab = $("#btn_jawab"); 
        var btn_prev = $("#btn_prev");
        var btn_next = $("#btn_next");

        btn_jawab.hide();
        btn_prev.hide();
        btn_next.hide();

</script>