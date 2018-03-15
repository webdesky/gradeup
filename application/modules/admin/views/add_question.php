<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Question</h1>
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
                <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo base_url('admin/questionList')?>"><i class="fa fa-th-list">&nbsp;Question List</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('admin/question') ?>" class="registration_form1" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 ">Module Name * </label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="module_id" id="module_id">
                                                <option data-display="--Select Modules--">--Select Modules--</option>
                                                <?php foreach ($modules as $key => $value) { ?>
                                                <option value="<?php echo $value['id']; ?>">
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
                                <div class="clearfix"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Question Marks </label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="question_marks" id="question_marks" placeholder="Question Marks" autocomplete="off" value="<?php echo set_value('question_marks'); ?>"> <span class="red"><?php echo form_error('question_marks'); ?></span> </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Question Type</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="question_type" onchange="questionChanges(this.value)">
                                                <option data-display="--Select question_type--">--Please Select Question Type--</option>
                                                <option value="Options">Options </option>
                                                <option value="Fill In the Blank">Fill In the Blank</option>
                                                <!-- <option value="Descriptive">Descriptive</option> -->
                                                <option value="True False">True False</option>
                                            </select>
                                            <span class="red"><?php echo form_error('question_type'); ?></span> </div>
                                    </div>
                                </div>
                                <div id="option11" style="display: none">
                                    <div class="col-md-6 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Question IN English * </label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="en_question" name="en_question" placeholder="English Question">
                                                </textarea> <span class="red"><?php echo form_error('en_question'); ?></span>
                                                <script type="text/javascript">
                                                CKEDITOR.replace('en_question');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="option12" style="display: none">
                                    <div class="col-md-6 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Question In Hindi</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="hi_question" name="hi_question" placeholder="Hindi Question">
                                                </textarea> <span class="red"><?php echo form_error('hi_question'); ?></span>
                                                <script type="text/javascript">
                                                CKEDITOR.replace('hi_question');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div id="option1" style="display: none">
                                    <div class="col-md-6 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Option A * </label>
                                            <div class="col-md-9">
                                                <input type="hidden" name="id">
                                                <textarea class="form-control" rows="8" id="en_option_a" name="en_option_a" placeholder="Option A">
                                                </textarea> <span class="red"><?php echo form_error('en_option_a'); ?></span>
                                                <script type="text/javascript">
                                                CKEDITOR.replace('en_option_a');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="option2" style="display: none">
                                    <div class="col-md-6 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Option A Hindi</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="hi_option_a" name="hi_option_a" placeholder="Option A">
                                                </textarea> <span class="red"><?php echo form_error('hi_option_a'); ?></span>
                                                <script type="text/javascript">
                                                CKEDITOR.replace('hi_option_a');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="option3" style="display: none">
                                    <div class="col-md-6 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Option B * </label>
                                            <div class="col-md-9">
                                                <input type="hidden" name="id">
                                                <textarea class="form-control" rows="8" id="en_option_b" name="en_option_b" placeholder="Option B">
                                                </textarea> <span class="red"><?php echo form_error('en_option_b'); ?></span>
                                                <script type="text/javascript">
                                                CKEDITOR.replace('en_option_b');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="option4" style="display: none">
                                    <div class="col-md-6 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Option B Hindi</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="hi_option_b" name="hi_option_b" placeholder="Option b">
                                                </textarea> <span class="red"><?php echo form_error('hi_option_b'); ?></span>
                                                <script type="text/javascript">
                                                CKEDITOR.replace('hi_option_b');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="option5" style="display: none">
                                    <div class="col-md-6 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Option C * </label>
                                            <div class="col-md-9">
                                                <input type="hidden" name="id">
                                                <textarea class="form-control" rows="8" id="en_option_c" name="en_option_c" placeholder="Option C">
                                                </textarea> <span class="red"><?php echo form_error('en_option_c'); ?></span>
                                                <script type="text/javascript">
                                                CKEDITOR.replace('en_option_c');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="option6" style="display: none">
                                    <div class="col-md-6 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Option C Hindi</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="hi_option_c" name="hi_option_c" placeholder="Option C">
                                                </textarea> <span class="red"><?php echo form_error('hi_option_c'); ?></span>
                                                <script type="text/javascript">
                                                CKEDITOR.replace('hi_option_c');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="option7" style="display: none">
                                    <div class="col-md-6 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Option D * </label>
                                            <div class="col-md-9">
                                                 <textarea class="form-control" rows="8" id="en_option_d" name="en_option_d" placeholder="Option D">
                                                    </textarea> <span class="red"><?php echo form_error('en_option_d'); ?></span>
                                                    <script type="text/javascript">
                                                    CKEDITOR.replace('en_option_d');
                                                    </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="option8" style="display: none">
                                    <div class="col-md-6 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Option D Hindi</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="hi_option_d" name="hi_option_d" placeholder="Option D">
                                                </textarea> <span class="red"><?php echo form_error('hi_option_d'); ?></span>
                                                <script type="text/javascript">
                                                CKEDITOR.replace('hi_option_d');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="option13" style="display: none">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3">Answer * </label>
                                            <div class="col-md-9">
                                                
                                                <textarea class="form-control" rows="8" id="en_answer" name="en_answer" placeholder="Answer">
                                                </textarea> <span class="red"><?php echo form_error('en_answer'); ?></span>
                                                <script type="text/javascript">
                                                CKEDITOR.replace('en_answer');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="option14" style="display: none">
                                    <div class="col-md-6 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Answer In Hindi</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="hi_answer" name="hi_answer" placeholder="ANswer">
                                                </textarea> <span class="red"><?php echo form_error('hi_answer'); ?></span>
                                                <script type="text/javascript">
                                                CKEDITOR.replace('hi_answer');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="option17" style="display: none">
                                    <div class="col-md-6 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Answer</label>
                                            <div class="col-md-9">
                                                <select  name="en_answers" class="form-control">
                                                    <option value="" selected="">Please Correct Answer</option>
                                                    <option value="1">True</option>
                                                    <option value="0">False</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div id="option15" style="display: none">
                                    <div class="col-md-6 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Explaination</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="en_explaination" name="en_explaination" placeholder="Explaination">
                                                </textarea> <span class="red"><?php echo form_error('en_explaination'); ?></span>
                                                <script type="text/javascript">
                                                CKEDITOR.replace('en_explaination');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="option16" style="display: none">
                                    <div class="col-md-6 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Explaination In Hindi</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="hi_explaination" name="hi_explaination" placeholder="Explaination">
                                                </textarea> <span class="red"><?php echo form_error('hi_explaination'); ?></span>
                                                <script type="text/javascript">
                                                CKEDITOR.replace('hi_explaination');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Status</label>
                                    <div class="col-lg-6">
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="1" checked>Active
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="0">Inactive
                                        </label>
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
    })
});





function questionChanges(val) {

    if (val == 'Options') {
        $('#options').css('display', 'block');
        $('#option11').css('display', 'block');
        $('#option12').css('display', 'block');
        $('#option1').css('display', 'block');
        $('#option2').css('display', 'block');
        $('#option3').css('display', 'block');
        $('#option4').css('display', 'block');
        $('#option5').css('display', 'block');
        $('#option6').css('display', 'block');
        $('#option7').css('display', 'block');
        $('#option8').css('display', 'block');
        $('#option9').css('display', 'none');
        $('#option10').css('display', 'none');

        $('#option13').css('display', 'block');
        $('#option14').css('display', 'block');
        $('#option15').css('display', 'block');
        $('#option16').css('display', 'block');
        $('#option17').css('display', 'none');
    } else if (val == 'Fill In the Blank') {
        $('#options').css('display', 'block');
        $('#option11').css('display', 'block');
        $('#option12').css('display', 'block');
        $('#option1').css('display', 'block');
        $('#option2').css('display', 'block');
        $('#option3').css('display', 'block');
        $('#option4').css('display', 'block');
        $('#option5').css('display', 'block');
        $('#option6').css('display', 'block');
        $('#option7').css('display', 'block');
        $('#option8').css('display', 'block');
        $('#option9').css('display', 'none');
        $('#option10').css('display', 'none');
        $('#option13').css('display', 'block');
        $('#option14').css('display', 'block');
        $('#option15').css('display', 'block');
        $('#option16').css('display', 'block');
        $('#option17').css('display', 'none');

    } else if (val == 'Descriptive') {
        $('#options').css('display', 'none');
        $('#option1').css('display', 'none');
        $('#option2').css('display', 'none');
        $('#option3').css('display', 'none');
        $('#option4').css('display', 'none');
        $('#option5').css('display', 'none');
        $('#option6').css('display', 'none');
        $('#option7').css('display', 'none');
        $('#option8').css('display', 'none');
        $('#option9').css('display', 'none');
        $('#option10').css('display', 'none');
        $('#option11').css('display', 'block');
        $('#option12').css('display', 'block');
        $('#option13').css('display', 'block');
        $('#option14').css('display', 'block');
        $('#option15').css('display', 'block');
        $('#option16').css('display', 'block');
        $('#option17').css('display', 'none');
        //$('#answers_type').css('display', 'none');
    } else if (val == 'True False') {
        $('#options').css('display', 'none');
        $('#option1').css('display', 'none');
        $('#option2').css('display', 'none');
        $('#option3').css('display', 'none');
        $('#option4').css('display', 'none');
        $('#option5').css('display', 'none');
        $('#option6').css('display', 'none');
        $('#option7').css('display', 'none');
        $('#option8').css('display', 'none');
        $('#option9').css('display', 'none');
        $('#option10').css('display', 'none');
        $('#option11').css('display', 'block');
        $('#option12').css('display', 'block');
        $('#option13').css('display', 'none');
        $('#option14').css('display', 'none');
        $('#option15').css('display', 'block');
        $('#option16').css('display', 'block');
        $('#option17').css('display', 'block');


        //$('#pattern_type').css('display', 'block');
    } else {

        // $('#option1div').css('display', 'none');

    }
}

function show_answer_option(id) {
    if (id == 2) {
        $('#option9').css('display', 'block');
        $('#option10').css('display', 'block');
    } else {
        $('#option9').css('display', 'none');
        $('#option10').css('display', 'none');
    }
}
</script>