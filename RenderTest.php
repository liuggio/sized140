<?php
namespace Sized140;

include __DIR__ . '/Sized140.php';

$template = "{the} {test}";
$dto      = new \StdClass();

$dto->the  = "Hello";
$dto->test = "World";

$render = new Render();

$out = $render($template, $dto);
if ($out == 'Hello World'){
    echo "\ntests pass Yes\n";
    exit(0);
}

echo "\ntests Fail\n";
exit(1);
