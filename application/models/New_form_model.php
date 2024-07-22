<?php
class New_form_model extends CI_Model {

    public function save_form_data($formId, $formData) {
        if (!$formId || !isset($formData['questions'])) {
            return false; // Handle error if formId is not valid or questions are missing
        }
    
        $questions_array = $formData['questions'];
    
        foreach ($questions_array as $question) {   
            $questionData = [
                'form_id' => $formId,
                'text' => $question['text'],
                'type' => $question['type'],
                'required' => isset($question['required']) && $question['required'] == 'true' ? 1 : 0
            ];
    
            $this->db->insert('questions', $questionData);
            $questionId = $this->db->insert_id(); // Get the inserted question_id
    
            // Handle options for multiple-choice, checkboxes, and dropdown questions
            if (in_array($question['type'], ['multiple-choice', 'checkboxes', 'dropdown'])) {
                foreach ($question['options'] as $option) {
                    if (!empty($option)) { // Avoid inserting empty options
                        $optionData = [
                            'question_id' => $questionId,
                            'option_text' => $option // Ensure column name matches database schema
                        ];
                        // Insert option into options table
                        $this->db->insert('options', $optionData);
                    }
                }
            }
        }
    
        return true; // Return true indicating success
    }
    
    
}
?>
