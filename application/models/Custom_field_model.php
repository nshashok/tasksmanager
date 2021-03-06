<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Custom_field_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get custom_field by id
     */
    function get_custom_field($id)
    {
        return $this->db->get_where('custom_fields',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all custom_fields
     */
    function get_all_custom_fields()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('custom_fields')->result_array();
    }
        
    /*
     * function to add new custom_field
     */
    function add_custom_field($params)
    {
        $this->db->insert('custom_fields',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update custom_field
     */
    function update_custom_field($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('custom_fields',$params);
    }
    
    /*
     * function to delete custom_field
     */
    function delete_custom_field($id)
    {
        return $this->db->delete('custom_fields',array('id'=>$id));
    }
}
