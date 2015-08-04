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
            <!-- SERVICE BLOCK -->
            <div class="row-fluid service-box" style="margin-top:10px;margin-bottom:50px">
                <div class="span4" onclick="location.href='<?php echo base_url();?>lesen_practice/teil_1'" style="cursor: pointer;" 
                onmouseover="this.style.background='#F5F5F5';" onmouseout="this.style.background='white';">
                    <div class="service-box-heading">
                        <i class="fa fa-certificate red"></i>
                        <span>
                            Doing practice
                        </span>
                    </div>
                    <p>
                        Latihan soal sebelum melakukan ujian. 
                    </p>
                </div>

                <div class="span4" onclick="location.href='<?php echo base_url();?>review_progress'" style="cursor: pointer;" 
                onmouseover="this.style.background='#F5F5F5';" onmouseout="this.style.background='white';">
                    <div class="service-box-heading">
                        <i class="fa fa-line-chart blue"></i>
                        <span>
                            Review Progress
                        </span>
                    </div>
                    <p>
                        Mereview rangkaian test yang pernah diikuti.
                    </p>
                </div>

                <div class="span4" onclick="location.href='<?php echo base_url();?>user_exam/start'" style="cursor: pointer;" 
                onmouseover="this.style.background='#F5F5F5';" onmouseout="this.style.background='white';">
                    <div class="service-box-heading">
                        <i class="fa fa-fighter-jet green"></i>
                        <span>
                            Doing Examination
                        </span>
                    </div>
                    <p>
                        Melanjutkan ujian yang pernah diikuti
                    </p>
                </div>
                
            </div>
            <!-- END SERVICE BLOCK -->

            <!-- CONTENT -->
            <div class="row-fluid margin-bottom-30">
                <div class="span4 space-mobile">
                    <h2>Your Skill</h2>
                    <p>Kemampuan Anda sejauh ini dilihat dari segi reading, struktur dan listening</p>
                </div>
                <div class="span8 front-skills space-mobile">
                    <span>Kemampuan membaca (lesen) ( <?php echo round($avg_lesen, 2); ?>%)</span>
                    <div class="progress">
                        <div style="width:<?php echo round($avg_lesen, 2); ?>%" class="bar"></div>
                    </div>
                    <span>Kemampuan Mendengarkan (horen) (<?php echo round($avg_horen, 2); ?>%)</span>
                    <div class="progress">
                        <div style="width:<?php echo round($avg_horen, 2); ?>%" class="bar red"></div>
                    </div>
                    <span>Kemampuan rata-rata (<?php echo round($avg_skill, 2); ?>%)</span>
                    <div class="progress">
                        <div style="width:<?php echo round($avg_skill, 2); ?>%" class="bar red"></div>
                    </div>
                </div>
            </div>
            <!-- END CONTENT -->             
        </div>
        <!-- END ABOUT INFO --> 
    </div>   
 <!-- END CONTAINER -->   
