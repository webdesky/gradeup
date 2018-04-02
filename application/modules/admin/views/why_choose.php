<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Why Choose Us</h1>
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
                <div class="panel-heading"><a class="btn btn-primary" href="<?php echo base_url('admin/whychooseList/')?>"><i class="fa fa-th-list">&nbsp;Why Choose US List</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php if(!empty($setting[0]->id)){ echo base_url('admin/choose/'.$setting[0]->id);}else{ echo base_url('admin/choose/'); } ?>" class="registration_forms12" enctype="multipart/form-data">
                                <div class="col-md-6 border-shadowss">
                                    <div class="en_div">English</div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Title * </label>
                                            <div class="col-md-10">
                                                <input type="text" id="en_site_title" name="en_site_title" class="form-control" value="<?php if(!empty($setting[0]->en_title)){ echo  $setting[0]->en_title;}else{echo set_value('en_site_title');}?>">
                                                <span class="red"><?php echo form_error('en_site_title'); ?></span> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Content * </label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" rows="5" id="en_content" name="en_content" placeholder="copyright"><?php if(!empty($setting[0]->en_content)){ echo $setting[0]->en_content;}else{echo set_value('en_content');}?>
                                                </textarea> <span class="red"><?php echo form_error('en_content'); ?></span>
                                                <script type="text/javascript">
                                                    CKEDITOR.replace('en_content');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Image * </label>
                                            <div class="col-md-10">
                                                <input type="file" name="image" class="form-control">
                                                <span class="red"><?php echo form_error('favicon_icon'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 border-shadowss">
                                    <div class="hi_div">Hindi</div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Title * </label>
                                            <div class="col-md-10">
                                                <input type="text" id="hi_site_title" name="hi_site_title" class="form-control" value="<?php if(!empty($setting[0]->hi_title)){ echo  $setting[0]->hi_title;}else{echo set_value('hi_site_title');}?>">
                                                <span class="red"><?php echo form_error('hi_site_title'); ?></span> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Content * </label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" rows="5" id="hi_content" name="hi_content" placeholder="copyright"><?php if(!empty($setting[0]->hi_content)){ echo  $setting[0]->hi_content;}else{echo set_value('hi_content');}?>
                                                </textarea> <span class="red"><?php echo form_error('hi_content'); ?></span>
                                                <script type="text/javascript">
                                                    CKEDITOR.replace('hi_content');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3">Status* </label>
                                            <div class="col-md-9">
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" value="1" <?php if(isset($setting) && $setting[0]->is_active==1){ echo "checked";} ?>>Active
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" value="0" <?php if(isset($setting) && $setting[0]->is_active==0){ echo "checked";} ?>>Inactive
                                                </label>
                                                <span class="red"><?php echo form_error('status'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br><br>
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
