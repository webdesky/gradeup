<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Event</h1>
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
                <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo base_url('admin/eventList')?>"><i class="fa fa-th-list">&nbsp;Event List</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php if(isset($event)){ echo base_url('admin/event/'.$event[0]->id); }else{ echo base_url('admin/event'); }?>" class="registration_form1" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Event Title * </label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="title" id="title" placeholder="Event Title" autocomplete="off" required="required" value="<?php if(isset($event)){ echo $event[0]->title; }else{echo set_value('title');} ?>"> <span class="red"><?php echo form_error('title'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Event Date* </label>
                                        <div class="col-md-9">
                                            <input type="text" name="event_date" id="event_date" class="form-control date" autocomplete="off" readonly="readonly" placeholder="Event Date" value="<?php if(isset($event)){ echo $event[0]->event_date; }else{echo set_value('event_date');} ?>" style="width: 50%;float: left;">
                                            <span><?php echo form_error('event_date'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Event Start* </label>
                                        <div class="col-md-9">
                                            <input type="text" id="start_time" name="start_time" class="form-control" autocomplete="off" readonly="readonly" placeholder="Start Time" style="width: 50%;" value="<?php if(isset($event)){ echo $event[0]->start_time; }else{echo set_value('start_time');} ?>" >
                                            <span><?php echo form_error('start_time'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Event End* </label>
                                        <div class="col-md-9">
                                            <input type="text" id="end_time" name="end_time" class="form-control" autocomplete="off" readonly="readonly" placeholder="End Time" style="width: 50%;"  value="<?php if(isset($event)){ echo $event[0]->end_time; }else{echo set_value('end_time');} ?>" >
                                            <span><?php echo form_error('end_time'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label class="col-md-3">Event Description</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="8" id="description" name="description" placeholder="Event Description">
                                                <?php if(isset($event)){ echo $event[0]->description; }else{echo set_value('description');} ?>
                                            </textarea> <span class="red"><?php echo form_error('description'); ?></span>
                                            <script type="text/javascript">
                                            CKEDITOR.replace('description');
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label class="col-md-3">Event Address</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="8" id="address" name="address" placeholder="Event Address">
                                                <?php if(isset($event)){ echo $event[0]->address; }else{echo set_value('address');} ?>
                                            </textarea> <span class="red"><?php echo form_error('address'); ?></span>
                                            <script type="text/javascript">
                                            CKEDITOR.replace('address');
                                            </script>
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label class="col-md-3">Event Image</label>
                                        <div class="col-md-9">
                                            
                                            <input type="file" name="event_image" id="event_image" class="form-control">
                                            <span class="red"><?php echo form_error('event_image'); ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Status* </label>
                                        <div class="col-md-9">
                                            <label class="radio-inline">
                                                <input type="radio" name="status" value="1" <?php if(isset($event) && $event[0]->is_active==1){ echo "checked";} ?>>Active
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="status" value="0" <?php if(isset($event) && $event[0]->is_active==0){ echo "checked";} ?>>Inactive
                                            </label>
                                            <span class="red"><?php echo form_error('status'); ?></span>
                                        </div>
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
    $('select').niceSelect();
    $(".registration_form1").validate({
        rules: {
            "module_name": "required",

        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    $('#start_time').timepicker();
    $('#end_time').timepicker();


});
</script>