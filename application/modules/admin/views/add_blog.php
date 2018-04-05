<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Blog</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <?php if(!empty($msg)){?>
            <div class="alert alert-success">
                <?php echo $msg;?> </div>
            <?php }?>
            <?php if ($info_message = $this->session->flashdata('info_message')): ?>
            <div id="form-messages" class="alert alert-success" role="alert">
                <?php echo $info_message; ?> </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading"><a class="btn btn-primary" href="#"><i class="fa fa-th-list">&nbsp;Blog List</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php if(isset($blog)){ echo base_url('admin/blog/'.$blog[0]->id); }else{ echo base_url('admin/blog'); }?>" class="registration_form1" enctype="multipart/form-data">
                                <div class="col-md-6 border-shadowss">
                                    <div class="en_div">English</div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2"> Title * </label>
                                            <div class="col-md-10">
                                                <input type="text" name="en_title" id="en_title" class="form-control" value="<?php if(isset($blog)){ echo $blog[0]->en_title; }else{echo set_value('en_title');} ?>">
                                                 <span class="red"><?php echo form_error('en_title'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 ">
                                        <div class="form-group">
                                            <label class="col-md-2"> Description * </label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" rows="8" id="en_description" name="en_description" placeholder="about us"><?php if(isset($blog)){ echo $blog[0]->en_description; }else{echo set_value('en_description');} ?>
                                                </textarea> <span class="red"><?php echo form_error('en_description'); ?></span>
                                                <script type="text/javascript">
                                                    CKEDITOR.replace('en_description');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <br/>
                                    <div class="col-md-12 ">
                                        <div class="form-group">
                                            <label class="col-md-2"> Address * </label>
                                            <div class="col-md-10">
                                                <input type="text" name="en_address" class="form-control" value="<?php if(isset($blog)){ echo $blog[0]->en_address; }else{echo set_value('en_address');} ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 border-shadowss">
                                    <div class="en_div">Hindi</div>
                                    <div class="col-md-12 ">
                                        <div class="form-group">
                                            <label class="col-md-2"> Title * </label>
                                            <div class="col-md-10">
                                                <input type="text" name="hi_title" id="hi_title" class="form-control" value="<?php if(isset($blog)){ echo $blog[0]->hi_title; }else{echo set_value('hi_title');} ?>">
                                                  <span class="red"><?php echo form_error('hi_title'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2"> Description * </label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" rows="8" id="hi_description" name="hi_description" placeholder="about_us"><?php if(isset($blog)){ echo $blog[0]->hi_description; }else{echo set_value('hi_description');} ?>
                                                </textarea> <span class="red"><?php echo form_error('hi_description'); ?></span>
                                                <script type="text/javascript">
                                                    CKEDITOR.replace('hi_description');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <br/>
                                    <div class="col-md-12 ">
                                        <div class="form-group">
                                            <label class="col-md-2"> Address * </label>
                                            <div class="col-md-10">
                                                <input type="text" name="hi_address" class="form-control" value="<?php if(isset($blog)){ echo $blog[0]->hi_address; }else{echo set_value('hi_address');} ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Event Date* </label>
                                            <div class="col-md-10">
                                                <input type="text" name="blog_date" id="blog_date" class="form-control date" autocomplete="off" readonly="readonly" placeholder="Blog Date" value="<?php if(isset($blog)){ echo $blog[0]->blog_date; } ?>" style="width: 50%;float: left;">
                                                <span><?php echo form_error('event_date'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Status* </label>
                                        <div class="col-md-9">
                                            <label class="radio-inline">
                                                <input type="radio" name="status" value="1" <?php if(isset($blog) && $blog[0]->is_active==1){ echo "checked";} ?>>Active
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="status" value="0" <?php if(isset($blog) && $blog[0]->is_active==0){ echo "checked";} ?>>Inactive
                                            </label>
                                            <span class="red"><?php echo form_error('status'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Image </label>
                                            <div class="col-md-10">
                                                <input type="file" name="image" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="col-md-12" align="center">
                                    <button type="submit" value="Save" class="btn btn-success">Save</button>
                                    <input type="reset" class="btn btn-default" value="Reset">
                                </div>
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
    $('select').niceSelect();
    $(".registration_form1").validate({
        rules: {
            "en_about_us": "required",
            "hi_about_us": "required",
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>