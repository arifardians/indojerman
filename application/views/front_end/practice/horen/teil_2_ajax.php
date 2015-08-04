<?php 
    $soals   = $this->session->userdata('horen_1_soals');
    $answers = $this->session->userdata('horen_1_answers');

    $soal    = $soals[$i]; 
    $answer  = $answers[$soal->id];

?>
<input type="hidden" id="no_soal" name="no_soal" value="<?php echo $i; ?>">
<div class="control-group">
    <div class="controls-label">
        <label class="label label-important" style="padding:10px"> Pertanyaan </label>
        <br/><br/>
        <audio id="audio_file" src="<?php echo base_url().$soal->sound;?>" ></audio>
        <br/>
        <label> <strong><?php echo $soal->statement; ?> </strong> </label>
    </div>   
    <div class="controls-label">
        <label class="label label-success" style="padding:10px;margin-top:15px;"> Pilihan Jawaban </label> 
        <?php 
                $opsi1 = array('label' => 'Richtig', 'value' => 1);
                $opsi2 = array('label' => 'Falsch', 'value' => 0 );
                $options = array();

                array_push($options, $opsi1); 
                array_push($options, $opsi2);
            ?>
        <?php foreach ($options as $option): ?>
            <label class="radio" style="margin-left:20px;">
                <?php if($option['value'] == $answer): ?>
                    <input type="radio" name="jawaban" value="<?php echo $option['value'];?>" checked />
                <?php else: ?>
                    <input type="radio" name="jawaban" value="<?php echo $option['value'];?>" />
                <?php endif; ?>
                <?php echo $option['label']; ?>
            </label>
        <?php endforeach; ?>
    </div>
</div>
<script type="text/javascript">
    audiojs.events.ready(function() {
    var as = audiojs.createAll({
        autoplay: true
    });
  });
</script>

<script type="text/javascript">
    var no_soal = $("#no_soal").val(); 
    // console.log("no soal : "+no_soal);
    var jumlah_soal = $("#jumlah_soal").text();
    jumlah_soal = parseInt(jumlah_soal);

    var progress_bar = $("#progress_bar");
    var progress_text = $("#progress_text");
    var current_progress = (no_soal/jumlah_soal) *100; 
    progress_bar.css('width', current_progress+'%');

    var current_soal = $("#current_soal");
    current_soal.text(parseInt(no_soal)+1);

    var nomor_soal = parseInt(no_soal)+1; 
    var btn_prev = $("#btn_prev");  
    var btn_next = $("#btn_next"); 
  

    if(nomor_soal == 1){
        btn_prev.attr("disabled");
    }else if(nomor_soal ==  jumlah_soal){
        btn_next.attr("disabled");
    }else{
       btn_prev.removeAttr("disabled");
       btn_next.removeAttr("disabled");
    }

</script>