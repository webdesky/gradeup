<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Training</h1>
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
                <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo base_url('admin/notices_list')?>"><i class="fa fa-th-list">&nbsp;Training List</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('admin/training/'.$training[0]->id) ?>" class="registration_form1" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <div class="form-group"> <label class="col-md-3 ">Module Name * </label>
                                    <div class="col-md-9"> <select class="form-control callbacks" name="module_id[]" multiple='multiple'>
                                            <option data-display="--Select Modules--">--Select Modules--</option>
                                           <?php $m=explode(",",$training[0]->module_id);?>
                                           <?php foreach ($modules as $key => $value) { ?>
                                                  <option value="<?php echo $value['id']; ?>" <?php if(in_array($value['id'], $m)){?> selected <?php }?> > <?php echo ucwords($value['en_module_name']); ?></option>
                                            <?php } ?>
                                         </select> <span class="red"><?php echo form_error('fk_module_id'); ?></span> </div>
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group"> <label class="col-md-3 ">Chapter Name * </label>
                                    <div class="col-md-9"> <select class="form-control callback" name="chapter_id[]"   multiple='multiple'>
                                          <?php $m=explode(",",$training[0]->chapter_id);?>
                                           <?php foreach ($chapters as $key => $value) { ?>
                                                  <option value="<?php echo $value['id']; ?>" <?php if(in_array($value['id'], $m)){?> selected <?php }?> > <?php echo ucwords($value['en_chapter_name']); ?></option>
                                            <?php } ?>
                                         </select> <span class="red"><?php echo form_error('en_chapter_name'); ?></span> </div>
                                </div>
                              </div>

                              <div class="clearfix"></div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">English Chapter Name * </label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="en_training_name" id="en_training_name" placeholder="training Name" autocomplete="off" required="required" value="<?php echo $training[0]->en_training_name ?>"> <span class="red"><?php echo form_error('en_training_name'); ?></span> </div>
                                </div>
                                </div>

                                <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3">Hindi Chapter Name * </label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="hi_training_name" id="hi_training_name" placeholder="Training Name hindi" autocomplete="off" required="required" value="<?php echo $training[0]->hi_training_name ?>"> <span class="red"><?php echo form_error('hi_training_name'); ?></span> </div>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Status</label>
                                    <div class="col-lg-6">
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="1" <?php if($training[0]->is_active=="1"){?> checked<?php }?>>Active
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="0" <?php if($training[0]->is_active=="0"){?> checked<?php }?>>Inactive
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12" align="center">
                                    <button type="submit" value="Save" class="btn btn-success">Save</button>
                                    <input type="reset" class="btn btn-default" value="Reset"> </div>
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
$(document).ready(function() {
    //$('select').niceSelect();
    
    $('.callbacks').multiSelect({
      afterSelect: function(values){

        var url = "<?php echo base_url('admin/getChapter') ?>";
        $.ajax({
        url: url,
        type: "POST",
        data: {
            module_id: values
        },
        success: function(data) {
                   
                   var obj = JSON.parse(data);
                    //console.log(obj);
                     if(obj.length != 0){
                    for (var i = 0; i < obj.length; i++) {

                        var h = obj[i].en_chapter_name;
                        $('.callback').multiSelect('addOption', { value: obj[i].id, text: obj[i].en_chapter_name, index: 0 });
                        
                        }
                    }
            
           
        }
     });
       //alert("Select value: "+values);
      },
      afterDeselect: function(values){
        //alert("Deselect value: "+values);
      }
    });

    $('.callback').multiSelect({
      afterSelect: function(values){

       
       //alert("Select value: "+values);
      },
      afterDeselect: function(values){
        //alert("Deselect value: "+values);
      }
    });
});


</script>