<?php

use Http\Route;
use Render\View;


include_once __DIR__.'/../config.php';
require __DIR__.'/../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('../app/views');
$twig = new Twig_Environment($loader, ['cache' => '../cache', 'debug' => DEBUG]);

$views = new View($twig);

include_once __DIR__.'/routes.php';

echo Route::routes($_SERVER['REQUEST_URI']);
