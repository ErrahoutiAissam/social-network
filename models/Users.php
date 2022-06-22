<?php

  class Users extends Model {
    public function __construct() {
      $this->table = 'users';
    }

    public function search($query) {
      return $this->requete("SELECT * FROM `users` 
        WHERE users.username LIKE '%$query%'
          OR users.firstname LIKE '%$query%'
          OR users.lastname LIKE '%$query%'")->fetchAll();
    }
  }
