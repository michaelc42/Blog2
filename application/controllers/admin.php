<?php

class Admin extends CI_Controller {

function __construct()
{
    parent::__construct();
	
    if($this->session->userdata('username') === FALSE)
	{	
		redirect('main/notAuthorized');
		die();
	}
	
}

public function admin_panel()
{	
	$data['main_content'] = 'admin_panel_view';
	$data['title'] = 'Control Panel';
	
	$this->load->view('includes/template', $data);
}

public function newPost()
{
	$this->load->library('form_validation');
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('new_content', 'Content', 'required');
    $formValid = $this->form_validation->run();
	
	if($formValid)
	{	
		$this->session->set_userdata('just_posted',TRUE);
		$this->load->model('admin_model');
		$this->admin_model->insertPost();
			
		
		redirect('admin/postSuccessful');
	}
	else 
	{
		$data['main_content'] = 'create_new_post_view';
		$data['title'] = 'Create a new post.';
		$this->load->view('includes/template', $data);
	}
	
	
}

public function postSuccessful()
{
	$data['main_content'] = 'post_successful_view';
	$data['title'] = 'Post created!';
	$this->load->view('includes/template', $data);
}

public function deletePost()
{
	echo 'Delete a post!';
}

}