<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update Profile</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('admin/profile') ?>" class="registration_form1" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-md-2">First Name * </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" value="<?php echo $users[0]->first_name;?>"> <span class="red"><?php echo form_error('first_name'); ?></span></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Last Name * </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value="<?php echo $users[0]->last_name;?>"> <span class="red"><?php echo form_error('last_name'); ?></span> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Email * </label>
                                    <div class="col-lg-6">
                                        <inp ut type="text" class="form-control" name="email" placeholder="Enter Email" value="<?php echo $users[0]->email;?>"> <span class="red"><?php echo form_error('email'); ?></span> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Date of Birth : </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control date" name="date_of_birth" id="date_of_birth" value="<?php echo $users[0]->date_of_birth;?>"> <span class="red"><?php echo form_error('date_of_birth'); ?></span>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-2">Gender : </label>
                                    <div class="col-lg-6">
                                        <label class="radio-inline">
                                            <input type="radio" name="gender" value="male" <?php if($users[0]->gender=="male"){ echo 'checked';}?>>Male</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="gender" value="female" <?php if($users[0]->gender=="female"){ echo 'checked';}?>>Female</label> <span class="red"><?php echo form_error('gender'); ?></span> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Mobile : </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="mobile" placeholder="Enter Mobile" value="<?php echo $users[0]->mobile;?>"> <span class="red"><?php echo form_error('mobile'); ?></span> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Phone no : </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" value="<?php echo $users[0]->phone_no;?>"> <span class="red"><?php echo form_error('phone'); ?></span> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Address : </label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control" name="address" placeholder="Enter Address"><?php echo $users[0]->address;?></textarea>
                                        <span class="red"><?php echo form_error('address'); ?></span> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Profile Pic : </label>
                                    <div class="col-lg-6">
                                        <input type="file" name="image" class="form-control"> <span class="red"><?php echo form_error('address'); ?></span> </div>
                                </div>
                                <div class="col-md-12" align="center">
                                    <input type="submit" name="submit" value="Save" class="btn btn-success">
                                    <button type="reset" class="btn btn-default">Reset</button>
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
