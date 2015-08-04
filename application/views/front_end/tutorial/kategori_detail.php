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
    <div class="row-fluid margin-bottom-30">
        <!-- BEGIN LEFT BAR -->
        <div class="span9 blog-posts margin-bottom-40">
            <h2>Sekilas <?php echo $title ?> </h2>
            <div class="row-fluid">
                <div class="span4">
                    <img src="<?php echo base_url();?>assets/img/buku_gelas.jpg">
                </div>
                <div class="span8">
                    <p><?php echo $kategori->keterangan ?></p>
                </div>
            </div>
            <br/><br/>
            <h4>Materi tutorial <?php echo $kategori->nama ?></h4>
            <div class="row-fluid">
                <div class="span4">
                    <img src="<?php echo base_url();?>assets/img/perpustakaan.jpg">
                </div>
                <div class="span8">
                    <p>Materi tutorial dari kategori ini meliputi : </p>
                    <?php foreach ($tutorials as $tutorial): ?>
                    <span> <i class="fa fa-plus-circle blue"></i> </span> <a href="<?php echo base_url();?>detail_tutorial/<?php echo $tutorial->id ?>">  <?php echo $tutorial->judul; ?> </a><br/>
                    <?php endforeach; ?>    
                    
                </div>
            </div>
        </div>
        <!-- END BEGIN LEFT BAR -->
        <!-- BEGIN RIGHT BAR -->
        <div class="span3 blog-sidebar">
            <h2>Recent Tutorial</h2>
            <div class="recent-news margin-bottom-10">
            <?php foreach ($lastest_tutorial as $tutorial):?>
                <div class="row-fluid margin-bottom-10">
                    <div class="span3">
                        <?php $image = $tutorial->image;?>
                        <?php if(isset($image) AND !empty($image)):  ?>
                        <img src="<?php echo base_url().''.$image; ?>" alt="<?php echo $tutorial->judul; ?>">
                        <?php else: ?>
                        <i class="fa fa-mortar-board fa-4x"></i>
                        <?php endif; ?>
                    </div>
                    <div class="span9 recent-news-inner">
                        <h3> <a href="<?php echo base_url();?>detail_tutorial/<?php echo $tutorial->id; ?>"><?php echo $tutorial->judul; ?></a> </h3>
                        <p><?php echo substr($tutorial->deskripsi,0,75).".." ?></p>
                    </div>
                    <br>
                </div>
             <?php endforeach; ?>

            </div>
        </div>
        <!-- END RIGHT BAR -->
    </div>
    <!-- BEGIN ABOUT INFO -->
 </div>
 <!-- BEGIN CONTAINER