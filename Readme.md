This is a stupid project about [yocto](http://en.wikipedia.org/wiki/Yocto-)-components
======================================================================================

## Emit

#### The Object Oriented Event dispatcher in a tweet:

``` php
class Emit{function bind($e,$f){$this->l[$e][]=$f;}function __invoke($e){foreach($this->l[end(explode('\\',get_class($e)))]as$a)$a($e);}}
```

**Emit Usage**

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

## Form

#### The Object Oriented DTO handler in a tweet:

``` php
class Form{function handle($c,$r){foreach(array_intersect_key((array)$r,(array)($d=new$c))as$a=>$v)$d->$a=$v;return$d;}}
```

**Form Usage**

``` php
$httpRequest = array('who'=>'liuggio', 'something we don\'t need');
$form = new Form();
$kissCommandDTO = $form->handle('\sized140\KissCommandDTO', $httpRequest);

echo $kissCommandDTO->who;
```

## Validation

Help me to do it :)

## Routing

Help me to do it :)

## Templating

Help me to do it :)

## Controller

Help me to do it :)


## Thanks to

1. http://twitto.org/  A web framework in a tweet by @fabpot
2. http://twittee.org/ A Dependency Injection Container in a Tweet by @fabpot
3. https://github.com/lastguest/ev A tweet-sized PHP Event emitter @lastguest
4. https://gist.github.com/mathiasverraes/9046427 - A test framework in a tweet by @mathiasverraes