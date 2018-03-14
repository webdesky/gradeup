<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Module</h1>
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
                <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo base_url('admin/notices_list')?>"><i class="fa fa-th-list">&nbsp;Module List</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('admin/module/'.$modules[0]->id) ?>" class="registration_form1" enctype="multipart/form-data">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">English Module Name * </label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="en_module_name" id="en_module_name" placeholder="Module Name" autocomplete="off" required="required" value="<?php echo $modules[0]->en_module_name ?>"> <span class="red"><?php echo form_error('en_module_name'); ?></span> </div>
                                </div>
                                </div>

                                <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Hindi Module Name * </label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="hi_module_name" id="hi_module_name" placeholder="Module Name" autocomplete="off" required="required" value="<?php echo $modules[0]->hi_module_name ?>" > <span class="red"><?php echo form_error('hi_module_name'); ?></span> </div>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Status</label>
                                    <div class="col-lg-6">
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="1" <?php if($modules[0]->is_active=="1"){?> checked<?php }?>>Active
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="0" <?php if($modules[0]->is_active=="0"){?> checked<?php }?>>Inactive
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
    $('select').niceSelect();
    $(".registration_form1").validate({
        rules: {
            "module_name": "required",

        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>