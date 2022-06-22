<?php

  namespace App\Admin\Controllers;

  use \Exception;
  use \Validation;
  use \Validations;

  class Users extends Controller {
    public function __construct() {
      parent::__construct();
      $this->loadModel('Users');
      $this->loadModel('Posts');
      $this->loadModel('Follows');
    }

    public function index($params = []) {
      $users = $this->Users->findAllWithNbPosts();

      $this->render('index', compact('users'));
    }

    public function profil($params = []) {
      $this->get(array_merge($params, ['id' => $params['auth-admin']]));
    }

    public function get($params = []) {
      $user = $this->Users->find($params['id']);

      if (!$user) {
        throw new Exception('Utilisateur non trouvé');
      } else {
        $posts = $this->Posts->findBy([
          'id_user' => $user['id']
        ]);
        $followers = $this->Follows->findBy([
          'id_following' => $user['id']
        ]);
        $following = $this->Follows->findBy([
          'id_follower' => $user['id']
        ]);
      }

      $this->render('get', compact('user', 'posts', 'followers', 'following'));
    }
    
    public function edit($params = []) {
      $user = $this->Users->find($params['id']);

      if (!$user) {
        throw new Exception('Utilisateur non trouvé');
      }

      $this->render('edit', compact('user'));
    }

    public function delete($params = []) {
      $user = $this->Users->find($params['id']);

      if (!$user) {
        throw new Exception('Post non trouvé');
      }

      $id = $user['id'];
      $this->render('delete', compact('id'));
    }

    public function postEdit($params = []) {
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
        $user = $this->Users->find($params['id']);

        if (!$user) {
          if (isset($errors['user'])) 
            $errors['user']['exist'] = 'Utilisateur non trouvé';
          else
            $errors['user'] = ['exist' => 'Utilisateur n\'existe pas'];

          $success = false;
        } else {
          $this->Users->update($user['id'], [
            'firstname' => htmlspecialchars(trim($params['firstname'])),
            'lastname' => htmlspecialchars(trim($params['lastname'])),
            'email' => htmlspecialchars(trim($params['email']))
          ]);
        }
      }

      $user = $this->Users->find($params['id']);
      $this->render('edit', compact('errors', 'success', 'user'));
    }
    
    public function postDelete($params = []) {
      $user = $this->Users->find($params['id']);

      if (!$user)
        throw new Exception("Utilisateur d'identifiant " . $params['id'] . ' non trouvé');

      $this->Users->delete($params['id']);
      
      header('Location: ' . BASE_URL_ADMIN . '/users');
      die();
    }
  }