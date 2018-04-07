<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
           
            <h1 class="page-header">Question List</h1>
          
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-primary" href="<?php echo base_url('admin/question')?>"><i class="fa fa-th-list">&nbsp;Add Question</i></a>
                     </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="users">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>Sr no.</th>
                                            <th>Question</th>
                                            <th>Question Type</th>
                                            <th>Created at</th>
                                            <th>Action</th>
                                         </tr>
                                            
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($question)){ ?>
                                        <?php $i=1; foreach($question as $value){
                                           //echo '<pre>'; print_r($value);die;?>
                                        <tr id="tr_<?php echo $i;?>">
                                            <td>
                                                <?php echo $i; ?> 
                                            </td>
                                            <td><?php echo $value['en_question'];?></td>
                                            <td>
                                                <?php echo $value['question_type'];?> 
                                            </td>
                                           
                                            <td>
                                                <?php echo date('Y-m-d',strtotime($value['created_at']));?> 
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('admin/question/'.$value['id'])?>"><span class="glyphicon glyphicon-edit"></span></a> |
                                                <a href="javascript:void(0)" onclick="delete_record('<?php echo $value['id']?>','<?php echo $i;?>','questions')"><span class="glyphicon glyphicon-trash"></span></a>
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
