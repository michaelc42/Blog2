<?php

class Admin_model extends CI_Model{

public function insertPost()
{
	$this->load->helper('date');

	$data = array( 'userid'		=> $this->session->userdata('userid'),
				   'title'		=> $this->input->post('title'),
				   'date'		=> now(),
				   'content'	=> $this->input->post('new_content'),
				   'tocomments'	=> sha1($this->session->userdata('userid').$this->input->post('title'))
							);
	
	$this->db->insert('posts', $data);

	return TRUE;
}


}