    <?php 
        $soals = $this->session->userdata('lesen_2_soals');
        $options_all = $this->session->userdata('lesen_2_options'); 
        $answers = $this->session->userdata('lesen_2_answers');


        $soal = $soals[$i];
        $options = $options_all[$soal->id];
        $answer = $answers[$soal->id];
        
       

    ?>

    <input type="hidden" id="no_soal" name="no_soal" value="<?php echo $i; ?>">
    <input type="hidden" id="base_url" value="<?php echo base_url() ?>" />

    <div class="control-group">
        <div class="controls-label">
            <label class="label label-important" style="padding:10px"> Pertanyaan </label>
            <label> <strong><?php echo $soal->question; ?> </strong> </label>
         </div>   
            <br/>
            <div class="span12">
                <div class="row">
                    <?php foreach ($options as $option ): ?>
                        <div class="span6">
                            <label><?php echo $option->statement; ?></label>
                            <img src="<?php echo base_url().$option->image; ?>" style="width: 100%; max-width: 400px;">
                        </div>
                    <?php endforeach; ?>
                     
                </div>
            </div>

        <div class="controls-label">
            <label class="label label-success" style="padding:10px;margin-top:15px;"> Pilihan Jawaban </label> 
            
            <?php foreach ($options as $option): ?>
            <label class="radio" style="margin-left:20px;">
                <?php if($option->id == $answer): ?>
                    <input type="radio" name="jawaban" value="<?php echo $option->id;?>" checked>
                <?php else: ?>
                    <input type="radio" name="jawaban" value="<?php echo $option->id;?>">
                <?php endif; ?>

                <?php echo $option->statement; ?>
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