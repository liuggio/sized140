<?php
namespace Sized140;

include __DIR__ . '/../Sized140.php';

class KissCommandDTO {
    public $who;
}

$httpRequest = array('who'=>'liuggio', 'something we don\'t need');

$kissCommandDTO = form('\sized140\KissCommandDTO', $httpRequest);

if ($kissCommandDTO->who == 'liuggio'){
    echo "\ntests pass Yes";
    exit(0);
}

echo "\ntests Fail";
exit(1);