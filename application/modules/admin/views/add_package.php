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
                            <form role="form" method="post" action="<?php echo base_url('admin/add_package')?>" class="registration_form1" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 ">Package Name * </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="package_name" name="package_name" value="<?php if(isset($exam) && $exam[0]->exam_name!=''){ echo $exam[0]->exam_name;} else{echo set_value('exam_name');}?>">
                                            <span class="red"><?php echo form_error('package_name'); ?></span> </div>
                                    </div>
                                </div>
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
                                        <label class="col-md-3">Question Type</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="question_type" id="question_type" onchange="get_results(this.value)">
                                                <option data-display="--Select question_type--">--Please Select Question Type--</option>
                                                <option value="Options" <?php if(isset($exam) && $exam[0]->question_type=='Options'){ ?> selected<?php }?> >Options </option>
                                                <option value="Fill In the Blank" <?php if(isset($exam) && $exam[0]->question_type=='Fill In the Blank'){ ?> selected<?php }?>>Fill In the Blank</option>
                                                <option value="True False" <?php if(isset($exam) && $exam[0]->question_type=='True False'){ ?> selected<?php }?>>True False</option>
                                            </select>
                                            <span class="red"><?php echo form_error('question_type'); ?></span> </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Time Per Question</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="time_per_question" id="time_per_question" placeholder="Time Per Question in seconds" autocomplete="off" onkeyup="get_valid_value('time_per_question',this.value)" required="required" value="<?php if(isset($exam)){ echo $exam[0]->time_per_question; }else{echo set_value('time_per_question');} ?>"> <span class="red"><?php echo form_error('time_per_question'); ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Passing Marks </label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="passing_marks" id="passing_marks" placeholder="Passing Marks" autocomplete="off" required="required" value="<?php if(isset($exam)){ echo $exam[0]->passing_marks; }else{ echo set_value('passing_marks');} ?>"> <span class="red"><?php echo form_error('passing_marks'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Marks(per question) </label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="positive_mark" id="positive_mark" placeholder="Positive Marks" autocomplete="off" required="required" value="<?php if(isset($exam)){ echo $exam[0]->positive_mark; }else{echo set_value('positive_mark');} ?>"> <span class="red"><?php echo form_error('positive_mark'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Negative Marks(per question) </label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="negative_mark" id="negative_mark" placeholder="Negative Marks" autocomplete="off" required="required" value="<?php if(isset($exam)){ echo $exam[0]->negative_mark; }else{echo set_value('negative_mark');} ?>"> <span class="red"><?php echo form_error('negative_mark'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="clearfix"></div> -->

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
                                                <input type="radio" name="payment_status" id="free" value="free" <?php if(isset($exam) && $exam[0]->payment_status=='free'){ echo 'checked'; } ?>>Free
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="payment_status" id="paid" value="paid" <?php if(isset($exam) && $exam[0]->payment_status=='paid'){ echo 'checked'; }?>>Paid
                                            </label>

                                            <input type="text" id="exam_price" name="exam_price" style="display: none">
                                            <span class="red"><?php echo form_error('exam_price'); ?></span>                                            
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
                                    <input type="submit" value="Save" class="btn btn-success" value="Search">
                                    <input type="reset" class="btn btn-default" value="Reset"> </div>
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
});

$('#paid').on('click', function() {
    $('#exam_price').show();
});
$('#free').on('click', function() {
    $('#exam_price').hide();
});

function get_results(str) {
    var module_id = $('#module_id').val();
    var question_type = str;
    $.ajax({
        url: '<?php echo base_url('admin/get_exam')?>',
        type: "GET",
        data: {
            module_id: module_id,
            question_type: question_type,
        },
        success: function(data) {
            if (data.trim() !== null && data.trim() !== undefined && data.trim() !== '') {
                var obj = JSON.parse(data);
                $('.one').html('');
                $('#myModal').modal("toggle");
                for (var i = 0; i < obj.length; i++) {
                    $('#table').append('<tr class="one"><td><div class=""><input type="checkbox" id="checkbox" name="exam_id[]" value="' + obj[i].id + '"><label></label></div></td><td>' + obj[i].exam_name + '</td><td><a target="_blank" href="<?php echo base_url()?>admin/view_exam/' + obj[i].id + '">View</a></td></tr>');
                }
            } else {
                alert('no record found');
            }
        }
    });
}

</script>
