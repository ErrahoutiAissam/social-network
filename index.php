<?php

require_once('requirements.php');

session_start();

use App\Admin\Controllers\Authentifications;
use App\Admin\Controllers\Home;
use App\Admin\Controllers\Users;
use App\Admin\Controllers\Posts;
use App\Admin\Controllers\Follows;
use App\Admin\Controllers\Search;
use App\Controllers\Authentifications as AuthentificationsController;
use App\Controllers\Home as HomeController;
use App\Controllers\Users as UsersController;
use App\Controllers\Posts as PostsController;
use App\Controllers\Follows as FollowsController;
use App\Controllers\Likes as LikesController;

// require('test.php');

$router = new Router([
  new Route('/admin/login', [Authentifications::class, 'login'], ['GET']),
  new Route('/admin/register', [Authentifications::class, 'register'], ['GET']),
  new Route('/admin/login', [Authentifications::class, 'postLogin'], ['POST']),
  new Route('/admin/register', [Authentifications::class, 'postRegister'], ['POST']),
  new Route('/admin/logout', [Authentifications::class, 'logout'], ['GET']),

  new Route('/admin', [Home::class, 'index'], ['GET']),
  new Route('/admin/profil', [Users::class, 'profil'], ['GET']),

  new Route('/admin/posts', [Posts::class, 'index'], ['GET']),
  new Route('/admin/post/{id}', [Posts::class, 'get'], ['GET'], ['id' => 'int']),
  new Route('/admin/post/add', [Posts::class, 'add'], ['GET']),
  new Route('/admin/post/{id}/edit', [Posts::class, 'edit'], ['GET'], ['id' => 'int']),
  new Route('/admin/post/{id}/delete', [Posts::class, 'delete'], ['GET'], ['id' => 'int']),

  new Route('/admin/post/add', [Posts::class, 'postAdd'], ['POST']),
  new Route('/admin/post/{id}/edit', [Posts::class, 'postEdit'], ['POST'], ['id' => 'int']),
  new Route('/admin/post/{id}/delete', [Posts::class, 'postDelete'], ['POST'], ['id' => 'int']),

  new Route('/admin/users', [Users::class, 'index'], ['GET']),
  new Route('/admin/user/{id}', [Users::class, 'get'], ['GET'], ['id' => 'int']),
  new Route('/admin/user/{id}/edit', [Users::class, 'edit'], ['GET'], ['id' => 'int']),
  new Route('/admin/user/{id}/delete', [Users::class, 'delete'], ['GET'], ['id' => 'int']),

  new Route('/admin/user/{id}/edit', [Users::class, 'postEdit'], ['POST'], ['id' => 'int']),
  new Route('/admin/user/{id}/delete', [Users::class, 'postDelete'], ['POST'], ['id' => 'int']),

  new Route('/admin/follows', [Follows::class, 'index'], ['GET']),
  new Route('/admin/follows/{id}', [Follows::class, 'get'], ['GET'], ['id' => 'int']),
  new Route('/admin/follows/add', [Follows::class, 'add'], ['GET']),
  new Route('/admin/follows/{id}/delete', [Follows::class, 'delete'], ['GET'], ['id' => 'int']),

  new Route('/admin/follows/add', [Follows::class, 'postAdd'], ['POST']),
  new Route('/admin/follows/{id}/delete', [Follows::class, 'postDelete'], ['POST'], ['id' => 'int']),


  new Route('/', [HomeController::class, 'index'], ['GET']),
  new Route('/login', [AuthentificationsController::class, 'login'], ['GET']),
  new Route('/register', [AuthentificationsController::class, 'register'], ['GET']),
  new Route('/login', [AuthentificationsController::class, 'postLogin'], ['POST']),
  new Route('/register', [AuthentificationsController::class, 'postRegister'], ['POST']),
  new Route('/logout', [AuthentificationsController::class, 'logout'], ['GET']),

  new Route('/profil', [UsersController::class, 'profil'], ['GET']),
  new Route('/profil/edit', [UsersController::class, 'editProfil'], ['POST']),
  new Route('/user/{id}', [UsersController::class, 'get'], ['GET'], ['id' => 'int']),

  new Route('/post/add', [PostsController::class, 'postAdd'], ['POST'], ['id' => 'int']),

  new Route('/search/{query}', [UsersController::class, 'search'], ['GET'], ['query' => 'alphanum']),

  new Route('/follow/{id}', [FollowsController::class, 'follow'], ['GET'], ['id' => 'int']),
  new Route('/unfollow/{id}', [FollowsController::class, 'unfollow'], ['GET'], ['id' => 'int']),

  new Route('/like/{id}', [LikesController::class, 'like'], ['GET'], ['id' => 'int']),
  new Route('/unlike/{id}', [LikesController::class, 'unlike'], ['GET'], ['id' => 'int']),
  new Route('/admin/search/users/{query}', [Search::class, 'getUsers'], ['GET'], ['query' => 'alphanum']),
  new Route('/admin/search/posts/{query}', [Search::class, 'getPosts'], ['GET'], ['query' => 'alphanum'])
]);

try {
  $route = $router->matchFromPath($_GET['p'], $_SERVER['REQUEST_METHOD']);

  if (explode("/", trim($route->getPath(), "/"))[0] == 'admin') {
    switch ($route->getPath()) {
      case '/admin/login':
      case '/admin/register':
        if (isset($_SESSION['auth-admin'])) {
          header('Location: ' . BASE_URL_ADMIN . '/');
          die();
        }
        break;

      default:
        if (!isset($_SESSION['auth-admin'])) {
          header('Location: ' . BASE_URL_ADMIN . '/login');
          die();
        }
        break;
    }
  } else {
    switch ($route->getPath()) {
      case '/login':
      case '/register':
        if (isset($_SESSION['auth-client'])) {
          header('Location: ' . BASE_URL . '/');
          die();
        }
        break;

      default:
        if (!isset($_SESSION['auth-client'])) {
          header('Location: ' . BASE_URL . '/login');
          die();
        }
        break;
    }
  }

  $vars = $route->getVars();

  $parameters = $route->getParameters();
  $controllerName = $parameters[0];

  $method = $parameters[1];
  $controller = new $controllerName();

  switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
      $controller->$method(array_merge($vars, $_SESSION));
      break;
    case 'POST':
      $controller->$method(array_merge($_POST, $vars, $_SESSION));
      break;
  }
} catch (Exception $e) {
  $msgError = $e->getMessage();
  require('views/admin/404/index.php');
}
