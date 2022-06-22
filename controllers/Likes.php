<?php

  namespace App\Controllers;

  use \Exception;
  use \Validation;
  use \Validations;
  
  class Likes extends Controller {
    public function __construct() {
      parent::__construct();
      $this->loadModel("Users");
      $this->loadModel("Likes");
      $this->loadModel("Posts");
    }

    public function like($params = []) {
      $post = $this->Posts->find($params['id']);

      if (!$post) {
        echo json_encode([
          'success' => false,
          'message' => "Post non trouvé"
        ]);
      } else {
        $results = $this->Likes->findBy([
          'id_post' => $params['id'],
          'id_user' => $params['auth-client']
        ]);

        if (count($results) > 0) {
          echo json_encode([
            'success' => false,
            'message' => "Post déja liké"
          ]);
        } else {
          $this->Likes->create([
            'id_post' => $params['id'],
            'id_user' => $params['auth-client']
          ]);

          $nbLikes = count($this->Likes->findBy([
            'id_post' => $params['id']
          ]));
          
          echo json_encode([
            'success' => true,
            'message' => "Like a réussi",
            'nbr_likes' => $nbLikes
          ]);
        }
      }
    }
    public function unlike($params = []) {
      $post = $this->Posts->find($params['id']);

      if (!$post) {
        echo json_encode([
          'success' => false,
          'message' => "Post non trouvé"
        ]);
        die();
      } else {
        $results = $this->Likes->findBy([
          'id_post' => $params['id'],
          'id_user' => $params['auth-client']
        ]);

        if (count($results) > 0) {
          $this->Likes->delete($results[0]['id']);
          $nbLikes = count($this->Likes->findBy([
            'id_post' => $params['id']
          ]));
          echo json_encode([
            'success' => true,
            'message' => "Dislike a réussi",
            'nbr_likes' => $nbLikes
          ]);
          die();
        } else {
          echo json_encode([
            'success' => false,
            'message' => "Déja disliké",
          ]);
          die();
        }
      }
    }
  }