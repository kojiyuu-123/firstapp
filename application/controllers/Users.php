<?php
class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // This line will load user model to this controller
        $this->load->model('users_model');
        
        $this->load->helper('url');
        
    }
    
    public function index()
	{
		$data["users"] = $this->users_model->get_users();
		
		$data["page_title"] = "List of Users";
		
		$this->load->view('header', $data);
		
		$this->load->view('users/index', $data);
		
		$this->load->view('footer', $data);
	}
	
	public function create()
	{
	    $this->load->helper('form');
	    $this->load->library('form_validation');
	    $this->load->helper('url');

	    $data["page_title"] = "Create New User";
	    $this->form_validation->set_rules('first_name', 'First name', 'required');//required：必須
	    $this->form_validation->set_rules('last_name', 'Last name', 'required');
	    $this->form_validation->set_rules('email', 'Email', array('required','valid_email'));//メールアドレスチェック（複数可）
		$this->form_validation->set_rules('phone_number', 'Phone_number', 'required');
		// 'required' => 'regex_match(/^0[\d]{1,4}(\-)?[\d]{1,5}(\-)?[\d]{1,5}$/)'
		
	    if ($this->form_validation->run() === FALSE) {
	        $this->load->view('header', $data); 
	        $this->load->view('users/create', $data);
	        $this->load->view('footer');
	    } else {
	        $this->users_model->create_user();
	        redirect(base_url('/'));
	    }
	}
	
	public function update($user_id)
	{
	    $this->load->helper('form');
	    $this->load->library('form_validation');

	    $data["user"] = $this->users_model->get_user($user_id);

	    $data["page_title"] = "Update User";
	    $this->form_validation->set_rules('first_name', 'First name', 'required');
	    $this->form_validation->set_rules('last_name', 'Last name', 'required');
	    $this->form_validation->set_rules('email', 'Email', array('required','valid_email'));
	    $this->form_validation->set_rules('phone_number', 'Phone_number', 'required');
	    if ($this->form_validation->run() === FALSE) {
	        $this->load->view('header', $data); 
	        $this->load->view('users/update', $data);
	        $this->load->view('footer');
	    } else {
	        $this->users_model->update_user($user_id);
	        redirect(base_url('/'));
	    }
	}
	
	public function delete($user_id)
	{
	    $this->users_model->delete_user($user_id);
	    redirect(base_url('/'));
	}

	public function deletes($user_ids)
	{
		//文字列でidが送られてくるので、仕切り文字"_"で区切る。
		$delData = explode("_",$user_ids);
		//削除するユーザーのidが送られてくる。ここでforをまわせば良い?
		for ($i=0;$i<count($delData);$i++){
			$this->users_model->delete_user(intval($delData[$i]));
		}
		
	    redirect(base_url('/'));
	    
	}

}

?>
