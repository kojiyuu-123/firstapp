<?php
class Users_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_users()
	{
    	$query = $this->db->get('users');
    	return $query->result_array();
	}
	
	public function update_user($user_id)
	{
	    $data = array(
	        'first_name' => $this->input->post('first_name'),
	        'last_name' => $this->input->post('last_name'),
	        'email' => $this->input->post('email'),
	        'phone_number' => $this->input->post('phone_number')
	    );

	    $this->db->where('id', $user_id);
	    return $this->db->update('users', $data);
	}

	public function create_user()
	{
	    $this->load->helper('url');

	    $data = array(
	        'first_name' => $this->input->post('first_name'),
	        'last_name' => $this->input->post('last_name'),
	        'email' => $this->input->post('email'),
	        'phone_number' => $this->input->post('phone_number')
	    );

	    return $this->db->insert('users', $data);
	}

	public function get_user($user_id)
	{
	    $query = $this->db->where('id', $user_id)->get('users');
	    return $query->row();
	}

	public function delete_user($user_id)
	{
	    return $this->db->where('id', $user_id)->delete('users');
	    // mySQL: WHERE id = $user_id
	}
}

?>