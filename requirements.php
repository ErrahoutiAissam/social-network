<?php

// Global variables
require_once('variables.php');

// Utilities
require_once('./utils.php');

// Route
require_once('Route.php');
require_once('Router.php');

// Database
require_once('./db.php');
require_once('./models/Model.php');
require_once('./models/admin/Model.php');

// Controllers
require_once('./controllers/admin/Controller.php');
require_once('./controllers/admin/Authentifications.php');
require_once('./controllers/admin/Home.php');
require_once('./controllers/admin/Users.php');
require_once('./controllers/admin/Posts.php');
require_once('./controllers/admin/Follows.php');
require_once('./controllers/admin/Search.php');

require_once('./controllers/Controller.php');
require_once('./controllers/Authentifications.php');
require_once('./controllers/Home.php');
require_once('./controllers/Users.php');
require_once('./controllers/Posts.php');
require_once('./controllers/Follows.php');
require_once('./controllers/Likes.php');
