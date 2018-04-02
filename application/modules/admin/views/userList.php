<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">User List</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php 
                        $user_role  =   $this->session->userdata('user_role'); 
                        if($user_role==4){
                            $rights     =   explode(',',trim($this->session->userdata('rights')->rights,'"'));   
                            $right0     =   str_split($rights[0]);
                        }
                    ?>
                    <a class="btn btn-primary" href="<?php echo base_url('admin/register/')?>"><i class="fa fa-th-list">&nbsp;Add User</i></a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="users">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>Sr no.</th>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Gender</th>
                                            <th>Status</th>
                                            <?php if($user_role==1 || ($user_role==4 && $right0[1]==1 || $right0[2]==1)){?>
                                            <th>Action</th>
                                            <?php }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; if(!empty($users)){ foreach($users as $users_list){?>
                                        <tr id="tr_<?php echo $i;?>">
                                            <td>
                                                <?php echo $i; ?> </td>
                                            <td>
                                                <?php echo ucfirst($users_list->first_name);?> </td>
                                            <td>
                                                <?php echo ucfirst($users_list->last_name);?> </td>
                                            <td>
                                                <?php echo $users_list->email;?> </td>
                                            <td>
                                                <?php echo $users_list->mobile;?> </td>
                                            <td>
                                                <?php echo $users_list->gender;?> </td>
                                            <td>
                                                <?php if($users_list->is_active==1){ echo 'Active';}else{ echo 'Inactive';}?> </td>

                                            <?php if($user_role==1 || ($user_role==4 && $right0[1]==1 || $right0[2]==1)){?>
                                            <td>
                                                <?php if($users_list->is_active==1){?>
                                                <a href="javascript:void(0)" onclick="update_status('<?php echo $users_list->id?>','<?php echo $users_list->is_active;?>')" title="Change Status">
                                                        <span class="glyphicon glyphicon-refresh"></span>
                                                    </a>
                                                <?php }else{?>
                                                <a href="javascript:void(0)" onclick="update_status('<?php echo $users_list->id?>','<?php echo $users_list->is_active;?>')" title="Change Status">
                                                        <span class="glyphicon glyphicon-refresh"></span>
                                                    </a>
                                                <?php }?> |

                                                <?php if($user_role==1 ||($user_role==4 && $right0[1]==1)){?> <a href="<?php echo base_url('admin/edit_user/'.$users_list->id)?>"><span class="glyphicon glyphicon-edit"></span></a> |

                                                <?php }if($user_role==1 || ($user_role==4 && $right0[2]==1)){?> <a href="javascript:void(0)" onclick="delete_record('<?php echo $users_list->id?>','<?php echo $i;?>','users')"><span class="glyphicon glyphicon-trash"></span></a>
                                                <?php }?> </td>
                                            <?php }?>
                                        </tr>
                                        <?php $i++;}}?> </tbody>
                                    <!-- <i class="fas fa-unlock-alt"></i> -->
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
function update_status(user_id, status) {
    swal({
        title: "Are you sure?", text: "Want to Change Status?", type: "warning", showCancelButton: true, closeOnConfirm: false, confirmButtonText: "Yes,Change it!", confirmButtonColor: "#ec6c62"
    },function(){
        $.ajax({
            url: "<?php echo base_url('admin/change_status')?>", data: {
                id: user_id, table: 'users', status: status
            }
            , type: "POST"
        }).done(function(data) {
            swal("Updated!", "Record was successfully updated!", "success");
        });
        location.reload();
    });
}

</script>
