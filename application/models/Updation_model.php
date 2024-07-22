<?php
class Updation_model extends CI_Model {

    public function get_form($form_id) {
        $this->db->where('id', $form_id);
        $query = $this->db->get('forms');
        return $query->row_array();
    }

    public function get_questions($form_id) {
        $this->db->where('form_id', $form_id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('questions');
        return $query->result_array();
    }

    public function get_options() {
        $query = $this->db->get('options');
        return $query->result_array();
    }

    public function update_form($form_id, $title, $description) {
        $this->db->where('id', $form_id);
        $this->db->update('forms', ['title' => $title, 'description' => $description]);
    }

    public function update_questions($form_id, $questions) {
        // First, delete existing questions
        $this->db->where('form_id', $form_id);
        $this->db->delete('questions');

        // Insert new questions
        foreach ($questions as $question) {
            $this->db->insert('questions', [
                'form_id' => $form_id,
                'text' => $question['text']
            ]);
            $question_id = $this->db->insert_id();

            if (isset($question['options'])) {
                foreach ($question['options'] as $option) {
                    $this->db->insert('options', [
                        'question_id' => $question_id,
                        'option_text' => $option
                    ]);
                }
            }
        }
    }
}
?>
