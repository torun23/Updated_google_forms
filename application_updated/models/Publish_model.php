<?php
class Publish_model extends CI_Model {

// Method to update form details including is_published status
public function update_form($form_id, $data) {
    $this->db->where('id', $form_id);
    return $this->db->update('forms', $data);
}

// Method to retrieve published forms by user
public function get_published_forms_by_user($user_id) {
    $this->db->where('user_id', $user_id);
    $this->db->where('is_published', 1);
    $this->db->order_by('id', 'DESC'); // Order by id column, most recent first
    $query = $this->db->get('forms');
    return $query->result();
}

}
