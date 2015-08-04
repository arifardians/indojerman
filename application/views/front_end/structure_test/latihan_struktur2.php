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
        <h2 class="block">Latihan soal struktur</h2>
        <div id="progress_text">Progress | Pertanyaan <span id="current_soal">1</span>  dari <span id="jumlah_soal"><?php echo count($this->session->userdata('soals')); ?></span> </div>
        <div class="progress">
            <div id="progress_bar" style="width:0%" class="bar"></div>
        </div>
    </div> 
    <div class="row-fluid margin-bottom-30">
        <!-- BEGIN LEFT BAR -->
        <div class="span9 blog-item margin-bottom-40" style="border-right: 1px solid #CFCFCF">
            <?php $i=0; ?>
            <form class="form-horizontal" id="soalForm" >
            

            <div id="result">
         
            <?php $soals = $this->session->userdata('soals'); ?>
            <?php $options = $this->session->userdata('options'); ?>
       
            <input type="hidden" id="no_soal" name="no_soal" value="<?php echo $i; ?>">
            <?php $soal = $soals[$i]; ?>
            <div class="control-group">
                <div class="controls">
                    <label class="label label-important" style="padding:10px"> Pertanyaan </label>
                </div>
                
                <div class="controls">
                   <label style="margin:10px;"> <strong><?php echo $soal->soal; ?> </strong> </label>
                    
                    <label class="label label-success" style="padding:10px;"> Jawaban </label> 
                    <?php foreach ($options[''.$soal->id] as $option): ?>
                    <label class="radio" style="margin-left:20px;">
                        <input type="radio" name="jawaban" value="<?php echo $option->id;?>">
                        <?php echo $option->opsi; ?>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>

            </div>
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
                <p><strong>Latihan soal struktur</strong></p>
                <i class="fa fa-user"></i> <span>145</span> <br/>
                <i class="fa fa-cube"></i> <span> Struktur</span> <br/>
                <i class="fa fa-tags"></i> <span>Latihan</span>
            </div>
        </div>
        <!-- END RIGHT BAR -->
    </div>
    <!-- BEGIN ABOUT INFO -->
 </div>
 <!-- BEGIN CONTAINER -->

 <script type="text/javascript">
        function prev_item(){
            event.preventDefault();
            var index_soal = $("#no_soal").val();
            var url = "http://localhost/master/index.php/front_end/home_controller/prev_soal";
            var nomor_soal = parseInt(index_soal); 
            if(nomor_soal > 0){
                var posting = $.post(url, {no_soal: nomor_soal});
                posting.done(function(data){
                    $("#result").empty().append(data);
                });
            }
        }

        function next_item(){
            event.preventDefault();
            var index_soal = $("#no_soal").val(); 
            var jumlah_soal = $("#jumlah_soal").text();
            jumlah_soal = parseInt(jumlah_soal);
            var url = "http://localhost/master/index.php/front_end/home_controller/next_soal";
            var nomor_soal = parseInt(index_soal);
            var result = $("#result"); 
            if(nomor_soal < (jumlah_soal -1)){
                var posting = $.post(url, {no_soal: nomor_soal});
                posting.done(function(data){
                    result.empty().append(data);
                });
            }
        }

        function action_jawab(){
            $("#soalForm").submit();

        }
        $('#soalForm').submit(function(event){
            event.preventDefault();
            var jawaban = $("input[name=jawaban]:checked").val();
            if(typeof(jawaban) == 'undefined'){
                jawaban = ""; 
            }
            // alert(jawaban);
           
            var form = $(this); 
            var i = $("#no_soal").val();
            var url = "http://localhost/master/index.php/front_end/home_controller/test_ajax";
            var posting =  $.post(url, {no_soal: i, jawaban: jawaban});
            var result = $("#soalForm #result"); 
            posting.success(function(data){
                // console.log(data);
                result.empty();
                result.append(data);
            });
        }); 

 </script>

 <script type="text/javascript"> 

    var total_seconds = 60 *10; 
    var c_minutes  = parseInt(total_seconds / 60);
    var c_seconds  = parseInt(total_seconds % 60);

    var minutes_text = document.getElementById('minutes');
    var seconds_text = document.getElementById('seconds');

    function checkTime(){
        minutes.innerHTML = ''+c_minutes; 
        seconds.innerHTML = ''+c_seconds;
        if(total_seconds <= 0){
            alert("Waktu Habis!!!");
        }else{
            total_seconds = total_seconds -1; 
            c_minutes = parseInt(total_seconds / 60); 
            c_seconds = parseInt(total_seconds % 60); 
            if($("#btn_jawab").is(":visible")){
                setTimeout("checkTime()", 1000);
            }
        }
    }
    setTimeout("checkTime()", 1000);
 </script>