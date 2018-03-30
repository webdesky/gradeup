<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Dashboard</h1>
		</div>
	</div>
	<div class="col-md-6">
		<div class="widget widget-nopad">
			<div class="widget-header">
				<h3><i class="fa fa-list-alt" style="font-size: 20px;"></i> Total Stats</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<div class="widget big-stats-container">
					<div class="widget-content">
						<h6 class="bigstats"></h6>
						<div id="big_stats" class="cf">
							<div class="stat">
								<div class="shortcuts1">
									<a href="#" class="shortcut1"><i class="fa fa-user" title="User's"></i> <span class="value"><?php echo $totaluser; ?>
								</span></a>

								</div>
							</div>
							<!-- .stat -->
							<div class="stat">
								<div class="shortcuts1">
									<a href="#" class="shortcut1">
								<i class="fa fa-question-circle" title="Question's"></i> <span class="value"><?php echo $totalquestion; ?></span></a> </div>
							</div>
							<!-- .stat -->
							<div class="stat">
								<div class="shortcuts1">
									<a href="#" class="shortcut1">
								<i class="fa fa-file-powerpoint-o" title="Post's"></i> <span class="value"><?php echo $totalpost; ?></span>
								</a> </div>
							</div>

							<!-- .stat -->
							<div class="stat">
								<div class="shortcuts1">
									<a href="#" class="shortcut1">
									<i class="fa fa-book" title="Exam's"></i> <span class="value"><?php //echo $totalexam; ?> 
							</span></a> </div>
							</div>
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
					<!-- <a href="<?php echo base_url('admin/moduleList') ?>" class="shortcut">
					<i class="shortcut-icon  fa fa-database"></i>
					<span class="shortcut-label">Modules</span>
					</a> -->
					<!-- <a href="<?php echo base_url('admin/chapterList') ?>" class="shortcut">
					  <i class="shortcut-icon fa fa-file-text"></i>
					  <span class="shortcut-label">Chapters</span> 
					</a> -->
					<!-- <a href="<?php echo base_url('admin/trainingList') ?>" class="shortcut">
					  <i class="shortcut-icon fa fa-graduation-cap"></i> 
					  <span class="shortcut-label">Training</span> 
					</a> -->
					<!-- <a href="<?php echo base_url('admin/questionList') ?>" class="shortcut"> 
					  <i class="shortcut-icon fa fa-question-circle"></i>
					  <span class="shortcut-label">Questions</span>  
					</a> -->
					<a href="<?php echo base_url('admin/postList') ?>" class="shortcut">
					  <i class="shortcut-icon fa fa-file-powerpoint-o"></i>
					  <span class="shortcut-label">Post</span> 
					</a>
					<!-- <a href="<?php echo base_url('admin/examList') ?>" class="shortcut">
					  <i class="shortcut-icon fa fa-book"></i>
					  <span class="shortcut-label">Exam</span> 
					</a> -->
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
				<canvas id="area-chart" class="chart-holder" height="250" width="715"> </canvas>
				<!-- /area-chart -->
			</div>
			<!-- /widget-content -->
		</div>
	</div>

</div>

<script>
var lineChartData = {
	labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
	datasets: [{
			fillColor: "rgba(220,220,220,0.5)",
			strokeColor: "rgba(220,220,220,1)",
			pointColor: "rgba(220,220,220,1)",
			pointStrokeColor: "#fff",
			data: [65, 59, 90, 81, 56, 55, 60, 55, 99, 50, 75, 50]
		},
		{
			fillColor: "rgba(151,187,205,0.5)",
			strokeColor: "rgba(151,187,205,1)",
			pointColor: "rgba(151,187,205,1)",
			pointStrokeColor: "#fff",
			data: [65, 59, 90, 81, 56, 55, 60, 55, 99, 50, 75, 50]
		}
	]
}
var myLine = new Chart(document.getElementById("area-chart").getContext("2d")).Line(lineChartData);
</script>
<!-- /Calendar -->

<style type="text/css">
.widget,.widget-content:after{clear:both}#big_stats .stat,.shortcuts{text-align:center}.widget{position:relative;width:auto;margin-bottom:2em;overflow:hidden}.widget-header{position:relative;height:40px;line-height:40px;background-color:#337ab7;border:1px solid #d6d6d6;-webkit-background-clip:padding-box}.widget-header h3{position:relative;top:-10px;left:10px;display:inline-block;margin-right:3em;font-size:25px;font-weight:800;color:#fff;line-height:18px;text-shadow:1px 1px 2px rgba(255,255,255,.5)}.widget-header [class*=" icon-"],.widget-header [class^=icon-]{display:inline-block;margin-left:13px;margin-right:-2px;font-size:16px;color:#555;vertical-align:middle}.widget-content{padding:20px 15px 15px;background:#FFF;border:1px solid #D5D5D5;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px;zoom:1}.widget-nopad .widget-content,.widget-table .widget-content{padding:0}#big_stats .stat:first-child,.widget-table .table tr td:first-child,.widget-table .table tr th:first-child{border-left:none}.widget-header+.widget-content{border-top:none;-webkit-border-top-left-radius:0;-webkit-border-top-right-radius:0;-moz-border-radius-topleft:0;-moz-border-radius-topright:0;border-top-left-radius:0;border-top-right-radius:0}.widget-content:after,.widget-content:before{content:"";display:table}.widget-table .table{margin-bottom:0;border:none}.widget-plain{background:0 0;border:none}.widget-plain .widget-content{padding:0;background:0 0;border:none}.widget-box .widget-content{background:#FFF}.shortcuts .shortcut{width:22.5%;display:inline-block;padding:12px 0;margin:0 .9% 1em;vertical-align:top;text-decoration:none;background:#3379b7;border-radius:5px}.shortcuts .shortcut:hover{background:#00ba8b}.shortcuts .shortcut:hover .shortcut-icon,.shortcuts .shortcut:hover span{color:#fff}.shortcuts .shortcut-label{display:block;font-weight:400;color:#545454}.shortcuts .shortcut .shortcut-icon{margin-top:.25em;margin-bottom:.25em;font-size:32px;color:#545454}#big_stats .stat{width:25%;height:119px;display:table-cell;padding:0;position:relative;border-right:1px solid #CCC;border-left:1px solid #FFF}h6.bigstats{margin:20px 20px 26px;border-bottom:1px solid #eee;padding-bottom:20px;font-size:16px}#big_stats{width:100%;display:table;margin-top:1.5em}#big_stats .stat .value{font-size:45px;font-weight:700;color:#545454;line-height:1em}#big_stats i{font-size:30px;display:block;line-height:40px;color:#b2afaa}#big_stats i:hover{color:#00ba8b}.shortcuts1 .shortcut1{width:81%;display:inline-block;padding:12px 0;margin:0 .9% 1em;vertical-align:top;text-decoration:none;background:#3379b7;border-radius:5px}.shortcuts1 .shortcut1:hover{background:#00ba8b}.shortcuts1 i,.shortcuts1 span{color:#fff!important}.shortcuts i,.shortcuts span{color:#fff!important}
</style>