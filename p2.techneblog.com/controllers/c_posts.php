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
}

?>