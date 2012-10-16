<?php

class users_controller extends base_controller {

	public function __construct() {
		parent::__construct();
		//echo "users_controller construct called<br><br>";
	} 
	
	public function index() {
		echo "Welcome to the users's department";
	}
	
	public function signup() {
		echo "This is the signup page";
	}
	
	public function login() {
		echo "This is the login page";
	}
	
	public function logout() {
		echo "This is the logout page";
	}
	
	public function profile($user_name = NULL) 
	{	
		# Setup view
		$this->template->content = View::instance('v_users_profile');
		$this->template->title = "Profile";

		# Load CSS / JS
			$client_files = Array 
			(
				"//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js",
				"/css/users.css",
				"/js/users.js",
			);

			$this->template->client_files = Utils::load_client_files($client_files);

		# Pass information to the view
		$this->template->content->user_name = $user_name;

		# Render template
		echo $this->template;
	}
		
} # end of the class


