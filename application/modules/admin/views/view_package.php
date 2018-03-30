<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">View Package</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <?php if ($info_message = $this->session->flashdata('info_message')): ?>
            <div id="form-messages" class="alert alert-success" role="alert">
                <?php echo $info_message; ?> </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading"> <a class="btn btn-primary" href="#"><i class="fa fa-th-list">&nbsp;View Package</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="" class="registration_form1" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Exam Name </label>
                                        <div class="col-md-9">
                                            <?php echo strtoupper($package[0]->package_name);?>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Module Name </label>
                                        <div class="col-md-9">
                                            <?php echo strtoupper($package[0]->en_module_name);?>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Chapter Name </label>
                                        <div class="col-md-9">
                                            <?php echo strtoupper($package[0]->en_chapter_name);?>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Question Type </label>
                                        <div class="col-md-9">
                                            <?php echo $package[0]->question_type;?>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix "></div>
                                <div class="col-md-6 ">
                                    <div class="form-group ">
                                        <label class="col-md-3 ">Created Date </label>
                                        <div class="col-md-9 ">
                                            <?php echo date('Y-m-d',strtotime($package[0]->created_at));?>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix "></div>
                                <div class="col-md-12 " align="center ">
                                    <input type="button" value="View Questions" class="btn btn-success" onclick="get_questions('<?php echo $package[0]->question_id;?>')">
                                </div>
                            </form>
                            <div id="questions_list" style="display: none">
                            </div>
                        </div>


                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- row -->
</div>
</div>

<script type="text/javascript">
function get_questions(id) {
    $.ajax({
        url: "<?php echo base_url('admin/get_questions')?>",
        data: {
            question_id: id,
        },
        type: "GET",
        success: function(data) {
            var obj = JSON.parse(data);
            if (obj.length != 0) {
                var option = '<table class="table table-bordered" id="table"><tr><th>Sr. No.</th><th>Question in English</th><th>Question in Hindi</th></tr>';
                for (var i = 0; i < obj.length; i++) {
                    option += '<tr><td>' + (i + 1) + '</td><td>' + obj[i].en_question + '</td><td>' + obj[i].hi_question + '</td></tr>';
                }
                option += '</table>';
                $('#questions_list').toggle().html(option);
            }

        }
    })
}

</script>
