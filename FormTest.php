<?php
namespace sized140;

include __DIR__ . '/Form.php';

// this is an event
class KissCommandDTO {
    public $who;
}

$httpRequest = array('who'=>'liuggio', 'something we don\'t need');
$form = new Form();
$kissCommandDTO = $form->handle('\sized140\KissCommandDTO', $httpRequest);

if ($kissCommandDTO->who == 'liuggio'){
    echo "\ntests pass Yes";
    exit(0);
}

echo "\ntests Fail";
exit(1);