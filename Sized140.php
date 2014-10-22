<?php
namespace Sized140;

//----------------------------------------------------------------------------------------------------------------------------------------|
/**
 * Form fill the $d DTO (and also create it, if not instantiated), with the value from the $r (request).
 *
 * @param object|string $d The DTO to fill.
 * @param array         $r The Request.
 *
 * @return mixed
 */
function form($d,$r){foreach(array_intersect_key((array)$r,(array)($c=is_object($d)?$d:new$d))as$a=>$v){$c->$a=$v;}return $c;}

/**
 * Validation Is->ok function validate an object $o with its mapping $m.
 *
 * @param object|array $o The object to fill.
 * @param array        $m The array of mapping [k=>v]
 *.
 * @return array
 */
class Is{var$r;function ok($o,$m){$e=[];foreach($o as$p=>$v)foreach($m[$p]as$a)if(!preg_match($this->r[$a]?:$a, $v))$e[$p]=$a;return$e;}}

/**
 * Template render a string $t filling the variables $d with the syntax {variablename}.
 *
 * @param string    $t The template string.
 * @param array|int $d The array of variable.
 *
 * @return string
 */
function render($t,$d=0){if(!$d)return$t;$d=(array)$d;$o=[];array_walk($d,function($i,$k)use(&$o){$o['{'."$k}"]=$i;});return strtr($t,$o);}

/**
 * Route matcher, return an array of the best match of the url $u on multiple routes $s.
 *
 * @param string $u The uri "REQUEST_URI" eg /homepage.
 * @param array  $s The array of routes with the syntax ['regex'=> executable] eg ['/'=>function ($request){...}].
 *
 * @return array The array has the syntax: [route-key, executable, arguments-extracted-from-the-preg].
 */
function match($u,$s){foreach($s as$a=>$c)if(preg_match("@^{$a}$@D",$u,$m)){array_shift($m);return[$a,$c,$m];}}

/**
 * Using the function match, it execute the controller giving the response as input.
 *
 * @param string $u The uri "REQUEST_URI" eg /homepage.
 * @param array  $r The $_Request array this will be injected to the controller as argument.
 * @param array  $s The array of routes with the syntax ['METHOD regex'=> executable ] eg ['GET /'=>function ($request){...}].
 * @param string $m The HTTP method eg. 'GET'.
 *
 * @return mixed
 */
function hub($u,$r,$s,$m){$m.=" $u";list(,$a,$c)=match($m,$s);$c[]=$r;return $a?call_user_func_array($a,$c):'404'.header('HTTP/1.1 404');}


/**
 * Emit->bind
 * @param string   $e The event name to bind.
 * @param callable $f The listener to execute.
 *
 * Emit($event)
 * @param object $e The event to raise.
 *
 */
class Emit{function bind($e,$f){$this->l[$e][]=$f;}function __invoke($e){foreach($this->l[end(explode('\\',get_class($e)))]as$a)$a($e);}}
