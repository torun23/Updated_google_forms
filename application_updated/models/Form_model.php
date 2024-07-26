<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_model extends CI_Model {

    public function save_form($form_data) {
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
    public function __construct() {
        $this->load->database();
    }

    public function get_form_title($form_id) {
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