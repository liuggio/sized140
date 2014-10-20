This is a stupid project
========================

## Emit

#### the Object Oriented Event dispatcher in a tweet:

``` php
class Emit{function bind($e,$f){$this->l[$e][]=$f;}function __invoke($e){foreach($this->l[end(explode('\\',get_class($e)))]as$a)$a($e);}}
```

Usage

``` php
$emit = new Emit();
// Binding 1 event to 2 listeners
$emit->bind('FoodOrdered', function(){
        echo 'FOOD ORDERED...';
});
$emit->bind('FoodOrdered', function($e){
        echo $e->name;
});

$event = new FoodOrdered('Pizza');
// calling the event
$emit($event);
```

## Thanks to

1. http://twitto.org/  A web framework in a tweet (@fabpot)
2. http://twittee.org/ A Dependency Injection Container in a Tweet (@fabpot)
3. https://github.com/lastguest/ev A tweet-sized PHP Event emitter
