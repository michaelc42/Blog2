<?php

class User_control_model extends CI_Model {

public function verifyUser($loginData)
{	

	/************************************************
		Query the db to see if the username exists.
		Only run the password query if the username
		exits.
	*************************************************/
	$nameExists = $this->db->select('username, userid')
			 ->from('users')
			 ->where('username', $loginData['username'])
			 ->get();
	
	$passCorrect = NULL; //Prep variable
	
	if( $nameExists->num_rows )
	{
		$passCorrect = $this->db->select('username')
				 ->from('users')
				 ->where('username', $loginData['username'])
				 ->where('password', $loginData['password'])
				 ->get();	
	}
	
	/*****************************************************
		Return data foreach case
	*****************************************************/
	if( !($nameExists->num_rows))
	{
		return array( 1 => 'wrongUsername');
	}
	
	if( $nameExists->num_rows && !($passCorrect->num_rows) )
	{
		return array( 1 => 'wrongPass');
	}
	
	if ( $passCorrect->num_rows() == 1)
	{
		return array($nameExists->row()->userid, 'loginOK');
	}
}

/**********************************************
	See if username is in the database
**********************************************/
public function doesUsernameExist($username)
{
	$exists = $this->db->select('username')
				   ->where('username', $username)
				   ->get('users');
	
	if ( $exists->num_rows() > 0 )
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

/*****************************************************
	Inserts new user data into database
*****************************************************/
public function createUser($data)
{
	$this->db->insert('users', $data);	
	return TRUE;
}


}