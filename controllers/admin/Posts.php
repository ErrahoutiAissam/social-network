<?php

  namespace App\Admin\Controllers;

  use \Exception;
  use \Validation;
  use \Validations;

  class Posts extends Controller {
    public function __construct() {
      parent::__construct();
      $this->loadModel('Posts');
      $this->loadModel('Users');
    }

    public function index($params = []) {
      $posts = $this->Posts->findAll();

      $this->render('index', compact('posts'));
    }

    public function get($params = []) {
      $post = $this->Posts->find($params['id']);
      $this->render('get', compact('post'));
    }

    public function add($params = []) {
      $users = $this->Users->findAll();
      $this->render('add', compact('users'));
    }
    
    public function edit($params = []) {
      $post = $this->Posts->find($params['id']);
      $users = $this->Users->findAll();

      if (!$post) {
        throw new Exception('Post non trouvé');
      }

      $this->render('edit', compact('post', 'users'));
    }
    public function delete($params = []) {
      $post = $this->Posts->find($params['id']);

      if (!$post) {
        throw new Exception('Post non trouvé');
      }

      $id = $post['id'];
      $this->render('delete', compact('id'));
    }

    public function postAdd($params = []) {
      $validator = new Validations([
        (new Validation('user', $params['user'], 'int'))
          ->setLabel('Identifiant d\'utilisateur')
          ->setRequired(true),
        (new Validation('content', $params['content'], 'text'))
          ->setLabel('Contenu')
          ->setRequired(true),
      ]);
      
      $errors = $validator->getErrors();
      $success = $validator->isSuccess();

      if ($success) {
        $user = $this->Users->find($params['user']);

        if (!$user) {
          if (isset($errors['user']))
            $errors['user']['exist'] = 'Utilisateur non trouvé';
          else
            $errors['user'] = ['exist' => 'Utilisateur n\'existe pas'];

          $success = false;
        } else {
          $this->Posts->create([
            'content' => htmlspecialchars(trim($params['content'])),
            'id_user' => htmlspecialchars(trim($params['user'])),
            'create_at' => date('Y-m-d'),
          ]);
        }
      }
      $users = $this->Users->findAll();
      $this->render('add', compact('errors', 'success', 'users'));
    }

    public function postEdit($params = []) {
      $validator = new Validations([
        (new Validation('user', $params['user'], 'int'))
          ->setLabel('Identifiant d\'utilisateur')
          ->setRequired(true),
        (new Validation('content', $params['content'], 'text'))
          ->setLabel('Contenu')
          ->setRequired(true),
      ]);
      
      $errors = $validator->getErrors();
      $success = $validator->isSuccess();

      if ($success) {
        $user = $this->Users->find($params['user']);

        if (!$user) {
          if (isset($errors['user']))
            $errors['user']['exist'] = 'Utilisateur non trouvé';
          else
            $errors['user'] = ['exist' => 'Utilisateur n\'existe pas'];

          $success = false;
        } else {
          $this->Posts->update($params['id'], [
            'content' => htmlspecialchars(trim($params['content'])),
            'id_user' => htmlspecialchars(trim($params['user'])),
          ]);
        }
      }

      $users = $this->Users->findAll();
      $post = $this->Posts->find($params['id']);
      $this->render('edit', compact('errors', 'success', 'users', 'post'));
    }
    
    public function postDelete($params = []) {
      $post = $this->Posts->find($params['id']);

      if (!$post)
        throw new Exception("Post d'identifiant " . $params['id'] . ' non trouvé');

      $this->Posts->delete($params['id']);
      
      header('Location: ' . BASE_URL_ADMIN . '/posts');
      die();
    }
  }