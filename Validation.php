<?php

class Validation
{
  private static $patterns = [
    'uri'           => '[A-Za-z0-9-\/_?&=]+',
    'url'           => '[A-Za-z0-9-:.\/_?&=#]+',
    'alpha'         => '[\p{L}]+',
    'words'         => '[\p{L}\s]+',
    'alphanum'      => '[\p{L}0-9]+',
    'int'           => '[0-9]+',
    'float'         => '[0-9\.,]+',
    'tel'           => '[0-9+\s()-]+',
    'text'          => '[\p{L}0-9\s.,;:!"%&()?+\'°#\/@-]+',
    'file'          => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+\.[A-Za-z0-9]{2,4}',
    'folder'        => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+',
    'address'       => '[\p{L}0-9\s.,()°-]+',
    'date_dmy'      => '[0-9]{1,2}\-[0-9]{1,2}\-[0-9]{4}',
    'date_ymd'      => '[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}',
    'email'         => '[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+[.][a-z-A-Z]+'
  ];

  private $errors = [];

  private $key;

  private $label;

  private $value;

  private $pattern = null;

  private $required;

  private $minVal;

  private $maxVal;

  public function __construct($key, $value, $pattern)
  {
    if (!isset(self::$patterns[$pattern]))
      throw new Exception("Pattern doens't exist");

    $this->key = $key;
    $this->pattern = $pattern;
    $this->value = $value;
  }

  public function pattern(): bool
  {
    $regex = '/^(' . self::$patterns[$this->pattern] . ')$/u';
    return $this->value == '' || preg_match($regex, $this->value);
  }

  public function customPattern(string $pattern): bool
  {
    $regex = '/^(' . $pattern . ')$/u';
    return $this->value == '' || preg_match($regex, $this->value);
  }

  public function required(): bool
  {
    return !($this->value == '' || $this->value == null);
  }

  public function min($length): bool
  {
    if (is_array($this->value)) {
      foreach ($this->value as $v) {
        if (!(new Validation("key", $v, $this->pattern))->min($length))
          return false;
      }
      return true;
    }

    if ($this->pattern == 'int' || $this->pattern == 'float') {
      return (float) $this->value >= $length;
    }

    if (is_string($this->value))
      return strlen($this->value) >= $length;

    return false;
  }

  public function max($length): bool
  {
    if ($this->pattern == 'int' || $this->pattern == 'float') {
      return (float) $this->value <= $length;
    }

    if (is_array($this->value)) {
      foreach ($this->value as $v) {
        if (!(new Validation("key", $v, $this->pattern, false, $length))->max($length))
          return false;
      }
      return true;
    }

    if (is_string($this->value))
      return strlen($this->value) <= $length;

    return false;
  }

  public function equal($value): bool
  {
    return $this->value == $value;
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

  public function match(): bool
  {
    if (!$this->pattern()) {
      $this->errors['pattern'] = $this->label . " est invalide";
      return false;
    }

    if ($this->required != false) {
      if (!$this->required()) {
        $this->errors['required'] = $this->label . " est obligatoire";
        return false;
      }
    }

    if ($this->minVal != null) {
      if (!$this->min($this->minVal)) {
        $this->errors['min'] = $this->label . " n'a pas dépassé la limite minimale";
        return false;
      }
    }

    if ($this->maxVal != null) {
      if (!$this->max($this->maxVal)) {
        $this->errors['max'] = $this->label . " a dépassé la limite maximale";
        return false;
      }
    }

    return true;
  }

  public function setKey(bool $key)
  {
    $this->key = $key;
    return $this;
  }

  public function getKey()
  {
    return $this->key;
  }

  public function setValue($value)
  {
    $this->value = $value;
  }

  public function getValue()
  {
    return $this->value;
  }

  public function setPattern($pattern)
  {
    if (!isset(self::$patterns[$pattern]))
      throw new Exception("Pattern doens't exist");

    $this->pattern = $pattern;
    return $this;
  }

  public function getPattern()
  {
    return $this->pattern;
  }

  public function setRequired(bool $required)
  {
    $this->required = $required;
    return $this;
  }

  public function getRequired(): bool
  {
    return $this->required;
  }

  public function setMin($min)
  {
    $this->minVal = $min;
    return $this;
  }

  public function getMin()
  {
    return $this->minVal;
  }

  public function setMax($max)
  {
    $this->maxVal = $max;
    return $this;
  }

  public function getMax()
  {
    return $this->maxVal;
  }

  public function setLabel($label)
  {
    $this->label = $label;
    return $this;
  }

  public function getLabel()
  {
    return $this->label;
  }
}
