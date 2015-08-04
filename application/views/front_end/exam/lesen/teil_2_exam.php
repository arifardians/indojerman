<!-- BEGIN BREADCRUMBS -->    
    <div class="row-fluid breadcrumbs margin-bottom-40">
        <div class="container">
            <div class="span4">
                <h1><?php echo $title ?></h1>
            </div>
            <div class="span8">
                <ul class="pull-right breadcrumb">
                    <?php for ($i=0; $i < count($breadcrumbs) ; $i++): ?>
                        <?php if($i == count($breadcrumbs)-1): ?>
                            <li class="active"><?php echo $breadcrumbs[$i]['title'] ?></li>
                        <?php else: ?>    
                        <li><a href="<?php echo $breadcrumbs[$i]['link'] ?>"><?php echo $breadcrumbs[$i]['title'] ?></a> <span class="divider">/</span></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    </div>
 <!-- END BREADCRUMBS -->
<!-- BEGIN CONTAINER -->   
 <div class="container min-hight">
    <!-- BEGIN ABOUT INFO -->  
    <div class="row-fluid margin-bottom-5">
        <h2 class="block"><?php echo $title ?></h2>
        <div id="progress_text">Progress | Pertanyaan <span id="current_soal">1</span>  dari <span id="jumlah_soal"><?php echo count($this->session->userdata('lesen_exams')); ?></span> </div>
        <div class="progress">
            <div id="progress_bar" style="width:0%" class="bar"></div>
        </div>
    </div> 
    <div class="row-fluid margin-bottom-30">
        <!-- BEGIN LEFT BAR -->
        <div class="span9 blog-item margin-bottom-40" style="border-right: 1px solid #CFCFCF">
            <?php $i=0; ?>
            <form class="form-horizontal" id="soalForm" >
            <input type="hidden" id="base_url" value="<?php echo base_url(); ?>" />       
            <!-- RESULT AJAX -->
            <div id="result">
       
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
                            <? endforeach; ?>
                             
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

            </div>
            <!-- END RESULT AJAX -->

            <div class="controls">
                <!-- <button type="submit" class="btn blue">Jawab</button> -->
                <div class="pull-right" style="margin-right:30px">
                    <button id="btn_prev" onclick="prev_item()" class="btn black"><i class="fa fa-chevron-circle-left"></i> Prev</button>
                    <button id="btn_next" onclick="next_item()" class="btn purple">Next <i class ="fa fa-chevron-circle-right"></i></button>
                </div>
            </div>

            </form>
            

        </div>
        <!-- END BEGIN LEFT BAR -->
        <!-- BEGIN RIGHT BAR -->
        <div class="span3 blog-sidebar">
            <div class="recent-news margin-bottom-10">
                <button id="btn_jawab" onclick="action_jawab()" class="btn blue"> Jawab <span> <i class="fa fa-chevron-right"></i> </span>  </button>
                <p class="alarm"> <span id="minutes">01 </span> Menit <span id="seconds">23 </span> Detik  tersisa</p>
                <p><strong><?php echo $title; ?></strong></p>
                <i class="fa fa-cube"></i> <span> <?php echo $title; ?></span> <br/>
                <i class="fa fa-tags"></i> <span> <?php echo $teil; ?></span> <br/>
                <i class="fa fa-dashboard"></i> <span><?php echo $category; ?></span> <br/><br/>
                
                <p><strong>Keterangan Soal</strong></p>

                <ul>
                <li>Tipe soal : Pilihan ganda</li>
                <li>Ujian : <?php echo $title; ?></li>
                <li>Jumlah soal : <?php echo $jumlah_soal; ?></li>
                <li>Nilai minimum : 60</li>
                <li>Waktu pengerjaan : 10 menit</li>
                </ul>
            </div>
        </div>
        <!-- END RIGHT BAR -->
    </div>
    <!-- BEGIN ABOUT INFO -->
 </div>
 <!-- BEGIN CONTAINER -->
<script src="<?php echo base_url();?>assets/scripts/examination/exam_lesen_navigation.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/scripts/examination/exam_horen_timer.js" type="text/javascript"></script>
