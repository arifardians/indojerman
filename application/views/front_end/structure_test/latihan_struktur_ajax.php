
    <?php $soals = $this->session->userdata('soals'); ?>
    <?php $options = $this->session->userdata('options'); ?>
    <?php $answers = $this->session->userdata('answers'); ?>

    <input type="hidden" name="no_soal" id="no_soal" value="<?php echo $i; ?>">
    <?php $soal = $soals[$i]; ?>
    <?php $current_answer = $answers[$soal->id];?>
    <div class="control-group">
        <div class="controls">
            <label class="label label-important" style="padding:10px"> Pertanyaan </label>
        </div>
        
        <div class="controls">
           <label style="margin:10px;"> <strong><?php echo $soal->soal; ?> </strong> </label>
            
            <label class="label label-success" style="padding:10px;"> Jawaban </label> 
            <?php foreach ($options[$soal->id] as $option): ?>
            <label class="radio" style="margin-left:20px;">
                <?php if($current_answer == $option->id): ?>
                    <input type="radio" name="jawaban" value="<?php echo $option->id;?>" checked>
                <?php else: ?>
                    <input type="radio" name="jawaban" value="<?php echo $option->id;?>">
                <?php endif; ?>    
                <?php echo $option->opsi; ?>
            </label>
            <?php endforeach; ?>
        </div>
    </div>
    
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
   
   