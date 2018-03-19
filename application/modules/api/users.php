<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions

require base_url('/libraries/REST_Controller.php');

class Users extends REST_Controller 

{   
    function __construct() {
      parent::__construct();
    }
    /*
     Users signup service
    */


    public function signup_post() {
           
        /* Check for required parameter */
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        //$data = $_POST;
        $object_info = $data;

        $required_parameter = array('user_mobile','device_id','device_type','fcm_token');
        $chk_error = check_required_value($required_parameter, $data);
        if ($chk_error) {
             $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }
        
        $data['added_date'] = date('Y-m-d H:i:s');
        /* Check for email */
         $user_mobile = $this->common_model->getRecordCount('users_master', array('user_mobile' => $data['user_mobile']));

         if($user_mobile > 0) {
            $updateArr = array('device_id' => $data['device_id'],'device_type' => $data['device_type'],'fcm_token' => $data['fcm_token']);
            $condition = array('user_mobile' => $data['user_mobile']);//die;
            $this->common_model->updateRecords('users_master', $updateArr, $condition);
             $userData = $this->common_model->getSingleRecordById('users_master', array('user_mobile' =>$data['user_mobile']));
            $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('user_data' => $userData));
             $this->response($resp);
         }else{
        $userId = $this->common_model->addRecords('users_master', $data);
        }
        if($userId) {        
            /* Get user data */
            $otp= rand(1000,9999);
            $data_mobile= array('otp_number'=>$otp,'otp_status'=>0,'user_id'=>$userId);
            $data_mobile['added_date'] = date('Y-m-d H:i:s');
            //$response= $this->smsapi($otp,$data['user_mobile']);
            $otplink = "http://control.textlab.in/index.php/smsapi/httpapi/?uname=posh1993&password=posh@123&sender=Poshsu&receiver=".$data['user_mobile']."&route=TA&msgtype=1&sms=".$otp."";

            $otp_id = $this->common_model->addRecords('user_otp_master',$data_mobile);
            $userData = $this->common_model->getSingleRecordById('users_master', array('user_id' => $userId));
            $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('user_data' => $userData, 'otp' => $otplink , 'otp_number' => $otp));
        } else {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' => 'Some error occured, please try again.'));
        }
        @$this->response($resp);
    
    }

    /*
     Users login service
    */

    public function login_post() {
        /* Check for required parameter */
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;
        $required_parameter = array('email', 'password');
        $chk_error = check_required_value($required_parameter, $object_info);
        if ($chk_error) {
             $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }

        /* Check for email */
        $check_email = $this->common_model->getRecordCount(USER, array('email' => $data['email']));
        if($check_email == 0) {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'EMAIL_IS_NOT_EXISTS', 'error_label' => 'This email is not exists in our database.'));
            @$this->response($resp);
        }

        $check_login = $this->common_model->getSingleRecordById(USER, array('email' => $data['email'], 'password' => MD5($data['password'])));
        if ($check_login['userrole'] == '3') {  
            $listingData = $this->common_model->getSingleRecordpById('listing', array('user_id' => $check_login['id']));
            $cons = array('salon_id' => $listingData['salon_id']);
            $imgArr = $this->common_model->getAllRecordsById('listing_images',$cons);
            $check_login["profile_status"] = 1;
            
            if(empty($listingData))
            {
                $check_login["profile_status"] = 0;
            }
        }
        $path = base_url().'uploads/';
        if(!empty($listingData)){
            /*array_combine(keys, values);
            array_merge(array1);*/
            $checkLogin = array_merge($check_login,$listingData,$imgArr);
        }
        else{
            $checkLogin = $check_login;
        }
        if(!empty($check_login)) {
            $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('user_data' => $checkLogin,'img_url'=> IMG_URL));
        } else {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'INVALID_DETAILS', 'error_label' => 'Email OR Password is not correct, please try again.'));
        }
        @$this->response($resp);
    
    }

    /*verify otp*/
    public function verifyotp_post() {
        /* Check for required parameter */
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;
        $required_parameter = array('user_id','otp_number');
        $chk_error = check_required_value($required_parameter, $object_info);
      	if($chk_error) {
             $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' =>'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param'])));
             $this->response($resp);
        }
        $condition = array('user_id' => $data['user_id'],'otp_number' => $data['otp_number']);
        $result=$this->common_model->getSingleRecordById('user_otp_master',$condition);
        $resultuser=$this->common_model->getSingleRecordById('users_master',array('user_id' => $data['user_id']));
        if(!empty($result))
        {
            $updateArr = array('otp_status' => 1);
            $updateArr2 = array('mobile_veryfy' => 1,'user_status' => 1);
            $condition2 = array('user_id' => $data['user_id']);//die;
            $this->common_model->updateRecords('users_master', $updateArr2, $condition2);
            $this->common_model->updateRecords('user_otp_master', $updateArr, $condition);
            $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('message' => "Your Otp Password has been verified"));
        }
        else
        {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'otp_not_match', 'error_label' =>'Your Otp Password do not verified.'));
        }
        $this->response($resp);  
    
    }

    /*
    * Social Login and sign up
    */

    public function social_post() {

        /* Check for required parameter */
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;
        $required_parameter = array('connected_via', 'firstname','lastname','email','device_type','device_id','device_token');
        $chk_error = check_required_value($required_parameter, $object_info);
        if($chk_error) {
             $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
             $this->response($resp);
        }
        /* Check for user */

        if($data['connected_via'] == 'facebook') {
            $checkUser = $this->common_model->getSingleRecordById(USER, array('facebook_token' => $data['device_token']));
        } elseif($data['connected_via'] == 'google') {
            $checkUser = $this->common_model->getSingleRecordById(USER, array('google_token' => $data['device_token']));
        } 
         else {
            $resp = array('code' => ERROR, 'message' => 'ERROR', 'response' => 'INVALID_SOCIAL_TYPE');
            $this->response($resp);
        }
           $device_type = isset($data['device_type']) ? $data['device_type'] : '';
           $device_id   = isset($data['device_id']) ? $data['device_id'] : '';
           $device_token = isset($data['device_token']) ? $data['device_token'] : '';
           $imageurl = isset($data['imgurl']) ? $data['imgurl'] : '';
        if(!empty($checkUser['id'])) {
           /* Proced to login */
           $condition = array('id' => $checkUser['id']);  
           $updateArr = array('firstname'=>$data['firstname'],'lastname'=>$data['lastname'],'device_type'=>$device_type,'device_id'=> $device_id,'device_token'=>$device_token, 'image' => $imageurl);             
           $this->common_model->updateRecords(USER, $updateArr, $condition);
           /* Proced to login */
           $userData = $this->common_model->getSingleRecordById(USER, array('id' => $checkUser['id']));
           $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('user_data' => $userData));
           $this->response($resp); 
        } else {
            $checkEmail = $this->common_model->getSingleRecordById(USER, array('email' => $data['email']));
            if(!empty($checkEmail['id'])) {
               $condition = array('id' => $checkEmail['id']);
               /* Proced to login */
               $update_device_data = array('firstname'=>$data['firstname'],'lastname'=>$data['lastname'],'device_type'=>$device_type,'device_id'=> $device_id , 'device_token'=>$device_token );            
               $this->common_model->updateRecords(USER, $update_device_data, $condition);
                /* Proced to login */
                /* Update user social ids */          
                $updateArr = array(
                    'facebook_token' => ($data['connected_via'] == 'facebook') ? $data['social_id'] : '',
                    'google_token' => ($data['connected_via'] == 'google') ? $data['social_id'] : ''
                 );

                $this->common_model->updateRecords(USER, $updateArr, $condition);
                /* Proceed to login */
                $userData = $this->common_model->getSingleRecordById(USER, array('id' => $checkEmail['id']));
                $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('user_data' => $userData));
                $this->response($resp);
                } else {
                /* create User */
                $postData = array(
                    'facebook_token' => ($data['connected_via'] == 'facebook') ? $data['social_id'] : '',
                    'google_token' => ($data['connected_via'] == 'google') ? $data['social_id'] : '',
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'email' => $data['email'],
                    'device_type'=>$device_type,
                    'device_id'=> $device_id , 
                    'device_token'=>$device_token,
                    'image' => $imageurl,
                    'createdate' => date('Y-m-d H:i:s')
                 );
                $userId = $this->common_model->addRecords(USER, $postData);
                if($userId) {
                    /* Get user data */
                    $userData = $this->common_model->getSingleRecordById(USER, array('id' => $userId));
                    $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('user_data' => $userData));
                } else {
                    $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'SERVER_ERROR', 'error_label' => 'Some error ocured, please try again again later.'));
                }
                /* Return Response */
                $this->response($resp);
            }
        }
    
    }
    /**
    * Login Process
    */ 
    public function processLogin($userId, $data) {
        /* Get user data */
        $userData = $this->common_model->getSingleRecordById(USER, array('user_id' => $userId));
        $userData['profile_pic_url'] = (!empty($userData['profile_pic'])) ? base_url().USER_UPLOAD_PATH.$userData['profile_pic'] : '';
        /* Update user login information */
        $deviceArr = array(
            'user_id' => $userId,
            'device_type' => $data['device_type'],
            'device_id' => $data['device_id'],
            'device_token' => $data['device_token'],
            'login_ip' => $this->input->ip_address(),
            'login_time' => date('Y-m-d H:i:s')
        );
        $this->common_model->addRecords(USER_LOGIN, $deviceArr);
        $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('user_data' => $userData));
        $this->response($resp);
   
    }

    /**
    * Forgot password
    */  

    public function forgot_password_post() {
        /* Check for required parameter */
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;
        $required_parameter = array('email');
        $chk_error = check_required_value($required_parameter, $object_info);
        if ($chk_error) {
             $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
             $this->response($resp);
        }
        /* Check for email */
        $check_email = $this->common_model->getRecordCount(USER, array('email' => $data['email']));
        if($check_email == 0) {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'EMAIL_IS_NOT_EXISTS', 'error_label' => 'This email is not exists in our database.'));
            $this->response($resp);
        }
        /* Get user info */
        $userData = $this->common_model->getSingleRecordById(USER, array('email' => $data['email']));
        $password_reset_key = substr(md5(time()),rand(7,9),rand(15,25));
        /* Update password reset key on user info */
        $condition = array('email' => $userData['email']);
        $updateArr = array('password_reset_key' => $password_reset_key);
        $this->common_model->updateRecords(USER, $updateArr, $condition);
        /* Return response */
        $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('password_reset_key' => $password_reset_key, 'user_data' => $userData)); 
        $this->response($resp);
    
    }
    /**
    * Change password
    */ 
    public function changepassword_post() {
        /* Check for required parameter */
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;
        $required_parameter = array('id', 'old_password', 'new_password');
        $chk_error = check_required_value($required_parameter, $object_info);
        if ($chk_error) {
            $resp = array('code' => MISSING_PARAM, 'message' => 'FAILURE',"response" => array("error" => "MISSED_A_PARAMETER","error_label"=> 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param'])));
            $this->response($resp);
        }
        $user_id = $data["id"];
        $old_password = md5($data["old_password"]);
        $new_password = md5($data["new_password"]);
        $userData = $this->common_model->getSingleRecordById('users', array('id' => $user_id));
        if(empty($userData))
        {
            $resp = array('code' => ERROR, 'message' => 'Invalid User Id');
            $this->response($resp);   
        }else if($userData["password"] != $old_password)
        {
            $resp = array('code' => ERROR, 'message' => 'Invalid Old Password');
            $this->response($resp); 
        }
        $this->common_model->updateRecords('users', array("password" => $new_password), array("id" => $user_id));
        /* Response array */
        $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('success' => 'PASSWORD_CHANGED', 'success_label' => 'Password changed successfully.'));
        $this->response($resp);
    
    }

    /**
    * Edit Profile
    */
    public function updateprofile_post() {
        /* Check for required parameter */
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;
        $required_parameter = array('user_id','user_fname','user_lname','user_email','user_role');
        $chk_error = check_required_value($required_parameter, $object_info);
        if ($chk_error) {
             $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
             $this->response($resp);
        }
        $data['edited_date'] = date('Y-m-d H:i:s');
         /* Check for valid user */
        $check_email = $this->common_model->getRecordCount('users_master', array('user_id' => $data['user_id']));
           if($check_email == 0) {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'USER_IS_NOT_EXISTS', 'error_label' => 'This user is not exists in our database.'));
            $this->response($resp);
           }   
           $uid = $data['user_id'];
            unset($data['user_id']);
            /* Update userdata */
            if(isset($data['email'])){
                $checkemail = $this->common_model->getRecordCount('users_master', array('email' => $data['email']));
            }
            if($data){
                $this->common_model->updateRecords('users_master', $data, array('user_id' => $uid));
            } 
            /* Get user data */
            $userData = $this->common_model->getSingleRecordById('users_master', array('user_id' => $uid));
            if(!empty($userData)) {    
                $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('user_data' =>$userData ));
            } else { 
                $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' => 'Some error occured, please try again.'));
            }
        $this->response($resp);
   
    }

    /**

    * Get user detail by user id

    * @param user id

    */

    public function getprofile_post() {
        /*Check for required parameter */
        $pdata = file_get_contents("php://input");
        $data = json_decode($pdata,true);
        $object_info = $data; 
        $required_parameter = array('user_id');
      
        $chk_error = check_required_value($required_parameter, $object_info);
        if ($chk_error) {
             $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
             $this->response($resp);
        }
        /* Check for valid user */
        $check_email = $this->common_model->getRecordCount(USER, array('id' => $data['user_id']));
        if($check_email == 0) {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'USER_IS_NOT_EXISTS', 'error_label' => 'This user is not exists in our database.'));
            $this->response($resp);
        }

        /* Get user info */

        $userData = $this->common_model->getSingleRecordById(USER, array('id' => $data['user_id']));
        if(!empty($userData)) {    
            $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('user_data' => $userData));
        } else {
            $resp = array('code' => ERROR, 'message' => array('error' => 'FAILURE', 'error_label' => 'Some error occured, please try again.'));
        }
        $this->response($resp);
    
    }
   
    /*
    all category service
    */
    public function getallcategory_post() {

            /* Check for required parameter */
            $pdata = file_get_contents("php://input");
            $data = json_decode($pdata,true);
            $object_info = $data;  
            $required_parameter = array('parent_id');
                        $chk_error = check_required_value($required_parameter, $object_info);
                       if ($chk_error) {
                             $resp = array('code' => MISSING_PARAM, 'message' => ('YOU_HAVE_MISSED_A_PARAMETER_') . strtoupper($chk_error['param']));
                             $this->response($resp);
                        }
            $category_data = $this->common_model->getAllRecordsById('category_master',array('parent_id' => $data['parent_id']));
            $j=0;
            $i=0;
            $array_data=array();
            foreach ($category_data as $key => $value){ 
            	$array_data[$i]['category_id']=$value['category_id'];
            	$array_data[$i]['category_name']=$value['category_name'];
                   $category_id = $value['category_id']; 
            
                    $subcat_data = $this->common_model->getAllRecordsById('category_master', array('parent_id' => $category_id));
                    $l=array();
                    foreach ($subcat_data as $key => $value1){ 
                    	$l[$j]['cate_id']=$value['category_id'];
                    	$l[$j]['subcate_id'] = $value1['category_id'];
                    	$l[$j]['subcate_name'] = $value1['category_name'];
                    	$j++;
                    }
                    $array_data[$i]['subcate_array']=$l;
                    //print_r($subcat_data);
                    //die();
                    //print_r($category_data[0]['subcate_array']); die;
                    //$category_data['subcat']=$subcat_data;
                    $i++;
            }
            //print_r($array_data);
            if(!empty($array_data)) {  
                $path = base_url().'uploads/category_images/';
                $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('result' => $array_data,'img_url' => $path));
            } else {

                $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response'=> array('error' => 'FAILURE', 'error_label' => ('category not found')));
            }
         $this->response($resp);
    
    }
    
    /*
    all catalog
    */
    public function getallcatalog_post() {

            /* Check for required parameter */
            $pdata = file_get_contents("php://input");
            $data = json_decode($pdata,true);
            $object_info = $data;  
            $catalog_data = $this->common_model->getcatlog();
            for ($i=0; $i <count($catalog_data) ; $i++) { 
                $catalog_id = $catalog_data[$i]['catlog_id'];
                $product_count = $this->common_model->countRecord('product_master', array('catlog_id' => $catalog_id));
                $catalog_data[$i]['design'] = $product_count; 
       		}
            if(!empty($catalog_data)) {  
                $path = base_url().'uploads/catlog_images/';
                $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('result' => $catalog_data,'img_url' => $path));
            } else {

                $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response'=> array('error' => 'FAILURE', 'error_label' => ('catalog not found')));
            }
         	$this->response($resp);
    
    }

    /*
    all product by category service
    */
    public function getallcatalogbycategory_post() {

            /* Check for required parameter */
            $pdata = file_get_contents("php://input");
            $data = json_decode($pdata,true);
            $object_info = $data;  
            $required_parameter = array('category_id');
            $chk_error = check_required_value($required_parameter, $object_info);
            if ($chk_error) {
                 $resp = array('code' => MISSING_PARAM, 'message' => ('YOU_HAVE_MISSED_A_PARAMETER_') . strtoupper($chk_error['param']));
                 $this->response($resp);
            }
            $catalog_data = $this->common_model->getAllRecordsById('category_catlog_images',array('category_id' => $data['category_id']));
            for ($i=0; $i <count($catalog_data) ; $i++) { 
                $catalog_id = $catalog_data[$i]['catlog_id'];
                $product_count = $this->common_model->countRecord('product_master', array('catlog_id' => $catalog_id));
                $single_product_price = $this->common_model->getsingle('product_master', array('catlog_id' => $catalog_id),'product_price');
                if(isset($single_product_price->product_price))
                  $catalog_data[$i]['product_price'] = $single_product_price->product_price;
              	else
              		 $catalog_data[$i]['product_price'] = "";
              	if(isset($product_count))
                  $catalog_data[$i]['design'] = $product_count;
              	else
              		 $catalog_data[$i]['design'] = "";		
                //$product_price = $this->common_model->getSingleRecordpriceById('product_master', array('catlog_id' => $catalog_id));
                //print_r($product_price); die;
                //$valuedata1[$i]['design'] = $product_count;
                //$valuedata1[$i]['product_price'] = $product_price['product_price'];  
       		}
            if(!empty($catalog_data)) {  
                $path = base_url().'uploads/catlog_images/';
                $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('result' => $catalog_data,'img_url' => $path));
            } else {

                $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response'=> array('error' => 'FAILURE', 'error_label' => ('catalog not found')));
            }
         	$this->response($resp);
    
    }
    /*
    all product service
    */
    public function getallcallection_post() {

            /* Check for required parameter */
            $pdata = file_get_contents("php://input");
            $data = json_decode($pdata,true);
            $object_info = $data;  
            $callection_firstdata = $this->common_model->getfirstRecord('tag_master');
            $callection_data = $this->common_model->getAllRecords('tag_master');
             for ($i=0; $i <count($callection_data) ; $i++) { 
                    $tag_id = $callection_data[$i]['tag_id'];
                    $callection_count = $this->common_model->getRecordCount('category_catlog_images', array('tag_id' => $tag_id));
                    $callection_data[$i]['count'] = $callection_count; 
            }
            // $productfull_data = array_merge($product_data,$imgArr);
            if(!empty($callection_data)) {  
                $path = base_url().'uploads/tag_images/';
                $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('first_result'=> $callection_firstdata,
                    'result' => $callection_data,'img_url' => $path));
            } else {

                $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response'=> array('error' => 'FAILURE', 'error_label' => ('callection not found')));
            }
            $this->response($resp);
    }
     /*
    all product by category service
    */
    public function getallcatalogbycallection_post() {

            /* Check for required parameter */
            $pdata = file_get_contents("php://input");
            $data = json_decode($pdata,true);
            $object_info = $data;  
            $required_parameter = array('tag_id');
            $chk_error = check_required_value($required_parameter, $object_info);
                if ($chk_error) {
                    $resp = array('code' => MISSING_PARAM, 'message' => ('YOU_HAVE_MISSED_A_PARAMETER_') . strtoupper($chk_error['param']));
                    $this->response($resp);
                }
            $whr = array('pcw.tag_id' => $data['tag_id']);            
            //$catalog_data = $this->common_model->getAllRecordsById('category_catlog_images',array('tag_id' => $data['tag_id']));
            $catalog_data = $this->common_model->getcatlogbycallection($whr);
            if(!empty($catalog_data)) {  
                $path = base_url().'uploads/catlog_images/';
                $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('result' => $catalog_data,'img_url' => $path));
            } else {

                $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response'=> array('error' => 'FAILURE', 'error_label' => ('catalog not found')));
            }
         $this->response($resp);
    
    }
    /*
    all product by category service
    */
    public function getallproductbycatalog_post() {

        /* Check for required parameter */
        $pdata = file_get_contents("php://input");
        $data = json_decode($pdata,true);
        $object_info = $data;  
        $required_parameter = array('catlog_id');
        $chk_error = check_required_value($required_parameter, $object_info);
            if ($chk_error) {
                $resp = array('code' => MISSING_PARAM, 'message' => ('YOU_HAVE_MISSED_A_PARAMETER_') . strtoupper($chk_error['param']));
                $this->response($resp);
            }
        $product_data = $this->common_model->getAllRecordsById('product_master',array('catlog_id' => $data['catlog_id']));

        for ($i=0; $i <count($product_data) ; $i++) { 
                $product_id = $product_data[$i]['product_id'];
                $single_product_image = $this->common_model->getsingle('product_images', array('product_id' => $product_id),'image_name');
                $product_data[$i]['product_images'] = $single_product_image->image_name;
                $product_data[$i]['images'] = $this->common_model->get_selected_field('product_images', array('product_id' => $product_id),'image_name');  
        }
        $catalog_data = $this->common_model->get_selected_field('category_catlog_images', array('catlog_id' => $data['catlog_id']),'catlog_description'); 

        $des = $catalog_data[0]->catlog_description; 
        //$catalog_des = (explode('<>',$des));
        //print_r($catalog_data); die();
        //$des = $catalog_data->catlog_description;
        if(!empty($product_data)) {  
            $path = base_url().'uploads/product_images/';
            $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('result' => $product_data,'catalog_des' =>$des,'img_url' => $path));
        } else {

            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response'=> array('error' => 'FAILURE', 'error_label' => ('product not found')));
        }
        $this->response($resp);
    }
                  /*
    all product service
    */
    public function getallproduct_post() {

            /* Check for required parameter */
            $pdata = file_get_contents("php://input");
            $data = json_decode($pdata,true);
            $object_info = $data;  
            $product_data = $this->common_model->getAllRecords('product_master');

           for ($i=0; $i <count($product_data) ; $i++) { 
                    $product_id = $product_data[$i]['product_id'];
                    $single_product_image = $this->common_model->getsingle('product_images', array('product_id' => $product_id),'image_name');
                    $product_data[$i]['product_images'] = $single_product_image->image_name;
    				$product_data[$i]['images'] = $this->common_model->get_selected_field('product_images', array('product_id' => $product_id),'image_name');  
            }
            //$productfull_data = array_merge($product_data,$imgArr);
            if(!empty($product_data)) {  
                $path = base_url().'uploads/';
                $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('result' => $product_data,'img_url' => IMG_URL));
            } else {

                $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response'=> array('error' => 'FAILURE', 'error_label' => ('product not found')));
            }
         $this->response($resp);
    
    }
    /*
    all product by category service
    */
    public function getallproductbycategory_post() {

            /* Check for required parameter */
            $pdata = file_get_contents("php://input");
            $data = json_decode($pdata,true);
            $object_info = $data;  
            $required_parameter = array('category_id','catlog_id');
            $chk_error = check_required_value($required_parameter, $object_info);
            if ($chk_error) {
                 $resp = array('code' => MISSING_PARAM, 'message' => ('YOU_HAVE_MISSED_A_PARAMETER_') . strtoupper($chk_error['param']));
                 $this->response($resp);
            }
            $product_data = $this->common_model->getAllRecordsById('product_master',array('category_id' => $data['category_id'],'catlog_id' => $data['catlog_id']));
            $design_count = $this->common_model->countRecord('product_master',array('category_id' => $data['category_id']));

            for ($i=0; $i <count($product_data) ; $i++) { 
                    $product_id = $product_data[$i]['product_id'];
                    $single_product_image = $this->common_model->getsingle('product_images', array('product_id' => $product_id),'image_name');
                    // if(!empty($single_product_image))
                    // {
                    //     $product_data[$i]['product_images'] = $single_product_image->image_name;
                    //     $product_data[$i]['images'] = $this->common_model->get_selected_field('product_images', array('product_id' => $product_id),'image_name');
                    // }
                    // else
                    // {
                    //     $product_data[$i]['product_images'] ='';
                    //     $product_data[$i]['images']=array();
                    // }
                    //if
                    $product_data[$i]['product_images'] = $single_product_image->image_name;
                    $product_data[$i]['images'] = $this->common_model->get_selected_field('product_images', array('product_id' => $product_id),'image_name');  
            }
            $catalog_data = $this->common_model->get_selected_field('category_catlog_images', array('catlog_id' => $data['catlog_id']),'catlog_description'); 

            $des = $catalog_data[0]->catlog_description; 
            //$catalog_des = (explode('<>',$des));
            //print_r($catalog_data); die();
            //$des = $catalog_data->catlog_description;
            if(!empty($product_data)) {  
                $path = base_url().'uploads/product_images/';
                $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('result' => $product_data,'design'=>$design_count,'catalog_des' =>$des,'img_url' => $path));
            } else {

                $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response'=> array('error' => 'FAILURE', 'error_label' => ('product not found')));
            }
         $this->response($resp);
    
    }

    /*
     product details
    */
    public function productdetails_post() {

        /* Check for required parameter */
        $pdata = file_get_contents("php://input");
        $data = json_decode($pdata,true);
        $object_info = $data;  
        $required_parameter = array('product_id');
        $chk_error = check_required_value($required_parameter, $object_info);
        if ($chk_error) {
             $resp = array('code' => MISSING_PARAM, 'message' => ('YOU_HAVE_MISSED_A_PARAMETER_') . strtoupper($chk_error['param']));
             $this->response($resp);
        }
        //$product_data = $this->common_model->getSingleRecordById('product_master',array('product_id' => $data['product_id']));
        $whr = array('pcw.product_id' => $data['product_id']); 
        $product_data = $this->common_model->getproductdetailwithsupplier($whr);
        if(!empty($product_data)) {  
            $path = base_url().'uploads/product_images/';
            $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('result' => $product_data,'img_url' => $path));
        } else {

            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response'=> array('error' => 'FAILURE', 'error_label' => ('product not found')));
        }
        $this->response($resp);
    
    }
    /*
    all banner list
    */
    public function getbannerimage_post() {

            /* Check for required parameter */
            $pdata = file_get_contents("php://input");
            $data = json_decode($pdata,true);
            $object_info = $data;  
            $banner_data = $this->common_model->getAllRecords('banner');
            if(!empty($banner_data)) {  
                $path = base_url().'uploads/';
                $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('result' => $banner_data,'img_url' => IMG_URL));
            } else {

                $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response'=> array('error' => 'FAILURE', 'error_label' => ('image not found')));
            }
         $this->response($resp);
    
    }
    /*
    searching 
    */
    public function searching_post() {
      $pdata = file_get_contents("php://input");
      $data  = json_decode($pdata, true);
      $object_info = $data;
      $required_parameter = array('keyword');
      $chk_error = check_required_value($required_parameter, $object_info);
        if ($chk_error) {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' => 'YOU_HAVE_MISSED_A_PARAMETER_'. strtoupper($chk_error['param'])));
        }
      $whr1= "catlog_title LIKE'%" . $data['keyword'] ."%'";
      $valuedata = $this->common_model->likesearch1('category_catlog_images',$whr1);
      for ($i=0; $i <count($valuedata) ; $i++) { 
                $catalog_id = $valuedata[$i]['catlog_id'];
                $product_count = $this->common_model->countRecord('product_master', array('catlog_id' => $catalog_id));
                $single_product_price = $this->common_model->getsingle('product_master', array('catlog_id' => $catalog_id),'product_price');
                if(isset($single_product_price->product_price))
                  $valuedata[$i]['product_price'] = $single_product_price->product_price;
              	else
              		 $valuedata[$i]['product_price'] = "";
              	if(isset($product_count))
                  $valuedata[$i]['design'] = $product_count;
              	else
              		 $valuedata[$i]['design'] = "";		
                //$product_price = $this->common_model->getSingleRecordpriceById('product_master', array('catlog_id' => $catalog_id));
                //print_r($product_price); die;
                //$valuedata1[$i]['design'] = $product_count;
                //$valuedata1[$i]['product_price'] = $product_price['product_price'];  
       		}
       	$path = base_url().'uploads/catlog_images/';	
      	//$valuedata = array_merge($valuedata1);
        if (!empty($valuedata)) {
          $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('result' => $valuedata,'img_url' => $path));

        } else {

        $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('result' => 'data not found','img_url' => IMG_URL,));

        }
        $this->response($resp);
    
    }
     /*
    all supplier service
    */
    public function getallsuppilers_post() {

            /* Check for required parameter */
            $pdata = file_get_contents("php://input");
            $data = json_decode($pdata,true);
            $object_info = $data;  
            $required_parameter = array('user_role');
            $chk_error = check_required_value($required_parameter, $object_info);
            if ($chk_error) {
                 $resp = array('code' => MISSING_PARAM, 'message' => ('YOU_HAVE_MISSED_A_PARAMETER_') . strtoupper($chk_error['param']));
                 $this->response($resp);
            }
            $supplier_data = $this->common_model->getAllRecordsById('users_master',array('user_role' => $data['user_role']));
            if(!empty($supplier_data)) {  
                $path = base_url().'uploads/';
                $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('result' => $supplier_data,'img_url' => IMG_URL));
            } else {

                $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response'=> array('error' => 'FAILURE', 'error_label' => ('supplier not found')));
            }
         $this->response($resp);
    
    }
    /*
     MY ADD TO CART PRODUCT

    */
    
    /*
     Add To Cart
    */
    public function add_to_cart_post()
    {
        /* Check for required parameter */
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;
        $required_parameter = array('user_id','product_id');
        $chk_error = check_required_value($required_parameter, $data);
        if ($chk_error) 
        {
             $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }
        $check_email = $this->common_model->getRecordCount('users_master', array('user_id' => $data['user_id']));
        if($check_email == 0) 
        {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'USER_IS_NOT_EXISTS', 'error_label' => 'This user is not exists in our database.'));
            $this->response($resp);
        }
        else
        {
            $product_data = $this->common_model->getSingleRecordById('product_master', array('product_id' => $data['product_id']));
            if (!empty($product_data)) 
            {
                $suppliers_id=$product_data['suppliers_id'];
                $check_catlog = $this->common_model->getRecordCount('product_cart_to_cart_wishlist', array('user_id' => $data['user_id'],"cart_wish_status"=>0,"suppliers_id!="=>$suppliers_id));
                if($check_catlog != 0) 
                {
                    $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'SUPPLIER_IS_NOT_EXISTS', 'error_label' => 'This Supplier is not exists in our database.'));
                    $this->response($resp);
                }
                else
                {
                    $product_catlog = $this->common_model->getRecordCount('product_cart_to_cart_wishlist', array('user_id' => $data['user_id'],"cart_wish_status"=>0,"product_id"=>$product_data['product_id']));
                    if($product_catlog == 0) 
                    {
                        $product_list_array=array("user_id"=>$data['user_id'],"product_id"=>$product_data['product_id'],"suppliers_id"=>$product_data['suppliers_id'],"product_qty"=>1,"product_price"=>$product_data['product_price'],"tax_amount"=>$product_data['tax_amount'],"discount_amount"=>$product_data['discount_amount'],"offer_amount"=>$product_data['offer_amount'],"sale_price"=>$product_data['sale_price'],"cart_wish_type"=>"add_to_cart","added_by"=>$data['user_id'],"added_date"=>date('Y-m-d H:i:s'),"added_ip"=>$_SERVER['REMOTE_ADDR']);
                        $cart_id=$this->common_model->insertData("product_cart_to_cart_wishlist",$product_list_array);
                        $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('cart_id' => $cart_id));
                        $this->response($resp);
                        
                    }
                    else
                    {
                        $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'PRODUCT_ALREADY_ADDED', 'error_label' => 'This Product is already added in our database.'));
                        $this->response($resp);
                        
                    }
                }
            }
            else
            {
                $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'PRODUCT_IS_NOT_EXISTS', 'error_label' => 'This product is not exists in our database.'));
                $this->response($resp);
            }
        }
    }
    public function cart_reseller_status_post()
    {
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;
        $required_parameter = array('user_id','product_id','action');
        $chk_error = check_required_value($required_parameter, $data);
        if ($chk_error) 
        {
             $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }
        $check_email = $this->common_model->getRecordCount('users_master', array('user_id' => $data['user_id']));
        if($check_email == 0) 
        {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'USER_IS_NOT_EXISTS', 'error_label' => 'This user is not exists in our database.'));
            $this->response($resp);
        }
        else
        {
            if($data['action']=='Y')
            {
                $user_id= $data['user_id'];
                $product_id= $data['product_id'];
                $where=array("user_id"=>$user_id);
                $this->common_model->delete("product_cart_to_cart_wishlist",$where);
                $product_data = $this->common_model->getSingleRecordById('product_master', array('product_id' => $data['product_id']));
                if (!empty($product_data)) 
                {

                    $product_list_array=array("user_id"=>$data['user_id'],"product_id"=>$product_data['product_id'],"suppliers_id"=>$product_data['suppliers_id'],"product_qty"=>1,"product_price"=>$product_data['product_price'],"tax_amount"=>$product_data['tax_amount'],"discount_amount"=>$product_data['discount_amount'],"offer_amount"=>$product_data['offer_amount'],"sale_price"=>$product_data['sale_price'],"cart_wish_type"=>"add_to_cart","added_by"=>$data['user_id'],"added_date"=>date('Y-m-d H:i:s'),"added_ip"=>$_SERVER['REMOTE_ADDR']);
                    $cart_id=$this->common_model->insertData("product_cart_to_cart_wishlist",$product_list_array);
                    $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('cart_id' => $cart_id));
                    $this->response($resp);
                }
                else
                {
                    $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'PRODUCT_IS_NOT_EXISTS', 'error_label' => 'This product is not exists in our database.'));
                    $this->response($resp);
                }
            }
            else
            {
                $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'STRING_IS_NOT_EXISTS', 'error_label' => 'Not a proper string to insert data.'));
                $this->response($resp);
            }
        }
    }
    public function update_cart_post()
    {
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;
        $required_parameter = array('product_cart_id','product_qty');
        $chk_error = check_required_value($required_parameter, $object_info);
        if ($chk_error) 
        {
             $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
             $this->response($resp);
        }
        else
        {
            $cartData = $this->common_model->getSingleRecordById('product_cart_to_cart_wishlist', array('product_cart_id' => $data['product_cart_id']));
            if(!empty($cartData))
            {
                $qty=$data['product_qty'];
                $product_id=$cartData['product_id'];
                $user_id=$cartData['user_id'];
                $product_data = $this->common_model->getSingleRecordById('product_master', array('product_id' => $product_id));
                if (!empty($product_data)) 
                {
                    $product_price=$qty*$product_data['product_price'];
                    $tax_amount=$qty*$product_data['tax_amount'];
                    $discount_amount=$qty*$product_data['discount_amount'];
                    $offer_amount=$qty*$product_data['offer_amount'];
                    $sale_price=$product_price+$tax_amount-$discount_amount-$offer_amount;
                    $where=array("product_cart_id"=>$data['product_cart_id']);
                    $product_list_array=array("product_qty"=>$qty,"product_price"=>$product_price,"tax_amount"=>$tax_amount,"discount_amount"=>$discount_amount,"offer_amount"=>$offer_amount,"sale_price"=>$sale_price,"edited_by"=>$user_id,"edited_date"=>date('Y-m-d H:i:s'),"edited_ip"=>$_SERVER['REMOTE_ADDR']);
                    $this->common_model->updateFields("product_cart_to_cart_wishlist",$product_list_array,$where);
                    $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('cart_id' => $data['product_cart_id']));
                    $this->response($resp);
                }
            }
            else
            {
                $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'CART_DATA_IS_NOT_EXISTS', 'error_label' => 'Cart Data is not exists in our database..'));
                $this->response($resp);
            }
        }
    }
    // public function add_to_cart_post() {

        
    //     $pdata = file_get_contents("php://input");
    //     $data = json_decode( $pdata,true );
    //     $object_info = $data;

    //     $required_parameter = array('user_id','product_id','product_qty','product_price','tax_amount','discount_amount','offer_amount','coupan_amount','sale_price','cart_wish_type');
    //     $chk_error = check_required_value($required_parameter, $data);
    //     if ($chk_error) {
    //          $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
    //          @$this->response($resp);
    //     }
	   //      $data['added_date'] = date('Y-m-d H:i:s');
	   //      $data['cart_wish_status'] = 0;
	   //      $product_cart_id = $this->common_model->addRecords('product_cart_to_cart_wishlist', $data);
	   //      if($product_cart_id) {        
	          
	   //          $addtocartData = $this->common_model->getSingleRecordById('product_cart_to_cart_wishlist', array('product_cart_id' => $product_cart_id));
	   //          $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('card_data' => $addtocartData));
	   //      } else {
	   //          $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' => 'Some error occured, please try again.'));
	   //      }
        
    //     @$this->response($resp);
    
    // }
    /**
    * update Cart
    */
    // public function update_cart_post() 
    // {
       
    //     $pdata = file_get_contents("php://input");
    //     $data = json_decode( $pdata,true );
    //     $object_info = $data;
    //     $required_parameter = array('product_cart_id','user_id','product_id','product_qty','product_price','tax_amount','discount_amount','offer_amount','coupan_amount','sale_price','cart_wish_type');
    //     $chk_error = check_required_value($required_parameter, $object_info);
    //     if ($chk_error) {
    //          $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
    //          $this->response($resp);
    //     }
    //     $data['edited_date'] = date('Y-m-d H:i:s');
        
    //      $check_email = $this->common_model->getRecordCount('product_cart_to_cart_wishlist', array('user_id' => $data['user_id']));
    //       if($check_email == 0) {
    //         $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'USER_IS_NOT_EXISTS', 'error_label' => 'This user is not exists in our database.'));
    //         $this->response($resp);
    //       }   
    //         $uid = $data['product_cart_id'];
    //         unset($data['product_cart_id']);
           
    //         if(isset($data['product_cart_id'])){
    //              $checkemail = $this->common_model->getRecordCount('product_cart_to_cart_wishlist', array('product_cart_id' => $data['product_cart_id'],'product_id' => $data['product_id'],'user_id' => $data['user_id']));
    //         }
    //         if($data){
    //              $this->common_model->updateRecords('product_cart_to_cart_wishlist', $data, array('product_cart_id' => $uid));
    //         } 
           
    //         $update_cartData = $this->common_model->getSingleRecordById('product_cart_to_cart_wishlist', array('product_cart_id' => $uid));
    //         if(!empty($update_cartData)) {    
    //             $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('card_data' =>$update_cartData ));
    //         } else { 
    //             $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' => 'Some error occured, please try again.'));
    //         }
    //     $this->response($resp);
   
    // }
    /*
     List card product
    */
    public function cart_product_list_post() {

        /* Check for required parameter */
            $pdata = file_get_contents("php://input");
            $data = json_decode($pdata,true);
            $object_info = $data;  
            $required_parameter = array('user_id');
            $chk_error = check_required_value($required_parameter, $object_info);
            if ($chk_error) {
                 $resp = array('code' => MISSING_PARAM, 'message' => ('YOU_HAVE_MISSED_A_PARAMETER_') . strtoupper($chk_error['param']));
                 $this->response($resp);
            }
            $whr = array('pcw.user_id' => $data['user_id'],'pcw.cart_wish_status'=>0);
            $cartproduct_data = $this->common_model->addcartlist($whr);
            $cartcount_data = $this->common_model->countRecord('product_cart_to_cart_wishlist',array('user_id' => $data['user_id']));
            $carttotal_data = $this->common_model->subtotal('product_cart_to_cart_wishlist',array('user_id' => $data['user_id']));
            //print_r($cartproduct_data); die;
            $path = base_url().'uploads/product_images/';
            if(!empty($cartproduct_data)) {  
                $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('result' => $cartproduct_data,'result_count' => $cartcount_data,'amount_total' => $carttotal_data, 'img_url' => $path));
            } else {

                $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' => 'cart empty'));
            }
         $this->response($resp);
    
    }
    /*
     delete product in card
    */
    public function delete_product_cart_post() {

        /* Check for required parameter */
        $pdata = file_get_contents("php://input");
        $data = json_decode($pdata, true);
        $object_info = $data;
        $required_parameter = array('user_id','product_cart_id');
        $chk_error = check_required_value($required_parameter, $object_info);

        if ($chk_error) {
            $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
            $this->response($resp);
        }

        $card_data = $this->common_model->getSingleRecordById('product_cart_to_cart_wishlist', array('product_cart_id' => $data['product_cart_id']));
        if (!empty($card_data)) {
        	
            $delete = $this->common_model->delete('product_cart_to_cart_wishlist', array('product_cart_id' => $data['product_cart_id']));
            if(empty($delete)){
            $cartcount_data = $this->common_model->countRecord('product_cart_to_cart_wishlist',array('user_id' => $data['user_id']));
        	$carttotal_data = $this->common_model->subtotal('product_cart_to_cart_wishlist',array('user_id' => $data['user_id']));
            }
            $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => 'Product deleted card successfully','result_count' => $cartcount_data,'amount_total' => $carttotal_data);
        } else {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' => 'Records not found '));
        }

        $this->response($resp);
    
    }

    /*
	 checkout products
    */

	public function checkout_post(){

	 	/* Check for required parameter */
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;

        $required_parameter = array('user_id','total_product_price','total_tax_price','total_coupan_price','total_discount_price','total_offer_price','total_shipping','total_sale_price','total_product_qty');
        $chk_error = check_required_value($required_parameter, $data);
        if ($chk_error) {
             $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }
        
        $data['added_date'] = date('Y-m-d H:i:s');
        $data['place_order_status'] = 0;
        $checkout_id = $this->common_model->addRecords('user_checkout_master', $data);
        if($checkout_id) {        
            /* Get add to cart data */
            $checkoutData = $this->common_model->getSingleRecordById('user_checkout_master', array('checkout_id' => $checkout_id));
            $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('checkout_data' => $checkoutData));
        } else {
            $resp = array('code' => ERROR,'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' => 'Some error occured, please try again.'));
        }
        @$this->response($resp);
	
	}
	/*
		checkout product one by one 
	*/
	public function checkout_products_post() {
        // Check for required parameter 
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;
        $required_parameter = array('user_services');
        $chk_error = check_required_value($required_parameter, $object_info);
        if ($chk_error) {
            $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
            $this->response($resp);
        } 
        $checkout_data = $data['user_services'];
         if(!empty($checkout_data))
        {     
            foreach ($checkout_data as $key => $arr)     
            {  
                    $arr['added_date'] = date('Y-m-d H:i:s');
                    $userId = $this->common_model->addRecords('checkuot_product_list', $arr); 
            }
            $ch_data = $this->common_model->getAllRecordsById('checkuot_product_list',array('checkout_id' => $arr['checkout_id']));
            $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('result' => $ch_data));
        }
        else {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' => 'Some error occured, please try again.'));
        }
        $this->response($resp);
    
    }
    /*
	 Shipping address
    */
    public function shared_catalog_list_post()
    {
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;
        $required_parameter = array('user_id');
        $chk_error = check_required_value($required_parameter,$data);
        if ($chk_error) 
        {
             $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }
        $check_email = $this->common_model->getRecordCount('users_master', array('user_id' => $data['user_id']));
        if($check_email == 0) 
        {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'USER_IS_NOT_EXISTS', 'error_label' => 'This user is allready exists in our database.'));
            $this->response($resp);
        }
        else
        {
            $shared_catlog_data = $this->common_model->getAllRecordsById('sharing_master', array('user_id' =>$data['user_id'],"sharing_acceptance_status"=>1));
            $catelog_list_array=array();
            for($i=0;$i<count($shared_catlog_data);$i++)
            {
                $catlog_id=$shared_catlog_data[$i]['catlog_id'];
                $catalog_data = $this->common_model->getSingleRecordById('category_catlog_images', array('catlog_id' => $catlog_id));
                if(count($catalog_data)>0) 
                { 
                    $catelog_list_array[$i] = $catalog_data;                     
                    // $catelog_list_array[$i]['category_id'] = $catalog_data['category_id']; 
                    // $catelog_list_array[$i]['catlog_title'] = $catalog_data['catlog_title'];
                    // $catelog_list_array[$i]['catlog_description'] = $catalog_data['catlog_description'];
                    // $catelog_list_array[$i]['tag_description'] = $catalog_data['tag_description'];
                    // $catelog_list_array[$i]['catlog_image'] = base_url()."uploads/catlog_images/".$catalog_data['catlog_image'];
                }


                

                
            }
            if(!empty($catelog_list_array)) 
            { 
                $path = base_url().'uploads/catlog_images/';
                $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('result' => $catelog_list_array,'img_url' => $path));
            } 
            else 
            {
                $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response'=> array('error' => 'FAILURE', 'error_label' => ('catalog not found')));
            }
        }
        $this->response($resp);
    }
    public function pincode_check_post()
    {
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;
        $required_parameter = array('pincode');
        $chk_error = check_required_value($required_parameter,$data);
        if ($chk_error) 
        {
             $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }
        $check_email = $this->common_model->getRecordCount('pincode_master', array('pin_code' => $data['pincode']));
        if($check_email == 0) 
        {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'PINCODE_IS_NOT_EXISTS', 'error_label' => 'Order will not delivered to this pincode.'));
            $this->response($resp);
        }
        else
        {
            $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('error' => 'PINCODE_IS_EXISTS', 'error_label' => 'Order will delivered to this pincode.'));
            $this->response($resp);
        }
    }
    public function shared_catalog_post()
    {
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;
        $required_parameter = array('user_id','catlog_id');
        $chk_error = check_required_value($required_parameter,$data);
        if ($chk_error) 
        {
             $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }
        $check_email = $this->common_model->getRecordCount('users_master', array('user_id' => $data['user_id']));
        if($check_email == 0) 
        {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'USER_IS_NOT_EXISTS', 'error_label' => 'This user is allready exists in our database.'));
            $this->response($resp);
        }
        $check_email = $this->common_model->getRecordCount('category_catlog_images', array('catlog_id' => $data['catlog_id']));
        if($check_email == 0) 
        {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'CATALOG_IS_NOT_EXISTS', 'error_label' => 'This catalog is noy exists in our database.'));
            $this->response($resp);
        }
        else
        {
            $shared_array=array("user_id"=>$data['user_id'],"sharing_type"=>"whatsaap","catlog_id"=>$data['catlog_id'],"sharing_acceptance_status"=>1,"added_by"=>$data['user_id'],"added_date"=>date('Y-m-d H:i:s'),"added_ip"=>$_SERVER['REMOTE_ADDR']);
            $sharing_id=$this->common_model->insertData("sharing_master",$shared_array);
            $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('sharing_id' => $sharing_id));
            @$this->response($resp);
        }
    }
	public function shippingaddress_post()
    {
	 	/* Check for required parameter */
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;
        $required_parameter = array('user_id','name','mobile','address_line1','addess_line2','addess_line3','city','state','pincode');
        $chk_error = check_required_value($required_parameter,$data);
        if ($chk_error) 
        {
             $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }
        $check_email = $this->common_model->getRecordCount('users_master', array('user_id' => $data['user_id']));
        if($check_email == 0) 
        {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'USER_IS_NOT_EXISTS', 'error_label' => 'This user is allready exists in our database.'));
            $this->response($resp);
        }
        else
        { 
            $user_checkout_data = $this->common_model->getSingleRecordById('user_checkout_master', array('user_id' => $data['user_id'],"place_order_status"=>0));
            if(count($user_checkout_data)>0)
            {
                
               
                $old_checkout_id=$user_checkout_data['checkout_id'];
                $where=array('user_id' => $data['user_id'],"checkout_id"=>$old_checkout_id);
                $this->common_model->delete("user_checkout_master",$where);
                $where1=array("checkout_id"=>$old_checkout_id);
                $this->common_model->delete("checkuot_product_list",$where1);
                $where1=array("checkout_id"=>$old_checkout_id);
                $this->common_model->delete("shipping_address_master",$where1);
            }
                    $total_product_price=0;
                    $total_tax_price=0;
                    $total_discount_price=0;
                    $total_offer_price=0;
                    $total_shipping=0;
                    $total_sale_price=0;
                    $total_product_qty=0;
                    $id=$data['user_id'];
                    $que="select sum(product_qty) as total_product_qty,sum(product_price) as total_product_price,sum(tax_amount) as total_tax_price,sum(discount_amount) as total_discount_price,sum(offer_amount) as total_offer_price,sum(sale_price) as total_sale_price  from product_cart_to_cart_wishlist where user_id='$id' and cart_wish_status=0 ";
                    $user_cart_Data = $this->common_model->make_query($que);

                    if(!empty($user_cart_Data)) 
                    { 
                            $cat_uuper_data=array("user_id"=>$data['user_id'],"total_product_price"=>$user_cart_Data[0]['total_product_price'],"total_tax_price"=>$user_cart_Data[0]['total_tax_price'],"total_discount_price"=>$user_cart_Data[0]['total_discount_price'],"total_offer_price"=>$user_cart_Data[0]['total_offer_price'],"total_shipping"=>90,"total_sale_price"=>$user_cart_Data[0]['total_sale_price'],"total_product_qty"=>$user_cart_Data[0]['total_product_qty'],"added_by"=>$id,"added_date"=>date('Y-m-d H:i:s'),"added_ip"=>$_SERVER['REMOTE_ADDR']);
                            $checkout_id = $this->common_model->insertData("user_checkout_master",$cat_uuper_data);
                            $cart_product_data = $this->common_model->getAllRecordsById('product_cart_to_cart_wishlist', array('user_id' =>$id,"cart_wish_status"=>0));
                            for($i=0;$i<count($cart_product_data);$i++)
                            {
                                
                                $product_details_data = $this->common_model->getSingleRecordById('product_master', array('product_id' => $cart_product_data[$i]['product_id']));
                                
                                if(count($product_details_data)>0)
                                {
                                    //$product_name=$product_details_data['product_name'];
                                    $product_name="testing";
                                }
                                else
                                {
                                    $product_name="";
                                }
                                $checkuot_product_list=array("checkout_id"=>$checkout_id,"product_id"=>$cart_product_data[$i]['product_id'],"product_name"=>$product_name,"pro_qty"=>$cart_product_data[$i]['product_qty'],"product_price"=>$cart_product_data[$i]['product_price'],"tax_amount"=>$cart_product_data[$i]['tax_amount'],"dicount_amount"=>$cart_product_data[$i]['discount_amount'],"offer_amount"=>$cart_product_data[$i]['offer_amount'],"sales_amount"=>$cart_product_data[$i]['sale_price'],"added_by"=>$id,"added_date"=>date('Y-m-d H:i:s'),"added_ip"=>$_SERVER['REMOTE_ADDR']);
                                $this->common_model->insertData("checkuot_product_list",$checkuot_product_list);
                            }
                            $data['checkout_id']=$checkout_id;
                            $shipping_address_id = $this->common_model->addRecords('shipping_address_master', $data);
                            $shipping_address_data = $this->common_model->getSingleRecordById('shipping_address_master', array('shipping_address_id' => $shipping_address_id));
                            $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('checkout_id' => $checkout_id));
                    }
                    else
                    {
                        $resp = array('code' => ERROR,'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' => 'Some error occured, please try again.'));
                    } 
        }
        @$this->response($resp);
	
	}
    public function get_last_shipping_post() 
    {
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;
        $required_parameter = array('user_id');
        $chk_error = check_required_value($required_parameter, $object_info);
        if ($chk_error) {
             $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
             $this->response($resp);
        }
        $data['edited_date'] = date('Y-m-d H:i:s');
        $check_email = $this->common_model->getRecordCount('users_master', array('user_id' => $data['user_id']));
        if($check_email == 0) {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'USER_IS_NOT_EXISTS', 'error_label' => 'This user is not exists in our database.'));
            $this->response($resp);
        }
        $last_shippingData=array();
        if($data)
        {
            $que="select * from shipping_address_master where user_id='".$data['user_id']."' order by shipping_address_id desc  limit 1 ";
            $last_shippingData = $this->common_model->make_query($que);

            if(!empty($last_shippingData)) 
            {   
                 $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('shipping_data' =>$last_shippingData ));
            } 
            else 
            { 
                 $resp = array('code' => 101, 'message' => 'FAILURE', 'response' => array('error' =>"FAILURE","error_label"=>"cart empty" ));
                
                // $resp = array('code' => FAILURE, 'message' => 'FAILURE');
            }
        } 
        else 
        { 
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' => 'Some error occured, please try again.'));
        }
        $this->response($resp); 
    }
    public function proccess_sales_details_post() 
    {
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;
        $required_parameter = array('checkout_id','user_id');
        $chk_error = check_required_value($required_parameter, $object_info);
        if ($chk_error) {
             $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
             $this->response($resp);
        }
        $check_email = $this->common_model->getRecordCount('users_master', array('user_id' => $data['user_id']));
        if($check_email == 0) {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'USER_IS_NOT_EXISTS', 'error_label' => 'This user is not exists in our database.'));
            $this->response($resp);
        }
        $user_checkout_data = $this->common_model->getSingleRecordById('user_checkout_master', array('checkout_id' => $data['checkout_id'],"place_order_status"=>0));
        // print_r($user_checkout_data);
        // die();
        if(count($user_checkout_data)>0)
        {
            $total_product_price=$user_checkout_data['total_product_price'];
            $total_tax_price=$user_checkout_data['total_tax_price'];
            $total_discount_price=$user_checkout_data['total_discount_price'];
            $total_offer_price=$user_checkout_data['total_offer_price'];
            $total_shipping=$user_checkout_data['total_shipping'];
            $total_sale_price=$user_checkout_data['total_sale_price']+$total_shipping;
            $total_product_qty=$user_checkout_data['total_product_qty'];
            $checkout_product_data = $this->common_model->getAllRecordsById('checkuot_product_list', array("checkout_id"=>$data['checkout_id'],"sale_order_satus"=>0));
            $product_list_array=array();
            for($i=0;$i<count($checkout_product_data);$i++)
            {
                $product_list_array[$i]['product_id']=$checkout_product_data[$i]['product_id'];
                $product_data = $this->common_model->get_where_array('product_master', array('product_id' => $product_list_array[$i]['product_id']));
                if(count($product_data)>0)
                {
                    $product_list_array[$i]['product_name']=$product_data[0]['product_name'];
                    $suppliers_id=$product_data[0]['suppliers_id'];
                    $user_data = $this->common_model->get_where_array(' users_master', array('user_id' => $suppliers_id));
                    if(count($user_data)>0)
                    {
                        $user_fullname=$user_data[0]['user_fullname'];
                    }
                    else
                    {
                        $user_fullname="";
                    }
                    $que="select image_path from  product_images where product_id='".$product_list_array[$i]['product_id']."' limit  1 ";
                    $user_cart_Data = $this->common_model->make_query($que);
                    if(!empty($user_cart_Data)) 
                    { 
                        $image_path=base_url().$user_cart_Data[0]['image_path'];
                    }
                    else
                    {
                        $image_path="";
                    }
                    $product_list_array[$i]['image_path']=$image_path;
                }
                $product_list_array[$i]['sales_amount']=$checkout_product_data[$i]['sales_amount'];
                $product_list_array[$i]['pro_qty']=$checkout_product_data[$i]['pro_qty'];

            }
            $respones_array=array("supplier_name"=>$user_fullname,"total_product_price"=>$total_product_price,"total_tax_price"=>$total_tax_price,"total_discount_price"=>$total_discount_price,"total_offer_price"=>$total_offer_price,"total_shipping"=>$total_shipping,"total_sale_price"=>$total_sale_price,"product_list_array"=>$product_list_array);
            $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => $respones_array);
        }
        else
        {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'CHECKOUT_ID_IS_NOT_EXISTS', 'error_label' => 'This checkout is not exists in our database.'));
            $this->response($resp);
        }
        @$this->response($resp);

    }
   
    public function get_user_histroy_post()
    {
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;
        $required_parameter = array('user_id');
        $chk_error = check_required_value($required_parameter,$data);
        if ($chk_error) 
        {
             $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }
        $check_email = $this->common_model->getRecordCount('users_master', array('user_id' => $data['user_id']));
        if($check_email == 0) 
        {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'USER_IS_NOT_EXISTS', 'error_label' => 'This user is allready exists in our database.'));
            $this->response($resp);
        }
        else
        { 
            $order_details_data = $this->common_model->getAllRecordsById('sales_order_master', array('user_id' =>$data['user_id'],"delevery_status !="=>0));

            if(count($order_details_data)>0)
            {
                $return_data_arrray=array();
                for($i=0;$i<count($order_details_data);$i++)
                {
                    $sale_order_id=$order_details_data[$i]['sale_order_id'];
                    $invoice_no=$order_details_data[$i]['invoice_no'];
                    $transaction_no=$order_details_data[$i]['transaction_no'];
                    $payment_method=$order_details_data[$i]['payment_method'];
                    $payment_status=$order_details_data[$i]['payment_status'];
                    $delevery_status=$order_details_data[$i]['delevery_status'];
                    $total_shipping_amount=$order_details_data[$i]['total_shipping_amount'];
                    $total_product_amount=$order_details_data[$i]['total_product_amount'];
                    $total_sale_price=$order_details_data[$i]['total_sale_price'];
                    $total_qty=$order_details_data[$i]['total_qty'];
                    $order_date=date('Y-m-d',strtotime($order_details_data[$i]['added_date']));

                    if($delevery_status==0)
                    {
                        $delevery_status="Ordered";
                    }
                    else if($delevery_status==1)
                    {
                        $delevery_status="shipped";
                    }
                    else if($delevery_status==2)
                    {
                        $delevery_status="In a way";
                    }
                    else if($delevery_status==3)
                    {
                        $delevery_status="Recive";
                    }
                    $delivery_amount=0.00;
                    $payment_amount=$order_details_data[$i]['payment_amount'];
                    $added_date=$order_details_data[$i]['added_date'];
                    $checkout_id=$order_details_data[$i]['checkout_id'];
                    $product_details_array=array();
                    $order_product_data = $this->common_model->getAllRecordsById('sales_order_product', array('sale_order_id' =>$sale_order_id));
                   
                    if(count($order_product_data)>0)
                    {
                        $l=0;
                        for($j=0;$j<count($order_product_data);$j++)
                        {
                            $product_details_array[$l]['sale_order_id']=$sale_order_id;
                            $product_details_array[$l]['product_id']=$order_product_data[$j]['product_id'];
                            $product_details_array[$l]['product_qty']=$order_product_data[$j]['product_qty'];
                            $product_details_array[$l]['sale_amount']=$order_product_data[$j]['sale_amount'];
                            $product_details_array[$l]['added_date']=$order_product_data[$j]['added_date'];
                            
                            $product_data = $this->common_model->get_where_array('product_master', array('product_id' => $product_details_array[$l]['product_id']));
                            if(count($product_data)>0)
                            {
                                $product_details_array[$l]['product_name']=$product_data[0]['product_name'];
                                $suppliers_id=$product_data[0]['suppliers_id'];
                                $user_data = $this->common_model->get_where_array('users_master', array('user_id' => $suppliers_id));
                                if(count($user_data)>0)
                                {
                                    $user_fullname=$user_data[0]['user_fullname'];
                                }
                                else
                                {
                                    $user_fullname="";
                                }
                                $catlog_id=$product_data[0]['catlog_id'];
                                $catlog_data = $this->common_model->get_where_array('category_catlog_images', array('catlog_id' => $catlog_id));
                                if(count($catlog_data)>0)
                                {
                                    $catlog_path=base_url()."uploads/catlog_images/".$catlog_data[0]['catlog_image'];
                                    // $catlog_path=base_url().$catlog_data[0]['catlog_path'];
                                    $dispatch_min_days=$catlog_data[0]['dispatch_min_days'];
                                    $dispatch_max_days=$catlog_data[0]['dispatch_max_days'];
                                    if($payment_method=='cod')
                                    {
                                        $delivery_amount=$catlog_data[0]['delivery_amount'];
                                    }
                                    else
                                    {
                                        $delivery_amount==0.00;
                                    }
                                }
                                else
                                {
                                    $catlog_path="";
                                    $dispatch_min_days="0";
                                    $dispatch_max_days="0";
                                    $delivery_amount="0";
                                }
                                if($dispatch_max_days==0)
                                {
                                   $dispatch_max_days=1; 
                                }

                                $que="select image_path from  product_images where product_id='".$product_details_array[$l]['product_id']."' limit  1 ";
                                $user_cart_Data = $this->common_model->make_query($que);
                                if(!empty($user_cart_Data)) 
                                { 
                                    $image_path=base_url().$user_cart_Data[0]['image_path'];
                                }
                                else
                                {
                                    $image_path="";
                                }
                                $product_details_array[$l]['image_path']=$image_path;
                                if($i==0)
                                {
                                    $global_image=$image_path;
                                    $global_product=$product_details_array[$l]['product_name'];
                                }
                                
                            }
                           $l++; 
                        }
                    }
                   

                    $delivery_date=date('Y-m-d', strtotime($order_date. ' + '.$dispatch_max_days.' days'));
                    $product_shipping_data = $this->common_model->get_where_array('shipping_address_master', array('checkout_id' => $checkout_id));
                    if(count($product_shipping_data)>0)
                    {
                        
                        $address=$product_shipping_data[0]['name']." ".$product_shipping_data[0]['address_line1']." ".$product_shipping_data[0]['addess_line2']." ".$product_shipping_data[0]['addess_line3']." ".$product_shipping_data[0]['city']." ".$product_shipping_data[0]['state']." ".$product_shipping_data[0]['pincode'];
                    }
                    else
                    {
                        $address="";
                    }
                    $return_data_arrray[$i]=array("sale_order_id"=>$sale_order_id,"delevery_status"=>$delevery_status,"invoice_no"=>$invoice_no,"transaction_no"=>$transaction_no,"payment_method"=>$payment_method,"total_qty"=>$total_qty,"address"=>$address,"supplier_name"=>$user_fullname,"total_shipping_amount"=>$total_shipping_amount,"total_product_amount"=>$total_product_amount,"total_sale_price"=>$total_sale_price,"image_path"=>$global_image,"product_name"=>$global_product,"dispatch_min_days"=>$dispatch_min_days,"dispatch_max_days"=>$dispatch_max_days,"delivery_amount"=>$delivery_amount,"order_date"=>$order_date,"delivery_date"=>$delivery_date,"product_details"=>$product_details_array);
                    
                    $l++;
                }

                $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('result' => $return_data_arrray));
            }
            else
            {
                $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('error' => 'FAILURE', 'error_label' => 'Record not found.'));
            }
        }
        $this->response($resp);
    }
    public function success_order_data_post()
    {
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;
        $required_parameter = array('user_id','paymet_methd','checkout_id');
        $chk_error = check_required_value($required_parameter,$data);
        if ($chk_error) 
        {
             $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }
        $check_email = $this->common_model->getRecordCount('users_master', array('user_id' => $data['user_id']));
        if($check_email == 0) 
        {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'USER_IS_NOT_EXISTS', 'error_label' => 'This user is allready exists in our database.'));
            $this->response($resp);
        }
        else
        { 
            if($data['paymet_methd']=='cod')
            {
                $checkout_details_data = $this->common_model->getAllRecordsById('user_checkout_master', array('user_id' =>$data['user_id'],"checkout_id"=>$data['checkout_id'],"place_order_status"=>0));
                if(count($checkout_details_data)>0)
                {
                    $rand=rand();
                    $rand1=rand();
                    $date=date('Y-m-d H:i:s');
                    $sale_order_insert=array("user_id"=>$checkout_details_data[0]['user_id'],"invoice_no"=>$rand,"transaction_no"=>$rand1,"checkout_id"=>$checkout_details_data[0]['checkout_id'],"total_product_amount"=>$checkout_details_data[0]['total_product_price'],"total_tax_amount"=>$checkout_details_data[0]['total_tax_price'],"total_discount_amount"=>$checkout_details_data[0]['total_discount_price'],"total_offer_amount"=>$checkout_details_data[0]['total_offer_price'],"total_shipping_amount"=>$checkout_details_data[0]['total_shipping'],"total_sale_price"=>$checkout_details_data[0]['total_sale_price'],"total_qty"=>$checkout_details_data[0]['total_product_qty'],"payment_method"=>$data['paymet_methd'],"payment_status"=>"pendding","delevery_status"=>1,"payment_amount"=>$checkout_details_data[0]['total_sale_price'],"added_by"=>$data['user_id'],"added_date"=>$date,"added_ip"=>$_SERVER['REMOTE_ADDR']);
                     $sales_id = $this->common_model->insertData("sales_order_master",$sale_order_insert);

                }
                else
                {
                    $sales_id=0;
                }               
            }
            else
            {
                $checkout_details_data = $this->common_model->getAllRecordsById('sales_order_master', array('user_id' =>$data['user_id'],"checkout_id"=>$data['checkout_id'],"place_order_status"=>0));
                if(count($checkout_details_data)>0)
                {
                    $rand=rand();
                    $rand1=rand();
                    $date=date('Y-m-d H:i:s');
                    $sale_order_insert=array("user_id"=>$checkout_details_data[0]['user_id'],"invoice_no"=>$rand,"transaction_no"=>$rand1,"checkout_id"=>$checkout_details_data[0]['checkout_id'],"total_product_amount"=>$checkout_details_data[0]['total_product_price'],"total_tax_amount"=>$checkout_details_data[0]['total_tax_price'],"total_discount_amount"=>$checkout_details_data[0]['total_discount_price'],"total_offer_amount"=>$checkout_details_data[0]['total_offer_price'],"total_shipping_amount"=>$checkout_details_data[0]['total_shipping'],"total_sale_price"=>$checkout_details_data[0]['total_sale_price'],"total_qty"=>$checkout_details_data[0]['total_product_qty'],"payment_method"=>$data['paymet_methd'],"payment_status"=>"pendding","delevery_status"=>0,"payment_amount"=>$checkout_details_data[0]['total_sale_price'],"added_by"=>$data['user_id'],"added_date"=>$date,"added_ip"=>$_SERVER['REMOTE_ADDR']);
                     $sales_id = $this->common_model->insertData("user_checkout_master",$cat_uuper_data);

                }   
                else
                {
                    $sales_id=0;
                }
            }
            if($sales_id!=0)
            {
                $checkout_product_data = $this->common_model->getAllRecordsById('checkuot_product_list', array('checkout_id' =>$data['checkout_id']));
                if(count($checkout_product_data)>0)
                {
                    for($i=0;$i<count($checkout_product_data);$i++)
                    {
                        $product_data=array("sale_order_id"=>$sales_id,"product_id"=>$checkout_product_data[$i]['product_id'],"product_name"=>$checkout_product_data[$i]['product_name'],"product_qty"=>$checkout_product_data[$i]['pro_qty'],"product_price"=>$checkout_product_data[$i]['product_price'],"tax_amount"=>$checkout_product_data[$i]['tax_amount'],"dicount_amount"=>$checkout_product_data[$i]['dicount_amount'],"offer_amount"=>$checkout_product_data[$i]['offer_amount'],"sale_amount"=>$checkout_product_data[$i]['sales_amount'],"added_by"=>$checkout_product_data[$i]['product_id'],"added_date"=>$date,"added_ip"=>$_SERVER['REMOTE_ADDR']);
                        $checkuot_product_id = $this->common_model->insertData("sales_order_product",$product_data);

                    }
                }
            }
         
           
            // $this->session->set_userdata('sales_id',$sales_id);
            // $this->session->set_userdata('payment_method',$data['paymet_methd']);
            // if($data['paymet_methd']=='cod')
            // {
            //     $url="users/success_url_get".$data['paymet_methd'];
            //     redirect($url,"refresh");
            // } 
            /************************************************************************/
            // $status=$this->session->userdata('payment_method');
            // $this->session->unsetset_userdata('payment_method');
            // if($status!='cod')
            // {

            // }
            // $sales_order_id=$this->session->userdata('sales_id');
            // echo $sales_order_id;
          
            // $this->session->unsetset_userdata('sales_id');
            $order_details_data = $this->common_model->getAllRecordsById('sales_order_master', array('sale_order_id'=>$sales_id,"delevery_status !="=>0));
           
            if(count($order_details_data)>0)
            {
                $return_data_arrray=array();
                for($i=0;$i<count($order_details_data);$i++)
                {
                    $sale_order_id=$order_details_data[$i]['sale_order_id'];
                    $invoice_no=$order_details_data[$i]['invoice_no'];
                    $transaction_no=$order_details_data[$i]['transaction_no'];
                    $payment_method=$order_details_data[$i]['payment_method'];
                    $payment_status=$order_details_data[$i]['payment_status'];
                    $delevery_status=$order_details_data[$i]['delevery_status'];
                    $total_qty=$order_details_data[$i]['total_qty'];
                    $order_date=date('Y-m-d',strtotime($order_details_data[$i]['added_date']));
                    if($delevery_status==0)
                    {
                        $delevery_status="Ordered";
                    }
                    else if($delevery_status==1)
                    {
                        $delevery_status="shipped";
                    }
                    else if($delevery_status==2)
                    {
                        $delevery_status="In a way";
                    }
                    else if($delevery_status==3)
                    {
                        $delevery_status="Recive";
                    }
                    $total_shipping_amount=$order_details_data[$i]['total_shipping_amount'];
                    $total_product_amount=$order_details_data[$i]['total_product_amount'];
                    $total_sale_price=$order_details_data[$i]['total_sale_price'];
                    $payment_amount=$order_details_data[$i]['payment_amount'];
                    $added_date=$order_details_data[$i]['added_date'];
                    $checkout_id=$order_details_data[$i]['checkout_id'];
                    $product_details_array=array();
                    $order_product_data = $this->common_model->getAllRecordsById('sales_order_product', array('sale_order_id' =>$sale_order_id));
                   
                    if(count($order_product_data)>0)
                    {
                        $l=0;
                        for($j=0;$j<count($order_product_data);$j++)
                        {
                            $product_details_array[$l]['sale_order_id']=$sale_order_id;
                            $product_details_array[$l]['product_id']=$order_product_data[$j]['product_id'];
                            $product_details_array[$l]['product_name']=$order_product_data[$j]['product_name'];
                            $product_details_array[$l]['product_qty']=$order_product_data[$j]['product_qty'];
                            $product_details_array[$l]['sale_amount']=$order_product_data[$j]['sale_amount'];
                            $product_details_array[$l]['added_date']=$order_product_data[$j]['added_date'];
                            
                            $product_data = $this->common_model->get_where_array('product_master', array('product_id' => $product_details_array[$l]['product_id']));
                            if(count($product_data)>0)
                            {
                                $product_list_array[$i]['product_name']=$product_data[0]['product_name'];
                                $suppliers_id=$product_data[0]['suppliers_id'];
                                $user_data = $this->common_model->get_where_array('users_master', array('user_id' => $suppliers_id));
                                if(count($user_data)>0)
                                {
                                    $user_fullname=$user_data[0]['user_fullname'];
                                }
                                else
                                {
                                    $user_fullname="";
                                }
                                $catlog_id=$product_data[0]['catlog_id'];
                                $catlog_data = $this->common_model->get_where_array('category_catlog_images', array('catlog_id' => $catlog_id));
                                if(count($catlog_data)>0)
                                {
                                    $catlog_path=base_url()."uploads/catlog_images/".$catlog_data[0]['catlog_image'];
                                    $dispatch_min_days=$catlog_data[0]['dispatch_min_days'];
                                    $dispatch_max_days=$catlog_data[0]['dispatch_max_days'];
                                    if($payment_method=='cod')
                                    {
                                        $delivery_amount=$catlog_data[0]['delivery_amount'];
                                    }
                                    else
                                    {
                                        $delivery_amount==0.00;
                                    }
                                }
                                else
                                {
                                    $catlog_path="";
                                    $dispatch_min_days="0";
                                    $dispatch_max_days="0";
                                    $delivery_amount="0";
                                }
                                if($dispatch_max_days==0)
                                {
                                   $dispatch_max_days=1; 
                                }
                                $que="select image_path from  product_images where product_id='".$product_details_array[$l]['product_id']."' limit  1 ";
                                $user_cart_Data = $this->common_model->make_query($que);
                                if(!empty($user_cart_Data)) 
                                { 
                                    $image_path=base_url().$user_cart_Data[0]['image_path'];
                                }
                                else
                                {
                                    $image_path="";
                                }
                                $product_details_array[$l]['image_path']=$image_path;
                                
                            }
                           $l++; 
                        }
                    }
                    

                    $product_shipping_data = $this->common_model->get_where_array('shipping_address_master', array('checkout_id' => $checkout_id));
                    if(count($product_shipping_data)>0)
                    {
                        
                        $address=$product_shipping_data[0]['name']." ".$product_shipping_data[0]['address_line1']." ".$product_shipping_data[0]['addess_line2']." ".$product_shipping_data[0]['addess_line3']." ".$product_shipping_data[0]['city']." ".$product_shipping_data[0]['state']." ".$product_shipping_data[0]['pincode'];
                    }
                    else
                    {
                        $address="";
                    }
                    $delivery_date=date('Y-m-d', strtotime($order_date. ' + '.$dispatch_max_days.' days'));
                    $return_data_arrray[$i]=array("sale_order_id"=>$sale_order_id,"delevery_status"=>$delevery_status,"invoice_no"=>$invoice_no,"transaction_no"=>$transaction_no,"payment_method"=>$payment_method,"total_qty"=>$total_qty,"address"=>$address,"supplier_name"=>$user_fullname,"total_shipping_amount"=>$total_shipping_amount,"total_product_amount"=>$total_product_amount,"total_sale_price"=>$total_sale_price,"catlog_path"=>$catlog_path,"dispatch_min_days"=>$dispatch_min_days,"dispatch_max_days"=>$dispatch_min_days,"delivery_amount"=>$delivery_amount,"order_date"=>$order_date,"delivery_date"=>$delivery_date,"product_details"=>$product_details_array);
                    
                    $l++;
                }
                $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('result' => $return_data_arrray));
            }
            else
            {
                $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('error' => 'FAILURE', 'error_label' => 'Record not found.'));
            }
             /************************************************************************/
        }
        $this->response($resp);
    }
   
    




	  /**
    * update shipping address
    */
    





    public function update_shippingadd_post() 
    {
        /* Check for required parameter */
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;
        $required_parameter = array('shipping_address_id','user_id','address_line1','addess_line2','addess_line3','city','district','state','country');
        $chk_error = check_required_value($required_parameter, $object_info);
        if ($chk_error) {
             $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
             $this->response($resp);
        }
        $data['edited_date'] = date('Y-m-d H:i:s');
         /* Check for valid user */
         $check_email = $this->common_model->getRecordCount('shipping_address_master', array('user_id' => $data['user_id']));
          if($check_email == 0) {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'USER_IS_NOT_EXISTS', 'error_label' => 'This user is not exists in our database.'));
            $this->response($resp);
          }   
            $uid = $data['shipping_address_id'];
            unset($data['shipping_address_id']);
            /* Update userdata */
            if(isset($data['shipping_address_id'])){
                 $checkemail = $this->common_model->getRecordCount('shipping_address_master', array('shipping_address_id' => $data['shipping_address_id'],'user_id' => $data['user_id']));
            }
            if($data){
                 $this->common_model->updateRecords('shipping_address_master', $data, array('shipping_address_id' => $uid));
            } 
            /* Get user data */
            $update_cartData = $this->common_model->getSingleRecordById('shipping_address_master', array('shipping_address_id' => $uid));
            if(!empty($update_cartData)) {    
                $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('card_data' =>$update_cartData ));
            } else { 
                $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' => 'Some error occured, please try again.'));
            }
        $this->response($resp);
   
    }
     /*
    all supplier service
    */
    public function bankdetailsbyadmin_post() 
    {

            /* Check for required parameter */
            $pdata = file_get_contents("php://input");
            $data = json_decode($pdata,true);
            $object_info = $data;  
            // $required_parameter = array('id');
            //             $chk_error = check_required_value($required_parameter, $object_info);
            //            if ($chk_error) {
            //                  $resp = array('code' => MISSING_PARAM, 'message' => ('YOU_HAVE_MISSED_A_PARAMETER_') . strtoupper($chk_error['param']));
            //                  $this->response($resp);
            //             }
            $admin_data = $this->common_model->getSingleRecordById('admin_master',array('id' => 1));
            if(!empty($admin_data)) {  
                $path = base_url().'uploads/';
                $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('result' => $admin_data,'img_url' => IMG_URL));
            } else {

                $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response'=> array('error' => 'FAILURE', 'error_label' => ('data not found')));
            }
         $this->response($resp);
    
    }
    /*
     Add To user bank details
    */
    public function add_user_bank_detail_post() {

        /* Check for required parameter */
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;

        $required_parameter = array('user_id','account_no','ifsc_code','account_name','bank_name','branch_name');
        $chk_error = check_required_value($required_parameter, $data);
        if ($chk_error) {
             $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }
        $check_email = $this->common_model->getRecordCount('users_account_details', array('user_id' => $data['user_id']));
        if($check_email > 0) {
            $accountid =	$this->common_model->updateRecords('users_account_details', $data,array('user_id' => $data['user_id']));

            $userbankData = $this->common_model->getSingleRecordById('users_account_details', array('users_account_id' => $accountid));
            $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('user_bank_data' => $userbankData));
            $this->response($resp);
        }else{
	        $data['added_date'] = date('Y-m-d H:i:s');
	        $data['status'] = 0;
	        $accountid = $this->common_model->addRecords('users_account_details', $data);
	        if($accountid) {        
	            /* Get add to cart data */
	            $userbankData = $this->common_model->getSingleRecordById('users_account_details', array('users_account_id' => $accountid));
	            $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('user_bank_data' => $userbankData));
	        } else {
	            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' => 'Some error occured, please try again.'));
	        }
        } 
        
        @$this->response($resp);
    
    }
     /*
    	get user bank details
    */
    public function getuserbankdetails_post() {

            /* Check for required parameter */
            $pdata = file_get_contents("php://input");
            $data = json_decode($pdata,true);
            $object_info = $data;  
            $required_parameter = array('user_id');
            $chk_error = check_required_value($required_parameter, $object_info);
           	if ($chk_error) {
                 $resp = array('code' => MISSING_PARAM, 'message' => ('YOU_HAVE_MISSED_A_PARAMETER_') . strtoupper($chk_error['param']));
                 $this->response($resp);
            }
            $admin_data = $this->common_model->getSingleRecordById('users_account_details',array('user_id' =>$data['user_id']));
            //print_r($admin_data); die;
            if(!empty($admin_data)) {  
                $path = base_url().'uploads/';
                $resp =  array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('user_bank_data' => $admin_data,'img_url' => IMG_URL));
            } else {

                $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response'=> array('error' => 'FAILURE', 'error_label' => ('data not found')));
            }
         $this->response($resp);
    
    }
    /*
     Add To Review
    */
    public function add_review_post() {

        /* Check for required parameter */
        $pdata = file_get_contents("php://input");
        $data = json_decode( $pdata,true );
        $object_info = $data;

        $required_parameter = array('user_id','catlog_id','suppiler_id','product_id','review_comment','review_rating');
        $chk_error = check_required_value($required_parameter, $data);
        if ($chk_error) {
             $resp = array('code' => MISSING_PARAM, 'message' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param']));
             @$this->response($resp);
        }
        // $check_email = $this->common_model->getRecordCount('review_master', array('user_id' => $data['user_id']));
        // if($check_email > 0) {
        //     $accountid =	$this->common_model->updateRecords('review_master', $data,array('user_id' => $data['user_id']));
        //     $userbankData = $this->common_model->getSingleRecordById('review_master', array('review_id' => $accountid));
        //     $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('review_master' => $userbankData));
        //     $this->response($resp);
        // }else{
	        $data['added_date'] = date('Y-m-d H:i:s');
	        $data['status'] = 0;
	        $accountid = $this->common_model->addRecords('review_master', $data);
	        if($accountid) {        
	            /* Get add to cart data */
	            $userbankData = $this->common_model->getSingleRecordById('review_master', array('review_id' => $accountid));
	            $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('review_master' => $userbankData));
	        } else {
	            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' => 'Some error occured, please try again.'));
	        //}
        } 
        
        @$this->response($resp);
    
    }
    /*
     List catlog review 
    */
    public function catlog_review_list_post() {

        /* Check for required parameter */
        $pdata = file_get_contents("php://input");
        $data = json_decode($pdata,true);
        $object_info = $data;  
        $required_parameter = array('catlog_id');
        $chk_error = check_required_value($required_parameter, $object_info);
        if ($chk_error) {
             $resp = array('code' => MISSING_PARAM, 'message' => ('YOU_HAVE_MISSED_A_PARAMETER_') . strtoupper($chk_error['param']));
             $this->response($resp);
        }

        $carttotal_data = $this->common_model->getAllRecordsById('review_master',array('catlog_id' => $data['catlog_id']));
        $path = base_url().'uploads/product_images/';
        if(!empty($carttotal_data)) {  
            $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('result' => $carttotal_data));
        } else {

            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' => 'catlog review empty'));
        }
        $this->response($resp);
    
    }
    /*
    List product review
    */
    public function product_review_list_post() {

        /* Check for required parameter */
        $pdata = file_get_contents("php://input");
        $data = json_decode($pdata,true);
        $object_info = $data;  
        $required_parameter = array('product_id');
        $chk_error = check_required_value($required_parameter, $object_info);
        if ($chk_error) {
             $resp = array('code' => MISSING_PARAM, 'message' => ('YOU_HAVE_MISSED_A_PARAMETER_') . strtoupper($chk_error['param']));
             $this->response($resp);
        }

        $carttotal_data = $this->common_model->getAllRecordsById('review_master',array('product_id' => $data['product_id']));
        $path = base_url().'uploads/product_images/';
        if(!empty($carttotal_data)) {  
            $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('result' => $carttotal_data));
        } else {

            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' => 'product review empty'));
        }
        $this->response($resp);
    
    }
    /* payment booking list*/

    public function payment_post(){

        $pdata = file_get_contents("php://input");
        $data = json_decode($pdata,true);
        //p($data);
        $required_parameter = array("checkout_id","card_number","exp_month","exp_year","cvv","currency_code");
        $chk_error = check_required_value($required_parameter, $data);

        if ($chk_error) {
             $resp = array('code' => MISSING_PARAM, 'message' => 'FAILURE',"response" => array("error" => "MISSED_A_PARAMETER","error_label"=> 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param'])));
             $this->response($resp);
        }
        $booking_id = $data["checkout_id"];
        $booking_data = $this->common_model->getDataBook("user_checkout_master",array("checkout_id" => $booking_id));

        if(!empty($booking_data))
        {
          $user_id = $booking_data[0]["user_id"];
          $amount =  $booking_data[0]["total_price"] * 100;
          $card_number = $data["card_number"];
          $exp_year = $data["exp_year"]; 
          $exp_month = $data["exp_month"]; 
          $cvv =  $data["cvv"];
          $currency_code =  $data["currency_code"];
         //print_r(STRIPE_SECRET_KEY); die();
          try { 
              require(APPPATH.'libraries/init.php'); // require stripe library
              \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY); //Replace with your Secret Key
              
              $token = Stripe\Token::create(array(
                "card" => array(
                "number" => $card_number,
                "exp_month" => $exp_month,
                "exp_year" => $exp_year,
                "cvc" => $cvv
                  )
              ));

              $charge = \Stripe\Charge::create(array(
                "amount" => $amount,
                "currency" => $currency_code,
                "card" => $token,
                "description" => "Demo Transaction"
              ));

              $chargeArray = $charge->__toArray(true);
              $p_status = $chargeArray["status"];
              $r_data = array();  
              $r_data["status"] =  ($p_status == "succeeded")? 1 : 0;
              $r_data["checkout_id"] = $booking_id;
              $r_data["card_no"] = $card_number;
              $r_data["transaction_no"] = $chargeArray["balance_transaction"];
              $r_data["payment_status"] = $p_status;
              $r_data["payment_method"] = $chargeArray["source"]["brand"];

              $this->common_model->addRecords("sales_order_master",$r_data);

              $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('payments' => $r_data));              
          }
          catch(Stripe_CardError $e) {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' =>  "Stripe_CardError : ".$e));
          }
          catch (Stripe_InvalidRequestError $e) {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' =>  "Stripe_InvalidRequestError : ".$e));
          } catch (Stripe_AuthenticationError $e) {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' =>  "Stripe_AuthenticationError : ".$e));
          } catch (Stripe_ApiConnectionError $e) {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' =>  "Stripe_ApiConnectionError : ".$e));
          } catch (Stripe_Error $e) {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' =>  "Stripe_Error : ".$e));
          } catch (Exception $e) {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' =>  "Exception : ".$e));
          }
        }else
        {
          $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' => 'No Data Found for this rent id'));
        }
        $this->response($resp);    
    
    }
    
    /*Update Guest User Travel Info*/

    public function testprofileimage_post() 
    {
      // Check for required parameter 
      $data = $_POST;
      $data = formatdata($data);
      $object_info = $data;
      $required_parameter = array("user_id");
      $chk_error = check_required_value($required_parameter, $object_info);
        if ($chk_error) 
        {
          $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' => 'YOU_HAVE_MISSED_A_PARAMETER_' . strtoupper($chk_error['param'])));
           $this->response($resp);
        }
        if(!empty($_FILES['user_image']['name'])) {  
                $config['file_name']     = time().$_FILES['user_image']['name']; 
                $config['upload_path']   = 'uploads/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|DOC|doc';
                $config['max_size']      = '10000';
                $config['max_width']     = '0';
                $config['max_height']    = '0';
                $config['remove_spaces'] = true;
                //$this->upload->initialize($config);
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('user_image')) {
                  $error = array('error' => $this->upload->display_errors());
                }
                else 
                {                         
                  $img = array('upload_data' => $this->upload->data());
                  $post_data['user_image'] = $img['upload_data']['file_name'];
                }
          }
          $profileId = $this->common_model->updateRecords('users_master', $post_data,array('user_id' => $data['user_id']));
          //print_r(expression)
          if($profileId) 
          {
            $profileData = $this->common_model->getSingleRecordById('users_master', array('user_id' => $data['user_id']));
            $resp = array('code' => SUCCESS, 'message' => 'SUCCESS', 'response' => array('user_data' => $profileData));
          } 
          else 
          {
            $resp = array('code' => ERROR, 'message' => 'FAILURE', 'response' => array('error' => 'FAILURE', 'error_label' =>'Some error occured, please try again.'));
          }
      $this->response($resp);
   
    }
}

?>
