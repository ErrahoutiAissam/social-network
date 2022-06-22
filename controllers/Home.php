<?php

  namespace App\Controllers;

  class Home extends Controller {
    public function __construct() {
      parent::__construct();
      $this->loadModel("Posts");
      $this->loadModel("Follows");
    }

    public function index($params = []) {
      $posts = $this->Posts->findByFollowers($params['auth-client']);
      $followers = $this->Follows->findBy(['id_follower' => $params['auth-client']]);
      $following = $this->Follows->findBy(['id_following' => $params['auth-client']]);
      
      $this->render('index', compact('posts', 'followers', 'following'));
    }
  }