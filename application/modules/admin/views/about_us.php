<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">About Us</h1>
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
                <div class="panel-heading"><a class="btn btn-primary" href="<?php echo base_url('admin/message_list')?>"><i class="fa fa-th-list">&nbsp;About Us</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('admin/about') ?>" class="registration_form1" enctype="multipart/form-data">
                            <div class="col-md-6 border-shadowss">
                                <div class="en_div">English</div>
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="col-md-3"> About Us * </label>
                                        <div class="col-md-9">
                                            <input type="hidden" name="id" value="<?php echo $about[0]['id']; ?>">
                                            <textarea class="form-control" rows="8" id="en_about_us" name="en_about_us" placeholder="about us"><?php echo  $about[0]['en_about_us']?>
                                            </textarea> <span class="red"><?php echo form_error('en_about_us'); ?></span>
                                            <script type="text/javascript">
                                                CKEDITOR.replace('en_about_us');
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-6 border-shadowss">
                                <div class="en_div">Hindi</div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-3"> About us * </label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="8" id="hi_about_us" name="hi_about_us" placeholder="about_us"><?php echo  $about[0]['hi_about_us']?>
                                        </textarea> <span class="red"><?php echo form_error('hi_about_us'); ?></span>
                                            <script type="text/javascript">
                                                CKEDITOR.replace('hi_about_us');
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
            "en_about_us": "required",
            "hi_about_us": "required",
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});

</script>
