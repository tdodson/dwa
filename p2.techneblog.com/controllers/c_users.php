<?php

class users_controller extends base_controller {


	public function __construct() {
		parent::__construct();
	}


	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function signup() {

		# Set up template
		$this->template->content = View::instance("v_users_signup");

		# Render the template
		echo $this->template;

	}


	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function p_signup() {

		# What data was submitted
		//print_r($_POST);

		# Encrypt password
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

		# Create and encrypt token
		$_POST['token']    = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

		# Store current timestamp 
		$_POST['created']  = Time::now(); # This returns the current timestamp
		$_POST['modified'] = Time::now();

		# Insert 
		DB::instance(DB_NAME)->insert('users', $_POST);

		echo "You're registered! Now go <a href='/users/login'>login</a>";

	}


	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function login() {

		# Load the template
		$this->template->content = View::instance("v_users_login");
		$this->template->title = "Login";

		# Render the template
		echo $this->template;

	}


	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function p_login() {

		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

		# Prevent SQL injection attacks
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);

		$q = "SELECT token
			FROM users
			WHERE email = '".$_POST['email']."'
			AND password = '".$_POST['password']."'";

		$token = DB::instance(DB_NAME)->select_field($q);

		# Login failed
		if(!token) {
			Router::redirect("/users/login");

		# Login password
		} else {
			setcookie("token", $token, strtotime('+1 year'), '/');

			#redirect to main page
			Router::redirect("/");
		}

	}

	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function logout() {
		# Generate and save a new token for next login
		$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
		
		# Create the data array for the update method
		$data = Array("token" => $new_token);

		# Updated DB
		DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token. "'");

		# Delete the token cookie to logout user
		setcookie("token", "", strtotime('-1 year'), '/');

		# Back to landing page
		Router::redirect("/");

	}


	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function profile() {

		# Not logged in
		if(!$this->user) {
			echo "Members only. <a href='/users/login/'>Please login.</a>";
			return false;
		}

		# Setup the view
			$this->template->content = View::instance("v_users_profile");
			$this->template->title   = "Profile for ".$user_name;

		# Don't need to pass any variables to the view because all we need is $user and that's already set globally in c_base.php

		# Render the view
			echo $this->template;	
	}

}