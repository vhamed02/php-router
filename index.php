<?php
require_once 'routes.php';
global $router;

try {
    $router->match();
} catch (Exception $exception) {
    print '<h1 style="text-align: center;margin-top: 25px;">' . $exception->getMessage() . '</h1>';
}