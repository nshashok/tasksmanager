<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Custom_fields_tracker_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get custom_fields_tracker by custom_field_id
     */
    function get_custom_fields_tracker($custom_field_id)
    {
        return $this->db->get_where('custom_fields_trackers',array('custom_field_id'=>$custom_field_id))->row_array();
    }
        
    /*
     * Get all custom_fields_trackers
     */
    function get_all_custom_fields_trackers()
    {
        $this->db->order_by('custom_field_id', 'desc');
        return $this->db->get('custom_fields_trackers')->result_array();
    }
        
    /*
     * function to add new custom_fields_tracker
     */
    function add_custom_fields_tracker($params)
    {
        $this->db->insert('custom_fields_trackers',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update custom_fields_tracker
     */
    function update_custom_fields_tracker($custom_field_id,$params)
    {
        $this->db->where('custom_field_id',$custom_field_id);
        return $this->db->update('custom_fields_trackers',$params);
    }
    
    /*
     * function to delete custom_fields_tracker
     */
    function delete_custom_fields_tracker($custom_field_id)
    {
        return $this->db->delete('custom_fields_trackers',array('custom_field_id'=>$custom_field_id));
    }
}
