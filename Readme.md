This is a stupid project about [yocto](http://en.wikipedia.org/wiki/Yocto-)-components
======================================================================================

## Form

#### Forming a DTO in a tweet:

``` php
function form($c,$r){foreach(array_intersect_key((array)$r,(array)($d=new$c))as$a=>$v)$d->$a=$v;return$d;}
```
It fills a DTO from a given request, Domain Driven Design Approved.

**Form() Usage**

``` php
$httpRequest = array('who'=>'liuggio', 'something we don\'t need');

$kissCommandDTO = form('\sized140\KissCommandDTO', $httpRequest);

echo $kissCommandDTO->who;
```

## Validation

#### Object oriented validation in a tweet:

``` php
class Is{var $r;function ok($o,$m){$e=[];foreach($o as$p=>$v)foreach($m[$p] as$a)if(!preg_match($this->r[$a]?:$a,$v))$e[$p]=$a;return $e;}}
```
Given an object, `Is->ok` will check if all the proprieties respect the validation on the mappings.

**Is() Usage**

``` php
// the object to validate:
class User
{
    public $name;
    public $email;
}

// The Object mapping
$userMapping = [
// property | assertion types
    'name'  => ['string', '/^[\S]{3,}$/'],
    'email' => ['email']
];

$alice =  new User();
$alice->name = 'Alice';
$alice->email = 'alice@email.com';

// init object
$is = new Is();
// register assertions
$is->r = [
    'string' => '/^[\S]+$/',
    'email' => '/^\S+@\S+\.\S+$/'
];

// Is the object OK?
$errors = $is->ok($alice, $userMapping);

count($errors) is 0 if there's no error;
```

## Routing

#### The *route* matcher in a tweet:

``` php
function match($p,$s){foreach($s as$a=>$c)if(preg_match("@^{$a}$@D",$p,$m)){array_shift($m);return[$a,$c,$m];}}
```
Given an array of routes, it find the one matching with the request.

**Match Usage**

``` php
$routes = [
    '/users/(\w+)/blog/(\w+)' => '\Sized140\UserController', // class name or function
    '/admin/(\w+)' => function ($id) { echo $id;}
];

$output = match($_SERVER["PATH_INFO"], $routes); //$_SERVER["PATH_INFO"] = "/users/15/blog/38";

// $output is ['/users/(\w+)/blog/(\w+)', '\Sized140\UserController', [15,38]]
// var_dump(return call_user_func_array($output[1],$output[2]));
```

## Templating

*Contribution provided by @claudio-dalicandro*

#### The template Render in a tweet:

``` php
function render($t,$d){$d=(array)$d;$o=[];array_walk($d,function($i,$k)use(&$o){$o['{'.$k.'}']=$i;});return strtr($t,$o);}
```
It replaces variables in a template.

**Render Usage**

``` php
$template = "{the} {test}";
$dto      = new \StdClass();

$dto->the  = "Hello";
$dto->test = "World";

echo render($template, $dto); // "Hello World"
```
or simply use array:

``` php
$dto = array('the'=>'Hello', 'test'=>'world');

echo render($template, $dto); // "Hello World"
```

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

## Thanks to

1. http://twitto.org/  A web framework in a tweet by @fabpot
2. http://twittee.org/ A Dependency Injection Container in a Tweet by @fabpot
3. https://github.com/lastguest/ev A tweet-sized PHP Event emitter @lastguest
4. https://gist.github.com/mathiasverraes/9046427 - A test framework in a tweet by @mathiasverraes
