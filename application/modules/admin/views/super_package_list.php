<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Super Package List</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-lg-12">
            <?php if ($info_message = $this->session->flashdata('info_message')): ?>
            <div id="form-messages" class="alert alert-success" role="alert">
                <?php echo $info_message; ?>
            </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                   <div class="panel-heading"><a class="btn btn-primary" href="<?php echo base_url('admin/super_package')?>"><i class="fa fa-th-list">&nbsp;Add Super Package </i></a></div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="notice">
                            <thead>
                                <tr class="bg-primary">
                                    <th>Sr. no</th>
                                    <th>Super Package Name</th>
                                    <th>valid Till</th>
                                    <th>Date</th>
                                   <!--  <th>Status</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count=1; if(!empty($super_package)) { foreach ($super_package as $key => $value) {
                            ?>
                                <tr class="odd gradeX" id="tr_<?php echo $count;?>">
                                    <td>
                                        <?php echo $count; ?>
                                    </td>
                                    <td class="center">
                                        <?php if(!empty($value['super_package_name'])){ echo ucwords($value['super_package_name']);}  ?>
                                    </td>
                                    <td class="center">
                                        <?php if(!empty($value['valid_till'])){ echo ucwords($value['valid_till']);} ?>
                                    </td>
                                    
                                    <td class="center">
                                        <?php echo $value['created_at'];  ?>
                                    </td>
                                   <!--  <td>
                                        <?php if($value['is_active']==0){?>
                                        <button class="btn btn-danger" onclick="updateStatus('<?php echo $value['id'] ?>','<?php echo $value['is_active'] ?>')">Pending</button>
                                        <?php }else{ ?>
                                        <button class="btn btn-success" onclick="updateStatus('<?php echo $value['id'] ?>','<?php echo $value['is_active'] ?>')">Approved</button>
                                        <?php } ?>
                                    </td> -->
                                    <td>
                                    <a href="<?php echo base_url('admin/super_package/'.$value['id'])?>"><span class="glyphicon glyphicon-edit"></span></a> |
                                        <a href="javascript:void(0)" onclick="delete_record('<?php echo $value['id']?>','<?php echo $count;?>','super_package')"><span class="glyphicon glyphicon-trash"></span></a>
                                        </td>
                                </tr>
                                <?php $count++; }}?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<script type="text/javascript">
$('#notice').DataTable({
    responsive: true
});

function updateStatus(id, active) {
    if (active == 0) {
        data = 1;
    } else {
        data = 0;
    }
    swal({
        title: "Are you sure?",
        text: "You want to Change Status?",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "Yes, Change it!",
        confirmButtonColor: "#ec6c62"
    }, function() {
        $.ajax({
            url: "<?php echo base_url('admin/update_review')?>",
            data: {
                id: id,
                active: data,
            },
            type: "POST"
        }).done(function(data) {
            swal("Changed!", "Status was successfully changed!", "success");
            window.location.reload();
        });
    });
}
</script>