<?php 
    $soals      = $this->session->userdata('horen_3_soals'); 
    $options_all= $this->session->userdata('horen_3_options');
    $answers    = $this->session->userdata('horen_3_answers');

    $soal       = $soals[$i];
    $options    = $options_all[$soal->id]; 
    $answer     = $answers[$soal->id];
?>

<input type="hidden" id="no_soal" name="no_soal" value="<?php echo $i; ?>">
<div class="control-group">
    <div class="controls-label">
        <label class="label label-important" style="padding:10px"> Pertanyaan </label>
        <br/><br/>
        <audio src="<?php echo base_url().$soal->sound;?>"></audio>
        <br/>
        <label> <strong><?php echo $soal->question; ?> </strong> </label>
    </div>   
    <div class="controls-label">
        <label class="label label-success" style="padding:10px;margin-top:15px;"> Pilihan Jawaban </label> 
        
        <?php foreach ($options as $option): ?>
        <label class="radio" style="margin-left:20px;">
            <?php if($option->id == $answer): ?>
                <input type="radio" name="jawaban" value="<?php echo $option->id;?>" checked />
            <?php else: ?>    
                <input type="radio" name="jawaban" value="<?php echo $option->id;?>" />
            <?php endif; ?>
            <?php echo $option->text; ?>
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