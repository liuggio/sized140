<?php
namespace Sized140;

include __DIR__ . '/../Sized140.php';
include __DIR__ . '/ui.php';

/**
 *
 * php -S 127.0.0.1:8080 index.php
 *
 * open the browser and go to http://127.0.0.1/something
 *
 */
// Init Validation
$is = new Is();
$is->r =[
    'string' => '/^[\S]+$/',
    'not-null' => '/^/'
];

$blog = new BlogController($is);

// Init routes
$routes = [
    'GET /(\w+)'  => [$blog, 'get'],
    'GET /'       => [$blog, 'homepage'],
    'POST /(\w+)' => [$blog, 'post']
];

$path_info = !empty($_SERVER['PATH_INFO']) ?: (!empty($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : $_SERVER['REQUEST_URI']);

// Create the Response
$response = hub($path_info, $_REQUEST, $routes, $_SERVER['REQUEST_METHOD']);

// response
echo $response;