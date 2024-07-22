<?php
class Response_model extends CI_Model {
// 888888888888888888888

    public function insert_response($data) {
        $this->db->insert('responses', $data);
        return $this->db->insert_id();
    }

    public function insert_response_answer($data) {
        $this->db->insert('response_answers', $data);
    }

    public function get_form($form_id) {
        $this->db->where('id', $form_id);
        $query = $this->db->get('forms');
        return $query->row();
    }

// 888888888888888888888


    public function get_questions($form_id) {
        $this->db->where('form_id', $form_id);
        $query = $this->db->get('questions');
        return $query->result();
    }

    public function get_options($question_id) {
        $this->db->where('question_id', $question_id);
        $query = $this->db->get('options');
        return $query->result();
    }
// 888888888888888888888
   
    public function get_responses_by_form($form_id) {
        $this->db->select('responses.id as response_id, responses.submitted_at, users.username');
        $this->db->from('responses');
        $this->db->join('users', 'responses.user_id = users.id');
        $this->db->where('responses.form_id', $form_id);
        $query = $this->db->get();
        $responses = $query->result();

        foreach ($responses as &$response) {
            $response->answers = $this->get_answers_by_response_id($response->response_id);
        }

        return $responses;
    }

    public function get_answers_by_response_id($response_id) {
        $this->db->select('response_answers.question_id, response_answers.answered_text');
        $this->db->from('response_answers');
        $this->db->where('response_answers.response_id', $response_id);
        $query = $this->db->get();
        return $query->result();
    }
// 888888888888888888888

      public function get_responses($form_id) {
        $this->db->where('form_id', $form_id);
        $query = $this->db->get('responses');
        return $query->result();
    }


    // Method to get response details
    public function get_response($response_id) {
        $this->db->select('responses.*, users.email');
        $this->db->from('responses');
        $this->db->join('users', 'responses.user_id = users.id'); // Assuming 'user_id' is the foreign key in 'responses'
        $this->db->where('responses.id', $response_id);
        $query = $this->db->get();
        return $query->row();
    }
    

    // Method to get questions and answers for a response
    public function get_questions_and_answers($response_id) {
        $this->db->select('questions.id AS question_id, questions.text AS question_text, response_answers.answered_text, users.email');
        $this->db->from('questions');
        $this->db->join('response_answers', 'questions.id = response_answers.question_id');
        $this->db->join('responses', 'response_answers.response_id = responses.id');
        $this->db->join('users', 'responses.user_id = users.id'); // Join to get the user's email
        $this->db->where('response_answers.response_id', $response_id);
        $query = $this->db->get();
        return $query->result();
    }
    

    public function get_form_by_response($response_id) {
        $this->db->select('forms.title, forms.description');
        $this->db->from('forms');
        $this->db->join('responses', 'forms.id = responses.form_id');
        $this->db->where('responses.id', $response_id);
        $query = $this->db->get();
        return $query->row();
    }
}
