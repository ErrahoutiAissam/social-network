<?php

  require_once(ROOT . 'Validations.php');

  class Route {
    private $name;

    private $path;

    private $parameters = [];

    private $methods = [];

    private $vars = [];

    private $types = [];

    /**
     * @param string $path
     * @param array $parameters
     *    $parameters = [
     *      0 => (string) Controller name : HomeController::class.
     *      1 => (string|null) Method name or null if invoke method
     *    ]
     * @param array $methods
     */
    public function __construct(string $path, array $parameters, array $methods = ['GET'], $types = []) {
      $this->path = $path;
      $this->parameters = $parameters;
      $this->methods = $methods;
      $this->types = $types;
    }

    public function match(string $path, string $method = ""): bool {
      $regex = $this->getPath();
      foreach ($this->getVarsNames() as $variable) {
        $varName = trim($variable, '{\}');
        $regex = str_replace($variable, '(?P<' . $varName . '>[^/]++)', $regex);
      }

      if (in_array($method, $this->getMethods()) && preg_match('#^' . $regex . '$#sD', self::trimPath($path), $matches)) {
        $values = array_filter($matches, static function ($key) {
          return is_string($key);
        }, ARRAY_FILTER_USE_KEY);

        foreach ($values as $key => $value) {
          $this->vars[$key] = $value;
        }

        // Check vars types
        foreach ($values as $key => $value) {
          if (isset($this->types[$key])) {
            if ((new Validations([new Validation($key, $value, $this->types[$key])]))->hasErrors())
              return false;
          }
        }
        return true;
      }
      return false;
    }

    public function getPath(): string {
      return $this->path;
    }

    public function getParameters(): array {
      return $this->parameters;
    }

    public function getMethods(): array {
      return $this->methods;
    }

    public function getVarsNames(): array {
      preg_match_all('/{[^}]*}/', $this->path, $matches);

      return reset($matches) ?? [];
    }

    public function hasVars(): bool {
      return $this->getVarsNames() !== [];
    }

    public function getVars(): array {
      return $this->vars;
    }

    public static function trimPath(string $path): string {
      return '/' . rtrim(ltrim(trim($path), '/'), '/');
    }
  }