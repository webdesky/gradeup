<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">View Testimonial</h1>
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
                <div class="panel-heading"> <a class="btn btn-primary" href="#"><i class="fa fa-th-list">&nbsp;View Testimonial</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="" class="registration_form1" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">User </label>
                                        <div class="col-md-9">
                                            <?php echo strtoupper($testimonials[0]->first_name.' '.$testimonials[0]->last_name);?>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Picture </label>
                                        <div class="col-md-9">
                                            <img src="<?php echo base_url('asset/uploads/'.$testimonials[0]->profile_pic)?>" " height="50px " width="50px ">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix "></div>
                            <div class="col-md-6 ">
                                <div class="form-group ">
                                    <label class="col-md-3 ">Testimonial </label>
                                    <div class="col-md-9 ">
                                        <?php echo $testimonials[0]->testimonial;?>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix "></div>
                            <div class="col-md-6 ">
                                <div class="form-group ">
                                    <label class="col-md-3 ">Status </label>
                                    <div class="col-md-9 ">
                                        <?php if($testimonials[0]->is_active==1){ echo 'Active';}else{echo 'Inactive';}?>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix "></div>
                            <div class="col-md-6 ">
                                <div class="form-group ">
                                    <label class="col-md-3 ">Created Date </label>
                                    <div class="col-md-9 ">
                                        <?php echo date('Y-m-d',strtotime($testimonials[0]->created_at));?>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix "></div>
                            <div class="col-md-12 " align="center ">
                                <input type="button" value="Change Status" class="btn btn-success" onclick="update_status('<?php echo $testimonials[0]->id;?>','<?php echo $testimonials[0]->is_active;?>','<?php if($testimonials[0]->is_active==1){ echo 'Inactivate';}else{echo 'Activate';}?>')">
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

function update_status(id,status,current_status) {
    swal({
        title:"Are you sure?",
        text: "Want to "+current_status+" Status?",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "Yes, Update it!",
        confirmButtonColor: "#ec6c62"
    }, function() {
        $.ajax({
            url: "<?php echo base_url('admin/change_status')?>",
            data: {
                id: id,
                table: 'testimonials',
                status:status
            },
            type: "POST"
        }).done(function(data) {
            swal("Updated!", "Record was successfully Updated!", "success");
        });
        setTimeout(function(){
               window.location.reload();
        }, 1000);

    });
}
                                            
</script>
