<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Mail List</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-lg-12">
            <?php if ($info_message = $this->session->flashdata('info_message')): ?>
            <div id="form-messages" class="alert alert-success" role="alert">
                <?php echo $info_message; ?> </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo base_url('admin/send_mail')?>"><i class="fa fa-th-list">&nbsp;Send Mail </i></a></div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="dataTables">
                            <thead>
                                <tr class="bg-primary">
                                    <th>Sr.No</th>
                                    <th>Reciever</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $count=1;
                                if($mail_list){
                                foreach ($mail_list as  $message) { ?>
                                <tr class="odd gradeX" id="tr_<?php echo $count;?>">
                                    <td>
                                        <?php echo $count; ?> </td>
                                    <td>
                                        <?php echo $message->first_name.' '.$message->last_name; ?> </td>
                                    <td class="center">
                                        <?php echo $message->subject; ?> </td>
                                    <td class="center">
                                        <?php echo $message->message; ?> </td>
                                    <td class="center"><a href="javascript:void(0)" onclick="delete_record('<?php echo $message->id?>','<?php echo $count; ?>','mail')"><i class="fa fa-trash-o" aria-hidden="true"></i></a> </td>
                                </tr>
                                <?php $count++; } }?> </tbody>
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
