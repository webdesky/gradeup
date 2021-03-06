<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model
{
    
    var $CI;
    
    public function __construct($params = array())
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('url');
        $this->CI->config->item('base_url');
        $this->CI->load->library('session', 'form_validation');
        $this->CI->load->database();  
    }
    public function insertData($table, $dataInsert)
    {
        $this->CI->db->insert($table, $dataInsert);
        return $this->CI->db->insert_id();
    }
    
    public function updateFields($table, $data, $where)
    {
        return $this->CI->db->update($table, $data, $where);
    }
    
    public function updateAmount($table, $field1, $field2, $amt, $where)
    {
        $this->CI->db->set($field1, "$field1+$amt", FALSE);
        $this->CI->db->set($field2, "$field2+1", FALSE);
        $this->CI->db->where($where);
        $this->CI->db->update($table);
    }
    
    public function get_matching_record($table, $val)
    {
        $this->CI->db->select('*');
        $this->CI->db->from($table);
        $this->CI->db->where("port_description LIKE '%$val%'");
        $q   = $this->CI->db->get();
        $num = $q->num_rows();
        if ($num > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }
    public function get_matching_record_from_job($table, $val)
    {
        $this->CI->db->select('*');
        $this->CI->db->from($table);
        $this->CI->db->where("job_no LIKE '%$val%'");
        $this->CI->db->order_by('job_id', 'DESC');
        $this->CI->db->limit(1);
        $q   = $this->CI->db->get();
        $num = $q->num_rows();
        if ($num > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }
    
    public function getsingle($table, $where = '', $fld = NULL, $order_by = '', $order = '')
    {
        if ($fld != NULL) {
            $this->CI->db->select($fld);
        }
        if ($where != '') {
            $this->CI->db->where($where);
        }
        if ($order_by != '') {
            $this->CI->db->order_by($order_by, $order);
        }
        $this->CI->db->limit(1);
        $q   = $this->CI->db->get($table);
        $num = $q->num_rows();
        if ($num > 0) {
            return $q->row();
        }
    }
    
    public function GetJoinRecord($table, $field_first, $tablejointo, $field_second, $field_val = '', $where = "", $group_by = '')
    {
        
        if (!empty($field_val)) {
            $this->CI->db->select("$field_val");
        } else {
            $this->CI->db->select("*");
        }
        $this->CI->db->from("$table");
        $this->CI->db->join("$tablejointo", "$tablejointo.$field_second = $table.$field_first");
        if (!empty($where)) {
            $this->CI->db->where($where);
        }
        if (!empty($group_by)) {
            $this->CI->db->group_by("$table.$field_first");
        }
        $q = $this->CI->db->get();        
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }
    
    public function getAllwhere($table, $where = '', $select = '',$order_fld = '', $order_type = '',  $limit = '', $offset = '')
    {
        if ($order_fld != '' && $order_type != '') {
            $this->CI->db->order_by($order_fld, $order_type);
        }
        if ($select == 'all') {
            $this->CI->db->select('*');
        } else {
            $this->CI->db->select($select);
        }
        if ($where != '') {
            $this->CI->db->where($where);
        }
        if ($limit != '' && $offset != '') {
            $this->CI->db->limit($limit, $offset);
        } else if ($limit != '') {
            $this->CI->db->limit($limit);
        }
        $q        = $this->CI->db->get($table);
        $num_rows = $q->num_rows();
        if ($num_rows > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }

    
    public function getAll($table, $select = '',$order_fld = '', $order_type = '',  $limit = '', $offset = '')
    {
        if ($order_fld != '' && $order_type != '') {
            $this->CI->db->order_by($order_fld, $order_type);
        }
        if ($select == 'all') {
            $this->CI->db->select('*');
        } else {
            $this->CI->db->select($select);
        }
        if ($limit != '' && $offset != '') {
            $this->CI->db->limit($limit, $offset);
        } else if ($limit != '') {
            $this->CI->db->limit($limit);
        }

        $q          = $this->CI->db->get($table);
        
        $num_rows   = $q->num_rows();
        
        if ($num_rows > 0) {
            foreach ($q->result_array() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }
    
    public function getAllwherenew($table, $where, $select = 'all')
    {
        $this->CI->db->cache_on();
        if ($select == 'all') {
            $this->CI->db->select('*');
        } else {
            $this->CI->db->select($select);
        }
        $this->CI->db->where($where, NULL, FALSE);
        $q = $this->db->get($table);
        $this->CI->db->cache_off();
        
        $num_rows = $q->num_rows();
        if ($num_rows > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        } else {
            return 'no';
        }
    }
    
    public function getcount($table, $where)
    {
        $this->CI->db->where($where);
        $q = $this->CI->db->count_all_results($table);
        return $q;
    }
    
    public function getTotalsum($table, $where, $data)
    {
        $this->CI->db->where($where);
        $this->CI->db->select_sum($data);
        $q = $this->CI->db->get($table);
        return $q->row();
    }
    
    public function GetJoinRecordNew($table, $field_first, $tablejointo, $field_second, $tablejointhree, $field_third,$tablejoinfour, $field_four, $field, $value, $field_val,$first_table_second_val)
    {
        
        $this->CI->db->select("$field_val");
        $this->CI->db->from("$table");
        $this->CI->db->join("$tablejointo", "$tablejointo.$field_second = $table.$field_first");
        if($tablejointhree && $field_third){
            $this->CI->db->join("$tablejointhree", "$tablejointhree.$field_third = $table.$first_table_second_val");

            if($tablejoinfour && $field_four){
                $this->CI->db->join("$tablejoinfour", "$tablejoinfour.$field_four = $table.$field_first");    
            }
        }
        $this->CI->db->where("$table.$field", "$value");
        $this->CI->db->limit(1);
        $q = $this->CI->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }


    public function GetSalerecords_for_view($table)
    {
        $this->CI->db->select("*");
        $this->CI->db->from("$table");
        $this->CI->db->order_by('job_id', 'DESC');
        $q = $this->CI->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }
    public function getRecords($table)
    {
        $query = $this->CI->db->get($table);
        return $query->result_array();
    }
    
    public function getAllRecords($table, $conditions = '')
    {
        $this->CI->db->cache_on();
        if (!empty($conditions)) {
            $query = $this->CI->db->get_where($table, $conditions);
        } else {
            $query = $this->CI->db->get($table);
        }
        $this->CI->db->cache_off();
        return $query->result_array();
    }
    
    public function delete($table, $where)
    {
        $this->CI->db->where($where)->delete($table);
    }
    
    public function update($table, $update, $where)
    {
        $query = $this->CI->db->where($where)->update($table, $update);
    }
    
    // some extra function start //
    public function countRecord($table, $condition)
    {
        $this->CI->db->where($condition);
        $query = $this->CI->db->get($table);
        return $query->num_rows();
    }
    
    public function fetchMaxRecord($table, $field)
    {
        $this->CI->db->select_max($field, 'max');
        $query = $this->CI->db->get($table);
        return $query->row_array();
    }
    
    public function insertPasswordResetString($email_address, $password_reset_key)
    {
        $this->CI->db->where('email', $email_address);
        $this->CI->db->update(USERS, array("password_reset_key" => $password_reset_key));
    }
    
    public function exists($fields)
    {
        $query = $this->CI->db->get_where(USERS, $fields, 1, 0);
        if ($query->num_rows() == 1)
            return TRUE;
        else
            return FALSE;
    }
    
    public function updatePassword($password, $password_reset_key)
    {
        $this->CI->db->where('password_reset_key', $password_reset_key);
        $this->CI->db->update(USERS, array(
            "password_reset_key" => "",
            "password" => md5($password)
        ));
    }
    
    public function check_oldpassword($oldpass, $user_id)
    {
        $this->CI->db->where('id', $user_id);
        $this->CI->db->where('password', md5($oldpass));
        $query = $this->CI->db->get('admins'); //data table
        return $query->num_rows();
    }
    
    public function insertBatch($table, $data)
    {
        $this->CI->db->insert_batch($table, $data);
        return $this->CI->db->insert_id();
    }
    
    public function updateBatch($table, $data, $condition)
    {
        $this->CI->db->update_batch($table, $data, $condition);
        return $this->CI->db->insert_id();
    }
    public function getAllwhereIN($table,$where,$select){
        if(!empty($select)){
            $this->CI->db->select($select);
        }else{
            $this->CI->db->select('*');
        }
        $this->CI->db->where_in('id',$where);
        $query = $this->CI->db->get($table);
        return $query->result_array();
    }
    
}