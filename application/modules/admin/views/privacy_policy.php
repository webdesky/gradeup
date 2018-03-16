<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Privacy Policy</h1>
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
                <div class="panel-heading"><a class="btn btn-primary" href="<?php echo base_url('admin/message_list')?>"><i class="fa fa-th-list">&nbsp;Privacy Policy</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('admin/privacy') ?>" class="registration_form1" enctype="multipart/form-data">

                             <div class="col-md-6 border-shadowss">
                                <div class="en_div">English</div>
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="col-md-3"> Privacy Policy* </label>
                                        <div class="col-md-9">
                                            <input type="hidden" name="id" value="<?php echo $privacy[0]['id']; ?>">
                                            <textarea class="form-control" rows="8" id="en_privacy_policy" name="en_privacy_policy" placeholder="about us"><?php echo  $privacy[0]['en_privacy_policy']?>
                                            </textarea> <span class="red"><?php echo form_error('en_privacy_policy'); ?></span>
                                            <script type="text/javascript">
                                                CKEDITOR.replace('en_privacy_policy');
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="col-md-6 border-shadowss">
                                <div class="en_div">Hindi</div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-3"> Privacy Policy * </label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="8" id="hi_privacy_policy" name="hi_privacy_policy" placeholder="about_us"><?php echo  $privacy[0]['hi_privacy_policy']?>
                                            </textarea> <span class="red"><?php echo form_error('hi_privacy_policy'); ?></span>
                                            <script type="text/javascript">
                                                CKEDITOR.replace('hi_privacy_policy');
                                            </script>
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
$(document).ready(function() {
    $('select').niceSelect();
    $(".registration_form1").validate({
        rules: {
            "en_privacy_policy": "required",
            "hi_privacy_policy": "required",
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});

</script>
