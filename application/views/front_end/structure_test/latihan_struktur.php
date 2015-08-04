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
        <div class="span9 blog-item margin-bottom-40">
            <h2><strong>Soal</strong></h2>
            <form class="form-horizontal">
            <?php $i = 1; ?>
            <?php foreach ($soals as $soal): ?>
            <div class="control-group">
                <label class="control-label">
                   <strong> <?php echo $i.'.'; ?> </strong> 
                </label>
                <div class="controls">
                   <label style="margin-top:5px;"> <strong> <?php echo $soal->soal; ?> </strong> </label> 
                    <?php foreach ($options[''.$soal->id] as $option): ?>
                    <label class="radio" style="margin-left:20px;">
                        <input type="radio" name="">
                        <?php echo $option->opsi; ?>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php $i++; ?>
            <?php endforeach; ?>
            </form>

        </div>
        <!-- END BEGIN LEFT BAR -->
        <!-- BEGIN RIGHT BAR -->
        <div class="span3 blog-sidebar">
            <div class="recent-news margin-bottom-10">
            
            </div>
        </div>
        <!-- END RIGHT BAR -->
    </div>
    <!-- BEGIN ABOUT INFO -->
 </div>
 <!-- BEGIN CONTAINER
