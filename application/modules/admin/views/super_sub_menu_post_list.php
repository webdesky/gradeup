<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <h1 class="page-header">Super Sub Menu List</h1>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-primary" href="<?php echo base_url('admin/super_sub_menu_post')?>"><i class="fa fa-th-list">&nbsp;Add Super Sub Menu Post</i></a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="users">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>Sr no.</th>
                                            <th>Menu Name</th>
                                            <th>Sub Menu Name</th>
                                            <th>Super Sub Menu Name</th>
                                            <th>English Post</th>
                                            <th>Hindi Post</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($super_sub_menu_post)){ ?>
                                        <?php $i=1; foreach($super_sub_menu_post as $sub_menu){ ?>
                                        <tr id="tr_<?php echo $i;?>">
                                            <td>
                                                <?php echo $i; ?> </td>
                                            <td>
                                                <?php echo $sub_menu->en_menu_name;?> </td>
                                            <td>
                                                <?php echo $sub_menu->sub_menu_name;?> </td>
                                            <td>
                                                <?php echo $sub_menu->super_sub_menu_name;?> </td>
                                             <td>
                                                <?php echo $sub_menu->en_post;?> </td>
                                            <td>
                                                <?php echo $sub_menu->hi_post;?> </td>
                                            <td>
                                                <?php if($sub_menu->is_active==1){ echo 'Active';}else{ echo 'Inactive';}?> </td>
                                            <td>
                                                <?php echo date('Y-m-d',strtotime($sub_menu->created_at));?> </td>
                                            <td>
                                                <a href="<?php echo base_url('admin/super_sub_menu_post/'.$sub_menu->super_sub_menu_post_id)?>"><span class="glyphicon glyphicon-edit"></span></a> |
                                                <a href="javascript:void(0)" onclick="delete_user('<?php echo $sub_menu->super_sub_menu_post_id?>','<?php echo $i;?>')"><span class="glyphicon glyphicon-trash"></span></a>
                                            </td>
                                        </tr>
                                        <?php $i++;}}?>
                                    </tbody>
                                </table>
                            </div>
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
$('#users').DataTable({
    responsive: true,
});

function delete_user(id, tr_id) {
    swal({
        title: "Are you sure?",
        text: "want to delete?",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "Yes, Delete it!",
        confirmButtonColor: "#ec6c62"
    }, function() {
        $.ajax({
            url: "<?php echo base_url('admin/delete')?>",
            data: {
                id: id,
                table: 'super_sub_menu_post'
            },
            type: "POST"
        }).done(function(data) {
            swal("Deleted!", "Record was successfully deleted!", "success");
            $('#tr_'+tr_id).remove();
        });

    });
}

</script>
