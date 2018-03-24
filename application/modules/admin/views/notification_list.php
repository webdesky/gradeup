<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <h1 class="page-header">Notification List</h1>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-primary" href="<?php echo base_url('admin/menu')?>"><i class="fa fa-th-list">&nbsp;Add Menu</i></a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="users">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>Sr no.</th>
                                            <th>Notification Title</th>
                                            <th>Notification Description</th>
                                            <th>Notification Url</th>
                                            <th>Created at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($notification)){ ?>
                                        <?php $i=1; foreach($notification as $notification){?>
                                        <tr id="tr_<?php echo $i;?>">
                                            <td>
                                                <?php echo $i; ?> </td>
                                            <td>
                                                <?php echo $notification['title'];?> </td>
                                            <td>
                                                <?php echo $notification['notification_description'];?> </td>
                                            <td>
                                                <?php echo $notification['notification_url'];?> </td>
                                            <td>
                                                <?php echo date('Y-m-d',strtotime($notification['created_at']));?> </td>
                                            <td>
                                                <a href="<?php echo base_url('admin/notification/'.$notification['id'])?>"><span class="glyphicon glyphicon-edit"></span></a> |
                                                <a href="javascript:void(0)" onclick="delete_user('<?php echo $notification['id']?>','<?php echo $i;?>')"><span class="glyphicon glyphicon-trash"></span></a>
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
                table: 'notification'
            },
            type: "POST"
        }).done(function(data) {
            swal("Deleted!", "Record was successfully deleted!", "success");
            $('#tr_' + tr_id).remove();
        });

    });
}

</script>
