<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Setting</h1>
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
                <div class="panel-heading"><a class="btn btn-primary" href="#"><i class="fa fa-th-list">&nbsp;Setting</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('admin/setting') ?>" class="registration_forms12" enctype="multipart/form-data">
                                <div class="col-md-6 border-shadowss">
                                    <div class="en_div">English</div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Site Title * </label>
                                            <div class="col-md-10">
                                                <input type="text" id="en_site_title" name="en_site_title" class="form-control" value="<?php echo  $setting[0]['en_site_title']?>">
                                                <span class="red"><?php echo form_error('en_site_title'); ?></span> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Meta Tags * </label>
                                            <div class="col-md-10">
                                                <input type="text" id="en_meta_tags" name="en_meta_tags" class="form-control" value="<?php echo  $setting[0]['en_meta_tags']?>">
                                                <input type="hidden" id="id" name="id" class="form-control" value="<?php echo  $setting[0]['id']?>">
                                                <span class="red"><?php echo form_error('en_meta_tags'); ?></span> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">CopyRight * </label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" rows="5" id="en_copyright" name="en_copyright" placeholder="copyright"><?php echo  $setting[0]['en_copyright']?>
                                                </textarea> <span class="red"><?php echo form_error('en_copyright'); ?></span>
                                                <script type="text/javascript">
                                                    CKEDITOR.replace('en_copyright');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Contact Us * </label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" rows="5" id="en_contact_us" name="en_contact_us" placeholder="contact_us"><?php echo  $setting[0]['en_contact_us']?>
                                                </textarea> <span class="red"><?php echo form_error('en_contact_us'); ?></span>
                                                <script type="text/javascript">
                                                    CKEDITOR.replace('en_contact_us');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Favicon Icon * </label>
                                            <div class="col-md-10">
                                                <input type="file" name="favicon_icon" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 border-shadowss">
                                    <div class="hi_div">Hindi</div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Site Title * </label>
                                            <div class="col-md-10">
                                                <input type="text" id="hi_site_title" name="hi_site_title" class="form-control" value="<?php echo  $setting[0]['hi_site_title']?>">
                                                <span class="red"><?php echo form_error('hi_site_title'); ?></span> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Meta Tags * </label>
                                            <div class="col-md-10">
                                                <input type="text" id="hi_meta_tags" name="hi_meta_tags" class="form-control" value="<?php echo  $setting[0]['hi_meta_tags']?>">
                                                <span class="red"><?php echo form_error('hi_meta_tags'); ?></span> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">CopyRight * </label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" rows="5" id="hi_copyright" name="hi_copyright" placeholder="copyright"><?php echo  $setting[0]['hi_copyright']?>
                                                </textarea> <span class="red"><?php echo form_error('hi_copyright'); ?></span>
                                                <script type="text/javascript">
                                                    CKEDITOR.replace('hi_copyright');
                                                </script>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Contact Us * </label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" rows="5" id="hi_contact_us" name="hi_contact_us" placeholder="contact_us"><?php echo  $setting[0]['hi_contact_us']?>
                                                </textarea> <span class="red"><?php echo form_error('hi_contact_us'); ?></span>
                                                <script type="text/javascript">
                                                    CKEDITOR.replace('hi_contact_us');
                                                </script>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Site Logo * </label>
                                            <div class="col-md-10">
                                                <input type="file" name="site_logo" class="form-control">
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
<script type="text/javascript">
$(document).ready(function(){$("select").niceSelect(),$(".registration_form1").validate({rules:{reciever_id:"required",subject:"required"},submitHandler:function(e){e.submit()}})});
</script>
