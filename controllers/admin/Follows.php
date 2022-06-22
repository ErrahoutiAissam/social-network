<?php

  namespace App\Admin\Controllers;

  use \Exception;

  class Follows extends Controller {
    public function __construct() {
      parent::__construct();
      $this->loadModel('Users');
      $this->loadModel('Follows');
    }

    public function index() {
      $follows = $this->Follows->findAll();

      $this->render('index', compact('follows'));
    }
    public function add($params = []) {
      $users = $this->Users->findAll();
      $this->render('add', compact('users'));
    }
    public function get($params = []) {
      $follows = $this->Follows->find($params['id']);
      $this->render('get', compact('follows'));
    }

    public function delete($params = []) {
      $follow = $this->Follows->find($params['id']);

      if (!$follow) {
        throw new Exception('Follow non trouvé');
      }

      $id = $follow['id'];
      $this->render('delete', compact('id'));
    }
    
    public function postAdd($params = []) {
      $errors = [];
      $success = false;
      if ($params['following'] != $params['follower']) {
        $follower = $this->Users->find($params['follower']);
        $following = $this->Users->find($params['following']);

        if (!$follower || !$following) {
          throw new Exception("Utilisateur non trouvé");
        }

        $alreadyFollowed = $this->Follows->findBy([
          'id_follower' => $params['follower'],
          'id_following' => $params['following']
        ]);

        if ($alreadyFollowed) {
          $errors['exist'] = "Déja abonné";
        } else {
          $this->Follows->create([
            'id_follower' => $params['follower'],
            'id_following' => $params['following'],
            'follow_at' => date('Y-m-d')
          ]);
        }
      } else {
        $errors['equals'] = "L'utilisateur abonné doit être different de l'utilisateur qui va sabonné";
      }

      $users = $this->Users->findAll();
      $this->render('add', compact('users', 'errors', 'success'));
    }

    public function postDelete($params = []) {
      $follow = $this->Follows->find($params['id']);

      if (!$follow)
        throw new Exception("Abonné d'identifiant " . $params['id'] . ' non trouvé');

      $this->Follows->delete($params['id']);
      
      header('Location: ' . BASE_URL_ADMIN . '/follows');
      die();
    }
  }