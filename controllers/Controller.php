<?php

  namespace App\Controllers;

  abstract class Controller {
    protected function __construct() {
      require_once(ROOT . 'Validations.php');
      $this->loadModel('Users');
    }

    public function loadModel($model) {
      require_once(ROOT . 'models/' . $model . '.php');
      $this->$model = new $model();
    }

    public function render($filename, $variables = []) {
      extract($variables);
      require_once(ROOT . 'views/' . strtolower(explode("\\", get_class($this))[2]) . '/' . $filename . '.php');
    }
  }