<?php

  namespace App\Admin\Models;

  class Users extends Model {
    public function __construct() {
      $this->table = 'users';
    }

    public function findAllWithNbPosts() {
      return $this->requete('SELECT users.id, users.firstname, users.lastname, users.email, COUNT(*) as `nbr_posts`, users.type
        FROM users
        INNER JOIN posts
        ON posts.id_user = users.id
        GROUP BY users.id
        
        UNION
        
        SELECT users.id, users.firstname, users.lastname, users.email, 0 as `nbr_posts`, users.type
        FROM users
        WHERE users.id 
          NOT IN (SELECT posts.id_user FROM posts)')
        ->fetchAll();
    }
  }