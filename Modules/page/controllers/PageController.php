<?php

use _Self\View;
use _Self\DB;

class PageController {
	
	public $db = null;
	public $view = null;

	public function __construct()
	{
        $this->db = new DB();
        $this->view = new View();
	}

	public function homepage()
	{
		$this->view->make('index');
	}

	public function aboutpage()
	{
        $this->view->make('about');
	}
    
    public function posts()
	{
        $posts = $this->db->table("posts")->all();
        $this->view->make('posts', $posts);
	}
    
    public function post($params)
	{
		$post = $this->db->table("posts")->where(['slug'=>$params['post']])->get();
        $this->view->make('post', $post[0]);
	}
}