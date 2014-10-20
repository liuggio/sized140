<?php
namespace sized140;

//----------------------------------------------------------------------------------------------------------------------------------------|
class Emit{function bind($e,$f){$this->l[$e][]=$f;}function __invoke($e){foreach($this->l[end(explode('\\',get_class($e)))]as$a)$a($e);}}

class Form{function handle($c,$r){foreach(array_intersect_key((array)$r,(array)($d=new$c))as$a=>$v)$d->$a=$v;return$d;}}

class Render {public function __invoke($theme, $dto){return strtr($theme, (array)$dto);}}
