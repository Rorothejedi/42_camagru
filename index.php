<?php
namespace App;

// Autoloader
require 'model/Autoloader.php';
\App\model\Autoloader::register();

if(session_id() == "") session_start();

// Instanciation du routeur
$router = new model\router\Router($_GET['url']);

// Router get
$router->get('/', "Public#displayGallery");
$router->get('/inscription', "Public#displayRegister");
$router->get('/confirmation_inscription', "Public#displayRegisterConfirm");
$router->get('/connexion', "Public#displayConnection");

$router->get('/mentions_legales', "Public#displayLegal");


// Router post
$router->post('/processRegistration', "Public#processRegistration");


//Route execution
$router->run();
