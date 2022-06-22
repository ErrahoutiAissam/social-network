<?php

  namespace App\Admin\Controllers;
  
  use \Exception;
  use \Validation;
  use \Validations;

  class Search extends Controller {
    public function __construct() {
      parent::__construct();
      $this->loadModel("Search");
    }

    public function getUsers($params = []) {
      $query = $params['query'];
      $users = $this->Search->getUsers($query);

      $this->render('users', compact('users', 'query'));
    }

    public function getPosts($params = []) {
      $query = $params['query'];
      $posts = $this->Search->getPosts($query);

      $this->render('posts', compact('posts', 'query'));
    }
  }