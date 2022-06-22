<?php

  namespace App\Admin\Controllers;

  use \Exception;
  use \Validation;
  use \Validations;

  class Authentifications extends Controller {
    public function __construct() {
      require_once(ROOT . 'Validations.php');
      $this->loadModel("Authentifications");
    }

    public function login() {
      $this->render('login');
    }
    public function register() {
      $this->render('register');
    }
    public function postLogin($params = []) {
      if (!isset($params['username']) || !isset($params['password']))
        throw new Exception("Username or password invalid!");

      $validator = new Validations([
        (new Validation('username', $params['username'], 'alphanum'))
          ->setLabel('Nom d\'utilisateur')
          ->setRequired(true),
        (new Validation('password', $params['password'], 'text'))
          ->setLabel('Mot de passe')
          ->setRequired(true)
      ]);

      $errors = $validator->getErrors();

      $user = $this->Authentifications->login($params['username'], $params['password']);

      if ($validator->isSuccess()) {
        if ($user) {
          if (PHP_SESSION_NONE === session_status())
            session_start();
          $_SESSION['auth-admin'] = $user['id'];

          header('Location: ' . BASE_URL_ADMIN . '/');
          die();  
        } else {
          $errors['auth'] = "Nom d'utilisateur ou mot de passe incorrecte";
        }
      }
      $this->render('login', compact('errors'));
    }
    public function postRegister($params = []) {
      $validator = new Validations([
        (new Validation('firstname', $params['firstname'], 'words'))
          ->setLabel('Prénom')
          ->setRequired(true),
        (new Validation('lastname', $params['lastname'], 'words'))
          ->setLabel('Nom')
          ->setRequired(true),
        (new Validation('username', $params['username'], 'alphanum'))
          ->setLabel('Nom d\'utilisateur')
          ->setRequired(true)
          ->setMin(4),
        (new Validation('email', $params['email'], 'email'))
          ->setLabel('Email')
          ->setRequired(true),
        (new Validation('password', $params['password'], 'text'))
          ->setLabel('Mot de passe')
          ->setRequired(true)
          ->setRequired(4)
      ]);

      $errors = $validator->getErrors();
      $success = $validator->isSuccess();

      $users = $this->Authentifications->findBy(['username' => $params['username']]);

      if (count($users) > 0) {
        $errors['auth'] = "Nom d'utilisateur déja utilisé";
        $success = false;
      } else {
        if ($success) {
          $this->Authentifications->create([
            'firstname' => $params['firstname'],
            'lastname' => $params['lastname'],
            'username' => $params['username'],
            'email' => $params['email'],
            'password' => password_hash($params['password'], null),
            'type' => 'admin'
          ]);
        }
      }

      $this->render('register', compact('errors', 'success'));
    }

    public function logout() {
      session_start();
      session_destroy();
      header('Location: ' . BASE_URL_ADMIN . '/login');
      die();
    }
  }