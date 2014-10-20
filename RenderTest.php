<?php
namespace sized140;

include __DIR__ . '/Sized140.php';

$template = "the test";
$dto      = new \StdClass();

$dto->the  = "Hello";
$dto->test = "World";

$render = new Render();

if ($render($template, $dto) == 'Hello World'){
    echo "\ntests pass Yes\n";
    exit(0);
}

echo "\ntests Fail\n";
exit(1);
