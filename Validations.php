<?php

require_once(ROOT . 'Validation.php');

class Validations
{
  private $errors = array();

  private $array = array();

  public function __construct($array = [])
  {
    $this->array = $array;
    $this->errors = $this->match($array);
  }

  public function add($key, $label, $value, $pattern, $required = false, $min = null, $max = null)
  {
    $this->array[] = new Validation($key, $label, $value, $pattern, $required, $min, $max);
  }

  public function isSuccess(): bool
  {
    if (empty($this->errors)) return true;
    return false;
  }

  public function getErrors(): array
  {
    return $this->errors;
  }

  public function hasErrors(): bool
  {
    return !$this->isSuccess();
  }

  public function match($array): array
  {
    $errors = [];

    foreach ($array as $value) {
      if (!$value->match()) {
        $errors[$value->getKey()] = $value->getErrors();
      }
    }

    return $errors;
  }
}
