<?php
namespace App;

// Autoloader
require 'model/Autoloader.php';
\App\model\Autoloader::register();

// Instanciation du routeur
$router = new model\router\Router($_GET['url']);

// Router get
$router->get('/', "Public#displayGallery");
$router->get('/inscription', "Public#displayRegister");
$router->get('/connexion', "Public#displayConnection");

// Router post


//Route execution
$router->run(); 