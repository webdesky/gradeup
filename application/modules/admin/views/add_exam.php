<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php if(isset($exam) && !empty($exam)){ echo 'Edit Exam';}else{ echo 'Add Exam';}?></h1>
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
                                    <form role="form" method="post" action="<?php if(isset($exam)){ echo base_url('admin/exam/'.$exam[0]->id); }else{ echo base_url('admin/exam'); }?>" class="registration_form1" enctype="multipart/form-data">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-3">Package Name * </label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" name="exam_name" id="exam_name" placeholder="exam Name" autocomplete="off" required="required" value="<?php if(isset($exam)){ echo $exam[0]->exam_name; }else{echo set_value('exam_name');} ?>"> <span class="red"><?php echo form_error('exam_name'); ?></span>
                                                </div>
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
                                                <label class="col-md-3 ">Chapter Name * </label>
                                                <div class="col-md-9">
                                                    <select class="form-control" name="chapter_id[]" id="chapter_id" multiple="multiple">
                                                        <option data-display="--Select Chapter--">--Select Chapter--</option>
                                                        <?php if(!empty($chapters[0])){ foreach($chapters as $values){?>
                                                            <option value="<?php echo $values->id?>" <?php if(!empty($exam[0]->chapter_id)){ $chapter_array = explode(',', $exam[0]->chapter_id); if(in_array($values->id, $chapter_array)){ echo 'selected';}}?>>
                                                                <?php echo $values->en_chapter_name;?>
                                                            </option>
                                                            <?php }}?>
                                                    </select> <span class="red"><?php echo form_error('chapter_id'); ?></span> </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-3">Question Type</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" name="question_type" id="question_type">
                                                        <option value="">--Please Select Question Type--</option>
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

                                        <!-- Question modal starts -->
                                        <div id="myModal" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Question List</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-md-12" style="display: none;" id="question">
                                                            <div class="panel panel-primary">
                                                                <div class="panel-heading">Question List</div>
                                                                <div class="panel-body">
                                                                    <table class="table table-bordered" id="table">
                                                                        <tr>
                                                                            <th>
                                                                                <input type="checkbox" id="checkAll">
                                                                            </th>
                                                                            <th>Question</th>
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
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <label class="col-md-3">Description</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control" rows="8" id="description" name="description" placeholder="Exam Description">
                                                        <?php if(isset($exam)){ echo $exam[0]->description; }else{echo set_value('description');} ?>
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
                                                        <input type="radio" name="payment_status" value="paid" <?php if(isset($exam) && $exam[0]->payment_status=='paid'){ echo 'checked'; } else{ echo 'checked';}?>>Paid
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="payment_status" value="free" <?php if(isset($exam) && $exam[0]->payment_status=='free'){ echo 'checked'; } ?>>Free
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-3">Status</label>
                                                <div class="col-lg-9">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="status" value="1" <?php if(isset($exam) && $exam[0]->is_active==1){ echo 'checked'; }else{ echo 'checked'; } ?>>Active
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="status" value="0" <?php if(isset($exam) && $exam[0]->is_active==0){ echo 'checked'; } ?>>Inactive
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <br/>
                                        <br/>
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
        // var module_id = $('#module_id').val();
        // getChapter(module_id);
        // var question_type = $('#question_type').val();
        // getQuestion(question_type);
        <?php }?>

        $('#question_type').on('change', function() {
            var module_id = $('#module_id').val();
            var chapter_id = [];
            $.each($("#chapter_id option:selected"), function() {
                chapter_id.push($(this).val());
            });
            var url = "<?php echo base_url('admin/getQuestion') ?>";
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    question_type: this.value,
                    module_id: module_id,
                    chapter_id: chapter_id,
                },
                success: function(data) {
                    if (data != null) {
                        var obj = JSON.parse(data);
                        $('.one').html('');
                        $('#myModal').modal("toggle");
                        for (var i = 0; i < obj.length; i++) {
                            $('#table').append('<tr class="one"><td><div class="checkbox checkbox-success"><input type="checkbox"   id="checkbox1" name="question_id[]" value=" ' + obj[i].id + ' "class="styled"><label></label></div></td><td>' + obj[i].en_question + '</td></tr>');
                            $('#question').show();
                        }
                    } else {
                        $('#question').css('display', 'none');
                    }
                    

                }
            });
        });

    });

    function getChapter(value) {
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

    function getQuestion(value) {

        var module_id   = $('#module_id').val();
        var chapter_id  = '<?php if(isset($exam)){ echo $exam[0]->chapter_id; }else{ echo '0'; } ?>';
        var question_id = '<?php if(isset($exam)){ echo $exam[0]->question_id; }else{ echo '1';} ?>';
        var url         = "<?php echo base_url('admin/getQuestion') ?>";
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
                    $('.one').html('');

                    for (var i = 0; i < obj.length; i++) {
                        if (question_id == obj[i].id) {
                            $('#table').append('<tr class="one"><td><div class="checkbox checkbox-success"><input type="checkbox" id="checkbox1" name="question_id[]" checked value=" ' + obj[i].id + ' "class="styled"><label></label></div></td><td>' + obj[i].en_question + '</td></tr>');
                        } else {
                            $('#table').append('<tr class="one"><td><div class="checkbox checkbox-success"><input type="checkbox" id="checkbox1" name="question_id[]" value=" ' + obj[i].id + ' "class="styled"><label></label></div></td><td>' + obj[i].en_question + '</td></tr>');
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
    $("#checkAll").click(function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    $('#module_id').on('change', function() {
        var url = "<?php echo base_url('admin/getChapter') ?>";
        $.ajax({
            url: url,
            type: "GET",
            data: {
                module_id: this.value
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#chapter_id').html('');
                if (obj.length != 0) {
                    var options = '';
                    for (var i = 0; i < obj.length; i++) {
                        options += '<option value="' + obj[i].id + '">' + obj[i].en_chapter_name + '</option>';
                    }

                    $("#chapter_id").html(options);
                }
            }
        });
    });
</script>