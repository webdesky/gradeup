<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Super Sub Menu Post</h1>
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
                <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo base_url('admin/super_submenupostList')?>"><i class="fa fa-th-list">&nbsp;Super Sub Menu Post List</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php if(isset($super_sub_menu_post)){ echo base_url('admin/super_sub_menu_post/'.$super_sub_menu_post[0]->super_sub_menu_post_id); }else{ echo base_url('admin/super_sub_menu_post'); }?>" class="registration_form1" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-3">Menu Name* </label>
                                            <div class="col-md-9">
                                                <select class="wide" name="menu_id" onchange="get_sub_menu(this.value)">
                                                    <option data-display="--Select Menu--">--Select Menu--</option>
                                                    <?php foreach ($menu as $key => $value) { ?>
                                                    <option value="<?php echo $value->id; ?>" <?php if(isset($super_sub_menu_post) && $super_sub_menu_post[0]->menu_id==$value->id) { echo 'selected'; } ?>>
                                                        <?php echo ucwords($value->en_menu_name); ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                                <span class="red"><?php echo form_error('menu_id'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-3">SubMenu Name* </label>
                                            <div class="col-md-9">
                                                <select class="wide" name="sub_menu_id" id="sub_menu_id" onchange="get_super__sub_menu(this.value)">
                                                    <?php if(isset($super_sub_menu_post) && !empty($super_sub_menu_post[0]->sub_menu_id)){?>
                                                    <option value="<?php echo $super_sub_menu_post[0]->sub_menu_id?>">
                                                        <?php echo $super_sub_menu_post[0]->sub_menu_name?>
                                                    </option>
                                                    <?php }?>
                                                </select>
                                                <span class="red"><?php echo form_error('sub_menu_id'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-3">Super SubMenu Name* </label>
                                            <div class="col-md-9">
                                                <select class="wide" name="super_sub_menu_id" id="super_sub_menu_id">
                                                    <?php if(isset($super_sub_menu_post) && !empty($super_sub_menu_post[0]->sub_menu_id)){?>
                                                    <option value="<?php echo $super_sub_menu_post[0]->super_sub_menu_id?>">
                                                        <?php echo $super_sub_menu_post[0]->en_super_sub_menu?>
                                                    </option>
                                                    <?php }?>
                                                </select>
                                                <span class="red"><?php echo form_error('super_sub_menu_id'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-3">Status* </label>
                                            <div class="col-md-9">
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" value="1" <?php if(isset($super_sub_menu_post) && $super_sub_menu_post[0]->is_active==1){ echo "checked";} ?>>Active
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" value="0" <?php if(isset($super_sub_menu_post) && $super_sub_menu_post[0]->is_active==0){ echo "checked";} ?>>Inactive
                                                </label>
                                                <span class="red"><?php echo form_error('status'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-6 border-shadowss">
                                    <div class="en_div">English</div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-3">Super Sub Menu Post* </label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="en_post" name="en_post" placeholder="about us">
                                                    <?php if(isset($super_sub_menu_post) && !empty($super_sub_menu_post[0]->en_post)){ echo $super_sub_menu_post[0]->en_post; }?>
                                            </textarea> <span class="red"><?php echo form_error('en_post'); ?></span>
                                                <script type="text/javascript">
                                                    CKEDITOR.replace('en_post');

                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 border-shadowss">
                                    <div class="en_div">Hindi</div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-3">Super Sub Menu post* </label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="8" id="hi_post" name="hi_post" placeholder="about us">
                                                    <?php if(isset($super_sub_menu_post) && !empty($super_sub_menu_post[0]->hi_post)){ echo $super_sub_menu_post[0]->hi_post; }?>
                                            </textarea> <span class="red"><?php echo form_error('hi_post'); ?></span>
                                                <script type="text/javascript">
                                                    CKEDITOR.replace('hi_post');

                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <br/><br/>
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

function get_sub_menu(str) {
    $.ajax({
        type: "GET",
        url: "<?php echo base_url('admin/get_record')?>",
        data: {
            id: str,
            table: 'sub_menu',
            field: 'menu_id',
            select: 'id, en_sub_menu_name',
        },
        success: function(result) {
            data = JSON.parse(result);
            var option = '<option data-display="--Select Sub Menu--">--Select Sub Menu--</option>';
            for (var i = 0; i < data.length; i++) {
                option += '<option value="' + data[i].id + '">' + data[i].en_sub_menu_name + '</option>';
            }
            $('#sub_menu_id').html(option);
            $('#sub_menu_id').niceSelect('update');
        }
    });
}

function get_super__sub_menu(str) {
    $.ajax({
        type: "GET",
        url: "<?php echo base_url('admin/get_record')?>",
        data: {
            id: str,
            table: 'super_sub_menu',
            field: 'sub_menu_id',
            select: 'id, en_super_sub_menu',
        },
        success: function(result) {
            data = JSON.parse(result);
            var option = '<option data-display="--Select Sub Menu--">--Select Sub Menu--</option>';
            for (var i = 0; i < data.length; i++) {
                option += '<option value="' + data[i].id + '">' + data[i].en_super_sub_menu + '</option>';
            }
            $('#super_sub_menu_id').html(option);
            $('#super_sub_menu_id').niceSelect('update');
        }
    });
}

</script>
