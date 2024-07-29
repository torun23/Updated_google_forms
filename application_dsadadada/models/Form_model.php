<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_model extends CI_Model
{

    // Function to get form details by ID
    public function get_form_by_id($form_id)
    {
        $this->load->database();
        $this->db->where('id', $form_id);
        $query = $this->db->get('forms');
        return $query->row();
    }
    // Get the total number of forms
    public function get_total_forms($user_id) {
        // Ensure user_id is passed as a parameter and used in the query
        $this->db->where('user_id', $user_id);
        return $this->db->count_all_results('forms'); // Use count_all_results to ensure WHERE conditions are applied
    }
    
    // Function to count published forms
    public function get_published_forms($user_id) {
        // Ensure user_id and is_published are passed as parameters and used in the query
        $this->db->where('user_id', $user_id);
        $this->db->where('is_published', 1);
        return $this->db->count_all_results('forms'); // Use count_all_results to ensure WHERE conditions are applied
    }

    // Function to get all forms
    public function get_all_forms($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('forms');
        return $query->result();
    }
    
    public function save_form($form_data)
    {
        $this->db->trans_start();

        foreach ($form_data as $section) {
            $question_data = array(
                'form_id' => $section['form_id'],
                'text' => $section['text'],
                'type' => $section['type'],
                'required' => $section['required'],
                'created_at' => date('Y-m-d H:i:s')
            );

            $this->db->insert('questions', $question_data);
            $question_id = $this->db->insert_id();

            foreach ($section['options'] as $option_text) {
                $option_data = array(
                    'question_id' => $question_id,
                    'option_text' => $option_text,
                    'created_at' => date('Y-m-d H:i:s')
                );

                $this->db->insert('options', $option_data);
            }
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        } else {
            return true;
        }
    }
    public function __construct()
    {
        $this->load->database();
    }

    public function get_form_title($form_id)
    {
        $this->db->select('title'); // Assuming the title column in the forms table is called 'title'
        $this->db->from('forms');
        $this->db->where('id', $form_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->title;
        } else {
            return null;
        }
    }
}
