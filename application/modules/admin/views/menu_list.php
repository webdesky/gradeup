<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <h1 class="page-header">Menu List</h1>

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
                                            <th>Module Name</th>
                                            <th>English Menu Name</th>
                                            <th>Menu Menu Name</th>
                                            <th>Created at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($menu)){ ?>
                                        <?php $i=1; foreach($menu as $menu){ ?>
                                        <tr id="tr_<?php echo $i;?>">
                                            <td>
                                                <?php echo $i; ?> </td>
                                            <td>
                                                <?php echo $menu->en_module_name;?> </td>
                                            <td>
                                                <?php echo $menu->en_menu_name;?> </td>
                                            <td>
                                                <?php echo $menu->hi_menu_name;?> </td>
                                            <td>
                                                <?php echo date('Y-m-d',strtotime($menu->created_at));?> </td>
                                            <td>
                                                <a href="<?php echo base_url('admin/menu/'.$menu->id)?>"><span class="glyphicon glyphicon-edit"></span></a> |
                                                <a href="javascript:void(0)" onclick="delete_record('<?php echo $menu->id?>','<?php echo $i;?>','menu')"><span class="glyphicon glyphicon-trash"></span></a>
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

