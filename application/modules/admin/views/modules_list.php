<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
           
            <h1 class="page-header">Module List</h1>
          
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-primary" href="<?php echo base_url('admin/module')?>"><i class="fa fa-th-list">&nbsp;Add Module</i></a>
                     </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="users">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>Sr no.</th>
                                            <th>English Module Name</th>
                                            <th>Hindi Module Name</th>
                                            <th>Created at</th>
                                            <th>Action</th>
                                            
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($modules)){ ?>
                                        <?php $i=1; foreach($modules as $module){?>
                                        <tr>
                                            <td id="tr_<?php echo $i;?>">
                                                <?php echo $i; ?> </td>
                                            <td>
                                                <?php echo $module->en_module_name;?> </td>
                                            <td>
                                                <?php echo $module->hi_module_name;?> </td>
                                            <td>
                                                <?php echo $module->created_at;?> </td>
                                            <td>
                                                <a href="<?php echo base_url('admin/edit_module/'.$module->id)?>"><span class="glyphicon glyphicon-edit"></span></a> |
                                                <a href="javascript:void(0)" onclick="delete_user('<?php echo $module->id?>','<?php echo $i;?>')"><span class="glyphicon glyphicon-trash"></span></a>
                                               </td>
                                                 </tr>
                                        <?php $i++;}}?> </tbody>
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
                table: 'modules'
            },
            type: "POST"
        }).done(function(data) {
            swal("Deleted!", "Record was successfully deleted!", "success");
            $('#tr_' + tr_id).remove();
        });

    });
}
</script>