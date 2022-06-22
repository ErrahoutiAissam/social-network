<?php

  namespace App\Controllers;

  use \Validation;
  use \Validations;
  
  class Posts extends Controller {
    public function __construct() {
      parent::__construct();
      $this->loadModel("Posts");
    }

    public function index() {}

    public function get($params = []) {
      $post = $this->Posts->find($params['id']);

      if (!$post)
        throw new Exception("Post d'identifiant " . $params['id'] . "non trouvé");

      $this->render('get', compact('post'));
    }

    public function edit($params = []) {
      $post = $this->Posts->find($params['id']);

      if (!$post)
        throw new Exception("Post d'identifiant " . $params['id'] . "non trouvé");

      // Un utilisateur peut modifier que ses propres posts
      if ($post['id_user'] != $params['auth'])
        throw new Exception("No route found");

      $this->render('edit');
    }

    // METHOD_REQUEST = POST pour la modification d'un post
    public function postEdit($params = []) {
      $post = $this->Posts->find($params['id']);

      if (!$post)
        throw new Exception("Post d'identifiant " . $params['id'] . "non trouvé");

      // Un utilisateur peut modifier que ses propres posts
      if ($post['id_user'] != $params['auth'])
        throw new Exception("No route found");
      
      $validator = new Validations([
        (new Validation('content', $params['content'], 'text'))
          ->setLabel('Contenu')
          ->setRequired(true)
          ->setMin(1)
      ]);

      $errors = $validator->getErrors();
      $success = $validator->isSuccess();

      if ($success) {
        $state = $this->Posts->update($params['id'], [
          'content' => $params['content']
        ]);

        if (!$state)
          $success = false;
      }

      header('Location: ' . BASE_URL . '/profil');
      die();
    }

    // afficher la page d'ajout d'un post
    public function add($params = []) {
      $this->render('add');
    }

    // METHOD_REQUEST = POST pour l'ajout d'un post
    public function postAdd($params = []) {
      $validator = new Validations([
        (new Validation('content', $params['content'], 'text'))
          ->setLabel('Contenu')
          ->setRequired(true)
          ->setMin(1)
      ]);

      $errors = $validator->getErrors();
      $success = $validator->isSuccess();

      if ($success) {
        $this->Posts->create([
          'content' => $params['content'],
          'id_user' => $params['auth-client'],
          'create_at' => date('Y-m-d h:i:s')
        ]);
      }

      header('Location: ' . BASE_URL . '/profil');
      die();
    }

    // afficher la page de suppression d'un post
    public function remove($params = []) {
      $post = $this->Posts->find($params['id']);

      if (!$post)
        throw new Exception("Post d'identifiant " . $params['id'] . "non trouvé");

      // Un utilisateur peut supprimer que ses propres posts
      if ($post['id_user'] != $params['auth'])
        throw new Exception("No route found");
      
      $this->render('remove');
    }

    // METHOD_REQUEST = POST pour la suppression d'un post
    public function postRemove($params = []) {
      $post = $this->Posts->find($params['id']);

      if (!$post)
        throw new Exception("Post d'identifiant " . $params['id'] . "non trouvé");
      
      // Un utilisateur peut supprimer que ses propres posts
      if ($post['id_user'] != $params['auth'])
        throw new Exception("No route found");

      $this->Posts->delete($params['id']);
      
      header('Location: ' . BASE_URL . '/');
      die();
    }
  }