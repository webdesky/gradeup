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
            <a class="navbar-brand" href="<?php echo base_url('admin/admin')?>">Online Test</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right ">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li style="font-size: 17px">
                        <a href="<?php echo base_url('admin/profile');?>">
                            <i class="fa fa-user fa-fw"></i> Update Profile</a>
                    </li>
                    <li style="font-size: 17px">
                        <a href="<?php echo base_url('admin/change_password');?>">
                            <i class="fa fa-gear fa-fw"></i> Change Password</a>
                    </li>
                    <li class="divider"></li>
                    <li style="font-size: 17px">
                        <a href="<?php echo base_url('admin/logout');?>">
                            <i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <?php 
            $user_role      =   $this->session->userdata('user_role');
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
                        </li>
                        <li>
                            <a href="<?php echo base_url('admin');?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li><a href="#"><i class="fa fa-file-powerpoint-o" aria-hidden="true"></i> Post Master<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('admin/post');?>">Add Post</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/postList');?>">Post List</a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#"><i class="fa fa-user"></i> User Master<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('admin/register');?>">Add User</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/userList');?>">User List</a>
                                </li>
                            </ul>
                        </li>
                       
                        <li> <a href="#"><i class="fa fa-database" aria-hidden="true"></i>  Module Master<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('admin/module');?>">Add Module</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/moduleList');?>">Module List</a>
                                </li>
                            </ul>
                        </li>
                        <li> <a href="#"><i class="fa fa-file-text" aria-hidden="true"></i>  Chapter Master<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('admin/chapter')?>">Add Chapter</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/chapterList')?>">Chapter List</a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#"><i class="fa fa-question-circle" aria-hidden="true"></i> Question Master<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('admin/question')?>">Add Question</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/questionList')?>">Question List</a>
                                </li>
                            </ul>
                        </li>
                        <li> <a href="#"><i class="fa fa-cart-plus" aria-hidden="true"></i> Exam Master<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('admin/exam')?>">Add Exam</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/examList')?>">Exam List</a>
                                </li>
                            </ul>
                        </li>
                         <li> <a href="#"><i class="fa fa-book" aria-hidden="true"></i> Package Master<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('admin/package')?>">Add Package</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/packageList')?>">Package List</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/super_package')?>">Add Super Sub Package</a>
                                </li>

                                <li>
                                     <a href="<?php echo base_url('admin/super_packageList')?>">Super Package List</a> 
                                </li>

                            </ul>
                        </li> 
                        <li> <a href="#"><i class="fa fa-copy" aria-hidden="true"></i> Menu Master<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('admin/menu')?>">Add Menu</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/menuList')?>">Menu List</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/sub_menu')?>">Add Sub Menu</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/submenuList')?>">Sub Menu List</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/super_sub_menu')?>">Add SuperSub Menu</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/super_submenuList')?>">SuperSub Menu List</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/super_sub_menu_post')?>">Add SuperSub Menu Post</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/super_submenupostList')?>">SuperSub Menu Post List</a>
                                </li>
                            </ul>
                        </li>

                         <li> <a href="#"><i class="fa fa-file-text" aria-hidden="true"></i>  Featured Links<span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('admin/category')?>">Add Category</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/categoryList')?>">Category List</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/link')?>">Add Links</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/linkList')?>">Link List</a>
                                </li>
                            </ul>
                        </li>

                         <li><a href="#"><i class="fa fa-copy" aria-hidden="true"></i> Pages Master<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('admin/about');?>">About Us</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/privacy');?>">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/terms');?>">Terms & Conditions</a>
                                </li>
                            </ul>
                        </li>

                        <li> <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> Configurations <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="<?php echo base_url('admin/setting');?>"><i class="fa fa-cog"></i> Site Settings</a>
                                </li>
                                <li><a href="#"><i class="fa fa-leanpub" aria-hidden="true"></i> Blog <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level third_level">
                                        <li>
                                            <a href="<?php echo base_url('admin/blog');?>">Add Blog</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('admin/blogList');?>">Blog list</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#"><i class="fa fa-newspaper-o" aria-hidden="true"></i>  News <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level third_level">
                                        <li>
                                            <a href="<?php echo base_url('admin/news');?>">Add News</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('admin/newsList');?>">News List</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#"><i class="fa fa-bell" aria-hidden="true"></i> Notification <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level third_level">
                                        <li>
                                            <a href="<?php echo base_url('admin/notification');?>">Add Notification</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('admin/notificationList');?>"> Notification List</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> Event <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level third_level">
                                        <li>
                                            <a href="<?php echo base_url('admin/event');?>">Add Event</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('admin/eventList');?>">Event list</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#"><i class="fa fa-quote-left" aria-hidden="true"></i> Testimonials<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level third_level">
                                        <li>
                                            <a href="<?php echo base_url('admin/testimonials')?>">View Testimonials</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#"><i class="fa fa-check" aria-hidden="true"></i> Why Choose Us<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level third_level">
                                        <li>
                                            <a href="<?php echo base_url('admin/choose')?>">Add Content</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('admin/whychooseList')?>">View Content</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
    </nav>

    <style type="text/css">
        .third_level {
            margin-left: 27px;
        }
    </style>