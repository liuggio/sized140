<?php
namespace Sized140;

//----------------------------------------------------------------------------------------------------------------------------------------|
class Emit{function bind($e,$f){$this->l[$e][]=$f;}function __invoke($e){foreach($this->l[end(explode('\\',get_class($e)))]as$a)$a($e);}}

class Form{function handle($c,$r){foreach(array_intersect_key((array)$r,(array)($d=new$c))as$a=>$v)$d->$a=$v;return$d;}}

class Render{function __invoke($t,$d){$d=(array)$d;$o=[];array_walk($d,function($i,$k)use(&$o){$o['{'.$k.'}']=$i;});return strtr($t,$o);}}
