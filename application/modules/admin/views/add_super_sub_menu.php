<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Super Sub Menu</h1>
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
                <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo base_url('admin/super_submenuList')?>"><i class="fa fa-th-list">&nbsp;Super Sub Menu List</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                        <?php //echo '<pre>'; print_r($super_sub_menu[0]);?>
                            <form role="form" method="post" action="<?php if(isset($super_sub_menu)){ echo base_url('admin/super_sub_menu/'.$super_sub_menu[0]->super_sub_menu_id); }else{ echo base_url('admin/super_sub_menu'); }?>" class="registration_form1" enctype="multipart/form-data">

                               
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3">Menu Name* </label>
                                            <div class="col-md-9">
                                                <select class="wide" name="menu_id" onchange="get_sub_menu(this.value)">
                                                    <option data-display="--Select Menu--">--Select Menu--</option>
                                                     <?php foreach ($menu as $key => $value) { ?>
                                                          <option value="<?php echo $value->id; ?>" <?php if(isset($super_sub_menu) && $super_sub_menu[0]->menu_id==$value->id) { ?> selected <?php } ?>><?php echo ucwords($value->en_menu_name); ?></option>
                                                    <?php } ?>
                                                 </select>
                                                <span class="red"><?php echo form_error('menu_id'); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3">SubMenu Name* </label>
                                            <div class="col-md-9">
                                                <select class="wide" name="sub_menu_id" id="sub_menu_id">
                                                <?php if(isset($super_sub_menu) && !empty($super_sub_menu[0]->sub_menu_id)){?>
                                                    <option value="<?php echo $super_sub_menu[0]->sub_menu_id?>"><?php echo $super_sub_menu[0]->en_sub_menu_name?></option>
                                                <?php }?>
                                                 </select>
                                                <span class="red"><?php echo form_error('sub_menu_id'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    
                               
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3">Super Sub Menu Name* </label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="en_sub_menu_name" id="en_sub_menu_name" placeholder="Super Sub Menu Name in English" autocomplete="off" required="required" value="<?php if(isset($super_sub_menu)){ echo $super_sub_menu[0]->en_super_sub_menu; } ?>"> <span class="red"><?php echo form_error('en_sub_menu_name'); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3">Super Sub Menu Name* </label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="hi_sub_menu_name" id="hi_sub_menu_name" placeholder="Super Sub Menu Name in Hindi" autocomplete="off" required="required" value="<?php if(isset($super_sub_menu)){ echo $super_sub_menu[0]->hi_super_sub_menu; } ?>"> <span class="red"><?php echo form_error('hi_sub_menu_name'); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Url* </label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="url" id="url" placeholder="url" autocomplete="off" required="required" value="<?php if(isset($super_sub_menu)){ echo $super_sub_menu[0]->url; } ?>"> <span class="red"><?php echo form_error('url'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Meta Title* </label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="meta_title" id="meta_title" placeholder="Meta Title" autocomplete="off" required="required" value="<?php if(isset($super_sub_menu)){ echo $super_sub_menu[0]->meta_title; } ?>"> <span class="red"><?php echo form_error('meta_title'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label class="col-md-3">Meta Description</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="8" id="meta_description" name="meta_description" placeholder="Meta Description">
                                                <?php if(isset($super_sub_menu)){ echo $super_sub_menu[0]->meta_description; } ?>
                                            </textarea> <span class="red"><?php echo form_error('meta_description'); ?></span>
                                            <script type="text/javascript">
                                            CKEDITOR.replace('meta_description');
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label class="col-md-3">Meta Keyword</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="8" id="meta_keyword" name="meta_keyword" placeholder="Meta Description">
                                                <?php if(isset($super_sub_menu)){ echo $super_sub_menu[0]->meta_keyword; } ?>
                                            </textarea> <span class="red"><?php echo form_error('meta_keyword'); ?></span>
                                            <script type="text/javascript">
                                            CKEDITOR.replace('meta_keyword');
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label class="col-md-3">Category Image</label>
                                        <div class="col-md-9">
                                            <input type="file" name="category_image" id="category_image" class="form-control">
                                            <span class="red"><?php echo form_error('category_image'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label class="col-md-3">Banner Image</label>
                                        <div class="col-md-9">
                                            <input type="file" name="banner_image" id="banner_image" class="form-control">
                                            <span class="red"><?php echo form_error('banner_image'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3">Status* </label>
                                            <div class="col-md-9">
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" value="1" <?php if(isset($super_sub_menu) && $super_sub_menu[0]->is_active==1){ echo "checked";} ?>>Active
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" value="0" <?php if(isset($super_sub_menu) && $super_sub_menu[0]->is_active==0){ echo "checked";} ?>>Inactive
                                                </label>
                                                <span class="red"><?php echo form_error('status'); ?></span>
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
</script>
