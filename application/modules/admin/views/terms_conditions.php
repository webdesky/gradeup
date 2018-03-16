<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Terms And Conditions</h1>
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
                <div class="panel-heading"><a class="btn btn-primary" href="#"><i class="fa fa-th-list">&nbsp;Terms And Conditions</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('admin/terms') ?>" class="registration_form1" enctype="multipart/form-data">

                              <div class="col-md-6 border-shadowss">
                                <div class="en_div">English</div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-3"> T&C* </label>
                                        <div class="col-md-9">
                                            <input type="hidden" name="id" value="<?php echo $terms[0]['id']; ?>">
                                            <textarea class="form-control" rows="8" id="en_terms" name="en_terms" placeholder="about us"><?php echo  $terms[0]['en_terms']?>
                                            </textarea> <span class="red"><?php echo form_error('en_terms'); ?></span>
                                            <script type="text/javascript">
                                                CKEDITOR.replace('en_terms');
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-6 border-shadowss">
                                <div class="en_div">Hindi</div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-3"> T&C * </label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="8" id="hi_terms" name="hi_terms" placeholder="about_us"><?php echo  $terms[0]['hi_terms']?>
                                            </textarea> <span class="red"><?php echo form_error('hi_terms'); ?></span>
                                            <script type="text/javascript">
                                                CKEDITOR.replace('hi_terms');
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
            "en_terms": "required",
            "hi_terms": "required",
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});

</script>
