<?php

  namespace App\Admin\Models;

  class Posts extends Model {
    public function __construct() {
      $this->table = 'posts';
    }
  }