<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <h1 class="page-header">Package List</h1>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">

                    <a class="btn btn-primary" href="<?php echo base_url('admin/package')?>"><i class="fa fa-th-list">&nbsp;Add package</i></a>

                     </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="users">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>Sr no.</th>
                                            <th>Package Name</th>
                                            <th>Time per Question</th>
                                            <th>Passing Marks</th>
                                            <th>Positive Mark</th>
                                            <th>Negative Mark</th>
                                            <th>Created at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($exam)){?>
                                        <?php $i=1; foreach($exam as $value){?>
                                        <tr id="tr_<?php echo $i;?>">
                                            <td>
                                                <?php echo $i; ?> </td>
                                            <td>
                                                <?php echo $value->package_name;?> </td>
                                            
                                            <td>
                                                <?php echo $value->time_per_question;?> </td>
                                            <td>
                                                <?php echo $value->passing_marks;?> </td>
                                            <td>
                                                <?php echo $value->positive_mark;?> </td>
                                            <td>
                                                <?php echo $value->negative_mark;?> </td>
                                            <td>
                                                <?php echo date('Y-m-d',strtotime($value->created_at));?> </td>
                                            <td>
                                                <!-- <a href="<?php echo base_url('admin/view_package/'.$value->id)?>"><span class="glyphicon glyphicon-eye-open"></span></a> |
                                                <a href="<?php echo base_url('admin/package/'.$value->id)?>"><span class="glyphicon glyphicon-edit"></span></a> | -->
                                                <a href="javascript:void(0)" onclick="delete_record('<?php echo $value->id;?>','<?php echo $i;?>','package')"><span class="glyphicon glyphicon-trash"></span></a>
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
