<!-- public/index.php -->
<?php

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router = require __DIR__ . '/../routes/web.php';
$router->resolve($requestUri);


