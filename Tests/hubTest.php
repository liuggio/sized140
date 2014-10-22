<?php
namespace Sized140;

include __DIR__ . '/../Sized140.php';


class Controller{
   public function get($slug) {
       return "[$slug]";
   }
}

$routes = [
    'GET /blog/(\w+)' => '\Sized140\Controller::get',
    'POST /blog' => function($request) {echo "Hi mate".implode(';',$request);}
];

$output = hub('/blog/titleslug', [], $routes, 'GET');


if ($output=='[titleslug]'){
    echo "\ntests pass Yes\n";
    exit(0);
}
var_dump($output);

echo "\ntests Fail\n";
exit(1);
