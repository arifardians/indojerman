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
                <div class="span4" onclick="location.href='<?php echo base_url();?>horen_practice/teil_1'" style="cursor: pointer;" 
                onmouseover="this.style.background='#F5F5F5';" onmouseout="this.style.background='white';">
                    <div class="service-box-heading">
                        <i class="fa fa-certificate red"></i>
                        <span>
                            Doing Practice
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
            <input type="hidden" id="total_horen" value="<?php echo count($horen_scores); ?>">
            <input type="hidden" id="total_lesen" value="<?php echo count($lesen_scores); ?>">

            <!-- CONTENT -->
            <div class="row-fluid margin-bottom-30">
               <div class="span12">
                   <!-- BEGIN INTERACTIVE CHART PORTLET-->
                    <div class="portlet box red">
                        <div class="portlet-title">
                            <div class="caption"><i class="icon-reorder"></i>Interactive Chart</div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"></a>
                                <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                <a href="javascript:;" class="reload"></a>
                                <a href="javascript:;" class="remove"></a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="placeholder" style="width:100%;height:250px;" ></div>
                        </div>
                    </div>
                    <!-- END INTERACTIVE CHART PORTLET-->  
               </div>
                
            </div>
            <!-- END CONTENT -->             
        </div>
        <!-- END ABOUT INFO --> 
    </div>   
 <!-- END CONTAINER -->   

<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.js"></script>

<!-- 
<script src="assets/plugins/flot/jquery.flot.resize.js"></script>
<script src="assets/plugins/flot/jquery.flot.pie.js"></script>
<script src="assets/plugins/flot/jquery.flot.stack.js"></script>
<script src="assets/plugins/flot/jquery.flot.crosshair.js"></script>
 --><!-- END PAGE LEVEL PLUGINS -->

<script>
    $(function() {

        var horens = [];
        var lesens = [];

        <?php $i = 1; ?>
        <?php foreach ($horen_scores as $item): ?>
            horens.push(['<?php echo $i ?>', '<?php echo $item ?>']);
            <?php $i++; ?>
        <?php endforeach; ?>

        <?php $i = 1; ?>
        <?php foreach ($lesen_scores as $item): ?>
            lesens.push(['<?php echo $i; ?>', '<?php echo $item; ?>']);
            <?php $i++; ?>
        <?php endforeach; ?>

       

        var plot = $.plot($("#placeholder"), [{
                        data: lesens,
                        label: "Lesen skill"
                    }, {
                        data: horens,
                        label: "Horen skill"
                    }
                ], {
                    series: {
                        lines: {
                            show: true,
                            lineWidth: 2,
                            fill: true,
                            fillColor: {
                                colors: [{
                                        opacity: 0.05
                                    }, {
                                        opacity: 0.01
                                    }
                                ]
                            }
                        },
                        points: {
                            show: true
                        },
                        shadowSize: 2
                    },
                    grid: {
                        hoverable: true,
                        clickable: true,
                        tickColor: "#eee",
                        borderWidth: 0
                    },
                    colors: ["#d12610", "#37b7f3", "#52e136"],
                    xaxis: {
                        ticks: 11,
                        tickDecimals: 0
                    },
                    yaxis: {
                        ticks: 11,
                        tickDecimals: 0
                    }
                });
        

        function showTooltip(x, y, contents) {
            $("<div id='tooltip'>" + contents + "</div>").css({
                position: "absolute",
                display: "none",
                top: y + 5,
                left: x + 5,
                border: "1px solid #fdd",
                padding: "2px",
                "background-color": "#fee",
                opacity: 0.80
            }).appendTo("body").fadeIn(200);
        }

        var previousPoint = null;
        $("#placeholder").bind("plothover", function (event, pos, item) {

            if ($("#enablePosition:checked").length > 0) {
                var str = "(" + pos.x.toFixed(2) + ", " + pos.y.toFixed(2) + ")";
                $("#hoverdata").text(str);
            }

            if ($("#enableTooltip:checked").length > 0) {
                if (item) {
                    if (previousPoint != item.dataIndex) {

                        previousPoint = item.dataIndex;

                        $("#tooltip").remove();
                        var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(2);

                        showTooltip(item.pageX, item.pageY,
                            item.series.label + " of " + x + " = " + y);
                    }
                } else {
                    $("#tooltip").remove();
                    previousPoint = null;            
                }
            }
        });

        $("#placeholder").bind("plotclick", function (event, pos, item) {
            if (item) {
                $("#clickdata").text(" - click point " + item.dataIndex + " in " + item.series.label);
                plot.highlight(item.series, item.datapoint);
            }
        });

        // Add the Flot version string to the footer

        $("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
    });



    // this is the example data
     /*function randValue() {
            return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
        }
        var pageviews = [
            [1, randValue()],
            [2, randValue()],
            [3, 2 + randValue()],
            [4, 3 + randValue()],
            [5, 5 + randValue()],
            [6, 10 + randValue()],
            [7, 15 + randValue()],
            [8, 20 + randValue()],
            [9, 25 + randValue()],
            [10, 30 + randValue()],
            [11, 35 + randValue()],
            [12, 25 + randValue()],
            [13, 15 + randValue()],
            [14, 20 + randValue()],
            [15, 45 + randValue()],
            [16, 50 + randValue()],
            [17, 65 + randValue()],
            [18, 70 + randValue()]           
        ];
        var visitors = [
            [1, randValue() - 5],
            [2, randValue() - 5],
            [3, randValue() - 5],
            [4, 6 + randValue()],
            [5, 5 + randValue()],
            [6, 20 + randValue()],
            [7, 25 + randValue()],
            [8, 36 + randValue()],
            [9, 26 + randValue()],
            [10, 38 + randValue()],
            [11, 39 + randValue()],
            [12, 50 + randValue()],
            [13, 51 + randValue()],
            [14, 12 + randValue()],
            [15, 13 + randValue()],
            [16, 14 + randValue()],
            [17, 15 + randValue()],
            [18, 15 + randValue()]            
        ];*/
        
</script>