<?php
// All available Routes
require_once 'src/Router.php';
$router = new Router();
$router->add('get', '/products/find/:id', function ($id) {
    echo sprintf('ID: %s' , $id);
});
