<?php

  namespace App\Controllers;

  use \Exception;
  use \Validation;
  use \Validations;
  
  class Users extends Controller {
    public function __construct() {
      parent::__construct();
      $this->loadModel("Users");
      $this->loadModel("Follows");
      $this->loadModel("Posts");
    }

    public function search($params = []) {
      $query = $params['query'];
      $results = $this->Users->search($query);

      $this->render('search', compact('results', 'query'));
    }

    public function editProfil($params = []) {
      $validator = new Validations([
        (new Validation('lastname', $params['lastname'], 'words'))
          ->setLabel('Nom d\'utilisateur')
          ->setRequired(true),
        (new Validation('firstname', $params['firstname'], 'words'))
          ->setLabel('Prénom d\'utilisateur')
          ->setRequired(true),
        (new Validation('email', $params['email'], 'email'))
          ->setLabel('Email')
          ->setRequired(true)
      ]);
      
      $errors = $validator->getErrors();
      $success = $validator->isSuccess();

      if ($success) {
        $this->Users->update($params['auth-client'], [
          'firstname' => $params['firstname'],
          'lastname' => $params['lastname'],
          'email' => $params['email']
        ]);
      }

      header('Location: ' . BASE_URL . '/profil');
      die();
    }

    public function profil($params = []) {
      $this->get(array_merge($params, ['id' => $params['auth-client']]));
    }

    public function get($params = []) {
      $user = $this->Users->find($params['id']);
      $amIFollowing = true;
      if ($params['id'] != $params['auth-client']) {
        $results = $this->Follows->findBy([
          'id_follower' => $params['auth-client'],
          'id_following' => $params['id']
        ]);

        if (count($results) == 0)
          $amIFollowing = false;
      }

      if (!$user)
        throw new Exception("Utilisateur d'identifiant " . $params['id'] . " non trouvé");
      
      $posts = $this->Posts->findBy([ 'id_user' => $params['id'] ]);
      $followers = $this->Follows->findBy(['id_follower' => $params['id']]);
      $following = $this->Follows->findBy(['id_following' => $params['id']]);

      $this->render('get', compact('posts', 'user', 'followers', 'following', 'amIFollowing'));
    }
  }