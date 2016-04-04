<input type="hidden" id="no_soal" name="no_soal" value="<?php echo $i; ?>">
<div class="control-group">
    <div class="controls-label">
        <label class="label label-important" style="padding:10px"> Pertanyaan </label>
        <label> <strong><?php echo $lesen->question; ?> </strong> </label>
     </div>   
        <br/>
        <div class="span12">
            <div class="row">
                <?php foreach ($options as $option ): ?>
                    <div class="span6">
                        <label><?php echo $option->text; ?></label>
                        <img src="<?php echo base_url().$option->image; ?>" style="width: 100%; max-width: 400px;">
                    </div>
                <?php endforeach; ?>
                 
            </div>
        </div>

    <div class="controls-label">
        <label class="label label-success" style="padding:10px;margin-top:15px;"> Pilihan Jawaban </label> 
        
        <?php foreach ($options as $option): ?>
        <label class="radio" style="margin-left:20px;">
            <?php if($option->value == $answer): ?>
                <input type="radio" name="jawaban" value="<?php echo $option->value;?>" checked>
            <?php else: ?>
                 <input type="radio" name="jawaban" value="<?php echo $option->value;?>" >
            <?php endif; ?>
            <?php echo $option->text; ?>
        </label>
        <?php endforeach; ?>
    </div>
</div>
<script src="<?php echo base_url();?>assets/scripts/examination/exam_progress_bar.js" type="text/javascript"></script>