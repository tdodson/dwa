<?php

class posts_controller extends base_controller {
	

	public function __construct() {
		parent::__construct();

		if(!$this->user) {
			die("Members only. <a href='/users/login'>Please login</a>");
		}
	}

	public function add() {

		#Setup View
		$this->template->content = View::instance("v_posts_add");

		# Render the template
		echo $this->template;
	}

	public function p_add() {
		print_r($_POST);
	}
}

?>