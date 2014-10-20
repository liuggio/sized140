<?php
namespace sized140;
class Emit{function bind($e,$f){$this->l[$e][]=$f;}function __invoke($e){foreach($this->l[end(explode('\\',get_class($e)))]as$a)$a($e);}}


