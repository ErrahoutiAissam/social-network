<?php

  namespace App\Controllers;

  use \Exception;
  use \Validation;
  use \Validations;
  
  class Follows extends Controller {
    public function __construct() {
      parent::__construct();
      $this->loadModel("Users");
      $this->loadModel("Follows");
    }

    public function follow($params = []) {
      $user = $this->Users->find($params['id']);

      if (!$user)
        throw new Exception("Utilisateur non trouvé");

      $results = $this->Follows->findBy([
        'id_follower' => $params['auth-client'],
        'id_following' => $params['id']
      ]);

      if (count($results) == 0) {
        $this->Follows->create([
          'follow_at' => date('Y-m-d'),
          'id_follower' => $params['auth-client'],
          'id_following' => $params['id']
        ]);
      }

      header('Location: ' . BASE_URL . '/user/' . $params['id']);
      die();
    }

    public function unfollow($params = []) {
      $user = $this->Users->find($params['id']);

      if (!$user)
        throw new Exception("Utilisateur non trouvé");

      $results = $this->Follows->findBy([
        'id_follower' => $params['auth-client'],
        'id_following' => $params['id']
      ]);

      if (count($results) > 0) {
        $this->Follows->delete($results[0]['id']);
      }

      header('Location: ' . BASE_URL . '/user/' . $params['id']);
      die();
    }
  }