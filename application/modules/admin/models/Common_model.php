<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends CI_Model
{
    public function getAllquestion($table, $where, $wherein){
    	if(!empty($select)){
            $this->db->select($select);
        }else{
            $this->db->select('*');
        }
        
        if(!empty($where)){
        	$this->db->where($where);
        }
        if(!empty($wherein)){
        	$this->db->where_in('chapter_id',$wherein);
        }
        $query = $this->db->get($table);

        return $query->result_array();
    }
}