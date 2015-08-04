<script src="<?php echo base_url()?>assets/scripts/audiojs/audio.min.js" type="text/javascript"></script>

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
        <div id="progress_text">Progress | Selesai </div>
        <div class="progress">
            <div id="progress_bar" style="width:100%" class="bar"></div>
        </div>
    </div> 
    <div class="row-fluid margin-bottom-30">
        <!-- BEGIN LEFT BAR -->
        <div class="span9 blog-item margin-bottom-40" style="border-right: 1px solid #CFCFCF">
            <form class="form-horizontal" id="soalForm" >
                   
            

            <input type="hidden" id="base_url" value="<?php echo base_url() ?>">

            <!-- RESULT AJAX -->
            <div id="result">
                <div class="row-fluid">
                    <h2><strong><?php echo $title; ?></strong></h2>
                    <div class="span3" style="border-right:1px solid #ddd;">
                        <img src="<?php echo base_url();?>assets/img/medal.png">
                        
                        <div class="keterangan">Nilai Anda: </div>
                        <div class="nilai"><?php echo $nilai_ujian; ?></div>
                    </div>
                    <div class="span6">
                        <p> Selamat, anda telah menyelesaikan seluruh soal pada ujian sertifikasi untuk <strong>Bahasa Jerman</strong> ini. Terima kasih telah berpartisipasi dalam mengikuti dan mengerjakan ujian sertifikasi ini. </p>

                        <div class="row-fluid">
                            <div class="span3">
                                <i class="fa fa-certificate"></i> <span>Ujian</span><br/><br/>
                                <i class="fa fa-cube"></i> <span>Jenis Ujian</span><br/>
                                <i class="fa fa-volume-up"></i> <span>Nilai</span> <br/><br/>

                                <i class="fa fa-cube"></i> <span>Jenis Ujian</span><br/>
                                <i class="fa fa-book"></i> <span>Nilai</span>
                            </div>
                            <div class="span6">
                                : <strong> Sertifikasi A1 </strong> <br/><br/>
                                : <strong> Ujian Mendengar </strong> <br/>
                                : <strong> <?php echo $nilai_mendengar; ?> </strong> <br/> <br/>
                                
                                : <strong> Ujian Membaca </strong> <br>
                                : <strong> <?php echo $nilai_membaca; ?> </strong> <br/> <br/>
                                
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span9 offset3">
                                <a href="<?php echo $button_link; ?>" class="btn blue big"><?php echo $button_label ?> <i class="fa fa-chevron-circle-right"></i> </a>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            <!-- RESULT AJAX -->
            
            <!-- END RESULT AJAX -->

            
            </form>
            

        </div>
        <!-- END BEGIN LEFT BAR -->
        <!-- BEGIN RIGHT BAR -->
        <div class="span3 blog-sidebar">
            <div class="recent-news margin-bottom-10">
                
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
                <li>Waktu pengerjaan : 30 menit</li>
                </ul>
            </div>
        </div>
        <!-- END RIGHT BAR -->
    </div>
    <!-- BEGIN ABOUT INFO -->
 </div>
 <!-- BEGIN CONTAINER -->