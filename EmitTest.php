<?php
namespace Sized140;

include __DIR__ . '/Sized140.php';

// this is an event
class FoodOrdered {
    public $name;
    public function __construct($name) {
        $this->name = $name;
    }
}

$emit = new Emit();
// Binding 2 events
$emit->bind('FoodOrdered', function(){
        echo 'FOOD ORDERED...';
});
$emit->bind('FoodOrdered', function($e){
        echo $e->name;
});

$event = new FoodOrdered('Pizza');
ob_start();
$emit($event);
$content = ob_get_contents();

if ($content=='FOOD ORDERED...Pizza'){
    echo "\ntests pass Yes";
    exit(0);
}

echo "\ntests Fail";
exit(1);