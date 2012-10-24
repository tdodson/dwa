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
			AND password = '".$_POST['password']."'
			";

		$token = DB::instance(DB_NAME)->select_field($q);

		# Login failed
		if($token == "") {
			Router::redirect("/users/login");
		}
		# Login passwed
		else {
			setcookie("token", $token, strtotime('+2 weeks'), '/');

			Router::redirect("/");
		}

	}


	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function logout() {
		echo "display the logout page";
	}


	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function profile($user_name = NULL) {

		# Not logged in
		if(!$this->user) {
			echo "Members only. <a href='/users/login/'>Please login.</a>";
			return;
		}

		# Logged in	
		if($user_name == NULL) {
			echo "You did not specify a user";
		} else {

			# Setup the view
				$this->template->content = View::instance("v_users_profile");
				$this->template->title   = "Profile for ".$user_name;

			# Don't need to pass any variables to the view because all we need is $user and that's already set globally in c_base.php

			# Render the view
				echo $this->template;

		}	
	}

}