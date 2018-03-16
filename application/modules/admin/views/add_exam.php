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
                <?php echo $info_message; ?> </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo base_url('admin/chapterList')?>"><i class="fa fa-th-list">&nbsp;Exam List</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php if(isset($exam)){ echo base_url('admin/exam/'.$exam[0]->id); }else{ echo base_url('admin/exam'); }?>" class="registration_form1" enctype="multipart/form-data">
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
                                        <label class="col-md-3">Exam Name * </label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="exam_name" id="exam_name" placeholder="Exam Name" autocomplete="off" required="required" value="<?php if(isset($exam)){ echo $exam[0]->exam_name; } ?>"> <span class="red"><?php echo form_error('exam_name'); ?></span>
                                        </div>
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
                                <!-- <div class="clearfix"></div> -->
                                <div class="col-md-12" style="display: none;" id="question">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Question List</div>
                                        <div class="panel-body">
                                            <table class="table table-bordered" id="table">
                                                <tr>
                                                    <th>Select</th>
                                                    <th>Question</th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Total Question </label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="total_question" id="total_question" placeholder="Total Question" autocomplete="off" onkeyup="get_valid_value('total_question',this.value)" required="required" value="<?php if(isset($exam)){ echo $exam[0]->total_question; } ?>"> <span class="red"><?php echo form_error('total_question'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Time Per Question</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="time_per_question" id="time_per_question" placeholder="Time Per Question" autocomplete="off" onkeyup="get_valid_value('time_per_question',this.value)" required="required" value="<?php if(isset($exam)){ echo $exam[0]->time_per_question; } ?>"> <span class="red"><?php echo form_error('time_per_question'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Test Duration</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="test_duration" readonly id="test_duration" autocomplete="off" onkeyup="get_valid_value('time_per_question',this.value)" required="required" value="<?php if(isset($exam)){ echo $exam[0]->test_duration; } ?>"> <span class="red"><?php echo form_error('test_duration'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Passing Marks </label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="passing_marks" id="passing_marks" placeholder="Passing Marks" autocomplete="off" required="required" value="<?php if(isset($exam)){ echo $exam[0]->passing_marks; } ?>"> <span class="red"><?php echo form_error('passing_marks'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Positive Marks(per question) </label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="positive_mark" id="positive_mark" placeholder="Positive Marks" autocomplete="off" required="required" value="<?php if(isset($exam)){ echo $exam[0]->positive_mark; } ?>"> <span class="red"><?php echo form_error('positive_mark'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Negative Marks(per question) </label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="negative_mark" id="negative_mark" placeholder="Negative Marks" autocomplete="off" required="required" value="<?php if(isset($exam)){ echo $exam[0]->negative_mark; } ?>"> <span class="red"><?php echo form_error('negative_mark'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Attempted Question(NO.)</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="no_of_ques_attempt" id="no_of_ques_attempt" placeholder="No of Question To attempted" autocomplete="off" required="required" value="<?php if(isset($exam)){ echo $exam[0]->no_of_ques_attempt; } ?>"> <span class="red"><?php echo form_error('no_of_ques_attempt'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label class="col-md-3">Description</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="8" id="description" name="description" placeholder="Exam Description"><?php if(isset($exam)){ echo $exam[0]->description; } ?>
                                            </textarea> <span class="red"><?php echo form_error('description'); ?></span>
                                            <script type="text/javascript">
                                            CKEDITOR.replace('description');
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Payment Status</label>
                                        <div class="col-lg-9">
                                            <label class="radio-inline">
                                                <input type="radio" name="payment_status" value="paid" <?php if(isset($exam) && $exam[0]->payment_status=='paid'){ echo 'checked'; } else{  echo 'checked';}?>>Paid
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="payment_status" value="free" <?php if(isset($exam) && $exam[0]->payment_status=='free'){ echo 'checked'; } ?>>Free
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Question Type</label>
                                        <div class="col-lg-9">
                                            <label class="radio-inline">
                                                <input type="radio" name="question_status" value="sequential" checked>Sequential    
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="question_status" value="random">Random
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Assign Type</label>
                                        <div class="col-lg-9">
                                            <label class="radio-inline">
                                                <input type="radio" name="assign_type" value="sequential" checked>Automatically        
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="assign_type" value="random">Assign   
                                            </label>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Status</label>
                                        <div class="col-lg-9">
                                            <label class="radio-inline">
                                                <input type="radio" name="status" value="1" <?php if(isset($exam) && $exam[0]->is_active==1){ echo 'checked'; }else{ echo 'checked';  } ?>>Active
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="status" value="0" <?php if(isset($exam) && $exam[0]->is_active==0){ echo 'checked'; } ?>>Inactive
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" align="center">
                                    <button type="submit" value="Save" class="btn btn-success">Save</button>
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
    //$('select').niceSelect();
    $(".registration_form1").validate({
        rules: {
            "module_name": "required",

        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    $("#time_per_question").keyup(function() {
        var timeSec = $("#total_question").val() * $("#time_per_question").val();
        var shine = secondsTimeSpanToHMS(timeSec);
        $("#test_duration").val(shine);
    });
    $("#time_per_question").blur(function() {
        var timeSec = $("#total_question").val() * $("#time_per_question").val();
        var shine = secondsTimeSpanToHMS(timeSec);
        $("#test_duration").val(shine);
    });

      <?php if(isset($exam)){ ?>
      var module_id = $('#module_id').val();
      getChapter(module_id);
      var question_type=$('#question_type').val();
      getQuestion(question_type);
      <?php }?>
    
    $('#module_id').on('change', function() {

        var url = "<?php echo base_url('admin/getChapter') ?>";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                module_id: this.value
            },
            success: function(data) {
                console.log(data);
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

    $('#question_type').on('change', function() {
        var module_id = $('#module_id').val();
        var chapter_id = $('#chapter_id').val();
        var url = "<?php echo base_url('admin/getQuestion') ?>";
        $.ajax({
            url: url,
            type: "GEt",
            data: {
                question_type: this.value,
                module_id: module_id,
                chapter_id: chapter_id,
            },
            success: function(data) {

                if (data != null) {
                    var obj = JSON.parse(data);
                    // $('#table').html('');

                    $('.one').html('');

                    for (var i = 0; i < obj.length; i++) {
                        $('#table').append('<tr class="one"><td><div class="checkbox checkbox-success"><input type="checkbox"   id="checkbox1" name="question_id[]" value=" '+ obj[i].id +' "class="styled"><label></label></div></td><td>' + obj[i].en_question + '</td></tr>');
                        $('#question').show();
                        // $("#chapter_id").append($("<option></option>").val(obj[i].id).html(obj[i].en_chapter_name));

                    }
                } else {
                    $('#question').css('display', 'none');
                }

            }
        });
    });

});


function getChapter(value){

         var url = "<?php echo base_url('admin/getChapter') ?>";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                module_id: value
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
}

function getQuestion(value){
       
        var module_id = $('#module_id').val();
        var chapter_id = <?php if(isset($exam)){ echo $exam[0]->chapter_id; }else{ echo '0'; } ?>;
        var question_id= <?php if(isset($exam)){ echo $exam[0]->question_id; }else{ echo '1';} ?>;
        var url = "<?php echo base_url('admin/getQuestion') ?>";
        $.ajax({
            url: url,
            type: "GET",
            data: {
                question_type: value,
                module_id: module_id,
                chapter_id: chapter_id,
            },
            success: function(data) {
                console.log(data);
                if (data != null) {
                    var obj = JSON.parse(data);
                    // $('#table').html('');

                    $('.one').html('');

                    for (var i = 0; i < obj.length; i++) {
                        if(question_id==obj[i].id){
                        $('#table').append('<tr class="one"><td><div class="checkbox checkbox-success"><input type="checkbox" id="checkbox1" name="question_id[]" checked value=" '+ obj[i].id +' "class="styled"><label></label></div></td><td>' + obj[i].en_question + '</td></tr>');
                    }else{
                            $('#table').append('<tr class="one"><td><div class="checkbox checkbox-success"><input type="checkbox" id="checkbox1" name="question_id[]" value=" '+ obj[i].id +' "class="styled"><label></label></div></td><td>' + obj[i].en_question + '</td></tr>');
                    }
                        $('#question').show();
                        // $("#chapter_id").append($("<option></option>").val(obj[i].id).html(obj[i].en_chapter_name));

                    }
                } else {
                    $('#question').css('display', 'none');
                }

            }
        });
 
}
function get_valid_value(id_name, value) {
    if (isNaN(value) == true) {
        $("#" + id_name).val("");
    }
}

function secondsTimeSpanToHMS(s) {

    var h = Math.floor(s / 3600); //Get whole hours
    s -= h * 3600;
    var m = Math.floor(s / 60); //Get remaining minutes
    s -= m * 60;
    var ground = h + ":" + (m < 10 ? '0' + m : m) + ":" + (s < 10 ? '0' + s : s); //zero padding on minutes and seconds
    return ground;
}
</script>