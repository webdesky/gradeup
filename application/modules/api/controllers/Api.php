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

?>