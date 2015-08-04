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
