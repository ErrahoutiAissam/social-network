<?php

  class Home extends Model {
    public function __construct() {
      $this->table = 'posts';
    }

    public function findPosts($id) {
      return $this->requete('', [$id])->fetchAll();
    }
  }
