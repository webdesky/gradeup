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
                                                <input type="text" id="en_site_title" name="en_site_title" class="form-control" value="<?php if(!empty($setting[0]['en_site_title'])){ echo  $setting[0]['en_site_title'];}?>">
                                                <span class="red"><?php echo form_error('en_site_title'); ?></span> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Meta Tags * </label>
                                            <div class="col-md-10">
                                                <input type="text" id="en_meta_tags" name="en_meta_tags" class="form-control" value="<?php echo  $setting[0]['en_meta_tags']?>">
                                                <input type="hidden" id="id" name="id" class="form-control" value="<?php if(!empty($setting[0]['id'])) { echo  $setting[0]['id'];}?>">
                                                <span class="red"><?php echo form_error('en_meta_tags'); ?></span> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">CopyRight * </label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" rows="5" id="en_copyright" name="en_copyright" placeholder="copyright"><?php if(!empty($setting[0]['en_copyright'])){ echo  $setting[0]['en_copyright'];}?>
                                                </textarea> <span class="red"><?php echo form_error('en_copyright'); ?></span>
                                                <script type="text/javascript">
                                                    CKEDITOR.replace('en_copyright');
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Site Phone * </label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="contact_us_phone" placeholder="987-654-321" value="<?php if(!empty($setting[0]['contact_us_phone'])){ echo  $setting[0]['contact_us_phone'];}?>">
                                                <span class="red"><?php echo form_error('contact_us_phone'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Address * </label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="en_address" placeholder="Enter Address" value="<?php if(!empty($setting[0]['en_address'])){ echo  $setting[0]['en_address'];}?>">
                                                <span class="red"><?php echo form_error('en_address'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Site Tagline * </label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="en_tagline" placeholder="Enter tagline" value="<?php if(!empty($setting[0]['en_tagline'])){ echo  $setting[0]['en_tagline'];}?>">
                                                <span class="red"><?php echo form_error('en_tagline'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Favicon Icon * </label>
                                            <div class="col-md-10">
                                                <input type="file" name="favicon_icon" class="form-control">
                                                <span class="red"><?php echo form_error('favicon_icon'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Twitter Url * </label>
                                            <div class="col-md-10">
                                                <input type="text" name="tw_url" class="form-control" value="<?php if(!empty($setting[0]['twitter_url'])){ echo  $setting[0]['twitter_url'];}?>">
                                                <span class="red"><?php echo form_error('tw_url'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Insta Url * </label>
                                            <div class="col-md-10">
                                                <input type="text" name="insta_url" class="form-control" value="<?php if(!empty($setting[0]['insta_url'])){ echo  $setting[0]['insta_url'];}?>">
                                                <span class="red"><?php echo form_error('insta_url'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Linkedin Url * </label>
                                            <div class="col-md-10">
                                                <input type="text" name="linkedin_url" class="form-control" value="<?php if(!empty($setting[0]['linkedin_url'])){ echo  $setting[0]['linkedin_url'];}?>">
                                                <span class="red"><?php echo form_error('linkedin_url'); ?></span>
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
                                                <input type="text" id="hi_site_title" name="hi_site_title" class="form-control" value="<?php if(!empty($setting[0]['hi_site_title'])){ echo $setting[0]['hi_site_title'];}?>">
                                                <span class="red"><?php echo form_error('hi_site_title'); ?></span> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Meta Tags * </label>
                                            <div class="col-md-10">
                                                <input type="text" id="hi_meta_tags" name="hi_meta_tags" class="form-control" value="<?php 
                                                if(!empty($setting[0]['hi_meta_tags'])){ echo  $setting[0]['hi_meta_tags'];}?>">
                                                <span class="red"><?php echo form_error('hi_meta_tags'); ?></span> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">CopyRight * </label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" rows="5" id="hi_copyright" name="hi_copyright" placeholder="copyright"><?php if(!empty($setting[0]['hi_copyright'])){ echo  $setting[0]['hi_copyright'];}?>
                                                </textarea> <span class="red"><?php echo form_error('hi_copyright'); ?></span>
                                                <script type="text/javascript">
                                                    CKEDITOR.replace('hi_copyright');
                                                </script>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Address * </label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="hi_address" placeholder="Enter Address" value="<?php if(!empty($setting[0]['hi_address'])){ echo  $setting[0]['hi_address'];}?>">
                                                <span class="red"><?php echo form_error('hi_address'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Site Tagline * </label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="hi_tagline" placeholder="Enter tagline" value="<?php if(!empty($setting[0]['hi_tagline'])){ echo  $setting[0]['hi_tagline'];}?>">
                                                <span class="red"><?php echo form_error('hi_tagline'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Site Email * </label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="contact_us_email" placeholder="contact@gmail.com" value="<?php if(!empty($setting[0]['contact_us_email'])) { echo  $setting[0]['contact_us_email'];}?>">
                                                <span class="red"><?php echo form_error('contact_us_email'); ?></span>
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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Fb Url * </label>
                                            <div class="col-md-10">
                                                <input type="text" name="fb_url" class="form-control" value="<?php if(!empty($setting[0]['fb_url'])) { echo  $setting[0]['fb_url'];}?>">
                                                <span class="red"><?php echo form_error('fb_url'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Google+ Url * </label>
                                            <div class="col-md-10">
                                                <input type="text" name="gplus_url" class="form-control" value="<?php if(!empty($setting[0]['gplus_url'])){ echo  $setting[0]['gplus_url'];}?>">
                                                <span class="red"><?php echo form_error('gplus_url'); ?></span>
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
