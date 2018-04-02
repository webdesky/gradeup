<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');



// This can be removed if you use __autoload() in config.php OR use Modular Extensions

require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller
{
    function __construct()
    {
      parent::__construct();
      
    }

    /*Set Language */
    public function set_language_post(){
        $pdata = file_get_contents("php://input");
        $data  = json_decode($pdata,true);
       
        $user_id    = $data['user_id'];
        $lang       = $data['lang'];

        $required_parameter = array('user_id','lang');
        $chk_error = $this->controller->check_required_value($required_parameter, $data);
        if ($chk_error) 
        {
             $resp = array('code' => MISSING_PARAM, 'message' => 'Missing ' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }

        $where           = array(
            'id'  => $user_id
        );

        $data = array(
              'language' => $lang
            );

        $result = $this->model->updateFields('users', $data, $where); 
        if (!empty($result)) 
            {
            $resp = array(
                    'code'      => 'SUCCESS',
                    'message'   => 'language Added Successfully'
                    
                    
                );
        }else{
            $resp = array(
                    'code'    => 'ERROR',
                    'message' => 'FAILURE'
                );
        }
        $this->response($resp);
    }
    
    /*Get Language */
    public function get_language_get(){
       $resp = array(
                'code'      => 'SUCCESS',
                'message'   => 'SUCCESS',
                'response'  => array(
                'language'   => 'hi'
                )
            );
        $this->response($resp);
    }

    /*Get All Modules*/
    public function get_modules_get(){

      $lang = $this->input->get('lang');
      $site_url = base_url();
      if($lang==='en' || $lang==null){
        $fields='id,en_module_name as module_name, CONCAT("'.$site_url.'","asset/uploads/",image)AS image';
      }else if($lang==='hi'){
        $fields='id,hi_module_name as module_name,CONCAT("'.$site_url.'","asset/uploads/",image)AS image';
      }else{
         $resp = array(
                'code'    => 'ERROR',
                'message' => 'Invalid Language Code'
            );
         $this->response($resp);
         return false;
      }  
       $where           = array(
            'is_active'  => 1
      );
      $data = $this->model->getAllwhere('modules',$where,$fields);
     
       
      if (!empty($data)) 
      {
        $resp = array(
                'code'      => 'SUCCESS',
                'message'   => 'SUCCESS',
                'response'  => array(
                'modules'   => $data
                )
            );
      }else{
        $resp = array(
                'code'    => 'ERROR',
                'message' => 'FAILURE'
            );
      }
        $this->response($resp);
    }

    /*Get All Choose Us*/
    public function get_chooseus_get(){
      $lang   = $this->input->get('lang');
      $site_url = base_url();
      if($lang ==='en' || $lang == null){
        $fields ='id,en_title as title,en_content as content,CONCAT("'.$site_url.'","asset/uploads/",image)AS image';
      }else if($lang ==='hi'){
        $fields ='id,hi_title as title,hi_content as content,CONCAT("'.$site_url.'","asset/uploads/",image)AS image';
      }else{
         $resp  = array(
                'code'    => 'ERROR',
                'message' => 'Invalid Language Code'
            );
         $this->response($resp);
         return false;
      }  
       $where           = array(
            'is_active'  => 1
      );
      $data = $this->model->getAllwhere('why_choose_us',$where,$fields);
      
      if (!empty($data)) 
      {
        $resp = array(
                'code'      => 'SUCCESS',
                'message'   => 'SUCCESS',
                'response'  => array(
                'choose_us' => $data
                )
            );
      }else{
        $resp = array(
                'code'    => 'ERROR',
                'message' => 'FAILURE'
            );
      }
        $this->response($resp);
    }

    /*Get All Chapters*/
    public function get_chapters_get(){
        $data = $this->model->getAll('chapters');
        if (!empty($data)) 
        {
            $resp = array(
                'code'      => 'SUCCESS',
                'message'   => 'SUCCESS',
                'response'  => array('chapters' => $data)
            );
        }else{
            $resp  = array(
                'code'      => 'ERROR',
                'message'   => 'FAILURE'
            );
        }
          $this->response($resp);
    }

    /*Get All Menus*/
    public function get_menus_get(){
      $lang =$this->input->get('lang');
      
      if($lang==='en' || $lang==null){
        $fields='id,module_id,en_menu_name as menu_name';
      }else if($lang==='hi'){
        $fields='id,module_id,hi_menu_name as menu_name';
      }else{
         $resp = array(
                'code'    => 'ERROR',
                'message' => 'Invalid Language Code'
            );
         $this->response($resp);
         return false;
      }  
     
      $data = $this->model->getAll('menu',$fields);
      foreach ($data as $key => $value) 
      {
        $where        = array(
                       'menu_id' => $value['id']
                );
        if($lang ==='en'){
            $fields1 = 'id,menu_id,en_sub_menu_name as sub_menu_name,is_active';
        }else if($lang === 'hi'){
            $fields1 ='id,menu_id,hi_sub_menu_name as sub_menu_name,is_active';
        }
          $data[$key]['sub_menu'] = $this->model->getAllwhere('sub_menu',$where,$fields1);
          if(!empty($data[$key]['sub_menu']))
          {
              foreach ($data[$key]['sub_menu'] as $sub_key => $sub_value)
               {
      
                  $where1        = array(
                       'sub_menu_id' => $sub_value->id
                  );

                  if($lang ==='en'){
                      $fields2 ='id,sub_menu_id,en_super_sub_menu as super_sub_menu,is_active';
                   }else if($lang ==='hi'){
                      $fields2 = 'id,sub_menu_id,hi_super_sub_menu as super_sub_menu,is_active';
                  }
                      $data[$key]['sub_menu'][$sub_key]->super_sub_menu= $this->model->getAllwhere('super_sub_menu',$where1,$fields2);   
               }
          }
      }
      
      if (!empty($data)) 
      {
          $resp = array(
                'code'      => 'SUCCESS',
                'message'   => 'SUCCESS',
                'response'  => array(
                'menu'      => $data
                )
            );
      }else{
          $resp = array(
                'code'      => 'ERROR',
                'message'   => 'FAILURE'
            );
      }
        $this->response($resp);
    }

    /*Get All Posts*/
    public function get_posts_get(){
      $fields='post.en_post,post.id,users.first_name,users.last_name,post.chapter_id,post.super_submenu_id,post.type,users.id as user_id';
      $data = $this->model->GetJoinRecord('post', 'added_by', 'users', 'id', $fields);
      
      foreach ($data as $key => $value) {
        
        $where = array(
                'id' => $value->chapter_id
            );
            
        $select = 'en_chapter_name';
        $chapter_name  = $this->model->getAllwhere('chapters', $where, $select);
        $value->chapter_name = $chapter_name[0]->en_chapter_name;

        $where1 = array(
                'id' => $value->super_submenu_id
            );
            
        $select1 = 'en_super_sub_menu';
        $menu_name  = $this->model->getAllwhere('super_sub_menu', $where1, $select1);
        $value->super_sub_menu = $menu_name[0]->en_super_sub_menu;

        $select2 = 'save_notes.id';
        $where2 =  array(
                'save_notes.user_id' => $value->user_id,
                'save_notes.post_id' => $value->id     

            );
        $notes=$this->model->GetJoinRecord('save_notes', 'post_id', 'post', 'id', $select2,$where2);
       
        if(!empty($notes)){
          $value->notes = true;
        }else{
           $value->notes = false;
        }

        $where3   = array(
            'user_id'  => $value->user_id,
            'post_id'  => $value->id
        );

        $check = $this->model->getAllwhere('post_likes', $where3);
          if(!empty($check)){
             $value->like =  true;
          }else{
              $value->like = false; 
          }

        $count = $this->model->getAllwhere('post_likes',array('post_id' => $value->id),'COUNT(id)  as Likes_count');
          if($count[0]->Likes_count!=0){
             $value->like_count = $count[0]->Likes_count;
          }else{
             $value->like_count = 0;         
          }
      }
      if (!empty($data)) 
      {
            $resp = array(
                'code'      => 'SUCCESS',
                'message'   => 'SUCCESS',
                'response'  => array(
                'post'      => $data
             )
            );
      }else{
            $resp = array(
                'code'      => 'ERROR',
                'message'   => 'FAILURE'
            );
      }
        $this->response($resp);
    }

    /*Get All Questions*/
    public function get_questions_get(){
      $data = $this->model->getAll('questions');
      if (!empty($data)) 
      {
            $resp = array(
                'code'      => 'SUCCESS',
                'message'   => 'SUCCESS',
                'response'  => array(
                'questions' => $data
                )
            );
      }else{
            $resp = array(
                'code'    => 'ERROR',
                'message' => 'FAILURE'
            );
      }
        $this->response($resp);
    }

    /*Get All Exams*/
    public function get_exams_get(){
      $data = $this->model->getAll('exam');
      if (!empty($data)) 
      {
          $resp = array(
                'code'      => SUCCESS,
                'message'   => 'SUCCESS',
                'response'  => array(
                'exam'      => $data
                )
            );
      }else{
          $resp = array(
                'code'      => ERROR,
                'message'   => 'FAILURE'
            );
      }
        $this->response($resp);
    }

    
   /*Get All Pages*/
    public function get_pages_get(){
      $lang =$this->input->get('lang');
      $page =$this->input->get('page');

      if($lang==='en' || $lang==null){
        $fields='id,en_'.$page.' '.'as'.' '.$page;
      }else if($lang ==='hi'){
       $fields='id,hi_'.$page.' '.'as'.' '.$page;
      }else{
         $resp = array(
                'code'    => 'ERROR',
                'message' => 'Invalid Language Code'
            );
         $this->response($resp);
         return false;
      }
        $data = $this->model->getAll('settings',$fields);
        if (!empty($data)) {
          $resp = array(
                'code'          => 'SUCCESS',
                'message'       => 'SUCCESS',
                'response'      => array(
                'settings'      => $data
                )
            );
        }else{
          $resp = array(
                'code'    => 'ERROR',
                'message' => 'FAILURE'
            );
        }
        $this->response($resp);
    }

    /*verify login*/
    public function verify_login_post(){
        $pdata = file_get_contents("php://input");
        $data = json_decode($pdata,true);
        $site_url=base_url();
        $email  = $data['email'];
        $password  = $data['password'];

        $where           = array(
               //"username = ".$username." or email=".$username,
               'email'     =>$email,
               'password'  => md5($password),
               'is_active' => 1
                );
        $data = $this->model->getAllwhere('users', $where,'id,first_name,last_name,email,CONCAT("'.$site_url.'","asset/uploads/",profile_pic)AS image,language');
        if($data[0]->language==null){
          $data[0]->language ='en';
        }
       
        if(!empty($data))
        {
          //$this->session->sess_destroy();
          $this->session->set_userdata('id',$data[0]->id);
          $resp = array('code' => 'SUCCESS', 'message' => 'SUCCESS', 'response' => array('user' => $data));   
        }else{
          $resp = array('code' => 'ERROR', 'message' => 'Failure', 'response' => array('message' => 'Invalid Email Or Password'));
        }
          $this->response($resp);
    }
    
     /*Check User isLogin*/
    public function isLogin_get(){
      if($this->session->userdata('id')!=null){
        $site_url=base_url();
        $where           = array(
               //"username = ".$username." or email=".$username,
               'id'        =>$this->session->userdata('id'),
               'is_active' => 1
                );
        $data = $this->model->getAllwhere('users', $where,'id,first_name,last_name,email,CONCAT("'.$site_url.'","asset/uploads/",profile_pic)AS image');
        $resp = array('code'  => 'SUCCESS', 'message' => 'SUCCESS', 'response' => array('user' => $data ));   
      }else{
        $resp = array('code' => 'ERROR', 'message' => 'Failure', 'response' => array('message' => 'please Login to continue'));
      }
       $this->response($resp);
    }

    /*register User*/
    public function register_post(){
        $pdata = file_get_contents("php://input");
        $data  = json_decode($pdata,true);
         $site_url=base_url();
        $required_parameter = array('first_name','last_name','email','password');
        $chk_error = $this->controller->check_required_value($required_parameter, $data);
        if ($chk_error) 
        {
             $resp = array('code' => MISSING_PARAM, 'message' => 'Missing ' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }

        $first_name  = $data['first_name'];
        $last_name   = $data['last_name'];
        $email       = $data['email'];
        $parts       = explode("@", $email);
        $username    = $parts[0];
        $password    = $data['password'];

        $where1             = array(
               'username'   => $username,
               'email'      => $email,
               'is_active'  => 1
                );
        $check = $this->model->getAllwhere('users', $where1);
        if(!empty($check)){
               $resp = array('code' => 'ERROR', 'message' => 'Email Already Registrered');
               $this->response($resp); 
               return false;

        }

        $data = array(
            'first_name'     => $first_name,
            'last_name'      => $last_name,
            'username'       => $username,
            'email'          => $email,
            'password'       => MD5($password),
            'is_active'      => 1,
            'user_role'      => 3,
            'created_at'     => date('Y-m-d H:i:s')
                );

        $id = $this->model->insertData('users', $data);
        $where           = array(
               'id'        =>$id,
               'is_active' => 1
                );
        $result = $this->model->getAllwhere('users', $where,'id,first_name,last_name,CONCAT("'.$site_url.'","asset/uploads/",profile_pic)AS image');
        if(!empty($data)){
            $resp = array('code' => 'SUCCESS', 'message' => 'User Registrered Successfully','response' => array('user' => $result));   
        }else{
            $resp = array('code' => 'ERROR', 'message' => 'FAILURE','response' => array('message' => 'User Not Registrered Successfully'));
        }
            $this->response($resp);
    } 

      /*Change Password*/
    public function changePassword_post(){
        $user_id      = $this->input->post('user_id');
        $old_password = md5($this->input->post('old_password'));
        $new_password = md5($this->input->post('new_password'));

        $where        = array(
                    'is_active' => 1,
                    'id'        =>  $user_id
                );

        $userData =    $this->model->getAllwhere('users',$where);
        if(empty($userData))
        {
            $resp = array('code' => 'ERROR', 'message' => 'Invalid User Id');
            $this->response($resp);   
        }else if($userData["password"] != $old_password)
        {
            $resp = array('code' => 'ERROR', 'message' => 'Invalid Old Password');
            $this->response($resp); 
        }
        $data        = array(
                    'password'  => $new_password
                );
        $result = $this->model->updateFields('users', $data, $where);

        /* Response array */
        $resp = array('code' => 'SUCCESS', 'message' => 'SUCCESS', 'response' => array('success' => 'PASSWORD_CHANGED', 'success_label' => 'Password changed successfully.'));

        $this->response($resp);
    }

      /*get user Profile*/
    public function getProfile_get(){
        $user_id      = $this->input->get('user_id');
        $where        = array(
                    'is_active' => 1,
                    'id'        =>  $user_id
                );
        $userData =    $this->model->getAllwhere('users',$where);
        if(empty($userData))
        {
            $resp = array('code' => 'ERROR', 'message' => 'Invalid User Id');
            $this->response($resp);   
        }else
        {
            $resp = array('code' => 'SUCCESS', 'message' => 'SUCCESS', 'response' => array('user' => $userData));   
            $this->response($resp); 
        }
    }

      /*Update user Profile*/
    public function updateProfile_post(){
        $user_id      = $this->input->post('user_id');
        $where        = array(
                    'is_active' => 1,
                    'id'        =>  $user_id
                );
        $userData =    $this->model->getAllwhere('users',$where);
        if(empty($userData))
        {
            $resp = array('code' => 'ERROR', 'message' => 'Invalid User Id');
            $this->response($resp);   
        }else
        {
                $first_name  = $this->input->post('first_name');
                $last_name   = $this->input->post('last_name');
                $address     = $this->input->post('address');
                $phone_no    = $this->input->post('phone_no');
                $mobile_no   = $this->input->post('mobile_no');
                $dob         = $this->input->post('dob');
                $gender      = $this->input->post('gender');
                $blood_group = $this->input->post('blood_group');
                $status      = $this->input->post('status');

                $data = array(
                    'first_name'     => $first_name,
                    'last_name'      => $last_name,
                    'address'        => $address,
                    'phone_no'       => $phone_no,
                    'mobile'         => $mobile_no,
                    'date_of_birth'  => $dob,
                    'gender'         => $gender,
                    'blood_group'    => $blood_group,
                    'is_active'      => $status,
                    'user_role'      => 3,
                );
        $result = $this->model->updateFields('users', $data, $where);

        /* Response array */
        $resp = array('code' => 'SUCCESS', 'message' => 'SUCCESS', 'response' => array('success' => 'Profile Updated Successfully', 'success_label' => 'Profile Updated Successfully'));

        $this->response($resp);

        }
    }

      /*Get Menu By Module ID*/
    public function getMenuByModule_get(){
        $module_id      = $this->input->post('module_id');
        $where          = array(
                    'is_active'   => 1,
                    'module_id'   =>  $module_id
                );
        $userData =    $this->model->getAllwhere('menu',$where);
        if(empty($userData))
        {
            $resp = array('code' => 'ERROR', 'message' => 'Invalid Module Id');
            $this->response($resp);   
        }else
        {
            $resp = array('code' => 'SUCCESS', 'message' => 'SUCCESS', 'response' => array('Menu' => $userData));   
            $this->response($resp); 
        }
    }

      /*Get Sub Menu By Menu ID*/
    public function getSubMenuByMenu_get(){
        $menu_id      = $this->input->post('menu_id');
        $where        = array(
                    'is_active'      => 1,
                    'menu_id'        =>  $menu_id
                );
        $userData =    $this->model->getAllwhere('sub_menu',$where);
        if(empty($userData))
        {
            $resp = array('code' => 'ERROR', 'message' => 'Invalid Menu Id');
            $this->response($resp);   
        }else
        {
            $resp = array('code' => 'SUCCESS', 'message' => 'SUCCESS', 'response' => array('Sub_Menu' => $userData));   
            $this->response($resp); 
        }
    }

       /*Get Question By Chapter   ID*/
    public function getquestionbychapter_get(){
        $chapter_id      = $this->input->get('chapter_id');
        $where           = array(
                    'is_active'  => 1,
                    'chapter_id' => $chapter_id
                );
        $data = $this->model->getAllwhere('exam',$where);
        foreach ($data as $key => $value) {
            
        }
    }

     /*Get Post By Menu ID*/
    public function get_post_by_menu_get(){
         $menu_id         = $this->input->get('menu_id');
         $where           = array(
                    'is_active'         => 1,
                    'super_sub_menu_id' => $menu_id
                );
         $userData = $this->model->getAllwhere('super_sub_menu_post',$where,'id,super_sub_menu_id,en_post,hi_post,is_active');
         if(empty($userData))
        {
            $resp = array('code' => 'ERROR', 'message' => 'Invalid Menu Id');
            $this->response($resp);   
        }else
        {
            $resp = array('code' => 'SUCCESS', 'message' => 'SUCCESS', 'response' => array('Post' => $userData));   
            $this->response($resp); 
        }
    }

      /*Get All News*/
    public function get_news_get(){
      $lang =$this->input->get('lang');
        $site_url = base_url();
      if($lang ==='en' || $lang == null || $lang === 'hi'){
        $fields  ='id,title,news_description,CONCAT("'.$site_url.'","asset/uploads/",news_image)AS news_image,news_url';
      }else{
         $resp = array(
                'code'    => 'ERROR',
                'message' => 'Invalid Language Code'
            );
         $this->response($resp);
         return false;
      }  
       $where           = array(
            'is_active'  => 1
      );
      $data = $this->model->getAllwhere('news',$where,$fields);
      
      if (!empty($data)) 
      {
        $resp = array(
                'code'        => 'SUCCESS',
                'message'     => 'SUCCESS',
                'response'    => array(
                'news'        => $data,
                'recent_news' => $data
                )
            );
      }else{
        $resp = array(
                'code'    => 'ERROR',
                'message' => 'FAILURE'
            );
      }
        $this->response($resp);
    }

      /*Get All Notification*/
    public function get_notification_get()
    {
      $lang =$this->input->get('lang');
      $site_url =base_url();
      if($lang ==='en' || $lang == null || $lang ==='hi'){
        $fields ='id,title,notification_description,CONCAT("'.$site_url.'","asset/uploads/",notification_image)AS notification_image,notification_url';
      }else{
         $resp = array(
                'code'    => 'ERROR',
                'message' => 'Invalid Language Code'
            );
         $this->response($resp);
         return false;
      }  
       $where            = array(
            'is_active'  => 1
      );
      $data = $this->model->getAllwhere('notification',$where,$fields);
      
      if (!empty($data)) 
      {
        $resp = array(
                'code'            => 'SUCCESS',
                'message'         => 'SUCCESS',
                'response'        => array(
                'notification'    => $data
              
                )
            );
      }else{
        $resp = array(
                'code'    => 'ERROR',
                'message' => 'FAILURE'
            );
      }
        $this->response($resp);
    }

    /*Get All Event*/
    public function get_events_get()
    {
      $lang     = $this->input->get('lang');
      $site_url = base_url();
      if($lang ==='en' || $lang ==null || $lang ==='hi'){
        $fields ='id,title,description,CONCAT("'.$site_url.'","asset/uploads/",image)AS image,MONTHNAME(event_date) as Month,DATE_FORMAT(event_date,"%d") as date,start_time,end_time,address';
      }else{
         $resp = array(
                'code'    => 'ERROR',
                'message' => 'Invalid Language Code'
            );
         $this->response($resp);
         return false;
      }  
       $where           = array(
            'is_active'  => 1
      );
      $data = $this->model->getAllwhere('event',$where,$fields);
      foreach ($data as $key => $value) {
        $data[$key]->Month        = substr($value->Month, 0, 3);
        $data[$key]->description  = str_replace('&nbsp'," ",$value->description);
      }
      if (!empty($data)) 
      {
        $resp = array(
                'code'            => 'SUCCESS',
                'message'         => 'SUCCESS',
                'response'        => array(
                'event'           => $data
              
                )
            );
      }else{
        $resp = array(
                'code'    => 'ERROR',
                'message' => 'FAILURE'
            );
      }
        $this->response($resp);
    }
    

    /*Get All Testimonials*/
    public function get_testimonial_get()
    {
      $lang =$this->input->get('lang');
      $site_url = base_url();
      if($lang ==='en' || $lang ==null || $lang ==='hi'){
        $fields ='testimonials.testimonial,CONCAT("'.$site_url.'","asset/uploads/",users.profile_pic)AS image,users.first_name,users.user_role';
      }else{
         $resp  = array(
                'code'    => 'ERROR',
                'message' => 'Invalid Language Code'
            );
         $this->response($resp);
         return false;
      }  
      $where           = array(
            'is_active'  => 1
      );
      $data = $this->model->GetJoinRecord('testimonials', 'user_id', 'users', 'id', $fields);
      if(!empty($data)){
        foreach ($data as $key => $value) {
          $where1           = array(
              'role_id'  => $value->user_role
          );
          $role_name   = $this->model->getAllwhere('user_role',$where1,'role_name');
          $value->role = $role_name[0]->role_name;
        }
      }
      if (!empty($data)) 
      {
        $resp = array(
                'code'            => 'SUCCESS',
                'message'         => 'SUCCESS',
                'response'        => array(
                'testimonials'    => $data
                )
            );
      }else{
        $resp = array(
                'code'    => 'ERROR',
                'message' => 'FAILURE'
            );
      }
        $this->response($resp);
    }

     /*Get Search Data*/
    public function get_search_get(){
      $keyword  = $this->input->get('keyword');
      $site_url = base_url();
      $fields  = 'id,en_post,en_post_title';
      $where    = "en_post_title LIKE '%$keyword%' AND is_active=".'1';
      $post     = $this->model->getAllwhere('post',$where,$fields);
      
      $where1   = "first_name LIKE '%$keyword%' AND is_active=".'1';
      $fields1  = 'id,first_name,last_name,CONCAT("'.$site_url.'","asset/uploads/",profile_pic)AS image';
      $user     = $this->model->getAllwhere('users',$where1,$fields1);
      
      if (!empty($user || $post)) 
      {
         $resp = array(
                'code'      => 'SUCCESS',
                'message'   => 'SUCCESS',
                'response'  => array(
                'post'      => $post,
                'user'      => $user,
                'exam'      => null
                )
            );
      }else{
        $resp = array(
                'code'    => 'ERROR',
                'message' => 'No Data Found'
            );
      }
      $this->response($resp);
    }

     /*Get User Profile By User Id*/
    public function get_profile_get(){
       $id       = $this->input->get('id');
       $site_url = base_url();
       $where    = array(

                    'users.is_active'  => 1,

                    'users.id'         => $id

                );
      $data      = $this->model->getAllwhere('users',$where,'id,first_name,last_name,CONCAT("'.$site_url.'","asset/uploads/",profile_pic)AS image,address');

      $where1    = array(

                    'post.is_active'  => 1,

                    'post.added_by'   => $id

                );
      $fields='post.en_post,post.id,post.chapter_id,post.super_submenu_id,post.type,post.added_by,CONCAT("'.$site_url.'","asset/uploads/",image)AS image,post.created_at';
      $data1 = $this->model->getAllwhere('post',$where1,$fields);

      $where2    =   array(

                    'save_notes.is_active'  => 1,

                    'save_notes.user_id'    => $id,
  

                );

      $notes =  $this->model->GetJoinRecord('save_notes', 'post_id', 'post', 'id', $fields,$where2);

      if(!empty($notes)){
        foreach ($notes as $key => $value) {
          $times = explode(",",$this->dateDiff($value->created_at,date('Y-m-d H:i:s')));
          
          $notes[$key]->duration=$times[0];


          $where3   = array(
            'user_id'  => $id,
            'post_id'  => $value->id
        );

        $check = $this->model->getAllwhere('post_likes', $where3);

          if(!empty($check)){
           $value->like =  true;
                 
          }else{
            $value->like = false; 
          
          }
        $count = $this->model->getAllwhere('post_likes',array('post_id' => $value->id),'COUNT(id)  as Likes_count');
          if($count[0]->Likes_count!=0){
             $value->like_count = $count[0]->Likes_count;
          }else{
             $value->like_count = 0;         
          }
        }
      }
       
      
      if(!empty($data1)){
      foreach ($data1 as $key => $value) {
          $times = explode(",",$this->dateDiff($value->created_at,date('Y-m-d H:i:s')));
          
          $data1[$key]->duration=$times[0];

          $select2 = 'save_notes.id';
          $where2 =  array(
                  'save_notes.user_id' => $id,
                  'save_notes.post_id' => $value->id     

              );
          $note=$this->model->GetJoinRecord('save_notes', 'post_id', 'post', 'id', $select2,$where2);
         
          if(!empty($note)){
            $value->notes  = true;
          }else{
             $value->notes = false;
          }

          $where3   = array(
              'user_id'  => $id,
              'post_id'  => $value->id
          );

          $check = $this->model->getAllwhere('post_likes', $where3);
       
          if(!empty($check)){
           $value->like       =  true;
          // $value->like_count =  $check[0]->Likes_count;       
          }else{
            $value->like       = false;
            //$value->like_count = 0;          
          }
          $count = $this->model->getAllwhere('post_likes',array('post_id' => $value->id),'COUNT(id)  as Likes_count');
          if($count[0]->Likes_count!=0){
             $value->like_count = $count[0]->Likes_count;
          }else{
             $value->like_count = 0;         
          }

          /*$where       = array(
                  'id' => $value->chapter_id
              );
              
          $select        = 'en_chapter_name';
          $chapter_name  = $this->model->getAllwhere('chapters', $where, $select);

          $data1[$key]->chapter_name = $chapter_name[0]->en_chapter_name;
         
          $where1      = array(
                  'id' => $value->super_submenu_id
              );
              
          $select1    = 'en_super_sub_menu';
          $menu_name  = $this->model->getAllwhere('super_sub_menu', $where1, $select1);
          $data1[$key]->super_sub_menu = $menu_name[0]->en_super_sub_menu;*/
        }
      }
      if (!empty($data)) 
      {
        $resp = array(
                'code'      => 'SUCCESS',
                'message'   => 'SUCCESS',
                'response'  => array(
                'User'      => $data,
                'Post'      => $data1,
                'Notes'     => $notes,
                )
            );
      }else{
        $resp = array(
                'code'    => 'ERROR',
                'message' => 'FAILURE'
            );
      }
        $this->response($resp);
    }

     /*Send Post Creation Data Modules and Menu*/
    public function post_data_get(){
      
      $where=array(
        'is_active'  => 1
      );
      $menu    = $this->model->getAllwhere('super_sub_menu',$where,'id,en_super_sub_menu as super_sub_menu');
      $chapter = $this->model->getAllwhere('chapters',$where,'id,en_chapter_name as chapter_name');

      if (!empty($menu || $modules)) 
      {
         $resp = array(
                'code'      => 'SUCCESS',
                'message'   => 'SUCCESS',
                'response'  =>  array(
                'menu'      => $menu,
                'chapter'   => $chapter
                )
            );
      }else{
        $resp = array(
                'code'    => 'ERROR',
                'message' => 'No Data Found'
            );
      }
      $this->response($resp);
    }

     /*Insert Post Into Database*/
    public function insert_data_post(){
        $pdata = file_get_contents("php://input");
        $data  = json_decode($pdata,true);
        
        $type=$data['type'];
        if($data['type']=='QUERY' || $data['type'] == 'SHARED'){
       
        $required_parameter = array('user_id','chapter_id','menu_id','post');
        $chk_error          = $this->controller->check_required_value($required_parameter, $data);
        if ($chk_error) 
        {
             $resp = array('code' => 'MISSING_PARAM', 'message' => 'Missing ' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }

        $user_id             = $data['user_id'];
        $chapter_id          = $data['chapter_id'];
        $super_submenu_id    = $data['menu_id'];
        $post                = $data['post'];
        $type                = $data['type'];
        $data = array(
            'added_by'            => $user_id,
            'chapter_id'          => $chapter_id,
            'super_submenu_id'    => $super_submenu_id,
            'en_post'             => $post,
            'type'                => $type,
            'is_active'           => 1,
            'created_at'          => date('Y-m-d H:i:s')
                );
      $response = $this->model->insertData('post', $data);
      }else if($data['type'] == 'MCQ'){

        $required_parameter = array('user_id','chapter_id','menu_id','question','option_a','option_b','option_c','option_d','answer');
        $chk_error          = $this->controller->check_required_value($required_parameter, $data);
        if ($chk_error) 
        {
             $resp = array('code' => 'MISSING_PARAM', 'message' => 'Missing ' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }

        $user_id             = $data['user_id'];
        $chapter_id          = $data['chapter_id'];
        $super_submenu_id    = $data['menu_id'];
        $question            = $data['question'];
        $option_a            = $data['option_a'];
        $option_b            = $data['option_b'];
        $option_c            = $data['option_c'];
        $option_d            = $data['option_d'];
        $option_e            = $data['option_e'];
        $answer              = $data['answer'];

        $data = array(
            'added_by'            => $user_id,
            'chapter_id'          => $chapter_id,
            'super_submenu_id'    => $super_submenu_id,
            'question'            => $question,
            'option_a'            => $option_a,
            'option_b'            => $option_b,
            'option_c'            => $option_c,
            'option_d'            => $option_d,
            'option_e'            => $option_e,
            'answer'              => $answer,
            'is_active'           => 1,
            'created_at'          => date('Y-m-d H:i:s')
                );


        $response = $this->model->insertData('mcq', $data);
      }
        if(!empty($response)){
            $resp = array('code' => 'SUCCESS', 'message' => $type.'  added successfully');   
        }else{
            $resp = array('code' => 'ERROR', 'message' => 'FAILURE','response' => array('message' => $type.'   Not added'));
        }
            $this->response($resp);
        
    } 

    public function get_blog_get(){
      $lang     = $this->input->get('lang');
      $site_url = base_url();
      if($lang ==='en' || $lang ==null){
        $fields ='id,en_title as title,en_description  as description,CONCAT("'.$site_url.'","asset/uploads/",image)AS image,MONTHNAME(blog_date) as Month,DATE_FORMAT(blog_date,"%d") as date,en_address';
      }else if($lang ==='hi'){
         $fields ='id,hi_title as title,hi_description as description,CONCAT("'.$site_url.'","asset/uploads/",image)AS image,MONTHNAME(blog_date) as Month,DATE_FORMAT(blog_date,"%d") as date,hi_address';
      }else{
         $resp = array(
                'code'    => 'ERROR',
                'message' => 'Invalid Language Code'
            );
         $this->response($resp);
         return false;
      }  
        $where           = array(
            'is_active'  => 1
      );
      $data = $this->model->getAllwhere('blogs',$where,$fields);
      foreach ($data as $key => $value) {
        $data[$key]->Month        = substr($value->Month, 0, 3);
        $data[$key]->description  = str_replace('&nbsp'," ",$value->description);
      }
      if (!empty($data)) 
      {
        $resp = array(
                'code'            => 'SUCCESS',
                'message'         => 'SUCCESS',
                'response'        => array(
                'blog'            => $data
              
                )
            );
      }else{
        $resp = array(
                'code'    => 'ERROR',
                'message' => 'FAILURE'
            );
      }
        $this->response($resp);
    }

    /*Get Website Settings*/
    public function get_settings_get(){      
        $lang = $this->input->get('lang');
        if($lang==null){
          $fields ='en_site_title as site_title,CONCAT(site_url,'.', image_folder,'.',logo)AS logo,CONCAT(site_url, '.', image_folder,'.',favicon)AS favicon,en_meta_tags as meta_tags,en_copyright as copyright,contact_us_phone,contact_us_email,twitter_url,insta_url,linkedin_url,fb_url,gplus_url';
        }else if($lang === 'hi' || $lang==='en'){
          $fields = $lang.'_site_title as site_title,CONCAT(site_url, '.', image_folder,'.',logo)AS logo,CONCAT(site_url, '.', image_folder,'.',favicon)AS favicon,'.$lang.'_meta_tags as meta_tags,'.$lang.'_copyright as copyright,contact_us_phone,contact_us_email,twitter_url,insta_url,linkedin_url,fb_url,gplus_url';
        }else{
           $resp = array(
                  'code'    => 'ERROR',
                  'message' => 'Invalid Language Code'
              );
           $this->response($resp);
           return false;
        }  
        $data = $this->model->getAll('settings',$fields);
        
        if (!empty($data)) {
            $resp = array(
                  'code'          => 'SUCCESS',
                  'message'       => 'SUCCESS',
                  'response'      => array(
                  'settings'      => $data
                  )
              );
        }else{
            $resp = array(
                  'code'    => 'ERROR',
                  'message' => 'FAILURE'
              );
        }
            $this->response($resp);
    }


    public function static_heading_get(){
      $lang = $this->input->get('lang');
      if($lang == 'en' || $lang == 'hi'){
        $this->lang->load($lang, 'english');
        $data[0]         = array(
                    'news'                    => $this->lang->line('news'),
                    'profile'                 => $this->lang->line('profile'),
                    'notification'            => $this->lang->line('notification'),
                    'practice'                => $this->lang->line('practice'),
                    'create'                  => $this->lang->line('create'),
                    'search_placeholder'      => $this->lang->line('search_placeholder'),
                    'save_to_my_notes'        => $this->lang->line('save_to_my_notes'),
                    'turn_on_notifications'   => $this->lang->line('turn_on_notifications'),
                    'copy_link'               => $this->lang->line('copy_link'),
                    'report'                  => $this->lang->line('report'),
                    'remove_from_my_notes'    => $this->lang->line('remove_from_my_notes'),
                    'upvote'                  => $this->lang->line('upvote'),
                    'comment'                 => $this->lang->line('comment'),
                    'share'                   => $this->lang->line('share'),
                    'start_quiz'              => $this->lang->line('start_quiz'),
                    'my_profile'              => $this->lang->line('my_profile'),
                    'my_packages'             => $this->lang->line('my_packages'),
                    'test_series'             => $this->lang->line('test_series'),
                    'my_exam'                 => $this->lang->line('my_exam'),
                    'help_feedback'           => $this->lang->line('help_feedback'),
                    'logout'                  => $this->lang->line('logout'),
                    'home'                    => $this->lang->line('home'),
                    'create_post'             => $this->lang->line('create_post'),
                    'ask_a_query'             => $this->lang->line('ask_a_query'),
                    'post_a_mcq'              => $this->lang->line('post_a_mcq'),
                    'share_info'              => $this->lang->line('share_info'),
                    'add_image'               => $this->lang->line('add_image'),
                    'next'                    => $this->lang->line('next'),
                    'login'                   => $this->lang->line('login'),
                    'register'                => $this->lang->line('register'),
                    'lang'                    => $this->lang->line('lang'),
                    'select_your_exam_below'  => $this->lang->line('select_your_exam_below'),
                    'why_choose_us'           => $this->lang->line('why_choose_us'),
                    'get_event'               => $this->lang->line('get_event'),
                    'our_student_says'        => $this->lang->line('our_student_says'),
                    'latest_blog'             => $this->lang->line('latest_blog'),
                    'our_success'             => $this->lang->line('our_success'),
                    'about_us'                => $this->lang->line('about_us'),
                    'privacy_policy'          => $this->lang->line('privacy_policy'),
                    'terms_condition'         => $this->lang->line('terms_condition'),
                    'faqs'                    => $this->lang->line('faqs'),
                    'search'                  => $this->lang->line('search'),
                    'courses'                 => $this->lang->line('courses'),
                    'students'                => $this->lang->line('students'),
                    'graduate_students'       => $this->lang->line('graduate_students'),
                    'awards'                  => $this->lang->line('awards'),
                    'english'                 => $this->lang->line('english'),
                    'hindi'                   => $this->lang->line('hindi')
        );
      }else{
          $resp = array(
                'code'    => 'ERROR',
                'message' => 'Invalid Language Code'
            );
         $this->response($resp);
         return false;
      }
     
      if (!empty($data)){
          $resp = array(
                'code'          => 'SUCCESS',
                'message'       => 'SUCCESS',
                'response'      => array(
                'headings'      => $data
                )
            );
      }else{
          $resp = array(
                'code'    => 'ERROR',
                'message' => 'No Heading Found'
            );
      }
          $this->response($resp);
    }

    function dateDiff($time1, $time2, $precision = 6) {
    // If not numeric then convert texts to unix timestamps
      if (!is_int($time1)) {
        $time1 = strtotime($time1);
      }
      if (!is_int($time2)) {
        $time2 = strtotime($time2);
      }

      // If time1 is bigger than time2
      // Then swap time1 and time2
      if($time1 > $time2) {
        $ttime = $time1;
        $time1 = $time2;
        $time2 = $ttime;
      }

      // Set up intervals and diffs arrays
      $intervals = array('year','month','day','hour','minute','second');
      $diffs = array();

      // Loop thru all intervals
      foreach ($intervals as $interval) {
        // Create temp time from time1 and interval
        $ttime = strtotime('+1 ' . $interval, $time1);
        // Set initial values
        $add = 1;
        $looped = 0;
        // Loop until temp time is smaller than time2
        while ($time2 >= $ttime) {
          // Create new temp time from time1 and interval
          $add++;
          $ttime = strtotime("+" . $add . " " . $interval, $time1);
          $looped++;
        }
   
        $time1 = strtotime("+" . $looped . " " . $interval, $time1);
        $diffs[$interval] = $looped;
        }
        
        $count = 0;
        $times = array();
        // Loop thru all diffs
        foreach ($diffs as $interval => $value) {
          // Break if we have needed precission
          if ($count >= $precision) {
            break;
          }
          // Add value and interval 
          // if value is bigger than 0
          if ($value > 0) {
            // Add s if value is not 1
            if ($value != 1) {
              $interval .= "s";
            }
            // Add value and interval to times array
            $times[] = $value . " " . $interval;
            $count++;
          }
        }

        // Return string with times
        return implode(", ", $times);
      }


      /*register User*/
      public function save_notes_post(){
        $pdata = file_get_contents("php://input");
        $data  = json_decode($pdata,true);
         
        $required_parameter = array('user_id','post_id');
        $chk_error          = $this->controller->check_required_value($required_parameter, $data);
        if ($chk_error) 
        {
             $resp = array('code' => 'MISSING_PARAM', 'message' => 'Missing ' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }

        $user_id     = $data['user_id'];
        $post_id     = $data['post_id'];
      
        $data = array(
            'user_id'        => $user_id,
            'post_id'        => $post_id,
            'is_active'      => 1,
            'created_at'     => date('Y-m-d H:i:s')
                );

        $data = $this->model->insertData('save_notes', $data);
       
        if(!empty($data)){
            $resp = array('code' => 'SUCCESS', 'message' => 'Post Added To Notes');   
        }else{
            $resp = array('code' => 'ERROR', 'message' => 'FAILURE','response' => array('message' => 'Post Not Added '));
        }
            $this->response($resp);
      } 


      public function delete_notes_post(){
        $pdata = file_get_contents("php://input");
        $data  = json_decode($pdata,true);
         
        $required_parameter = array('user_id','post_id');
        $chk_error = $this->controller->check_required_value($required_parameter, $data);
        if ($chk_error) 
        {
             $resp = array('code' => 'MISSING_PARAM', 'message' => 'Missing ' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }

        $user_id     = $data['user_id'];
        $post_id     = $data['post_id'];
        $where2      =  array(
                'user_id' => $user_id,
                'post_id' => $post_id    

            );
        $data = $this->model->delete('save_notes', $data);
        
        if($data){
            $resp = array('code' => 'SUCCESS', 'message' => 'Post Deleted from Notes');   
        }else{
            $resp = array('code' => 'ERROR', 'message' => 'FAILURE','response' => array('message' => 'Post Not Deleted '));
        }
            $this->response($resp);
      }

      public function post_likes_post(){
        $pdata = file_get_contents("php://input");
        $data  = json_decode($pdata,true);
         
        $required_parameter = array('user_id','post_id');
        $chk_error = $this->controller->check_required_value($required_parameter, $data);
        if ($chk_error) 
        {
             $resp = array('code' => 'MISSING_PARAM', 'message' => 'Missing ' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }

        $user_id     = $data['user_id'];
        $post_id     = $data['post_id'];
      
        $data = array(
            'user_id'        => $user_id,
            'post_id'        => $post_id,
            'is_active'      => 1,
            'created_at'     => date('Y-m-d H:i:s')
                );

        $data = $this->model->insertData('post_likes', $data);
       
        if(!empty($data)){
            $resp = array('code' => 'SUCCESS','message' => 'Like Added To Post');   
        }else{
            $resp = array('code' => 'ERROR', 'message' => 'FAILURE','response' => array('message' => 'like Not Added '));
        }
            $this->response($resp);
      } 

      public function delete_like_post(){
        $pdata = file_get_contents("php://input");
        $data  = json_decode($pdata,true);
         
        $required_parameter = array('user_id','post_id');
        $chk_error = $this->controller->check_required_value($required_parameter, $data);
        if ($chk_error) 
        {
             $resp = array('code' => 'MISSING_PARAM', 'message' => 'Missing ' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }

        $user_id     = $data['user_id'];
        $post_id     = $data['post_id'];
        $where2 =  array(
                'user_id' => $user_id,
                'post_id' => $post_id    

            );
        $data = $this->model->delete('post_likes', $data);
        
        if($data){
            $resp = array('code' => 'SUCCESS', 'message' => 'like Removed from Post');   
        }else{
            $resp = array('code' => 'ERROR', 'message' => 'FAILURE','response' => array('message' => 'Like Not Deleted '));
        }
            $this->response($resp);
      }

      public function post_comment_post(){
        $pdata = file_get_contents("php://input");
        $data  = json_decode($pdata,true);
         
        $required_parameter = array('user_id','post_id','comment');
        $chk_error = $this->controller->check_required_value($required_parameter, $data);
        if ($chk_error) 
        {
             $resp = array('code' => 'MISSING_PARAM', 'message' => 'Missing ' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }

        $user_id     = $data['user_id'];
        $post_id     = $data['post_id'];
        $comment     = $data['comment'];
        $comment_id  =@$data['comment_id'];
        $data = array(
            'user_id'        => $user_id,
            'post_id'        => $post_id,
            'comment'        => $comment,
            'comment_id'     => $comment_id,
            'is_active'      => 1,
            'created_at'     => date('Y-m-d H:i:s')
                );

        $data = $this->model->insertData('post_comment', $data);
       
        if(!empty($data)){
            $resp = array('code' => 'SUCCESS','message' => 'Comment Added To Post');   
        }else{
            $resp = array('code' => 'ERROR', 'message' => 'FAILURE','response' => array('message' => 'Comment Not Added '));
        }
            $this->response($resp);
      }

      public function get_comment_get(){
        $post_id = $this->input->get('id');

        $site_url = base_url();

        $data = $this->model->getAllwhere('post_comment','comment_id IS  NULL');
        
        $sub_comment = [];
        foreach ($data as $key => $value) {
          
          $where           = array(
            'comment_id'   => $value->id
          );
          $sub_comment[$key]['comment']=$value; 
          
            
          $user_id   = $sub_comment[$key]['comment']->user_id;

          $where2    = array(

                    'users.is_active'  => 1,

                    'users.id'         => $user_id

                );
           $user      = $this->model->getAllwhere('users',$where2,'id,first_name,last_name,CONCAT("'.$site_url.'","asset/uploads/",profile_pic)AS image,address');

           @$value->first_name = $user[0]->first_name;
           @$value->last_name  = $user[0]->last_name;
           @$value->image      = $user[0]->image;
           
           $sub_comment[$key]['comment']->sub_comment = $this->model->getAllwhere('post_comment',$where);

           $user_ids  = $sub_comment[$key]['comment']->sub_comment[0]->user_id;

           $where3    = array(

                    'users.is_active'  => 1,

                    'users.id'         => $user_ids

                );
           $user1      = $this->model->getAllwhere('users',$where3,'id,first_name,last_name,CONCAT("'.$site_url.'","asset/uploads/",profile_pic)AS image,address');
            //echo $this->db->last_query();
           @$sub_comment[$key]['comment']->sub_comment[0]->first_name = $user1[0]->first_name;
           @$sub_comment[$key]['comment']->sub_comment[0]->last_name  = $user1[0]->last_name;
           @$sub_comment[$key]['comment']->sub_comment[0]->image      = $user1[0]->image;
           
           
         }
         echo "<pre>";
         print_r($sub_comment);
      }

      public function get_news_by_id_get(){
        $news_id = $this->input->get('id');
        $site_url =base_url();
        $fields  ='id,title,news_description,CONCAT("'.$site_url.'","asset/uploads/",news_image)AS news_image,news_url,category';
        $where           = array(
            'is_active'  => 1,
            'id'         => $news_id
          );
        $data = $this->model->getAllwhere('news',$where,$fields);

        if (!empty($data)) 
        {
          $resp = array(
                'code'        => 'SUCCESS',
                'message'     => 'SUCCESS',
                'response'    => array(
                'news'        => $data,
                'recent_news' => $data
               
                )
            );
        }else{
          $resp = array(
                'code'    => 'ERROR',
                'message' => 'FAILURE'
            );
        }
        $this->response($resp);
      }


      /*Get User Profile By User Id*/
    public function get_profiles_get(){
       $id       = $this->input->get('id');
       $site_url = base_url();
       $where    = array(

                    'users.is_active'  => 1,

                    'users.id'         => $id

                );
      $data      = $this->model->getAllwhere('users',$where,'id,first_name,last_name,CONCAT("'.$site_url.'","asset/uploads/",profile_pic)AS image,address');

      $where1    = array(

                    'post.is_active'  => 1,

                    'post.added_by'   => $id

                );
      $fields='post.en_post,post.id,post.chapter_id,post.super_submenu_id,post.type,post.added_by,CONCAT("'.$site_url.'","asset/uploads/",image)AS image,post.created_at';
      $data1 = $this->model->getAllwhere('post',$where1,$fields);

      $where2    =   array(

                    'save_notes.is_active'  => 1,

                    'save_notes.user_id'    => $id,
  

                );

      $notes =  $this->model->GetJoinRecord('save_notes', 'post_id', 'post', 'id', $fields,$where2);

      if(!empty($notes)){
        foreach ($notes as $key => $value) {
          $times = explode(",",$this->dateDiff($value->created_at,date('Y-m-d H:i:s')));
          
          $notes[$key]->duration=$times[0];


          $where3   = array(
            'user_id'  => $id,
            'post_id'  => $value->id
        );

        $check = $this->model->getAllwhere('post_likes', $where3);

          if(!empty($check)){
           $value->like =  true;
                 
          }else{
            $value->like = false; 
          
          }
        $count = $this->model->getAllwhere('post_likes',array('post_id' => $value->id),'COUNT(id)  as Likes_count');
          if($count[0]->Likes_count!=0){
             $value->like_count = $count[0]->Likes_count;
          }else{
             $value->like_count = 0;         
          }

          $where = array('post_id' => $value->id,'comment_id'=>NULL);

          $comment = $this->model->getAllwhere('post_comment',$where);
            
        $sub_comment = '';
        foreach ($comment as $ckey => $cvalue) {
          
          $where           = array(
            'comment_id'   => $cvalue->id
          );
          $sub_comment[$ckey]=$cvalue; 
          
            
          $user_id   = $sub_comment[$ckey]->user_id;

          $where2    = array(

                    'users.is_active'  => 1,

                    'users.id'         => $user_id

                );
           $user      = $this->model->getAllwhere('users',$where2,'id,first_name,last_name,CONCAT("'.$site_url.'","asset/uploads/",profile_pic)AS image,address');

           @$cvalue->first_name = $user[0]->first_name;
           @$cvalue->last_name  = $user[0]->last_name;
           @$cvalue->image      = $user[0]->image;
           
           $sub_comment[$ckey]->sub_comment = $this->model->getAllwhere('post_comment',$where);

           
           $id = @$sub_comment[$ckey]->sub_comment[0]->user_id;
           $user_ids  =$id;

           $where3    = array(

                    'users.is_active'  => 1,

                    'users.id'         => $user_ids

                );
           $user1      = $this->model->getAllwhere('users',$where3,'id,first_name,last_name,CONCAT("'.$site_url.'","asset/uploads/",profile_pic)AS image,address');
            //echo $this->db->last_query();
           @$sub_comment[$ckey]->sub_comment[0]->first_name = $user1[0]->first_name;
           @$sub_comment[$ckey]->sub_comment[0]->last_name  = $user1[0]->last_name;
           @$sub_comment[$ckey]->sub_comment[0]->image      = $user1[0]->image;
           
           
         }

          if(!empty($sub_comment)){
            $notes[$key]->comment = $sub_comment;
          }else{
             $notes[$key]->comment = null;
          }
        }
      }
       
      
      if(!empty($data1)){
      foreach ($data1 as $key => $value) {
          $times = explode(",",$this->dateDiff($value->created_at,date('Y-m-d H:i:s')));
          
          $data1[$key]->duration=$times[0];

          $select2 = 'save_notes.id';
          $where2 =  array(
                  'save_notes.user_id' => $id,
                  'save_notes.post_id' => $value->id     

              );
          $note=$this->model->GetJoinRecord('save_notes', 'post_id', 'post', 'id', $select2,$where2);
         
          if(!empty($note)){
            $value->notes  = true;
          }else{
             $value->notes = false;
          }

          $where3   = array(
              'user_id'  => $id,
              'post_id'  => $value->id
          );

          $check = $this->model->getAllwhere('post_likes', $where3);
       
          if(!empty($check)){
           $value->like       =  true;
          // $value->like_count =  $check[0]->Likes_count;       
          }else{
            $value->like       = false;
            //$value->like_count = 0;          
          }
          $count = $this->model->getAllwhere('post_likes',array('post_id' => $value->id),'COUNT(id)  as Likes_count');
          if($count[0]->Likes_count!=0){
             $value->like_count = $count[0]->Likes_count;
          }else{
             $value->like_count = 0;         
          }

          /*Comment Section*/
           $where = array('post_id' => $value->id,'comment_id'=>NULL);
           $comment = $this->model->getAllwhere('post_comment',$where);

          $sub_comment = [];
          foreach ($comment as $ckey => $cvalue) {
            
            $where           = array(
              'comment_id'   => $cvalue->id
            );
            $sub_comment[$ckey]=$cvalue; 
            
              
            $user_id   = $sub_comment[$ckey]->user_id;

            $where2    = array(

                      'users.is_active'  => 1,

                      'users.id'         => $user_id

                  );
             $user      = $this->model->getAllwhere('users',$where2,'id,first_name,last_name,CONCAT("'.$site_url.'","asset/uploads/",profile_pic)AS image,address');

             @$cvalue->first_name = $user[0]->first_name;
             @$cvalue->last_name  = $user[0]->last_name;
             @$cvalue->image      = $user[0]->image;
             
             $sub_comment[$ckey]->sub_comment = $this->model->getAllwhere('post_comment',$where);

             
             $id = @$sub_comment[$ckey]->sub_comment[0]->user_id;
             $user_ids  =$id;

             $where3    = array(

                      'users.is_active'  => 1,

                      'users.id'         => $user_ids

                  );
             $user1      = $this->model->getAllwhere('users',$where3,'id,first_name,last_name,CONCAT("'.$site_url.'","asset/uploads/",profile_pic)AS image,address');
              //echo $this->db->last_query();
             @$sub_comment[$ckey]->sub_comment[0]->first_name = $user1[0]->first_name;
             @$sub_comment[$ckey]->sub_comment[0]->last_name  = $user1[0]->last_name;
             @$sub_comment[$ckey]->sub_comment[0]->image      = $user1[0]->image;
             
             
          }

          if(!empty($sub_comment)){
              $data1[$key]->comment = $sub_comment;
          }else{
               $data1[$key]->comment = null;
          }

           /*Comment Section Ends*/

          /*$where       = array(
                  'id' => $value->chapter_id
              );
              
          $select        = 'en_chapter_name';
          $chapter_name  = $this->model->getAllwhere('chapters', $where, $select);

          $data1[$key]->chapter_name = $chapter_name[0]->en_chapter_name;
         
          $where1      = array(
                  'id' => $value->super_submenu_id
              );
              
          $select1    = 'en_super_sub_menu';
          $menu_name  = $this->model->getAllwhere('super_sub_menu', $where1, $select1);
          $data1[$key]->super_sub_menu = $menu_name[0]->en_super_sub_menu;*/
        }
      }
      if (!empty($data)) 
      {
        $resp = array(
                'code'      => 'SUCCESS',
                'message'   => 'SUCCESS',
                'response'  => array(
                'User'      => $data,
                'Post'      => $data1,
                'Notes'     => $notes,

                )
            );
      }else{
        $resp = array(
                'code'    => 'ERROR',
                'message' => 'FAILURE'
            );
      }
        $this->response($resp);
    }

    public function get_modules_id_get(){
      $id       = $this->input->get('id');
      $lang     = $this->input->get('lang');
      $site_url = base_url();
      if($lang==='en' || $lang==null){
        $fields='id,en_module_name as module_name, CONCAT("'.$site_url.'","asset/uploads/",image)AS image';
      }else if($lang==='hi'){
        $fields='id,hi_module_name as module_name,CONCAT("'.$site_url.'","asset/uploads/",image)AS image';
      }else{
         $resp = array(
                'code'    => 'ERROR',
                'message' => 'Invalid Language Code'
            );
         $this->response($resp);
         return false;
      }  
       $where           = array(
            'is_active'  => 1
      );
      $data = $this->model->getAllwhere('modules',$where,$fields);

       

        foreach ($data as $key => $value) {
           $where1    = array(

                      'users.is_active'  => 1,

                      'users.id'         => $id,

                      "FIND_IN_SET('$value->id',module_id) !="=> 0


                  );
          
          $module_id    = $this->model->getAllwhere('users',$where1,'module_id');
          if(!empty($module_id)){
             $value->selected =true;
          }else{
             $value->selected =false;
          }
        }

     if (!empty($data)) 
      {
        $resp = array(
                'code'      => 'SUCCESS',
                'message'   => 'SUCCESS',
                'response'  => array(
                'Modules'   => $data
                )
            );
      }else{
        $resp = array(
                'code'    => 'ERROR',
                'message' => 'FAILURE'
            );
      }
        $this->response($resp);
   }

   public function check_module_post(){
        $pdata = file_get_contents("php://input");
        $data  = json_decode($pdata,true);
       
        $user_id    = $data['user_id'];
        $module_id  = $data['module_id'];
        
        $required_parameter = array('user_id','module_id');
        $chk_error = $this->controller->check_required_value($required_parameter, $data);
        if ($chk_error) 
        {
             $resp = array('code' => MISSING_PARAM, 'message' => 'Missing ' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }

        $where           = array(
            'id'  => $user_id
        );

        $where1    = array(

                      'users.is_active'  => 1,

                      'users.id'         => $user_id

                  );
        
        $module_ids   = $this->model->getAllwhere('users',$where1,'module_id');
          $result = '';
          if(!empty($module_ids[0]->module_id)){
            $id = explode(",",$module_ids[0]->module_id);
              foreach ($id as $key => $value) {
              if($value != $module_id){
               array_push($id,$module_id);
               break;
              }
            }
            $insertData= implode(",", array_unique($id));
            $data = array(
              'module_id' => $insertData
            );
            $result = $this->model->updateFields('users', $data, $where);
          }else{
             $data = array(
              'module_id' => $module_id
            );

            $result = $this->model->updateFields('users', $data, $where);
          }
            if (!empty($result)) 
            {
            $resp = array(
                    'code'      => 'SUCCESS',
                    'message'   => 'Modules Added Successfully'
                    
                    
                );
            }else{
            $resp = array(
                    'code'    => 'ERROR',
                    'message' => 'FAILURE'
                );
            }
      $this->response($resp);
   }

   public function uncheck_module_post(){
        $pdata = file_get_contents("php://input");
        $data  = json_decode($pdata,true);
       
        $user_id    = $data['user_id'];
        $module_id  = $data['module_id'];
        
        $required_parameter = array('user_id','module_id');
        $chk_error = $this->controller->check_required_value($required_parameter, $data);
        if ($chk_error) 
        {
             $resp = array('code' => MISSING_PARAM, 'message' => 'Missing ' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }

        $where           = array(
            'id'  => $user_id
        );

        $where1    = array(

                      'users.is_active'  => 1,

                      'users.id'         => $user_id

                  );
        
        $module_ids   = $this->model->getAllwhere('users',$where1,'module_id');
          $result = '';
        if(!empty($module_ids[0]->module_id)){
            $id = explode(",",$module_ids[0]->module_id);
              foreach ($id as $key => $value) {
              if($value == $module_id){
               unset($id[$key]);
               break;
              }
            }
            $insertData= implode(",", array_unique($id));
            $data = array(
              'module_id' => $insertData
            );
              $result = $this->model->updateFields('users', $data, $where);
              if (!empty($result)) 
              {
                $resp = array(
                    'code'      => 'SUCCESS',
                    'message'   => 'Modules Removed Successfully'
                    
                    
                );
              }else{
                $resp = array(
                    'code'    => 'ERROR',
                    'message' => 'FAILURE'
                );
              }
          $this->response($resp);
        }

   }
}
?>