<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php if(isset($exam) && !empty($exam)){ echo 'Edit Package';}else{ echo 'Add Super Package';}?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <?php if ($info_message = $this->session->flashdata('info_message')): ?>
                <div id="form-messages" class="alert alert-success" role="alert">
                    <?php echo $info_message; ?>
                </div>
                <?php endif ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo base_url('admin/packageList')?>"><i class="fa fa-th-list">&nbsp;Package List</i></a> </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <form role="form" method="post" action="<?php if(isset($super_package)){ echo base_url('admin/super_package/'.$super_package[0]->id); }else{ echo base_url('admin/super_package'); }?>" class="registration_form1" enctype="multipart/form-data">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-3">Super Package Name * </label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" name="super_package_name" id="super_package_name" placeholder="Super Package Name" autocomplete="off" required="required" value="<?php if(isset($super_package)){ echo $super_package[0]->super_package_name ; }else{echo set_value('super_package_name');} ?>"> <span class="red"><?php echo form_error('super_package_name'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-3 ">Package Name * </label>
                                                <div class="col-md-9">
                                                    <select class="form-control" name="package_id[]" id="package_id" multiple="multiple">
                                                        <option data-display="--Select Package--">--Select Chapter--</option>
                                                        <?php foreach($package as $values){?>
                                                            <option value="<?php echo $values['id']?>"  <?php if(!empty($super_package[0]->package_id)){ $chapter_array = explode(',', $super_package[0]->package_id); if(in_array($values['id'], $chapter_array)){ echo 'selected';}}?>>


                                                           <?php echo $values['exam_name']; ?> 
                                                            </option>
                                                            <?php }?>
                                                    </select> <span class="red"><?php echo form_error('package_id'); ?></span> </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                         <div class="form-group"> <label class="col-md-3">Valid Till * </label>
                                           <div class="col-lg-9"> <input type="text" id="valid_till" name="valid_till" class="form-control date" autocomplete="off" readonly="readonly" required="required" value="<?php if(isset($super_package)){ echo $super_package[0]->valid_till; }else{echo set_value('super_package_name');} ?>"> <span class="red"><?php echo form_error('valid_till'); ?></span> </div>
                                        </div>
                                        </div>

                                        
                                       

                                        <div class="clearfix"></div>
                                      
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-3">Status</label>
                                                <div class="col-lg-9">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="status" value="1" <?php if(isset($exam) && $exam[0]->is_active==1){ echo 'checked'; }else{ echo 'checked'; } ?>>Active
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="status" value="0" <?php if(isset($exam) && $exam[0]->is_active==0){ echo 'checked'; } ?>>Inactive
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <br/>
                                        <br/>
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

