<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        
    }
    
    public function index($msg = NULL)
    {
        if (!empty($this->session->userdata['user_role'])) {
            $log = $this->session->userdata['user_role'];
            if ($log == 1 || $log == 4) {
                redirect('admin/dashboard');
            } else if ($log == 2) {
                redirect('doctor/dashboard');
            } else if ($log == 3) {
                redirect('patient/dashboard');
            } else {
                $this->load->view('admin/login', $msg);
            }
        } else {
            if (isset($msg) && !empty($msg)) {
                $data['msg'] = $msg;
            } else {
                $data['msg'] = '';
            }
            $this->load->view('admin/login', $data);
        }
    }
    
    
    
    public function last_executed_query()
    {
        echo $this->db->last_query();
        die;
    }
    
    public function print_array($data = NULL)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
    
    
    public function verifylogin()
    {
        $data = $this->input->post();
        $this->controller->verifylogin($data);
    }
    
    
    public function dashboard()
    {
        if ($this->controller->checkSession()) {
            $data['body'] = 'dashboard';
            
            $where  = array(
                'is_active' => 1
            );
            $where1 = array(
                'user_role' => 3,
                'is_active' => 1
            );
            $where2 = array(
                'user_role' => 2,
                'is_active' => 1
            );
            $where3 = array(
                'user_role' => 2
            );
            $where4 = array(
                'sender_id ' => $this->session->userdata('id')
            );
            
            /* $field_val                = 'message.*,users.first_name,users.last_name';
            $data['messages_list']    = $this->model->GetJoinRecord('message', 'reciever_id', 'users', 'id', $field_val, $where4);
            $data['totalAppointment'] = $this->model->getcount('appointment', $where);
            $data['totalPatient']     = $this->model->getcount('users', $where1);
            $data['totalDoctor']      = $this->model->getcount('users', $where2);
            $data['appointmentList']  = $this->model->GetJoinRecord('appointment', 'doctor_id', 'users', 'id', '', $where3);*/
            $this->controller->load_view($data);
        } else {
            $this->index();
        }
    }
    
    public function setting()
    {
        $this->form_validation->set_rules('en_site_title', 'Site Title', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['setting'] = $this->model->getAll('settings');
            $data['body']    = 'setting';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                
                $en_site_title = $this->input->post('en_site_title');
                $hi_site_title = $this->input->post('hi_site_title');
                $en_meta_tags  = $this->input->post('en_meta_tags');
                $en_copyright  = $this->input->post('en_copyright');
                $en_contact_us = $this->input->post('en_contact_us');
                $hi_meta_tags  = $this->input->post('hi_meta_tags');
                $hi_copyright  = $this->input->post('hi_copyright');
                $hi_contact_us = $this->input->post('hi_contact_us');
                
                $data = array(
                    'en_site_title' => $en_site_title,
                    'en_meta_tags' => $en_meta_tags,
                    'en_copyright' => $en_copyright,
                    'en_contact_us' => $en_contact_us,
                    'hi_site_title' => $hi_site_title,
                    'hi_meta_tags' => $hi_meta_tags,
                    'hi_copyright' => $hi_copyright,
                    'hi_contact_us' => $hi_contact_us,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                if (isset($_FILES['favicon_icon']['name']) && !empty($_FILES['favicon_icon']['name'])) {
                    
                    if ($_FILES["favicon_icon"]["size"] > 500000) {
                        $this->session->set_flashdata('info_message', "favicon icon size too large");
                        redirect('admin/setting');
                    } else {
                        if (move_uploaded_file($_FILES['favicon_icon']['tmp_name'], 'asset/uploads/' . $_FILES['favicon_icon']['name'])) {
                            $data['favicon'] = $_FILES['favicon_icon']['name'];
                        }
                        
                    }
                }
                
                if (isset($_FILES['site_logo']['name']) && !empty($_FILES['site_logo']['name'])) {
                    
                    if ($_FILES["site_logo"]["size"] > 1000000) {
                        $this->session->set_flashdata('info_message', "Site Logo size too large");
                        redirect('admin/setting');
                    } else {
                        if (move_uploaded_file($_FILES['site_logo']['tmp_name'], 'asset/uploads/' . $_FILES['site_logo']['name'])) {
                            $data['logo'] = $_FILES['site_logo']['name'];
                        }
                        
                    }
                }
                
                
                $where  = array(
                    'id' => $this->input->post('id')
                );
                $result = $this->model->updateFields('settings', $data, $where);
                //$result = $this->model->insertData('setting', $data);
                //$this->message_list();
                redirect('admin/setting');
            }
            
            
        }
        
    }
    
    public function about()
    {
        $this->form_validation->set_rules('en_about_us', 'About us', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['about'] = $this->model->getAll('about_us');
            $data['body']  = 'about_us';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $en_about_us = $this->input->post('en_about_us');
                $hi_about_us = $this->input->post('hi_about_us');
                
                $data = array(
                    'en_about_us' => $en_about_us,
                    'hi_about_us' => $hi_about_us,
                    'created_at'  => date('Y-m-d H:i:s')
                    
                );
                
                $where  = array(
                    'id' => $this->input->post('id')
                );
                $result = $this->model->updateFields('about_us', $data, $where);
                
                redirect('admin/about');
            }
        }
    }
    public function privacy()
    {
        $this->form_validation->set_rules('en_privacy_policy', 'Privacy Policy', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['privacy'] = $this->model->getAll('privacy_policy');
            $data['body']    = 'privacy_policy';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $en_privacy_policy = $this->input->post('en_privacy_policy');
                $hi_privacy_policy = $this->input->post('hi_privacy_policy');
                
                $data = array(
                    'en_privacy_policy' => $en_privacy_policy,
                    'hi_privacy_policy' => $hi_privacy_policy,
                    'created_at'  => date('Y-m-d H:i:s')
                );
                
                $where  = array(
                    'id' => $this->input->post('id')
                );
                $result = $this->model->updateFields('privacy_policy', $data, $where);
                
                redirect('admin/privacy');
            }
        }
    }
    
    public function terms()
    {
        $this->form_validation->set_rules('en_terms', 'Terms And Condition', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['terms'] = $this->model->getAll('terms_conditions');
            $data['body']  = 'terms_conditions';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $en_terms = $this->input->post('en_terms');
                $hi_terms = $this->input->post('hi_terms');
                
                $data = array(
                    'en_terms' => $en_terms,
                    'hi_terms' => $hi_terms,
                    'created_at'  => date('Y-m-d H:i:s')
                );
                
                $where  = array(
                    'id' => $this->input->post('id')
                );
                $result = $this->model->updateFields('terms_conditions', $data, $where);
                
                redirect('admin/terms');
            }
        }
    }
    public function module($id = null)
    {
        $this->form_validation->set_rules('en_module_name', 'Module Name', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            if(!empty($id)){
                $where = array(
              'id ' => $id
              );
             $data['modules'] = $this->model->getAllwhere('modules', $where);
            }
            $data['body'] = 'add_module';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $en_module_name = $this->input->post('en_module_name');
                $hi_module_name = $this->input->post('hi_module_name');
                $is_active      = $this->input->post('status');
                
                $data = array(
                    'en_module_name' => $en_module_name,
                    'hi_module_name' => $hi_module_name,
                    'is_active' => $is_active,
                    'created_at' => date('Y-m-d H:i:s')
                );

               
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    
                    $result = $this->model->updateFields('modules', $data, $where);
                } else {
                    $result = $this->model->insertData('modules', $data);
                    
                }
                $this->moduleList();
            }
        }
    }
    
    public function moduleList()
    {
        $where           = array(
            'is_active' => 1
        );
        $data['modules'] = $this->model->getAllwhere('modules', $where);
        $data['body']    = 'modules_list';
        $this->controller->load_view($data);
    }
    
    public function edit_module($id)
    {
        $where           = array(
            'id ' => $id
        );
        $data['modules'] = $this->model->getAllwhere('modules', $where);
        $data['body']    = 'edit_module';
        
        $this->controller->load_view($data);
    }
    
    public function chapter($id = null)
    {
        $this->form_validation->set_rules('en_chapter_name', 'Chapter Name', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());

            if(!empty($id)){
                $where = array(
            'chapters.id ' => $id
           );
             $where1 = array(
                'is_active' => 1
            );
           $data['modules'] = $this->model->getAllwhere('modules', $where1);

           $data['chapter'] = $this->model->GetJoinRecord('chapters', 'fk_module_id', 'modules', 'id', 'chapters.id as ids,chapters.fk_module_id,chapters.en_chapter_name,chapters.hi_chapter_name,chapters.created_at,chapters.is_active,modules.en_module_name,modules.id', $where);


            }else{
           
            $where           = array(

                'is_active' => 1
            );
            $data['modules'] = $this->model->getAllwhere('modules', $where);


            }
            $data['body']    = 'add_chapter';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $fk_module_id    = $this->input->post('fk_module_id');
                $en_chapter_name = $this->input->post('en_chapter_name');
                $hi_chapter_name = $this->input->post('hi_chapter_name');
                $is_active       = $this->input->post('status');
                
                $data = array(
                    'fk_module_id' => $fk_module_id,
                    'en_chapter_name' => $en_chapter_name,
                    'hi_chapter_name' => $hi_chapter_name,
                    'is_active' => $is_active,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    
                    unset($data['created_at']);
                    
                    $result = $this->model->updateFields('chapters', $data, $where);
                } else {
                    $result = $this->model->insertData('chapters', $data);
                }
                
                $this->chapterList();
            }
        }
    }
    
    public function chapterList()
    {
        $data['chapter'] = $this->model->GetJoinRecord('chapters', 'fk_module_id', 'modules', 'id', 'chapters.id ,chapters.en_chapter_name,chapters.hi_chapter_name,chapters.created_at,chapters.is_active,modules.en_module_name');
        $data['body']    = 'chapter_list';
        $this->controller->load_view($data);
    }
    
    public function edit_chapter($id)
    {
        $where = array(
            'chapters.id ' => $id
        );
        
        $data['modules'] = $this->model->getAll('modules');
        $data['chapter'] = $this->model->GetJoinRecord('chapters', 'fk_module_id', 'modules', 'id', 'chapters.id as ids,chapters.fk_module_id,chapters.en_chapter_name,chapters.hi_chapter_name,chapters.created_at,chapters.is_active,modules.en_module_name,modules.id', $where);
        $data['body']    = 'edit_chapter';
        $this->controller->load_view($data);
    }
    
    public function check_database($password)
    {
        $username = $this->input->post('username', TRUE);
        $where    = array(
            'username' => $username,
            'password' => md5($password),
            'is_active' => 1
        );
        $result   = $this->model->getsingle('users', $where);
        
        if (!empty($result)) {
            
            $sess_array = array(
                'id' => $result->id,
                'username' => $result->username,
                'email' => $result->email,
                'user_role' => $result->user_role,
                'first_name' => $result->first_name,
                'last_name' => $result->last_name
            );
            
            if ($result->user_role == 4) {
                $where                = array(
                    'user_id' => $result->id
                );
                $sess_array['rights'] = $this->model->getsingle('user_rights', $where);
            }
            
            $this->session->set_userdata($sess_array);
            return true;
        } else {
            $this->form_validation->set_message('check_database', 'Invalid Credentials ! Please try again with valid username and password');
            return false;
        }
    }
    
    public function training($id = null)
    {
        
        $this->form_validation->set_rules('en_training_name', 'Training Name', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $where            = array(
                'is_active' => 1
            );
            $data['modules']  = $this->model->getAllwhere('modules', $where);
            $data['chapters'] = $this->model->getAllwhere('chapters', $where);
            $data['body']     = 'add_training';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $fk_module_id    = $this->input->post('fk_module_id');
                $en_chapter_name = $this->input->post('en_chapter_name');
                $hi_chapter_name = $this->input->post('hi_chapter_name');
                $is_active       = $this->input->post('status');
                
                $data = array(
                    'fk_module_id' => $fk_module_id,
                    'en_chapter_name' => $en_chapter_name,
                    'hi_chapter_name' => $hi_chapter_name,
                    'is_active' => $is_active,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    
                    unset($data['created_at']);
                    
                    $result = $this->model->updateFields('chapters', $data, $where);
                } else {
                    $result = $this->model->insertData('chapters', $data);
                }
                

                $this->trainingList();
             }
         }

    }

    public function trainingList(){
        $data['training']  = $this->model->getAll('training'); 
        $data['body']      = 'training_list';
        
        $this->controller->load_view($data);

    }

    public function edit_training($id){
         $where             = array(
            'id ' => $id
        );
        $data['modules']    = $this->model->getAll('modules');
        $data['chapters']   = $this->model->getAll('chapters');
        $data['training']   = $this->model->getAllwhere('training', $where);
        $data['body']       = 'edit_training';

        $this->controller->load_view($data);
    }

    public function getChapter(){

           $module_id = $this->input->post('module_id');
           $where = array(
            'fk_module_id ' => $module_id[0]
            );
            $data     = $this->model->getAllwhere('chapters', $where);

            echo json_encode($data);
    }

    public function question($id=null){
        $this->form_validation->set_rules('module_id', 'Module Name', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());

                 if(!empty($id)){
                     $where = array(
                'id ' => $id
                );
             $data['questions']  =$this->model->getAllwhere('questions',$where);
             $data['modules']    = $this->model->getAll('modules');
             $data['chapters']   = $this->model->getAll('chapters');
                 
             }else{
             $data['modules']    = $this->model->getAll('modules');
             $data['chapters']   = $this->model->getAll('chapters');
             }
             $data['body']       = 'add_question';
             $this->controller->load_view($data);
        } else {
             if ($this->controller->checkSession()) {
                $module_id           = $this->input->post('module_id');
                $chapter_id          = $this->input->post('chapter_id');
                $question_marks      = $this->input->post('question_marks');
                $question_type       = $this->input->post('question_type');
                $en_question         = $this->input->post('en_question');
                $hi_question         = $this->input->post('hi_question');
                $en_option_a         = $this->input->post('en_option_a');
                $en_option_b         = $this->input->post('en_option_b');
                $en_option_c         = $this->input->post('en_option_c');
                $en_option_d         = $this->input->post('en_option_d');
                $hi_option_a         = $this->input->post('hi_option_a');
                $hi_option_b         = $this->input->post('hi_option_b');
                $hi_option_c         = $this->input->post('hi_option_c');
                $hi_option_d         = $this->input->post('hi_option_d');
                
                if($question_type=='True False'){
                    $en_answer           = $this->input->post('en_answers');
                }else{
                    $en_answer           = $this->input->post('en_answer');    
                }
                
                $hi_answer           = $this->input->post('hi_answer');
                $en_explaination     = $this->input->post('en_explaination');
                $hi_explaination     = $this->input->post('hi_explaination');
                $is_active           = $this->input->post('status');

                 $data = array(
                    'module_id'              => $module_id, 
                    'chapter_id'             => $chapter_id,
                    'question_marks'         => $question_marks,
                    'question_type'          => $question_type,
                    'en_question'            => $en_question,
                    'hi_question'            => $hi_question,
                    'en_option_a'            => $en_option_a,
                    'en_option_b'            => $en_option_b,
                    'en_option_c'            => $en_option_c,
                    'en_option_d'            => $en_option_d,
                    'hi_option_a'            => $hi_option_a,
                    'hi_option_b'            => $hi_option_b,
                    'hi_option_c'            => $hi_option_c,
                    'hi_option_d'            => $hi_option_d,
                    'en_answer'              => $en_answer,
                    'hi_answer'              => $hi_answer,
                    'en_explaination'        => $en_explaination,
                    'hi_explaination'        => $hi_explaination,
                    'is_active'              => $is_active,
                    'created_at'             => date('Y-m-d H:i:s')
                );

                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                  
                    unset($data['created_at']);

                     $result = $this->model->updateFields('questions', $data, $where);
                } else {
                     $result = $this->model->insertData('questions', $data);
                } 
                   $this->questionList();

             }
         }
       
    }
    
    public function questionList(){
        $data['question']  = $this->model->getAll('questions'); 
        $data['body']      = 'question_list';

        $this->controller->load_view($data);

    }

    public function exam($id=null){
        $this->form_validation->set_rules('training_id', 'Training Name', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());

                 if(!empty($id)){
                     $where = array(
                'id ' => $id
                );
             $data['training']  =$this->model->getAllwhere('training',$where);
             }else{
             $data['training']    = $this->model->getAll('training');
            
             }
             $data['body']       = 'add_exam';
             $this->controller->load_view($data);
        } else {
             if ($this->controller->checkSession()) {
             }
         }

    }
    public function change_password()
    {
        $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['body'] = 'change_password';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                
                $data   = array(
                    'password' => md5($this->input->post('new_password', TRUE))
                );
                $where  = array(
                    'id' => $this->session->userdata('id')
                );
                $table  = 'users';
                $result = $this->model->updateFields($table, $data, $where);
                redirect('admin/change_password', 'refresh');
            }
        }
    }

    public function oldpass_check($oldpass)
    {
        $user_id = $this->session->userdata('id');
        $result  = $this->model->check_oldpassword($oldpass, $user_id);
        if ($result == 0) {
            $this->form_validation->set_message('oldpass_check', "%s does not match.");
            return FALSE;
        } else {
            $this->session->set_flashdata('success_msg', 'Password Successfully Updated!!!');
            return TRUE;
        }
    }

    public function logout()
    {
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
        $this->session->sess_destroy();
        $msg = "You have been logged out Successfully...";
        $this->index($msg);
    }
    
    
    
    public function register($id = null, $user_role = null)
    {
        $role = $user_role;
        
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha|min_length[2]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha|min_length[2]');
        $this->form_validation->set_rules('dob', 'Date Of Birth', 'trim|required');
        // $this->form_validation->set_rules('category', 'category', 'trim|required');
        if (empty($id)) {
            $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|is_unique[users.username]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|alpha_numeric');
            
            if ($role == 2) {
                $this->form_validation->set_rules('category', 'category', 'trim|required');
            }
        }
        
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['category']  = $this->model->getAll('category');
            $data['body']      = 'register';
            $data['user_role'] = "$role";
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                
                $user_role   = $this->input->post('user_role');
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
                
                if ($user_role == 2) {
                    $category       = $this->input->post('category');
                    $specialization = $this->input->post('specialization');
                }
                
                
                $data = array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'username' => $user_name,
                    'email' => $email,
                    'password' => MD5($password),
                    'address' => $address,
                    'phone_no' => $phone_no,
                    'mobile' => $mobile_no,
                    'date_of_birth' => $dob,
                    'gender' => $gender,
                    'blood_group' => $blood_group,
                    'is_active' => $status,
                    'user_role' => $user_role,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                
                if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                    $count = count($_FILES['image']['name']);
                    for ($i = 0; $i < $count; $i++) {
                        if ($_FILES['image']['error'][$i] == 0) {
                            if (move_uploaded_file($_FILES['image']['tmp_name'][$i], 'asset/uploads/' . $_FILES['image']['name'][$i])) {
                                $data['profile_pic'] = $_FILES['image']['name'][$i];
                            }
                        }
                    }
                }
                
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    unset($data['email']);
                    unset($data['password']);
                    $result = $this->model->updateFields('users', $data, $where);
                } else {
                    $result = $this->model->insertData('users', $data);
                    if ($user_role == 2) {
                        $data = array(
                            'doctor_id' => $result,
                            'category' => $category,
                            'specialization' => $specialization,
                            'is_active' => $status,
                            'created_at' => date('Y-m-d H:i:s')
                        );
                        $data = $this->model->insertData('doctor', $data);
                    }
                }
                $this->users_list($user_role);
            }
        }
    }
    
    
    public function users_list($user_role = null)
    {
        
        $where = array(
            'user_role ' => $user_role
        );
        
        $where1 = array(
            'role_id ' => $user_role
        );
        
        $data['role']      = $user_role;
        $data['category']  = $this->model->getAll('category');
        $data['users']     = $this->model->getAllwhere('users', $where);
        $data['user_role'] = $this->model->getAllwhere('user_role', $where1);
        $data['body']      = 'users_list';
        
        $this->controller->load_view($data);
    }
    
    
    public function subadmin_users_list($user_role)
    {
        $where             = array(
            'user_role ' => $user_role
        );
        $where1            = array(
            'role_id ' => $user_role
        );
        $data['users']     = $this->model->getAllwhere('users', $where);
        $data['user_role'] = $this->model->getAllwhere('user_role', $where1);
        $data['body']      = 'subadmin_users_list';
        $this->controller->load_view($data);
    }
    
    public function assign_rights($id)
    {
        $data['user_id']     = $id;
        $where               = array(
            'is_active' => 1
        );
        $data['rights_menu'] = $this->model->getAllwhere('rights_menu', $where);
        $where1              = array(
            'user_id' => $id
        );
        $data['user_rights'] = $this->model->getsingle('user_rights', $where1);
        $data['body']        = 'assign_rights';
        $this->controller->load_view($data);
        
    }
    
    public function addRights($id = null)
    {
        $actions = array(
            'add',
            'edit',
            'delete'
        );
        
        $user_roles = $this->input->post('user_role');
        $role       = json_encode(implode(',', $user_roles));
        $rights     = '';
        $user_id    = $this->input->post('user_id');
        
        foreach ($user_roles as $user_role) {
            foreach ($actions as $action) {
                if ($this->input->post($user_role . '_' . $action)) {
                    $rights .= 1;
                } else {
                    $rights .= 0;
                }
            }
            $rights .= ',';
        }
        
        $right = json_encode(rtrim($rights, ','));
        
        $data = array(
            'user_id' => $user_id,
            'roles' => $role,
            'rights' => $right,
            'created_at' => date('Y-m-d H:i:s'),
            'is_active' => 1
        );
        
        $where = array(
            'user_id' => $user_id
        );
        
        $user_rights = $this->model->getsingle('user_rights', $where);
        
        if (!empty($user_rights)) {
            $result = $this->model->updateFields('user_rights', $data, $where);
        } else {
            $result = $this->model->insertData('user_rights', $data);
        }
        
        $this->subadmin_users_list('4');
    }
    
    
    public function edit_user($id)
    {
        $where             = array(
            'id ' => $id
        );
        $where1            = array(
            'role_id >' => $this->session->userdata('user_role')
        );
        $data['user_role'] = $this->model->getAllwhere('user_role', $where1);
        $data['users']     = $this->model->getAllwhere('users', $where);
        $data['body']      = 'edit_user';
        $this->controller->load_view($data);
    }
    
    
    public function delete()
    {
        $id    = $this->input->post('id');
        $table = $this->input->post('table');
        $where = array(
            'id' => $id
        );
        $this->model->delete($table, $where);
    }
    
    public function change_status()
    {
        $id     = $this->input->post('id');
        $table  = $this->input->post('table');
        $where  = array(
            'id' => $id
        );
        $data   = array(
            'is_active' => 0
        );
        $result = $this->model->updateFields($table, $data, $where);
    }
    
    
    public function profile()
    {
        $where         = array(
            'id' => $this->session->userdata('id')
        );
        $data['users'] = $this->model->getAllwhere('users', $where);
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha|min_length[2]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha|min_length[2]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required');
        
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['body'] = 'profile';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                
                $first_name = $this->input->post('first_name');
                $last_name  = $this->input->post('last_name');
                $email      = $this->input->post('email');
                $address    = $this->input->post('address');
                $phone_no   = $this->input->post('phone');
                $mobile_no  = $this->input->post('mobile');
                $dob        = $this->input->post('date_of_birth');
                $gender     = $this->input->post('gender');
                
                $data = array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'address' => $address,
                    'phone_no' => $phone_no,
                    'mobile' => $mobile_no,
                    'date_of_birth' => $dob,
                    'gender' => $gender
                );
                
                
                if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                    
                    if (move_uploaded_file($_FILES['image']['tmp_name'], 'asset/uploads/' . $_FILES['image']['name'])) {
                        
                        $data['profile_pic'] = $_FILES['image']['name'];
                    }
                }
                
                $result = $this->model->updateFields('users', $data, $where);
                redirect('/admin/profile', 'refresh');
            }
        }
    }
    
    
    public function send_mail()
    {
        $where         = array(
            'user_role != ' => $this->session->userdata('user_role')
        );
        $data['users'] = $this->model->getAllwhere('users', $where);
        $this->form_validation->set_rules('reciever_id', 'Mail to', 'trim|required');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
        
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['body'] = 'send_mail';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                
                $reciever_id = $this->input->post('reciever_id');
                $subject     = $this->input->post('subject');
                $message     = $this->input->post('message');
                $sender_id   = $this->session->userdata('id');
                
                $data = array(
                    'reciever_id' => $reciever_id,
                    'sender_id'   => $sender_id,
                    'subject'     => $subject,
                    'message'     => trim($message),
                    'is_active'   => 1,
                    'created_at'  => date('Y-m-d H:i:s')
                );
                
                $config_mail = Array(
                    'protocol'  => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => '465',
                    'smtp_user' => 'webdeskytechnical@gmail.com',
                    'smtp_pass' => 'webdesky@2017',
                    'mailtype'  => 'html',
                    'charset'   => 'iso-8859-1',
                    'newline'   => "\r\n"
                );
                
                $this->load->library('email', $config_mail);
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");
                $this->email->from($this->session->userdata('email'), "Admin Team");
                $this->email->to($reciever_id);
                $this->email->subject($subject);
                $this->email->message($message);
                
                if (!$this->email->send()) {
                    show_error($this->email->print_debugger());
                }
                
                $result = $this->model->insertData('mail', $data);
                $this->mail_list();
            }
        }
    }
    
    public function mail_list()
    {
        $where             = array(
            'sender_id =' => $this->session->userdata('id')
        );
        $field_val         = 'mail.*,users.first_name,users.last_name';
        $data['mail_list'] = $this->model->GetJoinRecord('mail', 'reciever_id', 'users', 'id', $field_val, $where);
        $data['body']      = 'mail_list';
        $this->controller->load_view($data);
    }
    
    public function send_message()
    {
        $where         = array(
            'user_role != ' => $this->session->userdata('user_role')
        );
        $data['users'] = $this->model->getAllwhere('users', $where);
        $this->form_validation->set_rules('reciever_id', 'Mail to', 'trim|required');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['body'] = 'send_message';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $reciever_id = $this->input->post('reciever_id');
                $subject     = $this->input->post('subject');
                $message     = $this->input->post('message');
                $sender_id   = $this->session->userdata('id');
                
                $data = array(
                    'reciever_id' => $reciever_id,
                    'sender_id' => $sender_id,
                    'subject' => $subject,
                    'message' => trim($message),
                    'is_active' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                $result = $this->model->insertData('message', $data);
                $this->message_list();
            }
        }
    }
    
    public function message_list()
    {
        $where = array(
            'sender_id ' => $this->session->userdata('id')
        );
        
        $field_val             = 'message.*,users.first_name,users.last_name';
        $data['messages_list'] = $this->model->GetJoinRecord('message', 'reciever_id', 'users', 'id', $field_val, $where);
        $data['body']          = 'message_list';
        $this->controller->load_view($data);
    }
    
    
    public function check_password()
    {
        $old_password = $this->input->post('data');
        $where        = array(
            'id' => $this->session->userdata('id'),
            'password' => md5($old_password)
        );
        $result       = $this->model->getsingle('users', $where);
        if (!empty($result)) {
            echo '0';
        } else {
            echo '1';
        }
    }
    
    
    function file_upload($file)
    {
        if (!empty($file['logo']['name'])) {
            $f_name      = $file['logo']['name'];
            $f_tmp       = $file['logo']['tmp_name'];
            $f_size      = $file['logo']['size'];
            $f_extension = explode('.', $f_name); //To breaks the string into array
            $f_extension = strtolower(end($f_extension)); //end() is used to retrun a last element to the array
            $f_newfile   = "";
            
            if ($f_name) {
                $f_newfile = uniqid() . '.' . $f_extension; // It`s use to stop overriding if the image will be same then uniqid() will generate the unique name of both file.
                $store     = 'asset/uploads/' . $f_newfile;
                $image1    = move_uploaded_file($f_tmp, $store);
                return $f_newfile;
            }
        }
    }
    
    function get_record()
    {
        $id     = $this->input->get('id');
        $table  = $this->input->get('table');
        $field  = $this->input->get('field');
        $where  = array(
            "$field" => $id
        );
        $select = 'id, name';
        $states = $this->model->getAllwhere($table, $where, $select);
        echo json_encode($states);
    }
}