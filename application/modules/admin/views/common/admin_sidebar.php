<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            <a class="navbar-brand" href="<?php echo base_url()?>">Online Test</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right ">

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                <ul class="dropdown-menu dropdown-user">
                    <li style="font-size: 16px"><a href="<?php echo base_url('admin/profile')?>">
                        <i class="fa fa-user fa-fw"></i> Update Profile</a>
                    </li>
                    <li style="font-size: 16px"><a href="<?php echo base_url('admin/change_password')?>">
                        <i class="fa fa-gear fa-fw"></i> Change Password</a>
                    </li>
                    <li class="divider"></li>
                    <li style="font-size: 16px"><a href="<?php echo base_url('admin/logout')?>">
                        <i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <?php 
            $user_role  =   $this->session->userdata('user_role'); 
            if($user_role==4){
                $rights     =   explode(',',trim($this->session->userdata('rights')->rights,'"'));   
                $right0     =   str_split($rights[0]);
                $right1     =   str_split($rights[1]);
                $right2     =   str_split($rights[2]);
                $right3     =   str_split($rights[3]);
                $right4     =   str_split($rights[4]);
                $right5     =   str_split($rights[5]);
            }
        ?>


        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav sidebar-menu" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="<?php echo base_url('admin/index')?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('admin/setting')?>"><i class="fa fa-wrench fa-fw"></i> Settings</a>
                    </li>

                    <li> <a href="#"><i class="fa fa-book" aria-hidden="true"></i> Pages<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">

                            <li>
                                <a href="<?php echo base_url('admin/about')?>">About Us</a>
                            </li>

                            <li>
                                <a href="<?php echo base_url('admin/privacy')?>">Privacy Policy</a>
                            </li>

                            <li>
                                <a href="<?php echo base_url('admin/terms')?>">Terms And Conditions</a>
                            </li>

                        </ul>
                    </li>

                    <li> <a href="#"><i class="fa fa-hospital-o" aria-hidden="true"></i> Module Master<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">

                            <li>
                                <a href="<?php echo base_url('admin/module')?>"><i class="fa fa-dashboard fa-fw"></i>Add Module</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/moduleList')?>">Module List</a>
                            </li>

                        </ul>
                    </li>

                    <li> <a href="#"><i class="fa fa-hospital-o" aria-hidden="true"></i> Chapter Master<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">

                            <li>
                                <a href="<?php echo base_url('admin/chapter')?>"><i class="fa fa-dashboard fa-fw"></i>Add Chapter</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/chapterList')?>">Chapter List</a>
                            </li>



                        </ul>
                    </li>

                    <li> <a href="#"><i class="fa fa-hospital-o" aria-hidden="true"></i> Training Master<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">

                            <li>
                                <a href="<?php echo base_url('admin/training')?>"><i class="fa fa-dashboard fa-fw"></i>Add Training</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/trainingList')?>">Training List</a>
                            </li>



                        </ul>
                    </li>

                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>