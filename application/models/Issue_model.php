<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Issue_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get issue by id
     */
    function get_issue($id)
    {
        return $this->db->get_where('issues',array('id'=>$id))->row_array();
    }
    
    function get_issue_params($params)
    {
        return $this->db->get_where('issues',$params)->result_array();
    }
        
    /*
     * Get all issues
     */
    function get_all_issues()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('issues')->result_array();
    }
        
    /*
     * function to add new issue
     */
    function add_issue($params)
    {
        $this->db->insert('issues',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update issue
     */
    function update_issue($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('issues',$params);
    }
    
    /*
     * function to delete issue
     */
    function delete_issue($id)
    {
        return $this->db->delete('issues',array('id'=>$id));
    }
}
