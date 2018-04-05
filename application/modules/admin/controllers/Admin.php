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
            if ($log == 1) {
                redirect('admin/dashboard');
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
            $data['body']          = 'dashboard';
            $where1                = array(
                'user_role !=' => 1,
                'is_active' => 1
            );
            $where                 = array(
                'is_active' => 1
            );
            $data['totaluser']     = $this->model->getcount('users', $where1);
            $data['totalquestion'] = $this->model->getcount('questions', $where);
            $data['totalpost']     = $this->model->getcount('post', $where);
            $data['totalexam']     = $this->model->getcount('exam', $where);
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
                $en_site_title    = $this->input->post('en_site_title');
                $hi_site_title    = $this->input->post('hi_site_title');
                $en_meta_tags     = $this->input->post('en_meta_tags');
                $en_copyright     = $this->input->post('en_copyright');
                $contact_us_phone = $this->input->post('contact_us_phone');
                $hi_meta_tags     = $this->input->post('hi_meta_tags');
                $hi_copyright     = $this->input->post('hi_copyright');
                $contact_us_email = $this->input->post('contact_us_email');
                $tw_url           = $this->input->post('tw_url');
                $insta_url        = $this->input->post('insta_url');
                $linkedin_url     = $this->input->post('linkedin_url');
                $fb_url           = $this->input->post('fb_url');
                $gplus_url        = $this->input->post('gplus_url');
                
                $data = array(
                    'en_site_title' => $en_site_title,
                    'en_meta_tags' => $en_meta_tags,
                    'en_copyright' => $en_copyright,
                    'contact_us_phone' => $contact_us_phone,
                    'hi_site_title' => $hi_site_title,
                    'hi_meta_tags' => $hi_meta_tags,
                    'hi_copyright' => $hi_copyright,
                    'contact_us_email' => $contact_us_email,
                    'twitter_url' => $tw_url,
                    'insta_url' => $insta_url,
                    'linkedin_url' => $linkedin_url,
                    'fb_url' => $fb_url,
                    'gplus_url' => $gplus_url,
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
                redirect('admin/setting');
            }
        }
    }
    public function about()
    {
        $this->form_validation->set_rules('en_about_us', 'About us in English', 'trim|required');
        $this->form_validation->set_rules('hi_about_us', 'About us in Hindi', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['about'] = $this->model->getAll('settings');
            $data['body']  = 'about_us';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $en_about_us = $this->input->post('en_about_us');
                $hi_about_us = $this->input->post('hi_about_us');
                
                $data = array(
                    'en_about_us' => $en_about_us,
                    'hi_about_us' => $hi_about_us,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                $where  = array(
                    'id' => $this->input->post('id')
                );
                $result = $this->model->updateFields('settings', $data, $where);
                
                redirect('admin/about');
            }
        }
    }
    public function privacy()
    {
        $this->form_validation->set_rules('en_privacy_policy', 'Privacy Policy in English', 'trim|required');
        $this->form_validation->set_rules('hi_privacy_policy', 'Privacy Policy in Hindi', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['privacy'] = $this->model->getAll('settings');
            $data['body']    = 'privacy_policy';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $en_privacy_policy = $this->input->post('en_privacy_policy');
                $hi_privacy_policy = $this->input->post('hi_privacy_policy');
                $data              = array(
                    'en_privacy_policy' => $en_privacy_policy,
                    'hi_privacy_policy' => $hi_privacy_policy,
                    'created_at' => date('Y-m-d H:i:s')
                );
                $where             = array(
                    'id' => $this->input->post('id')
                );
                $result            = $this->model->updateFields('settings', $data, $where);
                redirect('admin/privacy');
            }
        }
    }
    public function terms()
    {
        $this->form_validation->set_rules('en_terms', 'Terms And Condition in English', 'trim|required');
        $this->form_validation->set_rules('hi_terms', 'Terms And Condition in Hindi', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['terms'] = $this->model->getAll('settings');
            $data['body']  = 'terms_conditions';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $en_terms = $this->input->post('en_terms');
                $hi_terms = $this->input->post('hi_terms');
                $data     = array(
                    'en_terms' => $en_terms,
                    'hi_terms' => $hi_terms,
                    'created_at' => date('Y-m-d H:i:s')
                );
                $where  = array(
                    'id' => $this->input->post('id')
                );
                $result = $this->model->updateFields('settings', $data, $where);
                redirect('admin/terms');
            }
        }
    }
    public function module($id = NULL)
    {
        $this->form_validation->set_rules('en_module_name', 'Module Name', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            if (!empty($id)) {
                $where           = array(
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
                
                if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                    
                    if ($_FILES["image"]["size"] > 500000) {
                        $this->session->set_flashdata('info_message', "Module icon size too large");
                        redirect('admin/module');
                    } else {
                        if (move_uploaded_file($_FILES['image']['tmp_name'], 'asset/uploads/' . $_FILES['image']['name'])) {
                            $data['image'] = $_FILES['image']['name'];
                        }
                    }
                }
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
        $data['modules'] = $this->model->getAll('modules');
        $data['body']    = 'modules_list';
        $this->controller->load_view($data);
    }
    public function category($id = NULL)
    {
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('status', 'Status ', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            if (!empty($id)) {
                $where            = array(
                    'id ' => $id
                );
                $data['category'] = $this->model->getAllwhere('category', $where);
            }
            $data['body'] = 'add_category';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $category_name = $this->input->post('category_name');
                $is_active     = $this->input->post('status');
                
                $data = array(
                    'category_name' => $category_name,
                    'is_active' => $is_active,
                    'created_at' => date('Y-m-d H:i:s')
                );
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    
                    $result = $this->model->updateFields('category', $data, $where);
                } else {
                    $result = $this->model->insertData('category', $data);
                }
                $this->categoryList();
            }
        }
    }
    public function categoryList()
    {
        $data['category'] = $this->model->getAll('category');
        $data['body']     = 'category_list';
        $this->controller->load_view($data);
    }
    public function link($id = NULL)
    {
        $this->form_validation->set_rules('category_id', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('title', 'title Name', 'trim|required');
        $this->form_validation->set_rules('url', 'url Name', 'trim|required');
        $this->form_validation->set_rules('status', 'Status ', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            if (!empty($id)) {
                $where        = array(
                    'featured_links.id ' => $id
                );
                $data['link'] = $this->model->GetJoinRecord('featured_links', 'category_id', 'category', 'id', 'featured_links.id,featured_links.title,featured_links.url,featured_links.created_at,featured_links.is_active,category.category_name,category.id as category_id', $where);
            }
            
            $data['category'] = $this->model->getAll('category');
            $data['body']     = 'add_link';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $category_id = $this->input->post('category_id');
                $is_active   = $this->input->post('status');
                $title       = $this->input->post('title');
                $url         = $this->input->post('url');
                $data        = array(
                    'category_id' => $category_id,
                    'title' => $title,
                    'url' => $url,
                    'is_active' => $is_active,
                    'created_at' => date('Y-m-d H:i:s')
                );
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    
                    $result = $this->model->updateFields('featured_links', $data, $where);
                } else {
                    $result = $this->model->insertData('featured_links', $data);
                }
                $this->linkList();
            }
        }
    }
    public function linkList()
    {
        $data['link'] = $this->model->GetJoinRecord('featured_links', 'category_id', 'category', 'id', 'featured_links.id,featured_links.title,featured_links.url,featured_links.created_at,featured_links.is_active,category.category_name');
        $data['body'] = 'link_list';
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
    public function chapter($id = NULL)
    {
        $this->form_validation->set_rules('en_chapter_name', 'Chapter Name', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            
            if (!empty($id)) {
                $where           = array(
                    'chapters.id ' => $id
                );
                $where1          = array(
                    'is_active' => 1
                );
                $data['modules'] = $this->model->getAllwhere('modules', $where1);
                $data['chapter'] = $this->model->GetJoinRecord('chapters', 'fk_module_id', 'modules', 'id', 'chapters.id as ids,chapters.fk_module_id,chapters.en_chapter_name,chapters.hi_chapter_name,chapters.created_at,chapters.is_active,modules.en_module_name,modules.id', $where);
            } else {
                $where           = array(
                    'is_active' => 1
                );
                $data['modules'] = $this->model->getAllwhere('modules', $where);
            }
            $data['body'] = 'add_chapter';
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
        $where           = array(
            'chapters.id' => $id
        );
        $data['modules'] = $this->model->getAll('modules');
        $data['chapter'] = $this->model->GetJoinRecord('chapters', 'fk_module_id', 'modules', 'id', 'chapters.id as ids,chapters.fk_module_id,chapters.en_chapter_name,chapters.hi_chapter_name,chapters.created_at,chapters.is_active,modules.en_module_name,modules.id', $where);
        $data['body']    = 'edit_chapter';
        $this->controller->load_view($data);
    }
    public function menu($id = NULL)
    {
        $this->form_validation->set_rules('module_id', 'Module Name', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            if (!empty($id)) {
                $where           = array(
                    'id' => $id
                );
                $data['menu']    = $this->model->getAllwhere('menu', $where);
                $data['modules'] = $this->model->getAllwhere('modules');
            } else {
                $where           = array(
                    'is_active' => 1
                );
                $data['modules'] = $this->model->getAllwhere('modules', $where);
            }
            $data['body'] = 'add_menu';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                
                $module_id        = $this->input->post('module_id');
                $en_menu_name     = $this->input->post('en_menu_name');
                $hi_menu_name     = $this->input->post('hi_menu_name');
                $url              = $this->input->post('url');
                $meta_title       = $this->input->post('meta_title');
                $meta_description = $this->input->post('meta_description');
                $meta_keyword     = $this->input->post('meta_keyword');
                $is_active        = $this->input->post('status');
                
                $data = array(
                    'module_id' => $module_id,
                    'en_menu_name' => $en_menu_name,
                    'hi_menu_name' => $hi_menu_name,
                    'url' => $url,
                    'meta_title' => $meta_title,
                    'meta_description' => $meta_description,
                    'meta_keyword' => $meta_keyword,
                    'is_active' => $is_active,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                if (isset($_FILES['category_image']['name']) && !empty($_FILES['category_image']['name'])) {
                    $count = count($_FILES['category_image']['name']);
                    if (move_uploaded_file($_FILES['category_image']['tmp_name'], 'asset/uploads/' . $_FILES['category_image']['name'])) {
                        $data['category_image'] = $_FILES['category_image']['name'];
                    }
                }
                
                if (isset($_FILES['banner_image']['name']) && !empty($_FILES['banner_image']['name'])) {
                    $count = count($_FILES['banner_image']['name']);
                    if (move_uploaded_file($_FILES['banner_image']['tmp_name'], 'asset/uploads/' . $_FILES['banner_image']['name'])) {
                        $data['banner_image'] = $_FILES['banner_image']['name'];
                    }
                }
                
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    
                    unset($data['created_at']);
                    
                    $result = $this->model->updateFields('menu', $data, $where);
                } else {
                    $result = $this->model->insertData('menu', $data);
                }
                $this->menuList();
            }
        }
    }
    public function menuList()
    {
        $where        = array(
            'menu.is_active' => 1
        );
        $data['menu'] = $this->model->GetJoinRecord('menu', 'module_id', 'modules', 'id', 'menu.en_menu_name,hi_menu_name,menu.id as id,modules.en_module_name,menu.created_at', $where);
        $data['body'] = 'menu_list';
        $this->controller->load_view($data);
    }
    public function sub_menu($id = NULL)
    {
        $this->form_validation->set_rules('menu_id', 'Menu Name', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            if (!empty($id)) {
                $where            = array(
                    'sub_menu.id' => $id
                );
                $data['sub_menu'] = $this->model->getAllwhere('sub_menu', $where);
                $data['menu']     = $this->model->getAllwhere('menu');
            } else {
                $where        = array(
                    'is_active' => 1
                );
                $data['menu'] = $this->model->getAllwhere('menu', $where);
            }
            $data['body'] = 'add_sub_menu';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                
                $menu_id          = $this->input->post('menu_id');
                $en_sub_menu_name = $this->input->post('en_sub_menu_name');
                $hi_sub_menu_name = $this->input->post('hi_sub_menu_name');
                $url              = $this->input->post('url');
                $meta_title       = $this->input->post('meta_title');
                $meta_description = $this->input->post('meta_description');
                $meta_keyword     = $this->input->post('meta_keyword');
                $is_active        = $this->input->post('status');
                
                $data = array(
                    'menu_id' => $menu_id,
                    'en_sub_menu_name' => $en_sub_menu_name,
                    'hi_sub_menu_name' => $hi_sub_menu_name,
                    'url' => $url,
                    'meta_title' => $meta_title,
                    'meta_description' => $meta_description,
                    'meta_keyword' => $meta_keyword,
                    'is_active' => $is_active,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                if (isset($_FILES['category_image']['name']) && !empty($_FILES['category_image']['name'])) {
                    $count = count($_FILES['category_image']['name']);
                    if (move_uploaded_file($_FILES['category_image']['tmp_name'], 'asset/uploads/' . $_FILES['category_image']['name'])) {
                        $data['category_image'] = $_FILES['category_image']['name'];
                    }
                }
                
                if (isset($_FILES['banner_image']['name']) && !empty($_FILES['banner_image']['name'])) {
                    $count = count($_FILES['banner_image']['name']);
                    if (move_uploaded_file($_FILES['banner_image']['tmp_name'], 'asset/uploads/' . $_FILES['banner_image']['name'])) {
                        $data['banner_image'] = $_FILES['banner_image']['name'];
                    }
                }
                
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    
                    unset($data['created_at']);
                    
                    $result = $this->model->updateFields('sub_menu', $data, $where);
                } else {
                    $result = $this->model->insertData('sub_menu', $data);
                }
                
                $this->submenuList();
            }
        }
    }
    public function submenuList()
    {
        $where            = array(
            'sub_menu.is_active' => 1
        );
        $data['sub_menu'] = $this->model->GetJoinRecord('sub_menu', 'menu_id', 'menu', 'id', 'sub_menu.en_sub_menu_name,sub_menu.hi_sub_menu_name,sub_menu.id as id,menu.en_menu_name,sub_menu.created_at', $where);
        $data['body']     = 'sub_menu_list';
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
    public function super_sub_menu($id = NULL)
    {
        $this->form_validation->set_rules('sub_menu_id', 'Sub Menu Name', 'trim|required|numeric');
        $this->form_validation->set_rules('en_sub_menu_name', 'Super Sub Menu Name in English', 'trim|required');
        $this->form_validation->set_rules('hi_sub_menu_name', 'Super Sub Menu Name in Hindi', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            if (!empty($id)) {
                $where     = array(
                    'super_sub_menu.id' => $id
                );
                $field_val = 'super_sub_menu.en_super_sub_menu,
                            super_sub_menu.is_active,
                            super_sub_menu.hi_super_sub_menu,
                            super_sub_menu.id as super_sub_menu_id,
                            sub_menu.en_sub_menu_name,
                            sub_menu.created_at,
                            sub_menu.menu_id,
                            sub_menu.id as sub_menu_id,
                            super_sub_menu.url,
                            super_sub_menu.meta_title,
                            super_sub_menu.meta_description,
                            super_sub_menu.meta_keyword';
                
                $data['super_sub_menu'] = $this->model->GetJoinRecord('super_sub_menu', 'sub_menu_id', 'sub_menu', 'id', $field_val, $where);
                
                $where                                = array(
                    'id' => $data['super_sub_menu'][0]->menu_id
                );
                $select                               = 'en_menu_name';
                $menu_name                            = $this->model->getAllwhere('menu', $where, $select);
                $data['super_sub_menu'][0]->menu_name = $menu_name[0]->en_menu_name;
                $data['menu']                         = $this->model->getAllwhere('menu');
            } else {
                $where        = array(
                    'is_active' => 1
                );
                $data['menu'] = $this->model->getAllwhere('menu', $where);
                
            }
            $data['body'] = 'add_super_sub_menu';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                
                $sub_menu_id      = $this->input->post('sub_menu_id');
                $en_sub_menu_name = $this->input->post('en_sub_menu_name');
                $hi_sub_menu_name = $this->input->post('hi_sub_menu_name');
                $url              = $this->input->post('url');
                $meta_title       = $this->input->post('meta_title');
                $meta_description = $this->input->post('meta_description');
                $meta_keyword     = $this->input->post('meta_keyword');
                $is_active        = $this->input->post('status');
                
                $data = array(
                    'sub_menu_id' => $sub_menu_id,
                    'en_super_sub_menu' => $en_sub_menu_name,
                    'hi_super_sub_menu' => $hi_sub_menu_name,
                    'url' => $url,
                    'meta_title' => $meta_title,
                    'meta_description' => $meta_description,
                    'meta_keyword' => $meta_keyword,
                    'is_active' => $is_active,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                if (isset($_FILES['category_image']['name']) && !empty($_FILES['category_image']['name'])) {
                    $count = count($_FILES['category_image']['name']);
                    if (move_uploaded_file($_FILES['category_image']['tmp_name'], 'asset/uploads/' . $_FILES['category_image']['name'])) {
                        $data['category_image'] = $_FILES['category_image']['name'];
                    }
                }
                
                if (isset($_FILES['banner_image']['name']) && !empty($_FILES['banner_image']['name'])) {
                    $count = count($_FILES['banner_image']['name']);
                    if (move_uploaded_file($_FILES['banner_image']['tmp_name'], 'asset/uploads/' . $_FILES['banner_image']['name'])) {
                        $data['banner_image'] = $_FILES['banner_image']['name'];
                    }
                }
                
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    
                    $result = $this->model->updateFields('super_sub_menu', $data, $where);
                } else {
                    $result = $this->model->insertData('super_sub_menu', $data);
                }
                
                $this->super_submenuList();
            }
        }
    }
    public function super_submenuList()
    {
        
        $field_val = 'super_sub_menu.en_super_sub_menu,
                    super_sub_menu.hi_super_sub_menu,
                    super_sub_menu.id as super_sub_menu_id,
                    super_sub_menu.is_active,
                    sub_menu.en_sub_menu_name,
                    sub_menu.created_at,
                    sub_menu.menu_id';
        
        $data['super_sub_menu'] = $this->model->GetJoinRecord('super_sub_menu', 'sub_menu_id', 'sub_menu', 'id', $field_val);
        for ($i = 0; $i < count($data['super_sub_menu']); $i++) {
            $where                                 = array(
                'id' => $data['super_sub_menu'][$i]->menu_id
            );
            $select                                = 'en_menu_name';
            $menu_name                             = $this->model->getAllwhere('menu', $where, $select);
            $data['super_sub_menu'][$i]->menu_name = $menu_name[0]->en_menu_name;
        }
        
        $data['body'] = 'super_sub_menu_list';
        $this->controller->load_view($data);
    }
    public function super_sub_menu_post($id = NULL)
    {
        $this->form_validation->set_rules('menu_id', ' Menu Name', 'trim|required|numeric');
        $this->form_validation->set_rules('sub_menu_id', 'Sub Menu Name', 'trim|required|numeric');
        $this->form_validation->set_rules('super_sub_menu_id', 'Super Sub Menu Name', 'trim|required|numeric');
        $this->form_validation->set_rules('en_post', 'Super Sub Menu Post in English', 'trim|required');
        $this->form_validation->set_rules('hi_post', 'Super Sub Menu Post in Hindi', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            if (!empty($id)) {
                $where = array(
                    'super_sub_menu_post.id' => $id
                );
                
                $field_val = 'super_sub_menu_post.id as super_sub_menu_post_id,
                            super_sub_menu_post.super_sub_menu_id,
                            super_sub_menu_post.created_at,
                            super_sub_menu_post.is_active,
                            super_sub_menu_post.hi_post,
                            super_sub_menu_post.en_post,
                            super_sub_menu.en_super_sub_menu,
                            super_sub_menu.sub_menu_id,
                            super_sub_menu.en_super_sub_menu';
                
                $data['super_sub_menu_post'] = $this->model->GetJoinRecord('super_sub_menu_post', 'super_sub_menu_id', 'super_sub_menu', 'id', $field_val, $where);
                
                $where                                         = array(
                    'id' => $data['super_sub_menu_post'][0]->sub_menu_id
                );
                $select                                        = 'menu_id,en_sub_menu_name';
                $sub_menu_name                                 = $this->model->getAllwhere('sub_menu', $where, $select);
                $data['super_sub_menu_post'][0]->sub_menu_name = $sub_menu_name[0]->en_sub_menu_name;
                $where1                                        = array(
                    'id' => $sub_menu_name[0]->menu_id
                );
                
                $select1                                 = 'id,en_menu_name';
                $menu                                    = $this->model->getAllwhere('menu', $where1, $select1);
                $data['super_sub_menu_post'][0]->menu    = $menu[0]->en_menu_name;
                $data['super_sub_menu_post'][0]->menu_id = $menu[0]->id;
                $data['menu']                            = $this->model->getAllwhere('menu');
            } else {
                $where        = array(
                    'is_active' => 1
                );
                $data['menu'] = $this->model->getAllwhere('menu', $where);
            }
            $data['body'] = 'add_super_sub_menu_post';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $super_sub_menu_id = $this->input->post('super_sub_menu_id');
                $en_post           = $this->input->post('en_post');
                $hi_post           = $this->input->post('hi_post');
                $is_active         = $this->input->post('status');
                
                $data = array(
                    'super_sub_menu_id' => $super_sub_menu_id,
                    'en_post' => $en_post,
                    'hi_post' => $hi_post,
                    'is_active' => $is_active,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    $result = $this->model->updateFields('super_sub_menu_post', $data, $where);
                } else {
                    $result = $this->model->insertData('super_sub_menu_post', $data);
                }
                $this->super_submenupostList();
            }
        }
    }
    public function super_submenupostList()
    {
        $field_val = 'super_sub_menu_post.id as super_sub_menu_post_id,
                    super_sub_menu_post.super_sub_menu_id,
                    super_sub_menu_post.created_at,
                    super_sub_menu_post.is_active,
                    super_sub_menu_post.hi_post,
                    super_sub_menu_post.en_post,
                    super_sub_menu.en_super_sub_menu,
                    super_sub_menu.sub_menu_id,
                    super_sub_menu.en_super_sub_menu';
        
        $data['super_sub_menu_post'] = $this->model->GetJoinRecord('super_sub_menu_post', 'super_sub_menu_id', 'super_sub_menu', 'id', $field_val);
        
        for ($i = 0; $i < count($data['super_sub_menu_post']); $i++) {
            $where                                          = array(
                'id' => $data['super_sub_menu_post'][$i]->sub_menu_id
            );
            $select                                         = 'menu_id,en_sub_menu_name';
            $sub_menu_name                                  = $this->model->getAllwhere('sub_menu', $where, $select);
            $data['super_sub_menu_post'][$i]->sub_menu_name = $sub_menu_name[0]->en_sub_menu_name;
            $where1                                         = array(
                'id' => $sub_menu_name[0]->menu_id
            );
            $select1                                        = 'id,en_menu_name';
            $menu                                           = $this->model->getAllwhere('menu', $where1, $select1);
            $data['super_sub_menu_post'][$i]->menu          = $menu[0]->en_menu_name;
            $data['super_sub_menu_post'][$i]->menu_id       = $menu[0]->id;
        }
        $data['body'] = 'super_sub_menu_post_list';
        $this->controller->load_view($data);
    }
    public function news($id = null)
    {
        $this->form_validation->set_rules('title', 'News Title', 'trim|required');
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            if (!empty($id)) {
                $where        = array(
                    'id' => $id
                );
                $data['news'] = $this->model->getAllwhere('news', $where);
            } else {
            }
            $data['body'] = 'add_news';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $title            = $this->input->post('title');
                $category         = $this->input->post('category');
                $news_description = $this->input->post('news_description');
                $news_url         = $this->input->post('news_url');
                $url              = $this->input->post('url');
                $meta_title       = $this->input->post('meta_title');
                $meta_description = $this->input->post('meta_description');
                $meta_keyword     = $this->input->post('meta_keyword');
                $is_active        = $this->input->post('status');
                
                $data = array(
                    'title' => $title,
                    'category' => $category,
                    'news_description' => $news_description,
                    'news_url' => $news_url,
                    'url' => $url,
                    'meta_title' => $meta_title,
                    'meta_description' => $meta_description,
                    'meta_keyword' => $meta_keyword,
                    'is_active' => $is_active,
                    'created_at' => date('Y-m-d H:i:s')
                );
                if (isset($_FILES['category_image']['name']) && !empty($_FILES['category_image']['name'])) {
                    $count = count($_FILES['category_image']['name']);
                    if (move_uploaded_file($_FILES['category_image']['tmp_name'], 'asset/uploads/' . $_FILES['category_image']['name'])) {
                        $data['category_image'] = $_FILES['category_image']['name'];
                    }
                }
                if (isset($_FILES['banner_image']['name']) && !empty($_FILES['banner_image']['name'])) {
                    $count = count($_FILES['banner_image']['name']);
                    if (move_uploaded_file($_FILES['banner_image']['tmp_name'], 'asset/uploads/' . $_FILES['banner_image']['name'])) {
                        $data['banner_image'] = $_FILES['banner_image']['name'];
                    }
                }
                if (isset($_FILES['news_image']['name']) && !empty($_FILES['news_image']['name'])) {
                    $count = count($_FILES['news_image']['name']);
                    if (move_uploaded_file($_FILES['news_image']['tmp_name'], 'asset/uploads/' . $_FILES['news_image']['name'])) {
                        $data['news_image'] = $_FILES['news_image']['name'];
                    }
                }
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    $result = $this->model->updateFields('news', $data, $where);
                } else {
                    $result = $this->model->insertData('news', $data);
                }
                
                $this->newsList();
            }
        }
    }
    public function newsList()
    {
        $data['news'] = $this->model->getAll('news');
        $data['body'] = 'news_list';
        $this->controller->load_view($data);
    }
    public function notification($id = null)
    {
        $this->form_validation->set_rules('title', 'Notification Title', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            if (!empty($id)) {
                $where                = array(
                    'id' => $id
                );
                $data['notification'] = $this->model->getAllwhere('notification', $where);
            } else {
                
            }
            $data['body'] = 'add_notification';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                
                $title                    = $this->input->post('title');
                $notification_description = $this->input->post('notification_description');
                $notification_url         = $this->input->post('notification_url');
                $url                      = $this->input->post('url');
                $meta_title               = $this->input->post('meta_title');
                $meta_description         = $this->input->post('meta_description');
                $meta_keyword             = $this->input->post('meta_keyword');
                $is_active                = $this->input->post('status');
                
                $data = array(
                    'title' => $title,
                    'notification_description' => $notification_description,
                    'notification_url' => $notification_url,
                    'url' => $url,
                    'meta_title' => $meta_title,
                    'meta_description' => $meta_description,
                    'meta_keyword' => $meta_keyword,
                    'is_active' => $is_active,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                if (isset($_FILES['category_image']['name']) && !empty($_FILES['category_image']['name'])) {
                    $count = count($_FILES['category_image']['name']);
                    if (move_uploaded_file($_FILES['category_image']['tmp_name'], 'asset/uploads/' . $_FILES['category_image']['name'])) {
                        $data['category_image'] = $_FILES['category_image']['name'];
                    }
                }
                
                if (isset($_FILES['banner_image']['name']) && !empty($_FILES['banner_image']['name'])) {
                    $count = count($_FILES['banner_image']['name']);
                    if (move_uploaded_file($_FILES['banner_image']['tmp_name'], 'asset/uploads/' . $_FILES['banner_image']['name'])) {
                        $data['banner_image'] = $_FILES['banner_image']['name'];
                    }
                }
                
                if (isset($_FILES['notification_image']['name']) && !empty($_FILES['notification_image']['name'])) {
                    $count = count($_FILES['notification_image']['name']);
                    if (move_uploaded_file($_FILES['notification_image']['tmp_name'], 'asset/uploads/' . $_FILES['notification_image']['name'])) {
                        $data['notification_image'] = $_FILES['notification_image']['name'];
                    }
                }
                
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    
                    unset($data['created_at']);
                    
                    $result = $this->model->updateFields('notification', $data, $where);
                } else {
                    $result = $this->model->insertData('notification', $data);
                }
                
                $this->notificationList();
            }
        }
    }
    public function notificationList()
    {
        $data['notification'] = $this->model->getAll('notification');
        $data['body']         = 'notification_list';
        $this->controller->load_view($data);
    }
    public function event($id = null)
    {
        $this->form_validation->set_rules('title', 'Event Title', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_rules('description', 'description', 'trim|required');
        $this->form_validation->set_rules('address', 'address', 'trim|required');
        $this->form_validation->set_rules('event_date', 'event date', 'trim|required');
        $this->form_validation->set_rules('start_time', 'event time', 'trim|required');
        $this->form_validation->set_rules('end_time', 'event time', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            if (!empty($id)) {
                $where         = array(
                    'id' => $id
                );
                $data['event'] = $this->model->getAllwhere('event', $where);
            } else {
                
            }
            $data['body'] = 'add_event';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                
                $title             = $this->input->post('title');
                $event_description = $this->input->post('description');
                $event_address     = $this->input->post('address');
                $event_date        = $this->input->post('event_date');
                $start_time        = $this->input->post('start_time');
                $end_time          = $this->input->post('end_time');
                $is_active         = $this->input->post('status');
                
                $data = array(
                    'title' => $title,
                    'description' => $event_description,
                    'address' => $event_address,
                    'event_date' => $event_date,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'is_active' => $is_active,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                if (isset($_FILES['event_image']['name']) && !empty($_FILES['event_image']['name'])) {
                    $count = count($_FILES['event_image']['name']);
                    if (move_uploaded_file($_FILES['event_image']['tmp_name'], 'asset/uploads/' . $_FILES['event_image']['name'])) {
                        $data['image'] = $_FILES['event_image']['name'];
                    }
                }
                
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    
                    unset($data['created_at']);
                    
                    $result = $this->model->updateFields('event', $data, $where);
                } else {
                    $result = $this->model->insertData('event', $data);
                }
                
                $this->eventList();
            }
        }
    }
    public function eventList()
    {
        $data['event'] = $this->model->getAll('event');
        $data['body']  = 'event_list';
        $this->controller->load_view($data);
    }
    public function blog($id = null)
    {
        $this->form_validation->set_rules('en_title', 'Blog Title', 'trim|required');
        $this->form_validation->set_rules('en_description', 'Blog description', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            
            if (!empty($id)) {
                $where        = array(
                    'id' => $id
                );
                $data['blog'] = $this->model->getAllwhere('blogs', $where);
            } else {
                
            }
            $data['body'] = 'add_blog';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                
                $en_title       = $this->input->post('en_title');
                $hi_title       = $this->input->post('hi_title');
                $en_description = $this->input->post('en_description');
                $hi_description = $this->input->post('hi_description');
                $en_address     = $this->input->post('en_address');
                $hi_address     = $this->input->post('hi_address');
                $blog_date      = $this->input->post('blog_date');
                $is_active      = $this->input->post('status');
                
                $data = array(
                    'en_title' => $en_title,
                    'hi_title' => $hi_title,
                    'en_description' => $en_description,
                    'hi_description' => $hi_description,
                    'en_address' => $en_address,
                    'hi_address' => $hi_address,
                    'blog_date' => $blog_date,
                    'is_active' => $is_active,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                    $count = count($_FILES['image']['name']);
                    if (move_uploaded_file($_FILES['image']['tmp_name'], 'asset/uploads/' . $_FILES['image']['name'])) {
                        $data['image'] = $_FILES['image']['name'];
                    }
                }
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    
                    unset($data['created_at']);
                    
                    $result = $this->model->updateFields('blogs', $data, $where);
                } else {
                    $result = $this->model->insertData('blogs', $data);
                }
                
                $this->blogList();
            }
        }
    }
    public function blogList()
    {
        $data['blogs'] = $this->model->getAll('blogs');
        $data['body']  = 'blog_list';
        $this->controller->load_view($data);
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
    public function trainingList()
    {
        $data['training'] = $this->model->getAll('training');
        $data['body']     = 'training_list';
        $this->controller->load_view($data);
    }
    public function edit_training($id)
    {
        $where            = array(
            'id ' => $id
        );
        $data['modules']  = $this->model->getAll('modules');
        $data['chapters'] = $this->model->getAll('chapters');
        $data['training'] = $this->model->getAllwhere('training', $where);
        $data['body']     = 'edit_training';
        $this->controller->load_view($data);
    }
    public function getChapter()
    {
        $module_id = $this->input->get('module_id');
        $where     = array(
            'fk_module_id ' => $module_id[0]
        );
        $select    = 'id,en_chapter_name';
        $data      = $this->model->getAllwhere('chapters', $where, $select);
        echo json_encode($data);
    }
    public function question($id = NULL)
    {
        $this->form_validation->set_rules('module_id', 'Module Name', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            
            if (!empty($id)) {
                $where             = array(
                    'id ' => $id
                );
                $data['questions'] = $this->model->getAllwhere('questions', $where);
                $data['modules']   = $this->model->getAll('modules');
                
                
                $field_val = 'id,en_chapter_name';
                
                $where1 = array(
                    'fk_module_id' => $data['questions'][0]->module_id
                );
                
                $data['chapters'] = $this->model->getAllwhere('chapters', $where1, $field_val);
                
            } else {
                $data['modules']  = $this->model->getAll('modules');
                $data['chapters'] = $this->model->getAll('chapters');
            }
            $data['body'] = 'add_question';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $module_id      = $this->input->post('module_id');
                $chapter_id     = $this->input->post('chapter_id');
                $question_marks = $this->input->post('question_marks');
                $question_type  = $this->input->post('question_type');
                $en_question    = $this->input->post('en_question');
                $hi_question    = $this->input->post('hi_question');
                $en_option_a    = $this->input->post('en_option_a');
                $en_option_b    = $this->input->post('en_option_b');
                $en_option_c    = $this->input->post('en_option_c');
                $en_option_d    = $this->input->post('en_option_d');
                $hi_option_a    = $this->input->post('hi_option_a');
                $hi_option_b    = $this->input->post('hi_option_b');
                $hi_option_c    = $this->input->post('hi_option_c');
                $hi_option_d    = $this->input->post('hi_option_d');
                
                if ($question_type == 'True False') {
                    $en_answer = $this->input->post('en_answers');
                } else {
                    $en_answer = $this->input->post('en_answer');
                }
                
                $hi_answer       = $this->input->post('hi_answer');
                $en_explaination = $this->input->post('en_explaination');
                $hi_explaination = $this->input->post('hi_explaination');
                $is_active       = $this->input->post('status');
                
                $data = array(
                    'module_id' => $module_id,
                    'chapter_id' => $chapter_id,
                    'question_marks' => $question_marks,
                    'question_type' => $question_type,
                    'en_question' => $en_question,
                    'hi_question' => $hi_question,
                    'en_option_a' => $en_option_a,
                    'en_option_b' => $en_option_b,
                    'en_option_c' => $en_option_c,
                    'en_option_d' => $en_option_d,
                    'hi_option_a' => $hi_option_a,
                    'hi_option_b' => $hi_option_b,
                    'hi_option_c' => $hi_option_c,
                    'hi_option_d' => $hi_option_d,
                    'en_answer' => $en_answer,
                    'hi_answer' => $hi_answer,
                    'en_explaination' => $en_explaination,
                    'hi_explaination' => $hi_explaination,
                    'is_active' => $is_active,
                    'created_at' => date('Y-m-d H:i:s')
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
    public function questionList()
    {
        $data['question'] = $this->model->getAll('questions');
        $data['body']     = 'question_list';
        $this->controller->load_view($data);
    }
    public function exam($id = NULL)
    {
        $this->form_validation->set_rules('module_id', 'Module Name', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            if (!empty($id)) {
                $where           = array(
                    'id ' => $id
                );
                $data['exam']    = $this->model->getAllwhere('exam', $where);
                $data['modules'] = $this->model->getAll('modules');
                
                $where1           = array(
                    'fk_module_id ' => $data['exam'][0]->module_id
                );
                $data['chapters'] = $this->model->getAllwhere('chapters', $where1);
            } else {
                $data['modules'] = $this->model->getAll('modules');
            }
            $data['body'] = 'add_exam';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                
                $module_id      = $this->input->post('module_id');
                $chapter_id     = implode(",", $this->input->post('chapter_id'));
                $exam_name      = $this->input->post('exam_name');
                $question_type  = $this->input->post('question_type');
                $description    = $this->input->post('description');
                $payment_status = $this->input->post('payment_status');
                
                $question_id = implode(",", $this->input->post('question_id'));
                
                $is_active = $this->input->post('status');
                
                $data = array(
                    'module_id' => $module_id,
                    'chapter_id' => $chapter_id,
                    'exam_name' => $exam_name,
                    'question_type' => $question_type,
                    'description' => $description,
                    'payment_status' => $payment_status,
                    'question_id' => $question_id,
                    'is_active' => $is_active,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    $result = $this->model->updateFields('exam', $data, $where);
                } else {
                    $result = $this->model->insertData('exam', $data);
                }
                $this->examList();
            }
        }
    }
    public function examList()
    {
        $data['exam'] = $this->model->getAll('exam');
        $data['body'] = 'exam_list';
        $this->controller->load_view($data);
    }
    public function view_exam($id)
    {
        $where           = array(
            'id' => $id
        );
        $field_val       = 'exam.*,modules.id as main_module_id,
                            modules.en_module_name,
                            chapters.id as main_chapter_id,
                            chapters.en_chapter_name';
        $field           = 'id';
        $value           = $id;
        $data['package'] = $this->model->GetJoinRecordNew('exam', 'module_id', 'modules', 'id', 'chapters', 'id', '', '', $field, $value, $field_val, 'chapter_id');
        $data['body']    = 'view_exam';
        $this->controller->load_view($data);
    }
    public function getQuestion()
    {
        $module_id     = $this->input->get('module_id');
        $chapter_id    = $this->input->get('chapter_id');
        $question_type = $this->input->get('question_type');
        $where         = array(
            'module_id ' => $module_id,
            'question_type' => $question_type
        );
        $data          = $this->Common_model->getAllquestion('questions', $where, $chapter_id);
        echo json_encode($data);
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
    public function register($id = NULL, $user_role = NULL)
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha|min_length[2]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha|min_length[2]');
        $this->form_validation->set_rules('dob', 'Date Of Birth', 'trim|required');
        if (empty($id)) {
            $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|is_unique[users.username]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|alpha_numeric');
        }
        
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['body'] = 'register';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
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
                    'user_role' => 3,
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
                }
                $this->userList();
            }
        }
    }
    public function userList($user_role = NULL)
    {
        $where         = array(
            'user_role !=' => 1
        );
        $data['users'] = $this->model->getAllwhere('users', $where);
        $data['body']  = 'userList';
        
        $this->controller->load_view($data);
    }
    public function subadmin_userList($user_role)
    {
        $where             = array(
            'user_role ' => $user_role
        );
        $where1            = array(
            'role_id ' => $user_role
        );
        $data['users']     = $this->model->getAllwhere('users', $where);
        $data['user_role'] = $this->model->getAllwhere('user_role', $where1);
        $data['body']      = 'subadmin_userList';
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
    public function addRights($id = NULL)
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
        
        $this->subadmin_userList('4');
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
        // echo $this->db->last_query(); 
        // die;
    }
    public function change_status()
    {
        $id    = $this->input->post('id');
        $table = $this->input->post('table');
        
        $where  = array(
            'id' => $id
        );
        $data   = array(
            'is_active' => 1 - $this->input->post('status')
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
                    'sender_id' => $sender_id,
                    'subject' => $subject,
                    'message' => trim($message),
                    'is_active' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                $config_mail = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => '465',
                    'smtp_user' => 'webdeskytechnical@gmail.com',
                    'smtp_pass' => 'webdesky@2017',
                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1',
                    'newline' => "\r\n"
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
    public function file_upload($file)
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
    public function get_record()
    {
        $id     = $this->input->get('id');
        $table  = $this->input->get('table');
        $field  = $this->input->get('field');
        $select = $this->input->get('select');
        $where  = array(
            "$field" => $id
        );
        $states = $this->model->getAllwhere($table, $where, $select);
        echo json_encode($states);
    }
    public function post($id = NULL)
    {
        $this->form_validation->set_rules('en_post_title', 'Post Title', 'trim|required');
        $this->form_validation->set_rules('en_post', 'Post', 'trim|required');
        $this->form_validation->set_rules('hi_post_title', 'Post', 'trim|required');
        $this->form_validation->set_rules('hi_post', 'Post', 'trim|required');
        $this->form_validation->set_rules('module_id', 'Module Name', 'trim|required|numeric');
        if (!empty($id)) {
            $where        = array(
                'id' => $id
            );
            $data['post'] = $this->model->getAllwhere('post', $where);
        }
        $where           = array(
            'is_active' => 1
        );
        $data['modules'] = $this->model->getAllwhere('modules', $where);
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['body'] = 'post';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $en_post_title = $this->input->post('en_post_title');
                $en_post       = $this->input->post('en_post');
                $hi_post_title = $this->input->post('hi_post_title');
                $hi_post       = $this->input->post('hi_post');
                $module_id     = $this->input->post('module_id');
                $is_active     = $this->input->post('status');
                
                $data = array(
                    'en_post_title' => $en_post_title,
                    'en_post' => $en_post,
                    'hi_post_title' => $hi_post_title,
                    'hi_post' => $hi_post,
                    'module_id' => $module_id,
                    'added_by' => $this->session->userdata('id'),
                    'is_active' => $is_active,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    $result = $this->model->updateFields('post', $data, $where);
                } else {
                    $result = $this->model->insertData('post', $data);
                }
                $this->postList();
            }
        }
    }
    public function postList()
    {
        if ($this->controller->checkSession()) {
            $where           = array(
                'is_active' => 1
            );
            $data['modules'] = $this->model->getAllwhere('modules', $where);
            $field_val       = 'post.*,users.first_name,users.last_name';
            $data['post']    = $this->model->GetJoinRecord('post', 'added_by', 'users', 'id', $field_val);
            $data['body']    = 'post_list';
            $this->controller->load_view($data);
        } else {
            show_404();
        }
    }
    public function testimonials()
    {
        if ($this->controller->checkSession()) {
            $field_val            = 'testimonials.*,users.first_name,users.last_name';
            $data['testimonials'] = $this->model->GetJoinRecord('testimonials', 'user_id', 'users', 'id', $field_val);
            $data['body']         = 'testimonials_list';
            $this->controller->load_view($data);
        } else {
            show_404();
        }
    }
    public function view_testimonial($id = NULL)
    {
        $where                = array(
            'testimonials.id' => $id
        );
        $field_val            = 'testimonials.*,users.first_name,users.last_name,users.profile_pic';
        $data['testimonials'] = $this->model->GetJoinRecord('testimonials', 'user_id', 'users', 'id', $field_val, $where);
        $data['body']         = 'view_testimonial';
        $this->controller->load_view($data);
    }
    public function choose($id = NULL)
    {
        $this->form_validation->set_rules('en_site_title', 'Title in English', 'trim|required');
        $this->form_validation->set_rules('en_content', 'Content in English', 'trim|required');
        $this->form_validation->set_rules('hi_site_title', 'Title in Hindi', 'trim|required');
        $this->form_validation->set_rules('hi_content', 'Content in Hindi', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|numeric');
        if (!empty($id)) {
            $where           = array(
                'id' => $id
            );
            $data['setting'] = $this->model->getAllwhere('why_choose_us', $where);
        }
        $where = array(
            'is_active' => 1
        );
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['body'] = 'why_choose';
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                $en_site_title = $this->input->post('en_site_title');
                $en_content    = $this->input->post('en_content');
                $hi_site_title = $this->input->post('hi_site_title');
                $hi_content    = $this->input->post('hi_content');
                $is_active     = $this->input->post('status');
                $f_newfile     = "";
                
                if (!empty($_FILES['image']['name'])) {
                    $f_name      = $_FILES['image']['name'];
                    $f_tmp       = $_FILES['image']['tmp_name'];
                    $f_size      = $_FILES['image']['size'];
                    $f_extension = explode('.', $f_name); //To breaks the string into array
                    $f_extension = strtolower(end($f_extension)); //end() is used to retrun a last element to the array                    
                    if ($f_name) {
                        $f_newfile = uniqid() . '.' . $f_extension; // It`s use to stop overriding if the image will be same then uniqid() will generate the unique name of both file.
                        $store     = 'asset/uploads/' . $f_newfile;
                        $image1    = move_uploaded_file($f_tmp, $store);
                    }
                }
                
                $data = array(
                    'en_title' => $en_site_title,
                    'en_content' => $en_content,
                    'hi_title' => $hi_site_title,
                    'hi_content' => $hi_content,
                    'image' => $f_newfile,
                    'is_active' => $is_active,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    $result = $this->model->updateFields('why_choose_us', $data, $where);
                } else {
                    $result = $this->model->insertData('why_choose_us', $data);
                }
                $this->whychooseList();
            }
        }
    }
    public function whychooseList()
    {
        if ($this->controller->checkSession()) {
            $data['post'] = $this->model->getAll('why_choose_us');
            $data['body'] = 'why_choose_list';
            $this->controller->load_view($data);
        } else {
            show_404();
        }
    }
    public function package()
    {
        if ($this->controller->checkSession()) {
            $data['modules'] = $this->model->getAll('modules');
            $data['body']    = 'add_package';
            $this->controller->load_view($data);
        } else {
            show_404();
        }
    }
    public function get_exam()
    {
        $module_id     = $this->input->get('module_id');
        $question_type = $this->input->get('question_type');
        $where         = array(
            'module_id' => $module_id,
            'question_type' => $question_type
        );
        $select        = 'id,exam_name';
        $package       = $this->model->getAllwhere('exam', $where, $select);
        if ($package != '') {
            echo json_encode($package);
        }
    }
    public function get_questions()
    {
        $question_id = explode(",", $this->input->get('question_id'));
        if (!empty($question_id)) {
            $select    = 'id,en_question,hi_question';
            $questions = $this->model->getAllwhereIN('questions', $question_id, $select);
            echo json_encode($questions);
        }
    }
    public function add_package()
    {
        $this->form_validation->set_rules('package_name', 'Exam Name', 'trim|required');
        $this->form_validation->set_rules('time_per_question', 'Time per Question', 'trim|required|numeric');
        $this->form_validation->set_rules('passing_marks', 'Passing Marks', 'trim|required|numeric');
        $this->form_validation->set_rules('positive_mark', 'Positive Marks', 'trim|required|numeric');
        //$this->form_validation->set_rules('package_id', 'Package', 'trim|required|numeric');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|numeric');
        $payment_status = $this->input->post('payment_status');
        
        if ($payment_status === 'paid') {
            $this->form_validation->set_rules('exam_price', 'Exam Price', 'trim|required|numeric');
        }
        
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['body'] = 'add_exam';
            $this->controller->load_view($data);
        } else {
            
            $package_name      = $this->input->post('package_name');
            $time_per_question = $this->input->post('time_per_question');
            $passing_marks     = $this->input->post('passing_marks');
            $positive_mark     = $this->input->post('positive_mark');
            $negative_mark     = $this->input->post('negative_mark');
            $exam_id           = implode(",", $this->input->post('exam_id'));
            $status            = $this->input->post('status');
            
            $data = array(
                'package_name' => $package_name,
                'time_per_question' => $time_per_question,
                'passing_marks' => $passing_marks,
                'positive_mark' => $positive_mark,
                'negative_mark' => $negative_mark,
                'exam_id' => $exam_id,
                'is_active' => $status,
                'created_at' => date('Y-m-d H:i:s')
            );
            
            if (!empty($id)) {
                $where = array(
                    'id' => $id
                );
                unset($data['created_at']);
                $result = $this->model->updateFields('package', $data, $where);
            } else {
                $result = $this->model->insertData('package', $data);
            }
            $this->packageList();
        }
    }
    public function packageList()
    {
        $field_val    = 'package.*,exam.exam_name';
        $data['exam'] = $this->model->GetJoinRecord('package', 'exam_id', 'exam', 'id', $field_val);
        $data['body'] = 'package_list';
        
        $this->controller->load_view($data);
    }
    
    public function super_package($id = NULL)
    {
        $this->form_validation->set_rules('super_package_name', 'Package ', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|numeric');
        if (!empty($id)) {
            $where                 = array(
                'id' => $id
            );
            $data['package']       = $this->model->getAll('package');
            $data['super_package'] = $this->model->getAllwhere('super_package', $where);
            
        }
        $where = array(
            'is_active' => 1
        );
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $data['package'] = $this->model->getAll('package');
            $data['body']    = 'add_super_package';
            
            $this->controller->load_view($data);
        } else {
            if ($this->controller->checkSession()) {
                
                $super_package_name = $this->input->post('super_package_name');
                $package_id         = implode(",", $this->input->post('package_id'));
                $valid_till         = $this->input->post('valid_till');
                $is_active          = $this->input->post('status');                
                $data = array(
                    'super_package_name' => $super_package_name,
                    'package_id' => $package_id,
                    'valid_till' => $valid_till,
                    'is_active' => $is_active,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    $result = $this->model->updateFields('super_package', $data, $where);
                } else {
                    $result = $this->model->insertData('super_package', $data);
                }
                $this->super_packageList();
            }
        }
    }
    public function super_packageList()
    {
        $data['super_package'] = $this->model->getAll('super_package');
        $data['body']          = 'super_package_list';
        $this->controller->load_view($data);
    }
    public function update()
    {
        $id          = $this->input->post('id');
        $table       = $this->input->post('table');
        $question_id = implode(',', $this->input->post('question_id'));
        $data        = array(
            'question_id' => $question_id
        );
        $where       = array(
            'id' => $id
        );
        if ($this->model->updateFields($table, $data, $where)) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
}