<?php

  namespace App\Admin\Controllers;

  class Home extends Controller {
    public function __construct() {
      parent::__construct();
    }

    public function index($params = []) {
      $this->render('index');
    }
  }