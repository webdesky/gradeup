<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Post</h1>
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
                <div class="panel-heading"><a class="btn btn-primary" href="<?php echo base_url('admin/post_list')?>"><i class="fa fa-th-list">&nbsp;Post</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <?php if(!empty($post[0])){?>
                                <form role="form" method="post" action="<?php echo base_url('admin/post/'.$post[0]->id) ?>" class="registration_form1" enctype="multipart/form-data">
                            <?php }else{?>
                                <form role="form" method="post" action="<?php echo base_url('admin/post') ?>" class="registration_form1" enctype="multipart/form-data">
                            <?php }?>
                                <div class="col-md-6 border-rights">
                                    <div class="form-group">
                                        <label class="col-md-3">Select Module * </label>
                                        <div class="col-md-9">
                                            <select class="wide" name="module_id">
                                                <option data-display="-- Select Module --" value="">-- Select Module --</option>
                                                <?php foreach($modules as $module):?>
                                                <option value="<?php echo $module->id;?>" <?php if(!empty($post[0])){
                                                    if($post[0]->module_id==$module->id){ echo 'selected';}
                                                    }?>><?php echo $module->en_module_name;?></option>
                                                <?php endforeach;?>
                                            </select>
                                            <span class="red"><?php echo form_error('module_id'); ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 border-rights">
                                    <div class="form-group">
                                        <label class="col-md-3">English Post Title * </label>
                                        <div class="col-md-9">
                                            <input type="text" name="en_post_title" class="form-control" value="<?php if(!empty($post[0])){ echo $post[0]->en_post_title;}else{ echo set_value('en_post_title');} ?>">
                                            <span class="red"><?php echo form_error('en_post_title'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 border-rights">
                                    <div class="form-group">
                                        <label class="col-md-3">Hindi Post Title * </label>
                                        <div class="col-md-9">
                                            <input type="text" name="hi_post_title" class="form-control" value="<?php if(!empty($post[0])){ echo $post[0]->hi_post_title;}else{ echo set_value('hi_post_title');} ?>">
                                            <span class="red"><?php echo form_error('hi_post_title'); ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 border-rights">
                                    <div class="form-group">
                                        <label class="col-md-3">English Post * </label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="8" id="en_post" name="en_post" placeholder="Post"><?php if(!empty($post[0])){ echo $post[0]->en_post;}else{ echo set_value('en_post'); }?>
                                            </textarea> <span class="red"><?php echo form_error('en_post'); ?></span>
                                            <script type="text/javascript">
                                                CKEDITOR.replace('en_post');
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 border-rights">
                                    <div class="form-group">
                                        <label class="col-md-3">Hindi Post * </label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="8" id="hi_post" name="hi_post" placeholder="about_us"><?php if(!empty($post[0])){ echo $post[0]->hi_post;}else{ echo set_value('hi_post'); }?>
                                        </textarea> <span class="red"><?php echo form_error('hi_post'); ?></span>
                                            <script type="text/javascript">
                                                CKEDITOR.replace('hi_post');
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Status</label>
                                    <div class="col-lg-6">
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="1" <?php if(!empty($post[0]) && $post[0]->is_active==1){ echo 'checked';}?>>Active
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="0" <?php if(!empty($post[0]) && $post[0]->is_active==0){ echo 'checked';}?>>Inactive
                                        </label>
                                    </div>
                                </div>
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
            "en_post": "required",
            "hi_post": "required",
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});

</script>
