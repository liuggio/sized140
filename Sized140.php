<?php
namespace Sized140;

//----------------------------------------------------------------------------------------------------------------------------------------|
function form($c,$r){foreach(array_intersect_key((array)$r,(array)($d=new$c))as$a=>$v)$d->$a=$v;return$d;}

class Is{var$r;function ok($o,$m){$e=[];foreach($o as$p=>$v)foreach($m[$p]as$a)if(!preg_match($this->r[$a]?:$a,$v))$e[$p]=$a;return $e;}}

function render($t,$d){$d=(array)$d;$o=[];array_walk($d,function($i,$k)use(&$o){$o['{'.$k.'}']=$i;});return strtr($t,$o);}

function match($p,$s){foreach($s as$a=>$c)if(preg_match("@^{$a}$@D",$p,$m)){array_shift($m);return[$a,$c,$m];}}

class Emit{function bind($e,$f){$this->l[$e][]=$f;}function __invoke($e){foreach($this->l[end(explode('\\',get_class($e)))]as$a)$a($e);}}


/* not compressed:
function form($c, $r)
{
    foreach (array_intersect_key((array)$r, (array)($d = new$c)) as $a => $v) {
        $d->$a = $v;
    }

    return $d;
}

class Is
{
    var $r;

    function ok($o, $m)
    {
        $e = [];
        foreach ($o as $p => $v) foreach ($m[$p] as $a) if (!preg_match($this->r[$a] ? : $a, $v)) $e[$p] = $a;

        return $e;
    }
}

function render($t, $d)
{
    $d = (array)$d;
    $o = [];
    array_walk(
        $d,
        function ($i, $k) use (&$o) {
            $o['{' . $k . '}'] = $i;
        }
    );

    return strtr($t, $o);
}

function match($p, $s)
{
    foreach ($s as $a => $c) if (preg_match("@^{$a}$@D", $p, $m)) {
        array_shift($m);

        return [$a, $c, $m];
    }
}

class Emit
{
    function bind($e, $f)
    {
        $this->l[$e][] = $f;
    }

    function __invoke($e)
    {
        foreach ($this->l[end(explode('\\', get_class($e)))] as $a) $a($e);
    }
}
*/