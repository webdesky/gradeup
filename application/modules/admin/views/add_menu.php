<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Menu</h1>
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
                <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo base_url('admin/chapterList')?>"><i class="fa fa-th-list">&nbsp;Menu List</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php if(isset($menu)){ echo base_url('admin/menu/'.$menu[0]->id); }else{ echo base_url('admin/menu'); }?>" class="registration_form1" enctype="multipart/form-data">

                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-3">Module Name* </label>
                                            <div class="col-md-9">
                                                <select class="wide" name="module_id">
                                                    <option data-display="--Select Modules--">--Select Modules--</option>
                                                     <?php foreach ($modules as $key => $value) { ?>
                                                          <option value="<?php echo $value->id; ?>" <?php if(isset($menu) && $menu[0]->module_id==$value->id) { ?> selected <?php } ?>><?php echo ucwords($value->en_module_name); ?></option>
                                                    <?php } ?>
                                                 </select>
                                                <span class="red"><?php echo form_error('module_id'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-3">Status* </label>
                                            <div class="col-md-9">
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" value="1" <?php if(isset($menu) && $menu[0]->is_active==1){ echo "checked";} ?>>Active
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" value="0" <?php if(isset($menu) && $menu[0]->is_active==0){ echo "checked";} ?>>Inactive
                                                </label>
                                                <span class="red"><?php echo form_error('status'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-3">Menu Name* </label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="en_menu_name" id="en_menu_name" placeholder="Menu Name in English" autocomplete="off" required="required" value="<?php if(isset($menu)){ echo $menu[0]->en_menu_name; } ?>"> <span class="red"><?php echo form_error('en_menu_name'); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-3">Menu Name* </label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="hi_menu_name" id="hi_menu_name" placeholder="Menu Name in Hindi" autocomplete="off" required="required" value="<?php if(isset($menu)){ echo $menu[0]->hi_menu_name; } ?>"> <span class="red"><?php echo form_error('hi_menu_name'); ?></span>
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
