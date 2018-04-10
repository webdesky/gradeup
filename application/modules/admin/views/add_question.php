<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Question</h1>
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
                <div class="panel-heading"> 
                    <a class="btn btn-primary" href="<?php echo base_url('admin/questionList')?>">
                        <i class="fa fa-th-list">&nbsp;Question List</i>
                    </a> 
                    <?php if(!isset($questions)) {?>
                    <a class="btn btn-primary" data-toggle="modal" data-target="#questionModel">
                        <i class="fa fa-th-list">&nbsp;Upload Excel</i>
                    </a> 
                    <a class="btn btn-primary" href="<?php echo base_url('asset/uploads/question_excel.xlsx')?>">
                        <i class="fa fa-th-list">&nbsp;Excel Format</i>
                    </a> 
                    <?php }?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php if(isset($questions)) {  echo base_url('admin/question/'.$questions[0]->id); }else{ echo base_url('admin/question'); } ?>" class="registration_form12" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 ">Module Name * </label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="module_id" id="module_id" required="required">
                                                <option value="">--Select Modules--</option>
                                                <?php foreach ($modules as $key => $value) { ?>
                                                <option value="<?php echo $value['id']; ?>" <?php if(isset($questions) && $questions[0]->module_id==$value['id']){ ?> selected
                                                    <?php }?>>
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
                                            <select class="form-control" name="chapter_id" id="chapter_id" required="required">
                                                <option value="">--Select Chapter--</option>
                                                <?php if(!empty($chapters)){ foreach($chapters as $val){?>
                                                <option value="<?php echo $val->id;?>" <?php if(isset($questions) && $questions[0]->chapter_id==$val->id){ echo 'selected';}?>><?php echo $val->en_chapter_name;?></option>
                                                <?php }}?>
                                            </select> <span class="red"><?php echo form_error('chapter_id'); ?></span> </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Status </label>
                                        <div class="col-md-9">
                                            <label class="radio-inline">
                                            <input type="radio" name="status" value="1" <?php if(isset($questions) && $questions[0]->is_active==1){ ?> checked
                                            <?php }else{ echo 'checked'; }?>>Active
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="0" <?php if(isset($questions) && $questions[0]->is_active==0){ ?> checked <?php }?>>Inactive
                                        </label> </div>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Question Type</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="question_type" id="question_type" onchange="questionChanges(this.value)">
                                                <option value="">--Please Select Question Type--</option>
                                                <option value="Options" <?php if(isset($questions) && $questions[0]->question_type=='Options'){ ?> selected
                                                    <?php }?> >Options </option>
                                                <option value="Fill In the Blank" <?php if(isset($questions) && $questions[0]->question_type=='Fill In the Blank'){ ?> selected
                                                    <?php }?>>Fill In the Blank</option>
                                                <option value="True False" <?php if(isset($questions) && $questions[0]->question_type=='True False'){ ?> selected
                                                    <?php }?>>True False</option>
                                            </select>
                                            <span class="red"><?php echo form_error('question_type'); ?></span> </div>
                                    </div>
                                </div>

                                <div class="col-md-6 border-shadowss" style="display: none">
                                 
                                <div id="option11" style="display: none">
                                    <div class="en_div">English</div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-3">Question  </label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="en_question" name="en_question" placeholder="English Question">
                                                    <?php  if(isset($questions)) {  echo  $questions[0]->en_question; }else{echo set_value('en_question');} ?>
                                                </textarea> <span class="red"><?php echo form_error('en_question'); ?></span>
                                                <script type="text/javascript">
                                                CKEDITOR.replace('en_question');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="option1" style="display: none">
                                    <div class="col-md-12 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Option A * </label>
                                            <div class="col-md-9">
                                                <input type="hidden" name="id">
                                                <textarea class="form-control" rows="8" id="en_option_a" name="en_option_a" placeholder="Option A">
                                                    <?php  if(isset($questions)) {  echo  $questions[0]->en_option_a; }else{echo set_value('en_option_a');} ?>
                                                </textarea> <span class="red"><?php echo form_error('en_option_a'); ?></span>
                                               <!--  <script type="text/javascript">
                                                CKEDITOR.replace('en_option_a');
                                                </script> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="option3" style="display: none">
                                    <div class="col-md-12 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Option B * </label>
                                            <div class="col-md-9">
                                                <input type="hidden" name="id">
                                                <textarea class="form-control" rows="8" id="en_option_b" name="en_option_b" placeholder="Option B">
                                                    <?php  if(isset($questions)) {  echo  $questions[0]->en_option_b; }else{echo set_value('en_option_b');} ?>
                                                </textarea> <span class="red"><?php echo form_error('en_option_b'); ?></span>
                                                <!-- <script type="text/javascript">
                                                CKEDITOR.replace('en_option_b');
                                                </script> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                 <div id="option5" style="display: none">
                                    <div class="col-md-12 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Option C * </label>
                                            <div class="col-md-9">
                                                <input type="hidden" name="id">
                                                <textarea class="form-control" rows="8" id="en_option_c" name="en_option_c" placeholder="Option C">
                                                    <?php  if(isset($questions)) {  echo  $questions[0]->en_option_c; }else{echo set_value('en_option_c');} ?>
                                                </textarea> <span class="red"><?php echo form_error('en_option_c'); ?></span>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                 <div id="option7" style="display: none">
                                    <div class="col-md-12 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Option D * </label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="en_option_d" name="en_option_d" placeholder="Option D">
                                                    <?php  if(isset($questions)) {  echo  $questions[0]->en_option_d; }else{echo set_value('en_option_d');} ?>
                                                </textarea> <span class="red"><?php echo form_error('en_option_d'); ?></span>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="option13" style="display: none">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-3">Answer * </label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="en_answer" name="en_answer" placeholder="Answer">
                                                    <?php  if(isset($questions)) {  echo  $questions[0]->en_answer; }else{echo set_value('en_answer');} ?>
                                                </textarea> <span class="red"><?php echo form_error('en_answer'); ?></span>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="option15" style="display: none">
                                    <div class="col-md-12 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Explaination</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="en_explaination" name="en_explaination" placeholder="Explaination">
                                                    <?php  if(isset($questions)) {  echo  $questions[0]->en_explaination; }else{echo set_value('en_explaination');} ?>
                                                </textarea> <span class="red"><?php echo form_error('en_explaination'); ?></span>
                                                <script type="text/javascript">
                                                CKEDITOR.replace('en_explaination');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               </div>
                              <!--  <div class="clearfix"></div> -->
                               <div class="col-md-6 border-shadowss" style="display: none">
                                
                               <div id="option12" style="display: none">
                                 <div class="en_div">Hindi</div>
                                    <div class="col-md-12 ">
                                        <div class="form-group">
                                            <label class="col-md-3">Question</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="hi_question" name="hi_question" placeholder="Hindi Question">
                                                    <?php  if(isset($questions)) {  echo  $questions[0]->hi_question; }else{echo set_value('hi_question');} ?>
                                                </textarea> <span class="red"><?php echo form_error('hi_question'); ?></span>
                                                <script type="text/javascript">
                                                CKEDITOR.replace('hi_question');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           
                                <div class="clearfix"></div>
                                
                                <div id="option2" style="display: none">
                                    <div class="col-md-12 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Option A </label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="hi_option_a" name="hi_option_a" placeholder="Option A">
                                                    <?php  if(isset($questions)) {  echo  $questions[0]->hi_option_a; }else{echo set_value('hi_option_a');} ?>
                                                </textarea> <span class="red"><?php echo form_error('hi_option_a'); ?></span>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="option4" style="display: none">
                                    <div class="col-md-12 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Option B </label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="hi_option_b" name="hi_option_b" placeholder="Option b">
                                                    <?php  if(isset($questions)) {  echo  $questions[0]->hi_option_b; }else{echo set_value('hi_option_b');} ?>
                                                </textarea> <span class="red"><?php echo form_error('hi_option_b'); ?></span>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <div id="option6" style="display: none">
                                    <div class="col-md-12 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Option C </label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="hi_option_c" name="hi_option_c" placeholder="Option C">
                                                    <?php  if(isset($questions)) {  echo  $questions[0]->hi_option_c; }else{echo set_value('hi_option_c');} ?>
                                                </textarea> <span class="red"><?php echo form_error('hi_option_c'); ?></span>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <div id="option8" style="display: none">
                                    <div class="col-md-12 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Option D </label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="hi_option_d" name="hi_option_d" placeholder="Option D">
                                                    <?php  if(isset($questions)) {  echo  $questions[0]->hi_option_d; }else{echo set_value('hi_option_d');} ?>
                                                </textarea> <span class="red"><?php echo form_error('hi_option_d'); ?></span>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="option14" style="display: none">
                                    <div class="col-md-12 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Answer </label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="hi_answer" name="hi_answer" placeholder="ANswer">
                                                    <?php  if(isset($questions)) {  echo  $questions[0]->hi_answer; }else{echo set_value('hi_answer');} ?>
                                                </textarea> <span class="red"><?php echo form_error('hi_answer'); ?></span>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="clearfix"></div>
                                
                                <div id="option16" style="display: none">
                                    <div class="col-md-12 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Explaination </label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="hi_explaination" name="hi_explaination" placeholder="Explaination">
                                                    <?php  if(isset($questions)) {  echo  $questions[0]->hi_explaination; }else{echo set_value('hi_explaination');} ?>
                                                </textarea> <span class="red"><?php echo form_error('hi_explaination'); ?></span>
                                                <script type="text/javascript">
                                                CKEDITOR.replace('hi_explaination');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <br><br>
                             <div id="option17" style="display: none">
                                    <div class="col-md-6 border-rights">
                                        <div class="form-group">
                                            <label class="col-md-3">Answer</label>
                                            <div class="col-md-9">
                                                <select name="en_answers" class="form-control">
                                                    <option value="" selected="">Please Correct Answer</option>
                                                    <option value="1" <?php if(isset($questions) && $questions[0]->en_answer==1){ ?> selected
                                                        <?php }?>>True</option>
                                                    <option value="0" <?php if(isset($questions) && $questions[0]->en_answer==0){ ?> selected
                                                        <?php }?>>False</option>
                                                </select>
                                            </div>
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
        <?php if (!empty($validation)){ ?>
            <script type="text/javascript">
                 $(window).on('load',function(){
                    $('#questionModel').modal('show');
                });
            </script>
        <?php }?>
</div>
</div>



<div id="questionModel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Excel</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="<?php  echo base_url('admin/excelupload');?>" class="registration_form12" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-4">Module Name * </label>
                            <div class="col-md-8">
                                <select class="form-control" name="module_id1" id="module_id1" required="required">
                                    <option value="">--Select Modules--</option>
                                    <?php foreach ($modules as $key => $value) { ?>
                                    <option value="<?php echo $value['id']; ?>" <?php if(isset($questions) && $questions[0]->module_id==$value['id']){ ?> selected
                                        <?php }?>>
                                        <?php echo ucwords($value['en_module_name']); ?>
                                    </option>
                                    <?php } ?>
                                </select>
                                <span class="red"><?php echo form_error('module_id1'); ?></span> 
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-4">Chapter Name * </label>
                            <div class="col-md-8">
                                <select class="form-control" name="chapter_id1" id="chapter_id1" required="required">
                                    <option value="">--Select Chapter--</option>
                                    <?php if(!empty($chapters)){ foreach($chapters as $val){?>
                                    <option value="<?php echo $val->id;?>" <?php if(isset($questions) && $questions[0]->chapter_id==$val->id){ echo 'selected';}?>><?php echo $val->en_chapter_name;?></option>
                                    <?php }}?>
                                </select> 
                                <span class="red"><?php echo form_error('chapter_id1'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-4">Question Type</label>
                            <div class="col-md-8">
                                <select class="form-control" name="question_type1" id="question_type">
                                    <option value="">--Please Select Question Type--</option>
                                    <option value="Options" <?php if(isset($questions) && $questions[0]->question_type=='Options'){ ?> selected
                                        <?php }?> >Options </option>
                                    <option value="Fill In the Blank" <?php if(isset($questions) && $questions[0]->question_type=='Fill In the Blank'){ ?> selected
                                        <?php }?>>Fill In the Blank</option>
                                    <!-- <option value="Descriptive">Descriptive</option> -->
                                    <option value="True False" <?php if(isset($questions) && $questions[0]->question_type=='True False'){ ?> selected
                                        <?php }?>>True False</option>
                                </select>
                                <span class="red"><?php echo form_error('question_type1'); ?></span> </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-4">Upload Excel</label>
                            <div class="col-md-8">
                                <input type="file" name="question_excel" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                <span class="red"><?php echo form_error('question_excel'); ?></span> </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                        <br/>
                        <div class="col-md-12" align="center">
                            <button type="submit" value="Save" class="btn btn-success">Save</button>
                            <input type="reset" class="btn btn-default" value="Reset"> 
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
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

    var question_type = $('#question_type').val();
    questionChanges(question_type);
    var module = $('#module_id').val();
    

    function getChapter(value) {
        var url = "<?php echo base_url('admin/getChapter') ?>";
        $.ajax({
            url: url,
            type: "GET",
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
    $('#module_id').on('change', function() {
        var url = "<?php echo base_url('admin/getChapter') ?>";
        $.ajax({
            url: url,
            type: "GET",
            data: {
                module_id: this.value
            },
            success: function(data) {
                if(data.length!=''){
                var obj = JSON.parse(data);
                $('#chapter_id').html('');
                if (obj.length != 0) {
                    for (var i = 0; i < obj.length; i++) {
                        $("#chapter_id").append($("<option></option>").val(obj[i].id).html(obj[i].en_chapter_name));
                    }
                }
            }}

        });
    });
    $('#module_id1').on('change', function() {
        var url = "<?php echo base_url('admin/getChapter') ?>";
        $.ajax({
            url: url,
            type: "GET",
            data: {
                module_id: this.value
            },
            success: function(data) {
                if(data.length!=''){
                var obj = JSON.parse(data);
                $('#chapter_id1').html('');
                if (obj.length != 0) {
                    for (var i = 0; i < obj.length; i++) {
                        $("#chapter_id1").append($("<option></option>").val(obj[i].id).html(obj[i].en_chapter_name));
                    }
                }
            }}

        });
    })
});



function questionChanges(val) {
    if (val == 'Options') {
        $('.border-shadowss').css('display', 'block');
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
        $('.border-shadowss').css('display', 'block');
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
        $('.border-shadowss').css('display', 'block');
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
    } else if (val == 'True False') {
        $('.border-shadowss').css('display', 'block');
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
    } else {}
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



