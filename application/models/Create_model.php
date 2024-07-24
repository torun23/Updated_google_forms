
<?php
class Create_model extends CI_Model {

    public function details() {
        // Retrieve user_id from session
        $user_id = $this->session->userdata('user_id');

        // Prepare data to insert into forms table
        $data = array(
            'user_id' => $user_id,
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description')
        );

        // Insert data into forms table
        $this->db->insert('forms', $data);

        // Store form_id in session
        $formId = $this->db->insert_id();
        $this->session->set_userdata('form_id', $formId);

return $formId;
    }

}
?>
