<?php
namespace Sized140;

include __DIR__ . '/Sized140.php';

$routes = [
    '/users/(\w+)/blog/(\w+)' => '\Sized140\UserController'
];
$_SERVER["PATH_INFO"] = "/users/15/blog/38";

$output = match($_SERVER["PATH_INFO"], $routes);


$assertion = ['/users/(\w+)/blog/(\w+)', '\Sized140\UserController', [15,38]];
if ($output == $assertion){
    echo "\ntests pass Yes\n";
    exit(0);
}

echo "\ntests Fail\n";
exit(1);
