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
                    <?php echo $info_message; ?>
                </div>
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
                                                    <?php echo strtoupper($package[0]->exam_name);?>
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
                                         <input type="hidden" name="q_id[]" id="q">
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
                    $('#q').val(JSON.stringify(obj)); 
                    var option = '<table class="table table-bordered" id="table"><tr><th>Sr. No.</th><th>Question in English</th><th>Question in Hindi</th><th>Remove</th></tr>';
                    for (var i = 0; i < obj.length; i++) {
                        option += '<tr><td>' + (i + 1) + '</td><td>' + obj[i].en_question + '</td><td>' + obj[i].hi_question + '</td><td><input type="checkbox" name="question_id[]" value="' + obj[i].id + '"/></td></tr>';
                    }
                    option += '<tr><td><input class="btn btn-primary" type="button" id="update_question" onclick="update_question()" value="Update"></td></tr></table>';
                    $('#questions_list').toggle().html(option);
                }

            }
        })
    }

    function update_question() {
        var final=$('#q').val();
       
        var myArray = [];
        $(":checkbox:not(:checked)").each(function() {
            myArray.push(this.value);
        });
        swal({
            title: "Are you sure?",
            text: "Want to Remove?",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "Yes, Remove it!",
            confirmButtonColor: "#ec6c62"
        }, function() {
            $.ajax({
                url: "<?php echo base_url('admin/update')?>",
                data: {
                    'question_id': myArray,
                    'table': 'exam',
                    'id': '<?php echo $this->uri->segment(3)?>'
                },
                type: "POST"
            }).done(function(data) {
                swal("Deleted!", "Record was successfully removed!", "success");
            });

        });
    }
</script>