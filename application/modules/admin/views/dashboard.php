<style type="text/css">
/*------------------------------------------------------------------
[6. Widget / .widget]
*/

.widget {

    position: relative;
    clear: both;

    width: auto;

    margin-bottom: 2em;

    overflow: hidden;
}

.widget-header {

    position: relative;

    height: 40px;
    line-height: 40px;

    background: #f9f6f1;
    background: -moz-linear-gradient(top, #f9f6f1 0%, #f2efea 100%);
    /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #f9f6f1), color-stop(100%, #f2efea));
    /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, #f9f6f1 0%, #f2efea 100%);
    /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top, #f9f6f1 0%, #f2efea 100%);
    /* Opera11.10+ */
    background: -ms-linear-gradient(top, #f9f6f1 0%, #f2efea 100%);
    /* IE10+ */
    background: linear-gradient(top, #f9f6f1 0%, #f2efea 100%);
    /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f6f1', endColorstr='#f2efea');
    -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f6f1', endColorstr='#f2efea')";


    border: 1px solid #d6d6d6;


    -webkit-background-clip: padding-box;
}

.widget-header h3 {

    position: relative;
    top: -10px;
    left: 10px;

    display: inline-block;
    margin-right: 3em;

    font-size: 25px;
    font-weight: 800;
    color: #525252;
    line-height: 18px;

    text-shadow: 1px 1px 2px rgba(255, 255, 255, .5);
}

.widget-header [class^="icon-"],
.widget-header [class*=" icon-"] {

    display: inline-block;
    margin-left: 13px;
    margin-right: -2px;

    font-size: 16px;
    color: #555;
    vertical-align: middle;
}




.widget-content {
    padding: 20px 15px 15px;

    background: #FFF;


    border: 1px solid #D5D5D5;

    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
}

.widget-header+.widget-content {
    border-top: none;

    -webkit-border-top-left-radius: 0;
    -webkit-border-top-right-radius: 0;
    -moz-border-radius-topleft: 0;
    -moz-border-radius-topright: 0;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}

.widget-nopad .widget-content {
    padding: 0;
}


/* Widget Content Clearfix */

.widget-content:before,
.widget-content:after {
    content: "";
    display: table;
}

.widget-content:after {
    clear: both;
}


/* For IE 6/7 (trigger hasLayout) */

.widget-content {
    zoom: 1;
}


/* Widget Table */

.widget-table .widget-content {
    padding: 0;
}

.widget-table .table {
    margin-bottom: 0;

    border: none;
}

.widget-table .table tr td:first-child {
    border-left: none;
}

.widget-table .table tr th:first-child {
    border-left: none;
}



/* Widget Plain */

.widget-plain {

    background: transparent;

    border: none;
}

.widget-plain .widget-content {
    padding: 0;

    background: transparent;

    border: none;
}



/* Widget Box */

.widget-box {}

.widget-box .widget-content {
    background: #E3E3E3;
    background: #FFF;
}


/*------------------------------------------------------------------
[1. Shortcuts / .shortcuts]
*/

.shortcuts {
    text-align: center;
}

.shortcuts .shortcut {
    width: 22.50%;
    display: inline-block;
    padding: 12px 0;
    margin: 0 .9% 1em;
    vertical-align: top;

    text-decoration: none;

    background: #f9f6f1;

    border-radius: 5px;
}

.shortcuts .shortcut .shortcut-icon {
    margin-top: .25em;
    margin-bottom: .25em;

    font-size: 32px;
    color: #545454;
}

.shortcuts .shortcut:hover {
    background: #00ba8b;
}

.shortcuts .shortcut:hover span {
    color: #fff;
}

.shortcuts .shortcut:hover .shortcut-icon {
    color: #fff;
}

.shortcuts .shortcut-label {
    display: block;

    font-weight: 400;
    color: #545454;
}

.shortcuts .shortcut .shortcut-icon {
    margin-top: .25em;
    margin-bottom: .25em;
    font-size: 32px;
    color: #545454;
}

#big_stats .stat:first-child {
    border-left: none;
}

#big_stats .stat {
    width: 25%;
    height: 119px;
    text-align: center;
    display: table-cell;
    padding: 0;
    position: relative;
    border-right: 1px solid #CCC;
    border-left: 1px solid #FFF;
}

h6.bigstats {
    margin: 20px;
    border-bottom: 1px solid #eee;
    padding-bottom: 20px;
    margin-bottom: 26px;
    font-size: 16px;
}

#big_stats {
    width: 100%;
    display: table;
    margin-top: 1.5em;
}

#big_stats .stat .value {
    font-size: 45px;
    font-weight: bold;
    color: #545454;
    line-height: 1em;
}

#big_stats i {
    font-size: 30px;
    display: block;
    line-height: 40px;
    color: #b2afaa;
}

#big_stats i:hover {
    color: #00ba8b;
}
</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
    </div>
    <div class="col-md-6">
        <div class="widget widget-nopad">
            <div class="widget-header">
                <h3><i class="fa fa-list-alt" style="font-size: 20px;"></i>   Today's Stats</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                <div class="widget big-stats-container">
                    <div class="widget-content">
                        <h6 class="bigstats"></h6>
                        <div id="big_stats" class="cf">
                            <div class="stat"> <i class="fa fa-user"></i> <span class="value"><?php echo $totaluser; ?></span> </div>
                            <!-- .stat -->
                            <div class="stat"> <i class="fa fa-question-circle"></i> <span class="value"><?php echo $totalquestion; ?></span> </div>
                            <!-- .stat -->
                            <div class="stat"> <i class="fa fa-file-powerpoint-o"></i> <span class="value"><?php echo $totalpost; ?></span> </div>
                            <!-- .stat -->
                            <div class="stat"> <i class="fa fa-book"></i> <span class="value"><?php echo $totalexam; ?></span> </div>
                            <!-- .stat -->
                        </div>
                    </div>
                    <!-- /widget-content -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="widget">
            <div class="widget-header">
                <h3><i class="fa fa-bookmark" style="font-size: 20px"></i> Important Shortcuts</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                <div class="shortcuts">
                    <a href="<?php echo base_url('admin/moduleList') ?>" class="shortcut">
                    <i class="shortcut-icon  fa fa-database"></i>
                    <span class="shortcut-label">Modules</span>
                     </a>
                    <a href="<?php echo base_url('admin/chapterList') ?>" class="shortcut">
                      <i class="shortcut-icon fa fa-file-text"></i>
                      <span class="shortcut-label">Chapters</span> 
                     </a>
                    <a href="<?php echo base_url('admin/trainingList') ?>" class="shortcut">
                      <i class="shortcut-icon fa fa-graduation-cap"></i> 
                      <span class="shortcut-label">Training</span> 
                     </a>
                    <a href="<?php echo base_url('admin/questionList') ?>" class="shortcut"> 
                      <i class="shortcut-icon fa fa-question-circle"></i>
                      <span class="shortcut-label">Questions</span> 
                     
                     </a><a href="<?php echo base_url('admin/postList') ?>" class="shortcut">
                      <i class="shortcut-icon fa fa-file-powerpoint-o"></i>
                      <span class="shortcut-label">Post</span> 
                     </a>
                    <a href="<?php echo base_url('admin/examList') ?>" class="shortcut">
                      <i class="shortcut-icon fa fa-book"></i>
                      <span class="shortcut-label">Exam</span> 
                     </a>
                    <a href="<?php echo base_url('admin/userList') ?>" class="shortcut">
                      <i class="shortcut-icon fa fa-user"></i> 
                      <span class="shortcut-label">Users</span> 
                     </a>
                    <a href="<?php echo base_url('admin/setting') ?>" class="shortcut"> 
                      <i class="shortcut-icon fa fa-cog"></i>
                      <span class="shortcut-label">Settings</span> 
                     </a>
                </div>
                <!-- /shortcuts -->
            </div>
            <!-- /widget-content -->
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-6">
        <div class="widget">
            <div class="widget-header"> <i class="icon-signal"></i>
                <h3> Area Chart Example</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                <canvas id="area-chart" class="chart-holder" height="250" width="538"> </canvas>
                <!-- /area-chart -->
            </div>
            <!-- /widget-content -->
        </div>
   </div>

</div>
<script>
var lineChartData = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [{
            fillColor: "rgba(220,220,220,0.5)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            data: [65, 59, 90, 81, 56, 55, 40]
        },
        {
            fillColor: "rgba(151,187,205,0.5)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            data: [28, 48, 40, 19, 96, 27, 100]
        }
    ]

}

var myLine = new Chart(document.getElementById("area-chart").getContext("2d")).Line(lineChartData);


var barChartData = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [{
            fillColor: "rgba(220,220,220,0.5)",
            strokeColor: "rgba(220,220,220,1)",
            data: [65, 59, 90, 81, 56, 55, 40]
        },
        {
            fillColor: "rgba(151,187,205,0.5)",
            strokeColor: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19, 96, 27, 100]
        }
    ]

}
</script>
<!-- /Calendar -->