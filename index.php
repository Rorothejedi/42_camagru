<?php
namespace App;

// Autoloader
require 'model/Autoloader.php';
\App\model\Autoloader::register();

// Instanciation du routeur
$router = new model\router\Router($_GET['url']);

// Router get
$router->get('/', "Public#displayGallery");

// Router post


//Route execution
$router->run(); 