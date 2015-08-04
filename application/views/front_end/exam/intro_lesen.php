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
        <div class="row-fluid margin-bottom-20">
            <!-- CONTENT -->
            <div class="row-fluid margin-bottom-30">
                <div class="span9 blog-item margin-bottom-40" style="border-right: 1px solid #CFCFCF">
                    <?php echo $content; ?>
                </div>
                <!-- BEGIN RIGHT BAR -->
                <div class="span3 blog-sidebar">
                    <div class="recent-news margin-bottom-10">
                        <button id="btn_jawab" onclick="action_jawab()" class="btn blue"> Mulai Ujian <span> <i class="fa fa-chevron-right"></i> </span>  </button>
                        <p class="alarm"> <span id="minutes">20 </span> Menit <span id="seconds">00 </span> Detik  total waktu</p>
                        <p><strong>Ujian sertifikasi A1</strong></p>
                        <i class="fa fa-cube"></i> <span> Sertifikasi A1</span> <br/>
                        <i class="fa fa-tags"></i> <span>Ujian</span> <br/>
                        <i class="fa fa-dashboard"></i> <span>Intro Lesen</span> <br/><br/>
                        <p><strong>Keterangan Soal Sertifikasi</strong></p>

                        <ul>
                        <li>Tipe soal : Pilihan ganda</li>
                        <li>Ujian : Mendengarkan</li>
                        <li>Jumlah soal : 15</li>
                        <li>Nilai minimum : 60</li>
                        <li>Waktu pengerjaan : 25 menit</li>
                        </ul>

                    </div>
                </div>
                <!-- END RIGHT BAR -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END ABOUT INFO -->   
    </div>
<!-- END CONTAINER -->   
