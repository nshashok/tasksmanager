<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Versions_custom_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get versions_custom by id
     */
    function get_versions_custom($id)
    {
        return $this->db->get_where('versions_custom',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all versions_custom
     */
    function get_all_versions_custom()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('versions_custom')->result_array();
    }
        
    /*
     * function to add new versions_custom
     */
    function add_versions_custom($params)
    {
        $this->db->insert('versions_custom',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update versions_custom
     */
    function update_versions_custom($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('versions_custom',$params);
    }
    
    /*
     * function to delete versions_custom
     */
    function delete_versions_custom($id)
    {
        return $this->db->delete('versions_custom',array('id'=>$id));
    }
}
