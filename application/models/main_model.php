<?php

class Main_model extends CI_Model {


/************************************************
	This function gets all the blog post
************************************************/
public function getBlogPosts($totalPosts, $offset)
{
	$this->db->select('users.username,users.first_name, users.last_name, posts.postid, 
					   posts.title, posts.date, posts.content, posts.numberComments, posts.tocomments');
    $this->db->from('posts');
    $this->db->join('users', 'users.userid = posts.userid', 'inner');
	$this->db->order_by("posts.postid", "desc"); 
	$this->db->limit( $totalPosts, $offset);
	
	$query = $this->db->get();

	return $query->result();

}

public function getTotalPosts()
{
	$query = $this->db->select()->get('posts');
	
	return $query->num_rows();
}

/************************************************
	This function gets the post to display
	in the singel post_view
************************************************/
public function getSinglePost($postid)
{
	$query = $this->db->where('postid', $postid)
				  ->select('users.username, users.first_name, users.last_name,
					posts.title, posts.date, posts.content')
				  ->from('posts')->join('users', 'users.userid = posts.userid', 'inner')
				  ->get();
		
	return $query->result();
}

/******************************************
	Gets the comment for the specific
	post
******************************************/
public function getComments($postid)
{
	$query = $this->db->where('postid', $postid)
		->select('comments.title, comments.comment, comments.date, users.username,
				users.first_name, users.last_name')
		->from('comments')->join('users', 'users.userid = comments.userid',  'inner')
		->get();
	
	return $query->result();
}

}//end class