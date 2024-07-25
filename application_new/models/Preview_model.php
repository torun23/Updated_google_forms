<?php
class preview_model extends CI_Model {
    
    public function get_form($form_id) {
        $this->db->where('id', $form_id);
        $query = $this->db->get('forms');
        return $query->row();
    }

    public function get_questions($form_id) {
        $this->db->where('form_id', $form_id);
        $query = $this->db->get('questions');
        return $query->result(); // Ensure this returns objects with the 'is_required' field
    }

    public function get_options($question_id) {
        $this->db->where('question_id', $question_id);
        $query = $this->db->get('options');
        return $query->result(); // Ensure this returns the options related to the question
    }
    
}