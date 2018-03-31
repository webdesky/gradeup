<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add News</h1>
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
                <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo base_url('admin/chapterList')?>"><i class="fa fa-th-list">&nbsp;Menu List</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php if(isset($news)){ echo base_url('admin/news/'.$news[0]->id); }else{ echo base_url('admin/news'); }?>" class="registration_form1" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">News Title * </label>
                                        <div class="col-md-9">
                                             <input class="form-control" type="text" name="title" id="title" placeholder="News Title" autocomplete="off" required="required" value="<?php if(isset($news)){ echo $news[0]->title; } ?>"> <span class="red"><?php echo form_error('title'); ?></span>
                                           
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">News Category * </label>
                                        <div class="col-md-9">
                                             <input class="form-control" type="text" name="category" id="category" placeholder="News Category Ex. Sports,Politics" autocomplete="off" required="required" value="<?php if(isset($news)){ echo $news[0]->category; } ?>"> <span class="red"><?php echo form_error('category'); ?></span>
                                           
                                        </div>
                                    </div>
                                </div>

                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">News Url* </label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="news_url" id="news_url" placeholder="News Url" autocomplete="off"  value="<?php if(isset($news)){ echo $news[0]->news_url; } ?>"> <span class="red"><?php echo form_error('news_url'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                              <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">News Description* </label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="8" id="news_description" name="news_description" placeholder="Meta Description">
                                                <?php if(isset($news)){ echo $news[0]->news_description; } ?>
                                            </textarea> <span class="red"><?php echo form_error('news_description'); ?></span>
                                            <script type="text/javascript">
                                            CKEDITOR.replace('news_description');
                                            </script>
                                        </div>
                                    </div>
                                </div>
                             

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Url* </label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="url" id="url" placeholder="url" autocomplete="off"  value="<?php if(isset($news)){ echo $news[0]->url; } ?>"> <span class="red"><?php echo form_error('url'); ?></span>
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3">Meta Title* </label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="meta_title" id="meta_title" placeholder="Meta Title" autocomplete="off"  value="<?php if(isset($news)){ echo $news[0]->meta_title; } ?>"> <span class="red"><?php echo form_error('meta_title'); ?></span>
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label class="col-md-3">Meta Description</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="8" id="meta_description" name="meta_description" placeholder="Meta Description">
                                                <?php if(isset($news)){ echo $news[0]->meta_description; } ?>
                                            </textarea> <span class="red"><?php echo form_error('meta_description'); ?></span>
                                            <script type="text/javascript">
                                            CKEDITOR.replace('meta_description');
                                            </script>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label class="col-md-3">Meta Keyword</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="8" id="meta_keyword" name="meta_keyword" placeholder="Meta Description">
                                               <?php if(isset($news)){ echo $news[0]->meta_keyword; } ?>
                                            </textarea> <span class="red"><?php echo form_error('meta_keyword'); ?></span>
                                            <script type="text/javascript">
                                            CKEDITOR.replace('meta_keyword');
                                            </script>
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label class="col-md-3">News Image</label>
                                        <div class="col-md-9">
                                            
                                            <input type="file" name="news_image" id="news_image" class="form-control">
                                            <span class="red"><?php echo form_error('news_image'); ?></span>
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label class="col-md-3">Category Image</label>
                                        <div class="col-md-9">
                                            
                                            <input type="file" name="category_image" id="category_image" class="form-control">
                                            <span class="red"><?php echo form_error('category_image'); ?></span>
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label class="col-md-3">Banner Image</label>
                                        <div class="col-md-9">
                                            
                                            <input type="file" name="banner_image" id="banner_image" class="form-control">
                                            <span class="red"><?php echo form_error('banner_image'); ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                       
                                            <div class="form-group">
                                                <label class="col-md-3">Status* </label>
                                                <div class="col-md-9">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="status" value="1" <?php if(isset($news) && $news[0]->is_active==1){ echo "checked";} ?>>Active
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="status" value="0" <?php if(isset($news) && $news[0]->is_active==0){ echo "checked";} ?>>Inactive
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
});
</script>