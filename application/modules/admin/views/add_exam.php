<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Exam</h1>
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
                        <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo base_url('admin/examList')?>"><i class="fa fa-th-list">&nbsp;Exam List</i></a> </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <form role="form" method="post" action="" class="registration_form1" enctype="multipart/form-data">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-3 ">Module Name * </label>
                                                <div class="col-md-9">
                                                    <select class="form-control" name="module_id" id="module_id">
                                                        <option data-display="--Select Modules--">--Select modules--</option>
                                                        <?php foreach ($modules as $key => $value) { ?>
                                                            <option value="<?php echo $value['id']; ?>" <?php if(isset($exam) && $exam[0]->module_id==$value['id']){ echo 'selected'; } ?>>
                                                                <?php echo ucwords($value['en_module_name']); ?>
                                                            </option>
                                                            <?php } ?>
                                                    </select> <span class="red"><?php echo form_error('module_id'); ?></span> </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-3 ">Chapter Name * </label>
                                                <div class="col-md-9">
                                                    <select class="form-control" name="chapter_id" id="chapter_id">
                                                        <option data-display="--Select Chapter--">--Select Chapter--</option>
                                                    </select> <span class="red"><?php echo form_error('chapter_id'); ?></span> </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-3">Question Type</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" name="question_type" id="question_type">
                                                        <option data-display="--Select question_type--">--Please Select Question Type--</option>
                                                        <option value="Options" <?php if(isset($exam) && $exam[0]->question_type=='Options'){ ?> selected
                                                            <?php }?> >Options </option>
                                                        <option value="Fill In the Blank" <?php if(isset($exam) && $exam[0]->question_type=='Fill In the Blank'){ ?> selected
                                                            <?php }?>>Fill In the Blank</option>
                                                        <!-- <option value="Descriptive">Descriptive</option> -->
                                                        <option value="True False" <?php if(isset($exam) && $exam[0]->question_type=='True False'){ ?> selected
                                                            <?php }?>>True False</option>
                                                    </select>
                                                    <span class="red"><?php echo form_error('question_type'); ?></span> </div>
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                        <!-- Question modal starts -->
                                        <div id="myModal" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Package List</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-md-12" id="question">
                                                            <div class="panel panel-primary">
                                                                <div class="panel-heading"></div>
                                                                <div class="panel-body">
                                                                    <table class="table table-bordered" id="table">
                                                                        <tr>
                                                                            <th>Select</th>
                                                                            <th>Package Name</th>
                                                                            <th>Package Info</th>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Submit</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- Question modal ends -->


                                        <div class="clearfix"></div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-3">Payment Status</label>
                                                <div class="col-lg-9">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="payment_status" id="payment_status" value="paid" <?php if(isset($exam) && $exam[0]->payment_status=='paid'){ echo 'checked'; } else{ echo 'checked';}?>>Paid
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="payment_status" id="payment_status" value="free" <?php if(isset($exam) && $exam[0]->payment_status=='free'){ echo 'checked'; } ?>>Free
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-3">Status</label>
                                                <div class="col-lg-9">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="status" id="status" value="1" <?php if(isset($exam) && $exam[0]->is_active==1){ echo 'checked'; }else{ echo 'checked'; } ?>>Active
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="status" id="status" value="0" <?php if(isset($exam) && $exam[0]->is_active==0){ echo 'checked'; } ?>>Inactive
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <br/>
                                        <br/>
                                        <div class="col-md-12" align="center">
                                            <input type="button" value="Save" class="btn btn-success" value="Search" onclick="get_results()">
                                            <input type="reset" class="btn btn-default" value="Reset">  </div>
                                    </form>
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
    $(document).ready(function() {
        $(".registration_form1").validate({
            rules: {
                "module_name": "required",
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

        $('#module_id').on('change', function() {
            var url = "<?php echo base_url('admin/getChapter') ?>";
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    module_id: this.value
                },
                success: function(data) {
                    var obj = JSON.parse(data);
                    $('#chapter_id').html('');
                    if (obj.length != 0) {
                        for (var i = 0; i < obj.length; i++) {
                            $("#chapter_id").append($("<option></option>").val(obj[i].id).html(obj[i].en_chapter_name));

                        }
                    }

                }
            });
        });
    });

    function get_results() {
        var module_id = $('#module_id').val();
        var chapter_id = $('#chapter_id').val();
        var question_type = $('#question_type').val();
        var payment_status = $("input[name='payment_status']:checked").val();
        var status = $('#status').val();
        $.ajax({
            url: '<?php echo base_url('admin/get_exam')?>',
            type: "GET",
            data: {
                module_id: module_id,
                chapter_id: chapter_id,
                question_type: question_type,
                payment_status: payment_status,
                status: status
            },
            success: function(data) {
                if (data.trim() !== null && data.trim() !== undefined && data.trim() !== '') {
                    var obj = JSON.parse(data);
                    $('.one').html('');
                    $('#myModal').modal("toggle");
                    for (var i = 0; i < obj.length; i++) {
                        $('#table').append('<tr class="one"><td><div class=""><input type="radio" id="radio" name="package_id" value="'+obj[i].id+'"><label></label></div></td><td>' + obj[i].exam_name + '</td><td><a target="_blank" href="<?php echo base_url()?>admin/view_package/' + obj[i].id + '">View</a></td></tr>');
                    }
                } else {
                    alert('no record found');
                }

            }
        });
    }



</script>