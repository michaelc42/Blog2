<?php
/***************************************************************************************************
	This controller controls the login, create user, and logout controls.
***************************************************************************************************/

class User_control extends CI_Controller {

    function __construct()
    {   
        //makes sure you dont over ride the default constructor
        parent::__construct();
        //starts the session on page load
        session_start();
		//print_r( $this->session->all_userdata());
    }

	/***************************************************
		Login Controller controls the main login view
	****************************************************/
    public function login()
    {
        /************************************************
			Set rules for the form
		************************************************/
		$this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
        $formValid = $this->form_validation->run();
		
		
		/************************************************
			Load model and pass login data to be verified
			returns strings for the Switch.  Only load
			and prep the data
			if the form is valid.  
		************************************************/
		$okToLogin = NULL; //prep variable
		$loginData[] = NULL; //prep array
		if( $formValid )
		{
			$loginData['username'] = $this->input->post('username');
			$loginData['password'] = md5($this->input->post('password'));
			
			$this->load->model('user_control_model');
			$okToLogin = $this->user_control_model->verifyUser($loginData);
		}
		
		/************************************************
			Check to see if the username or password
			are correct.  Each case determines if the
			name or pass are wrong or correct. Output
			errors to the view if there are any.
		************************************************/
		switch($okToLogin[1])
		{
		case 'wrongUsername':
			$data['wrongUsername'] = "Username does not exist.";
			$data['wrongPassword'] = 0;
			break;
		case 'wrongPass':
			$data['wrongPassword'] = "Password is incorrect.";
			$data['wrongUsername'] = 0;
			break;
		case 'loginOK':
			//create a new session
			$this->session->set_userdata('username', $loginData['username']);
			$this->session->set_userdata('userid', $okToLogin[0]);
			redirect('main');
			$data['wrongUsername'] = 0;
			$data['wrongPassword'] = 0;
			break;
		default :
			$data['wrongUsername'] = 0;
			$data['wrongPassword'] = 0;
			break;
		}
		
        /************************************************
			Load the login_view and pass it any data
		************************************************/
        $data['main_content'] = 'login_view';
        $data['title'] = 'Login';
        $this->load->view('includes/template', $data);
    
    }
	
	/*************************************************
		Creates a session if the user logs in from
		the header login
	*************************************************/
	/*
	public function headerLogin()
	{
			$loginData['username'] = $this->input->post('header_username');
			$loginData['password'] = md5($this->input->post('header_password'));
			
			$this->load->model('user_control_model');
			$okToLogin = $this->user_control_model->verifyUser($loginData);
			
			if ($okToLogin === "loginOK")
			{
				echo "Login name: ";
				echo $this->input->post('header_username');//$loginData['username'];
				echo "Login correct";
				echo $okToLogin;
			}
			else
			{
				echo "Login incorrect";
			}
	}
	*/
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('user_control/login');
	}

    public function new_user()
    {
		/************************************************
			Set rules for the create_new_user form
		************************************************/
        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name', 'First name', 'required');
        $this->form_validation->set_rules('last_name', 'Last name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_message('matches', 'Passwords do not match.')
             ->set_rules('password', 'Password', 'required|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password Confirm', 'required');
        $formValid = $this->form_validation->run();
		
		
		/************************************************
			if the form is valid, prep the data and
			insert new user info into the table
			then redirect to the login screen
		************************************************/
		$userCreated = NULL; //prep
		if ( $formValid )
		{
			$userData['first_name'] = $this->input->post('first_name');
			$userData['last_name'] = $this->input->post('last_name');
			$userData['username'] = $this->input->post('username');
			$userData['email'] = $this->input->post('email');
			$userData['password'] = md5($this->input->post('password'));
			
			$this->load->model('user_control_model');
			$usernameExist = $this->user_control_model->doesUsernameExist($userData['username']);
			
			if ( $usernameExist == FALSE )
			{
				$this->user_control_model->createUser($userData);
				$userCreated = TRUE;
				redirect('user_control/user_created');
				
			}
			else
			{
				$userCreated = FALSE;
			}
		}
		$userCreated;
		/************************************************
			Load view and pass data
		************************************************/
        $data['main_content'] = 'new_user_view';
        $data['title'] = 'Create New User';
		$data['userExists'] = ($userCreated === FALSE ? 'Username already exists.' : '');
        $this->load->view('includes/template', $data);
    }
	
	/**********************************************
		Makes a view to tell the user that the
		account has been created
	**********************************************/
	public function user_created()
	{
		$data['main_content'] = 'account_created_view';
		$data['title'] = 'New Account Created';
		$this->load->view('includes/template', $data);
	}

}
