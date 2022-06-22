<?php

  namespace App\Admin\Models;

  class Authentifications extends Model {
    public function __construct() {
      $this->table = 'users';
    }

    public function login(string $username, string $password) {
      $users = $this->findBy(['username' => $username, 'type' => 'admin']);

      if (!isset($users[0]))
        return false;

      if (password_verify($password, $users[0]['password']))
        return $users[0];

      return false;
    }
  }