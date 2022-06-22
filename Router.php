<?php

  class Router {
    private const NO_ROUTE = 404;

    private $routes;

    /**
     * Router constructor.
     * @param $routes array<Route>
     */
    public function __construct(array $routes = []) {
      $this->routes = $routes;
    }

    public function matchFromPath(string $path, string $method = ""): Route {
      foreach ($this->routes as $route) {
        if ($route->match($path, $method) === false) {
          continue;
        }
        return $route;
      }
      throw new \Exception(
        'No route found for ' . $method,
        self::NO_ROUTE
      );
    }

    public function generateUri(string $name, array $parameters = []): string {
      return $this->urlGenerator->generate($name, $parameters);
    }

    public function getUrlgenerator(): UrlGenerator {
      return $this->urlGenerator;
    }
  }