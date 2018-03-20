<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions

require APPPATH . '/libraries/REST_Controller.php';



class Api extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    /*
    Users signup service
    */
    
    public function get_modules_post()
    {
        $data = $this->model->getAll('modules');
        if (!empty($data)) {
            $resp = array(
                'code' => SUCCESS,
                'message' => 'SUCCESS',
                'response' => array(
                    'modules' => $data
                )
            );
        } else {
            $resp = array(
                'code' => ERROR,
                'message' => 'FAILURE'
            );
        }
        $this->response($resp);
    }
    
    public function get_chapters_post()
    {
        $data = $this->model->getAll('chapters');
        if (!empty($data)) {
            $resp = array(
                'code' => SUCCESS,
                'message' => 'SUCCESS',
                'response' => array('chapters' => $data)
            );
        } else {
            $resp = array(
                'code' => ERROR,
                'message' => 'FAILURE'
            );
        }
        $this->response($resp);
    }
    
    public function get_posts_post()
    {
        $data = $this->model->getAll('post');
        if (!empty($data)) {
            $resp = array(
                'code' => SUCCESS,
                'message' => 'SUCCESS',
                'response' => array(
                    'post' => $data
                )
            );
        } else {
            $resp = array(
                'code' => ERROR,
                'message' => 'FAILURE'
            );
        }
        $this->response($resp);
    }
    
    public function get_questions_post()
    {
        $data = $this->model->getAll('questions');
        if (!empty($data)) {
            $resp = array(
                'code' => SUCCESS,
                'message' => 'SUCCESS',
                'response' => array(
                    'questions' => $data
                )
            );
        } else {
            $resp = array(
                'code' => ERROR,
                'message' => 'FAILURE'
            );
        }
        $this->response($resp);
    }
    
    
    public function get_exams_post()
    {
        $data = $this->model->getAll('exam');
        if (!empty($data)) {
            $resp = array(
                'code' => SUCCESS,
                'message' => 'SUCCESS',
                'response' => array(
                    'exam' => $data
                )
            );
        } else {
            $resp = array(
                'code' => ERROR,
                'message' => 'FAILURE'
            );
        }
        $this->response($resp);
    }
    
    public function get_settings_post()
    {        
        $data = $this->model->getAll('settings');
        if (!empty($data)) {
            $resp = array(
                'code' => SUCCESS,
                'message' => 'SUCCESS',
                'response' => array(
                    'settings' => $data
                )
            );
        } else {
            $resp = array(
                'code' => ERROR,
                'message' => 'FAILURE'
            );
        }
        $this->response($resp);
    }
}


      /*verify login*/
      public function verify_login_post()
      {

        $username  = $this->get('username');
        $password  = $this->get('password');

        $where           = array(
                    
                    "username = ".$username." or email=".$username,
                    'password'  => md5($password),
                    'is_active' => 1
                );
        $data = $this->model->getAllwhere('users', $where);
       
           if(!empty($data)){
               $resp = array('code' => 'SUCCESS', 'message' => 'SUCCESS', 'response' => array('user' => $data));   
            }else{
               $resp = array('code' => 'ERROR', 'message' => 'Wrong Crediantials');
            }
              $this->response($resp);
      }

      /*register User*/
      public function register_post()
      {
                
          $first_name  = $this->input->post('first_name');
          $user_name   = $this->input->post('user_name');
          $last_name   = $this->input->post('last_name');
          $email       = $this->input->post('email');
          $password    = $this->input->post('password');
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
                  'username'       => $user_name,
                  'email'          => $email,
                  'password'       => MD5($password),
                  'address'        => $address,
                  'phone_no'       => $phone_no,
                  'mobile'         => $mobile_no,
                  'date_of_birth'  => $dob,
                  'gender'         => $gender,
                  'blood_group'    => $blood_group,
                  'is_active'      => $status,
                  'user_role'      => 3,
                  'created_at'     => date('Y-m-d H:i:s')
                );
               /* if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                    $count = count($_FILES['image']['name']);
                    for ($i = 0; $i < $count; $i++) {
                        if ($_FILES['image']['error'][$i] == 0) {
                            if (move_uploaded_file($_FILES['image']['tmp_name'][$i], 'asset/uploads/' . $_FILES['image']['name'][$i])) {
                                $data['profile_pic'] = $_FILES['image']['name'][$i];
                            }
                        }
                    }
                }*/
          $result = $this->model->insertData('users', $data);
          if(!empty($data)){
              $resp = array('code' => 'SUCCESS', 'message' => 'User Registrered Successfully');   
          }else{
              $resp = array('code' => 'ERROR', 'message' => 'FAILURE');
          }
              $this->response($resp);
      } 

      /*Change Password*/
      public function changePassword_post()
      {

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
      public function getProfile_get()
      {

        $user_id      = $this->input->get('user_id');
       
        $where       = array(
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
      public function updateProfile_post()
      {

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
       public function getMenuByModule_get()
      {

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
      public function getSubMenuByMenu_get()
      {

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

      public function getquestionbychapter_get()
      {
         $chapter_id      = $this->input->get('chapter_id');
         $where        = array(
                    'is_active'  => 1,
                    'chapter_id' => $chapter_id
                );
        $data = $this->model->getAllwhere('exam',$where);
       

      }
}
?>