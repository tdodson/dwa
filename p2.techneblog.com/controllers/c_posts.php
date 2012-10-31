<?php

class posts_controller extends base_controller {
	

	public function __construct() {
		parent::__construct();

		# To use this controller, the user must be logged in
		if(!$this->user) {
			die("Members only. <a href='/users/login'>Please login</a>");
		}
	}

	public function add() {

		#Setup View
		$this->template->content = View::instance("v_posts_add");
		$this->template->title = "Add a new post";

		# Render the template
		echo $this->template;
	}

	public function p_add() {

		# Associate this post with this user
		$_POST['user_id'] = $this->user->user_id;

		# Unix timestamp of when this post was created / modified
		$_POST['created'] = Time::now();
		$_Post['modified'] = Time::now();

		# Insert into database
		DB::instance(DB_NAME)->insert('posts', $_POST);

		# Quick and dirty feedback
		echo "Your post has been added. <a href='/posts/add'>Add another</a>?";
	}

	public function index() {
		$this->template->content = View::instance("v_posts_index");
		$this->template->title = "Posts";

		# SQL Query
		$q = "SELECT *
			FROM posts
			JOIN users USING (user_id)";

		# Run query
		$posts = DB::instance(DB_NAME)->select_rows($q);

		# Pass data to the view
		$this->template->content->posts = $posts;

		# Render view
		echo $this->template;
	}

	public function users() {
		# Setup the view
		$this->template->content = View::instance("v_posts_users");
		$this->template->title = "Users";

		# Query to get users
		$q = "SELECT *
			FROM users";

		# Store users in a variable
		$users = DB::instance(DB_NAME)->select_rows($q);

		# Find users followed by this user.
			$q = "SELECT *
				FROM users_users
				WHERE user_id = ".$this->user->user_id;

			$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');
			
		# Pass data (users and connections) to the view
		$this->template->content->users       = $users;
		$this->template->content->connections = $connections;

		# Render the view
		echo $this->template;

	}

	public function follow ($user_id_followed) {
		# Prepare our data array to be inserted
		$data = Array(
			"created" => Time::now(),
			"user_id" => $this->user->user_id,
			"user_id_followed" => $user_id_followed
		);
	
		# Do the insert
		DB::instance(DB_NAME)->insert('users_users', $data);

		# Send them back
		Router::redirect("/posts/users");
	}

	public function unfollow($user_id_followed) {

		# Delete this connection
		$where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
		DB::instance(DB_NAME)->delete('users_users', $where_condition);
		
		# Send them back
		Router::redirect("/posts/users");
	}	
}

?>