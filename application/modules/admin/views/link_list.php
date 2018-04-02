<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
           
            <h1 class="page-header">Link List</h1>
          
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-primary" href="<?php echo base_url('admin/link')?>"><i class="fa fa-th-list">&nbsp;Add Link</i></a>
                     </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="users">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>Sr no.</th>
                                            <th>Category Name</th>
                                            <th>Link Title</th>
                                            <th>Link Url</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($link)){ ?>
                                        <?php $i=1; foreach($link as $value){?>
                                        <tr id="tr_<?php echo $i;?>">
                                            <td>
                                                <?php echo $i; ?> </td>
                                            <td>
                                                <?php echo $value->category_name;?> </td>
                                            <td>
                                                <?php echo $value->title;?> </td>
                                            <td>
                                                <?php echo $value->url;?> </td>
                                            <td>
                                                <?php if($value->is_active==1){ echo 'Active';}else{echo 'Inactive';}?> </td>
                                            <td>
                                                <?php echo date('Y-m-d',strtotime($value->created_at));?> </td>
                                            <td>
                                                <a href="<?php echo base_url('admin/link/'.$value->id)?>"><span class="glyphicon glyphicon-edit"></span></a> |
                                                <a href="javascript:void(0)" onclick="delete_user('<?php echo $value->id?>','<?php echo $i;?>')"><span class="glyphicon glyphicon-trash"></span></a>
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
                table: 'featured_links'
            },
            type: "POST"
        }).done(function(data) {
            swal("Deleted!", "Record was successfully deleted!", "success");
            $('#tr_'+tr_id).remove();
        });

    });
}
</script>