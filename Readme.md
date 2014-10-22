WOW
===

* Super-fast
* http status code are important
* uses some DDD concept
* Super micro it is [yocto](http://en.wikipedia.org/wiki/Yocto-)
* it works :)

## 6 tweets framework

``` php
function form($d,$r){foreach(array_intersect_key((array)$r,(array)($c=is_object($d)?$d:new$d))as$a=>$v){$c->$a=$v;}return $c;}
class Is{var$r;function ok($o,$m){$e=[];foreach($o as$p=>$v)foreach($m[$p]as$a)if(!preg_match($this->r[$a]?:$a, $v))$e[$p]=$a;return$e;}}
function render($t,$d=0){if(!$d)return$t;$d=(array)$d;$o=[];array_walk($d,function($i,$k)use(&$o){$o['{'."$k}"]=$i;});return strtr($t,$o);}
function match($u,$s){foreach($s as$a=>$c)if(preg_match("@^{$a}$@D",$u,$m)){array_shift($m);return[$a,$c,$m];}}
function hub($u,$r,$s,$m){$m.=" $u";list(,$a,$c)=match($m,$s);$c[]=$r;return $a?call_user_func_array($a,$c):'404'.header('HTTP/1.1 404');}
class Emit{function bind($e,$f){$this->l[$e][]=$f;}function __invoke($e){foreach($this->l[end(explode('\\',get_class($e)))]as$a)$a($e);}}
```

## Real Demo:

There's a running example in the [./Example/index.php](./Example/index.php) file.

### Install

1. first clone: `git clone git@github.com:liuggio/sized140.git`, and enter in the `cd sized140`
2. just run with `php -S localhost:8080 Example/index.php`

open your browser at `localhost:8080`

## Components

### 1. Hub: executes the controller

#### Execute controller and find the best match injecting the $request

**hub usage**

``` php
class Controller{
   public function get($slug /*,$request*/) {
       return "[$slug]";
   }
}

$routes = [
    'GET /blog/(\w+)' => '\Sized140\Controller::get',   // will match this
    'POST /blog' => function($request) {echo "Hi mate";}
];

$output = hub('/blog/titleslug', $request=[], $routes, 'GET'); // [titleslug]
```

### 2.Form

#### Forming a DTO in a tweet:

It fills a DTO from a given request, Domain Driven Design Approved.

**Form() usage**

``` php
$httpRequest = array('who'=>'liuggio', 'something we don\'t need');

$kissCommandDTO = form('\sized140\KissCommandDTO', $httpRequest);

echo $kissCommandDTO->who; // liuggio
```
or given an already instantiated object:

``` php
$httpRequest = array('who'=>'liuggio', 'something we don\'t need');

$kissCommandDTO = new \sized140\KissCommandDTO();
$kissCommandDTO->who = 'nobody';

$kissCommandDTO = form($kissCommandDTO, $httpRequest);

echo $kissCommandDTO->who; // liuggio
```

### 3. Is->ok object validation

#### Validation in a tweet:

Given an object, `Is->ok` will check if all the proprieties respect the validation as regex on the mappings array

**Is->ok() usage**

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

### 4.Route Matcher

#### The *route* matcher in a tweet:

Given an array of routes, it find the one matching with the request.

**Match usage**

``` php
$routes = [
    '/users/(\w+)/blog/(\w+)' => '\Sized140\UserController::get', // class name or function
    '/admin/(\w+)' => function ($id) {echo $id;}
];

$output = match($_SERVER["PATH_INFO"], $routes); //$_SERVER["PATH_INFO"] = "/users/15/blog/38";

// $output is ['/users/(\w+)/blog/(\w+)', '\Sized140\UserController', [15,38]]
// var_dump(return call_user_func_array($output[1],$output[2]));
```

### 5.Template engine

*Contribution provided by @claudio-dalicandro*

#### The template Render in a tweet:

It replaces variables in a template.

**Render usage**

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

### 6.Emit the Event Dispatcher

#### The Object Oriented Event dispatcher in a tweet:

**Emit usage**

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

### Tests

See the [./Tests](./Tests) folder for more examples

## Thanks to

1. http://twitto.org/  A web framework in a tweet by @fabpot
2. http://twittee.org/ A Dependency Injection Container in a Tweet by @fabpot
3. https://github.com/lastguest/ev A tweet-sized PHP Event emitter @lastguest
4. https://gist.github.com/mathiasverraes/9046427 - A test framework in a tweet by @mathiasverraes
