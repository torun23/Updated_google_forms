<?php
class Updation_model extends CI_Model
{

    public function get_form($form_id)
    {
        $this->db->where('id', $form_id);
        $query = $this->db->get('forms');
        return $query->row_array();
    }

    public function get_questions($form_id)
    {
        $this->db->where('form_id', $form_id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('questions');
        return $query->result_array();
    }

    public function get_options()
    {
        $query = $this->db->get('options');
        return $query->result_array();
    }
    public function update_form_data($form_id, $title, $description, $questions)
    {
        $this->db->trans_start();
    
        // Update form title, description, and modified_on timestamp
        $data = [
            'title' => $title,
            'description' => $description,
            'modified_on' => date('Y-m-d H:i:s') // Ensure this is set correctly
        ];
        $this->db->where('id', $form_id);
        $this->db->update('forms', $data);
        
    
        // Update questions
        $this->db->where('form_id', $form_id);
        $this->db->delete('questions');
    
        foreach ($questions as $question) {
            $question_data = [
                'form_id' => $form_id,
                'text' => $question['text'],
                'type' => $question['type'],
                'is_required' => $question['required'] // Correctly capture the required value
            ];
            $this->db->insert('questions', $question_data);
            $question_id = $this->db->insert_id();
    
            if (isset($question['options'])) {
                foreach ($question['options'] as $option_text) {
                    $option_data = [
                        'question_id' => $question_id,
                        'option_text' => $option_text
                    ];
                    $this->db->insert('options', $option_data);
                }
            }
        }
    
        $this->db->trans_complete();
    
        return $this->db->trans_status();
    }
    
    private function update_question_options($question_id, $options)
    {
        // Fetch existing options for this question
        $existing_options = $this->db->where('question_id', $question_id)->get('options')->result_array();
        $existing_option_texts = array_column($existing_options, 'option_text');

        // Insert or update options
        foreach ($options as $option_text) {
            if (in_array($option_text, $existing_option_texts)) {
                // Option already exists, no need to insert
                continue;
            }

            // Insert new option
            $option_data = [
                'question_id' => $question_id,
                'option_text' => $option_text
            ];
            $this->db->insert('options', $option_data);
        }

        // Delete options that are no longer present
        $options_to_delete = array_diff($existing_option_texts, $options);
        if (!empty($options_to_delete)) {
            $this->db->where('question_id', $question_id);
            $this->db->where_in('option_text', $options_to_delete);
            $this->db->delete('options');
        }
    }



}
?>