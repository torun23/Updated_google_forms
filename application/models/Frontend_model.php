
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend_model extends CI_Model {
    public function getforms()
    {
        // Get the user_id from session
        $user_id = $this->session->userdata('user_id');
    
        // Ensure user_id is set
        if (!$user_id) {
            return []; // Return an empty array if user_id is not available
        }
    
        // Filter forms by user_id and order by created_at in descending order
        $this->db->where('user_id', $user_id); // Assuming 'user_id' is the column name in the 'forms' table
        $this->db->order_by('created_at', 'DESC'); // Order by created_at column, most recent first
        $query = $this->db->get('forms');
        
        return $query->result(); // Return the result as an array of objects
    }
    
    public function deleteForm($id){  
        return $this->db->delete('forms', ['id' => $id]);
        }
    public function getFormById($form_id)
        {
            $query = $this->db->get_where('forms', ['id' => $form_id]);
            return $query->row_array();
        }
    public function getforms_draft($user_id) {
            $this->db->where('is_published', 0); // Filter by unpublished forms
            $this->db->where('user_id', $user_id); // Filter by user_id
            $this->db->order_by('created_at', 'DESC'); // Sort by creation date, newest first
            $query = $this->db->get('forms');
            return $query->result();
        }
        
        
}