<?php 
require_once __DIR__ . '/Router.php';

$router = new Router();

$router->add('/', __DIR__ . '/../views/home.php');
$router->add('/login', __DIR__ . '/../views/login.php');
$router->add('/sign-up', __DIR__ . '/../views/signup.php');
$router->add('/admin', __DIR__ . '/../views/admin.php');


// Custom callback example
$router->add('/hello', function () {
    echo "Hello, welcome!";
});

return $router;