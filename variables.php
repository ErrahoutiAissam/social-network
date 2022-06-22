<?php
  
  define('ROOT', str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));
  define('BASE_URL', "/" . explode('/', $_SERVER['REQUEST_URI'])[1]);
  define('BASE_URL_ADMIN', "/" . explode('/', $_SERVER['REQUEST_URI'])[1] . '/admin');