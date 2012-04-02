<?php
/***************************************************************************************************
	This controller controls the main homepage
***************************************************************************************************/

class Main extends CI_Controller {
	/***************************************************************
		The index is the home page.  It displays the four latest
		posts.  Links to comments.
	***************************************************************/
	public function index($offset = NULL)
	{
		$limit = 4;
		
		$this->load->helper('date');
		
		$this->load->model('main_model');	
		
		$totalPosts = $this->main_model->getTotalPosts();
		$data['posts'] = $this->main_model->getBlogPosts($limit,$offset); //returns array of data, and an array with the total_rows				
		
		
		$data['main_content'] = 'main_page_view';
		$data['title'] = 'Main Page';
		
		$this->load->library('pagination');

		$config['base_url'] = 'http://localhost/apps/blog2/main/index/';
		$config['total_rows'] = $totalPosts;
		$config['per_page'] = $limit;
		$config['display_pages'] = FALSE;
		$config['prev_link'] = '&lt- Newer ';	
		$config['next_link'] = ' Older -&gt;';

		$this->pagination->initialize($config); 

		
		$this->load->view('includes/template', $data);
	}
	
	
	/****************************************************************
		This function controls the way a single post is handled
		and viewed.  This gets the comments and adds them to the
		page too.
	****************************************************************/
	public function singlePost($linkToPost)
	{
		$postid = substr($linkToPost, -2); //the postid is the last two chars of the link
		
		$this->load->model('main_model');
		
		$result = $this->main_model->getSinglePost($postid);
		
		$comments = $this->main_model->getComments($postid);
		
		$data['main_content'] = 'post_view';
		$data['title'] = 'Single Post';
		$data['results'] = $result;
		$data['comments'] = $comments;
		
		$this->load->view('includes/template', $data);
	
	}
	
	/****************************************************
		Creates a controller and sends to to a 
		not authorized page
	****************************************************/
	public function notAuthorized()
	{
		$data['main_content'] = 'not_authorized_view';
		$this->load->view('includes/template', $data);
	}
}
